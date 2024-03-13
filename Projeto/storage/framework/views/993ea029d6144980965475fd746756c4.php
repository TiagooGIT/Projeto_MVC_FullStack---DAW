<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="/bootstrap-5.3.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-text">
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Bem-vindo,
                            <?php if(auth()->guard()->check()): ?>
                                <?php echo e(auth()->user()->name); ?>

                                <?php if(auth()->user()->moderator): ?>
                                    <i class="fas fa-user-shield text-light ms-2"></i>
                                <?php else: ?>
                                    <i class="fas fa-user text-light ms-2"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                                Astronauta!
                                <i class="fas fa-user-astronaut text-light ms-2"></i> 
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php if(auth()->guard()->guest()): ?>
                                <li><a class="dropdown-item text-dark" href="<?php echo e(route('login')); ?>"> Login</a></li>
                                <li><a class="dropdown-item text-dark" href="<?php echo e(route('register')); ?>"> Registar</a></li>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->moderator): ?>
                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('moderator.dashboard')); ?>">Dashboard</a></li>
                                <?php endif; ?>
                                <?php if(!auth()->user()->moderator): ?>
                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a></li>
                                <?php endif; ?>
                                    <li><form action="<?php echo e(route('logout')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form></li>
                            <?php endif; ?>
                        </ul>
                    </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>


    <script src="/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</body>

</html>
<?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/layout.blade.php ENDPATH**/ ?>