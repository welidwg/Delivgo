
<?php

use App\Models\Category;
use App\Models\Config;

$categories = Category::where('resto_id', $resto->user_id)->get();

?>
<?php $__env->startSection('content'); ?>
    <style>
        .floatBtn {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 20px;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
            z-index: 999 !important;
        }
    </style>
    <?php if(Auth::check()): ?>
        <a data-bs-target="#textCommand" data-bs-toggle="modal"
            class="floatBtn bg-primary d-flex align-items-center justify-content-center">
            <i class="fab fa-facebook-messenger fs-3 my-float"></i>
        </a>
        <div class="modal fade in" id="textCommand" aria-labelledby="textCommand" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">



                        <div class="main-content text-center mb-3 py-auto">
                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                            </a>


                            <form action="#" class="formsModal" id="messageForm">
                                <h6 for="" class="mb-3 fs-3 color-3">Commande par message</h6>

                                <div class="input-group mb-2 rounded bg-light  align-items-center">

                                    <textarea style="resize: none" rows="5" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Votre commande par details" name="message"></textarea>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>">
                                <input type="hidden" name="resto_id" value="<?php echo e($resto->user_id); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="mx-auto mt-3">
                                    <button type="submit" class="btn w-100" id="btnLogin">Passez la commande <i
                                            class="fal fa-check"></i></button>
                                </div>
                            </form>
                            <script>
                                $("#messageForm").on("submit", (e) => {
                                    e.preventDefault()
                                    axios.post("/commandeMessage/add", $("#messageForm").serialize())
                                        .then(res => {
                                            toastr.success(res.data.message)
                                            $("#messageForm").trigger("reset")
                                            $(".modal").modal("hide")
                                        })
                                        .catch(err => {
                                            console.error(err);
                                            toastr.error("Quelque chose s'est mal passé")

                                        })

                                })
                            </script>

                        </div>




                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if($resto->address == '' || $categories->count() == 0): ?>
        <div class="modal fade in" id="Astuces" aria-labelledby="astuces" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">



                        <div class="main-content text-center mb-3 py-auto">


                            <?php if(Auth::check()): ?>
                                <label for="" class="mb-3 fs-1 color-3">Bienvenue,<br>
                                    <?php echo e(Auth::user()->name); ?></label>
                            <?php else: ?>
                                <label for="" class="mb-3 fs-1 color-3">Bienvenue chère invité</label>
                            <?php endif; ?>

                            <p class="fw-bold">Le compte de ce restaurant est actuellement sous maintenance.<br>
                                Veuillez revenir ulterierement
                                <br>
                                Merci.


                            </p>

                            <div class="mx-auto mt-3">
                                <a href=<?php echo e(url('/')); ?> id="checkBtnSubmit" class="btn  w-100"><i
                                        class="fad fa-angle-double-left"></i> Allez vers l'accueil</a>
                            </div>

                        </div>




                    </div>

                </div>
            </div>
        </div>
        <script>
            $(window).on("load", function() {
                $('#Astuces').modal('show');
                // $("#launchAstuces").click()

                // document.getElementById("launchAstuces").click();

            });
        </script>
    <?php endif; ?>
    <script></script>
    <section class="inner-page-hero bg-image  bg-color-3 shadow-sm "
        style="position: sticky;top:0px;left:0;right:0;z-index: -998 !important;">
        <div class="profile mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <!-- <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="image-wrap">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <figure><img id="logoResto" src="images/cabane.jpg" alt="" style="width:10rem"></figure>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div> -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 profile-desc animate__animated animate__fadeInDown">
                        <div class=" p-3 ">
                            <div class="row align-items-center justify-content-center">
                                <div class="col col-sm-12 col-lg-2 col-md-2">
                                    <img src="<?php echo e(asset("uploads/logos/$resto->avatar")); ?>"
                                        class="img-fluid  rounded-circle p-2">

                                </div>
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-2 text-white fw-bold text-center"><?php echo e($resto->name); ?></h4>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="bg-white " style="z-index: 1 !important;position: relative;">

        <section class="contact bg-light" style="padding: 0px !important;">
            <div class="info-wrap
            animate__animated animate__fadeInUp">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 info mx-auto">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Localisation:</h4>
                        <p><?php echo e($resto->address); ?><br><?php echo e($resto->region->label); ?>, Tunisie</p>
                    </div>

                    <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-clock"></i>
                        <h4>Disponibilité:</h4>
                        <?php if($resto->onDuty): ?>
                            <p><span class="text-success fw-bold">En service</span></p>
                        <?php else: ?>
                            <p><span class="text-danger fw-bold">Hors service</span></p>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0 info mx-auto">
                        <i class="fal fa-coins"></i>
                        <h4>Frais de livraison:</h4>

                        <p>
                            <?php
                                
                                $frais = Config::latest()->first();
                                
                                $current_time = date('h:i a');
                                $sunrise = '22:00 pm';
                                $sunset = '06:26 am';
                                $date1 = DateTime::createFromFormat('h:i a', date('h:i a'));
                                $date2 = DateTime::createFromFormat('h:i a', $sunrise);
                                $date3 = DateTime::createFromFormat('h:i a', $sunset);
                            ?>

                            <?php if($date1 > $date2 && $date1 < $date3): ?>
                                <span class="fw-bold"><?php echo e($frais->frais_nuit); ?> Dt</span>
                            <?php else: ?>
                                <?php if($resto->deliveryPrice != 0 && $resto->deliveryPrice != null): ?>
                                    <span class="fw-bold"><?php echo e($resto->region->deliveryPrice); ?> dt</span>
                                <?php else: ?>
                                    <span class="fw-bold text-success">gratuit</span>
                                <?php endif; ?>
                            <?php endif; ?>




                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Téléphone:</h4>
                        <p>
                            <a href="tel:+216 <?php echo e($resto->phone); ?>">+216 <?php echo e($resto->phone); ?></a>

                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="menu">
            <div class="container">

                <div class="bg-white mb-3">
                    <div class="section-title">
                        <h2 class="">Verifiez notre délicieux <span>Menu</span></h2>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="menu-flters">
                                <li data-filter="*" class="filter-active">Tous</li>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li data-filter=".<?php echo e(str_replace(' ', '', $cat->label)); ?>"><?php echo e($cat->label); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    Aucune catégorie encore
                                <?php endif; ?>
                                
                            </ul>
                        </div>
                    </div>
                    <form action="" class="mb-2">
                        <div class="input-group rounded-pill border-1 shadow-sm  justify-content-between align-items-center  "
                            style="background-color:#f8f5f5">
                            <button type="submit" class="btn  mx-2 bg-transparent border-none color-dark ">
                                <i class="fas fa-search text-muted "></i>
                            </button>
                            <input type="text" placeholder="Rechercher dans <?php echo e($resto->name); ?>"
                                class="rounded-pill p-2 color-dark px-2 bg-transparent form-control border-0  shadow-none" />
                        </div>
                    </form>
                </div>
                <div class="row menu-container">

                    <?php $__empty_1 = true; $__currentLoopData = $resto->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-lg-6  menu-item <?php echo e(str_replace(' ', '', $product->category->label)); ?> "
                            id="productsCont<?php echo e($product->product_id); ?>">

                            <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                                <img class="flex-shrink-0 img-fluid rounded " width="120px"
                                    style="max-height: 120px;height: 120px"
                                    src="<?php echo e(asset("uploads/products/$product->picture")); ?>" alt="">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                        <span><?php echo e($product->label); ?></span>
                                        <br />

                                        <span class="fw-light fs-5 color-1"> <i class="fal fa-coins"></i>
                                            <?php echo e($product->price); ?> DT</span>

                                    </h5>
                                    <?php if($product->description != ''): ?>
                                        <small style="min-height: 60px;height:auto;position: relative;">
                                            <?php echo e($product->description); ?>

                                            
                                        </small>
                                    <?php else: ?>
                                        <small>
                                            <?php echo e($product->label); ?>

                                            
                                        </small>
                                    <?php endif; ?>

                                    <div class="col-lg-12 " style="text-align: right">

                                        <?php if(Auth::check()): ?>
                                            <?php if($resto->onDuty): ?>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#AddtoCartModal<?php echo e($product->product_id); ?>"
                                                    class="btn color-dark fs-4 align-self-end"
                                                    style="border-radius: 12px"><i class="fal fa-cart-plus"></i></button>
                                            <?php else: ?>
                                                <button type="button" id="notAvailable<?php echo e($product->product_id); ?>"
                                                    class="btn color-dark fs-4 align-self-end"
                                                    style="border-radius: 12px"><i class="fal fa-cart-plus"></i></button>
                                                <script>
                                                    $("#notAvailable<?php echo e($product->product_id); ?>").on("click", (e) => {
                                                        toastr.error("Ce restaurant est hors service pour le moment")
                                                    })
                                                </script>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="button" id="loginMust<?php echo e($product->product_id); ?>"
                                                class="btn color-dark fs-4 align-self-end" style="border-radius: 12px"><i
                                                    class="fal fa-cart-plus"></i></button>
                                            <script>
                                                $("#loginMust<?php echo e($product->product_id); ?>").on("click", (e) => {
                                                    toastr.error("Il faudra que vous se connecter d'abord !")
                                                })
                                            </script>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="AddtoCartModal<?php echo e($product->product_id); ?>"
                            aria-labelledby="AddtoCartModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content text-center mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>


                                            <h6 for="" class="mb-3 fs-3 color-3"><?php echo e($product->label); ?><br>
                                                <small class="text-muted" style="font-size: 17px"><?php echo e($product->price); ?>

                                                    DT</small>

                                            </h6>

                                            <form action="#" class="formsModal"
                                                id="addtocart<?php echo e($product->product_id); ?>">
                                                <input type="hidden" value="<?php echo e($product->product_id); ?>"
                                                    name="product_id">
                                                <input type="hidden" value="<?php echo e($resto->user_id); ?>" name="resto_id">
                                                <div class="border rounded p-3">
                                                    <div
                                                        class="input-group my-auto mb-1 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"
                                                            style="width: auto">Quantité : </label>
                                                        <input type="number" value="1"
                                                            class="form-control disabled shadow-none border-0 text-center bg-transparent"
                                                            placeholder="How much you want ?"
                                                            id="quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>"
                                                            name="quantity<?php echo e($product->product_id); ?>">
                                                        <div class="d-flex flex-column align-items-center px-3 py-auto">
                                                            <a class=" fw-bold" id="incr<?php echo e($product->product_id); ?>">
                                                                <i class="fas fa-plus"></i>

                                                            </a>
                                                            <a class=" fw-bold" id="decr<?php echo e($product->product_id); ?>">
                                                                <i class="fas fa-minus"></i>

                                                            </a>

                                                        </div>
                                                        <script>
                                                            $("#incr<?php echo e($product->product_id); ?>").on("click", (e) => {
                                                                Increment('quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>',
                                                                    'Total<?php echo e($product->product_id); ?>',
                                                                    'UnitTotal<?php echo e($product->product_id); ?>')
                                                            })
                                                            $("#decr<?php echo e($product->product_id); ?>").on("click", (e) => {
                                                                Decrement('quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>',
                                                                    'Total<?php echo e($product->product_id); ?>',
                                                                    'UnitTotal<?php echo e($product->product_id); ?>')
                                                            })
                                                        </script>
                                                    </div>
                                                </div>


                                                <?php if($product->have_toppings): ?>
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-sandwich"></i> Choisissez vos garnitures :
                                                            <br> <small class="text-success">Maximum :
                                                                <?php echo e($resto->configs[0]->perTopp); ?></small>
                                                        </h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            <?php $__currentLoopData = $resto->toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="topping<?php echo e($topping->id . $product->product_id); ?>"
                                                                        value="<?php echo e($topping->id); ?>"
                                                                        name="topping<?php echo e($product->product_id); ?>[]">
                                                                    <label class=" text-left" style="width: auto"
                                                                        for="topping<?php echo e($topping->id . $product->product_id); ?>"><?php echo e($topping->label); ?>

                                                                        <span class="text-success ">
                                                                            <?php echo e($topping->price != 0 ? '+ ' . $topping->price . ' DT' : 'gratuit'); ?>

                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#topping<?php echo e($topping->id . $product->product_id); ?>").on("change", (e) => {
                                                                        if ($("#topping<?php echo e($topping->id . $product->product_id); ?>").is(":checked")) {
                                                                            // let total = parseFloat($("#Total<?php echo e($product->product_id); ?>").html())
                                                                            // let newTotal = total + parseFloat("<?php echo e($topping->price); ?>")
                                                                            // $("#Total<?php echo e($product->product_id); ?>").html(newTotal)
                                                                            InrementTotal("<?php echo e($topping->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')
                                                                        } else {

                                                                            // $("#Total<?php echo e($product->product_id); ?>").html(parseFloat($(
                                                                            //     "#Total<?php echo e($product->product_id); ?>").html()) - parseFloat(
                                                                            //     "<?php echo e($topping->price); ?>"))
                                                                            DecrementTotal("<?php echo e($topping->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')

                                                                        }
                                                                    })
                                                                    $("input[name='topping<?php echo e($product->product_id); ?>[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("<?php echo e($resto->configs[0]->perTopp); ?>");
                                                                        var cnt = $("input[name='topping<?php echo e($product->product_id); ?>[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='topping<?php echo e($product->product_id); ?>[]']").filter(':not(:checked)').prop('disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='topping<?php echo e($product->product_id); ?>[]']").prop('disabled',
                                                                                false)
                                                                        }


                                                                    })
                                                                </script>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>



                                                <?php if($product->have_supplement): ?>
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-utensils-alt"></i> Choisissez vos suppléments
                                                            <br> <small class="text-success">Maximum :
                                                                <?php echo e($resto->configs[0]->perSupp); ?></small>
                                                        </h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            <?php $__currentLoopData = $resto->supplements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="supplement<?php echo e($supplement->id . $product->product_id); ?>"
                                                                        value="<?php echo e($supplement->id); ?>"
                                                                        name="supplement<?php echo e($product->product_id); ?>[]">
                                                                    <label class="text-left" style="width: auto"
                                                                        for="supplement<?php echo e($supplement->id . $product->product_id); ?>"><?php echo e($supplement->label); ?>

                                                                        <span class="text-success fw-bold">
                                                                            +<?php echo e($supplement->price); ?> DT
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#supplement<?php echo e($supplement->id . $product->product_id); ?>").on("change", (e) => {
                                                                        if ($("#supplement<?php echo e($supplement->id . $product->product_id); ?>").is(":checked")) {

                                                                            InrementTotal("<?php echo e($supplement->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')
                                                                        } else {


                                                                            DecrementTotal("<?php echo e($supplement->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')

                                                                        }
                                                                    })
                                                                    $("input[name='supplement<?php echo e($product->product_id); ?>[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("<?php echo e($resto->configs[0]->perSupp); ?>");;
                                                                        var cnt = $("input[name='supplement<?php echo e($product->product_id); ?>[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='supplement<?php echo e($product->product_id); ?>[]']").filter(':not(:checked)').prop(
                                                                                'disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='supplement<?php echo e($product->product_id); ?>[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($product->have_sauces): ?>
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-hat-chef"></i> Choisissez vos
                                                            sauces<br> <small class="text-success">Maximum :
                                                                <?php echo e($resto->configs[0]->perSauce); ?></small></h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            <?php $__currentLoopData = $resto->sauces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sauce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="sauce<?php echo e($sauce->id . $product->product_id); ?>"
                                                                        value="<?php echo e($sauce->id); ?>"
                                                                        name="sauces<?php echo e($product->product_id); ?>[]">
                                                                    <label class=" text-left" style="width: auto"
                                                                        for="sauce<?php echo e($sauce->id . $product->product_id); ?>"><?php echo e($sauce->label); ?>

                                                                        <span class="text-success ">
                                                                            <?php echo e($sauce->price != 0 ? '+ ' . $sauce->price . ' DT' : 'gratuit'); ?>

                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#sauce<?php echo e($sauce->id . $product->product_id); ?>").on("change", (e) => {
                                                                        if ($("#sauce<?php echo e($sauce->id . $product->product_id); ?>").is(":checked")) {

                                                                            InrementTotal("<?php echo e($sauce->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')
                                                                        } else {


                                                                            DecrementTotal("<?php echo e($sauce->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')

                                                                        }
                                                                    })
                                                                    $("input[name='sauces<?php echo e($product->product_id); ?>[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("<?php echo e($resto->configs[0]->perSauce); ?>");;
                                                                        var cnt = $("input[name='sauces<?php echo e($product->product_id); ?>[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='sauces<?php echo e($product->product_id); ?>[]']").filter(':not(:checked)').prop('disabled',
                                                                                true)
                                                                        } else {
                                                                            $("input[name='sauces<?php echo e($product->product_id); ?>[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($product->have_drinks): ?>
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-cocktail"></i> Choisissez vos boissons :<br>
                                                            <small class="text-success">Maximum :
                                                                <?php echo e($resto->configs[0]->perDrink); ?></small>
                                                        </h6>


                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            <?php $__currentLoopData = $resto->drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="drink<?php echo e($drink->id . $product->product_id); ?>"
                                                                        value="<?php echo e($drink->id); ?>"
                                                                        name="drink<?php echo e($product->product_id); ?>[]">
                                                                    <label class="text-left" style="width: auto"
                                                                        for="drink<?php echo e($drink->id . $product->product_id); ?>"><?php echo e($drink->label); ?>

                                                                        <span class="text-success fw-bold">
                                                                            +<?php echo e($drink->price); ?> DT
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#drink<?php echo e($drink->id . $product->product_id); ?>").on("change", (e) => {
                                                                        if ($("#drink<?php echo e($drink->id . $product->product_id); ?>").is(":checked")) {

                                                                            InrementTotal("<?php echo e($drink->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')
                                                                        } else {


                                                                            DecrementTotal("<?php echo e($drink->price); ?>", "Total<?php echo e($product->product_id); ?>",
                                                                                'UnitTotal<?php echo e($product->product_id); ?>',
                                                                                'quantity<?php echo e($product->product_id); ?><?php echo e($resto->user_id); ?>')

                                                                        }
                                                                    })
                                                                    $("input[name='drink<?php echo e($product->product_id); ?>[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("<?php echo e($resto->configs[0]->perDrink); ?>");;
                                                                        var cnt = $("input[name='drink<?php echo e($product->product_id); ?>[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='drink<?php echo e($product->product_id); ?>[]']").filter(':not(:checked)').prop('disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='drink<?php echo e($product->product_id); ?>[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                
                                                <?php echo csrf_field(); ?>
                                            </form>

                                        </div>
                                    </div>
                                    <div
                                        class="modal-footer bg-white d-flex align-items-center justify-content-between w-100">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <strong class="color-1">
                                                <i class="fal fa-coins"></i>
                                                Total &nbsp;(DT):
                                            </strong>
                                            <input type="number" disabled
                                                class="form-control border-0 shadow-none bg-white text-dark"
                                                style="width: 100px" id="Total<?php echo e($product->product_id); ?>"
                                                value="<?php echo e($product->price); ?>" step="0.1" />
                                            <input type="hidden" id="UnitTotal<?php echo e($product->product_id); ?>"
                                                value="<?php echo e($product->price); ?>" step="0.1" />


                                        </div>
                                        <button class="btn "
                                            onclick="submitForm('addtocart<?php echo e($product->product_id); ?>')"> <i
                                                class="fal fa-cart-plus "></i>Ajoutez au panier </button>
                                    </div>
                                    <script></script>

                                </div>
                            </div>
                        </div>
                        <script>
                            $("#AddtoCartModal<?php echo e($product->product_id); ?>").appendTo("body")
                        </script>
                        <script>
                            function submitForm(id) {
                                $("#" + id).trigger("submit")
                            }
                            $("#addtocart<?php echo e($product->product_id); ?>").on('submit', (e) => {
                                e.preventDefault();

                                let form = $("#addtocart<?php echo e($product->product_id); ?>")[0]
                                let formData = new FormData(form)
                                formData.append("total", $("#Total<?php echo e($product->product_id); ?>").val())
                                formData.append("UnitTotal", $("#UnitTotal<?php echo e($product->product_id); ?>").val())
                                axios.post("/cart/add", formData)
                                    .then(res => {
                                        toastr.info(res.data)
                                        $(".modal").modal("hide");
                                        $("#addtocart<?php echo e($product->product_id); ?>").trigger("reset");
                                        $("#cart").load("/cartContent")
                                        $("#UnitTotal<?php echo e($product->product_id); ?>").val('<?php echo e($product->price); ?>')
                                        $("#Total<?php echo e($product->product_id); ?>").val('<?php echo e($product->price); ?>')
                                    })
                                    .catch(err => {
                                        toastr.error(err.response.data)
                                    })
                            })
                        </script>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo $__env->make('main/layouts/notfound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <span class="text-center fs-4 fw-bold mx-auto">Il n'ya pas des produits !</span>
                    <?php endif; ?>




                    <script>
                        function Increment(id, idTotal, unitP) {
                            let inp = document.getElementById(id)
                            inp.value++
                            let unitprice = document.getElementById(unitP)
                            let valueTotal = parseFloat(document.getElementById(idTotal).value);
                            let newval = unitprice.value * inp.value
                            document.getElementById(idTotal).value = newval
                        }


                        function Decrement(id, idTotal, unitP) {
                            let inp = document.getElementById(id);
                            let unitprice = document.getElementById(unitP)

                            if (parseInt(inp.value) != 1) {
                                inp.value--
                                let valueTotal = parseFloat(document.getElementById(idTotal).value);
                                let newval = valueTotal - parseFloat(unitprice.value)
                                document.getElementById(idTotal).value = parseFloat(newval)
                            }

                        }
                    </script>
                    <script>
                        function InrementTotal(label, id, unitP, qte) {
                            let input = document.getElementById(id)
                            let val = parseFloat($("#" + id).val())
                            let quantity = parseFloat(document.getElementById(qte).value)
                            let unitprice = document.getElementById(unitP)

                            unitprice.value = parseFloat(unitprice.value) + (parseFloat(label))
                            // $("#" + id).attr("value", parseFloat(label))
                            let newval = val + (parseFloat(label) * quantity)
                            input.value = newval



                            // input.value = input.value + parseFloat(label);
                            // $("#" + id).val(label + $("#" + id).val())
                            // $("#" + id).html(parseFloat($("#" + id).html()) + parseFloat(label))
                        }

                        function DecrementTotal(label, id, unitP, qte) {
                            let input = document.getElementById(id)
                            let quantity = parseFloat(document.getElementById(qte).value)
                            let val = parseFloat($("#" + id).val())
                            let newval = val - (parseFloat(label) * quantity)

                            let unitprice = document.getElementById(unitP)
                            unitprice.value = parseFloat(unitprice.value) - (parseFloat(label))
                            input.value = newval

                            // $("#" + id).val( $("#" + id).val()-label)
                            // $("#" + id).html(parseFloat($("#" + id).html()) - parseFloat(label))
                        }
                    </script>
                    



                </div>

            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/pages/menu.blade.php ENDPATH**/ ?>