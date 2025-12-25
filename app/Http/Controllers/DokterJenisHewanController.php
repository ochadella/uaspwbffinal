<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterJenisHewanController extends Controller
{
    // ❌ constructor DIHAPUS karena menyebabkan error middleware()
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user || strtolower($user->role ?? '') !== 'dokter') {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        }

        // ambil data jenis hewan
        $jenisHewan = DB::table('jenis_hewan')->orderBy('idjenis_hewan')->get();

        return view('dokter.jenis.Datajenishewan_dokter', [
            'jenisHewan' => $jenisHewan,
            'initial' => strtoupper(substr($user->nama, 0, 1)),
            'displayName' => $user->nama,
            'displayRole' => ucfirst($user->role),
        ]);
    }
}
