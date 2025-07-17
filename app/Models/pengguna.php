<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Model
{
    protected $table = 'penggunas';
protected $fillable = ['email', 'nama_pengguna', 'password', 'status'];

}
