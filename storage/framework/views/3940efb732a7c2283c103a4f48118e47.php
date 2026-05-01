<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('style'); ?>
<style>
    body {
        background: url('/kantor.jpeg') no-repeat center center fixed;
        background-size: cover;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        width: 320px;
        text-align: center;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        box-sizing: border-box;
    }

    button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="login-wrapper">
    <div class="login-box">
        <h2>STOK GUDANG ATK</h2>

        <?php if(session('error')): ?>
            <div class="error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
            </select>

            <button type="submit">Login</button>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel-1\Gudang-ATK\resources\views/pages/login.blade.php ENDPATH**/ ?>