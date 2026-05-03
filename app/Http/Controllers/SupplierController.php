<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string',
            'kontak' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        Supplier::create($request->only('nama', 'kontak', 'alamat'));
        return redirect()->route('index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required|string',
            'kontak' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        Supplier::findOrFail($id)->update($request->only('nama', 'kontak', 'alamat'));
        return redirect()->route('index')->with('success', 'Supplier berhasil diupdate.');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->route('index')->with('success', 'Supplier berhasil dihapus.');
    }
}
