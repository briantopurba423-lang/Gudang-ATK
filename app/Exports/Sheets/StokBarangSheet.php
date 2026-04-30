<?php

namespace App\Exports\Sheets;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StokBarangSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Barang::with('kategori')->get()->map(function ($b, $i) {
            return [
                'No'           => $i + 1,
                'Kode Barang'  => $b->kode_barang,
                'Nama Barang'  => $b->nama,
                'Kategori'     => $b->kategori->nama ?? '-',
                'Stok'         => $b->stok,
                'Status'       => $b->stok == 0 ? 'Habis' : ($b->stok <= 5 ? 'Menipis' : 'Tersedia'),
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Stok', 'Status'];
    }

    public function title(): string { return 'Stok Barang'; }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E73D8']], 'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 14, 'C' => 25, 'D' => 18, 'E' => 8, 'F' => 12];
    }
}
