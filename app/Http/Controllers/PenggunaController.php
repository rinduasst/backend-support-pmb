<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class PenggunaController extends Controller
{
    // Ambil semua pengguna
    public function index()
    {
        $penggunas = Pengguna::all();
        return response()->json($penggunas, 200);
    }

    // Simpan pengguna baru dari API
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'username' => 'required|unique:penggunas',
            'password' => 'required',
            'email' => 'required|email|unique:penggunas',
            'nama_pengguna' => 'required',
            'status' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);
    
        // Simpan ke DB
        Pengguna::create($validated);
    
        return response()->json(['message' => 'Pengguna berhasil disimpan']);
    }
    
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);
    
        $validatedData = $request->validate([
            'email' => 'required|email|unique:penggunas,email,' . $id,
            'nama_pengguna' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            // 'password' => 'nullable|string|min:6',
        ]);
    
        if (!empty($validatedData['password'])) {
            $pengguna->password = bcrypt($validatedData['password']);
        }
       $pengguna->email = $validatedData['email'];
    $pengguna->nama_pengguna = $validatedData['nama_pengguna'];
    $pengguna->status = $validatedData['status'];
    $pengguna->save();
    
        return response()->json(['message' => 'Data berhasil diupdate'], 200);
    }
    
public function show($id)
{
    $pengguna = Pengguna::findOrFail($id);
    return response()->json($pengguna, 200);
}
public function destroy($id)
{
    try {
        $pengguna = Pengguna::findOrFail($id);

        // Kosongkan petugas_id di semua kendala yang menggunakan pengguna ini
        \App\Models\Kendala::where('petugas_id', $id)->update(['petugas_id' => null]);

        // Hapus pengguna
        $pengguna->delete();

        return response()->json(['message' => 'Pengguna berhasil dihapus dan kendala yang terkait telah diperbarui']);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal hapus pengguna',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function ubahPassword(Request $request, $id)
{
    $request->validate([
        'old_password' => 'required',
        'password' => 'required|min:6',
    ]);

    $pengguna = Pengguna::findOrFail($id);

    // Verifikasi password lama
    if (!Hash::check($request->old_password, $pengguna->password)) {
        return response()->json(['message' => 'Password lama tidak sesuai'], 422);
    }

    // Simpan password baru
    $pengguna->password = bcrypt($request->password);
    $pengguna->save();

    return response()->json(['message' => 'Password berhasil diubah']);
}
}