
@extends('layouts.main')

@section('title', 'Produk ATK')

@section('style')
<style>
    .form-input{
    width:100%;
    margin-top:6px;
    padding:10px 12px;
    border:1px solid #dbeafe;
    border-radius:8px;
    outline:none;
    font-size:14px;
}

.form-input:focus{
    border-color:#4f46e5;
}

.btn-save{
    margin-top:20px;
    background:#4f46e5;
    color:white;
    border:none;
    padding:11px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:700;
}

.btn-save:hover{
    background:#4338ca;
}
.tb-head{
    text-align:left;
    padding:14px;
    font-size:13px;
    color:#475569;
    border-bottom:1px solid #e2e8f0;
}

.tb-data{
    padding:14px;
    font-size:14px;
    border-bottom:1px solid #f1f5f9;
}
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f8fafc; }

    .product-wrap {
        padding: 100px 40px 60px;
        max-width: 1200px;
        margin: auto;
    }

    .product-wrap h1 {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .product-wrap .sub {
        color: #64748b;
        margin-bottom: 32px;
        font-size: 15px;
    }

    /* Filter bar */
    .filter-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 28px;
        align-items: center;
    }

    .filter-bar input {
        padding: 9px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        flex: 1;
        min-width: 200px;
        outline: none;
    }

    .filter-bar input:focus { border-color: #4f46e5; }

    .filter-bar select {
        padding: 9px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        outline: none;
        cursor: pointer;
    }

    /* Stats */
    .stats-row {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .stat-pill {
        background: white;
        border-radius: 10px;
        padding: 12px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-pill strong { color: #1e293b; font-size: 18px; }

    /* Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        padding: 22px 18px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        transition: transform 0.2s, box-shadow 0.2s;
        border-top: 4px solid #4f46e5;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .product-card.menipis { border-top-color: #f59e0b; }
    .product-card.habis   { border-top-color: #ef4444; opacity: 0.85; }

    .product-card .icon {
        font-size: 32px;
        margin-bottom: 12px;
        display: block;
    }

    .product-card .kode {
        font-size: 11px;
        color: #4f46e5;
        font-family: monospace;
        background: #e8f4fd;
        padding: 2px 8px;
        border-radius: 8px;
        display: inline-block;
        margin-bottom: 8px;
    }

    .product-card h3 {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .product-card .meta {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    .product-card .stok-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
    }

    .product-card .stok-num {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
    }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .badge-ok      { background: #dcfce7; color: #166534; }
    .badge-menipis { background: #fef9c3; color: #854d0e; }
    .badge-habis   { background: #fee2e2; color: #991b1b; }
    .badge-kat     { background: #f0e6ff; color: #6d28d9; font-size: 11px; padding: 2px 8px; border-radius: 8px; }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
        grid-column: 1 / -1;
    }

    .empty-state .icon { font-size: 48px; margin-bottom: 12px; display: block; }
</style>
@endsection

@section('content')
<div class="product-wrap">

    {{-- ===== FORM TAMBAH PRODUK  ===== --}}
    <div style="background:white;padding:24px;border-radius:14px;margin-bottom:30px;box-shadow:0 2px 10px rgba(0,0,0,.06);">
        <h2 style="margin-bottom:18px;font-size:20px;color:#1e293b;">➕ Tambah Produk ATK</h2>

        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:16px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
                <div>
                    <label style="font-size:13px;font-weight:600;color:#475569;">Nama Barang</label>
                    <input type="text" name="nama" required class="form-input" placeholder="Contoh: Pulpen Hitam">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;color:#475569;">Stok Awal</label>
                    <input type="number" name="stok" min="0" required class="form-input" placeholder="0">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;color:#475569;">Stok Minimum</label>
                    <input type="number" name="stok_minimum" min="0" value="5" required class="form-input">
                </div>
                <div>
                    <label style="font-size:13px;font-weight:600;color:#475569;">Kategori</label>
                    <select name="kategori_id" class="form-input">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-save" style="margin-top:18px;">💾 Simpan Produk</button>
        </form>
    </div>

    {{-- ===== TABEL PRODUK ===== --}}
    <div style="background:white;border-radius:14px;margin-bottom:30px;box-shadow:0 2px 10px rgba(0,0,0,.06);overflow:hidden;">
        <div style="padding:18px 24px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
            <h2 style="font-size:18px;color:#1e293b;">📋 Daftar Produk</h2>
            <input type="text" id="tableSearch" placeholder="🔍 Cari..." oninput="filterTable()"
                style="padding:8px 14px;border:1px solid #ddd;border-radius:8px;font-size:13px;outline:none;min-width:200px;">
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th class="tb-head">#</th>
                        <th class="tb-head">Kode</th>
                        <th class="tb-head">Nama Barang</th>
                        <th class="tb-head">Kategori</th>
                        <th class="tb-head">Stok</th>
                        <th class="tb-head">Min. Stok</th>
                        <th class="tb-head">Status</th>
                        <th class="tb-head">Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @forelse($barang as $i => $b)
                    @php
                        $status = $b->stok <= 0 ? 'habis' : ($b->stok <= $b->stok_minimum ? 'menipis' : 'aman');
                    @endphp
                    <tr data-search="{{ strtolower($b->nama . ' ' . $b->kode_barang) }}">
                        <td class="tb-data">{{ $i + 1 }}</td>
                        <td class="tb-data"><code style="background:#e8f4fd;color:#1e73d8;padding:2px 8px;border-radius:6px;font-size:12px;">{{ $b->kode_barang }}</code></td>
                        <td class="tb-data"><strong>{{ $b->nama }}</strong></td>
                        <td class="tb-data">
                            @if($b->kategori)
                                <span style="background:#f0e6ff;color:#6d28d9;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:600;">{{ $b->kategori->nama }}</span>
                            @else
                                <span style="color:#94a3b8;">-</span>
                            @endif
                        </td>
                        <td class="tb-data" style="font-weight:700;font-size:16px;">{{ $b->stok }}</td>
                        <td class="tb-data" style="color:#64748b;">{{ $b->stok_minimum }}</td>
                        <td class="tb-data">
                            @if($status === 'habis')
                                <span style="background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:10px;font-size:12px;font-weight:700;">🔴 Habis</span>
                            @elseif($status === 'menipis')
                                <span style="background:#fef9c3;color:#854d0e;padding:3px 10px;border-radius:10px;font-size:12px;font-weight:700;">⚠️ Menipis</span>
                            @else
                                <span style="background:#dcfce7;color:#166534;padding:3px 10px;border-radius:10px;font-size:12px;font-weight:700;">✅ Aman</span>
                            @endif
                        </td>
                        <td class="tb-data">
                            <form action="{{ url('barang') }}/{{ $b->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:5px 12px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center;padding:32px;color:#94a3b8;">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

   

</div>

<script>
function filterCards() {
    const search   = document.getElementById('searchInput').value.toLowerCase();
    const kategori = document.getElementById('filterKategori').value.toLowerCase();
    const status   = document.getElementById('filterStatus').value.toLowerCase();

    document.querySelectorAll('.product-card').forEach(function(card) {
        const nama    = card.dataset.nama    || '';
        const kode    = card.dataset.kode    || '';
        const kat     = card.dataset.kategori.toLowerCase();
        const stat    = card.dataset.status  || '';

        const matchSearch   = !search   || nama.includes(search) || kode.includes(search);
        const matchKategori = !kategori || kat === kategori;
        const matchStatus   = !status   || stat === status;

        card.style.display = (matchSearch && matchKategori && matchStatus) ? '' : 'none';
    });
}
</script>
@endsection
