<title>HomePage</title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="d-flex align-items-center justify-content-center mb-1">
        <img src="<?php echo e(asset('images/AlienBlue_Icon.png')); ?>" alt="Reddit Logo" style="max-height: 80px;">
        <h2 class="text-center text-black ms-3 fw-bold">ForuEddit</h2>
    </div>


    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <a href="<?php echo e(route('posts.show', ['id' => $post->id_post])); ?>" class="btn btn-primary btn-sm me-2" style="max-height: 30px; min-width: 80px;">Ver mais</a>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(!auth()->user()->moderator): ?>
                            <?php if(auth()->user()->id_user !== $post->user->id_user): ?>
                                <form method="post" action="<?php echo e(route('posts.vote', ['id' => $post->id_post])); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" name="vote" value="up" class="btn btn-success btn-sm" style="max-height: 30px; min-width: 80px;" >Upvote</button>
                                    <button type="submit" name="vote" value="down" class="btn btn-danger btn-sm" style="max-height: 30px; min-width: 80px;" >Downvote</button>
                                </form>
                            <?php endif; ?>

                            <?php if(auth()->user()->id_user === $post->user->id_user): ?>
                                <a href="<?php echo e(route('posts.edit', ['id' => $post->id_post])); ?>" class="btn btn-warning btn-sm" >Atualizar Post</a>
                            <?php endif; ?>
                        <?php endif; ?>
                   
                        <?php if(auth()->user()->moderator): ?>
                            <a href="<?php echo e(route('posts.moderation', ['id' => $post->id_post])); ?>" class="btn btn-info btn-sm" style="max-height: 30px; min-width: 80px;">Moderar</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(auth()->check() && !auth()->user()->moderator): ?>
        <div class="text-end mt-5 mb-5">
            <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success">Criar Post</a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/home.blade.php ENDPATH**/ ?>