<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:kategoris,nama',
        ]);

        Kategori::create($request->only('nama'));
        return redirect()->route('index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|unique:kategoris,nama,' . $id,
        ]);

        Kategori::findOrFail($id)->update($request->only('nama'));
        return redirect()->route('index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect()->route('index')->with('success', 'Kategori berhasil dihapus.');
    }
}
