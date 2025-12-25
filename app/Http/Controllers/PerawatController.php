<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
    /* ===========================================================
       INDEX — Menampilkan perawat role = Perawat
    ============================================================ */
    public function index()
    {
        $perawat = User::where('role', 'Perawat')
                        ->orderBy('iduser', 'asc')
                        ->get();

        return view('admin.perawat.index', compact('perawat'));
    }

    /* ===========================================================
       CREATE — Tidak dipakai (pakai modal)
    ============================================================ */
    public function create()
    {
        return redirect()->route('admin.perawat.index');
    }

    /* ===========================================================
       STORE — Tambah perawat via modal (WAJIB FIX IDUSER)
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:3',
            'status'   => 'required'
        ]);

        // === WAJIB: iduser manual, bukan auto increment ===
        $nextId = (User::max('iduser') ?? 0) + 1;

        $nextId = User::max("iduser") + 1;
        $nextId = User::max("iduser") + 1;
        $nextId = User::max("iduser") + 1;
        $nextId = User::max("iduser") + 1;
        User::create([
            'iduser'   => $nextId,
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'Perawat',
            'status'   => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       UPDATE — Edit perawat via modal
    ============================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'status' => 'required'
        ]);

        $perawat = User::find($id);

        if (!$perawat) {
            return response()->json(['success' => false, 'message' => 'Perawat tidak ditemukan']);
        }

        // Cek email duplikat
        $emailCheck = User::where('email', $request->email)
                          ->where('iduser', '!=', $id)
                          ->first();

        if ($emailCheck) {
            return response()->json(['success' => false, 'message' => 'Email sudah digunakan']);
        }

        $perawat->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       RESET PASSWORD PERAWAT
    ============================================================ */
    public function reset($id)
    {
        $perawat = User::find($id);

        if (!$perawat) {
            return back()->with('error', 'Perawat tidak ditemukan');
        }

        $perawat->password = Hash::make("123456");
        $perawat->save();

        return back()->with('success', 'Password perawat berhasil direset menjadi 123456');
    }

    /* ===========================================================
       DELETE PERAWAT
    ============================================================ */
    public function delete($id)
    {
        $perawat = User::find($id);

        if (!$perawat) {
            return back()->with('error', 'Perawat tidak ditemukan');
        }

        $perawat->delete();

        return back()->with('success', 'Perawat berhasil dihapus');
    }
}
