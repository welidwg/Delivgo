<?php

use App\Models\Category;
$categs = Category::where('resto_id', Auth::user()->user_id)->get();
?>
<table class="table mb-0 table-hover align-middle text-nowrap" id="productsTable1">
    <thead>
        <tr>
            <th class="border-top-0">Produit</th>
            <th class="border-top-0">Prix</th>
            <th class="border-top-0">Catégorie</th>
            <th class="border-top-0">Actions</th>

        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                            <img src="<?php echo e(asset('uploads/products/' . $product->picture)); ?>" class="rounded"
                                width="50px" alt="">
                        </div>
                        <div class="">
                            <h4 class="m-b-0 font-16"><?php echo e($product->label); ?></h4>
                        </div>
                    </div>
                </td>
                <td><?php echo e($product->price); ?> DT</td>
                <td><?php echo e($product->Category->label); ?> </td>

                <td>
                    <a href="#!" data-bs-toggle="modal"
                        data-bs-target="#editProductModal<?php echo e($product->product_id); ?>"
                        class="btn shadow-none text-info"><i class="fas fa-edit"></i></a>

                    <a href="#!" id="deleteProduct<?php echo e($product->product_id); ?>"
                        class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                </td>
                <script>
                    $("#deleteProduct<?php echo e($product->product_id); ?>").on("click", (e) => {
                        alertify.confirm("Confirmation", "Are you sure that you want to delete this product ?",
                            () => {
                                let btn = $("#deleteProduct<?php echo e($product->product_id); ?>")
                                let oldval = btn.html()
                                btn.html(spinner)
                                axios.delete("/product/delete/<?php echo e($product->product_id); ?>")
                                    .then(res => {
                                        console.log(res)
                                        toastr.success(res.data.message)
                                        setTimeout(() => {
                                            $("#productsTable").load("/dash/productsTable")
                                        }, 500);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)
                                    }).finally(() => {
                                        btn.html(oldval)
                                    })

                            }, () => {

                            })
                    })
                </script>

            </tr>



        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>



    </tbody>
</table>


<script>
    $('#productsTable1').DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "Aucun produit encore",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/productsTable.blade.php ENDPATH**/ ?>