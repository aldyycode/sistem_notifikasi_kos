<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'luas_kamar',
        'harga_sewa',
        'lantai',
        'fasilitas',
        'status_kamar'
    ];
}