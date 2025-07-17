<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'kendalas';
    protected $fillable = ['kode_pendaftar', 'nama', 'no_wa'];
    
}
