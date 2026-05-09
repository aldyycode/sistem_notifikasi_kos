<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    public function index()
    {
        $penghunis = Penghuni::with('kamar')->latest()->get();
        return view('penghuni.index', compact('penghunis'));
    }

    public function create()
    {
        // hanya ambil kamar kosong
        $kamars = Kamar::where('status_kamar', 'kosong')->get();
        // $kamars = Kamar::all();

        return view('penghuni.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penghuni' => 'required|string|max:255',
            'kamar_id' => 'required|exists:kamars,id',
            'no_wa' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'tanggal_masuk' => 'required|date',
            'status_hunian' => 'required|in:aktif,nonaktif',
        ]);

        // cek ulang kamar masih kosong (anti race condition sederhana)
        $kamar = Kamar::findOrFail($request->kamar_id);

        if ($kamar->status_kamar !== 'kosong') {
            return back()->withErrors(['kamar_id' => 'Kamar sudah terisi'])->withInput();
        }

//         if (!is_numeric(auth()->id())) {
//     dd('ID USER BUKAN INTEGER', auth()->id());
// }

        Penghuni::create([
            'id_pengelola' => 1,
            'nama_penghuni' => $request->nama_penghuni,
            'kamar_id' => $request->kamar_id,
            'no_wa' => $request->no_wa,
        'gender' => $request->gender,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_hunian' => $request->status_hunian,
            'nama_kontak_darurat' => $request->nama_kontak_darurat,
            'no_kontak_darurat' => $request->no_kontak_darurat,
        ]);

        // update status kamar
        $kamar->update([
            'status_kamar' => 'terisi'
        ]);

        return redirect()->route('penghuni.index')
            ->with('success', 'Penghuni berhasil ditambahkan');
    }

    public function edit($id)
    {
        // dd($kamars);
        $penghuni = Penghuni::findOrFail($id);

        // tampilkan semua kamar + kamar yang sedang dipakai penghuni ini
        $kamars = Kamar::where('status_kamar', 'kosong')
            ->orWhere('id', $penghuni->kamar_id)
            ->get();

        return view('penghuni.edit', compact('penghuni', 'kamars'));
    }

    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $request->validate([
            'nama_penghuni' => 'required|string|max:255',
            'kamar_id' => 'required|exists:kamars,id',
            'no_wa' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'tanggal_masuk' => 'required|date',
            'status_hunian' => 'required|in:aktif,nonaktif',
        ]);

        $kamarLama = $penghuni->kamar_id;
        $kamarBaru = $request->kamar_id;

        // kalau pindah kamar
        if ($kamarLama != $kamarBaru) {

            $kamar = Kamar::findOrFail($kamarBaru);

            if ($kamar->status_kamar !== 'kosong') {
                return back()->withErrors(['kamar_id' => 'Kamar sudah terisi'])->withInput();
            }

            // kosongkan kamar lama
            Kamar::where('id', $kamarLama)
                ->update(['status_kamar' => 'kosong']);

            // isi kamar baru
            $kamar->update(['status_kamar' => 'terisi']);
        }

        $penghuni->update([
            'nama_penghuni' => $request->nama_penghuni,
            'kamar_id' => $kamarBaru,
            'no_wa' => $request->no_wa,
            'gender' => $request->gender,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_hunian' => $request->status_hunian,
            'nama_kontak_darurat' => $request->nama_kontak_darurat,
            'no_kontak_darurat' => $request->no_kontak_darurat,
        ]);

        return redirect()->route('penghuni.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function show($id)
{
    $penghuni = Penghuni::with('kamar')->findOrFail($id);

    return view('penghuni.show', compact('penghuni'));
}

    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        // kosongkan kamar
        Kamar::where('id', $penghuni->kamar_id)
            ->update(['status_kamar' => 'kosong']);

        $penghuni->delete();

        return redirect()->route('penghuni.index')
            ->with('success', 'Data berhasil dihapus');
    }
}