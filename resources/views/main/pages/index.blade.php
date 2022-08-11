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
                                    {{-- <a href="#menu"
                                        class="btn-menu animate__animated animate__fadeInUp scrollto mb-2">Join us</a> --}}
                                    {{-- <a href="#book-a-table"
                                        class="btn-book animate__animated animate__fadeInUp scrollto">Contact US</a> --}}
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
                                            <input type="text" placeholder="Quel est votre ville ? " id="inputLocation"
                                                class="rounded-pill mx-3 color-dark   bg-transparent form-control border-0 fs-5 shadow-none" />
                                            <a id="triggerLocation"
                                                class="btn d-none d-lg-flex color-1  align-items-center justify-content-around  fw-bold mx-2 bg-transparent border-none color-primary ">
                                                <i class="fas fa-map-marker-alt mx-2"></i>
                                                Utiliser ma position

                                            </a>
                                            <span id="tete"></span>
                                        </div>
                                        <a class=" mt-2 text-white fw-bold fs-4 d-block d-lg-none" id="triggerLocation2">
                                            Utiliser ma position
                                            <i class="fas fa-map-marker-alt"></i>

                                        </a>
                                    </form>


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
                <p class="fw-bold" style="letter-spacing: 3px">Ceci sont nos partenaires</p>
            </div>

            <div id="restoContainer"></div>
            <script>
                if (localStorage.region != undefined) {
                    console.log(localStorage.region);
                    let current = localStorage.region;
                    $("#restoContainer").load(`/restosContent/${current.replaceAll(' ', '%20')}`)

                } else {
                    $("#restoContainer").load("/restosContent/0")

                }
            </script>

        </div>
    </section>
    <script>
        $("#searchLoc").on("submit", (e) => {
            e.preventDefault()
        })
        $("#inputLocation").on("keyup", (e) => {
            let loc = $("#inputLocation").val();
            if (loc == "") {
                $("#restoContainer").load(`/restosContent/0`)


            }
            if (e.keyCode === 13) {
                $("#restoContainer").load(`/restosContent/${loc}`)
                setTimeout(() => {
                    window.location.href = "#menu"
                }, 500);

            }
        })
        $("#triggerLocation,#triggerLocation2").on("click", (e) => {
            console.log("test");
            let location = localStorage.getItem("region")
            @if (Auth::check() && Auth::user()->city != '')
                location = "{{ Auth::user()->region->label }}"
            @endif

            if (location != undefined && location != "undefined") {
                $("#inputLocation").val(location)
                if (regs.includes(location)) {
                    // toastr.success("all is good")
                    $("#restoContainer").load(`/restosContent/${location}`)
                    setTimeout(() => {
                        window.location.href = "#menu"
                    }, 500);
                } else {
                    $("#restoContainer").load(`/restosContent/${location}`)
                    setTimeout(() => {
                        window.location.href = "#menu"
                    }, 500);

                    toastr.error("Désolé on ne délivre pas encore dans cette région/ville")
                }
            } else {

                Position()

            }
        })
    </script>

    <section id="why-us" class="why-us">
        <div class="container">

            <div class="section-title">
                <h2>Pourquoi <span>Delivgo </span> ?</h2>
                {{-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque
                    vitae autem.</p> --}}
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
    @if (!Auth::check())
        <section id="join-us" class="why-us">
            <div class="container">

                <div class="section-title">
                    <h2>Rejoignez <span>Delivgo </span></h2>
                    {{-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque
                    vitae autem.</p> --}}
                </div>
                <div class="row text-center d-flex align-items-center justify-content-center ">
                    <div class="col-md-4 mb-5 mb-lg-0 d-flex align-items-center">
                        <div class="card testimonial-card">
                            <div class="card-up" style="background-color: #9d789b;"></div>
                            <div class="avatar mx-auto bg-white p-3">
                                <img src="{{ asset('images/livreur.webp') }}" class="rounded-circle img-fluid "
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
                                <img src="{{ asset('images/restaurant.jpg') }}" class="rounded-circle img-fluid "
                                    style="width: 200px;height: 200px" />
                            </div>
                            <div class="card-body">
                                <h4 class="mb-2 fs-3 fw-bolder">Devenir partenaire</h4>
                                <hr>
                                <p class="dark-grey-text mt-4" style="height: 70px">
                                    Boostez vos ventes grâce à notre technologie.
                                    <br>
                                </p>
                                <button data-bs-toggle="modal" data-bs-target="#restoDemandModal"
                                    class="btn  text-white rounded-pill bg-color-1">Rejoignez-nous
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

                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                            </a>


                            <form action="#" class="formsModal" id="DelivererForm">
                                <h6 for="" class="mb-3 fs-3 color-3">Devenir un livreur</h6>
                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                    <input type="text"
                                        class="form-control shadow-none border-0 text-center bg-transparent"
                                        placeholder="Votre Nom" name="name" required>
                                </div>
                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-phone"></i></label>
                                    <input type="tel"
                                        class="form-control shadow-none border-0 text-center bg-transparent"
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
                            axios.post("/demande/add", $('#DelivererForm').serialize()).then((res) => {
                                toastr.success("Demande envoyée ! ")
                                $("#DelivererForm").trigger("reset")

                                setTimeout(() => {
                                    $(".modal").modal("hide");

                                }, 700);

                            }).catch((err) => {
                                console.log(err.response.data);
                                if (err.response.data.type != undefined) {
                                    toastr.error(err.response.data.message)
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
        <div class="modal fade" id="restoDemandModal" tabindex="-1" role="dialog" aria-labelledby="delivererModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">


                        <div class="main-content text-center mb-3 py-auto">

                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                            </a>


                            <form action="#" class="formsModal" id="restoForm">
                                <h6 for="" class="mb-3 fs-3 color-3">Devenir un partenaire</h6>
                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                    <input type="text"
                                        class="form-control shadow-none border-0 text-center bg-transparent"
                                        placeholder="Nom de l'entreprise" name="name" required>
                                </div>
                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-phone"></i></label>
                                    <input type="tel"
                                        class="form-control shadow-none border-0 text-center bg-transparent"
                                        placeholder="Votre numéro" name="phone" required>
                                </div>
                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                                    <input type="email" name="email"
                                        class="form-control shadow-none border-0 text-center bg-transparent"
                                        placeholder="Votre email" required>
                                </div>
                                <input type="hidden" name="type" value="2">
                                <div class="mx-auto mt-3">
                                    <button type="submit" class="btn w-100" id="btnResto">Envoyez la demande &nbsp;<i
                                            class="fal fa-check"></i></button>
                                </div>

                        </div>


                        </form>

                    </div>
                    <script>
                        $("#restoForm").on("submit", (e) => {
                            e.preventDefault();
                            $('#btnResto').html(spinner);
                            axios.post("/demande/add", $('#restoForm').serialize()).then((res) => {
                                toastr.success("Demande envoyée ! ")
                                $("#restoForm").trigger("reset")

                                setTimeout(() => {
                                    $(".modal").modal("hide");

                                }, 700);

                            }).catch((err) => {
                                console.log(err.response.data);
                                if (err.response.data.type != undefined) {
                                    toastr.error(err.response.data.message)
                                    return false;


                                } else {
                                    toastr.error("Erreur inconnue, veuillez réssayer plus tard!");

                                }
                                //   toastr.error(err.response.data)
                            }).finally(() => {
                                $('#btnResto').html(`Envoyez la demande &nbsp;<i
                                        class="fal fa-check"></i>`);

                            })
                        })
                    </script>

                </div>
            </div>
        </div>
    @endif
@endsection
