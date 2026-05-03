@extends('layouts.main')

@section('title', 'Manager Dashboard | ATK System')

@section('style')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background: #2c3e50;
        color: white;
        min-height: 100vh;
        position: fixed;
        display: flex;
        flex-direction: column;
        z-index: 200;
    }

    .sidebar-header {
        padding: 24px 20px;
        text-align: center;
        background: rgba(0,0,0,0.2);
        font-weight: bold;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .sidebar-header small {
        display: block;
        font-size: 11px;
        color: #95a5a6;
        margin-top: 4px;
        font-weight: normal;
    }

    .sidebar a {
        display: block;
        color: #bdc3c7;
        padding: 14px 24px;
        text-decoration: none;
        transition: 0.2s;
        border-left: 4px solid transparent;
        font-size: 14px;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #34495e;
        color: white;
        border-left-color: #3498db;
    }

    .sidebar .logout-wrap {
        margin-top: auto;
        padding: 16px;
    }

    .sidebar .logout-wrap form button {
        width: 100%;
        background: #e74c3c;
        color: white;
        border: none;
        padding: 11px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .content {
        margin-left: 250px;
        flex: 1;
        padding: 90px 28px 28px;
        width: 100%;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-header h1 {
        font-size: 22px;
        color: #2c3e50;
    }

    .page-header p {
        color: #7f8c8d;
        font-size: 13px;
        margin-top: 4px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border-top: 4px solid #3498db;
    }

    .stat-card.warning { border-top-color: #e74c3c; }
    .stat-card.success { border-top-color: #27ae60; }
    .stat-card.purple { border-top-color: #8e44ad; }

    .stat-card h3 {
        font-size: 12px;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card .num {
        font-size: 36px;
        font-weight: bold;
        color: #2c3e50;
        margin-top: 8px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .grid-2-equal {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media(max-width: 900px) {
        .grid-2,
        .grid-2-equal {
            grid-template-columns: 1fr;
        }
    }

    .card {
        background: white;
        padding: 22px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .card h3 {
        font-size: 15px;
        color: #2c3e50;
        margin-bottom: 4px;
    }

    .card .sub {
        font-size: 12px;
        color: #95a5a6;
        margin-bottom: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    th, td {
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    th {
        color: #95a5a6;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: bold;
        display: inline-block;
    }

    .badge-danger  { background: #fdecea; color: #e74c3c; }
    .badge-warning { background: #fff3cd; color: #856404; }
    .badge-in      { background: #eafaf1; color: #27ae60; }
    .badge-out     { background: #fdecea; color: #e74c3c; }

    .alert {
        padding: 10px 16px;
        border-radius: 6px;
        margin-bottom: 16px;
        font-size: 13px;
    }

    .alert-error {
        background: #fdecea;
        color: #c0392b;
    }

    .btn-export {
        background: linear-gradient(135deg, #27ae60, #1e8449);
        color: white;
        padding: 11px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        white-space: nowrap;
    }
</style>
@endsection

@section('content')

<div class="dashboard-wrapper">

    <div class="sidebar">
        <div class="sidebar-header">
            📊 ATK MANAGER
            <small>{{ Session::get('username') }} · Manager</small>
        </div>

        <a href="#" class="active" onclick="return false;">Dashboard</a>
       
        <div class="logout-wrap">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </div>

    <div class="content">

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h1>Selamat Datang, {{ Session::get('username') }}!</h1>
                <p>Ringkasan aktivitas inventaris gudang ATK.</p>
            </div>

            <a href="{{ route('export.excel') }}" class="btn-export">
                📥 Export Excel
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Jenis Barang</h3>
                <div class="num">{{ $totalBarang }}</div>
            </div>

            <div class="stat-card warning">
                <h3>Stok Hampir Habis</h3>
                <div class="num">{{ $stokMenipis }}</div>
            </div>

            <div class="stat-card warning" style="border-top-color:#e67e22">
                <h3>Stok Habis</h3>
                <div class="num">{{ $stokHabis }}</div>
            </div>

            <div class="stat-card success">
                <h3>Total Masuk</h3>
                <div class="num">{{ $totalMasuk }}</div>
            </div>

            <div class="stat-card" style="border-top-color:#e74c3c">
                <h3>Total Keluar</h3>
                <div class="num">{{ $totalKeluar }}</div>
            </div>

            <div class="stat-card purple">
                <h3>Supplier</h3>
                <div class="num">{{ $totalSupplier }}</div>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <h3>Tren Barang Masuk & Keluar</h3>
                <div class="sub">7 hari terakhir</div>
                <canvas id="stockChart" height="120"></canvas>
            </div>

            <div class="card">
                <h3>⚠️ Perlu Re-Stock</h3>
                <div class="sub">Stok di bawah 10 unit</div>

                <table>
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStock as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if($item->stok == 0)
                                        <span class="badge badge-danger">Habis</span>
                                    @else
                                        <span class="badge badge-warning">{{ $item->stok }} unit</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align:center;color:#999;padding:20px;">
                                    ✅ Semua stok aman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid-2-equal">
            <div class="card">
                <h3>📥 Riwayat Barang Masuk</h3>
                <div class="sub">10 transaksi terakhir</div>

                <table>
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatMasuk as $r)
                            <tr>
                                <td>{{ $r->nama }}</td>
                                <td>{{ $r->nama_supplier ?? '-' }}</td>
                                <td><span class="badge badge-in">+{{ $r->jumlah }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;color:#999;">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h3>📤 Riwayat Barang Keluar</h3>
                <div class="sub">10 transaksi terakhir</div>

                <table>
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatKeluar as $r)
                            <tr>
                                <td>{{ $r->nama }}</td>
                                <td><span class="badge badge-out">-{{ $r->jumlah }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;color:#999;">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = {!! json_encode($chartLabels ?? []) !!};
const dataMasuk = {!! json_encode($chartMasuk ?? []) !!};
const dataKeluar = {!! json_encode($chartKeluar ?? []) !!};

new Chart(document.getElementById('stockChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Barang Masuk',
                data: dataMasuk,
                borderColor: '#27ae60',
                backgroundColor: 'rgba(39,174,96,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            },
            {
                label: 'Barang Keluar',
                data: dataKeluar,
                borderColor: '#e74c3c',
                backgroundColor: 'rgba(231,76,60,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }
        ]
    },
    options: {
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

@endsection