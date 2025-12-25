<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\DB;

class DokterRekamMedisController extends Controller
{
    // ============================================================
    // INDEX: LIST DATA REKAM MEDIS DENGAN JOIN LENGKAP 🔥
    // ============================================================
    public function index(Request $request)
    {
        $rekamMedis = DB::table('rekam_medis AS rm')
            ->join('temu_dokter AS td', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->join('pet AS p', 'rm.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')

            // 🔥 FIX BENAR → tabel user + kolom iduser
            ->leftJoin('user AS du', 'rm.dokter_pemeriksa', '=', 'du.iduser')

            // 🔥 JOIN KATEGORI
            ->leftJoin('kategori_klinis AS kk', 'rm.kategori_klinis', '=', 'kk.idkategori_klinis')
            ->leftJoin('kode_tindakan AS kt', 'rm.kategori_tindakan', '=', 'kt.id')

            ->select(
                'rm.*',
                'td.idtemu_dokter AS idreservasi',
                'td.tanggal_temu',
                'td.waktu_temu',
                'td.keluhan',
                'td.status',

                // PET (🔥 umur disesuaikan ke usia)
                'p.nama AS nama_hewan',
                'p.jenis_kelamin',
                'p.umur AS usia',

                'rh.nama_ras',
                'jh.nama_jenis_hewan',

                // PEMILIK
                'pm.nama AS nama_pemilik',
                'pm.no_wa',
                'pm.alamat AS alamat_pemilik', // ⭐ DITAMBAHKAN

                // KATEGORI
                'kk.nama_kategori_klinis',
                'kt.nama_tindakan',

                // 🔥 NAMA DOKTER PEMERIKSA
                'du.nama AS nama_dokter'
            )

            /* =====================================================
               🔥 FIX URUTAN SESUAI PERMINTAAN
               BUKAN LAGI BERDASARKAN ID, TAPI TANGGAL & WAKTU
               ===================================================== */
            ->orderBy('td.tanggal_temu', 'ASC')
            ->orderBy('td.waktu_temu', 'ASC')

            ->get();

        return view('dokter.rekammedis.datarekammedis', compact('rekamMedis'));
    }

    // ============================================================
    // DETAIL: HALAMAN DETAIL REKAM MEDIS (FIX ERROR + FIX KATEGORI) 🔥
    // ============================================================
    public function detail($id)
    {
        $rekamMedis = DB::table('rekam_medis AS rm')
            ->join('temu_dokter AS td', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->join('pet AS p', 'rm.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')

            // 🔥 FIX BENAR → tabel user + kolom iduser
            ->leftJoin('user AS du', 'rm.dokter_pemeriksa', '=', 'du.iduser')

            // 🔥 JOIN KATEGORI
            ->leftJoin('kategori_klinis AS kk', 'rm.kategori_klinis', '=', 'kk.idkategori_klinis')
            ->leftJoin('kode_tindakan AS kt', 'rm.kategori_tindakan', '=', 'kt.id')

            ->select(
                'rm.*',
                'td.idtemu_dokter AS idreservasi',
                'td.tanggal_temu',
                'td.waktu_temu',
                'td.keluhan',
                'td.status AS status_reservasi',

                // PET
                'p.nama AS nama_hewan',
                'p.jenis_kelamin',
                'p.umur AS usia',

                'rh.nama_ras',
                'jh.nama_jenis_hewan',

                // PEMILIK
                'pm.nama AS nama_pemilik',
                'pm.no_wa',
                'pm.alamat AS alamat_pemilik', // ⭐ DITAMBAHKAN

                // KATEGORI
                'kk.nama_kategori_klinis',
                'kt.nama_tindakan',

                // 🔥 Nama dokter
                'du.nama AS nama_dokter'
            )
            ->where('rm.idtemu_dokter', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()
                ->route('dokter.rekammedis.index')
                ->with('error', 'Detail rekam medis tidak ditemukan.');
        }

        return view('dokter.rekammedis.detailrekammedis', compact('rekamMedis'));
    }

    // ============================================================
    // SIMPAN PEMERIKSAAN DOKTER (TIDAK DIRUBAH)
    // ============================================================
    public function store(Request $request)
    {
        $request->validate([
            'idtemu_dokter'    => 'required|numeric',
            'diagnosa'         => 'required|string',
            'anamnesa'         => 'nullable|string',
            'tindakan'         => 'nullable|string',
            'resep'            => 'nullable|string',
            'kategori_klinis'  => 'nullable|string',
            'kategori_tindakan'=> 'nullable|string',
            'ubah_status_ke'   => 'nullable|string',
        ]);

        $idTemu = $request->idtemu_dokter;

        $td = DB::table('temu_dokter')
            ->where('idtemu_dokter', $idTemu)
            ->select('idpet', 'dokter_id')
            ->first();

        if (!$td) {
            return redirect()->back()->with('error', 'Data temu dokter tidak ditemukan.');
        }

        $bagian = [];

        if ($request->tindakan) {
            $bagian[] = "Tindakan Medis:\n" . $request->tindakan;
        }

        if ($request->resep) {
            $bagian[] = "Resep / Terapi:\n" . $request->resep;
        }

        if ($request->kategori_klinis) {
            $bagian[] = "Kategori Klinis: " . $request->kategori_klinis;
        }

        if ($request->kategori_tindakan) {
            $bagian[] = "Kategori Tindakan: " . $request->kategori_tindakan;
        }

        $temuanKlinis = trim(implode("\n\n", $bagian));
        if ($temuanKlinis === '') {
            $temuanKlinis = null;
        }

        DB::table('rekam_medis')->updateOrInsert(
            ['idtemu_dokter' => $idTemu],
            [
                'anamnesa'        => $request->anamnesa,
                'diagnosa'        => $request->diagnosa,
                'temuan_klinis'   => $temuanKlinis,

                'resep'            => $request->resep,
                'kategori_klinis'  => $request->kategori_klinis,
                'kategori_tindakan'=> $request->kategori_tindakan,

                'idpet'           => $td->idpet,
                'dokter_pemeriksa'=> $td->dokter_id,

                'updated_at'      => now(),
            ]
        );

        DB::table('temu_dokter')
            ->where('idtemu_dokter', $idTemu)
            ->update([
                'status' => $request->ubah_status_ke ?: 'Selesai',
            ]);

        return redirect()->route('dokter.rekammedis.index')
            ->with('success', 'Rekam medis dokter berhasil disimpan.');
    }
}
