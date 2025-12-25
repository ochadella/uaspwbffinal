<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SiteController extends Controller
{
    /**
     * Halaman Home
     */
    public function home()
    {
        return view('interface.home');
    }

    /**
     * Halaman Login — DINONAKTIFKAN
     */
    public function login()
    {
        // Mencegah bentrok dengan LoginController
        abort(404);
    }

    /**
     * Proses Login — DINONAKTIFKAN
     */
    public function loginPost(Request $request)
    {
        // Mencegah bentrok dengan LoginController
        abort(404);
    }

    /**
     * Redirect Role — TETAP AKTIF
     */
    private function redirectByRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('interface.dashboard');

            case 'dokter':
                return redirect()->route('interface.dashboard_dokter');

            case 'perawat':
                return redirect()->route('interface.dashboard_perawat');

            case 'resepsionis':
                return redirect()->route('dashboard.resepsionis');

            default:
                return redirect()->route('interface.dashboard');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    /**
     * Halaman Register
     */
    public function register()
    {
        return view('interface.register');
    }

    /**
     * Dashboard Resepsionis
     */
    public function dashboardResepsionis()
    {
        $total_antrian = DB::table('temu_dokter')
            ->whereIn('status', ['Menunggu', 'Dalam Antrian', 'Sedang Diperiksa'])
            ->count();

        return view('interface.dashboard_resepsionis', compact('total_antrian'));
    }
}
