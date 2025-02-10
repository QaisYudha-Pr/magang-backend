<?php
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tabel', function () {
    return view('table');
});

Route::get('/tambah', function () {
    return view('tambah');
});

Route::get('barang', [BarangController::class, 'store']);
