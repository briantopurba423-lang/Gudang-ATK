@extends('layouts.main')

@section('title', 'Dashboard Admin - ATK Stok Sistem')

@section('style')
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --sidebar-bg: #34495e; --sidebar-hover: #2c3e50; --sidebar-active: #1e73d8;
    --primary: #1e73d8; --success: #27ae60; --danger: #e74c3c; --warning: #f39c12;
    --card-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }
  html, body { width: 100%; height: 100%; overflow-x: hidden; background: #f1f5f9; font-family: 'Segoe UI', Arial, sans-serif; }
  .sidebar { width: 240px; min-height: 100vh; background: var(--sidebar-bg); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 100; box-shadow: 2px 0 8px rgba(0,0,0,0.15); overflow-y: auto; }
  .sidebar-brand { padding: 24px 20px 16px; color: #fff; font-size: 18px; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
  .sidebar-nav { flex: 1; padding: 12px 0; }
  .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.75); cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent; }
  .nav-item:hover { background: var(--sidebar-hover); color: #fff; border-left-color: rgba(255,255,255,0.3); }
  .nav-item.active { background: rgba(30,115,216,0.25); color: #fff; border-left-color: var(--primary); }
  .nav-item .icon { font-size: 18px; width: 22px; text-align: center; }
  .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.1); }
  .btn-logout { display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 14px; background: rgba(231,76,60,0.15); color: #e74c3c; border: 1px solid rgba(231,76,60,0.3); border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.2s; }
  .btn-logout:hover { background: #e74c3c; color: #fff; }
  .main-content { margin-left: 240px; width: calc(100% - 240px); min-height: 100vh; padding: 28px; background: #f1f5f9; }
  .page-section { display: none; }
  .page-section.active { display: block; }
  .page-header { margin-bottom: 24px; }
  .page-header h1 { font-size: 22px; font-weight: 700; color: #1e293b; }
  .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 18px; margin-bottom: 28px; }
  .stat-card { background: #fff; border-radius: 10px; padding: 20px 22px; box-shadow: var(--card-shadow); display: flex; align-items: center; gap: 16px; }
  .stat-icon { font-size: 32px; width: 52px; height: 52px; display: flex; align-items: center; justify-content: center; border-radius: 10px; }
  .stat-icon.blue { background: #dbeafe; } .stat-icon.green { background: #dcfce7; } .stat-icon.orange { background: #ffedd5; } .stat-icon.red { background: #fee2e2; }
  .stat-info .label { font-size: 12px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
  .stat-info .value { font-size: 26px; font-weight: 700; color: #1e293b; margin-top: 2px; }
  .alert-success { background: #dcfce7; border: 1px solid #86efac; border-radius: 8px; padding: 12px 18px; margin-bottom: 20px; color: #166534; font-size: 14px; font-weight: 500; }
  .alert-danger { background: #fee2e2; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 18px; margin-bottom: 20px; color: #991b1b; font-size: 14px; font-weight: 500; }
  .card { background: #fff; border-radius: 10px; box-shadow: var(--card-shadow); overflow: hidden; margin-bottom: 24px; }
  .card-header { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
  .card-header h3 { font-size: 15px; font-weight: 600; color: #1e293b; }
  .card-body { padding: 20px; }
  table { width: 100%; border-collapse: collapse; font-size: 14px; }
  thead th { background: #f8fafc; padding: 10px 14px; text-align: left; font-weight: 600; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; }
  tbody td { padding: 11px 14px; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover { background: #f8fafc; }
  .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
  .badge-success { background: #dcfce7; color: #166534; } .badge-warning { background: #fef9c3; color: #854d0e; } .badge-danger { background: #fee2e2; color: #991b1b; }
  .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; }
  .form-group { display: flex; flex-direction: column; gap: 5px; }
  .form-group label { font-size: 13px; font-weight: 600; color: #475569; }
  .form-control { padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; background: #fff; transition: border-color 0.2s; width: 100%; }
  .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(30,115,216,0.1); }
  .btn { padding: 9px 18px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
  .btn-primary { background: var(--primary); color: #fff; } .btn-primary:hover { background: #1558a8; }
  .btn-success { background: var(--success); color: #fff; } .btn-success:hover { background: #1e8449; }
  .btn-danger  { background: var(--danger);  color: #fff; } .btn-danger:hover  { background: #c0392b; }
  .btn-warning { background: var(--warning); color: #fff; } .btn-warning:hover { background: #d68910; }
  .btn-sm { padding: 5px 12px; font-size: 12px; }
  .modal-backdrop { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 999; align-items: center; justify-content: center; }
  .modal-backdrop.open { display: flex; }
  .modal-box { background: #fff; border-radius: 12px; padding: 28px; width: 100%; max-width: 480px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
  .modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
  .modal-header h3 { font-size: 17px; font-weight: 700; color: #1e293b; }
  .modal-close { background: none; border: none; font-size: 22px; cursor: pointer; color: #94a3b8; line-height: 1; }
  .modal-close:hover { color: #e74c3c; }
  .modal-footer { margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px; }
  @media (max-width: 768px) {
    .sidebar { width: 200px; }
    .main-content { margin-left: 200px; padding: 16px; }
    .stat-grid { grid-template-columns: 1fr 1fr; }
  }
</style>
@endsection

@section('content')
<div style="display:flex; width:100%; min-height:100vh;">

  {{-- SIDEBAR --}}
  <aside class="sidebar">
    <div class="sidebar-brand">📦 ATK Stok Sistem</div>
    <nav class="sidebar-nav">
      <div class="nav-item active" id="nav-dashboard" onclick="showPage('dashboard')">
        <span class="icon">🏠</span> Dashboard
      </div>
      <div class="nav-item" id="nav-kategori" onclick="showPage('kategori')">
        <span class="icon">🏷️</span> Kategori
      </div>
      <div class="nav-item" id="nav-barang" onclick="showPage('barang')">
        <span class="icon">📦</span> Data Barang
      </div>
      <div class="nav-item" id="nav-supplier" onclick="showPage('supplier')">
        <span class="icon">🏭</span> Data Supplier
      </div>
      <div class="nav-item" id="nav-masuk" onclick="showPage('masuk')">
        <span class="icon">📥</span> Barang Masuk
      </div>
      <div class="nav-item" id="nav-keluar" onclick="showPage('keluar')">
        <span class="icon">📤</span> Barang Keluar
      </div>
    </nav>
    <div class="sidebar-footer">
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn-logout">
      <span>🚪</span> Keluar
    </button>
  </form>
</div>
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="main-content">

    @if(session('success'))
      <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-danger">❌ {{ session('error') }}</div>
    @endif

    {{-- ===== DASHBOARD ===== --}}
    <section class="page-section active" id="page-dashboard">
      <div class="page-header"><h1>Dashboard Admin</h1></div>

      <div class="stat-grid">
        <div class="stat-card">
          <div class="stat-icon blue">📦</div>
          <div class="stat-info"><div class="label">Total Barang</div><div class="value">{{ $totalBarang }}</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">🏭</div>
          <div class="stat-info"><div class="label">Total Supplier</div><div class="value">{{ $totalSupplier }}</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">📥</div>
          <div class="stat-info"><div class="label">Total Masuk</div><div class="value">{{ $barangMasuk }}</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon red">📤</div>
          <div class="stat-info"><div class="label">Total Keluar</div><div class="value">{{ $barangKeluar }}</div></div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>📋 Ringkasan Stok Barang</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Min. Stok</th><th>Status</th></tr>
            </thead>
            <tbody>
              @forelse($barang as $i => $b)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td><code>{{ $b->kode_barang }}</code></td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->kategori->nama ?? '-' }}</td>
                <td><strong>{{ $b->stok }}</strong></td>
                <td>{{ $b->stok_minimum }}</td>
                <td>
                  @if($b->stok <= 0)
                    <span class="badge badge-danger">� Habis</span>
                  @elseif($b->stok <= $b->stok_minimum)
                    <span class="badge badge-warning">⚠️ Menipis</span>
                  @else
                    <span class="badge badge-success">✅ Aman</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr><td colspan="7" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada data barang.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="card">
          <div class="card-header"><h3>� Riwayat Barang Masuk</h3></div>
          <div style="overflow-x:auto;">
            <table>
              <thead><tr><th>Nama Barang</th><th>Supplier</th><th>Jumlah</th><th>Tanggal</th></tr></thead>
              <tbody>
                @forelse($riwayatMasuk as $r)
                <tr>
                  <td>{{ $r->nama }}</td>
                  <td>{{ $r->nama_supplier ?? '-' }}</td>
                  <td><span class="badge badge-success">+{{ $r->jumlah }}</span></td>
                  <td>{{ $r->tanggal }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#94a3b8; padding:16px;">Belum ada riwayat.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><h3>📤 Riwayat Barang Keluar</h3></div>
          <div style="overflow-x:auto;">
            <table>
              <thead><tr><th>Nama Barang</th><th>Jumlah</th><th>Tanggal</th></tr></thead>
              <tbody>
                @forelse($riwayatKeluar as $r)
                <tr>
                  <td>{{ $r->nama }}</td>
                  <td><span class="badge badge-danger">-{{ $r->jumlah }}</span></td>
                  <td>{{ $r->tanggal }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center; color:#94a3b8; padding:16px;">Belum ada riwayat.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    {{-- ===== KATEGORI ===== --}}
    <section class="page-section" id="page-kategori">
      <div class="page-header"><h1>🏷️ Kategori</h1></div>
      <div class="card">
        <div class="card-header"><h3>Tambah Kategori</h3></div>
        <div class="card-body">
          <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Alat Tulis" required>
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi singkat (opsional)">
              </div>
            </div>
            <div style="margin-top:14px;">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Daftar Kategori</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Nama Kategori</th><th>Deskripsi</th><th>Jumlah Barang</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              @forelse($kategori as $i => $k)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->deskripsi ?? '-' }}</td>
                <td><span class="badge badge-success">{{ $k->barangs_count }}</span></td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick="openEditKategori({{ $k->id }}, '{{ addslashes($k->nama) }}', '{{ addslashes($k->deskripsi ?? '') }}')">✏️ Edit</button>
                  <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="5" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada kategori.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ===== BARANG ===== --}}
    <section class="page-section" id="page-barang">
      <div class="page-header"><h1>📦 Data Barang</h1></div>
      <div class="card">
        <div class="card-header"><h3>Tambah Barang</h3></div>
        <div class="card-body">
          <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Pulpen Hitam" required>
              </div>
              <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stok" class="form-control" placeholder="0" min="0" required>
              </div>
              <div class="form-group">
                <label>Stok Minimum</label>
                <input type="number" name="stok_minimum" class="form-control" placeholder="5" min="0" value="5">
              </div>
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" class="form-control">
                  <option value="">-- Pilih Supplier --</option>
                  @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div style="margin-top:14px;">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Daftar Barang</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Supplier</th><th>Stok</th><th>Min. Stok</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              @forelse($barang as $i => $b)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td><code>{{ $b->kode_barang }}</code></td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->kategori->nama ?? '-' }}</td>
                <td>{{ $b->supplier->nama ?? '-' }}</td>
                <td><strong>{{ $b->stok }}</strong></td>
                <td>{{ $b->stok_minimum }}</td>
                <td>
                  @if($b->stok <= 0)
                    <span class="badge badge-danger">🔴 Habis</span>
                  @elseif($b->stok <= $b->stok_minimum)
                    <span class="badge badge-warning">⚠️ Menipis</span>
                  @else
                    <span class="badge badge-success">✅ Aman</span>
                  @endif
                </td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick="openEditBarang({{ $b->id }}, '{{ addslashes($b->nama) }}', {{ $b->stok }}, {{ $b->stok_minimum }}, {{ $b->kategori_id ?? 'null' }}, {{ $b->supplier_id ?? 'null' }})">✏️ Edit</button>
                  <form action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus barang ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="9" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada data barang.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ===== SUPPLIER ===== --}}
    <section class="page-section" id="page-supplier">
      <div class="page-header"><h1>🏭 Data Supplier</h1></div>
      <div class="card">
        <div class="card-header"><h3>Tambah Supplier</h3></div>
        <div class="card-body">
          <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama perusahaan" required>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" placeholder="No. HP">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap">
              </div>
            </div>
            <div style="margin-top:14px;">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Daftar Supplier</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Nama Supplier</th><th>Kontak</th><th>Alamat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              @forelse($supplier as $i => $s)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->kontak ?? '-' }}</td>
                <td>{{ $s->alamat ?? '-' }}</td>
                <td>
                  <button class="btn btn-warning btn-sm" onclick="openEditSupplier({{ $s->id }}, '{{ addslashes($s->nama) }}', '{{ addslashes($s->kontak ?? '') }}', '{{ addslashes($s->alamat ?? '') }}')">✏️ Edit</button>
                  <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus supplier ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="5" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada data supplier.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ===== BARANG MASUK ===== --}}
    <section class="page-section" id="page-masuk">
      <div class="page-header"><h1>📥 Barang Masuk</h1></div>
      <div class="card">
        <div class="card-header"><h3>Catat Barang Masuk</h3></div>
        <div class="card-body">
          <form action="{{ route('masuk') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label>Pilih Barang</label>
                <select name="id_barang" class="form-control" required>
                  <option value="">-- Pilih Barang --</option>
                  @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }} (Stok: {{ $b->stok }})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" class="form-control">
                  <option value="">-- Pilih Supplier (opsional) --</option>
                  @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" placeholder="0" min="1" required>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
              </div>
            </div>
            <div style="margin-top:14px;">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Riwayat Barang Masuk</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Nama Barang</th><th>Supplier</th><th>Jumlah</th><th>Tanggal</th></tr>
            </thead>
            <tbody>
              @forelse($riwayatMasuk as $i => $r)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->nama_supplier ?? '-' }}</td>
                <td><span class="badge badge-success">+{{ $r->jumlah }}</span></td>
                <td>{{ $r->tanggal }}</td>
              </tr>
              @empty
              <tr><td colspan="5" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada riwayat barang masuk.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

    {{-- ===== BARANG KELUAR ===== --}}
    <section class="page-section" id="page-keluar">
      <div class="page-header"><h1>📤 Barang Keluar</h1></div>
      <div class="card">
        <div class="card-header"><h3>Catat Barang Keluar</h3></div>
        <div class="card-body">
          <form action="{{ route('keluar') }}" method="POST">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label>Pilih Barang</label>
                <select name="id_barang" class="form-control" required>
                  <option value="">-- Pilih Barang --</option>
                  @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }} (Stok: {{ $b->stok }})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" placeholder="0" min="1" required>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
              </div>
            </div>
            <div style="margin-top:14px;">
              <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header"><h3>Riwayat Barang Keluar</h3></div>
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr><th>#</th><th>Nama Barang</th><th>Jumlah</th><th>Tanggal</th></tr>
            </thead>
            <tbody>
              @forelse($riwayatKeluar as $i => $r)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->nama }}</td>
                <td><span class="badge badge-danger">-{{ $r->jumlah }}</span></td>
                <td>{{ $r->tanggal }}</td>
              </tr>
              @empty
              <tr><td colspan="4" style="text-align:center; color:#94a3b8; padding:24px;">Belum ada riwayat barang keluar.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </main>
</div>

{{-- ===== MODAL EDIT BARANG ===== --}}
<div class="modal-backdrop" id="modal-edit-barang" onclick="handleBackdropClick(event, 'modal-edit-barang')">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="modal-header">
      <h3>✏️ Edit Barang</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-barang')">&times;</button>
    </div>
    <form id="form-edit-barang" method="POST">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama" id="edit-barang-nama" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" name="stok" id="edit-barang-stok" class="form-control" min="0" required>
        </div>
        <div class="form-group">
          <label>Stok Minimum</label>
          <input type="number" name="stok_minimum" id="edit-barang-stok-min" class="form-control" min="0">
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select name="kategori_id" id="edit-barang-kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
              <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <select name="supplier_id" id="edit-barang-supplier" class="form-control">
            <option value="">-- Pilih Supplier --</option>
            @foreach($supplier as $s)
              <option value="{{ $s->id }}">{{ $s->nama }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="background:#e2e8f0; color:#475569;" onclick="closeModal('modal-edit-barang')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== MODAL EDIT KATEGORI ===== --}}
<div class="modal-backdrop" id="modal-edit-kategori" onclick="handleBackdropClick(event, 'modal-edit-kategori')">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="modal-header">
      <h3>✏️ Edit Kategori</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-kategori')">&times;</button>
    </div>
    <form id="form-edit-kategori" method="POST">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" name="nama" id="edit-kategori-nama" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" id="edit-kategori-deskripsi" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="background:#e2e8f0; color:#475569;" onclick="closeModal('modal-edit-kategori')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== MODAL EDIT SUPPLIER ===== --}}
<div class="modal-backdrop" id="modal-edit-supplier" onclick="handleBackdropClick(event, 'modal-edit-supplier')">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="modal-header">
      <h3>✏️ Edit Supplier</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-supplier')">&times;</button>
    </div>
    <form id="form-edit-supplier" method="POST">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-group">
          <label>Nama Supplier</label>
          <input type="text" name="nama" id="edit-supplier-nama" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kontak</label>
          <input type="text" name="kontak" id="edit-supplier-kontak" class="form-control">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" id="edit-supplier-alamat" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="background:#e2e8f0; color:#475569;" onclick="closeModal('modal-edit-supplier')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  function showPage(name) {
    document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    const section = document.getElementById('page-' + name);
    const nav = document.getElementById('nav-' + name);
    if (section) section.classList.add('active');
    if (nav) nav.classList.add('active');
  }

  function openModal(id) { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }
  function handleBackdropClick(e, id) {
    if (e.target === document.getElementById(id)) closeModal(id);
  }

  function openEditBarang(id, nama, stok, stokMin, kategoriId, supplierId) {
    document.getElementById('form-edit-barang').action = '/barang/' + id;
    document.getElementById('edit-barang-nama').value = nama;
    document.getElementById('edit-barang-stok').value = stok;
    document.getElementById('edit-barang-stok-min').value = stokMin;
    const selKat = document.getElementById('edit-barang-kategori');
    const selSup = document.getElementById('edit-barang-supplier');
    if (selKat) selKat.value = kategoriId ?? '';
    if (selSup) selSup.value = supplierId ?? '';
    openModal('modal-edit-barang');
  }

  function openEditKategori(id, nama, deskripsi) {
    document.getElementById('form-edit-kategori').action = '/kategori/' + id;
    document.getElementById('edit-kategori-nama').value = nama;
    document.getElementById('edit-kategori-deskripsi').value = deskripsi;
    openModal('modal-edit-kategori');
  }

  function openEditSupplier(id, nama, kontak, alamat) {
    document.getElementById('form-edit-supplier').action = '/supplier/' + id;
    document.getElementById('edit-supplier-nama').value = nama;
    document.getElementById('edit-supplier-kontak').value = kontak;
    document.getElementById('edit-supplier-alamat').value = alamat;
    openModal('modal-edit-supplier');
  }

  setTimeout(() => {
    document.querySelectorAll('.alert-success, .alert-danger').forEach(el => {
      el.style.transition = 'opacity 0.5s';
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 500);
    });
  }, 3000);

  const hash = window.location.hash.replace('#', '');
  if (hash) showPage(hash);
</script>
@endsection
