<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghuni;


class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $penghunis = Penghuni::all();
    return view('penghuni.index', compact('penghunis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penghuni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'nama_penghuni' => 'required',
        'nomor_kamar' => 'required',
        'no_wa' => 'required',
        'status_hunian' => 'required'
    ]);

    Penghuni::create([
        'id_pengelola' => 1, // sementara hardcode dulu
        'nama_penghuni' => $request->nama_penghuni,
        'nomor_kamar' => $request->nomor_kamar,
        'no_wa' => $request->no_wa,
        'status_hunian' => $request->status_hunian
    ]);

    return redirect()->route('penghuni.index')
                     ->with('success', 'Data penghuni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $penghuni = Penghuni::findOrFail($id);

    return view('penghuni.edit', compact('penghuni'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_penghuni' => 'required',
        'nomor_kamar'   => 'required',
        'no_wa'         => 'required',
        'status_hunian' => 'required'
    ]);

    $penghuni = Penghuni::findOrFail($id);

    $penghuni->update([
        'nama_penghuni' => $request->nama_penghuni,
        'nomor_kamar'   => $request->nomor_kamar,
        'no_wa'         => $request->no_wa,
        'status_hunian' => $request->status_hunian,
    ]);

    return redirect('/penghuni')->with('success', 'Data berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $penghuni = Penghuni::findOrFail($id);
    $penghuni->delete();

    return redirect('/penghuni')->with('success', 'Data berhasil dihapus');
}
}
