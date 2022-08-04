 <?php
     
     use App\Models\Notification;
     
     $notifs = Notification::where('to', Auth::user()->user_id)
         ->with('sender')
         ->orderBy('created_at', 'desc')
         ->get();
     
 ?>


 <?php $__empty_1 = true; $__currentLoopData = $notifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
     <a class="dropdown-item d-flex align-items-center bg-light" href="#">
         <div class="me-3 col-3">
             <div class=" "><img src="<?php echo e(asset('/uploads/logos/' . $notif->sender->avatar)); ?>"
                     class="rounded-circle shadow-sm" width="45px" alt="">
             </div>
         </div>
         <div class="col text-wrap" style="width: 100%;">
             <h6 class="fw-bold fs-5"><?php echo e($notif->title); ?></h6>
             <p style=""><?php echo e($notif->content); ?></p>
             <span class="small text-gray-500 " style="text-align: right" id="date<?php echo e($notif->id); ?>"></span>
             <script>
                 $("#date<?php echo e($notif->id); ?>").html(moment("<?php echo e($notif->created_at); ?>").fromNow())
             </script>

         </div>
     </a>
     <hr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
     <div style="zoom: 0.95">
         <?php echo $__env->make('main/layouts/notfound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <p class="text-center">No notifications yet</p>
     </div>
 <?php endif; ?>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/layouts/notif.blade.php ENDPATH**/ ?>