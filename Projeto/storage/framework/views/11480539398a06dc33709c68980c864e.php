<!-- reports.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Posts Reportados</title>
</head>
<body>
    <h2>Posts Reportados</h2>

    <?php $__currentLoopData = $reportedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
            <!-- Exiba informações sobre os posts reportados -->
            <h3>Titulo: <?php echo e($reportedPost->post->titulo); ?></h3>
            <p>Conteudo: <?php echo e($reportedPost->post->conteudo); ?></p>
            <p>Post ID: <?php echo e($reportedPost->post->id_post); ?></p>
            <p>Reason: <?php echo e($reportedPost->reason); ?></p>
            <small>Criado em: <?php echo e($reportedPost->created_at); ?></small>
            <!-- Adicione outras informações que deseja exibir -->
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <a href="<?php echo e(route('home')); ?>">Voltar para a Home Page</a><br>
    <a href="<?php echo e(route('moderator.dashboard')); ?>">Ver Posts Eliminados</a><br>
</body>
</html>
<?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/dashboard/moderator/reports.blade.php ENDPATH**/ ?>