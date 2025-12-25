<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'idtemu_dokter',
        'anamnesa',
        'diagnosa',
        'temuan_klinis',
        'dokter_pemeriksa'
    ];
}
