<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id';

    public $timestamps = false; // ⬅ WAJIB supaya tidak error

    protected $fillable = [
        'iduser_dokter',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruang'
    ];

    public function dokter()
    {
        return $this->belongsTo(User::class, 'iduser_dokter', 'iduser');
    }
}
