<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PemilikKunjunganController extends Controller
{
    public function index()
    {
        // 🔥 Pemilik memakai idpemilik (bukan iduser)
        $idpemilik = auth()->user()->idpemilik;

        $kunjungan = DB::table('temu_dokter')
            ->join('pet', 'pet.idpet', '=', 'temu_dokter.idpet')

            // 🔥 JOIN ras_hewan sesuai kolom yang ada
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')

            // 🔥 JOIN jenis_hewan lewat ras_hewan
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')

            // 🔥 JOIN dokter
            ->join('user as dokter', 'dokter.iduser', '=', 'temu_dokter.dokter_id')

            ->where('pet.idpemilik', $idpemilik)
            ->where('temu_dokter.status', 'Selesai')
            ->orderBy('temu_dokter.tanggal_temu', 'desc')

            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'jenis_hewan.nama_jenis_hewan',
                'ras_hewan.nama_ras',
                'dokter.nama as nama_dokter'
            )
            ->get();

        return view('pemilik.kunjungan.riwayatkunjungan', compact('kunjungan'));
    }
}
