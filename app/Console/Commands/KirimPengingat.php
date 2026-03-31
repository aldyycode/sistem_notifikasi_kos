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
    protected $description = 'Mengirim pengingat pembayaran';

    public function handle()
    {
        $this->info("Command kirim pengingat dijalankan");

        $hariIni = Carbon::now();

        $pembayarans = Pembayaran::with('penghuni')
            ->where('status_bayar', 'belum_lunas')
            ->get();

        $this->info("Jumlah pembayaran ditemukan: ".$pembayarans->count());

        $wa = new WhatsAppService();

        foreach ($pembayarans as $pembayaran) {

            $jatuhTempo = Carbon::parse($pembayaran->jatuh_tempo);

            $selisih = $hariIni->diffInDays($jatuhTempo, false);

            $this->info("Pembayaran ID {$pembayaran->id_pembayaran} selisih hari: {$selisih}");

            $jenisReminder = null;

            if ($selisih == 7) {
                $jenisReminder = 'H-7';
            } 
            elseif ($selisih == 3) {
                $jenisReminder = 'H-3';
            } 
            elseif ($selisih == 1) {
                $jenisReminder = 'H-1';
            } 
            elseif ($selisih < 0) {
                $jenisReminder = 'Overdue';
            }

            if (!$jenisReminder) {
                continue;
            }

            $sudahDikirim = Notifikasi::where('id_pembayaran',$pembayaran->id_pembayaran)
                ->where('jenis_reminder',$jenisReminder)
                ->exists();

            if ($sudahDikirim) {
                continue;
            }

            $nama = $pembayaran->penghuni->nama_penghuni ?? 'Penghuni';

            $nomor = $pembayaran->penghuni->no_wa;

            // ubah 08 menjadi 628
            if(substr($nomor,0,1) == "0"){
                $nomor = "62".substr($nomor,1);
            }

            $linkUpload = url('/pembayaran/'.$pembayaran->id_pembayaran.'/upload');

            $pesan = "Halo {$nama},\n\n"
                   . "Pembayaran kos sebesar Rp {$pembayaran->jumlah_bayar}\n"
                   . "akan jatuh tempo pada {$jatuhTempo->format('d M Y')}.\n"
                   . "Reminder: {$jenisReminder}.\n\n"
                   . "Silakan upload bukti pembayaran di sini:\n"
                   . $linkUpload;

            $response = $wa->send($nomor,$pesan);

            $this->info("Response WA:");
            $this->info(json_encode($response));

            $status = (isset($response['status']) && $response['status'] == true)
                    ? 'terkirim'
                    : 'gagal';

            Notifikasi::create([
                'id_pembayaran'=>$pembayaran->id_pembayaran,
                'isi_pesan'=>$pesan,
                'tanggal_kirim'=>now(),
                'status_kirim'=>$status,
                'jenis_reminder'=>$jenisReminder
            ]);

            $this->info("Reminder {$jenisReminder} dikirim ke {$nama}");
        }

        $this->info("Proses selesai.");
    }
}