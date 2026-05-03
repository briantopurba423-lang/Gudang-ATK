<nav style="position:fixed; top:0; width:100%; z-index:100; background:rgba(255,255,255,0.97); backdrop-filter:blur(10px); padding:14px 40px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 1px 10px rgba(0,0,0,0.08);">

    <div style="font-size:20px; font-weight:bold; color:#4f46e5;">
        📦 ATK <span style="color:#0ea5e9;">Stock</span>
    </div>

    <div style="display:flex; gap:24px; align-items:center;">
        <a href="{{ route('home') }}"
           style="text-decoration:none; font-size:14px; color:{{ $colorHome }}; font-weight:{{ $weightHome }};">
            Home
        </a>
        <a href="{{ route('about') }}"
           style="text-decoration:none; font-size:14px; color:{{ $colorAbout }}; font-weight:{{ $weightAbout }};">
            About
        </a>
        <a href="{{ route('login.form') }}"
           style="background:linear-gradient(135deg,#4f46e5,#0ea5e9); color:white; padding:9px 22px; border-radius:25px; text-decoration:none; font-size:14px; font-weight:bold;">
            Masuk
        </a>
    </div>

</nav>
