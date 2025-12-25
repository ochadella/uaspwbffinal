<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterJadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Validasi role dokter
        if (!$user || strtolower($user->role ?? '') !== 'dokter') {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        // ============================================
        // FIX: Ambil jadwal dokter dari tabel jadwal_dokter
        // Foreign key = iduser_dokter → cocok dengan iduser dokter yang login
        // ============================================
        $jadwalPemeriksaan = DB::table('jadwal_dokter')
            ->where('iduser_dokter', $user->iduser)
            ->orderBy('id', 'asc')
            ->get();

        return view('dokter.jadwal.jadwal_pemeriksaan', [
            'jadwalPemeriksaan' => $jadwalPemeriksaan,
            'initial' => strtoupper(substr($user->nama, 0, 1)),
            'displayName' => $user->nama,
            'displayRole' => ucfirst($user->role),
        ]);
    }
}
