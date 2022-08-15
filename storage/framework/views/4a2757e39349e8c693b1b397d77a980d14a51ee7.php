

<?php
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplement;
use App\Models\Garniture;
use App\Models\Sauce;
use App\Models\Drink;
$categs = Category::where('resto_id', Auth::user()->user_id)->get();

?>
<?php $__env->startSection('title'); ?>
    Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_path'); ?>
    Menu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_title'); ?>
    <i class="fal fa-burger-soda"></i>&nbsp; My Menu
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('dash/modals/menuModals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <!-- column -->
        <div class="col col-md-8 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Produits&nbsp;

                                <a href="" class="btn " data-bs-target="#addProductModal" data-bs-toggle="modal"><i
                                        class="fas fa-plus"></i></a>

                            </h4>


                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="productsTable">
                        </table>

                    </div>
                    <script>
                        $("#productsTable").load("/dash/productsTable")
                    </script>
                    <?php
                        $products = Product::where('resto_id', Auth::user()->user_id)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editProductModal<?php echo e($product->product_id); ?>" tabindex="-1"
                            role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>



                                            <h6 for="" class="mb-3 fs-3 color-3 text-center"><?php echo e($product->label); ?>

                                            </h6>
                                            <div>
                                                <?php
                                                    $catges1 = Category::where('id', '!=', $product->category->id)->get();
                                                ?>
                                                <form action="" method="POST"
                                                    id="editProductForm<?php echo e($product->product_id); ?>" class="formsModal"
                                                    enctype="multipart/form-data">

                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Nom de produit" name="label"
                                                            value="<?php echo e($product->label); ?>">
                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-pen"></i></label>
                                                        <textarea class="form-control shadow-none border-0  bg-transparent" name="description"
                                                            placeholder=" Description (Optionel )" cols="" rows="2" style="resize: none"><?php echo e($product->description); ?></textarea>

                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" min="1"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="prix" name="price" value="<?php echo e($product->price); ?>"
                                                            step="0.1">
                                                    </div>

                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-list"></i></label>

                                                        <select id="category" name="category"
                                                            class="form-control shadow-none border-0  bg-transparent">
                                                            <option value="<?php echo e($product->category->id); ?>">
                                                                <?php echo e($product->category->label); ?>

                                                            </option>


                                                            <?php $__currentLoopData = $catges1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value=<?php echo e($cat->id); ?>><?php echo e($cat->label); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                A des Suppléments ?</label>
                                                            <input class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckDefault" name="supplement"
                                                                <?php echo e($product->have_supplement ? 'checked' : ''); ?>>

                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                A des garnitures ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="topping"
                                                                <?php echo e($product->have_toppings ? 'checked' : ''); ?>>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                A des sauces ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="sauce"
                                                                <?php echo e($product->have_sauces ? 'checked' : ''); ?>>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                A des boissons ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="drink"
                                                                <?php echo e($product->have_drinks ? 'checked' : ''); ?>>

                                                        </div>
                                                        <input type="hidden" name="product_id"
                                                            value="<?php echo e($product->product_id); ?>">
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="picture" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-camera"></i>
                                                        </label>
                                                        <label style="width: auto;text-align: left"
                                                            for="picture<?php echo e($product->product_id); ?>">&nbsp;&nbsp;Changer
                                                            l'image de produit</label>
                                                        <input type="file" min="1" hidden
                                                            id="picture<?php echo e($product->product_id); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Product pic" name="picture" accept="image/*">
                                                    </div>
                                                    <input type="hidden" name="resto_id"
                                                        value="<?php echo e(Auth::user()->user_id); ?>">
                                                    <div class="mx-auto mt-3">
                                                        <button type="submit"
                                                            id="editProductBtnSubmit<?php echo e($product->product_id); ?>"
                                                            class="btn w-100">Mis à jour&nbsp;
                                                            <i class="fal fa-check"></i></button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldval<?php echo e($product->product_id); ?> = $("#editProductBtnSubmit<?php echo e($product->product_id); ?>").html()

                                            $("#editProductForm<?php echo e($product->product_id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editProductBtnSubmit<?php echo e($product->product_id); ?>").html(spinner)
                                                let form<?php echo e($product->product_id); ?> = $("#editProductForm<?php echo e($product->product_id); ?>")[0]
                                                let formdata<?php echo e($product->product_id); ?> = new FormData(form<?php echo e($product->product_id); ?>)

                                                axios.post("/product/update/<?php echo e($product->product_id); ?>", formdata<?php echo e($product->product_id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#productsTable").load("/dash/productsTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editProductBtnSubmit<?php echo e($product->product_id); ?>").html(
                                                            oldval<?php echo e($product->product_id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>


                </div>
            </div>
        </div>
        <div class="col col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Catégories&nbsp;

                                <a href="" class="btn" data-bs-target="#addCategoryModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="categoriesTable" style="max-height: 500px;overflow: auto">


                    </div>
                    <script>
                        $("#categoriesTable").load("/dash/categoriesTable")
                    </script>
                    <?php
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $categs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editCatModal<?php echo e($cat->id); ?>" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editCatForm<?php echo e($cat->id); ?>"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Modifier
                                                        Catégorie</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="<?php echo e($cat->label); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="titre" name="label" required>
                                                    </div>



                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editCatBtn<?php echo e($cat->id); ?>"
                                                            class="btn w-100">Modifier&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEditCat<?php echo e($cat->id); ?> = $("#editCatBtn<?php echo e($cat->id); ?>").html()

                                            $("#editCatForm<?php echo e($cat->id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editCatBtn<?php echo e($cat->id); ?>").html(spinner)
                                                let formEditCat<?php echo e($cat->id); ?> = $("#editCatForm<?php echo e($cat->id); ?>")[0]
                                                let formdataEditCat<?php echo e($cat->id); ?> = new FormData(formEditCat<?php echo e($cat->id); ?>)

                                                axios.post("/category/update/<?php echo e($cat->id); ?>", formdataEditCat<?php echo e($cat->id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#categoriesTable").load("/dash/categoriesTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editCatBtn<?php echo e($cat->id); ?>").html(
                                                            oldvalEditCat<?php echo e($cat->id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Suppléments&nbsp;

                                <a href="" class="btn" data-bs-target="#addSuppModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="tableSupps">

                    </div>
                    <script>
                        $("#tableSupps").load("/dash/supplementsTable")
                    </script>
                    <?php
                        $supplements = Supplement::where('resto_id', Auth::user()->user_id)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $supplements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editSuppModal<?php echo e($supplement->id); ?>" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editSuppForm<?php echo e($supplement->id); ?>"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Modifier
                                                        Supplément</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="<?php echo e($supplement->label); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="titre" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1"
                                                            value="<?php echo e($supplement->price); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="prix unitaire" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editSuppBtn<?php echo e($supplement->id); ?>"
                                                            class="btn w-100">Modifier&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEdit<?php echo e($supplement->id); ?> = $("#editSuppBtn<?php echo e($supplement->id); ?>").html()

                                            $("#editSuppForm<?php echo e($supplement->id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editSuppBtn<?php echo e($supplement->id); ?>").html(spinner)
                                                let formEditSupp<?php echo e($supplement->id); ?> = $("#editSuppForm<?php echo e($supplement->id); ?>")[0]
                                                let formdataEditSupp<?php echo e($supplement->id); ?> = new FormData(formEditSupp<?php echo e($supplement->id); ?>)

                                                axios.post("/supplement/update/<?php echo e($supplement->id); ?>", formdataEditSupp<?php echo e($supplement->id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#tableSupps").load("/dash/supplementsTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editSuppBtn<?php echo e($supplement->id); ?>").html(
                                                            oldvalEdit<?php echo e($supplement->id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>

                </div>
            </div>
        </div> <!-- column -->
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Garnitures&nbsp;

                                <a href="" class="btn" data-bs-target="#addGarnitureModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            
                        </div>

                    </div>
                    <!-- title -->

                    <div class="table-responsive" id="toppingsTable">

                    </div>
                    <script>
                        $("#toppingsTable").load("/dash/toppingsTable")
                    </script>
                    <?php
                        $toppings = Garniture::where('resto_id', Auth::user()->user_id)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editToppingModal<?php echo e($topping->id); ?>" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>
                                            <div>
                                                <form action="#" id="editToppForm<?php echo e($topping->id); ?>"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Modifier
                                                        garniture</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="<?php echo e($topping->label); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="titre" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1"
                                                            value="<?php echo e($topping->price); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="prix unitaire" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editToppBtn<?php echo e($topping->id); ?>"
                                                            class="btn w-100">Modifier&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEditTopp<?php echo e($topping->id); ?> = $("#editToppBtn<?php echo e($topping->id); ?>").html()

                                            $("#editToppForm<?php echo e($topping->id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editToppBtn<?php echo e($topping->id); ?>").html(spinner)
                                                let formEditTopp<?php echo e($topping->id); ?> = $("#editToppForm<?php echo e($topping->id); ?>")[0]
                                                let formEditToppData<?php echo e($topping->id); ?> = new FormData(formEditTopp<?php echo e($topping->id); ?>)

                                                axios.post("/topping/update/<?php echo e($topping->id); ?>", formEditToppData<?php echo e($topping->id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#toppingsTable").load("/dash/toppingsTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editToppBtn<?php echo e($topping->id); ?>").html(
                                                            oldvalEdit<?php echo e($supplement->id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Sauces&nbsp;

                                <a href="" class="btn" data-bs-target="#addSaucesModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="tableSauces">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="saucesTable">
                        </table>
                    </div>
                    <script>
                        $("#saucesTable").load("/dash/saucesTable")
                    </script>
                    <?php
                        $saucess = Sauce::where('resto_id', Auth::user()->user_id)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $saucess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editSauceModal<?php echo e($sc->id); ?>" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editSauceForm<?php echo e($sc->id); ?>"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Modifier
                                                        Sauce</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="<?php echo e($sc->label); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="titre" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1" value="<?php echo e($sc->price); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="prix unitaire" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editSauceBtn<?php echo e($sc->id); ?>"
                                                            class="btn w-100">Modifier&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEditSauce<?php echo e($sc->id); ?> = $("#editSauceBtn<?php echo e($sc->id); ?>").html()

                                            $("#editSauceForm<?php echo e($sc->id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editSauceBtn<?php echo e($sc->id); ?>").html(spinner)
                                                let formEditSauce<?php echo e($sc->id); ?> = $("#editSauceForm<?php echo e($sc->id); ?>")[0]
                                                let formdataEditSauce<?php echo e($sc->id); ?> = new FormData(formEditSauce<?php echo e($sc->id); ?>)

                                                axios.post("/sauce/update/<?php echo e($sc->id); ?>", formdataEditSauce<?php echo e($sc->id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#saucesTable").load("/dash/saucesTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editSauceBtn<?php echo e($sc->id); ?>").html(
                                                            oldvalEditSauce<?php echo e($sc->id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Boissons&nbsp;

                                <a href="" class="btn" data-bs-target="#addDrinksModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="drinksTable">


                    </div>
                    <script>
                        $("#drinksTable").load("/dash/drinksTable")
                    </script>
                    <?php
                        $drinkss = Drink::where('resto_id', Auth::user()->user_id)->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $drinkss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <div class="modal fade" id="editDrinkModal<?php echo e($dr->id); ?>" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editDrinkForm<?php echo e($dr->id); ?>"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Modifier
                                                        Drink</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="<?php echo e($dr->label); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="titre" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1"
                                                            value="<?php echo e($dr->price); ?>"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="prix unitaire" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editDrinkBtn<?php echo e($dr->id); ?>"
                                                            class="btn w-100">Modifier&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEditDrink<?php echo e($dr->id); ?> = $("#editDrinkBtn<?php echo e($dr->id); ?>").html()

                                            $("#editDrinkForm<?php echo e($dr->id); ?>").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editDrinkBtn<?php echo e($dr->id); ?>").html(spinner)
                                                let formEditDrink<?php echo e($dr->id); ?> = $("#editDrinkForm<?php echo e($dr->id); ?>")[0]
                                                let formdataEditDrink<?php echo e($dr->id); ?> = new FormData(formEditDrink<?php echo e($dr->id); ?>)

                                                axios.post("/drink/update/<?php echo e($dr->id); ?>", formdataEditDrink<?php echo e($dr->id); ?>)
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#drinksTable").load("/dash/drinksTable")
                                                        }, 700);

                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                        if (err.response.data.type != undefined) {

                                                            toastr.error(err.response.data.message)
                                                        } else {
                                                            for (const k in err.response.data) {
                                                                toastr.error(err.response.data[k])

                                                            }
                                                        }
                                                    }).finally(() => {
                                                        $("#editDrinkBtn<?php echo e($dr->id); ?>").html(
                                                            oldvalEditSauce<?php echo e($dr->id); ?>)
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        // function LoadDataTable() {
        //     $(".table").DataTable({
        //         "language": {
        //             "decimal": ".",
        //             "emptyTable": "There is no records yet",
        //             "info": "",
        //             "infoFiltered": "",
        //             "infoEmpty": "",
        //             "lengthMenu": "",
        //         }
        //     });
        // }
        // $(window).on("load", function() {
        //     $(".table").DataTable({
        //         "language": {
        //             "decimal": ".",
        //             "emptyTable": "There is no records yet",
        //             "info": "",
        //             "infoFiltered": "",
        //             "infoEmpty": "",
        //             "lengthMenu": "",
        //         }
        //     });
        // });
        // setInterval(() => {
        //     $('.table').DataTable().ajax.reload();
        // }, 1000);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/menu.blade.php ENDPATH**/ ?>