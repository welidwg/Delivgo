<!DOCTYPE html>
<html dir="ltr" lang="en">
@php
$user = Auth::user();
@endphp

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Flexy lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Flexy admin lite design, Flexy admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description"
        content="Flexy Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>{{ env('APP_NAME') }} | @section('title')

        @show
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('images/icons/favicon.ico') }} />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/custom.css') }}" rel="stylesheet" />
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
    <link rel="stylesheet" href="assets/fa/css/all.min.css">
    {{-- <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    {{-- <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                            <img src="{{ asset('images/logo/logoOrangeBack.png') }}" width="50" alt="homepage"
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
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
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
                                <h6 class="dropdown-header">alerts center</h6><a
                                    class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                        <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div><span class="small text-gray-500">December 12, 2019</span>
                                        <p>A new monthly report is ready to download!</p>
                                    </div>
                                </a><a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                        <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div><span class="small text-gray-500">December 7, 2019</span>
                                        <p>$290.29 has been deposited into your account!</p>
                                    </div>
                                </a><a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                        <div class="bg-warning icon-circle"><i
                                                class="fas fa-exclamation-triangle text-white"></i></div>
                                    </div>
                                    <div><span class="small text-gray-500">December 2, 2019</span>
                                        <p>Spending Alert: We&#39;ve noticed unusually high spending for your
                                            account.</p>
                                    </div>
                                </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src={{ $user->avatar != null ? asset('uploads/logos/' . $user->avatar) : asset('images/users/profile.png') }}
                                    alt="user" class="rounded- mx-2" width="31" />
                                <span class="fs-5">{{ $user->name }} | <span class="fw-bolder"> @php
                                    switch ($user->type) {
                                        case 2:
                                            echo 'Restaurant';
                                            break;
                                        case 3:
                                            echo 'Deliverer';
                                            break;
                                        case 4:
                                            echo 'Admin';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                @endphp
                                    </span></span>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-user m-r-5 m-l-5"></i>
                                    My
                                    Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-wallet m-r-5 m-l-5"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-email m-r-5 m-l-5"></i>
                                    Inbox</a>
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
                        <li class="sidebar-item {{ request()->routeIs('dash') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ route('dash') }}"
                                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('dash.profile') ? 'selected' : '' }} ">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('dash.profile') }}" aria-expanded="false"><i
                                    class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="table-basic.html"
                                aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                                    class="hide-menu">Table</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="icon-material.html"
                                aria-expanded="false"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Icon</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="starter-kit.html"
                                aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Blank</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="error-404.html"
                                aria-expanded="false"><i class="mdi mdi-alert-outline"></i><span
                                    class="hide-menu">404</span></a>
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
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item">
                                    <a href="/dash" class="link"><i class="mdi mdi-home-outline fs-4"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @section('header_path')

                                    @show
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold"> @section('header_title')

                            @show
                        </h1>
                    </div>

                </div>
            </div>
            <div class="container-fluid">

                @section('content')

                @show

            </div>

            @include('dash/footer')

        </div>

    </div>




    <script src={{ asset('dist/js/app-style-switcher.js') }}></script>
    <!--Wave Effects -->
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src={{ asset('dist/js/custom.js') }}></script>


</body>

</html>
