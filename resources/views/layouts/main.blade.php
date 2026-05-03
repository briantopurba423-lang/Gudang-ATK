<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATK Stock System')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f8fafc; color: #1e293b; }
        footer {
            background: #0f172a; color: #94a3b8;
            padding: 40px 20px; text-align: center;
        }
        footer .footer-logo { font-size: 20px; font-weight: bold; color: white; margin-bottom: 10px; }
        footer p { font-size: 13px; margin: 4px 0; }
    </style>
    @yield('style')
</head>
<body>

    @unless(isset($hideNav) && $hideNav)
        <x-navbar :active="$active ?? 'home'" />
    @endunless

    @yield('content')

    @unless(isset($hideNav) && $hideNav)
        <footer>
            <div class="footer-logo">📦 ATK Stok SIstem</div>
            <x-footer />
        </footer>
    @endunless

    @yield('scripts')
</body>
</html>
