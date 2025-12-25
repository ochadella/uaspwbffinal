<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPerawat extends Model
{
    protected $table = 'jadwal_perawat';
    protected $primaryKey = 'id';

    public $timestamps = false; // ⬅ WAJIB supaya tidak error

    protected $fillable = [
        'iduser_perawat',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruang'
    ];

    public function perawat()
    {
        return $this->belongsTo(User::class, 'iduser_perawat', 'iduser');
    }
}
