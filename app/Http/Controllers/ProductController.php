<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class ProductController extends Controller
{
    // Praktikum A — tampilkan list produk
    public function index()
    {
        $data     = Barang::with('kategori')->get();
        $kategori = Kategori::all();
        return view('list_product', compact('data', 'kategori'));
    }

    // Praktikum B & C — simpan produk baru (route: produk.simpan)
    public function simpan(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'kategori_id'  => 'nullable|exists:kategoris,id',
        ]);

        $produk               = new Barang();
        $produk->nama         = $request->input('nama');
        $produk->stok         = $request->input('stok');
        $produk->stok_minimum = $request->input('stok_minimum') ?? 5;
        $produk->kategori_id  = $request->input('kategori_id');
        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
