<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil data admin login

        return view('admin.profile.index', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 FUNGSI UPLOAD FOTO PROFIL ADMIN
    |--------------------------------------------------------------------------
    | Upload foto profil admin dengan validasi dan penghapusan foto lama.
    */
    public function uploadPhoto(Request $request)
    {
        try {

            // Validasi foto
            $request->validate([
                'foto_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // Ambil user admin login
            $user = Auth::user();

            // Pastikan folder storage/app/public/profil ada
            if (!Storage::exists('public/profil')) {
                Storage::makeDirectory('public/profil');
            }

            // Hapus foto lama jika ada
            if (!empty($user->foto_profile) && Storage::exists('public/profil/' . $user->foto_profile)) {
                Storage::delete('public/profil/' . $user->foto_profile);
            }

            // Simpan foto baru
            $namaFile = time() . '_' . $request->file('foto_profile')->getClientOriginalName();
            $request->file('foto_profile')->storeAs('public/profil', $namaFile);

            // Update database
            $user->foto_profile = $namaFile;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {

            // Jika terjadi error, kirim alasan sebenarnya ke front-end
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 FUNGSI HAPUS FOTO PROFIL ADMIN
    |--------------------------------------------------------------------------
    | Menghapus foto profil admin dan mengembalikan ke default.
    */
    public function deletePhoto(Request $request)
    {
        try {

            // Ambil user admin login
            $user = Auth::user();

            // Hapus foto dari storage jika ada
            if (!empty($user->foto_profile) && Storage::exists('public/profil/' . $user->foto_profile)) {
                Storage::delete('public/profil/' . $user->foto_profile);
            }

            // Set foto_profile jadi null
            $user->foto_profile = null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil dihapus!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus foto: ' . $e->getMessage()
            ], 500);
        }
    }
}