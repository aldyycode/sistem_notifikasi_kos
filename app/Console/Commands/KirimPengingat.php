<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pembayaran;
use App\Models\Notifikasi;
use Carbon\Carbon;
use App\Services\WhatsAppService;

class KirimPengingat extends Command
{
    protected $signature = 'kirim:pengingat';
    protected $description = 'Mengirim pengingat pembayaran H-3';

 public function handle()
{
    $hariIni = Carbon::now()->toDateString();

    $pembayarans = Pembayaran::with('penghuni')
        ->where('status_bayar', 'belum_lunas')
        ->get();

    $wa = new WhatsAppService();

    foreach ($pembayarans as $pembayaran) {

        $jatuhTempo = $pembayaran->jatuh_tempo;
        $selisih = Carbon::parse($hariIni)->diffInDays($jatuhTempo, false);

        $jenisReminder = null;

        if ($selisih == 7) {
            $jenisReminder = 'H-7';
        } elseif ($selisih == 3) {
            $jenisReminder = 'H-3';
        } elseif ($selisih == 1) {
            $jenisReminder = 'H-1';
        } elseif ($selisih < 0) {
            $jenisReminder = 'Overdue';
        }

        if (!$jenisReminder) {
            continue;
        }

        // Cek apakah sudah pernah dikirim
        $sudahDikirim = Notifikasi::where('id_pembayaran', $pembayaran->id_pembayaran)
            ->where('jenis_reminder', $jenisReminder)
            ->exists();

        if ($sudahDikirim) {
            continue;
        }

        $pesan = "Halo {$pembayaran->penghuni->nama_penghuni}, "
               . "Pembayaran kos sebesar Rp {$pembayaran->jumlah_bayar} "
               . "akan jatuh tempo pada {$jatuhTempo}. "
               . "Reminder: {$jenisReminder}.";

        $response = $wa->send($pembayaran->penghuni->no_wa, $pesan);

        $status = (isset($response['status']) && $response['status'] == true)
                  ? 'terkirim'
                  : 'gagal';

        Notifikasi::create([
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'isi_pesan' => $pesan,
            'tanggal_kirim' => now(),
            'status_kirim' => $status,
            'jenis_reminder' => $jenisReminder
        ]);

        $this->info("Reminder {$jenisReminder} dikirim ke {$pembayaran->penghuni->nama_penghuni}");
    }

    $this->info("Proses selesai.");
}}