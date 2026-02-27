<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar Artisan Command milik aplikasi
     * (biasanya kosong karena Laravel auto-load dari folder Commands)
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        // App\Console\Commands\KirimPengingat::class, // optional
    ];

    /**
     * MENDAFTARKAN JADWAL OTOMATIS
     * Inilah bagian paling penting.
     */
    protected function schedule(Schedule $schedule)
    {
        // Menjalankan command kirim:pengingat setiap hari jam 08:00
        $schedule->command('kirim:pengingat')
                 ->dailyAt('08:00');

        // (Opsional) bisa ditambah:
        // ->withoutOverlapping(); // mencegah double run
        // ->runInBackground();    // jalankan di background
    }

    /**
     * Mendaftarkan command yang ada di folder Commands
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}