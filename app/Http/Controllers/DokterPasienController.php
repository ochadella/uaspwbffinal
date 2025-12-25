<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DokterPasienController extends Controller
{
    public function index(Request $request)
    {
        // ===============================
        // AMBIL ID DOKTER YANG LOGIN
        // ===============================
        $dokterID = Auth::id();

        // ===============================
        // QUERY UTAMA
        // JOIN KE REKAM MEDIS (PUNYA PERAWAT)
        // ===============================

        $pasien = DB::table('temu_dokter AS td')
            ->join('pet AS p', 'td.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('rekam_medis AS rm', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->select(
                'td.idtemu_dokter AS idreservasi',
                'p.nama AS nama_hewan',
                'jh.nama_jenis_hewan AS jenis_hewan',
                'rh.nama_ras AS ras',
                'p.jenis_kelamin',

                // ================================================================
                // 🔥 PERBAIKAN UTAMA: ambil umur dari tabel PET (bulan), bukan YEAR
                // ================================================================
                'p.umur AS umur',

                'pm.nama AS nama_pemilik',
                'td.tanggal_temu AS tanggal_kunjungan',

                DB::raw("
                    CASE
                        WHEN td.status = 'Menunggu' THEN 'Menunggu'
                        WHEN td.status = 'Dalam Antrian' THEN 'Dalam Antrian'
                        WHEN td.status = 'Sedang Diperiksa' THEN 'Sedang Diperiksa'
                        WHEN td.status = 'Selesai' THEN 'Selesai'
                        ELSE 'Tidak Diketahui'
                    END AS status
                "),

                // DATA PERAWAT
                'rm.anamnesa_awal',
                'rm.suhu',
                'rm.nadi',
                'rm.berat_badan',
                'rm.perilaku_hewan',

                // DATA DOKTER
                'rm.anamnesa',
                'rm.diagnosa',
                'rm.temuan_klinis',

                // 🔥 FIX WAJIB (AMAN MESKI KOLOM TIDAK ADA)
                DB::raw("COALESCE(rm.resep, '') AS resep"),
                DB::raw("COALESCE(rm.kategori_klinis, '') AS kategori_klinis"),
                DB::raw("COALESCE(rm.kategori_tindakan, '') AS kategori_tindakan"),

                // STATUS REKAM MEDIS
                DB::raw("IF(rm.diagnosa IS NULL, 'Belum', 'Selesai') AS status_rekam")
            )
            ->where('td.dokter_id', $dokterID)
            ->orderBy('td.tanggal_temu', 'DESC')
            ->get();

        // ====================================================
        // AMBIL DATA KATEGORI DARI ADMIN (TIDAK WAJIB ADA DI DB)
        // ====================================================
        $kategori_klinis = DB::table('kategori_klinis')->get();
        $kategori_tindakan = DB::table('kode_tindakan')->get();

        $kategoriKlinis = $kategori_klinis;
        $kategoriTindakan = $kategori_tindakan;

        return view(
            'dokter.pasien.DataPasien',
            compact(
                'pasien',
                'kategori_klinis',
                'kategori_tindakan',
                'kategoriKlinis',
                'kategoriTindakan'
            )
        );
    }

    // ======================================================================
    // DETAIL PASIEN
    // ======================================================================
    public function detail($id)
    {
        $dokterID = Auth::id();

        $pasien = DB::table('temu_dokter AS td')
            ->join('pet AS p', 'td.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('rekam_medis AS rm', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->select(
                'td.*',
                'p.nama AS nama_hewan',
                'p.jenis_kelamin',
                'p.tanggal_lahir',

                // ======================================================
                // 🔥 PERBAIKAN WAJIB: Tambahkan umur (bulan)
                // ======================================================
                'p.umur AS umur',

                'rh.nama_ras',
                'jh.nama_jenis_hewan',
                'pm.nama AS nama_pemilik',
                'pm.no_wa',
                'pm.alamat',

                // PERAWAT
                'rm.anamnesa_awal',
                'rm.suhu',
                'rm.nadi',
                'rm.berat_badan',
                'rm.perilaku_hewan',

                // DOKTER
                'rm.anamnesa',
                'rm.diagnosa',
                'rm.temuan_klinis',

                // 🔥 FIX WAJIB (AMAN MESKI KOLOM TIDAK ADA)
                DB::raw("COALESCE(rm.resep, '') AS resep"),
                DB::raw("COALESCE(rm.kategori_klinis, '') AS kategori_klinis"),
                DB::raw("COALESCE(rm.kategori_tindakan, '') AS kategori_tindakan")
            )
            ->where('td.idtemu_dokter', $id)
            ->where('td.dokter_id', $dokterID)
            ->first();

        if (!$pasien) {
            abort(404, 'Data pasien tidak ditemukan atau bukan pasien Anda.');
        }

        return view('dokter.pasien.DetailPasien', compact('pasien'));
    }
}
