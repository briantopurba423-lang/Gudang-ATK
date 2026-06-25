<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class NotifikasiController extends Controller
{
    /**
     * Mengembalikan daftar barang yang stoknya <= stok_minimum.
     * Digunakan oleh AJAX polling untuk notifikasi real-time stok rendah.
     */
    public function stokRendah(): JsonResponse
    {
        if (!Session::get('status')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $barangStokRendah = Barang::with('kategori')
            ->whereColumn('stok', '<=', 'stok_minimum')
            ->orderBy('stok')
            ->get()
            ->map(function ($b) {
                return [
                    'id'            => $b->id,
                    'nama'          => $b->nama,
                    'kode_barang'   => $b->kode_barang,
                    'stok'          => $b->stok,
                    'stok_minimum'  => $b->stok_minimum,
                    'satuan'        => $b->satuan ?? 'pcs',
                    'kategori'      => $b->kategori->nama ?? '-',
                    'status'        => $b->stok <= 0 ? 'kosong' : 'sedikit',
                ];
            });

        return response()->json([
            'total'  => $barangStokRendah->count(),
            'barang' => $barangStokRendah,
        ]);
    }
}
