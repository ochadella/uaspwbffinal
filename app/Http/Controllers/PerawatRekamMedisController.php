<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;       // ⭐ Tambahan
use App\Models\JadwalPerawat;             // ⭐ Tambahan
use Carbon\Carbon;                        // ⭐ Tambahan

class PerawatRekamMedisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'idtemu_dokter' => 'required|numeric',
            'anamnesa_awal' => 'required|string',
            'suhu'          => 'required|string',
            'nadi'          => 'required|string',
            'berat_badan'   => 'required|string',
            'perilaku_hewan'=> 'required|string',
        ]);

        $id = $request->idtemu_dokter;

        // ============================================================
        // 🔥 AMBIL DATA WAJIB DARI TEMU DOKTER (idpet & dokter_id & tanggal)
        // ============================================================
        $td = DB::table('temu_dokter')
            ->where('idtemu_dokter', $id)
            ->select('idpet', 'dokter_id', 'tanggal_temu')
            ->first();

        if (!$td) {
            return redirect()->back()->with('error', 'Data temu dokter tidak ditemukan!');
        }

        // ============================================================
        // ⭐⭐ CEK APAKAH PERAWAT SEDANG JAGA ⭐⭐
        // ============================================================

        $perawat = Auth::user();  
        $tanggalKunjungan = $td->tanggal_temu;

        // Ambil hari kunjungan (Senin, Selasa, Rabu…)
        $hariKunjungan = Carbon::parse($tanggalKunjungan)->isoFormat('dddd');

        // ============================================================
        // 🔥 FIX UTAMA: jadwal perawat mencatat hari pada kolom `tanggal`
        // ============================================================
        $sedangJaga = JadwalPerawat::where('iduser_perawat', $perawat->iduser ?? $perawat->id)
                    ->where('tanggal', $hariKunjungan)
                    ->exists();

        if (!$sedangJaga) {
            return redirect()->back()->with('error', 'Anda tidak sedang jaga pada tanggal kunjungan ini. Rekam medis tidak dapat ditulis.');
        }

        // ============================================================
        // 1️⃣ SIMPAN / UPDATE REKAM MEDIS AWAL OLEH PERAWAT
        // ============================================================
        DB::table('rekam_medis')->updateOrInsert(
            ['idtemu_dokter' => $id],
            [
                'anamnesa_awal' => $request->anamnesa_awal,
                'suhu'          => $request->suhu,
                'nadi'          => $request->nadi,
                'berat_badan'   => $request->berat_badan,
                'perilaku_hewan'=> $request->perilaku_hewan,
                
                // 🔥 WAJIB DIISI AGAR INSERT TIDAK ERROR (NOT NULL + FK)
                'idpet'             => $td->idpet,
                'dokter_pemeriksa'  => $td->dokter_id,

                // updated_at sudah benar
                'updated_at'    => now(),
            ]
        );

        // ============================================================
        // 2️⃣ UBAH STATUS DI TEMU DOKTER → Sedang Diperiksa
        // ============================================================
        DB::table('temu_dokter')
            ->where('idtemu_dokter', $id)
            ->update([
                'status' => 'Sedang Diperiksa'
            ]);

        // otomatis resepsionis & dokter melihat status baru
        return redirect()->back()->with('success', 'Rekam medis berhasil disimpan!');
    }
}
