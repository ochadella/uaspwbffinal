<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokterProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil data dokter login

        return view('dokter.profile.index', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 FUNGSI BARU — UPLOAD FOTO PROFIL DOKTER
    |--------------------------------------------------------------------------
    | Ditambahkan TANPA mengubah fungsi index() kamu.
    | Semua baris lama tetap utuh persis seperti kamu kirim.
    */
    public function uploadPhoto(Request $request)
    {
        try {

            // Validasi foto (🔹 GANTI: foto → foto_profile)
            $request->validate([
                'foto_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // Ambil user dokter login
            $user = Auth::user();

            // Pastikan folder storage/app/public/profil ada
            if (!Storage::exists('public/profil')) {
                Storage::makeDirectory('public/profil');
            }

            // Hapus foto lama jika ada (🔹 GANTI: foto → foto_profile)
            if (!empty($user->foto_profile) && Storage::exists('public/profil/' . $user->foto_profile)) {
                Storage::delete('public/profil/' . $user->foto_profile);
            }

            // Simpan foto baru (🔹 GANTI: foto → foto_profile)
            $namaFile = time() . '_' . $request->file('foto_profile')->getClientOriginalName();
            $request->file('foto_profile')->storeAs('public/profil', $namaFile);

            // Update database (🔹 GANTI: foto → foto_profile)
            $user->foto_profile = $namaFile;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {

            // ⛔ Jika terjadi error, kirim alasan sebenarnya ke front-end!
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload foto: ' . $e->getMessage()
            ], 500);
        }
    }
}
