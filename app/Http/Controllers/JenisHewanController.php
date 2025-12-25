<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index()
    {
        $rows = DB::table('jenis_hewan')->get();
        return view('dokter.jenis.datajenishewan', [
            'rows' => $rows,
            'editData' => null
        ]);
    }

    public function store(Request $request)
    {
        // VALIDASI WAJIB
        $request->validate([
            'nama_jenis_hewan' => 'required'
        ]);

        // GENERATE ID MANUAL — AMBIL ID TERBESAR TERUS +1
        $lastId = DB::table('jenis_hewan')->max('idjenis_hewan') ?? 0;

        DB::table('jenis_hewan')->insert([
            'idjenis_hewan'     => $lastId + 1,
            'nama_jenis_hewan'  => $request->nama_jenis_hewan
        ]);

        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $editData = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->first();
        $rows = DB::table('jenis_hewan')->get();
        return view('dokter.jenis.datajenishewan', compact('editData', 'rows'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required'
        ]);

        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan
        ]);

        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
        return redirect('/dokter/jenis/datajenishewan')->with('success', 'Data berhasil dihapus!');
    }
}
