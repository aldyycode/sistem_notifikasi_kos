<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Menampilkan form ulasan
     */
public function create(Request $request)
{
    $id = $request->id_pembayaran ?? $request->payment;

    if (!$id) {
        abort(404, 'ID pembayaran tidak ditemukan');
    }

    $pembayaran = Pembayaran::with('penghuni')->findOrFail($id);

    $sudahReview = Ulasan::where('id_pembayaran', $id)->exists();

    return view('ulasan.create', compact('pembayaran', 'sudahReview'));
}
    /**
     * Menyimpan ulasan ke database
     */
public function store(Request $request)
{
    // VALIDASI
    $request->validate([
        'id_pembayaran' => 'required',
        'id_penghuni'   => 'required',
        'nilai_rating'  => 'required|integer|min:1|max:5',
        'isi_ulasan'    => 'required|string',
    ]);

    // SIMPAN DATA
    Ulasan::create([
        'id_pembayaran' => $request->id_pembayaran,
        'id_penghuni'   => $request->id_penghuni,
        'nilai_rating'  => $request->nilai_rating,
        'isi_ulasan'    => $request->isi_ulasan,
    ]);

    // REDIRECT (WAJIB)
    return redirect()->route('ulasan.terimakasih');
}
}