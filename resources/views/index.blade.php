<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ATK System</title>
    <style>
        body { margin: 0; font-family: Arial; display: flex; background: #f4f4f4; height: 100vh; }
        .sidebar { width: 220px; background: #34495e; color: white; padding: 20px 0; display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; margin-bottom: 20px; }
        .sidebar a { display: block; color: white; padding: 15px; text-decoration: none; cursor: pointer; }
        .sidebar a:hover { background: #2c3e50; }
        .sidebar .logout { background: #e74c3c; margin-top: auto; text-align: center; }

        .main { flex: 1; padding: 20px; overflow-y: auto; }
        .card { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #1e73d8; color: white; }
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>ATK System</h2>
    <a onclick="showPage('dashboard')">Dashboard</a>
    <a onclick="showPage('barang')">Data Barang</a>
    <a onclick="showPage('supplier')">Data Supplier</a>
    <a onclick="showPage('masuk')">Barang Masuk</a>
    <a onclick="showPage('keluar')">Barang Keluar</a>

    <!-- Logout Laravel -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout">Logout</button>
    </form>
</div>

<div class="main">

    <!-- DASHBOARD -->
    <div id="dashboard">
        <h1>Dashboard ATK</h1>
        <div style="display:flex; gap:20px">
            <div class="card" style="flex:1">
                <h3>Total Barang</h3>
                <p style="font-size:32px">{{ $totalBarang }}</p>
            </div>

            <div class="card" style="flex:1">
                <h3>Total Supplier</h3>
                <p style="font-size:32px">{{ $totalSupplier }}</p>
            </div>
        </div>
    </div>

    <!-- DATA BARANG -->
    <div id="barang" class="hidden">
        <h2>Data Barang</h2>

        <form method="POST" action="{{ route('barang.store') }}">
            @csrf
            <input type="text" name="nama" placeholder="Nama Barang">
            <input type="number" name="stok" placeholder="Stok">
            <button type="submit">Tambah</button>
        </form>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            @foreach($barang as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->stok }}</td>
                <td>
                    <form action="{{ route('barang.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- SUPPLIER -->
    <div id="supplier" class="hidden">
        <h2>Supplier</h2>

        <form method="POST" action="{{ route('supplier.store') }}">
            @csrf
            <input type="text" name="nama" placeholder="Nama Supplier">
            <input type="text" name="kontak" placeholder="Kontak">
            <button type="submit">Tambah</button>
        </form>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kontak</th>
            </tr>

            @foreach($supplier as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->kontak }}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<script>
function showPage(page) {
    document.querySelectorAll(".main > div").forEach(div => div.classList.add("hidden"));
    document.getElementById(page).classList.remove("hidden");
    sessionStorage.setItem('page', page);
}

window.onload = function() {
    const page = sessionStorage.getItem('page') || 'dashboard';
    showPage(page);
}
</script>

</body>
</html>