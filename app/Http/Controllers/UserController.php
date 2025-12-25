<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /* ============================ */
    /*     INDEX (WAJIB ADA)       */
    /* ============================ */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.user.datauser', compact('users', 'roles'));
    }

    /* ============================ */
    /*     TAMBAH USER             */
    /* ============================ */
    public function store(Request $req)
    {
        try {
            $req->validate([
                'nama' => 'required',
                'email' => 'required|email|unique:user,email',
                'password' => 'required|min:3',
                'role' => 'required'
            ]);

            /* ============================
               FIX ID MANUAL TANPA LONCAT
               ============================ */
            $existing = User::pluck('iduser')->toArray();
            $nextId = 1;

            while (in_array($nextId, $existing)) {
                $nextId++;
            }

            $nextId = User::max("iduser") + 1;
            $nextId = User::max("iduser") + 1;
            $nextId = User::max("iduser") + 1;
            $nextId = User::max("iduser") + 1;

            // FIX final memastikan ID benar
            $nextId = (User::max("iduser") ?? 0) + 1;

            User::create([
                'iduser'   => $nextId,
                'nama'     => $req->nama,
                'email'    => $req->email,
                'password' => Hash::make($req->password),
                'role'     => $req->role,
                'status'   => 'aktif'
            ]);

            if ($req->ajax() || $req->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->route('admin.user.data')->with('success', 'User berhasil ditambahkan');

        } catch (\Exception $e) {
            if ($req->ajax() || $req->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    /* ============================ */
    /*     UPDATE USER             */
    /* ============================ */
    public function update(Request $req)
    {
        try {
            $req->validate([
                'edit_id' => 'required',
                'nama'    => 'required',
                'email'   => 'required|email',
                'role'    => 'required'
            ]);

            $user = User::where('iduser', $req->edit_id)->first();
            
            if (!$user) {
                if ($req->ajax() || $req->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
                }
                return back()->with('error', 'User tidak ditemukan');
            }

            $cekEmail = User::where('email', $req->email)
                            ->where('iduser', '!=', $req->edit_id)
                            ->first();

            if ($cekEmail) {
                if ($req->ajax() || $req->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Email sudah digunakan']);
                }
                return back()->with('error', 'Email sudah digunakan');
            }

            /* ============================
               UPDATE DATA USER
            ============================ */
            $user->update([
                'nama' => $req->nama,
                'email' => $req->email,
                'role' => $req->role
            ]);

            /* ==================================================
               SINKRON UPDATE JIKA USER INI MEMILIKI DATA PEMILIK
               (idpemilik bernilai)
            ==================================================== */
            if ($user->idpemilik !== null) {
                DB::table('pemilik')->where('idpemilik', $user->idpemilik)->update([
                    'nama'  => $req->nama,
                    'email' => $req->email
                ]);
            }

            /* ==================================================
               SINKRONKAN KE USER LAIN JIKA DIA PEMILIK
               idpemilik = iduser pemilik yang terhubung
            ==================================================== */
            $userPemilik = User::where('idpemilik', $req->edit_id)->first();

            if ($userPemilik) {
                $userPemilik->update([
                    'nama'  => $req->nama,
                    'email' => $req->email,
                ]);
            }

            if ($req->ajax() || $req->wantsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->route('admin.user.data')->with('success', 'User berhasil diupdate');

        } catch (\Exception $e) {
            if ($req->ajax() || $req->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }
    }

    /* ============================ */
    /*     RESET PASSWORD          */
    /* ============================ */
    public function resetPassword($id)
    {
        try {
            $user = User::where('iduser', $id)->first();

            if (!$user) {
                return redirect()->route('admin.user.data')->with('error', 'User tidak ditemukan');
            }

            $user->password = Hash::make("123456");
            $user->save();

            return redirect()->route('admin.user.data')->with('success', 'Password berhasil direset menjadi 123456');
            
        } catch (\Exception $e) {
            return redirect()->route('admin.user.data')->with('error', 'Gagal reset password: ' . $e->getMessage());
        }
    }

    /* ============================ */
    /*     DELETE USER             */
    /* ============================ */
    public function delete($id)
    {
        try {
            if (!$id) {
                return redirect()->route('admin.user.data')->with('error', 'ID user tidak valid');
            }

            $user = User::where('iduser', $id)->first();

            if (!$user) {
                return redirect()->route('admin.user.data')->with('error', 'User tidak ditemukan');
            }

            DB::table('role_user')->where('iduser', $id)->delete();

            /* ==================================================
               SINKRON DELETE: HAPUS PEMILIK JIKA DIA PEMILIK
            ==================================================== */
            DB::table('pemilik')->where('iduser', $id)->delete();

            $user->delete();

            return redirect()->route('admin.user.data')->with('success', 'User berhasil dihapus');
            
        } catch (\Exception $e) {
            return redirect()->route('admin.user.data')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }

    /* ============================ */
    /*     TOGGLE STATUS           */
    /* ============================ */
    public function toggleStatus($id)
    {
        try {
            $user = User::where('iduser', $id)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
            }

            $user->status = ($user->status === 'aktif') ? 'nonaktif' : 'aktif';
            $user->save();

            return response()->json([
                'success' => true,
                'status' => $user->status,
                'message' => "Status berhasil diubah menjadi {$user->status}"
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /* ============================ */
    /*     CREATE FORM             */
    /* ============================ */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.tambahuser', compact('roles'));
    }
}
