<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPerawat;

class PerawatJadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Tambahan agar tidak error ketika user null (TIDAK menghapus kode lain)
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Untuk navbar (WAJIB supaya tidak error)
        $displayName  = $user->nama ?? 'User';
        $displayRole  = $user->role ?? 'Perawat';
        $initial      = strtoupper(substr($displayName, 0, 1));

        // Ambil jadwal perawat sesuai iduser perawat yang login
        // Tambahan: gunakan iduser atau id jika salah satu tidak ada (tanpa mengubah kode asli)
        $idPerawat = $user->iduser ?? $user->id;

        $jadwal = JadwalPerawat::where('iduser_perawat', $idPerawat)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        return view('perawat.jadwal.jadwal_jaga', compact(
            'jadwal',
            'displayName',
            'displayRole',
            'initial'
        ));
    }
}
