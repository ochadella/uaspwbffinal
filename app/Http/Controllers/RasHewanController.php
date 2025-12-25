<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasHewanController extends Controller
{
    /* ===========================================================
       INDEX — Menampilkan semua ras + jenis hewan
    ============================================================ */
    public function index()
    {
        $listJenis = DB::table('jenis_hewan')
                        ->orderBy('idjenis_hewan')
                        ->get();

        $listRas = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.idras_hewan',
                'ras_hewan.nama_ras',
                'ras_hewan.idjenis_hewan',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('ras_hewan.idras_hewan', 'asc')
            ->get();

        return view('dokter.ras.datarashewan', compact('listRas', 'listJenis'));
    }

    /* ===========================================================
       CREATE — Tidak dipakai karena pakai MODAL POPUP
    ============================================================ */
    public function create()
    {
        return redirect()->route('dokter.ras.data');
    }

    /* ===========================================================
       STORE — Tambah ras via Modal (JSON response)
       — PLEK KETIPLEK LOGIKA DOKTER
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ras'      => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer',
        ]);

        // === ⚠ WAJIB: GENERATE ID RAS MANUAL (tanpa auto increment) ===
        $nextId = (DB::table('ras_hewan')->max('idras_hewan') ?? 0) + 1;

        DB::table('ras_hewan')->insert([
            'idras_hewan'   => $nextId,
            'nama_ras'      => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan
        ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       UPDATE — Edit ras via modal (JSON response)
       — Sama persis flow Dokter
    ============================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras'      => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer',
        ]);

        $ras = DB::table('ras_hewan')->where('idras_hewan', $id)->first();

        if (!$ras) {
            return response()->json(['success' => false, 'message' => 'Ras hewan tidak ditemukan']);
        }

        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->update([
                'nama_ras'      => $request->nama_ras,
                'idjenis_hewan' => $request->idjenis_hewan,
            ]);

        return response()->json(['success' => true]);
    }

    /* ===========================================================
       DELETE RAS HEWAN
       — Sama gaya Dokter (redirect back)
    ============================================================ */
    public function destroy($id)
    {
        $ras = DB::table('ras_hewan')->where('idras_hewan', $id)->first();

        if (!$ras) {
            return back()->with('error', 'Ras hewan tidak ditemukan');
        }

        DB::table('ras_hewan')->where('idras_hewan', $id)->delete();

        return back()->with('success', 'Ras hewan berhasil dihapus');
    }
}
