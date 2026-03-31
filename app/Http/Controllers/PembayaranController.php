<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use App\Models\Notifikasi;
use App\Services\WhatsAppService;

class PembayaranController extends Controller
{

    public function index()
    {
          $pembayarans = Pembayaran::with(['penghuni','notifikasi'])->get();

    return view('pembayaran.index', compact('pembayarans'));
    }


    public function create()
    {
        $penghunis = Penghuni::all();

        return view('pembayaran.create', compact('penghunis'));
    }


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


    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('penghuni')
                    ->where('id_pembayaran',$id)
                    ->firstOrFail();

        if ($pembayaran->status_bayar == 'lunas') {
            return back()->with('info', 'Pembayaran sudah lunas sebelumnya.');
        }

        $pembayaran->update([
            'status_bayar' => 'lunas',
            'tanggal_bayar' => now()
        ]);

        $wa = new WhatsAppService();

        
        $linkReview = route('ulasan.create', $pembayaran->id_pembayaran);

        $nama = $pembayaran->penghuni->nama_penghuni ?? 'Penghuni';

        $nomor = $pembayaran->penghuni->no_wa ?? '';

        if (substr($nomor,0,1) == "0") {
            $nomor = "62".substr($nomor,1);
        }

        $pesan = "Halo {$nama},\n\n"
               . "Terima kasih atas pembayaran kos Anda.\n"
               . "Kami sangat menghargai feedback Anda.\n\n"
               . "Silakan beri ulasan melalui link berikut:\n"
               . $linkReview;

        $response = $wa->send($nomor, $pesan);

        $status = (isset($response['status']) && $response['status'] == true)
                ? 'terkirim'
                : 'gagal';

        Notifikasi::create([
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'isi_pesan' => $pesan,
            'tanggal_kirim' => now(),
            'status_kirim' => $status,
            'jenis_reminder' => 'Review'
        ]);

    return back()->with('success', 'Pembayaran berhasil dilunasi & link review dikirim.');
}

public function kirimWa($id)
{
    $pembayaran = Pembayaran::with('penghuni')
                ->where('id_pembayaran', $id)
                ->firstOrFail();

    $wa = new WhatsAppService();

    $nama  = $pembayaran->penghuni->nama_penghuni ?? 'Penghuni';
    $nomor = $pembayaran->penghuni->no_wa ?? '';

    // Format nomor ke 62
    if (substr($nomor, 0, 1) == "0") {
        $nomor = "62" . substr($nomor, 1);
    }

    $pesan = "Halo {$nama},\n\n"
           . "Tagihan kos Anda:\n"
           . "Jumlah: Rp " . number_format($pembayaran->jumlah_bayar, 0, ',', '.') . "\n"
           . "Jatuh Tempo: " . $pembayaran->jatuh_tempo . "\n\n"
           . "Silakan lakukan pembayaran.\n\n";

    $response = $wa->send($nomor, $pesan);

    $status = (isset($response['status']) && $response['status'] == true)
                ? 'terkirim'
                : 'gagal';

    // Simpan notifikasi
    Notifikasi::create([
        'id_pembayaran' => $pembayaran->id_pembayaran,
        'isi_pesan' => $pesan,
        'tanggal_kirim' => now(),
        'status_kirim' => $status,
        'jenis_reminder' => 'Tagihan'
    ]);

    return back()->with('success', 'Tagihan + link ulasan berhasil dikirim');
}
}