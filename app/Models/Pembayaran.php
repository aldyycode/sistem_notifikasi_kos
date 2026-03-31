<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $primaryKey = 'id_pembayaran';

    public $timestamps = false;

    protected $guarded = [];

    protected $fillable = [
        'id_penghuni',
        'jumlah_bayar',
        'jatuh_tempo',
        'status_bayar',
        'bukti_transfer',
        'tanggal_bayar'
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class,'id_penghuni');
    }

    public function notifikasi()
{
    return $this->hasMany(Notifikasi::class, 'id_pembayaran');
}
}