<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghunis';
    protected $primaryKey = 'id_penghuni';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pengelola',
        'nama_penghuni',
        'nomor_kamar',
        'no_wa',
        'status_hunian'
    ];

    public function ulasan()
{
    return $this->hasMany(Ulasan::class, 'id_penghuni');
}

}

