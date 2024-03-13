<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div>
            <h1 class="text-center fw-bold">Dashboard do <?php echo e(auth()->user()->name); ?></h1>

            <h2 class="mt-4 text-center">Os Teus Posts</h2>

            <?php $__currentLoopData = $userPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            
                    <div class="text-center mx-auto">
                        <h4 class="mt-3 fw-bold">Métricas de Interação</h4>
                        <p class="card-text">Cliques em "Ver mais": <?php echo e($post->interactions ? $post->interactions->where('action', 'view_more')->count() : 0); ?></p>
                        <p class="card-text">Traduções: <?php echo e($post->interactions ? $post->interactions->where('action', 'traducao')->count() : 0); ?></p>
                        <p class="card-text">Traduções Validada: <?php echo e($post->interactions ? $post->interactions->where('action', 'traducao_validada')->count() : 0); ?></p>
                        <p class="card-text">Traduções Eliminadas: <?php echo e($post->interactions ? $post->interactions->where('action', 'traducao_eliminada')->count() : 0); ?></p>
                        <p class="card-text">Reports: <?php echo e($post->interactions ? $post->interactions->where('action', 'report')->count() : 0); ?></p>
                        <a href="<?php echo e(route('posts.graph', ['id' => $post->id_post])); ?>" class="btn btn-primary mt-3 mb-3">Ver Gráfico</a>
                    </div>
        </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="d-flex justify-content-center align-items-center">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/dashboard/user.blade.php ENDPATH**/ ?>