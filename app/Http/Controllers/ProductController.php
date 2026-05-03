<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            ['id' => 1, 'produk' => 'Pulpen Pilot'],
            ['id' => 2, 'produk' => 'Kertas HVS A4'],
            ['id' => 3, 'produk' => 'Staples Besar'],
            ['id' => 4, 'produk' => 'Tinta Printer Hitam'],
            ['id' => 5, 'produk' => 'Map Plastik'],
        ];

        return view('list_product', compact('data'));
    }
}
