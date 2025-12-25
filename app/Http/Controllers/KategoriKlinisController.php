<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class KategoriKlinisController extends Controller
{
    // ============================
    //  TAMPIL DATA
    // ============================
    public function index()
    {
        $rows = DB::table('kategori_klinis')->get()->map(fn($r) => (array) $r);

        return view('admin.kategoriklinis.datakategoriklinis', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    // ============================
    //  TAMBAH DATA (MANUAL ID)
    // ============================
    public function store(Request $request)
    {
        $nextId = (DB::table('kategori_klinis')->max('idkategori_klinis') ?? 0) + 1;

        DB::table('kategori_klinis')->insert([
            'idkategori_klinis'     => $nextId,
            'nama_kategori_klinis'  => $request->nama_kategori_klinis,
            'deskripsi'             => $request->deskripsi
        ]);

        return redirect()->route('admin.kategoriklinis.data');
    }

    // ============================
    //  EDIT (BUKA POPUP)
    // ============================
    public function edit($id)
    {
        $editData = (array) DB::table('kategori_klinis')
                        ->where('idkategori_klinis', $id)
                        ->first();

        $rows = DB::table('kategori_klinis')->get()->map(fn($r) => (array) $r);

        return view('admin.kategoriklinis.datakategoriklinis', compact('rows', 'editData'));
    }

    // ============================
    //  UPDATE (POST)
    // ============================
    public function update(Request $request, $id)
    {
        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->update([
                'nama_kategori_klinis' => $request->nama_kategori_klinis,
                'deskripsi'            => $request->deskripsi
            ]);

        return redirect()->route('admin.kategoriklinis.data');
    }

    // ============================
    //  DELETE (AMAN DARI ERROR)
    // ============================
    public function destroy($id)
    {
        try {
            DB::table('kategori_klinis')
                ->where('idkategori_klinis', $id)
                ->delete();

            return redirect()->route('admin.kategoriklinis.data');

        } catch (Exception $e) {

            // Jika FK error → tampilkan pesan aman
            return redirect()
                ->route('admin.kategoriklinis.data')
                ->with('error', 'Kategori ini tidak dapat dihapus karena sedang dipakai pada Kode Tindakan.');
        }
    }
}
