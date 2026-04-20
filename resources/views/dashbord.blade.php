<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard ATK</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200">

<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-600 text-white flex flex-col">
        <div class="p-4 text-lg font-bold bg-gray-700">
            ATK Sistem
        </div>

        <div class="p-4">
            <a href="#" class="block bg-gray-500 p-2 rounded">Dashboard</a>
        </div>

        <div class="mt-auto p-4">
            <button class="w-full bg-gray-500 p-2 rounded">Logout</button>
        </div>
    </div>

    <!-- Content -->
    <div class="flex-1 p-6">

        <!-- Header -->
        <h1 class="text-xl font-semibold mb-4">Stok</h1>

        <!-- Filter -->
        <div class="flex items-center gap-4 mb-4">
            <span>Periode</span>

            <input type="date" class="border p-2 rounded">
            <span>→</span>
            <input type="date" class="border p-2 rounded">

            <button class="bg-gray-300 px-4 py-2 rounded">
                Tampilkan
            </button>

            <button class="bg-gray-300 px-4 py-2 rounded">
                Export Excel
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-2">Laporan Stok</h2>

            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama Barang</th>
                        <th class="border p-2">Kode Barang</th>
                        <th class="border p-2">Stok Awal</th>
                        <th class="border p-2">Barang Masuk</th>
                        <th class="border p-2">Barang Keluar</th>
                        <th class="border p-2">Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2 text-center">1</td>
                        <td class="border p-2">Pulpen</td>
                        <td class="border p-2">ATK001</td>
                        <td class="border p-2 text-center">100</td>
                        <td class="border p-2 text-center">50</td>
                        <td class="border p-2 text-center">20</td>
                        <td class="border p-2 text-center">130</td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="6" class="border p-2 text-right">Total</td>
                        <td class="border p-2 text-center">130</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

</body>
</html>