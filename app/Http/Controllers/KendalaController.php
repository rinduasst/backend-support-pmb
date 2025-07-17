<?php

namespace App\Http\Controllers;

use App\Models\Kendala;
use App\Models\KendalaLog;
use App\Models\Pengguna;
use App\Models\Pendaftar;

use Illuminate\Http\Request;

class KendalaController extends Controller
{
    // Ambil semua data kendala
    public function index()
    {
        $kendalas = Kendala::with('petugas','kategori')->get();
        return response()->json($kendalas);
        return Kendala::orderBy('id', 'desc')->paginate(10); //cari method dan dibuat desc buat tampilin terbaru
    }

    // Tampilkan detail satu kendala
    public function show($id)
    {
        $kendala = Kendala::with(['petugas','kategori',])->find($id);
      
        if (!$kendala) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($kendala);
    }

    // Simpan kendala baru
    public function store(Request $request)

    {

        $request->validate([
            'kode_pendaftar' => [
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status_pendaftar === 'pendaftar' && !is_numeric($value)) {
                        $fail('Kode pendaftar harus berupa angka.');
                    }
                }
            ],
            'nama' => 'nullable|string',
            'kendala' => 'nullable|string',
            'status_pendaftar' => 'required|string',
            'tindak_lanjut' => 'nullable',
            'no_wa' => 'nullable',
            'status' => 'required|in:Progres,Selesai',
            'tanggal_penanganan' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'petugas_id' => 'nullable|exists:penggunas,id',
            'kategori_id' => 'nullable|exists:kategori_kendalas,id'
        ]);
        if ($request->petugas_id && !is_numeric($request->petugas_id)) {
            $petugas = Pengguna::where('nama', $request->petugas_id)->first();
            if ($petugas) {
                $request->merge(['petugas_id' => $petugas->id]);
            } else {
                return response()->json(['message' => 'Petugas tidak ditemukan'], 422);
            }
        }
        
        $kendala = Kendala::create($request->all());

        return response()->json([
            'message' => 'Data kendala berhasil ditambahkan',
            'data' => $kendala
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                'kode_pendaftar' => 'nullable|numeric',
                'nama' => 'nullable|string',
                'kendala' => 'nullable|string',
                'tindak_lanjut' => 'nullable|string',
                'no_wa' => 'nullable|string',
                'status' => 'required|in:Progres,Selesai',
                'tanggal_penanganan' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date',
                'petugas_id' => 'nullable|exists:penggunas,id',
                'kategori_id' => 'nullable|exists:kategori_kendalas,id'
            ]);

        $kendala = Kendala::findOrFail($id);

        $kendala->update([
            'status_pendaftar' => $request->status_pendaftar,
            'kode_pendaftar' => $request->kode_pendaftar,
            'nama' => $request->nama,
        'kendala' => $request->kendala,
        'tindak_lanjut' => $request->tindak_lanjut,
            'no_wa' => $request->no_wa,
            'status' => $request->status,
            'tanggal_penanganan' => $request->tanggal_penanganan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'petugas_id' => $request->petugas_id,
            'kategori_id' => $request->kategori_id,
            
        ]);

        return response()->json(['message' => 'Berhasil update data kendala']);
    }

    // Hapus data kendala
    public function destroy($id)
    {
        $kendala = Kendala::find($id);
        if (!$kendala) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    
        $kendala->delete();
        return response()->json(['message' => 'Data kendala berhasil dihapus']);
    }
//mencari semua kendala milik pendaftar berdasarkan kode pendaftar
public function findByKodePendaftar($kode)
{
    $kendalas = Kendala::with('petugas')
        ->where('kode_pendaftar', $kode)
        ->orderBy('created_at', 'desc')
        ->get();

    if ($kendalas->isEmpty()) {
        return response()->json(['message' => 'Tidak ada data sebelumnya'], 404);
    }

    return response()->json($kendalas);
}
public function search(Request $request)
{
    $kode = $request->query('kode');
    $results = Pendaftar::where('kode_pendaftar', 'like', $kode . '%')
                ->select('kode_pendaftar', 'nama', 'no_wa')
                ->limit(5)
                ->get();
    return response()->json($results);
}

}
