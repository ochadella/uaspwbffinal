<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPerawat; // ⭐ Tambahan: untuk cek jadwal perawat
use Carbon\Carbon;           // ⭐ Tambahan: untuk ambil hari dari tanggal

class PerawatPasienController extends Controller
{
    // ============================================================
    // ⭐ FUNGSI TAMBAHAN — TIDAK MENGGANGGU KODE ASLI
    // ============================================================
    private function cekPerawatSedangJaga($perawat, $tanggalKunjungan)
    {
        // ubah tanggal jadi Carbon
        $waktu = Carbon::parse($tanggalKunjungan);

        // dapatkan nama hari: Senin, Selasa, Rabu, ...
        $hari = $waktu->isoFormat('dddd');

        // ============================================================
        // 🔥 FIX UTAMA: kolom di database adalah 'tanggal', bukan 'hari'
        // ============================================================
        return JadwalPerawat::where('iduser_perawat', $perawat->iduser ?? $perawat->id)
                ->where('tanggal', $hari)
                ->exists();
    }

    // ============================================================
    // ⭐ FUNGSI INDEX (ASLI KAMU UTUH, HANYA DITAMBAHI SETELAH QUERY)
    // ============================================================
    public function index()
    {
        // ============================
        //  PERBAIKAN: AMBIL UMUR DARI PET (p.umur)
        //  + JOIN DOKTER AGAR TERISI DI MODAL
        //  + JOIN REKAM_MEDIS AGAR DATA PERAWAT MUNCUL
        // ============================

        $pasien = DB::table('temu_dokter as td')
            ->select(
                'td.idtemu_dokter',
                'p.nama as nama_hewan',
                'rh.nama_ras as jenis',
                'p.umur',  // umur dari tabel pet
                'pm.nama as nama_pemilik',
                'td.tanggal_temu as tanggal_kunjungan',
                'td.status',

                // ======================
                //  🔥 PENAMBAHAN PENTING
                //  Ambil nama dokter dari tabel user
                // ======================
                'u.nama as nama_dokter',

                // ======================
                //  🔥 DATA REKAM MEDIS PERAWAT
                //  Supaya saat modal dibuka lagi,
                //  field terisi dari tabel rekam_medis
                // ======================
                'rm.anamnesa_awal',
                'rm.suhu',
                'rm.nadi',
                'rm.berat_badan',
                'rm.perilaku_hewan'
            )
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')

            // ======================
            //  🔥 JOIN DOKTER
            // ======================
            ->leftJoin('user as u', 'td.dokter_id', '=', 'u.iduser')

            // ======================
            //  🔥 JOIN REKAM MEDIS (DIISI PERAWAT)
            // ======================
            ->leftJoin('rekam_medis as rm', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')

            // ======================
            //  🔥 ORDER BY DIBENERIN !!!
            //      ASC = tanggal lama dulu
            //      DESC = tanggal baru dulu
            // kamu MAU tanggal lama jadi No 1 → jadi ASC
            // ======================
            ->orderBy('td.tanggal_temu', 'ASC')
            ->get();

        // =====================
        // USER LOGIN DISPLAY
        // =====================
        $user        = Auth::user();
        $displayName = $user->nama ?? 'User';
        $displayRole = ucfirst(strtolower($user->role ?? 'Perawat'));
        $initial     = strtoupper(substr($displayName, 0, 1));

        // ============================================================
        // ⭐ PENAMBAHAN: CEK APA PERAWAT BOLEH MENULIS REKAM MEDIS
        // ============================================================
        foreach ($pasien as $p) {
            // true jika perawat sedang jaga sesuai hari pasien berkunjung
            $p->boleh_tulis = $this->cekPerawatSedangJaga($user, $p->tanggal_kunjungan);
        }

        return view('perawat.pasien.data_pasien', compact(
            'pasien',
            'displayName',
            'displayRole',
            'initial'
        ));
    }
}
