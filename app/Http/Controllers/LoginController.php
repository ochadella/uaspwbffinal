<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('interface.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // CEK USER ADA
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.',
            ])->withInput($request->only('email'));
        }

        // CEK PASSWORD
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->withInput($request->only('email'));
        }

        // CEK STATUS AKTIF (TOLERAN)
        if (isset($user->status)) {
            $statusClean = strtolower(trim($user->status));
            
            // HANYA TOLAK jika status JELAS nonaktif
            if (in_array($statusClean, ['nonaktif', 'inactive', 'banned', 'suspended'])) {
                return back()->withErrors([
                    'email' => 'Akun tidak aktif. Hubungi administrator.',
                ])->withInput($request->only('email'));
            }
        }

        // LOGIN SUKSES
        Auth::login($user);
        $request->session()->regenerate();

        // GET ROLE DAN BERSIHKAN
        $role = strtolower(trim($user->role ?? ''));

        // REDIRECT BERDASARKAN ROLE
        switch ($role) {
            case 'administrator':
            case 'admin':
                return redirect()->route('interface.dashboard');
                
            case 'dokter':
                return redirect()->route('interface.dashboard_dokter');
                
            case 'perawat':
                return redirect()->route('interface.dashboard_perawat');
                
            case 'resepsionis':
            case 'resepsionist':
                return redirect()->route('dashboard.resepsionis');

            /* ============================
               ⭐ PENAMBAHAN UNTUK PEMILIK ⭐
               ============================ */
            case 'pemilik':
                return redirect()->route('dashboard.pemilik');
            /* ============================ */

            default:
                Auth::logout();
                return back()->withErrors([
                    'email' => "Role tidak valid: [{$user->role}]. Hubungi administrator.",
                ])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
