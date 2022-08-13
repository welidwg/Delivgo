@extends('main/base')

@section('title')
    Profile
@endsection
@section('content')
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
                                {{-- <div class="col col-sm-12 col-lg-2 col-md-2">
                                    <img src="images/cabane.jpg" class="img-fluid  rounded-circle p-2">

                                </div> --}}
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-5 text-white fw-bold text-center">Votre Profile</h4>
                                </div>

                            </div>
                            {{-- <div class="d-flex flex-row justify-content-center align-items-center mt-2"
                                style="font-size: 2.3vh;white-space: nowrap;color: antiquewhite">
                                <div class="px-2"><i class="fal fa-phone" aria-hidden="true"></i> 54963667</div>&nbsp;
                                <div class="px-2"><i class="fal fa-truck"></i> 3,000&nbsp;DT</div>&nbsp;
                                <div class="px-2"><i class="fal fa-clock" aria-hidden="true"></i> 45 min</div>&nbsp;

                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="container-fluid p-5  bg-white">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        @php
            $user = Auth::user();
        @endphp
        <div id="profileCont">
            @include('dash/layouts/profile')
        </div>


    </div>
@endsection
