

<?php $__env->startSection('header_path'); ?>
    Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_title'); ?>
    Profile
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="profileCont">
        <?php echo $__env->make('dash/layouts/profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/profile.blade.php ENDPATH**/ ?>