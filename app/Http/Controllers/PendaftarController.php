<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Log;

class PendaftarController extends Controller
{
 

public function search(Request $request)
{
    $kode = $request->query('kode');
    Log::info('Kode query:', ['kode' => $kode]);

    if (!$kode) {
        return response()->json([], 200);
    }

    $pendaftar = Pendaftar::where('kode_pendaftar', 'like', "%{$kode}%")
        ->select('kode_pendaftar', 'nama', 'no_wa')
        ->limit(10)
        ->get();

    Log::info('Hasil query:', $pendaftar->toArray());

    return response()->json($pendaftar);
}

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
