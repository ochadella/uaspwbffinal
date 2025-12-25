<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalPerawat;

class JadwalPerawatController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role perawat
        $perawat = User::where('role', 'perawat')->get();

        // Ambil semua jadwal + join user
        $jadwal = JadwalPerawat::with('perawat')->orderBy('tanggal', 'asc')->get();

        return view('admin.jadwal.jadwalperawat', compact('perawat', 'jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser_perawat' => 'required|exists:user,iduser',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required|string|max:255',
        ]);

        // ===== FIX TANPA AUTO INCREMENT =====
        $lastId = JadwalPerawat::max('id');
        $newId = $lastId ? $lastId + 1 : 1;

        JadwalPerawat::insert([
            'id' => $newId,                       // ⬅ WAJIB!
            'iduser_perawat' => $request->iduser_perawat,
            'tanggal' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruang,
        ]);

        return back()->with('success', 'Jadwal perawat berhasil ditambahkan');
    }

    public function destroy($id)
    {
        JadwalPerawat::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}
