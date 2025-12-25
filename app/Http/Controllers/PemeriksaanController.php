<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;

class PemeriksaanController extends Controller
{
    // ============================================================
    // INDEX: LIST DATA PEMERIKSAAN (PLEK KETIPLEK DATA REKAM MEDIS DOKTER)
    // ============================================================
    public function index()
    {
        $pemeriksaan = DB::table('rekam_medis AS rm')
            ->join('temu_dokter AS td', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->join('pet AS p', 'rm.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user AS u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
            ->leftJoin('kategori_klinis AS kk', 'rm.kategori_klinis', '=', 'kk.idkategori_klinis')
            ->leftJoin('kode_tindakan AS kt', 'rm.kategori_tindakan', '=', 'kt.id')

            ->select(
                'rm.*',
                'td.idtemu_dokter AS idreservasi',       // ID Reservasi
                'td.tanggal_temu AS tanggal_kunjungan',   // tanggal kunjungan
                'td.waktu_temu',
                'td.keluhan',
                'td.status',

                // PET
                'p.nama AS nama_hewan',
                'p.jenis_kelamin',
                'p.umur AS usia',
                'rh.nama_ras',
                'jh.nama_jenis_hewan',

                // PEMILIK
                'pm.nama AS nama_pemilik',
                'pm.no_wa',
                'pm.alamat AS alamat_pemilik',

                // DOKTER
                'u.nama AS nama_dokter',

                // KATEGORI
                'kk.nama_kategori_klinis',
                'kt.nama_tindakan'
            )

            // urut tanggal lama dulu → ASC
            ->orderBy('td.tanggal_temu', 'ASC')
            ->orderBy('td.waktu_temu', 'ASC')
            ->get();

        $user        = auth()->user();
        $displayName = $user->nama ?? $user->name ?? 'User';
        $displayRole = ucfirst($user->role ?? 'Perawat');
        $initial     = strtoupper(mb_substr($displayName, 0, 1));

        return view('perawat.pemeriksaan.data_pemeriksaan', compact(
            'pemeriksaan',
            'displayName',
            'displayRole',
            'initial'
        ));
    }

    // ============================================================
    // DETAIL: HALAMAN DETAIL PEMERIKSAAN (PLEK KETIPLEK DETAIL DOKTER)
    // ============================================================
    public function detail($id)
    {
        $rekamMedis = DB::table('rekam_medis AS rm')
            ->join('temu_dokter AS td', 'rm.idtemu_dokter', '=', 'td.idtemu_dokter')
            ->join('pet AS p', 'rm.idpet', '=', 'p.idpet')
            ->leftJoin('ras_hewan AS rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan AS jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')
            ->join('pemilik AS pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user AS u', 'rm.dokter_pemeriksa', '=', 'u.iduser')
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
                'pm.alamat AS alamat_pemilik',

                // DOKTER
                'u.nama AS nama_dokter',

                // KATEGORI
                'kk.nama_kategori_klinis',
                'kt.nama_tindakan'
            )
            ->where('rm.idtemu_dokter', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()
                ->route('perawat.pemeriksaan.index')
                ->with('error', 'Detail pemeriksaan tidak ditemukan.');
        }

        return view('perawat.pemeriksaan.detail_pemeriksaan', compact('rekamMedis'));
    }

    // ============================================================
    // METHOD LAMA (STORE/UPDATE/DESTROY) BIARIN AJA, TAPI
    // SEKARANG TIDAK DIPAKAI DI UI (SUDAH DETAIL ONLY)
    // ============================================================

    public function edit($id)
    {
        $data = DB::table('rekam_medis')->where('idtemu_dokter', $id)->first();
        return view('perawat.pemeriksaan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::table('rekam_medis')
            ->where('idtemu_dokter', $id)
            ->update([
                'anamnesa'      => $request->anamnesa,
                'diagnosa'      => $request->diagnosa,
                'temuan_klinis' => $request->temuan_klinis,
            ]);

        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('rekam_medis')->where('idtemu_dokter', $id)->delete();

        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    public function store(Request $request)
    {
        DB::table('rekam_medis')->insert([
            'anamnesa'      => $request->anamnesa,
            'diagnosa'      => $request->diagnosa,
            'temuan_klinis' => $request->temuan_klinis,
            'created_at'    => now(),
        ]);

        return redirect()->route('perawat.pemeriksaan.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }
}
