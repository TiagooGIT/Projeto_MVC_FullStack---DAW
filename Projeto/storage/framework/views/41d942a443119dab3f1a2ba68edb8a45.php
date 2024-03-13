<title>Editar Post</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Editar Post</h2>

        <?php if(session('success')): ?>
            <p class="alert alert-success"><?php echo e(session('success')); ?></p>
        <?php endif; ?>

        <form action="<?php echo e(route('posts.update', ['id' => $post->id_post])); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" value="<?php echo e($post->titulo); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo:</label>
                <textarea name="conteudo" rows="4" class="form-control" required><?php echo e($post->conteudo); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Post</button>
        </form>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary">Cancelar</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/posts/edit.blade.php ENDPATH**/ ?>