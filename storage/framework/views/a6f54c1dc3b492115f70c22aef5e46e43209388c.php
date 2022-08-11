<table class="table mb-0 table-hover align-middle text-nowrap" id="supplementsTable">
    <thead>
        <tr>
               <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
            <th class="border-top-0 mx-auto">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $supps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">

                        <div class="">
                            <h4 class="m-b-0 font-16"><?php echo e($supp->label); ?></h4>
                        </div>
                    </div>
                </td>
                <td>
                    <?php echo e($supp->price); ?> DT
                </td>

                <td>
                    <div class="">

                        <a data-bs-toggle="modal" data-bs-target="#editSuppModal<?php echo e($supp->id); ?>"
                            id="editSupp<?php echo e($supp->id); ?>" class="btn shadow-none text-primary"><i
                                class="fas fa-edit"></i></a>
                        <a href="#!" id="deleteSupp<?php echo e($supp->id); ?>" class="btn shadow-none text-danger"><i
                                class="fas fa-trash"></i></a>

                    </div>
                    <script>
                        $("#deleteSupp<?php echo e($supp->id); ?>").on("click", (e) => {
                            alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                axios.delete("/supplement/delete/<?php echo e($supp->id); ?>")
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            // $("#toppingsTable").load("/dash/toppingsTable" + " #toppingsTable")
                                            $("#tableSupps").load("/dash/supplementsTable");
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <script></script>
    </tbody>
</table>
<script>
    $("#supplementsTable").DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "Aucun supplement encore",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/supplementsTable.blade.php ENDPATH**/ ?>