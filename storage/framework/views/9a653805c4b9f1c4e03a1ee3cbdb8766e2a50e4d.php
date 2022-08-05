  <div class="row restoCard animate__animated animate__fadeInUp" style="zoom: 0.97">
      <?php $__empty_1 = true; $__currentLoopData = $restos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col col-md-4 col-sm-12 mb-3">
              <a href="<?php echo e(url('/resto/' . $resto->user_id)); ?>">
                  <div class="card shadow " style="border-radius: 20px">
                      <div class="d-flex align-items-center justify-content-center w-100 text-center headerResto"
                          style="background-image: url(uploads/logos/<?php echo e($resto->avatar); ?>);background-size: contain; background-repeat: no-repeat;height: 200px;background-position: center">
                          <div class="w-100 h-100 d-flex justify-content-center  align-items-center titleResto ">
                              <h6 class="display-3 text-white fw-bold"><?php echo e($resto->name); ?></h6>

                          </div>
                      </div>
                      <div class="card-body p-1  px-0 ">
                          <div class="row mb-0 p-3 align-items-center" style="flex-wrap: nowrap">
                              <div class="col-8 ">
                                  <span> <i class="fas fa-map-marker-alt"></i>
                                      <?php echo e($resto->address); ?> , <?php echo e($resto->region->label); ?></span>
                                  
                              </div>
                              <div class="col d-flex align-items-center justify-content-end"
                                  style="flex-wrap: nowrap;white-space: nowrap;">
                                  <div><i class="fal fa-biking-mountain"></i> <?php echo e($resto->deliveryPrice); ?>.000 DT
                                  </div>
                                  
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </a>

          </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <?php echo $__env->make('main/layouts/notfound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <span class="text-center fs-4 fw-bold">Désolé<br>Il n'y a pas des restaurants pour le moment !</span>
      <?php endif; ?>





  </div>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/layouts/restoCard.blade.php ENDPATH**/ ?>