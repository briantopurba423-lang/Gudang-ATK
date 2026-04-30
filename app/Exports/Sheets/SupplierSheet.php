<?php

namespace App\Exports\Sheets;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Supplier::all()->map(function ($s, $i) {
            return [
                'No'      => $i + 1,
                'Nama'    => $s->nama,
                'Kontak'  => $s->kontak,
                'Alamat'  => $s->alamat ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Supplier', 'Kontak', 'Alamat'];
    }

    public function title(): string { return 'Supplier'; }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8E44AD']]],
        ];
    }

    public function columnWidths(): array
    {
        return ['A' => 5, 'B' => 22, 'C' => 16, 'D' => 35];
    }
}
