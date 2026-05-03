<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        $kategoris = [
            ['nama' => 'Alat Tulis',    'deskripsi' => 'Pulpen, pensil, spidol, dll'],
            ['nama' => 'Kertas',        'deskripsi' => 'Berbagai jenis kertas'],
            ['nama' => 'Perlengkapan',  'deskripsi' => 'Staples, map, penggaris, dll'],
            ['nama' => 'Tinta & Toner', 'deskripsi' => 'Tinta printer dan toner'],
        ];
        foreach ($kategoris as $k) {
            DB::table('kategoris')->insert(array_merge($k, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Supplier
        $suppliers = [
            ['nama' => 'PT Sinar Jaya',     'kontak' => '081234567890', 'alamat' => 'Jl. Sudirman No. 12, Jakarta Pusat'],
            ['nama' => 'CV Maju Bersama',   'kontak' => '082345678901', 'alamat' => 'Jl. Gatot Subroto No. 45, Bandung'],
            ['nama' => 'Toko Berkah Abadi', 'kontak' => '083456789012', 'alamat' => 'Jl. Malioboro No. 7, Yogyakarta'],
            ['nama' => 'UD Sejahtera',      'kontak' => '084567890123', 'alamat' => 'Jl. Ahmad Yani No. 88, Surabaya'],
        ];
        foreach ($suppliers as $s) {
            DB::table('suppliers')->insert(array_merge($s, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Barang (kategori_id: 1=Alat Tulis, 2=Kertas, 3=Perlengkapan, 4=Tinta)
        $barangs = [
            ['kode_barang' => 'ATK-001', 'nama' => 'Pulpen Pilot',        'stok' => 150, 'stok_minimum' => 20, 'kategori_id' => 1, 'supplier_id' => 1],
            ['kode_barang' => 'ATK-002', 'nama' => 'Kertas HVS A4',       'stok' => 80,  'stok_minimum' => 10, 'kategori_id' => 2, 'supplier_id' => 2],
            ['kode_barang' => 'ATK-003', 'nama' => 'Staples Besar',       'stok' => 40,  'stok_minimum' => 5,  'kategori_id' => 3, 'supplier_id' => 3],
            ['kode_barang' => 'ATK-004', 'nama' => 'Tinta Printer Hitam', 'stok' => 25,  'stok_minimum' => 5,  'kategori_id' => 4, 'supplier_id' => 4],
            ['kode_barang' => 'ATK-005', 'nama' => 'Map Plastik',         'stok' => 60,  'stok_minimum' => 10, 'kategori_id' => 3, 'supplier_id' => 1],
            ['kode_barang' => 'ATK-006', 'nama' => 'Penggaris 30cm',      'stok' => 3,   'stok_minimum' => 5,  'kategori_id' => 3, 'supplier_id' => 2],
            ['kode_barang' => 'ATK-007', 'nama' => 'Spidol Whiteboard',   'stok' => 0,   'stok_minimum' => 5,  'kategori_id' => 1, 'supplier_id' => 3],
            ['kode_barang' => 'ATK-008', 'nama' => 'Buku Tulis',          'stok' => 200, 'stok_minimum' => 30, 'kategori_id' => 2, 'supplier_id' => 4],
        ];
        foreach ($barangs as $b) {
            DB::table('barangs')->insert(array_merge($b, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Barang Masuk (supplier_id: 1=PT Sinar Jaya, 2=CV Maju Bersama, 3=Toko Berkah, 4=UD Sejahtera)
        $masukData = [
            ['barang_id' => 1, 'supplier_id' => 1, 'jumlah' => 100, 'tanggal' => Carbon::now()->subDays(6)->toDateString()],
            ['barang_id' => 2, 'supplier_id' => 2, 'jumlah' => 50,  'tanggal' => Carbon::now()->subDays(5)->toDateString()],
            ['barang_id' => 3, 'supplier_id' => 3, 'jumlah' => 30,  'tanggal' => Carbon::now()->subDays(5)->toDateString()],
            ['barang_id' => 4, 'supplier_id' => 4, 'jumlah' => 20,  'tanggal' => Carbon::now()->subDays(4)->toDateString()],
            ['barang_id' => 5, 'supplier_id' => 1, 'jumlah' => 40,  'tanggal' => Carbon::now()->subDays(3)->toDateString()],
            ['barang_id' => 8, 'supplier_id' => 2, 'jumlah' => 150, 'tanggal' => Carbon::now()->subDays(2)->toDateString()],
            ['barang_id' => 1, 'supplier_id' => 3, 'jumlah' => 50,  'tanggal' => Carbon::now()->subDays(1)->toDateString()],
            ['barang_id' => 6, 'supplier_id' => 4, 'jumlah' => 10,  'tanggal' => Carbon::now()->toDateString()],
        ];
        foreach ($masukData as $m) {
            DB::table('barang_masuk')->insert(array_merge($m, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Barang Keluar
        $keluarData = [
            ['barang_id' => 1, 'jumlah' => 20, 'tanggal' => Carbon::now()->subDays(5)->toDateString()],
            ['barang_id' => 2, 'jumlah' => 10, 'tanggal' => Carbon::now()->subDays(4)->toDateString()],
            ['barang_id' => 3, 'jumlah' => 5,  'tanggal' => Carbon::now()->subDays(3)->toDateString()],
            ['barang_id' => 4, 'jumlah' => 3,  'tanggal' => Carbon::now()->subDays(2)->toDateString()],
            ['barang_id' => 5, 'jumlah' => 8,  'tanggal' => Carbon::now()->subDays(1)->toDateString()],
            ['barang_id' => 8, 'jumlah' => 25, 'tanggal' => Carbon::now()->toDateString()],
        ];
        foreach ($keluarData as $k) {
            DB::table('barang_keluar')->insert(array_merge($k, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }
    }
}
