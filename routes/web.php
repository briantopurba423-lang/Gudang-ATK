<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;

// Landing Page
Route::get('/', [AuthController::class, 'home'])->name('home');
Route::get('/home', [AuthController::class, 'home']);

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (protected by session check inside controller)
Route::get('/dashboard', [AuthController::class, 'index'])->name('index');
Route::get('/manager', [AuthController::class, 'dashboardManager'])->name('manager.dashboard');

// Barang
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

// Supplier
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

// Transaksi
Route::post('/masuk', [TransaksiController::class, 'masuk'])->name('masuk');
Route::post('/keluar', [TransaksiController::class, 'keluar'])->name('keluar');

// Kategori
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
