<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kamar;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penghunis = Penghuni::with('kamar')->latest()->get();

        return view('penghuni.index', compact('penghunis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kamars = Kamar::where('status_kamar', 'kosong')->get();

        return view('penghuni.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penghuni'        => 'required',
            'id_kamar'            => 'required',
            'no_wa'               => 'required',
            'status_hunian'       => 'required',
            'gender'              => 'required',
            'tanggal_masuk'       => 'required|date',
            'tanggal_keluar'      => 'nullable|date',
            'nama_kontak_darurat' => 'nullable',
            'no_kontak_darurat'   => 'nullable'
        ]);

        Penghuni::create([
            'id_pengelola'         => 1,
            'nama_penghuni'        => $request->nama_penghuni,
            'id_kamar'             => $request->id_kamar,
            'no_wa'                => $request->no_wa,
            'status_hunian'        => $request->status_hunian,
            'gender'               => $request->gender,
            'tanggal_masuk'        => $request->tanggal_masuk,
            'tanggal_keluar'       => $request->tanggal_keluar,
            'nama_kontak_darurat'  => $request->nama_kontak_darurat,
            'no_kontak_darurat'    => $request->no_kontak_darurat
        ]);

        Kamar::where('id_kamar', $request->id_kamar)
            ->update([
                'status_kamar' => 'terisi'
            ]);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penghuni = Penghuni::with('kamar')->findOrFail($id);

        return view('penghuni.show', compact('penghuni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $kamars = Kamar::where('status_kamar', 'kosong')
                    ->orWhere('id_kamar', $penghuni->id_kamar)
                    ->get();

        return view('penghuni.edit', compact('penghuni', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penghuni'        => 'required',
            'id_kamar'            => 'required',
            'no_wa'               => 'required',
            'status_hunian'       => 'required',
            'gender'              => 'required',
            'tanggal_masuk'       => 'required|date',
            'tanggal_keluar'      => 'nullable|date',
            'nama_kontak_darurat' => 'nullable',
            'no_kontak_darurat'   => 'nullable'
        ]);

        $penghuni = Penghuni::findOrFail($id);

        $kamarLama = $penghuni->id_kamar;

        $penghuni->update([
            'nama_penghuni'        => $request->nama_penghuni,
            'id_kamar'             => $request->id_kamar,
            'no_wa'                => $request->no_wa,
            'status_hunian'        => $request->status_hunian,
            'gender'               => $request->gender,
            'tanggal_masuk'        => $request->tanggal_masuk,
            'tanggal_keluar'       => $request->tanggal_keluar,
            'nama_kontak_darurat'  => $request->nama_kontak_darurat,
            'no_kontak_darurat'    => $request->no_kontak_darurat
        ]);

        if ($kamarLama != $request->id_kamar) {
            Kamar::where('id_kamar', $kamarLama)
                ->update([
                    'status_kamar' => 'kosong'
                ]);
        }

        Kamar::where('id_kamar', $request->id_kamar)
            ->update([
                'status_kamar' => 'terisi'
            ]);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        Kamar::where('id_kamar', $penghuni->id_kamar)
            ->update([
                'status_kamar' => 'kosong'
            ]);

        $penghuni->delete();

        return redirect()->route('penghuni.index')
            ->with('success', 'Data penghuni berhasil dihapus');
    }
}