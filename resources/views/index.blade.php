<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ATK System</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial; display: flex; background: #f4f4f4; min-height: 100vh; }

        .sidebar { width: 220px; background: #34495e; color: white; padding: 20px 0; display: flex; flex-direction: column; min-height: 100vh; position: fixed; }
        .sidebar h2 { text-align: center; margin-bottom: 20px; font-size: 18px; }
        .sidebar a { display: block; color: white; padding: 14px 20px; text-decoration: none; cursor: pointer; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background: #2c3e50; border-left: 4px solid #3498db; }
        .sidebar .logout-wrap { margin-top: auto; padding: 10px; }
        .sidebar .logout-wrap button { width: 100%; background: #e74c3c; color: white; border: none; padding: 12px; cursor: pointer; border-radius: 4px; font-size: 14px; }
        .sidebar .logout-wrap button:hover { background: #c0392b; }

        .main { margin-left: 220px; flex: 1; padding: 24px; overflow-y: auto; }

        .cards { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; }
        .card { background: white; padding: 20px 24px; border-radius: 8px; flex: 1; min-width: 150px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .card h3 { margin: 0 0 8px; font-size: 14px; color: #666; }
        .card .num { font-size: 36px; font-weight: bold; color: #2c3e50; margin: 0; }
        .card.blue .num { color: #1e73d8; }
        .card.green .num { color: #27ae60; }
        .card.red .num { color: #e74c3c; }
        .card.purple .num { color: #8e44ad; }

        .section-box { background: white; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .section-box h2 { margin-top: 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }

        .form-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px; align-items: flex-end; }
        .form-row input, .form-row select { padding: 9px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; flex: 1; min-width: 140px; }
        .form-row input:focus, .form-row select:focus { outline: none; border-color: #3498db; }
        .btn { padding: 9px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #1e73d8; color: white; }
        .btn-primary:hover { background: #1558a8; }
        .btn-success { background: #27ae60; color: white; }
        .btn-success:hover { background: #1e8449; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }

        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 10px 12px; border: 1px solid #e0e0e0; text-align: center; }
        th { background: #1e73d8; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }

        .alert { padding: 10px 16px; border-radius: 4px; margin-bottom: 16px; font-size: 14px; }
        .alert-error { background: #fdecea; color: #c0392b; border: 1px solid #f5c6cb; }
        .alert-success { background: #eafaf1; color: #1e8449; border: 1px solid #a9dfbf; }

        .hidden { display: none; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .badge-in  { background: #eafaf1; color: #27ae60; }
        .badge-out { background: #fdecea; color: #e74c3c; }
        .badge-kat { background: #f0e6ff; color: #8e44ad; }
        .badge-kode { background: #e8f4fd; color: #1e73d8; font-family: monospace; }
    </style>
</head>
<body>

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

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- DASHBOARD -->
    <div id="dashboard">
        <h1 style="margin-top:0;color:#2c3e50;">Dashboard ATK</h1>
        <div class="cards">
            <div class="card blue">
                <h3>Total Jenis Barang</h3>
                <p class="num">{{ $totalBarang }}</p>
            </div>
            <div class="card purple">
                <h3>Total Kategori</h3>
                <p class="num">{{ $kategori->count() }}</p>
            </div>
            <div class="card">
                <h3>Total Supplier</h3>
                <p class="num">{{ $totalSupplier }}</p>
            </div>
            <div class="card green">
                <h3>Total Barang Masuk</h3>
                <p class="num">{{ $barangMasuk }}</p>
            </div>
            <div class="card red">
                <h3>Total Barang Keluar</h3>
                <p class="num">{{ $barangKeluar }}</p>
            </div>
        </div>

        <div class="section-box">
            <h2>Ringkasan Stok Barang</h2>
            <table>
                <tr>
                    <th>No</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Status</th>
                </tr>
                @forelse($barang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-kode">{{ $b->kode_barang }}</span></td>
                    <td>{{ $b->nama }}</td>
                    <td>
                        @if($b->kategori)
                            <span class="badge badge-kat">{{ $b->kategori->nama }}</span>
                        @else
                            <span style="color:#aaa">-</span>
                        @endif
                    </td>
                    <td>{{ $b->stok }}</td>
                    <td>
                        @if($b->stok <= 0)
                            <span class="badge badge-out">Habis</span>
                        @elseif($b->stok <= 5)
                            <span class="badge" style="background:#fff3cd;color:#856404;">Menipis</span>
                        @else
                            <span class="badge badge-in">Tersedia</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">Belum ada data barang</td></tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- KATEGORI -->
    <div id="kategori" class="hidden">
        <div class="section-box">
            <h2>🏷️ Kategori Barang</h2>
            <form method="POST" action="{{ route('kategori.store') }}">
                @csrf
                <div class="form-row">
                    <input type="text" name="nama" placeholder="Nama Kategori" required>
                    <input type="text" name="deskripsi" placeholder="Deskripsi (opsional)">
                    <button type="submit" class="btn btn-primary">+ Tambah</button>
                </div>
            </form>
            <table>
                <tr>
                    <th>No</th><th>Nama Kategori</th><th>Deskripsi</th><th>Jumlah Barang</th><th>Aksi</th>
                </tr>
                @forelse($kategori as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-kat">{{ $k->nama }}</span></td>
                    <td>{{ $k->deskripsi ?? '-' }}</td>
                    <td>{{ $k->barangs_count }}</td>
                    <td>
                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="padding:5px 12px;font-size:12px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada kategori</td></tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- DATA BARANG -->
    <div id="barang" class="hidden">
        <div class="section-box">
            <h2>📋 Data Barang</h2>
            <form method="POST" action="{{ route('barang.store') }}">
                @csrf
                <div class="form-row">
                    <input type="text" name="nama" placeholder="Nama Barang" required>
                    <input type="number" name="stok" placeholder="Stok Awal" min="0" required>
                    <select name="kategori_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">+ Tambah</button>
                </div>
            </form>
            <table>
                <tr>
                    <th>No</th><th>Kode Barang</th><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Aksi</th>
                </tr>
                @forelse($barang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge badge-kode">{{ $b->kode_barang }}</span></td>
                    <td>{{ $b->nama }}</td>
                    <td>
                        @if($b->kategori)
                            <span class="badge badge-kat">{{ $b->kategori->nama }}</span>
                        @else
                            <span style="color:#aaa">-</span>
                        @endif
                    </td>
                    <td>{{ $b->stok }}</td>
                    <td>
                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="padding:5px 12px;font-size:12px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">Belum ada data barang</td></tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- SUPPLIER -->
    <div id="supplier" class="hidden">
        <div class="section-box">
            <h2>🏭 Data Supplier</h2>
            <form method="POST" action="{{ route('supplier.store') }}">
                @csrf
                <div class="form-row">
                    <input type="text" name="nama" placeholder="Nama Supplier" required>
                    <input type="text" name="kontak" placeholder="Kontak / No. HP" required>
                    <input type="text" name="alamat" placeholder="Alamat Lengkap">
                    <button type="submit" class="btn btn-primary">+ Tambah</button>
                </div>
            </form>
            <table>
                <tr>
                    <th>No</th><th>Nama Supplier</th><th>Kontak</th><th>Alamat</th><th>Aksi</th>
                </tr>
                @forelse($supplier as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kontak }}</td>
                    <td style="text-align:left;">{{ $s->alamat ?? '-' }}</td>
                    <td>
                        <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus supplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="padding:5px 12px;font-size:12px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada data supplier</td></tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- BARANG MASUK -->
    <div id="masuk" class="hidden">
        <div class="section-box">
            <h2>📥 Barang Masuk</h2>
            <form method="POST" action="{{ route('masuk') }}">
                @csrf
                <div class="form-row">
                    <select name="id_barang" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->kode_barang }} - {{ $b->nama }} (Stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah" placeholder="Jumlah Masuk" min="1" required>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    <button type="submit" class="btn btn-success"> Simpan </button>
                </div>
            </form>
        </div>
        <div class="section-box">
            <h2>Riwayat Barang Masuk</h2>
            <table>
                <tr>
                    <th>No</th><th>Nama Barang</th><th>Jumlah</th><th>Tanggal</th>
                </tr>
                @forelse($riwayatMasuk as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->nama }}</td>
                    <td><span class="badge badge-in">+{{ $r->jumlah }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="4">Belum ada riwayat barang masuk</td></tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- BARANG KELUAR -->
    <div id="keluar" class="hidden">
        <div class="section-box">
            <h2>📤 Barang Keluar</h2>
            <form method="POST" action="{{ route('keluar') }}">
                @csrf
                <div class="form-row">
                    <select name="id_barang" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->kode_barang }} - {{ $b->nama }} (Stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah" placeholder="Jumlah Keluar" min="1" required>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    <button type="submit" class="btn btn-danger"> Simpan </button>
                </div>
            </form>
        </div>
        <div class="section-box">
            <h2>Riwayat Barang Keluar</h2>
            <table>
                <tr>
                    <th>No</th><th>Nama Barang</th><th>Jumlah</th><th>Tanggal</th>
                </tr>
                @forelse($riwayatKeluar as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->nama }}</td>
                    <td><span class="badge badge-out">-{{ $r->jumlah }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="4">Belum ada riwayat barang keluar</td></tr>
                @endforelse
            </table>
        </div>
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

</body>
</html>
