<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalDokter;

class JadwalDokterController extends Controller
{
    public function index()
    {
        // Ambil semua user yang memiliki role dokter
        $dokter = User::where('role', 'dokter')->get();

        // Ambil semua jadwal + relasi dokter
        $jadwal = JadwalDokter::with('dokter')->orderBy('tanggal', 'asc')->get();

        return view('admin.jadwal.jadwaldokter', compact('dokter', 'jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser_dokter' => 'required|exists:user,iduser',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required|string|max:255',
        ]);

        // ===== FIX TANPA AUTO INCREMENT =====
        // Ambil ID terakhir
        $lastId = JadwalDokter::max('id');

        // Jika tabel masih kosong → mulai dari 1
        $newId = $lastId ? $lastId + 1 : 1;

        // Karena tabel tidak punya created_at/updated_at
        $data = [
            'id' => $newId,                        // ⬅ WAJIB! supaya tidak error
            'iduser_dokter' => $request->iduser_dokter,
            'tanggal' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruang,
        ];

        JadwalDokter::insert($data);

        return back()->with('success', 'Jadwal dokter berhasil ditambahkan');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal dokter berhasil dihapus');
    }

    // ============================================================
    // ✨ METHOD UPDATE — DIBENERIN, TIDAK ADA BARIS YANG DIHAPUS ✨
    // ============================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'iduser_dokter' => 'required|exists:user,iduser',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required|string|max:255',
        ]);

        // Data yang akan diupdate
        $data = [
            'iduser_dokter' => $request->iduser_dokter,
            'tanggal'       => $request->hari,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'ruang'         => $request->ruang,
        ];

        // Update ke database
        JadwalDokter::where('id', $id)->update($data);

        // =======================================================
        // ⭐ FIX UTAMA: REDIRECT KE HALAMAN UTAMA JADWAL DOKTER
        // agar modal tertutup & tampilan kembali normal
        // =======================================================
        return redirect()
            ->route('admin.jadwal.dokter')
            ->with('success', 'Jadwal dokter berhasil diperbarui');
    }
}
