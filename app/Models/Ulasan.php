<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
    'id_pembayaran',
    'id_penghuni',
    'nilai_rating',
    'isi_ulasan'
];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni');
    }
}