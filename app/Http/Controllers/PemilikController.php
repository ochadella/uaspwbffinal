<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // ← DITAMBAH untuk password

class PemilikController extends Controller
{
    /* ===========================================================
       INDEX — Menampilkan semua data pemilik
    ============================================================ */
    public function index()
    {
        $pemilik = DB::table('pemilik')
                    ->orderBy('pemilik.idpemilik', 'asc')
                    ->get();

        return view('resepsionis.pemilik.datapemilik', compact('pemilik'));
    }

    /* ===========================================================
       STORE — Tambah pemilik + AUTO BUAT USER
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'no_wa'   => 'required|numeric',
            'alamat'  => 'required|string|max:255',
        ], [
            'no_wa.numeric' => 'No WA hanya boleh berisi angka.',
        ]);

        /* =======================================================
           GENERATE ID USER BARU (sinkron dengan data user)
        ======================================================== */
        $nextUserId = (DB::table('user')->max('iduser') ?? 0) + 1;

        /* =======================================================
           BUAT USER BARU OTOMATIS DENGAN ROLE PEMILIK
        ======================================================== */
        DB::table('user')->insert([
            'iduser'    => $nextUserId,
            'nama'      => $request->nama,
            'email'     => $request->email,
            'password'  => Hash::make('123456'),
            'role'      => "Pemilik",
            'status'    => "aktif",
            'idpemilik' => null,  
        ]);

        /* =======================================================
           GENERATE IDPEMILIK MANUAL
        ======================================================== */
        $nextPemilikId = (DB::table('pemilik')->max('idpemilik') ?? 0) + 1;

        /* =======================================================
           INSERT PEMILIK + EMAIL (FIX) + SINKRON IDUSER
        ======================================================== */
        DB::table('pemilik')->insert([
            'idpemilik' => $nextPemilikId,
            'nama'      => $request->nama,
            'email'     => $request->email,
            'no_wa'     => $request->no_wa,
            'alamat'    => $request->alamat,
            'iduser'    => $nextUserId,   // connect ke tabel user
        ]);

        /* =======================================================
           FIX: UPDATE USER.idpemilik → supaya saling terhubung
        ======================================================== */
        DB::table('user')->where('iduser', $nextUserId)->update([
            'idpemilik' => $nextPemilikId
        ]);

        /* ==============================
           FIX: Kembali ke regrispemilik
        =============================== */
        return redirect()->route('resepsionis.pemilik.regris')
                         ->with('success', 'Data pemilik berhasil ditambahkan');
    }

    /* ===========================================================
       UPDATE PEMILIK (DITAMBAHKAN EMAIL + SINKRON USER)
    ============================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:150',
            'no_wa'  => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        /* =======================================================
           UPDATE TABEL PEMILIK
        ======================================================== */
        DB::table('pemilik')
            ->where('idpemilik', $id)
            ->update([
                'nama'   => $request->nama,
                'email'  => $request->email,
                'no_wa'  => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

        /* =======================================================
           SINKRON UPDATE KE USER
        ======================================================== */
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();

        if ($pemilik) {
            DB::table('user')
                ->where('iduser', $pemilik->iduser)
                ->update([
                    'nama'  => $request->nama,
                    'email' => $request->email
                ]);
        }

        /* ==============================
           FIX: tetap di halaman regrispemilik
        =============================== */
        return redirect()->route('resepsionis.pemilik.regris')
                         ->with('success', 'Data pemilik berhasil diperbarui');
    }

    /* ===========================================================
       DELETE PEMILIK + SINKRON DELETE USER
    ============================================================ */
    public function destroy($id)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        
        if (!$pemilik) {
            return back()->with('error', 'Data pemilik tidak ditemukan');
        }

        /* =======================================================
           CEK FOREIGN KEY — apakah punya pet?
        ======================================================== */
        $punyaPet = DB::table('pet')->where('idpemilik', $id)->exists();

        if ($punyaPet) {
            return back()->with('error', 'Pemilik tidak dapat dihapus karena masih memiliki data Pet.');
        }

        /* =======================================================
           SINKRON DELETE USER
        ======================================================== */
        DB::table('user')->where('iduser', $pemilik->iduser)->delete();

        /* =======================================================
           HAPUS PEMILIK
        ======================================================== */
        DB::table('pemilik')->where('idpemilik', $id)->delete();

        /* ==============================
           FIX: setelah hapus tetap di regrispemilik
        =============================== */
        return redirect()->route('resepsionis.pemilik.regris')
                         ->with('success', 'Data pemilik berhasil dihapus');
    }

    /* ===========================================================
       FORM REGISTRASI
    ============================================================ */
    public function formRegistrasi()
    {
        $pemilik = DB::table('pemilik')
                    ->orderBy('idpemilik', 'asc')
                    ->get();

        return view('resepsionis.pemilik.regrispemilik', compact('pemilik'));
    }
}
