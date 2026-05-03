<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProductController;


Route::get('/',      [AuthController::class, 'home'])->name('home');
Route::get('/home',  [AuthController::class, 'home']);

Route::prefix('pages')->group(function () {
    Route::get('/home',     [AuthController::class, 'home'])->name('pages.home');
    Route::get('/about',    fn() => view('pages.about', ['active' => 'about']))->name('about');
  
});

Route::get('/list-product', [ProductController::class, 'index'])->name('list.product');


Route::get('/login',   [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login',  [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [AuthController::class, 'index'])->name('index');
Route::get('/manager',   [AuthController::class, 'dashboardManager'])->name('manager.dashboard');

Route::prefix('barang')->group(function () {
    Route::post('/',       [BarangController::class, 'store'])->name('barang.store');
    Route::put('/{id}',    [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    
});


Route::prefix('supplier')->group(function () {
    Route::post('/',       [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('/{id}',    [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});


Route::post('/masuk',  [TransaksiController::class, 'masuk'])->name('masuk');
Route::post('/keluar', [TransaksiController::class, 'keluar'])->name('keluar');


Route::prefix('kategori')->group(function () {
    Route::post('/',       [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/{id}',    [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});


Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
