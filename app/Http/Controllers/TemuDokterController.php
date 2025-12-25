<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    public function index()
    {
        $rows = DB::table('temu_dokter as td')
            ->leftJoin('pet', 'td.idpet', '=', 'pet.idpet')
            ->leftJoin('pemilik', 'td.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'td.dokter_id', '=', 'user.iduser')
            ->select(
                'td.*',
                'pet.nama as nama_pet',
                'pemilik.nama as nama_pemilik',
                'user.nama as nama_dokter'
            )
            ->orderBy('td.idtemu_dokter', 'desc')
            ->get();

        $pets = DB::table('pet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->select(
                'pet.idpet',
                'pet.nama as nama_pet',
                'pemilik.idpemilik',
                'pemilik.nama as nama_pemilik'
            )
            ->orderBy('pet.nama', 'asc')
            ->get();

        $pemilik = DB::table('pemilik')
            ->select('idpemilik', 'nama as nama_pemilik')
            ->orderBy('nama', 'asc')
            ->get();

        $dokter = DB::table('user')
            ->where('role', 'dokter')
            ->select('iduser as id', 'nama', 'email')
            ->orderBy('nama', 'asc')
            ->get();

        return view('resepsionis.temudokter.temudokter', [
            'rows'    => $rows,
            'pets'    => $pets,
            'pemilik' => $pemilik,
            'dokter'  => $dokter,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet'        => 'required|numeric',
            'idpemilik'    => 'required|numeric',
            'dokter_id'    => 'required|numeric',
            'tanggal_temu' => 'required|date',
            'waktu_temu'   => 'nullable',
            'keluhan'      => 'nullable|string',
            'status'       => 'required|string'
        ]);

        $nextId = (DB::table('temu_dokter')->max('idtemu_dokter') ?? 0) + 1;

        DB::table('temu_dokter')->insert([
            'idtemu_dokter' => $nextId,
            'idpet'         => $request->idpet,
            'idpemilik'     => $request->idpemilik,
            'dokter_id'     => $request->dokter_id,
            'tanggal_temu'  => $request->tanggal_temu,
            'waktu_temu'    => $request->waktu_temu,
            'keluhan'       => $request->keluhan,
            'status'        => $request->status,
            'created_at'    => now()
        ]);

        return redirect()->route('resepsionis.temudokter')
                         ->with('success', 'Antrian temu dokter berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet'        => 'required|numeric',
            'idpemilik'    => 'required|numeric',
            'dokter_id'    => 'required|numeric',
            'tanggal_temu' => 'required|date',
            'waktu_temu'   => 'nullable',
            'keluhan'      => 'nullable|string',
            'status'       => 'required|string'
        ]);

        $temu = DB::table('temu_dokter')->where('idtemu_dokter', $id)->first();

        DB::table('temu_dokter')
            ->where('idtemu_dokter', $id)
            ->update([
                'idpet'         => $request->idpet,
                'idpemilik'     => $request->idpemilik,
                'dokter_id'     => $request->dokter_id,
                'tanggal_temu'  => $request->tanggal_temu,
                'waktu_temu'    => $request->waktu_temu,
                'keluhan'       => $request->keluhan,
                'status'        => $request->status,
            ]);

        if ($request->status == 'Selesai') {
            DB::table('rekam_medis')->insert([
                'idpet'     => $temu->idpet,
                'tanggal'   => now(),
                'keluhan'   => $temu->keluhan,
                'diagnosa'  => '-',
                'tindakan'  => '-',
                'created_at'=> now()
            ]);
        }

        return redirect()->route('resepsionis.temudokter')
                         ->with('success', 'Data antrian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('temu_dokter')
            ->where('idtemu_dokter', $id)
            ->delete();

        return redirect()->route('resepsionis.temudokter')
                         ->with('success', 'Antrian berhasil dihapus!');
    }

    /* ===========================================================
       AJAX — Ambil Dokter Berdasarkan Tanggal (HARI)
    ============================================================ */
    public function getDokterByDate(Request $request)
    {
        $tanggal = $request->tanggal;

        // Normalisasi format tanggal
        try {
            if (strpos($tanggal, "/") !== false) {
                [$d, $m, $y] = explode("/", $tanggal);
                $tanggal = "$y-$m-$d";
            }

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
                return response()->json([]);
            }

            // KONVERSI TANGGAL → HARI
            $hari = Carbon::parse($tanggal)->locale('id')->dayName;

        } catch (\Exception $e) {
            return response()->json([]);
        }

        $hari = ucfirst($hari); // Senin, Selasa, Rabu...

        // FILTER BERDASARKAN KOLOM 'tanggal' YANG ISINYA HARI
        $dokter = DB::table('jadwal_dokter')
            ->join('user', 'user.iduser', '=', 'jadwal_dokter.iduser_dokter')
            ->where('jadwal_dokter.tanggal', $hari)
            ->select(
                'user.iduser',
                'user.nama',
                'jadwal_dokter.jam_mulai',
                'jadwal_dokter.jam_selesai'
            )
            ->get();

        return response()->json($dokter);
    }
}
