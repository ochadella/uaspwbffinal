<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // ✅ Tampilkan semua data kategori
    public function index()
    {
        // Ambil semua data dari tabel 'kategori'
        $rows = DB::table('kategori')->get()->map(function ($item) {
            return (array) $item;
        });

        // Kirim ke view
        return view('admin.kategori.datakategori', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    // ✅ Simpan data baru
    public function store(Request $request)
    {
        // Ambil idkategori terakhir kemudian +1
        $nextId = (DB::table('kategori')->max('idkategori') ?? 0) + 1;

        DB::table('kategori')->insert([
            'idkategori'    => $nextId,
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.data');
    }


    // ✅ Edit data (tampilkan data lama)
    public function edit($id)
    {
        $data = DB::table('kategori')->where('idkategori', $id)->first();

        // ❗ FIX UTAMA: Jika id tidak ditemukan → hindari error
        if (!$data) {
            return redirect()->route('admin.kategori.data')->with('error', 'Kategori tidak ditemukan!');
        }

        $editData = (array) $data;

        // Ambil ulang semua baris
        $rows = DB::table('kategori')->get()->map(fn($i) => (array) $i);

        return view('admin.kategori.datakategori', compact('rows', 'editData'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        DB::table('kategori')->where('idkategori', $id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.data');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        DB::table('kategori')->where('idkategori', $id)->delete();

        return redirect()->route('admin.kategori.data');
    }
}
