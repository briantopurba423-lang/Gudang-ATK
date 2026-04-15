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
background:#eef2f7;
}

/* HEADER */
header{
background:linear-gradient(135deg,#4facfe,#6a11cb);
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
color:#4facfe;
text-decoration:none;
border-radius:30px;
font-weight:bold;
transition:0.3s;
}

.btn:hover{
background:#ffd700;
color:black;
}

/* SECTION */
section{
padding:60px 20px;
text-align:center;
}

/* FEATURES */
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
border-radius:15px;
box-shadow:0 6px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:translateY(-10px);
}

.card h3{
color:#6a11cb;
}

/* STAT */
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
border-radius:12px;
width:200px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
transition:0.3s;
}

.stat-box:hover{
transform:scale(1.05);
}

.stat-box h2{
color:#4facfe;
}

/* CONTACT */
.contact{
background:linear-gradient(135deg,#f6f9ff,#e0e7ff);
}

.contact-form{
max-width:500px;
margin:auto;
display:flex;
flex-direction:column;
gap:15px;
}

.contact-form input,
.contact-form textarea{
padding:12px;
border-radius:10px;
border:1px solid #ccc;
font-size:14px;
}

.contact-form button{
padding:12px;
border:none;
background:linear-gradient(135deg,#4facfe,#6a11cb);
color:white;
border-radius:25px;
cursor:pointer;
transition:0.3s;
}

.contact-form button:hover{
opacity:0.85;
}

/* FOOTER */
.footer{
background:#1e293b;
color:#cbd5e1;
padding:30px 20px;
text-align:center;
}

.footer p{
margin:5px 0;
font-size:14px;
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

<!-- CONTACT -->
<section class="contact">

<h2>Hubungi Kami</h2>
<p>Silakan kirim pesan jika ada pertanyaan</p>

<form class="contact-form" onsubmit="kirimPesan(event)">
<input type="text" id="nama" placeholder="Nama Anda" required>
<input type="email" id="email" placeholder="Email" required>
<textarea id="pesan" rows="5" placeholder="Pesan..." required></textarea>
<button type="submit">Kirim Pesan</button>
</form>

</section>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 ATK Stock System</p>
<p>Email: support@atkstock.com | Telp: 0812-xxxx-xxxx</p>
</footer>

<script>
function kirimPesan(e){
e.preventDefault();

let nama = document.getElementById("nama").value;

alert("Terima kasih " + nama + "! Pesan kamu sudah dikirim 😊");

document.querySelector(".contact-form").reset();
}
</script>

</body>
</html>