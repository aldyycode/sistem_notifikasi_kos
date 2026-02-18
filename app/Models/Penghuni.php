<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = [
    'id_pengelola',
    'nama_penghuni',
    'nomor_kamar',
    'no_wa',
    'status_hunian'
];
}


