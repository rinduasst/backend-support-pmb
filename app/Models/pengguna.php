<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penggunas';

    protected $fillable = [
        'email',
        'nama_pengguna',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
