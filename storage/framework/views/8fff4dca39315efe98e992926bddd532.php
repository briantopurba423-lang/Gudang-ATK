<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'ATK Stock System'); ?></title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f8fafc; color: #1e293b; }

        nav {
            position: fixed; top: 0; width: 100%; z-index: 100;
            background: rgba(255,255,255,0.95);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo { font-size: 20px; font-weight: bold; color: #4f46e5; }
        nav .logo span { color: #0ea5e9; }
        nav a.nav-btn {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: white;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 40px 20px;
            text-align: center;
        }

        footer .footer-logo {
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-bottom: 12px;
        }

        footer p {
            font-size: 17px;
            margin: 4px 0;
        }
    </style>

    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>

<?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html><?php /**PATH C:\laragon\www\laravel-1\Gudang-ATK\resources\views/layouts/main.blade.php ENDPATH**/ ?>