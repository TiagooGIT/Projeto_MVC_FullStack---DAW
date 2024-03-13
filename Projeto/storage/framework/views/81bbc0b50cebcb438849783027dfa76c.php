<title>Gráfico - <?php echo e(ucfirst($metric)); ?></title>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">Gráfico - <?php echo e(ucfirst($metric)); ?></h2>

        <form action="<?php echo e(route('posts.graph', ['id' => $post->id_post])); ?>" method="get" class="mb-3">
            <label for="metric" class="form-label">Escolha a métrica:</label>
            <select name="metric" id="metric" class="form-select">
                <option value="view_more" <?php echo e($metric === 'view_more' ? 'selected' : ''); ?>>Ver Mais</option>
                <option value="report" <?php echo e($metric === 'report' ? 'selected' : ''); ?>>Report</option>
                <option value="tradução" <?php echo e($metric === 'traducao' ? 'selected' : ''); ?>>Traduções</option>
                <option value="tradução_validada" <?php echo e($metric === 'traducao_validada' ? 'selected' : ''); ?>>Tradução_validada</option>
                <option value="tradução_eliminada" <?php echo e($metric === 'traducao_eliminada' ? 'selected' : ''); ?>>Tradução_eliminada</option>
            </select>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary mt-3">Atualizar Gráfico</button>
            </div>
        </form>
        
        <canvas id="interactionChart" width="400" height="200"></canvas>
        <div class="d-flex justify-content-center align-items-center">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-secondary mt-3">Voltar à Dashboard do <?php echo e(auth()->user()->name); ?></a>
        </div>
    </div>

    <script src="/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
    <script>
        var ctx = document.getElementById('interactionChart').getContext('2d');
        var interactionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: '<?php echo e(ucfirst($metric)); ?>',
                    data: <?php echo json_encode($clicks->values()); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgb(0, 0, 0)',
                    borderWidth: 2,
                    fill: false 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        max: <?php echo $clicks->max() + 2; ?>,
                    },
                    x: {
                        beginAtZero: false,
                        offset: true,
                    }
                }
            }
        });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Uni\DAW\Projeto-DAW\resources\views/posts/graph.blade.php ENDPATH**/ ?>