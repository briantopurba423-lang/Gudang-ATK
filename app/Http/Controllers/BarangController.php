<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'kategori_id'  => 'nullable|exists:kategoris,id',
            'supplier_id'  => 'nullable|exists:suppliers,id',
        ]);

        Barang::create($request->only('nama', 'stok', 'stok_minimum', 'kategori_id', 'supplier_id'));
        return redirect()->route('index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required|string',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'kategori_id'  => 'nullable|exists:kategoris,id',
            'supplier_id'  => 'nullable|exists:suppliers,id',
        ]);

        Barang::findOrFail($id)->update($request->only('nama', 'stok', 'stok_minimum', 'kategori_id', 'supplier_id'));
        return redirect()->route('index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('index')->with('success', 'Barang berhasil dihapus.');
    }
}
