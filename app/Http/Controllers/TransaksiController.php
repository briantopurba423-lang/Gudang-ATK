<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function masuk(Request $request)
    {
        $request->validate([
            'id_barang'   => 'required|exists:barangs,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'jumlah'      => 'required|integer|min:1',
            'tanggal'     => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->id_barang);
        $barang->stok += $request->jumlah;
        $barang->save();

        DB::table('barang_masuk')->insert([
            'barang_id'   => $barang->id,
            'supplier_id' => $request->supplier_id ?: null,
            'jumlah'      => $request->jumlah,
            'tanggal'     => $request->tanggal,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('index')->with('success', 'Barang masuk berhasil dicatat.');
    }

    public function keluar(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak cukup! Stok tersedia: ' . $barang->stok);
        }

        $barang->stok -= $request->jumlah;
        $barang->save();

        DB::table('barang_keluar')->insert([
            'barang_id'  => $barang->id,
            'jumlah'     => $request->jumlah,
            'tanggal'    => $request->tanggal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('index')->with('success', 'Barang keluar berhasil dicatat.');
    }
}
