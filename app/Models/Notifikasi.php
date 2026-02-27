<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_pembayaran',
        'isi_pesan',
        'tanggal_kirim',
        'status_kirim'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}