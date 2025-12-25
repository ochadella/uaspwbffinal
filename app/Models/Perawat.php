<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'idperawat';
    public $timestamps = false;

    protected $fillable = [
        'idperawat',
        'username',
        'nama_perawat',
        'alamat',
        'nohp',
        'status'
    ];
}
