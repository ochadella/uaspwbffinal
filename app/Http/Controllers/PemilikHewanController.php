<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class PemilikHewanController extends Controller
{
    public function index()
    {
        // Ambil iduser yang sedang login
        $iduser = auth()->user()->iduser;

        // Ambil idpemilik berdasarkan iduser
        $pemilik = DB::table('pemilik')->where('iduser', $iduser)->first();

        if (!$pemilik) {
            // Jika user belum jadi pemilik, tampilkan halaman kosong
            $hewanSaya = collect();
            return view('pemilik.hewan.hewansaya', compact('hewanSaya'));
        }

        $idpemilik = $pemilik->idpemilik;

        // Ambil semua hewan milik pemilik ini lengkap dengan ras & jenis hewan
        $hewanSaya = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpemilik', $idpemilik)
            ->select(
                'pet.*',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->get();

        return view('pemilik.hewan.hewansaya', compact('hewanSaya'));
    }
}
