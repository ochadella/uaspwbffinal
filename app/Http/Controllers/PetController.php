<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $rows = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'pemilik.no_wa as wa_pemilik',
                'pemilik.alamat as alamat_pemilik',
                'ras_hewan.nama_ras'
            )
            ->get()
            ->map(fn($item) => (array)$item)
            ->toArray();

        $listPemilik = DB::table('pemilik')
            ->select('idpemilik', 'nama', 'no_wa', 'alamat')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $listRas = DB::table('ras_hewan')
            ->select('idras_hewan as idras', 'nama_ras')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $listJenis = DB::table('jenis_hewan')
            ->select('idjenis_hewan as idjenis', 'nama_jenis_hewan')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $pemilik = $listPemilik;
        $ras     = $listRas;
        $jenis   = $listJenis;

        $editData = null;

        return view(
            'resepsionis.pet.datapet',
            compact('rows', 'listPemilik', 'listRas', 'listJenis', 'pemilik', 'ras', 'jenis', 'editData')
        );
    }

    public function store(Request $request)
    {
        $nextId = (DB::table('pet')->max('idpet') ?? 0) + 1;

        DB::table('pet')->insert([
            'idpet'          => $nextId,
            'nama'           => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'idpemilik'      => $request->idpemilik,
            'idras_hewan'    => $request->idras,

            // ✅ FIX DI SINI — umur harus ambil dari input user
            'umur'           => $request->umur,
        ]);

        return redirect()->route('resepsionis.pet.regris')
                         ->with('success', 'Data pet berhasil ditambahkan');
    }

    public function edit($id)
    {
        $editData = DB::table('pet')->where('idpet', $id)->first();

        $rows = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'pemilik.no_wa as wa_pemilik',
                'pemilik.alamat as alamat_pemilik',
                'ras_hewan.nama_ras'
            )
            ->get()
            ->map(fn($item) => (array)$item)
            ->toArray();

        $listPemilik = DB::table('pemilik')
            ->select('idpemilik', 'nama', 'no_wa', 'alamat')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $listRas = DB::table('ras_hewan')
            ->select('idras_hewan as idras', 'nama_ras')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $listJenis = DB::table('jenis_hewan')
            ->select('idjenis_hewan as idjenis', 'nama_jenis_hewan')
            ->get()
            ->map(fn($item) => $item)
            ->toArray();

        $pemilik = $listPemilik;
        $ras     = $listRas;
        $jenis   = $listJenis;

        return view(
            'resepsionis.pet.datapet',
            compact('rows', 'editData', 'listPemilik', 'listRas', 'listJenis', 'pemilik', 'ras', 'jenis')
        );
    }

    public function update(Request $request, $id)
    {
        DB::table('pet')->where('idpet', $id)->update([
            'nama'           => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'idpemilik'      => $request->idpemilik,
            'idras_hewan'    => $request->idras,
            'umur'           => $request->umur,
        ]);

        return redirect()->route('resepsionis.pet.regris')
                         ->with('success', 'Data pet berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();

        return redirect()->route('resepsionis.pet.regris')
                         ->with('success', 'Data pet berhasil dihapus');
    }

    public function getPet($id)
    {
        // ambil hewan + pemilik pakai model Pet
        $pet = Pet::with('pemilik')->where('idpet', $id)->first();

        if (!$pet) {
            return response()->json(['error' => 'Data pet tidak ditemukan'], 404);
        }

        return response()->json([
            'idpet'     => $pet->idpet,
            'nama_pet'  => $pet->nama,
            'idpemilik' => $pet->idpemilik,
            'nama_pemilik' => $pet->pemilik->nama ?? null,
        ]);
    }


    public function indexResepsionis()
    {
        $rows = DB::table('pet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'pemilik.no_wa as wa_pemilik',
                'pemilik.alamat as alamat_pemilik',
                'ras_hewan.nama_ras',
                'ras_hewan.idras_hewan as idras'
            )
            ->get();

        $pemilik = DB::table('pemilik')->get();
        $ras     = DB::table('ras_hewan')->select(
                        'idras_hewan as idras',
                        'nama_ras'
                   )->get();

        return view('resepsionis.pet.datapet', compact('rows', 'pemilik', 'ras'));
    }

    public function regrispet()
    {
        $pemilik = \DB::table('pemilik')->get();

        $ras = \DB::table('ras_hewan')
            ->select('idras_hewan as idras', 'nama_ras')
            ->get();

        $rows = \DB::table('pet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select(
                'pet.*',
                'pemilik.nama as nama_pemilik',
                'pemilik.no_wa as wa_pemilik',
                'pemilik.alamat as alamat_pemilik',
                'ras_hewan.nama_ras',
                'ras_hewan.idras_hewan'
            )
            ->get()
            ->map(function ($r) {
                return (array) $r;
            });

        return view('resepsionis.pet.Regrispet', compact('pemilik', 'ras', 'rows'));
    }

}
