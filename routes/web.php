<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
Route::get('/home', [HomeController::class, 'index']);

Route::get('/index', [BarangController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Barang
Route::resource('barang', BarangController::class);

// Supplier
Route::resource('supplier', SupplierController::class);

// Transaksi
Route::post('/masuk', [TransaksiController::class, 'masuk']);
Route::post('/keluar', [TransaksiController::class, 'keluar']);
