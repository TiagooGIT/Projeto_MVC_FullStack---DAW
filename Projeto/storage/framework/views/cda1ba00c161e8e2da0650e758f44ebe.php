<title>Registrar</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Registrar</h2>
        
        <form action="<?php echo e(route('register')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Senha:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="moderator" class="form-check-input" value="1">
                <label for="moderator" class="form-check-label">Moderador</label>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <p class="mt-3">Já tem uma conta? <a href="<?php echo e(route('login')); ?>">Faça login.</a></p>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/auth/register.blade.php ENDPATH**/ ?>