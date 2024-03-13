<title>Moderar Post</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Moderar Post</h2>
        <hr>

        <?php if($posts_translated->isEmpty()): ?>
            <p>Não existe traduções para validar.</p>
        <?php else: ?>
            <?php $__currentLoopData = $posts_translated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($translatedPost->validacao != 1): ?>
                    <div class="border p-3 mb-3">
                        <p class="mb-2">Title: <?php echo e($translatedPost->titulo); ?></p>
                        <p class="mb-2">Content: <?php echo e($translatedPost->conteudo); ?></p>
                        <p class="mb-2">Author: <?php echo e($translatedPost->user->name); ?></p>
                        <p class="mb-2">Created at: <?php echo e($translatedPost->created_at); ?></p>
                        <p class="mb-2">Lingua Traduzida: <?php echo e($translatedPost->language->language); ?></p>

                        <form action="<?php echo e(route('posts.validateById', ['id' => $translatedPost->id_post])); ?>" method="get">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success">Validar</button>
                        </form>
                        <hr>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>

    <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/mod/moderation_Translation.blade.php ENDPATH**/ ?>