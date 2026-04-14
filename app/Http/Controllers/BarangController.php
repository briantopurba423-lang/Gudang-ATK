<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
     public function index()
    {
        $barang = Barang::all();
        return view('index', compact('barang'));
    }

    public function store(Request $request)
    {
        Barang::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->back();
    }
}
