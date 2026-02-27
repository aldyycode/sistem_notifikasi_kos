<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
    'id_penghuni',
    'jumlah_bayar',
    'jatuh_tempo',
    'tanggal_bayar',
    'status_bayar',
    'jenis_reminder'
];

public function penghuni()
{
    return $this->belongsTo(\App\Models\Penghuni::class, 'id_penghuni');
}

}

