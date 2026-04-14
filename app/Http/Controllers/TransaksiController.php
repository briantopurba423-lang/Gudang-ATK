<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class TransaksiController extends Controller
{
     public function masuk(Request $request)
    {
        $barang = Barang::find($request->id_barang);
        $barang->stok += $request->jumlah;
        $barang->save();

        return back();
    }

    public function keluar(Request $request)
    {
        $barang = Barang::find($request->id_barang);

        if ($barang->stok >= $request->jumlah) {
            $barang->stok -= $request->jumlah;
            $barang->save();
        } else {
            return back()->with('error', 'Stok tidak cukup');
        }

        return back();
    }
}
