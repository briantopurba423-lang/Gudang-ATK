<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();

        return view('produk.listproduk', compact('data'));
    }
}