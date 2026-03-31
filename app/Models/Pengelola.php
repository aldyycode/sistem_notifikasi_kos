<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengelola extends Authenticatable
{
    protected $primaryKey = 'id_pengelola';

    protected $fillable = [
    'nama_pengelola',
    'username',
    'password',
];

    protected $hidden = [
        'password',
    ];
}