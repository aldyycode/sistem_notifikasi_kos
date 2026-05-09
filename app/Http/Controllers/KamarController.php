<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::latest()->get();
        return view('kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamars',
            'tipe_kamar' => 'required',
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar,' . $id . ',id',
            'tipe_kamar' => 'required',
        ]);

        $kamar->update($request->all());

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil diupdate');
    }

      public function show($id)
    {
        $kamar = Kamar::findOrFail($id);

        return view('kamar.show', compact('kamar'));
    }


    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil dihapus');
    }
}