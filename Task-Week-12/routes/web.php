<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;

Route::get('/', function () {
    return view('welcome'); // Route langsung Views tanpa controller
});
Route::resource('kontaks', KontakController::class); // routes mengunakan controller yakni akses controller 'KontakController' dengan akses link ‘/kontaks’
// Tambahkan
use App\Http\Controllers\MahasiswaController;

Route::resource('mahasiswa', MahasiswaController::class)->except(['show']); // Route ‘/mahasiswa’
Route::get('/mahasiswa/get-data', [MahasiswaController::class, 'getData'])->name('mahasiswa.get-data'); // Route JSON ‘/mahasiswa/get-data’

// routes mengunakan controller yakni akses controller ‘MahasiswaController’

// Routes untuk Buku CRUD
use App\Http\Controllers\BukuController;
Route::resource('buku', BukuController::class);

// Route untuk Bengkel CRUD
use App\Http\Controllers\BengkelController;
Route::resource('bengkel', BengkelController::class); // Route '/bengkel' dengan semua method CRUD
Route::get('/bengkel-data', [BengkelController::class, 'getData'])->name('bengkel.get-data'); // Route JSON untuk data table
