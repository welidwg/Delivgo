<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/logo/logo1.jpg')); ?>" />


    <link href="https://cdn.jsdelivr.ne
    t/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="<?php echo e(asset('assets/vendor/animate.css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fa/css/all.min.css')); ?>">


    
    <link href="<?php echo e(asset('dist/css/style.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
        integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css"
        integrity="sha512-IXuoq1aFd2wXs4NqGskwX2Vb+I8UJ+tGJEu/Dc0zwLNKeQ7CW3Sr6v0yU3z5OQWe3eScVIkER4J9L7byrgR/fA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"
        integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/bootstrap.min.css"
        integrity="sha512-6xVTeh6P+fsqDhF7t9sE9F6cljMrK+7eR7Qd+Py7PX5QEVVDLt/yZUgLO22CXUdd4dM+/S6fP0gJdX2aSzpkmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        alertify.defaults.theme.input = "form-control focus text-dark"
        alertify.defaults.theme.ok = "btn btn-danger text-white"
        alertify.defaults.theme.cancel = "btn btn-light"
    </script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script src="<?php echo e(asset('/js/pusher.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment/fr.js')); ?>"></script>
    <?php if(Auth::check()): ?>
        <script>
            var audio = new Audio("<?php echo e(asset('notif.wav')); ?>");

            var pusher = new Pusher("33ae8c9470ab8fad0744", {
                cluster: "eu",
            });

            Pusher.logToConsole = true;

            var channel = pusher.subscribe('notif-<?php echo e(Auth::user()->user_id); ?>');
            channel.bind('notif', function(data) {
                audio.play();

                toastr.info(`
        <strong>${data.notif.title}</strong>
        ${data.notif.content}
        `)

                let permission = Notification.requestPermission();
                if (Notification.permission == "granted") {

                    const notif = new Notification(data.notif.title, {
                        body: data.notif.content,
                        icon: "<?php echo e(asset('/images/logo/logoOrange.PNG')); ?>"
                    });
                }
                console.log(data);
            });
        </script>
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/dt-1.11.5/fh-3.2.2/sc-2.0.5/sb-1.3.2/sp-2.0.0/datatables.min.js"></script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {

            "language": {
                "search": "Rechercher:",

                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
            },

        });
    </script>
</head>
<?php
use Illuminate\Support\Carbon;
Carbon::setLocale('fr');

?>
<?php
$ip = request()->ip() == '127.0.0.1' ? '102.154.237.218' : request()->ip();

?>


