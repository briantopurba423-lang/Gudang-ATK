<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanStokExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Stok Barang'    => new Sheets\StokBarangSheet(),
            'Barang Masuk'   => new Sheets\BarangMasukSheet(),
            'Barang Keluar'  => new Sheets\BarangKeluarSheet(),
            'Supplier'       => new Sheets\SupplierSheet(),
        ];
    }
}
