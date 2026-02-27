<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Menampilkan form ulasan
     */
    public function create()
    {
        $penghunis = Penghuni::all();
        return view('ulasan.create', compact('penghunis'));
    }

    /**
     * Menyimpan ulasan ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penghuni'   => 'required|exists:penghunis,id_penghuni',
            'isi_ulasan'    => 'required|string',
            'nilai_rating'  => 'required|integer|min:1|max:5'
        ]);

        Ulasan::create([
            'id_penghuni'      => $request->id_penghuni,
            'isi_ulasan'       => $request->isi_ulasan,
            'nilai_rating'     => $request->nilai_rating,
            'tanggal_ulasan'   => now()
        ]);

        return redirect('/dashboard')->with('success', 'Ulasan berhasil dikirim');
    }
}