<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KendalaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PendaftarController;
use App\Models\Pengguna;
use App\Http\Controllers\KategoriKendalaController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test',function(){
    return view ('dashboard.index');
} );
Route::post('/login', [AuthController::class, 'login']);

//kendala
Route::get('/kendala', [KendalaController::class, 'index']);
Route::post('/kendala', [KendalaController::class, 'store'])->withoutMiddleware(['throttle:api']);
Route::put('/kendala/{id}', [KendalaController::class, 'update']);
Route::delete('/kendala/{id}', [KendalaController::class, 'destroy']);
Route::get('/kendala/{id}', [KendalaController::class, 'show']);
Route::get('/kendala/kode/{kode}', [KendalaController::class, 'findByKodePendaftar']);
Route::get('/kendala/search', [KendalaController::class, 'search']);

//pengguna
Route::get('/pengguna', [PenggunaController::class, 'index']);
Route::post('/pengguna', [PenggunaController::class, 'store']);
Route::put('/pengguna/{id}', [PenggunaController::class, 'update']);
Route::get('/pengguna/{id}', [PenggunaController::class, 'show']);
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy']);
Route::put('/pengguna/{id}/ubah-password', [PenggunaController::class, 'ubahPassword']);

Route::get('/petugas', function () {
    return response()->json(Pengguna::all(['id', 'nama_pengguna']));
});
Route::get('/pendaftar/search', [PendaftarController::class, 'search']);

//route buat kategori kendala
Route::post('/kategori-kendala', [KategoriKendalaController::class, 'store']);
Route::put('/kategori-kendala/{id}', [KategoriKendalaController::class, 'update']);
Route::get('/kategori-kendala/{id}', [KategoriKendalaController::class, 'show']);
Route::get('/kategori-kendala', [KategoriKendalaController::class, 'index']);
Route::delete('/kategori-kendala/{id}', [KategoriKendalaController::class, 'destroy']);







