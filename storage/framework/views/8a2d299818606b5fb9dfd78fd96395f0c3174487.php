
<?php $__env->startSection('content'); ?>
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">


                <div class="carousel-inner" role="listbox">

                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="background-image: url(images/hero-bg-2.jpg);">
                        <div class="carousel-container">

                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown display-1"><span>Deliv</span>Go</h2>
                                <p class="animate__animated animate__fadeInUp w-100 fs-5 fw-bold subtitle">DELIVERING GOOD
                                    VIBES
                                    <br>

                                </p>

                                <div class="mb-5">
                                    
                                    
                                </div>
                                <div class=" animate__animated animate__fadeInUp">
                                    <form action="" id="searchLoc">
                                        <?php
                                        $ip = '197.5.62.69'; //Dynamic IP address get
                                        $data = \Location::get($ip);
                                        ?>
                                        <div
                                            class="input-group rounded-pill w-100 border-0 shadow sm bg-light justify-content-between align-items-center">
                                            <button class="btn fs-5 w-25 bg-transparent d-lg-none border-none color-1 ">
                                                <i class="fas fa-flag"></i> </button>
                                            <input type="text" placeholder="Quel est votre adresse" id=""
                                                class="rounded-pill mx-3 color-dark   bg-transparent form-control border-0 fs-5 shadow-none" />
                                            <button type="submit " onclick="getLocation()"
                                                class="btn d-none d-lg-flex color-1  align-items-center justify-content-around  fw-bold mx-2 bg-transparent border-none color-primary ">
                                                <i class="fas fa-map-marker-alt mx-2"></i>
                                                Utiliser ma position

                                            </button>
                                            <span id="tete"></span>
                                        </div>
                                        <a class=" mt-2 text-white fw-bold fs-4 d-block d-lg-none">
                                            Utiliser ma position
                                            <i class="fas fa-map-marker-alt"></i>

                                        </a>
                                    </form>
                                    <script>
                                        $("#searchLoc").on("submit", (e) => {
                                            e.preventDefault()
                                        })
                                    </script>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>



            </div>
        </div>
    </section>


    <section id="menu" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Nos <span>Restaurants</span></h2>
                <p class="fw-bold" style="letter-spacing: 3px">Ceci nos collaborateurs</p>
            </div>

            <div class="row restoCard" style="zoom: 0.97">
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
                                                <?php echo e($resto->address); ?> , <?php echo e($resto->city); ?></span>
                                            
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

        </div>
    </section>
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Pourquoi <span>Delivgo </span> ?</h2>
                
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="box">
                        <span><i class="fal fa-store"></i></span>
                        <h4>Les meilleurs restaurants</h4>
                        <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <span><i class="fal fa-biking-mountain"></i></span>
                        <h4>Livraison rapide</h4>
                        <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno
                            para dest</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <span><i class="fal fa-user-headset"></i></span>
                        <h4> Support idéal</h4>
                        <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <section id="join-us" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Rejoignez <span>Delivgo </span></h2>
                
            </div>
            <div class="row text-center d-flex align-items-center justify-content-center ">
                <div class="col-md-4 mb-5 mb-lg-0 d-flex align-items-center">
                    <div class="card testimonial-card">
                        <div class="card-up" style="background-color: #9d789b;"></div>
                        <div class="avatar mx-auto bg-white p-3">
                            <img src="<?php echo e(asset('images/livreur.webp')); ?>" class="rounded-circle img-fluid "
                                style="width: 200px;height: 200px" />
                        </div>
                        <div class="card-body">
                            <h4 class="mb-2 fs-3 fw-bolder">Devenir livreur</h4>
                            <hr>
                            <p class="dark-grey-text mt-4 " style="height: 70px">
                                Livrez avec Delivgo pour gagner des revenus
                                compétitifs.
                            </p>
                            <button data-bs-toggle="modal" data-bs-target="#delivererModal"
                                class="btn  text-white rounded-pill bg-color-1">Rejoignez-nous
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0 d-flex align-items-center">
                    <div class="card testimonial-card">
                        <div class="card-up" style="background-color: #9d789b;"></div>
                        <div class="avatar mx-auto bg-white p-3">
                            <img src="<?php echo e(asset('images/restaurant.jpg')); ?>" class="rounded-circle img-fluid "
                                style="width: 200px;height: 200px" />
                        </div>
                        <div class="card-body">
                            <h4 class="mb-2 fs-3 fw-bolder">Devenir partenaire</h4>
                            <hr>
                            <p class="dark-grey-text mt-4" style="height: 70px">
                                Boostez vos ventes grâce à notre technologie.
                                <br>
                            </p>
                            <button class="btn  text-white rounded-pill bg-color-1">Rejoignez-nous
                            </button>
                        </div>


                    </div>
                </div>


            </div>

        </div>
    </section>
    <div class="modal fade" id="delivererModal" tabindex="-1" role="dialog" aria-labelledby="delivererModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">


                    <div class="main-content text-center mb-3 py-auto">

                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" class="formsModal" id="DelivererForm">
                            <h6 for="" class="mb-3 fs-3 color-3">Devenir un livreur</h6>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                <input type="text" class="form-control shadow-none border-0 text-center bg-transparent"
                                    placeholder="Votre Nom" name="name" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-phone"></i></label>
                                <input type="tel" class="form-control shadow-none border-0 text-center bg-transparent"
                                    placeholder="Votre numéro" name="phone" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                                <input type="email" name="email"
                                    class="form-control shadow-none border-0 text-center bg-transparent"
                                    placeholder="Votre email" required>
                            </div>
                            <input type="hidden" name="type" value="3">
                            <div class="mx-auto mt-3">
                                <button type="submit" class="btn w-100" id="btnLivreur">Envoyez la demande &nbsp;<i
                                        class="fal fa-check"></i></button>
                            </div>

                    </div>


                    </form>

                </div>
                <script>
                    $("#DelivererForm").on("submit", (e) => {
                        e.preventDefault();
                        $('#btnLivreur').html(spinner);
                        axios.post("/demande/add/deliverer", $('#DelivererForm').serialize()).then((res) => {
                            toastr.success("Dzmande envoyée ! ")
                            $("#DelivererForm").trigger("reset")

                            setTimeout(() => {
                                $(".modal").modal("hide");

                            }, 700);

                        }).catch((err) => {
                            console.log(err.response.data);
                            if (err.response.data.email != undefined) {
                                localStorage.setItem("email", err.response.data.email);
                                toastr.error(err.response.data.message)
                                $('#confirmModal').modal('show');
                                return false;

                            }
                            if (err.response.data.type != undefined) {
                                toastr.error(err.response.data.message)
                                return false;


                            } else {
                                for (let k in err.response.data) {
                                    toastr.error(err.response.data[k])
                                }
                                return false;

                            }
                            //   toastr.error(err.response.data)
                        }).finally(() => {
                            $('#btnLivreur').html(`Envoyez la demande &nbsp;<i
                                        class="fal fa-check"></i>`);

                        })
                    })
                </script>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/pages/index.blade.php ENDPATH**/ ?>