<title>Detalhes do Post - <?php echo e($post->titulo); ?></title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <h2 class="mb-4 fw-bold">Detalhes do Post - <?php echo e($post->titulo); ?></h2>

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
    </div>
    
    <div class="card mb-3 mx-auto" style="max-width: 800px;">
        <div class="card-header d-flex justify-content-between">
            <h2 class="mb-4 fw-bold">Traduções Disponíveis</h2>
        </div>    
        <?php $__currentLoopData = $posts_translated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $translatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border p-3 mb-3 text-left">
                <h4 class="mb-4 fw-bold">Post Traduzido nº<?php echo e($index + 1); ?></h4>
                <p><?php echo e($translatedPost->titulo); ?></p>
                <p><?php echo e($translatedPost->conteudo); ?></p>
                <p>Língua Traduzida: <?php echo e($translatedPost->language->language); ?></p>
                <p>Criado em: <?php echo e($translatedPost->created_at); ?></p><br>
                <h4 class="mb-4 fw-bold">Informações sobre a tradução</h4>
                <p>Utilizador Tradutor: <?php echo e($translatedPost->user->name); ?></p>
                <p>Validação: <?php echo e($translatedPost->validacao); ?></p>
                <p>Comentário da Validação: <?php echo e($translatedPost->comentario_validacao); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->id_user !== $post->user->id_user): ?>
            <?php if(!auth()->user()->moderator): ?>
            <div class="d-flex justify-content-center align-items-center">
                <button id="translateButton" class="btn btn-primary d-block mt-3">Traduzir</button>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(auth()->user()->moderator): ?>
            <div class="d-flex justify-content-center align-items-center">
                <a href="<?php echo e(route('posts.moderation_translation', ['id' => $post->id_post])); ?>" class="btn btn-warning btn-n d-block mx-auto mt-3">
                    <i class="fas fa-edit me-2"></i> Validar Tradução
                </a>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-center align-items-center">
            <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary d-block mt-3">Voltar para a lista de posts</a>
        </div>

        <form id="translationForm" action="<?php echo e(route('posts.translation.store', ['id' => $post->id_post])); ?>" method="post" style="display: none; text-align: center;">
            <?php echo csrf_field(); ?>
            <select name="id_language" class="form-select mb-3">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($language['id_language']); ?>"><?php echo e($language['language']); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="btn btn-success btn-sm">Concluir Tradução</button>
        </form>
    <?php endif; ?>
    
    <script>
        $(document).ready(function() {
            $("#translateButton").click(function() {
                $("#translationForm").toggle();
            });
        });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/posts/show.blade.php ENDPATH**/ ?>