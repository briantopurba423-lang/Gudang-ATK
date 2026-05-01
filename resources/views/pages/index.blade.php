@extends('layouts.main')

@section('title', 'ATK System')

@section('style')
<style>
    body { background:#f4f4f4; }

    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 220px;
        background: #34495e;
        color: white;
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        position: fixed;
        z-index: 200;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 14px 20px;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #2c3e50;
        border-left: 4px solid #3498db;
    }

    .sidebar .logout-wrap {
        margin-top: auto;
        padding: 10px;
    }

    .sidebar .logout-wrap button {
        width: 100%;
        background: #e74c3c;
        color: white;
        border: none;
        padding: 12px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
    }

    .main {
        margin-left: 220px;
        flex: 1;
        padding: 90px 24px 24px;
        overflow-y: auto;
        width: 100%;
    }

    .cards {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .card {
        background: white;
        padding: 20px 24px;
        border-radius: 8px;
        flex: 1;
        min-width: 150px;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }

    .card h3 {
        margin: 0 0 8px;
        font-size: 14px;
        color: #666;
    }

    .card .num {
        font-size: 36px;
        font-weight: bold;
        color: #2c3e50;
        margin: 0;
    }

    .card.blue .num { color: #1e73d8; }
    .card.green .num { color: #27ae60; }
    .card.red .num { color: #e74c3c; }
    .card.purple .num { color: #8e44ad; }

    .section-box {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }

    .section-box h2 {
        margin-top: 0;
        color: #2c3e50;
        font-size: 18px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .form-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        align-items: flex-end;
    }

    .form-row input,
    .form-row select {
        padding: 9px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        flex: 1;
        min-width: 140px;
    }

    .btn {
        padding: 9px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary { background: #1e73d8; color: white; }
    .btn-success { background: #27ae60; color: white; }
    .btn-danger { background: #e74c3c; color: white; }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 10px 12px;
        border: 1px solid #e0e0e0;
        text-align: center;
    }

    th {
        background: #1e73d8;
        color: white;
    }

    tr:nth-child(even) { background: #f9f9f9; }

    .alert {
        padding: 10px 16px;
        border-radius: 4px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .alert-error { background: #fdecea; color: #c0392b; }
    .alert-success { background: #eafaf1; color: #1e8449; }

    .hidden { display: none; }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge-in  { background: #eafaf1; color: #27ae60; }
    .badge-out { background: #fdecea; color: #e74c3c; }
    .badge-kat { background: #f0e6ff; color: #8e44ad; }
    .badge-kode { background: #e8f4fd; color: #1e73d8; font-family: monospace; }
</style>
@endsection

@section('content')

<div class="admin-wrapper">

    <div class="sidebar">
        <h2>📦 ATK System</h2>
        <a onclick="showPage('dashboard')" id="nav-dashboard">🏠 Dashboard</a>
        <a onclick="showPage('kategori')" id="nav-kategori">🏷️ Kategori</a>
        <a onclick="showPage('barang')" id="nav-barang">📋 Data Barang</a>
        <a onclick="showPage('supplier')" id="nav-supplier">🏭 Data Supplier</a>
        <a onclick="showPage('masuk')" id="nav-masuk">📥 Barang Masuk</a>
        <a onclick="showPage('keluar')" id="nav-keluar">📤 Barang Keluar</a>

        <div class="logout-wrap">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <div class="main">

        {{-- PASTE SEMUA ISI BAGIAN DALAM <div class="main"> LAMA KAMU DI SINI --}}
        {{-- Mulai dari @if(session('error')) sampai div id="keluar" --}}

    </div>

</div>

<script>
function showPage(page) {
    document.querySelectorAll(".main > div").forEach(div => div.classList.add("hidden"));
    document.getElementById(page).classList.remove("hidden");

    document.querySelectorAll(".sidebar a").forEach(a => a.classList.remove("active"));

    const nav = document.getElementById('nav-' + page);
    if (nav) nav.classList.add("active");

    sessionStorage.setItem('page', page);
}

window.onload = function() {
    const page = sessionStorage.getItem('page') || 'dashboard';
    showPage(page);
}
</script>

@endsection