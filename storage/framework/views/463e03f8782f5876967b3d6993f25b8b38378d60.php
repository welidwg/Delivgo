

<?php $__env->startSection('title'); ?>
    Historique
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_path'); ?>
    Historique
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_title'); ?>
    Historique
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="mainct">

        </div>
    </div>
    <script>
        function LoadContentMain() {
            try {
                $("#mainct").load("/dash/historiqueContent")
                setTimeout(() => {
                    LoadContentMain()
                }, 14000);
            } catch (error) {
                console.error(error);
            }


        }
        LoadContentMain()
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/historique.blade.php ENDPATH**/ ?>