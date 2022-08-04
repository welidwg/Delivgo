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

</head>
<?php
use Illuminate\Support\Carbon;
Carbon::setLocale('fr');

?>
<?php
$ip = request()->ip() == '127.0.0.1' ? '102.154.237.218' : request()->ip();
if ($position = Location::get($ip)) {
    // echo $position->regionName;
} else {
    // Failed retrieving position.
}
?>


<body>
    <div class="preloader">

        <div class="lds-ripple">

            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cart" style="width: 700px !important"
        aria-labelledby="">

    </div>
    <script>
        $("#cart").load("/cartContent")
    </script>

    <?php echo $__env->make('main/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main id="main" style="min-height: 100vh">
        <?php $__env->startSection('content'); ?>

        <?php echo $__env->yieldSection(); ?>
    </main>
    <?php if($position = Location::get($ip)): ?>
        <script>
            alertify.alert("location", "Ceci est votre localidation : <?php echo e($position->regionName); ?>")
        </script>
    <?php endif; ?>
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

</html>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/base.blade.php ENDPATH**/ ?>