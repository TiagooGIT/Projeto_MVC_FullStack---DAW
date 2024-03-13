<title>Reportar Post</title>
    <?php $__env->startSection('content'); ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php elseif(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>   
    <div class="container mt-5">
        <h2 class="mb-4">Reportar Post</h2>

        <form action="<?php echo e(route('posts.report.post', ['id' => $post->id_post])); ?>" method="post" class="mb-3">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="reason" class="form-label">Motivo do Relatório:</label>
                <textarea name="reason" id="reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Relatório</button>
        </form>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary">Voltar para a lista de posts</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/posts/report.blade.php ENDPATH**/ ?>