<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanStokExport;

class ExportController extends Controller
{
    public function exportExcel()
    {
        if (!Session::get('status')) {
            return redirect()->route('login.form');
        }

        $filename = 'Laporan_ATK_' . now()->format('d-m-Y') . '.xlsx';
        return Excel::download(new LaporanStokExport(), $filename);
    }
}
