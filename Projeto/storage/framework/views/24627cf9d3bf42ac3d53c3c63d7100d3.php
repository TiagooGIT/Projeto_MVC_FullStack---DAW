<title>Criar Post</title>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Criar Post</h2>

        <?php if(session('success')): ?>
            <p style="color: green;"><?php echo e(session('success')); ?></p>
        <?php endif; ?>

        <form action="<?php echo e(route('posts.store')); ?>" method="post" class="mb-3">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo:</label>
                <textarea name="conteudo" rows="4" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="id_language" class="form-label">Idioma:</label>
                <select name="id_language" class="form-select">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($language['id_language']); ?>"><?php echo e($language['language']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Criar Post</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/posts/create.blade.php ENDPATH**/ ?>