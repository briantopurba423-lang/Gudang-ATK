@extends('layouts.main')

@section('title', 'Register - ATK Stock System')

@section('style')
<style>
    .register-wrapper { display:flex; justify-content:center; align-items:center; min-height:100vh; padding-top:60px; }
    .register-box { background:white; padding:36px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); width:360px; text-align:center; }
    .register-box h2 { margin-bottom:8px; color:#1e293b; font-size:20px; }
    .register-box p { color:#64748b; font-size:13px; margin-bottom:20px; }
    .register-box a { display:block; margin-top:14px; font-size:13px; color:#4f46e5; text-decoration:none; }
</style>
@endsection

@section('content')
<div class="register-wrapper">
    <div class="register-box">
        <h2>📦 Daftar Akun</h2>
        <p>Registrasi hanya dapat dilakukan oleh admin.<br>Hubungi admin untuk mendapatkan akun.</p>
        <a href="{{ route('login.form') }}">← Sudah punya akun? Login</a>
    </div>
</div>
@endsection
