<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
$user = Auth::user();
use Illuminate\Support\Carbon;
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Delivgo | <?php $__env->startSection('title'); ?>

        <?php echo $__env->yieldSection(); ?>
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/logo/logo1.jpg')); ?>" />
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('dist/css/style.min.css')); ?>" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
        integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
        integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/fa/css/all.min.css')); ?>">

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="<?php echo e(asset('dist/css/custom.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css"
        integrity="sha512-IXuoq1aFd2wXs4NqGskwX2Vb+I8UJ+tGJEu/Dc0zwLNKeQ7CW3Sr6v0yU3z5OQWe3eScVIkER4J9L7byrgR/fA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"
        integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/bootstrap.min.css"
        integrity="sha512-6xVTeh6P+fsqDhF7t9sE9F6cljMrK+7eR7Qd+Py7PX5QEVVDLt/yZUgLO22CXUdd4dM+/S6fP0gJdX2aSzpkmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/dt-1.11.5/fh-3.2.2/sc-2.0.5/sb-1.3.2/sp-2.0.0/datatables.min.js"></script>

    
    <script>
        alertify.defaults.theme.input = "form-control focus text-dark"
        alertify.defaults.theme.ok = "btn btn-success"
        alertify.defaults.theme.cancel = "btn btn-light"
    </script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="<?php echo e(asset('/js/pusher.js')); ?>"></script>
    <style>

    </style>
    <?php
        Carbon::setLocale('fr');
        
    ?>
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
        <strong>${data.notif.title}</strong><br>
        ${data.notif.content}
            

        `)

                let permission = Notification.requestPermission();
                if (Notification.permission == "granted") {

                    const notif = new Notification(data.notif.title, {
                        body: data.notif.content,
                        icon: "<?php echo e(asset('/images/logo/logoOrange.PNG')); ?>"
                    });
                }

                // setTimeout(() => notif.close(), 5000);


                console.log(data);
            });
        </script>
    <?php endif; ?>


</head>


<body>
    <script>
        const spinner = `   <div class="spinner-grow spinner-grow-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;
    </script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo e(asset('/images/logo/logo2.png')); ?>" width="50" alt="homepage"
                                class="dark-logo" />
                            <!-- Light Logo icon -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text fw-bold">
                            <!-- dark Logo text -->
                            Delivgo
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->

                    <a class="dropdown-toggle nav-toggler waves-effect waves-light  d-block d-md-none"
                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                            class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                        <h6 class="dropdown-header fw-bold">Notifications</h6>
                        <div id="notifCont1" style="height: 300px;max-height: 300px;overflow: auto;">
                        </div>
                        <script>
                            function notifLoad() {
                                $("#notifCont1").load("/notif")
                                setTimeout(() => {
                                    notifLoad()
                                }, 14 * 1000);
                            }
                            notifLoad()
                        </script>
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
                                    class="mdi mdi-magnify me-1"></i>
                                <span class="font-16">Search</span></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter" />
                                <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                href="#"><span class="badge bg-danger badge-counter">3+</span><i
                                    class="fas fa-bell fa-fw"></i></a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                <h6 class="dropdown-header">Notifications</h6>
                                <div id="notifCont" style="height: 300px;max-height: 300px;overflow: auto;width: 500px">
                                </div>
                                <script>
                                    function notifLoad() {
                                        $("#notifCont").load("/notif")
                                        setTimeout(() => {
                                            notifLoad()
                                        }, 10 * 1000);
                                    }
                                    notifLoad()
                                </script>
                                
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src=<?php echo e($user->avatar != null ? asset('uploads/logos/' . $user->avatar) : asset('images/users/profile.png')); ?>

                                    alt="user" class="rounded- mx-2" width="31" />
                                <span class="fs-5"><?php echo e($user->name); ?> | <span class="fw-bolder"> <?php
                                    switch ($user->type) {
                                        case 2:
                                            echo 'Restaurant';
                                            break;
                                        case 3:
                                            echo 'Livreur';
                                            break;
                                        case 4:
                                            echo 'Admin';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                ?>
                                    </span></span>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href=<?php echo e(url('/logout')); ?>><i
                                        class="fal fa-sign-out-alt"></i>
                                    Déconnexion</a>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item <?php echo e(request()->routeIs('dash') ? 'selected' : ''); ?>">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link " href="<?php echo e(route('dash')); ?>"
                                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Tableau de board</span></a>
                        </li>
                        <li class="sidebar-item <?php echo e(request()->routeIs('stats') ? 'selected' : ''); ?>">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link " href="<?php echo e(route('stats')); ?>"
                                aria-expanded="false"><i class="fal fa-chart-line"></i><span class="hide-menu">Mes
                                    statistiques</span></a>
                        </li>
                        <li class="sidebar-item <?php echo e(request()->routeIs('dash.profile') ? 'selected' : ''); ?> ">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="<?php echo e(route('dash.profile')); ?>" aria-expanded="false"><i
                                    class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <?php if(Auth::user()->type == 2): ?>
                            <li class="sidebar-item <?php echo e(request()->routeIs('dash.menu') ? 'selected' : ''); ?> ">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="<?php echo e(route('dash.menu')); ?>" aria-expanded="false">

                                    <i class="fal fa-burger-soda"></i>&nbsp;<span class="hide-menu">Mon
                                        Menu</span></a>
                            </li>
                        <?php endif; ?>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/"
                                aria-expanded="false"><i class="fal fa-arrow-circle-left"></i><span
                                    class="hide-menu">Allez vers l'accueil</span></a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-12 ">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item">
                                    <a href="/dash" class="link"><i class="mdi mdi-home-outline fs-4"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php $__env->startSection('header_path'); ?>

                                    <?php echo $__env->yieldSection(); ?>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold"> <?php $__env->startSection('header_title'); ?>

                            <?php echo $__env->yieldSection(); ?>
                        </h1>
                    </div>

                </div>
            </div>
            <div class="container-fluid">

                <?php $__env->startSection('content'); ?>

                <?php echo $__env->yieldSection(); ?>

            </div>

            <?php echo $__env->make('dash/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

    </div>
    <?php if(Auth::user()->type != 4): ?>

        <?php if($user->address == '' && Route::currentRouteName() != 'dash.profile'): ?>
            <div class="modal fade in" id="Astuces" aria-labelledby="astuces" data-bs-backdrop="static"
                data-bs-keyboard="false" aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-body p-4 px-5 ">
                            <div class="main-content text-center mb-3 py-auto">
                                <label for="" class="mb-3 fs-1 color-3">Bienvenue ,
                                    <?php echo e($user->name); ?></label>
                                <p class="fw-bold">Nous sommes très honoreux que vous joignez nous .<br>
                                    Mais, avant de commencez votre experience avec notre plateforme,nous demandons de
                                    vous
                                    de completer quelques informations dans votre profile.
                                    <br>
                                </p>
                                <div class="mx-auto mt-3">
                                    <a href=<?php echo e(url('/dash/profile')); ?> id="checkBtnSubmit" class="btn  w-100">Vers
                                        votre
                                        profile <i class="fad fa-angle-double-right"></i></a>
                                </div>
                                <div class="mx-auto mt-3">
                                    <a role="button" href="/logout" id="resendBtn"
                                        class="color-1 w-100">Déconnexion</a>
                                    <br>

                                    <a role="button" href="/" id="resendBtn" class="color-1 w-100">Retournez
                                        vers
                                        l'accueil</a>
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

    <?php endif; ?>


    <script src=<?php echo e(asset('dist/js/app-style-switcher.js')); ?>></script>
    <!--Wave Effects -->
    <script src="<?php echo e(asset('dist/js/waves.js')); ?>"></script>
    <!--Menu sidebar -->
    <script src="<?php echo e(asset('dist/js/sidebarmenu.js')); ?>"></script>
    <!--Custom JavaScript -->
    <script src=<?php echo e(asset('dist/js/custom.js')); ?>></script>

    <script src="<?php echo e(asset('js/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment/fr.js')); ?>"></script>
    <script>
        moment.locale('fr')
    </script>


</body>

</html>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/base.blade.php ENDPATH**/ ?>