<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Cek role dokter (silakan sesuaikan field role di tabel user)
        if (!$user || strtolower($user->role ?? '') !== 'dokter') {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke dashboard dokter.');
        }

        return view('interface.dashboard_dokter', compact('user'));
    }
}
