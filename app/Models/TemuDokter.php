<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    // Nama tabel SESUAI DATABASE
    protected $table = 'temu_dokter';

    // Primary key SESUAI DATABASE
    protected $primaryKey = 'idtemu_dokter';

    // created_at otomatis ada → tidak perlu timestamps manual
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'idpet',
        'idpemilik',
        'idrole_user',
        'tanggal_temu',
        'waktu_temu',
        'keluhan',
        'status',
    ];

    /* ===========================================================
       RELASI: setiap antrian punya PET
    ============================================================ */
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    /* ===========================================================
       RELASI: setiap antrian punya PEMILIK
    ============================================================ */
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    /* ===========================================================
       RELASI: setiap antrian punya DOKTER (idrole_user)
    ============================================================ */
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
