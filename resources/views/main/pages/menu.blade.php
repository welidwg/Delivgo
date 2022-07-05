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
                                <div class="col col-sm-12 col-lg-2 col-md-2">
                                    <img src="images/cabane.jpg" class="img-fluid  rounded-circle p-2">

                                </div>
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-2 text-white fw-bold text-center">La Cabane</h4>
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
    <div class="bg-white " style="z-index: 1 !important;position: relative;">

        <section class="contact bg-light" style="padding: 0px !important;">
            <div class="info-wrap
            animate__animated animate__fadeInUp">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 info">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>A108 Adam Street<br>New York, NY 535022</p>
                    </div>

                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-clock"></i>
                        <h4>Open Hours:</h4>
                        <p>Monday-Saturday:<br>11:00 AM - 2300 PM</p>
                    </div>



                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="menu" class="menu">
            <div class="container">

                <div class="bg-white mb-3">
                    <div class="section-title">
                        <h2 class="">Check our tasty <span>Menu</span></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="menu-flters">
                                <li data-filter="*" class="filter-active">Show All</li>
                                <li data-filter=".filter-starters">Starters</li>
                                <li data-filter=".filter-salads">Salads</li>
                                <li data-filter=".filter-specialty">Specialty</li>
                            </ul>
                        </div>
                    </div>
                    <form action="" class="mb-2">
                        <div class="input-group rounded-pill border-1 shadow-sm  justify-content-between align-items-center  "
                            style="background-color:#f8f5f5">
                            <button type="submit" class="btn  mx-2 bg-transparent border-none color-dark ">
                                <i class="fas fa-search text-muted "></i>
                            </button>
                            <input type="text" placeholder="Search in la cabane"
                                class="rounded-pill p-2 color-dark px-2 bg-transparent form-control border-0  shadow-none" />
                        </div>
                    </form>
                </div>
                <div class="row menu-container">

                    <div class="col-lg-6  menu-item filter-starters">
                        <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                            <img class="flex-shrink-0 img-fluid rounded " width="120px" src="images/brunch/b1.jpg"
                                alt="">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                    <span>Californian</span>
                                    <br />

                                    <span class="fw-light fs-5"> <i class="fal fa-coins"></i> 15 DT</span>

                                </h5>

                                <small style="min-height: 60px;height:auto;position: relative;">
                                    Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                    Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a>
                                </small>
                                <div class="col-lg-12 " style="text-align: right">

                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn color-dark fs-4 align-self-end" style="border-radius: 12px"><i
                                            class="fal fa-cart-plus"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-specialty">
                        <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                            <img class="flex-shrink-0 img-fluid rounded" width="120px" src="images/brunch/b2.jpg"
                                alt="">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                    <span>A la tunisiene</span>
                                    <br />

                                    <span class="fw-light fs-5"> <i class="fal fa-coins"></i> 25 DT</span>

                                </h5>

                                <small style="min-height: 60px;height:auto;position: relative;">
                                    Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                    Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a>
                                </small>
                                <div class="col-lg-12 text-right">

                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn color-dark fs-4" style="border-radius: 12px"><i
                                            class="fal fa-cart-plus"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 menu-item filter-specialty">
                        <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                            <img class="flex-shrink-0 img-fluid rounded" width="120px" src="images/brunch/b2.jpg"
                                alt="">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                    <span>A la tunisiene</span>
                                    <br />

                                    <span class="fw-light fs-5"> <i class="fal fa-coins"></i> 25 DT</span>

                                </h5>

                                <small style="min-height: 60px;height:auto;position: relative;">
                                    Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                    Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a>
                                </small>
                                <div class="col-lg-12 text-right">

                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn color-dark fs-4" style="border-radius: 12px"><i
                                            class="fal fa-cart-plus"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 menu-item filter-specialty">
                        <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                            <img class="flex-shrink-0 img-fluid rounded" width="120px" src="images/brunch/b2.jpg"
                                alt="">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                    <span>A la tunisiene</span>
                                    <br />

                                    <span class="fw-light fs-5"> <i class="fal fa-coins"></i> 25 DT</span>

                                </h5>

                                <small style="min-height: 60px;height:auto;position: relative;">
                                    Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                    Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a>
                                </small>
                                <div class="col-lg-12 text-right">

                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn color-dark fs-4" style="border-radius: 12px"><i
                                            class="fal fa-cart-plus"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-starters">
                        <div class="menu-content">
                            <a href="#">Crab Cake</a><span>$7.95</span>
                        </div>
                        <div class="menu-ingredients">
                            A delicate crab cake served on a toasted roll with lettuce and tartar sauce
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-salads">
                        <div class="menu-content">
                            <a href="#">Caesar Selections</a><span>$8.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Lorem, deren, trataro, filede, nerada
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-specialty">
                        <div class="menu-content">
                            <a href="#">Tuscan Grilled</a><span>$9.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Grilled chicken with provolone, artichoke hearts, and roasted red pesto
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-starters">
                        <div class="menu-content">
                            <a href="#">Mozzarella Stick</a><span>$4.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Lorem, deren, trataro, filede, nerada
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-salads">
                        <div class="menu-content">
                            <a href="#">Greek Salad</a><span>$9.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Fresh spinach, crisp romaine, tomatoes, and Greek olives
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-salads">
                        <div class="menu-content">
                            <a href="#">Spinach Salad</a><span>$9.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette
                        </div>
                    </div>

                    <div class="col-lg-6 menu-item filter-specialty">
                        <div class="menu-content">
                            <a href="#">Lobster Roll</a><span>$12.95</span>
                        </div>
                        <div class="menu-ingredients">
                            Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
