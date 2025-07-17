<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendala extends Model
{
    use HasFactory;
    protected $table = 'kendalas'; 
    protected $guarded = []; // biar bisa mass assign
    protected $fillable = [
        'kode_pendaftar',
        'nama',
        'status_pendaftar',
        'kendala',
        'tindak_lanjut',
        'no_wa',
        'status',
        'tanggal_penanganan',
        'tanggal_selesai',
        'petugas_id',
        'kategori_id',
    ];
    public function petugas()
    {
        return $this->belongsTo(Pengguna::class, 'petugas_id');
    
    }
    //setiap kendala dimiliki oleh satu petugas
  public function kategori()
    {
        return $this->belongsTo(KategoriKendala::class, 'kategori_id');
    }
 

}
