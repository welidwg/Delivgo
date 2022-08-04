   <table class="table mb-0 table-hover align-middle text-nowrap" id="drinksTable1">
       <thead>
           <tr>
               <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
               <th class="border-top-0 mx-auto">Actions</th>

           </tr>
       </thead>
       <tbody>
           <?php $__empty_1 = true; $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               <tr>
                   <td>
                       <div class="d-flex align-items-center">

                           <div class="">
                               <h4 class="m-b-0 font-16"><?php echo e($drink->label); ?></h4>
                           </div>
                       </div>
                   </td>
                   <td>
                       <?php echo e($drink->price); ?> DT
                   </td>

                   <td>
                       <div class="">

                           <a href="#!" id="editDrink<?php echo e($drink->id); ?>" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>
                           <a href="#!" id="deleteDrink<?php echo e($drink->id); ?>" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteDrink<?php echo e($drink->id); ?>").on("click", (e) => {
                               alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                   axios.delete("/drink/delete/<?php echo e($drink->id); ?>")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           setTimeout(() => {
                                               $("#drinksTable").load("/dash/drinksTable")
                                           }, 700);
                                       })
                                       .catch(err => {
                                           console.error(err);
                                           toastr.error("erreur inconnue")
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
       $("#drinksTable1").DataTable({
           "language": {
               "decimal": ".",
            "emptyTable": "Aucun boisson encore",
               "info": "",
               "infoFiltered": "",
               "infoEmpty": "",
               "lengthMenu": "",
           }
       });
   </script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/drinksTable.blade.php ENDPATH**/ ?>