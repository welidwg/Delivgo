<table class="table mb-0 table-hover align-middle text-nowrap" id="toppingsTable1">
    <thead>
        <tr>
            <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
            <th class="border-top-0 mx-auto">Actions</th>

        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $garns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $garn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">

                        <div class="">
                            <h4 class="m-b-0 font-16"><?php echo e($garn->label); ?></h4>
                        </div>
                    </div>
                </td>
                <td>
                    <?php echo e($garn->price); ?> DT
                </td>

                <td>
                    <div class="">

                        <a href="#!" id="editGarn<?php echo e($garn->id); ?>" class="btn shadow-none text-primary"
                            data-bs-toggle="modal" data-bs-target="editToppingModal<?php echo e($garn->id); ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#!" id="deleteGarn<?php echo e($garn->id); ?>" class="btn shadow-none text-danger">
                            <i class="fas fa-trash"></i>
                        </a>

                    </div>
                    <script>
                        $("#deleteGarn<?php echo e($garn->id); ?>").on("click", (e) => {
                            alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                axios.delete("/topping/delete/<?php echo e($garn->id); ?>")
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            // $("#toppingsTable").load("/dash/toppingsTable" + " #toppingsTable")
                                            $("#toppingsTable").load("/dash/toppingsTable");
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
    $('#toppingsTable1').DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "Aucun garniture encore",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/toppingsTable.blade.php ENDPATH**/ ?>