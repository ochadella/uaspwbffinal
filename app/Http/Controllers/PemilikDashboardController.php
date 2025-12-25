<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ======================================
        // PROTEKSI: HANYA PEMILIK YANG BOLEH AKSES
        // ======================================
        if (!$user || $user->role !== 'Pemilik') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Pemilik.');
        }

        // ======================================
        // FIX UTAMA — Ambil ID Pemilik yang benar
        // ======================================
        $idPemilik = $user->idpemilik ?? null;

        if (!$idPemilik) {
            abort(500, 'ID Pemilik tidak ditemukan pada akun Anda.');
        }

        // ======================================
        // TOTAL HEWAN MILIK PEMILIK
        // ======================================
        $total_hewan = DB::table('pet')
            ->where('idpemilik', $idPemilik)
            ->count();

        // ======================================
        // AMBIL SEMUA ID PET MILIK PEMILIK
        // ======================================
        $petIds = DB::table('pet')
            ->where('idpemilik', $idPemilik)
            ->pluck('idpet');

        // ======================================
        // TOTAL RIWAYAT KUNJUNGAN = REKAM MEDIS
        // ======================================
        $total_kunjungan = DB::table('rekam_medis')
            ->whereIn('idpet', $petIds)
            ->count();

        $rekam_medis = $total_kunjungan;

        // ======================================
        // 🔥 TOTAL JADWAL TEMU DOKTER (HANYA STATUS AKTIF)
        // ======================================
        $total_temu_dokter = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('pet.idpemilik', $idPemilik)
            ->whereIn('temu_dokter.status', [
                'menunggu', 'menunggu antrian', 'sedang diperiksa'
            ]) // hanya yang belum selesai
            ->count();

        // ======================================
        // 🔥 Ambil 5 Jadwal Terbaru YANG BELUM SELESAI
        // ======================================
        $jadwal = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('user', 'temu_dokter.dokter_id', '=', 'user.iduser')
            ->where('pet.idpemilik', $idPemilik)
            ->whereIn('temu_dokter.status', [
                'menunggu', 'menunggu antrian', 'sedang diperiksa'
            ]) // agar selesai tidak muncul
            ->orderBy('temu_dokter.tanggal_temu', 'desc')
            ->select(
                'temu_dokter.idtemu_dokter',
                'pet.nama as nama_hewan',
                'temu_dokter.tanggal_temu as tanggal',
                'temu_dokter.waktu_temu as jam',
                'user.nama as dokter',
                'temu_dokter.status as status'
            )
            ->limit(5)
            ->get();

        // ======================================
        // INISIAL NAMA PEMILIK
        // ======================================
        $initial = strtoupper(substr($user->nama, 0, 1));

        // ======================================
        // RETURN KE VIEW
        // ======================================
        return view('interface.dashboard_pemilik', [
            'user' => $user,
            'total_hewan' => $total_hewan,
            'total_kunjungan' => $total_kunjungan,
            'rekam_medis' => $rekam_medis,

            'total_temu_dokter' => $total_temu_dokter,
            'jadwal' => $jadwal,
            'initial' => $initial,
        ]);
    }
}
