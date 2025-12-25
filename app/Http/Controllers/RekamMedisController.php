<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    /**
     * Show the form for creating a new Medical Record
     */
    public function create(Request $request)
    {
        // Ambil ID dari query string ?id=...
        $idTemuDokter = $request->query('id');

        return view('perawat.rekammedis.inputrekammedis', compact('idTemuDokter'));
    }

    /**
     * Store the newly created rekam medis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idtemu_dokter' => 'required|integer',
            'anamnesa' => 'required|string',
            'diagnosa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'dokter_pemeriksa' => 'required|integer',
        ]);

        RekamMedis::create($validated);

        return redirect()
            ->route('perawat.rekammedis.data')
            ->with('success', 'Rekam Medis berhasil disimpan!');
    }
}
