<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangMasukSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return DB::table('barang_masuk')
            ->join('barangs', 'barang_masuk.barang_id', '=', 'barangs.id')
            ->leftJoin('suppliers', 'barang_masuk.supplier_id', '=', 'suppliers.id')
            ->select('barangs.kode_barang', 'barangs.nama', 'suppliers.nama as nama_supplier', 'barang_masuk.jumlah', 'barang_masuk.tanggal')
            ->orderByDesc('barang_masuk.tanggal')
            ->get()
            ->map(function ($r, $i) {
                return [
                    'No'          => $i + 1,
                    'Kode Barang' => $r->kode_barang,
                    'Nama Barang' => $r->nama,
                    'Supplier'    => $r->nama_supplier ?? '-',
                    'Jumlah'      => $r->jumlah,
                    'Tanggal'     => $r->tanggal,
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'Kode Barang', 'Nama Barang', 'Supplier', 'Jumlah', 'Tanggal'];
    }

    public function title(): string { return 'Barang Masuk'; }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '27AE60']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 14, 'C' => 25, 'D' => 22, 'E' => 10, 'F' => 14];
    }
}
