@extends('layouts.main')

@section('title', 'List Produk ATK')

@section('style')
<style>
    * { box-sizing: border-box; }
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; }

    .wrap {
        max-width: 960px;
        margin: 100px auto 60px;
        padding: 0 20px;
    }

    /* ===== FORM INPUT PRODUK ===== */
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 28px 32px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 32px;
    }

    .form-card h1 {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-table { width: 100%; border-collapse: collapse; }
    .form-table td { padding: 10px 8px; vertical-align: middle; }
    .form-table td:first-child {
        font-weight: 600;
        color: #475569;
        font-size: 14px;
        width: 120px;
        white-space: nowrap;
    }

    .form-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 14px;
        color: #1e293b;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }

    textarea.form-control { resize: vertical; min-height: 80px; }

    .btn-primary {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 10px 28px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
        transition: background 0.2s;
    }

    .btn-primary:hover { background: #4338ca; }

    /* ===== ALERT ===== */
    .alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    /* ===== TABEL PRODUK ===== */
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-header h2 {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
    }

    .search-input {
        padding: 8px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        min-width: 200px;
    }

    .search-input:focus { border-color: #4f46e5; }

    .data-table { width: 100%; border-collapse: collapse; font-size: 14px; }

    .data-table thead th {
        background: #4f46e5;
        color: white;
        padding: 12px 16px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
    }

    .data-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }

    .data-table tbody tr:last-child td { border-bottom: none; }
    .data-table tbody tr:hover { background: #f8fafc; }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-ok      { background: #dcfce7; color: #166534; }
    .badge-menipis { background: #fef9c3; color: #854d0e; }
    .badge-habis   { background: #fee2e2; color: #991b1b; }
    .badge-kat     { background: #ede9fe; color: #5b21b6; }
    .badge-kode    { background: #e0f2fe; color: #0369a1; font-family: monospace; }

    .btn-hapus {
        background: #fee2e2;
        color: #991b1b;
        border: none;
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-hapus:hover { background: #fca5a5; }

    .empty-row td {
        text-align: center;
        padding: 32px;
        color: #94a3b8;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="wrap">

    {{-- ===== FORM INPUT PRODUK (Praktikum 9 - A) ===== --}}
    <div class="form-card">
        <h1>Input Produk</h1>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $e) ❌ {{ $e }}<br> @endforeach
            </div>
        @endif

        {{-- Praktikum 9 B: route produk.simpan --}}
        <form method="POST" action="{{ route('produk.simpan') }}">
            @csrf
            <table class="form-table">
                <tr>
                    <td>Nama:</td>
                    <td colspan="3">
                        <input type="text" class="form-control" id="nama" name="nama"
                               value="{{ old('nama') }}" placeholder="Nama barang" required>
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi:</td>
                    <td colspan="3">
                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                  placeholder="Deskripsi barang (opsional)">{{ old('deskripsi') }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Stok:</td>
                    <td>
                        <input type="number" class="form-control" id="stok" name="stok"
                               value="{{ old('stok', 0) }}" min="0" required>
                    </td>
                    <td style="padding-left:16px; font-weight:600; color:#475569; white-space:nowrap;">Stok Min:</td>
                    <td>
                        <input type="number" class="form-control" id="stok_minimum" name="stok_minimum"
                               value="{{ old('stok_minimum', 5) }}" min="0">
                    </td>
                </tr>
                <tr>
                    <td>Kategori:</td>
                    <td colspan="3">
                        <select class="form-control" name="kategori_id">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn-primary">Simpan</button>
        </form>
    </div>

    {{-- ===== TABEL PRODUK (Praktikum 9 - D) ===== --}}
    <div class="table-card">
        <div class="table-header">
            <h2>📋 Daftar Produk ATK</h2>
            <input type="text" class="search-input" id="searchInput"
                   placeholder="🔍 Cari produk..." oninput="filterTable()">
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Min. Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="produkTable">
                    @forelse($data as $i => $b)
                    @php
                        $status = $b->stok <= 0
                            ? 'habis'
                            : ($b->stok <= $b->stok_minimum ? 'menipis' : 'aman');
                    @endphp
                    <tr data-search="{{ strtolower($b->nama . ' ' . $b->kode_barang) }}">
                        <td>{{ $i + 1 }}</td>
                        <td><span class="badge badge-kode">{{ $b->kode_barang }}</span></td>
                        <td><strong>{{ $b->nama }}</strong></td>
                        <td>
                            @if($b->kategori)
                                <span class="badge badge-kat">{{ $b->kategori->nama }}</span>
                            @else
                                <span style="color:#94a3b8;">-</span>
                            @endif
                        </td>
                        <td style="font-weight:700;">{{ $b->stok }}</td>
                        <td style="color:#64748b;">{{ $b->stok_minimum }}</td>
                        <td>
                            @if($status === 'habis')
                                <span class="badge badge-habis">🔴 Habis</span>
                            @elseif($status === 'menipis')
                                <span class="badge badge-menipis">⚠️ Menipis</span>
                            @else
                                <span class="badge badge-ok">✅ Aman</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ url('barang') }}/{{ $b->id }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hapus">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="8">📭 Belum ada data produk. Tambahkan melalui form di atas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function filterTable() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#produkTable tr').forEach(function(row) {
        const text = row.dataset.search || '';
        row.style.display = !q || text.includes(q) ? '' : 'none';
    });
}
</script>
@endsection
