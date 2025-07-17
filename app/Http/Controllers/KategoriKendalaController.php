<?php
namespace App\Http\Controllers;

use App\Models\KategoriKendala;
use Illuminate\Http\Request;


class KategoriKendalaController extends Controller
{
    public function index()
    {
        return response()->json(KategoriKendala::all());
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_kategori' => 'required|string|max:255'
    ]);

    $kategori = KategoriKendala::create([
        'nama_kategori' => $request->nama_kategori
    ]);

    return response()->json($kategori, 201);
    }

    public function show($id)
    {
        $kategori = KategoriKendala::findOrFail($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
    // Validasi input
    $request->validate([
        'nama_kategori' => 'required|string|max:255'
    ]);

    // Cari data berdasarkan ID
    $kategori = KategoriKendala::findOrFail($id);

    // Update data
    $kategori->nama_kategori = $request->nama_kategori;
    $kategori->save();

    // Kembalikan response
    return response()->json([
        'message' => 'Kategori berhasil diperbarui',
        'data' => $kategori
    ]);
    }
    public function destroy($id)
    {
    $kategori = KategoriKendala::findOrFail($id);
    $kategori->delete();

    return response()->json([
        'message' => 'Kategori berhasil dihapus'
    ]);
    }



};
