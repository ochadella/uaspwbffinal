<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{
    /* ===========================================================
       DASHBOARD — FIX untuk error $total_antrian undefined
    ============================================================ */
    public function dashboardResepsionis()
    {
        // Jika kamu punya tabel antrian dokter, ganti nama tabelnya:
        // contoh: DB::table('antrian')->count();
        $total_antrian = DB::table('temu_dokter')->count();

        return view('interface.dashboard_resepsionis', compact('total_antrian'));
    }

    /* ===========================================================
       INDEX — Menampilkan resepsionis (role = Resepsionis)
    ============================================================ */
    public function index()
    {
        $resepsionis = User::where('role', 'Resepsionis')
                           ->orderBy('iduser', 'asc')
                           ->get();

        return view('admin.resepsionis.index', compact('resepsionis'));
    }

    /* ===========================================================
       CREATE — Tidak dipakai (pakai modal)
    ============================================================ */
    public function create()
    {
        return redirect()->route('admin.resepsionis.index');
    }

    /* ===========================================================
       STORE — Tambah resepsionis via modal (SAMA seperti dokter)
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:3',
            'status'   => 'required',
        ]);

        // === generate iduser manual ===
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
            'role'     => 'Resepsionis',  // fixed, tidak berubah
            'status'   => $request->status,
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       UPDATE — Edit resepsionis via modal
    ============================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'status' => 'required'
        ]);

        $resepsionis = User::find($id);

        if (!$resepsionis) {
            return response()->json(['success' => false, 'message' => 'Resepsionis tidak ditemukan']);
        }

        // cek email duplikat
        $emailCheck = User::where('email', $request->email)
                          ->where('iduser', '!=', $id)
                          ->first();

        if ($emailCheck) {
            return response()->json(['success' => false, 'message' => 'Email sudah digunakan']);
        }

        $resepsionis->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       RESET PASSWORD
    ============================================================ */
    public function reset($id)
    {
        $resepsionis = User::find($id);

        if (!$resepsionis) {
            return back()->with('error', 'Resepsionis tidak ditemukan');
        }

        $resepsionis->password = Hash::make("123456");
        $resepsionis->save();

        return back()->with('success', 'Password berhasil direset menjadi 123456');
    }

    /* ===========================================================
       DELETE
    ============================================================ */
    public function delete($id)
    {
        $resepsionis = User::find($id);

        if (!$resepsionis) {
            return back()->with('error', 'Resepsionis tidak ditemukan');
        }

        $resepsionis->delete();

        return back()->with('success', 'Resepsionis berhasil dihapus');
    }
}
