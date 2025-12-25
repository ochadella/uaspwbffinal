<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemilikTemuDokterController extends Controller
{
    // ============================
    //  METHOD INDEX (DITAMBAHKAN)
    // ============================
    public function index()
    {
        $user = Auth::user();

        // ambil id pemilik dari user login
        $idPemilik = $user->idpemilik;

        // daftar hewan milik pemilik
        $hewan = DB::table('pet')
            ->where('idpemilik', $idPemilik)
            ->get();

        // daftar temu dokter milik pemilik
        $temu = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('user as dokter', 'temu_dokter.dokter_id', '=', 'dokter.iduser')
            ->where('pet.idpemilik', $idPemilik)
            ->whereIn('temu_dokter.status', ['Menunggu', 'Sedang Diperiksa']) // 🔥 FILTER STATUS NON-SELESAI
            ->orderBy('temu_dokter.tanggal_temu', 'desc')
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'dokter.nama as nama_dokter'
            )
            ->get();

        // VIEW SESUAI FOLDER YANG KAMU PUNYA!!!
        return view('pemilik.temu_dokter.temudokter', compact('hewan', 'temu'));
    }

    // ====================================
    //  METHOD DETAIL (ASLI PUNYA KAMU)
    // ====================================
    public function detail($id)
    {
        $user = Auth::user();

        // ambil id pemilik dari user login
        $idPemilik = $user->idpemilik;

        // ambil data temu dokter + join pet + dokter
        $detail = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('user as dokter', 'temu_dokter.dokter_id', '=', 'dokter.iduser')
            ->where('temu_dokter.idtemu_dokter', $id)
            ->where('pet.idpemilik', $idPemilik) // keamanan: hanya pemilik yg punya akses
            ->select(
                'temu_dokter.*',
                'pet.nama as nama_hewan',
                'dokter.nama as nama_dokter'
            )
            ->first();

        if (!$detail) {
            return redirect()->route('dashboard.pemilik')
                ->with('error', 'Data temu dokter tidak ditemukan');
        }

        // FIX PENTING!!!
        // Pastikan view sesuai folder:
        // resources/views/pemilik/temu_dokter/temudokter_detail.blade.php
        return view('pemilik.temu_dokter.temudokter_detail', compact('detail'));
    }
}
