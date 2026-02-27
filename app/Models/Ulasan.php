<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $primaryKey = 'id_ulasan';

    protected $fillable = [
        'id_penghuni',
        'isi_ulasan',
        'nilai_rating',
        'tanggal_ulasan'
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni');
    }
}