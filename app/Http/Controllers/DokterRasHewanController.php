<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RasHewan;

class DokterRasHewanController extends Controller
{
    // ❗ Constructor dihapus karena menyebabkan error middleware()
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        // Ambil semua ras hewan dari admin (READ ONLY untuk dokter)
        $rasHewan = RasHewan::with('jenis')->get();

        // Tampilkan view dokter dengan data lengkap
        return view('dokter.ras.Datarashewan_dokter', compact('rasHewan'));
    }
}
