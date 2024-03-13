<title>Eliminar Post - MOD</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Eliminar Post - MOD</h2>

        <h3>Título: <?php echo e($post->titulo); ?></h3>
        <p>Conteúdo: <?php echo e($post->conteudo); ?></p>
        <p>Autor: <?php echo e($post->user->name); ?></p>
        <p>Criado em: <?php echo e($post->created_at); ?></p>

        <form action="<?php echo e(route('posts.delete.post', ['id' => $post->id_post])); ?>" method="post" class="mb-3">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="reason" class="form-label">Motivo da Eliminação:</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Post</button>
        </form>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary">Voltar para a lista de posts</a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/mod/delete.blade.php ENDPATH**/ ?>