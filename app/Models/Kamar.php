<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamars';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'luas_kamar',
        'harga_sewa',
        'lantai',
        'fasilitas',
        'status_kamar'
    ];
       public function penghunis()
    {
        return $this->hasMany(Penghuni::class, 'kamar_id');
    }
}