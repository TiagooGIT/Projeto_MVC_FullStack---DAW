<title>Dashboard do Moderador</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="container mt-5">
        <h2>Dashboard do Moderador</h2>

        <h3>Posts Eliminados</h3>
        <?php $__currentLoopData = $deletedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deletedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Titulo: <?php echo e($deletedPost->title); ?></h3>
                <p class="card-text">Conteudo: <?php echo e($deletedPost->content); ?></p>
                <p class="card-text">Post ID: <?php echo e($deletedPost->id_user); ?></p>
                <p class="card-text">Razão: <?php echo e($deletedPost->reason); ?></p>
                <p class="card-text">Eliminado Por: <?php echo e($deletedPost->moderator->name); ?></p>
                <small class="text-muted">Criado em: <?php echo e($deletedPost->created_at); ?></small>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <a href="<?php echo e(route('moderator.reports')); ?>" class="btn btn-primary">Ver Posts Reportados</a><br>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-2">Voltar para a Home Page</a>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/dashboard/moderator/moderator.blade.php ENDPATH**/ ?>