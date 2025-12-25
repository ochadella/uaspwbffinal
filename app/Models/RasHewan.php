<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    use HasFactory;

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;

    protected $fillable = [
        'nama_ras',
        'idjenis_hewan'
    ];

    // 🔥 RELASI WAJIB ADA (INILAH YANG KAMU BUTUHKAN)
    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
