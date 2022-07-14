@extends('main/base')
@section('content')
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
                                    <a href="#menu"
                                        class="btn-menu animate__animated animate__fadeInUp scrollto mb-2">Restaurants</a>
                                    <a href="#book-a-table"
                                        class="btn-book animate__animated animate__fadeInUp scrollto">Contact US</a>
                                </div>
                                <div class=" animate__animated animate__fadeInUp">
                                    <form action="">
                                        <?php
                                        $ip = '197.5.62.69'; //Dynamic IP address get
                                        $data = \Location::get($ip);
                                        ?>
                                        <div
                                            class="input-group rounded-pill w-100 border-0 shadow sm bg-light justify-content-between align-items-center">
                                            <button class="btn fs-5 w-25 bg-transparent d-lg-none border-none color-1 ">
                                                <i class="fas fa-flag"></i> </button>
                                            <input type="text" placeholder="What's your address?"
                                                class="rounded-pill mx-3 color-dark   bg-transparent form-control border-0 fs-5 shadow-none" />
                                            <button type="submit " onclick="getLocation()"
                                                class="btn d-none d-lg-flex color-1  align-items-center justify-content-around  fw-bold mx-2 bg-transparent border-none color-primary ">
                                                <i class="fas fa-location-circle fs-5 mx-2"></i>
                                                Use my position

                                            </button>
                                            <span id="tete"></span>
                                        </div>
                                        <a class=" mt-2 color-primary fw-bold fs-4 d-block d-lg-none">
                                            <i class="fas fa-location-circle fs-3"></i>
                                            Use my position</a>
                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>



            </div>
        </div>
    </section>


    <section id="why-us" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Our <span>Restaurants</span></h2>
                <p class="fw-bold" style="letter-spacing: 3px">These are our most popular restaurants</p>
            </div>

            <div class="row restoCard" style="zoom: 0.97">
                @forelse ($restos as $resto)
                    <div class="col col-md-4 col-sm-12 mb-3">
                        <a href="{{ url('/resto/' . $resto->user_id) }}">
                            <div class="card shadow " style="border-radius: 20px">
                                <div class="d-flex align-items-center justify-content-center w-100 text-center headerResto"
                                    style="background-image: url(uploads/logos/{{ $resto->avatar }});background-size: contain; background-repeat: no-repeat;height: 200px;background-position: center">
                                    <div class="w-100 h-100 d-flex justify-content-center  align-items-center titleResto ">
                                        <h6 class="display-3 text-white fw-bold">{{ $resto->name }}</h6>

                                    </div>
                                </div>
                                <div class="card-body pt-0 px-0 ">
                                    <div class="row mb-0 p-3" style="flex-wrap: nowrap">
                                        <div class="col">
                                            <i class="fal fa-thumbs-up"></i> 55%
                                        </div>
                                        <div class="col d-flex align-items-center justify-content-start"
                                            style="flex-wrap: nowrap;white-space: nowrap;">
                                            <div><i class="fal fa-biking-mountain"></i> {{ $resto->deliveryPrice }}.000 DT
                                            </div>
                                            &nbsp;|&nbsp;
                                            <div><i class="fas fa-dot"></i> 45-55 min</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                @empty
                    @include('main/layouts/notfound')
                    <span class="text-center fs-4 fw-bold">Sorry<br>There is no restaurants yet !</span>
                @endforelse





            </div>

        </div>
    </section>
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Why <span>Delivgo</span></h2>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque
                    vitae autem.</p>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="box">
                        <span>01</span>
                        <h4>Lorem Ipsum</h4>
                        <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <span>02</span>
                        <h4>Repellat Nihil</h4>
                        <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno
                            para dest</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box">
                        <span>03</span>
                        <h4> Ad ad velit qui</h4>
                        <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
