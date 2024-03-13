    <title>Post Traduzido</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="container mt-5">
        <h2>Detalhes do Post</h2>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Título: <?php echo e($postTranslated->titulo); ?></h3>
                <p class="card-text">Conteúdo: <?php echo e($postTranslated->conteudo); ?></p>
                <p class="card-text">Autor: <?php echo e($postTranslated->user->name); ?></p>
                <p class="card-text">Língua Traduzida: <?php echo e($postTranslated->language->language); ?></p>
                <p class="card-text">Criado em: <?php echo e($postTranslated->created_at); ?></p>
            </div>
        </div>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/translations/showTranslation.blade.php ENDPATH**/ ?>