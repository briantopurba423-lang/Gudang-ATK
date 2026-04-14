<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;



Route::get('/home', [HomeController::class, 'index']);

Route::get('/index', [BarangController::class, 'index']);



// Barang
Route::resource('barang', BarangController::class);

// Supplier
Route::resource('supplier', SupplierController::class);

// Transaksi
Route::post('/masuk', [TransaksiController::class, 'masuk']);
Route::post('/keluar', [TransaksiController::class, 'keluar']);
