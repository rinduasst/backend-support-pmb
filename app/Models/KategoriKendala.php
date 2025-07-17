<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKendala extends Model
{
    use Hasfactory;
    protected $table ='kategori_kendalas';
    protected $fillable=['nama_kategori','id_kategori'];
}
