@extends('main/base')


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
                                    <h4 class="display-5 text-white fw-bold text-center">Your Profile</h4>
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
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="images/avatar/5.jpg" class="rounded" width="150" />
                            <h4 class="card-title m-t-10">Hanna Gover</h4>
                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                            {{-- <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                        <font class="font-medium">254</font>
                                    </a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                        <font class="font-medium">54</font>
                                    </a></div>
                            </div> --}}
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>hannagover@gmail.com</h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
                        <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                        <div class="map-box">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div> <small class="text-muted p-t-30 db">Social Profile</small>
                        <br />
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2">
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Johnathan Doe" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="johnathan@admin.com"
                                        class="form-control form-control-line" name="example-email" id="example-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" value="password" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Message</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-select shadow-none form-control-line">
                                        <option>London</option>
                                        <option>India</option>
                                        <option>Usa</option>
                                        <option>Canada</option>
                                        <option>Thailand</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success text-white">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

    </div>
@endsection
