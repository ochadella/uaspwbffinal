<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;

class PemilikProfileController extends Controller
{
    public function index()
    {
        // user login
        $user = auth()->user();

        // Ambil data pemilik berdasarkan id_user
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return "Data pemilik tidak ditemukan.";
        }

        // Jumlah hewan — FIX SESUAI STRUKTUR TABEL PET
        $jumlahPet = Pet::where('idpemilik', $pemilik->idpemilik)->count();

        // Ambil semua idpet milik pemilik ini — FIX
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        // Jumlah kunjungan — FIX SESUAI STRUKTUR REKAM_MEDIS (idpet)
        $jumlahKunjungan = RekamMedis::whereIn('idpet', $petIds)->count();

        return view('pemilik.profile.index', compact(
            'pemilik',
            'jumlahPet',
            'jumlahKunjungan'
        ));
    }
}
