<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Pengguna;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    // Untuk login via form React
   // app/Http/Controllers/AuthController.php
   public function login(Request $request)
   {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required'
       ]);
   
       $user = Pengguna::where('email', $request->email)->first();
   
       if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json(['message' => 'Email atau password salah.'], 401);
       }
   
       if (strcasecmp($user->status, 'aktif') !== 0) {
           return response()->json(['message' => 'Akun Anda tidak aktif.'], 403);
       }
   
       return response()->json(['user' => $user]);
   }
   

  

    public function logout()
    {
        Auth::logout();
        return redirect()->to('auth');
    }
}
