<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalJaga extends Model
{
    protected $table = 'jadwal_jaga';
    protected $primaryKey = 'idjadwal';
    public $timestamps = false;

    protected $fillable = [
        'idjadwal',
        'id_perawat',
        'tanggal',
        'shift',
        'jam_mulai',
        'jam_selesai',
        'keterangan'
    ];
}
