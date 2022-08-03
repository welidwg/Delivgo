





<?php $__env->startSection('title'); ?>
    Tableau de bord
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_path'); ?>
    Tableau de bord
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_title'); ?>
    <span class="d-flex align-items-center justify-content-between"> Bienvenue , <?php echo e($user->name); ?>

        <div class="form-check form-switch">
            <label class="form-check-label fs-4 text-dark" id="ondutylabel" for="onduty"></label>

            <input class="form-check-input" type="checkbox" role="switch" id="onduty"
                <?php echo e(Auth::user()->onDuty ? 'checked' : ''); ?>>
            <script>
                if ($('#onduty').is(":checked")) {
                    $("#ondutylabel").html("En service")
                } else {
                    $("#ondutylabel").html("Hors service")

                }
                $('#onduty').on("change", (e) => {
                    if ($('#onduty').is(":checked")) {
                        $("#ondutylabel").html("En service")
                    } else {
                        $("#ondutylabel").html("Hors service")

                    }
                    axios.post("/user/update/duty/<?php echo e(Auth::user()->user_id); ?>")
                        .then(res => {
                            console.log(res)
                            toastr.info(res.data.message)
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error("Quelque chose s'est mal passé")

                        })
                })
            </script>

        </div>

    </span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->type == 4): ?>
        <div class="row">
            <div class="col-md-4 col-xl-3 mb-2">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a href="#!" id="addRegBtn" data-bs-toggle="modal" data-bs-target="#addReg">Ajouter
                                        region</a>
                                    <div class="modal fade" id="addReg" tabindex="-1" role="dialog" aria-labelledby=""
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-0">
                                                <div class="modal-body p-4 px-5 ">


                                                    <div class="main-content  mb-3 py-auto">

                                                        <a href="#" style="" class="close-btn"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><span
                                                                    class="fal fa-times"></span></span>
                                                        </a>




                                                        <div>
                                                            <form action="#" id="AddRegForm" class="formsModal">
                                                                <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                                                    Ajouter région</h6>

                                                                <div
                                                                    class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                                    <label for="" class="px-2 color-3 fs-5"><i
                                                                            class="fal fa-tag"></i></label>
                                                                    <input type="text"
                                                                        class="form-control shadow-none border-0  bg-transparent"
                                                                        placeholder="Nom" name="label" required>
                                                                    <small class="text-danger text-center"
                                                                        style="font-size: 9px">*
                                                                        Séparez les nom par des
                                                                        virgules ' <strong
                                                                            style="font-size: 11px">,</strong> ' si vous
                                                                        voulez
                                                                        ajouter
                                                                        plusieurs</small>
                                                                </div>
                                                                <div
                                                                    class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                                    <label for="" class="px-2 color-3 fs-5"><i
                                                                            class="fal fa-coins"></i></label>
                                                                    <input type="number" step="0.1"
                                                                        class="form-control shadow-none border-0  bg-transparent"
                                                                        placeholder="frais de livraison" name="prix"
                                                                        required>
                                                                </div>


                                                                <div class="mx-auto mt-3">
                                                                    <button href="#!" type="submit" id="aDDrEGsUBMIT"
                                                                        class="btn w-100">Ajouter&nbsp;
                                                                        <i class="fal fa-check"></i></button>
                                                                </div>
                                                                <?php echo csrf_field(); ?>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <script>
                                                        let oldvalEdit = $("#aDDrEGsUBMIT").html()

                                                        $("#AddRegForm").on("submit", (e) => {
                                                            e.preventDefault()
                                                            $("#aDDrEGsUBMIT").html(spinner)

                                                            axios.post("/region/add", $("#AddRegForm").serialize())
                                                                .then(res => {
                                                                    toastr.info(res.data.message)
                                                                    $(".modal").modal("hide")


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
                                                                    $("#aDDrEGsUBMIT").html(oldvalEdit)
                                                                })


                                                        })
                                                    </script>


                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-auto"><i class="far fa-map-marker-alt fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a data-bs-toggle="modal" data-bs-target="#addFrais">Fixer frais de nuit</a>

                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>
    <ul class="nav justify-content-end flex-column">
        <li class="nav-item" style="">
            <a class="nav-link  text-primary" href="#commandes"><i class="fal fa-angle-double-right"></i>&nbsp;Commandes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="#demandes"><i class="fal fa-angle-double-right"></i>&nbsp;Demandes de
                livreurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="#"><i class="fal fa-angle-double-right"></i>&nbsp;Commande par
                message</a>
        </li>
        
    </ul>
    <div id="mainContent">

    </div>
    <div class="modal fade" id="addFrais" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">


                    <div class="main-content  mb-3 py-auto">

                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>




                        <div>
                            <form action="#" method="post" id="AddFraisForm" class="formsModal">
                                <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                    Frais de nuit</h6>
                                <?php
                                    use App\Models\Config;
                                    $check = Config::where('id', '!=', null)->first();
                                    $frais = null;
                                    if ($check) {
                                        $frais = $check->frais_nuit;
                                    }
                                    
                                ?>

                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                    <input type="number" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Frais" name="frais_nuit" required value="<?php echo e($frais); ?>">

                                </div>
                                <?php echo csrf_field(); ?>


                                <div class="mx-auto mt-3">
                                    <button href="#!" type="submit" id="addfraisbtn"
                                        class="btn w-100">Ajouter&nbsp;
                                        <i class="fal fa-check"></i></button>
                                </div>
                            </form>

                        </div>

                    </div>



                </div>


            </div>
        </div>

    </div>
    <script>
        let oldvalEditFrais = $("#addfraisbtn").html()


        $("#AddFraisForm").on("submit", (e) => {
            console.log("test");
            e.preventDefault()
            $("#addfraisbtn").html(spinner)


            axios.post("/configs/add", $("#AddFraisForm").serialize())
                .then(res => {
                    toastr.info(res.data.message)
                    $(".modal").modal("hide")


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
                    $("#addfraisbtn").html(oldvalEditFrais)
                })


        })
    </script>
    <script>
        function LoadContentMain() {
            $("#mainContent").load("/dash/mainContent")
            setTimeout(() => {
                LoadContentMain()
            }, 14000);

        }
        LoadContentMain()
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/main.blade.php ENDPATH**/ ?>