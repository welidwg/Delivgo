   <table class="table mb-0 table-hover align-middle text-nowrap" id="categoriesTable1">
       <thead>
           <tr>
               <th class="border-top-0">Label</th>
               <th class="border-top-0 mx-auto">Actions</th>

           </tr>
       </thead>
       <tbody>
           <?php $__empty_1 = true; $__currentLoopData = $categs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               <tr>
                   <td>
                       <div class="d-flex align-items-center">

                           <div class="">
                               <h4 class="m-b-0 font-16"><?php echo e($cat->label); ?></h4>
                           </div>
                       </div>
                   </td>

                   <td>
                       <div class="">

                           <a href="#!" id="deleteCategory<?php echo e($cat->id); ?>" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteCategory<?php echo e($cat->id); ?>").on("click", (e) => {
                               alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                   axios.delete("/category/delete/<?php echo e($cat->id); ?>")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           setTimeout(() => {
                                               $("#categoriesTable").load("/dash/categoriesTable")
                                           }, 700);
                                       })
                                       .catch(err => {
                                           console.error(err);
                                           toastr.error("Something went wrong")
                                       })

                               }, () => {})
                           })
                       </script>

                   </td>

               </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
               
           <?php endif; ?>


       </tbody>
   </table>





   <script>
       $('#categoriesTable1').DataTable({
           "language": {
               "decimal": ".",
            "emptyTable": "Aucune catégorie encore",
               "info": "",
               "infoFiltered": "",
               "infoEmpty": "",
               "lengthMenu": "",
           }
       });
   </script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/categoriesTable.blade.php ENDPATH**/ ?>