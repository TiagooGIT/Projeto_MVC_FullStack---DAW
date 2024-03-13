<title>Validar Post - <?php echo e($posts_translated->titulo); ?></title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    
    <div class="container mt-5">
        <h2>Validar <?php echo e($posts_translated->titulo); ?></h2>

        <h3>Título: <?php echo e($posts_translated->titulo); ?></h3>
        <p>Conteúdo: <?php echo e($posts_translated->conteudo); ?></p>
        <p>Autor: <?php echo e($posts_translated->user->name); ?></p>
        <p>Criado em: <?php echo e($posts_translated->created_at); ?></p>

        <form action="<?php echo e(route('posts.validate_Translation', ['id' => $posts_translated->id_post])); ?>" method="post"
            class="mt-3">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="validacao" class="form-label">Validação:</label>
                <div class="form-check">
                    <input type="hidden" name="validacao" value="0">
                    <input type="checkbox" name="validacao" id="validacao" class="form-check-input" value="1">
                    <label for="validacao" class="form-check-label">Validar</label>
                </div>
            </div>

            <div id="comentario_container" class="mb-3" style="display:none;">
                <label for="comentario_validacao" class="form-label">Comentário Validação:</label>
                <textarea name="comentario_validacao" id="comentario_validacao" class="form-control" rows="4"
                    cols="50"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Finalizar</button>
        </form>

        <script>
            document.getElementById('validacao').addEventListener('change', function () {
                var comentarioContainer = document.getElementById('comentario_container');
                if (this.checked) {
                    comentarioContainer.style.display = 'block';
                } else {
                    comentarioContainer.style.display = 'none';
                }
            });
        </script>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/mod/validation.blade.php ENDPATH**/ ?>