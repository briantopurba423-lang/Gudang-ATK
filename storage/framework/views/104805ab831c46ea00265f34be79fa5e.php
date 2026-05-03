<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATK Stock System</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f8fafc; color: #1e293b; }

        /* NAVBAR */
        nav {
            position: fixed; top: 0; width: 100%; z-index: 100;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);
            padding: 16px 40px; display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 1px 10px rgba(0,0,0,0.08);
        }
        nav .logo { font-size: 20px; font-weight: bold; color: #4f46e5; }
        nav .logo span { color: #0ea5e9; }
        nav a.nav-btn {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: white; padding: 10px 24px; border-radius: 25px;
            text-decoration: none; font-size: 14px; font-weight: bold;
            transition: opacity 0.2s;
        }
        nav a.nav-btn:hover { opacity: 0.85; }

        /* HERO */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #4f46e5 0%, #0ea5e9 50%, #06b6d4 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding: 100px 20px 60px; color: white;
        }
        .hero .tag {
            background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);
            padding: 6px 18px; border-radius: 20px; font-size: 13px; margin-bottom: 24px;
            display: inline-block;
        }
        .hero h1 { font-size: 52px; font-weight: 800; line-height: 1.2; margin-bottom: 20px; }
        .hero h1 span { color: #fde68a; }
        .hero p { font-size: 18px; opacity: 0.9; max-width: 560px; margin-bottom: 36px; line-height: 1.7; }
        .hero-btns { display: flex; gap: 16px; flex-wrap: wrap; justify-content: center; margin-bottom: 60px; }
        .btn-white {
            background: white; color: #4f46e5; padding: 14px 32px; border-radius: 30px;
            text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.2s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
        .btn-outline {
            background: transparent; color: white; padding: 14px 32px; border-radius: 30px;
            text-decoration: none; font-weight: bold; font-size: 15px;
            border: 2px solid rgba(255,255,255,0.6); transition: 0.2s;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.15); }

        /* STATS */
        .stats {
            display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;
        }
        .stat-card {
            background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 24px 36px; border-radius: 16px; text-align: center; min-width: 160px;
        }
        .stat-card .num { font-size: 42px; font-weight: 800; color: #fde68a; }
        .stat-card p { font-size: 13px; opacity: 0.85; margin-top: 4px; }

        /* SECTION */
        section { padding: 80px 20px; }
        .section-title { text-align: center; margin-bottom: 50px; }
        .section-title h2 { font-size: 34px; font-weight: 800; color: #1e293b; margin-bottom: 12px; }
        .section-title p { color: #64748b; font-size: 16px; max-width: 500px; margin: auto; }

        /* FEATURES */
        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px; max-width: 1100px; margin: auto;
        }
        .feature-card {
            background: white; padding: 32px 24px; border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: 0.3s; text-align: center;
            border-top: 4px solid transparent;
        }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .feature-card:nth-child(1) { border-color: #4f46e5; }
        .feature-card:nth-child(2) { border-color: #0ea5e9; }
        .feature-card:nth-child(3) { border-color: #10b981; }
        .feature-card:nth-child(4) { border-color: #f59e0b; }
        .feature-card:nth-child(5) { border-color: #ef4444; }
        .feature-card:nth-child(6) { border-color: #8b5cf6; }
        .feature-card .icon { font-size: 40px; margin-bottom: 16px; }
        .feature-card h3 { font-size: 17px; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
        .feature-card p { color: #64748b; font-size: 14px; line-height: 1.6; }

        /* HOW IT WORKS */
        .how-bg { background: linear-gradient(135deg, #f0f4ff, #e8f4fd); }
        .steps { display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; max-width: 900px; margin: auto; }
        .step {
            background: white; padding: 28px 24px; border-radius: 16px; text-align: center;
            flex: 1; min-width: 200px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }
        .step .num-circle {
            width: 50px; height: 50px; border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: white; font-size: 20px; font-weight: bold;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;
        }
        .step h3 { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
        .step p { color: #64748b; font-size: 13px; line-height: 1.6; }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: white; text-align: center; padding: 80px 20px;
        }
        .cta h2 { font-size: 36px; font-weight: 800; margin-bottom: 16px; }
        .cta p { font-size: 16px; opacity: 0.9; margin-bottom: 36px; }

        /* FOOTER */
        footer {
            background: #0f172a; color: #94a3b8; padding: 40px 20px; text-align: center;
        }
        footer .footer-logo { font-size: 22px; font-weight: bold; color: white; margin-bottom: 12px; }
        footer p { font-size: 17px; margin: 4px 0; }
        footer .footer-links { margin: 16px 0; display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        footer .footer-links a { color: #94a3b8; text-decoration: none; font-size: 13px; }
        footer .footer-links a:hover { color: white; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="logo">📦 ATK <span>Stock</span></div>
    <a href="<?php echo e(route('about')); ?>" class="nav-btn">Tentang</a>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="tag">✨ Sistem Manajemen Gudang ATK</div>
    <h1>Kelola Stok ATK<br><span>Lebih Mudah & Efisien</span></h1>
    <p>Pantau barang masuk, keluar, dan stok gudang secara real-time. Solusi digital untuk manajemen alat tulis kantor yang akurat.</p>
    <div class="hero-btns">
        <a href="<?php echo e(route('login.form')); ?>" class="btn-white">🚀 Mulai Sekarang</a>
        <a href="#fitur" class="btn-outline">Lihat Fitur</a>
    </div>
    <div class="stats">
        <div class="stat-card">
            <div class="num"><?php echo e($totalBarang); ?></div>
            <p>Jenis Barang</p>
        </div>
        <div class="stat-card">
            <div class="num"><?php echo e($totalSupplier); ?></div>
            <p>Supplier</p>
        </div>
        <div class="stat-card">
            <div class="num"><?php echo e($barangMasuk); ?></div>
            <p>Total Masuk</p>
        </div>
        <div class="stat-card">
            <div class="num"><?php echo e($barangKeluar); ?></div>
            <p>Total Keluar</p>
        </div>
    </div>
</section>

<section>


<!-- FITUR -->
<section id="fitur">
    <div class="section-title">
        <h2>Fitur Unggulan</h2>
        <p>Semua yang kamu butuhkan untuk mengelola stok ATK dalam satu sistem</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="icon">🏷️</div>
            <h3>Kategori Barang</h3>
            <p>Kelompokkan barang berdasarkan kategori agar lebih terorganisir dan mudah dicari.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📋</div>
            <h3>Data Barang</h3>
            <p>Tambah, edit, dan hapus data barang lengkap dengan kode unik otomatis.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📥</div>
            <h3>Barang Masuk</h3>
            <p>Catat setiap penerimaan barang dan stok terupdate secara otomatis.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📤</div>
            <h3>Barang Keluar</h3>
            <p>Kontrol pengeluaran barang dengan validasi stok agar tidak minus.</p>
        </div>
        <div class="feature-card">
            <div class="icon">🏭</div>
            <h3>Data Supplier</h3>
            <p>Simpan informasi supplier untuk memudahkan proses pengadaan barang.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📊</div>
            <h3>Dashboard Realtime</h3>
            <p>Pantau statistik stok, status barang, dan riwayat transaksi dari satu halaman.</p>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section class="how-bg">
    <div class="section-title">
        <h2>Cara Kerja</h2>
        <p>Hanya 3 langkah untuk mulai mengelola stok ATK kamu</p>
    </div>
    <div class="steps">
        <div class="step">
            <div class="num-circle">1</div>
            <h3>Login ke Sistem</h3>
            <p>Masuk menggunakan akun yang telah diberikan admin.</p>
        </div>
        <div class="step">
            <div class="num-circle">2</div>
            <h3>Input Data Barang</h3>
            <p>Tambahkan data barang beserta kategori dan stok awal.</p>
        </div>
        <div class="step">
            <div class="num-circle">3</div>
            <h3>Catat Transaksi</h3>
            <p>Catat barang masuk dan keluar, stok otomatis terupdate.</p>
        </div>
    </div>
</section>


<!-- FOOTER -->
<footer>
    <div class="footer-logo">📦 ATK Stock System</div>
    <p>© 2026 ATK Stock System. All rights reserved.</p>
    <p style="margin-top:15px;">Email: stokgudangatk@gmail.com | Telp: 0812-6481-0914</p>
</footer>

</body>
</html>
<?php /**PATH C:\laragon\www\laravel-1\Gudang-ATK\resources\views/01home.blade.php ENDPATH**/ ?>