<body>
    <div class="preloader">

        <div class="lds-ripple">

            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="cart"
        style="width: 700px !important" aria-labelledby="">

    </div>
    <script>
        $("#cart").load("/cartContent")
    </script>

    <?php echo $__env->make('main/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main id="main" style="min-height: 100vh">
        <?php if(Auth::check()): ?>
            <a data-bs-target="#demandeLIvr" data-bs-toggle="modal"
                class="floatBtn bg-primary d-flex align-items-center justify-content-center"
                title="Demandez un livreur ">
                <i class="fal fa-biking-mountain"></i> </a>
            <div class="modal fade in" id="demandeLIvr" aria-labelledby="demandeLIvr" aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-body p-4 px-5 ">



                            <div class="main-content text-center mb-3 py-auto">
                                <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                </a>


                                <form action="#" class="formsModal" id="messageForm3">
                                    <h6 for="" class="mb-3 fs-3 color-3">Demandez un livreur</h6>
                                    <small>*Ici vous pouvez demandez d'un livreur de vous livrer vos
                                        achats,médicaments,etc...</small>

                                    <div class="input-group mb-2 rounded bg-light  align-items-center">

                                        <textarea style="resize: none" rows="5" class="form-control shadow-none border-0  bg-transparent"
                                            placeholder="Votre commande par details" name="message"></textarea>
                                    </div>

                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center justify-content-center"
                                        id="avatarContainer">

                                        <label for="picture" class="test-center" style="width: auto"> <i
                                                class="fal fa-camera"></i> Ajoutez une image (optionel)</label>

                                        <input type="file"
                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                            accept="image/*" id="picture" name="picture" hidden>

                                        <img id="imageCont" src="#" alt="" width="35px"
                                            class="img-fluid rounded" style="display: none">
                                    </div>
                                    <script>
                                        $('#picture').change(function() {
                                            var i = $(this).prev('label').clone();
                                            var file = $('#picture')[0].files[0].name;
                                            $(this).prev('label').text("Cliquez pour changer");
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#imageCont').fadeIn("slow")
                                                $('#imageCont').attr('src', e.target.result)
                                            };
                                            reader.readAsDataURL($('#picture')[0].files[0]);


                                        });
                                    </script>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="mx-auto mt-3">
                                        <button type="submit" class="btn w-100" id="btnLogin">Passez la commande <i
                                                class="fal fa-check"></i></button>
                                    </div>
                                    <?php echo csrf_field(); ?>
                                </form>
                                <script>
                                    $("#messageForm3").on("submit", (e) => {
                                        e.preventDefault()
                                        let formData = new FormData($("#messageForm3")[0]);
                                        axios.post("/otherCommande/add", formData)
                                            .then(res => {
                                                toastr.success(res.data.message)
                                                $("#messageForm3").trigger("reset")
                                                $(".modal").modal("hide")
                                                $('#imageCont').fadeOut("slow")
                                                $('#imageCont').attr('src', "")
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
        <?php $__env->startSection('content'); ?>

        <?php echo $__env->yieldSection(); ?>
        <div class="modal fade" id="modalRegion" aria-labelledby="modalRegion" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">


                        <div class="main-content text-center mb-3 py-auto">

                            <a href="#" style="" class="close-btn" id="closeModalConfirm">
                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                            </a>


                            <h6 for="" class="mb-3 fs-3 color-3">Ajoutez votre emplacement</h6>
                            
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i
                                        class="fal fa-map-marker-alt"></i></label>
                                
                                <input list="browsers" placeholder="exp(Khnisse,Sahline,Monastir,..)"
                                    class="form-control shadow-none border-0 text-center bg-transparent"
                                    name="browser" id="browser">
                                <script>
                                    let regs = []
                                </script>
                                <datalist id="browsers">
                                    <?php
                                        use App\Models\Region;
                                        $regionMain = Region::where('label', '!=', 'Autre')->get();
                                    ?>
                                    <?php $__currentLoopData = $regionMain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <script>
                                            regs.push("<?php echo e($region->label); ?>")
                                        </script>
                                        <option value="<?php echo e($region->label); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <script>
                                        console.log("reg", regs);
                                    </script>

                                </datalist>
                            </div>
                            <div class="mx-auto mt-3">
                                <a href="#!" id="btnRegion" class="btn w-100">Confirmer
                                    <i class="fal fa-sign-in-alt"></i></a>
                            </div>
                            <div class="mx-auto mt-3">
                                <a role="button" id="resendBtn" data-bs-dismiss="modal"
                                    class=" w-100 fs-5">Annuler</a>
                            </div>
                            <script>
                                $("#btnRegion").on("click", () => {
                                    let value = $("#browser").val();
                                    localStorage.setItem("region", value)
                                    $("#modalRegion").modal("hide")

                                    if (!regs.includes(value)) {
                                        toastr.warning(
                                            "<span style='color:black'>Cette région/ville n'est pas encore dans nos zones de livraison</span>"
                                        )

                                    } else {
                                        <?php if(Auth::check()): ?>
                                            axios.post("/user/updateAddress/<?php echo e(Auth::user()->user_id); ?>", {
                                                adresse: value
                                            }).then((res) => {
                                                console.log(res);
                                                window.location.reload();


                                            }).catch((err) => {
                                                console.log(err.response.data);
                                            })
                                        <?php endif; ?>

                                    }
                                })
                                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                                    return new bootstrap.Tooltip(tooltipTriggerEl)
                                })
                            </script>

                        </div>




                    </div>

                </div>
            </div>

        </div>
    </main>
  
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <?php echo $__env->make('main/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Vendor JS Files -->
<script src="<?php echo e(asset('assets/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script>


<script></script>

<!-- Template Main JS File -->
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/custom.js')); ?>"></script>
<script></script>
<?php if($position = Location::get($ip)): ?>
    <script>
        function Position(cond) {
            alertify.confirm("Votre emplacement",
                "Basant sur votre adresse IP , ceci est votre région/ville : <br><strong><?php echo e($position->cityName . ' | ' . $position->regionName); ?></strong>  <br>Confirmez-vous que cette région/ville est votre emplacement actuelle ?",
                () => {
                    localStorage.setItem("region", "<?php echo e($position->cityName); ?>")
                    <?php if(Auth::check()): ?>
                        axios.post("/user/updateAddress/<?php echo e(Auth::user()->user_id); ?>", {
                            address: "<?php echo e($position->cityName); ?>"
                        }).then((res) => {
                            console.log(res);
                            if (cond) {
                                window.location.reload();
                            }

                        }).catch((err) => {
                            console.log(err.response.data);
                        })
                    <?php endif; ?>
                }, () => {
                    $("#modalRegion").modal("show")
                }).set({
                labels: {
                    ok: "Oui, je confirme",
                    cancel: "Non"
                }
            })
        }
        if (localStorage.getItem("region") == undefined) {

            Position()
        }
    </script>
<?php endif; ?>

</html>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/base.blade.php ENDPATH**/ ?>