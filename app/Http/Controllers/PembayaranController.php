<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Penghuni;


class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $pembayarans = Pembayaran::with('penghuni')->get();
    return view('pembayaran.index', compact('pembayarans'));
}


    /**
     * Show the form for creating a new resource.
     */
 public function create()
{
    $penghunis = Penghuni::all();
    return view('pembayaran.create', compact('penghunis'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_penghuni' => 'required',
        'jumlah_bayar' => 'required|numeric',
        'jatuh_tempo' => 'required|date'
    ]);

    Pembayaran::create([
        'id_penghuni' => $request->id_penghuni,
        'jumlah_bayar' => $request->jumlah_bayar,
        'jatuh_tempo' => $request->jatuh_tempo,
        'status_bayar' => 'belum_lunas'
    ]);

    return redirect()->route('pembayaran.index')
                     ->with('success', 'Data pembayaran berhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
