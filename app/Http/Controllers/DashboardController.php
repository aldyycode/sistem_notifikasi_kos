<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Notifikasi;
use Carbon\Carbon;
use App\Models\Ulasan;

class DashboardController extends Controller
{
public function index()
{
    $totalBelumLunas = Pembayaran::where('status_bayar','belum_lunas')->count();
    $totalLunas = Pembayaran::where('status_bayar','lunas')->count();

    $notifikasiTerkirim = Notifikasi::where('status_kirim','terkirim')->count();
    $notifikasiGagal = Notifikasi::where('status_kirim','gagal')->count();

    $reminderStats = Notifikasi::selectRaw('jenis_reminder, COUNT(*) as total')
        ->groupBy('jenis_reminder')
        ->pluck('total','jenis_reminder')
        ->toArray(); // PENTING

    $chartData = [
        'pembayaran' => [
            'belum_lunas' => $totalBelumLunas,
            'lunas' => $totalLunas
        ],
        'notifikasi' => [
            'terkirim' => $notifikasiTerkirim,
            'gagal' => $notifikasiGagal
        ],
        'reminder' => $reminderStats
    ];

    $ulasans = Ulasan::with('penghuni')->latest()->take(5)->get();

$ratingStats = Ulasan::selectRaw('nilai_rating, COUNT(*) as total')
    ->groupBy('nilai_rating')
    ->pluck('total','nilai_rating')
    ->toArray();

$chartData['rating'] = $ratingStats;

    return view('dashboard', compact(
    'chartData',
    'totalBelumLunas',
    'totalLunas',
    'notifikasiTerkirim',
    'notifikasiGagal',
    'ulasans',
'chartData'
));
}
}