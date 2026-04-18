<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengelola extends Authenticatable
{
    protected $table = 'pengelolas';
    protected $primaryKey = 'id_pengelola';

    protected $fillable = [
    'nama_pengelola',
    'username',
    'password',
    'no_wa',
];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}