<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet'; 
    protected $primaryKey = 'idpet';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idpet',
        'idpemilik',
        'nama',
        'tanggal_lahir',
        'warna_bulu',
        'jenis_kelamin',
        'idras_hewan'
    ];

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // 🔥 RELASI YANG WAJIB ADA UNTUK AUTO-FILL PEMILIK
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
}
