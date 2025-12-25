<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemilikRekamMedisController extends Controller
{
    /**
     * Halaman daftar rekam medis milik pemilik
     */
    public function index()
    {
        $user = Auth::user();
        $idPemilik = $user->idpemilik;

        $rekamMedis = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idtemu_dokter', '=', 'temu_dokter.idtemu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->join('user as dokter', 'rekam_medis.dokter_pemeriksa', '=', 'dokter.iduser')
            ->where('pet.idpemilik', $idPemilik)
            ->select(
                'rekam_medis.*',
                'temu_dokter.tanggal_temu',
                'temu_dokter.waktu_temu',
                'temu_dokter.keluhan',
                'pet.nama as nama_hewan',
                'pet.jenis_kelamin',
                'pet.umur',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan as nama_jenis_hewan',
                'dokter.nama as nama_dokter'
            )
            ->orderBy('temu_dokter.tanggal_temu', 'desc')
            ->get();

        return view('pemilik.rekammedis.rekammedis', compact('rekamMedis'));
    }


    /**
     * Detail rekam medis
     */
    public function detail($id)
    {
        $user = Auth::user();
        $idPemilik = $user->idpemilik;

        $detail = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idtemu_dokter', '=', 'temu_dokter.idtemu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as dokter', 'rekam_medis.dokter_pemeriksa', '=', 'dokter.iduser')
            ->where('rekam_medis.idtemu_dokter', $id)
            ->where('pet.idpemilik', $idPemilik)
            ->select(
                'rekam_medis.*',
                'temu_dokter.tanggal_temu',
                'temu_dokter.waktu_temu',
                'temu_dokter.keluhan',
                'pet.nama as nama_hewan',
                'pet.jenis_kelamin',
                'pet.umur',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan as nama_jenis_hewan',
                'pemilik.nama as nama_pemilik',
                'pemilik.no_wa',
                'pemilik.alamat',
                'dokter.nama as nama_dokter'
            )
            ->first();

        return view('pemilik.rekammedis.detailrekammedis', compact('detail'));
    }
}
