<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ATK Stock System</title>

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

header{
background:linear-gradient(90deg,#1e3c72,#2a5298);
color:white;
padding:60px 20px;
text-align:center;
}

header h1{
font-size:40px;
}

.btn{
display:inline-block;
margin-top:20px;
padding:12px 25px;
background:white;
color:#1e3c72;
text-decoration:none;
border-radius:30px;
font-weight:bold;
}

section{
padding:60px 20px;
text-align:center;
}

.features{
display:flex;
flex-wrap:wrap;
justify-content:center;
gap:20px;
}

.card{
background:white;
width:260px;
padding:25px;
border-radius:10px;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.card h3{
color:#1e3c72;
}

.stat{
display:flex;
justify-content:center;
gap:30px;
margin-top:40px;
flex-wrap:wrap;
}

.stat-box{
background:white;
padding:20px;
border-radius:8px;
width:200px;
box-shadow:0 3px 8px rgba(0,0,0,0.1);
}

.stat-box h2{
color:#1e3c72;
}

.footer{
background:#2c3e50;
color:white;
padding:20px;
text-align:center;
}
</style>
</head>

<body>

<header>

<h1>Aplikasi Stok Gudang ATK</h1>

<p>Solusi Digital untuk Manajemen Persediaan ATK</p>

<a href="/login" class="btn">Masuk ke Sistem</a>

<div class="stat">

<div class="stat-box">
<h2>{{ $totalBarang ?? 0 }}</h2>
<p>Total Barang</p>
</div>

<div class="stat-box">
<h2>{{ $barangMasuk ?? 0 }}</h2>
<p>Barang Masuk</p>
</div>

<div class="stat-box">
<h2>{{ $barangKeluar ?? 0 }}</h2>
<p>Barang Keluar</p>
</div>

</div>

</header>

<section>

<h2>Fitur Unggulan</h2>

<div class="features">

<div class="card">
<h3>📦 Data Barang</h3>
<p>Kelola data barang dengan mudah tambah edit dan hapus.</p>
</div>

<div class="card">
<h3>📥 Barang Masuk</h3>
<p>Catat setiap barang masuk dan update stok otomatis.</p>
</div>

<div class="card">
<h3>📤 Barang Keluar</h3>
<p>Kontrol pengeluaran barang agar stok tetap terpantau.</p>
</div>

<div class="card">
<h3>📊 Laporan</h3>
<p>Laporan stok barang secara otomatis.</p>
</div>

</div>

</section>

<section>

<h2>Tentang Aplikasi</h2>

<p>
Aplikasi Stok Gudang ATK membantu perusahaan atau sekolah
mengelola persediaan alat tulis kantor secara digital
agar lebih cepat, akurat, dan efisien.
</p>

</section>

<div class="footer">
© 2026 ATK Stock System
</div>

</body>
</html>