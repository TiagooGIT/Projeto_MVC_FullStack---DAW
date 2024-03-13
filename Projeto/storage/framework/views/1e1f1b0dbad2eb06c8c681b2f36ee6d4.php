<title>Detalhes do Post - <?php echo e(auth()->user()->name); ?></title>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="card mb-3 mx-auto" style="max-width: 800px;">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user me-2"></i> 
                    <p class="card-text fs-5"><?php echo e($post->user->name); ?></p>
                </div>
                <div class="d-flex">
                    <p class="card-text me-2">
                        <i class="fas fa-thumbs-up text-success"></i>
                        <?php echo e($post->votes ? $post->votes->where('vote', 'up')->count() : 0); ?>

                    </p>
                    <p class="card-text">
                        <i class="fas fa-thumbs-down text-danger"></i>
                        <?php echo e($post->votes ? $post->votes->where('vote', 'down')->count() : 0); ?>

                    </p>
                </div>
            </div>
            <div class="card-body p-4">
                <h5 class="card-title text-center mb-3 fs-4"><?php echo e($post->titulo); ?></h5>
                <p class="card-text fs-6"><?php echo e($post->conteudo); ?></p>
                <p class="card-text">Lingua: <?php echo e($post->language ? $post->language->language : 'N/A'); ?></p>
            </div>
            <div class="card-footer text-muted d-flex justify-content-between">
                <small>Criado em: <?php echo e($post->created_at); ?></small>
                <div class="d-flex">
                    <form action="<?php echo e(route('posts.report', ['id' => $post->id_post])); ?>" method="get" class="mb-3 me-3">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-warning">Denunciar</button>
                    </form>
                    <form action="<?php echo e(route('posts.delete', ['id' => $post->id_post])); ?>" method="get" class="ml-3">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/mod/moderation.blade.php ENDPATH**/ ?>