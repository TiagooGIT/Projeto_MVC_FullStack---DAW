<!DOCTYPE html>
<html>

<head>
    <title>Eliminar Post - MOD</title>
</head>

<body>
    <h2>Eliminar Post - MOD</h2>

    <h3>Título: <?php echo e($posts_translated->titulo); ?></h3>
    <p>Conteúdo: <?php echo e($posts_translated->conteudo); ?></p>
    <p>Autor: <?php echo e($posts_translated->user->name); ?></p>
    <p>Criado em: <?php echo e($posts_translated->created_at); ?></p>

    <form action="<?php echo e(route('posts.delete.translation', ['id' => $posts_translated->id_post])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <label for="reason">Motivo da Eliminação:</label>
        <textarea name="reason" id="reason" rows="4" cols="50" required></textarea><br>
        <button type="submit">Eliminar Post</button>
    </form>


    <a href="<?php echo e(route('home')); ?>">Voltar para a lista de posts</a>
</body>

</html><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/mod/delete_translation.blade.php ENDPATH**/ ?>