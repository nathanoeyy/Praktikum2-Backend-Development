<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

// Route dengan closure (inline function)
Route::get('/', function () {
    return view('welcome');
});

// Route dengan parameter
Route::get('/halo/{nama}', function (string $nama) {
    return "Halo, {$nama}! Selamat datang di praktikum Laravel.";
});

// Route dengan parameter opsional
Route::get('/kampus/{nama?}', function (string $nama = 'Universitas') {
     return "Selamat datang di {$nama}";
});

// --- BAGIAN KHUSUS MAHASISWA ---
// 1. Panggil route khusus/spesifik (create form) TERLEBIH DAHULU
Route::get('/mahasiswa/create/form', [MahasiswaController::class, 'create']);

// 2. Route index
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->middleware('log.request');

// 3. Route dengan parameter dinamis ditaruh DI BAWAH
Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'show']);
Route::get('/mahasiswa/{nim}/{nama}', function (string $nim, string $nama) {
    return "NIM: {$nim} | Nama: {$nama}";
});

// Route POST
Route::post('/mahasiswa', function (Request $request) {
    return response()->json([
        'message' => 'Data mahasiswa berhasil diterima',
        'data' => [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'jurusan' => $request->input('jurusan'),
        ]
    ]);
});