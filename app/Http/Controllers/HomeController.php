<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
{
    // total barang
    $totalBarang = DB::table('barang')->count();
   
    // barang masuk
    $barangMasuk = DB::table('barang_masuk')->sum('jumlah');

    // barang keluar
    $barangKeluar = DB::table('barang_keluar')->sum('jumlah');

    return view('home', compact(
        'totalBarang',
        'barangMasuk',
        'barangKeluar'
    ));
}
}