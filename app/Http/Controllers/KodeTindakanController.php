<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $rows = DB::table('kode_tindakan')->get();

        // Jika ada edit ID, ambil datanya
        $editData = null;
        if (request()->has('edit')) {
            $editData = DB::table('kode_tindakan')
                ->where('id', request()->edit)   // PAKAI id BUKAN id_tindakan
                ->first();
        }

        return view('admin.kodetindakan.datatindakan', compact('rows', 'editData'));
    }

    public function store(Request $request)
    {
        DB::table('kode_tindakan')->insert([
            'kode_tindakan' => $request->kode_tindakan,
            'nama_tindakan' => $request->nama_tindakan,
            'harga'        => $request->harga,
        ]);

        return redirect()->route('admin.kodetindakan.data')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        DB::table('kode_tindakan')
            ->where('id', $id)  // PAKAI id
            ->update([
                'kode_tindakan' => $request->kode_tindakan,
                'nama_tindakan' => $request->nama_tindakan,
                'harga'         => $request->harga,
            ]);

        return redirect()->route('admin.kodetindakan.data')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($id)
    {
        DB::table('kode_tindakan')
            ->where('id', $id) // PAKAI id
            ->delete();

        return redirect()->route('admin.kodetindakan.data')
            ->with('success', 'Data berhasil dihapus!');
    }
}
