@extends('main/base')
@php

use App\Models\Category;
use App\Models\Config;
use App\Models\IsNight;
use App\Http\Controllers\ConfigsController;
use Carbon\Carbon;

$categories = Category::where('resto_id', $resto->user_id)->get();

@endphp
@section('content')
    <style>

    </style>
    @if (Auth::check())
        <a data-bs-target="#textCommand" data-bs-toggle="modal"
            class="floatBtn bg-primary d-flex align-items-center justify-content-center" style="bottom: 120px"
            title="passez une commande par message vers ce restaurant">
            <i class="fab fa-facebook-messenger fs-3 my-float"></i>
        </a>
        <div class="modal fade in" id="textCommand" aria-labelledby="textCommand" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">



                        <div class="main-content text-center mb-3 py-auto">
                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                            </a>


                            <form action="#" class="formsModal" id="messageForm">
                                <h6 for="" class="mb-3 fs-3 color-3">Commande par message</h6>

                                <div class="input-group mb-2 rounded bg-light  align-items-center">

                                    <textarea style="resize: none" rows="5" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Votre commande par details" name="message"></textarea>
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                                <input type="hidden" name="resto_id" value="{{ $resto->user_id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="mx-auto mt-3">
                                    <button type="submit" class="btn w-100" id="btnLogin">Passez la commande <i
                                            class="fal fa-check"></i></button>
                                </div>
                            </form>
                            <script>
                                $("#messageForm").on("submit", (e) => {
                                    e.preventDefault()
                                    axios.post("/commandeMessage/add", $("#messageForm").serialize())
                                        .then(res => {
                                            toastr.success(res.data.message)
                                            $("#messageForm").trigger("reset")
                                            $(".modal").modal("hide")
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
    @endif


    @if ($resto->address == '' || $categories->count() == 0)
        <div class="modal fade in" id="Astuces" aria-labelledby="astuces" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">



                        <div class="main-content text-center mb-3 py-auto">


                            @if (Auth::check())
                                <label for="" class="mb-3 fs-1 color-3">Bienvenue,<br>
                                    {{ Auth::user()->name }}</label>
                            @else
                                <label for="" class="mb-3 fs-1 color-3">Bienvenue chère invité</label>
                            @endif

                            <p class="fw-bold">Le compte de ce restaurant est actuellement sous maintenance.<br>
                                Veuillez revenir ulterierement
                                <br>
                                Merci.


                            </p>

                            <div class="mx-auto mt-3">
                                <a href={{ url('/') }} id="checkBtnSubmit" class="btn  w-100"><i
                                        class="fad fa-angle-double-left"></i> Allez vers l'accueil</a>
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
    @endif
    <script></script>
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
                                    <img src="{{ asset("uploads/logos/$resto->avatar") }}"
                                        class="img-fluid  rounded-circle p-2">

                                </div>
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-2 text-white fw-bold text-center">{{ $resto->name }}</h4>
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
                    <div class="col-lg-3 col-md-6 info mx-auto">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Localisation:</h4>
                        <p>{{ $resto->address }}<br>{{ $resto->region->label }}, Tunisie</p>
                    </div>

                    <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-clock"></i>
                        <h4>Disponibilité:</h4>
                        @if ($resto->onDuty)
                            <p><span class="text-success fw-bold">En service</span></p>
                        @else
                            <p><span class="text-danger fw-bold">Hors service</span></p>
                        @endif
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0 info mx-auto">
                        <i class="fal fa-coins"></i>
                        <h4>Frais de livraison:</h4>

                        <p>
                            @php
                                $check = Config::latest()->first();
                                $is_night = IsNight::latest()->first();
                                
                                $now = Carbon::now();
                                $curr = date('a');
                                $start = Carbon::createFromTimeString($check->du);
                                $end = Carbon::createFromTimeString($check->to);
                                if ($curr == 'am') {
                                    $start = Carbon::createFromTimeString($check->du)->subDay();
                                } else {
                                    $end = Carbon::createFromTimeString($check->to)->addDay();
                                }
                                
                            @endphp


                            @if ($now->between($start, $end, true))
                                {{ $check->frais_nuit }} TND


                                <small class="color-1">*frais de nuits </small>
                            @else
                                @if (Auth::check() && Auth::user()->city != null)
                                    <span class="fw-bold">{{ Auth::user()->region->deliveryPrice }} TND</span>
                                @else
                                    <span class="fw-bold">3 TND</span>
                                @endif
                            @endif

                            {{-- @if ($date1 > $date2 && $date1 < $date3)
                                <span class="fw-bold">{{ $frais->frais_nuit }} nuit Dt</span>
                            @else
                                @if ($resto->deliveryPrice != 0 && $resto->deliveryPrice != null)
                                    @if (Auth::check() && Auth::user()->city != null)
                                        <span class="fw-bold">{{ Auth::user()->region->deliveryPrice }} dt</span>
                                    @else
                                        <span class="fw-bold">{{ $resto->deliveryPrice }} dt</span>
                                    @endif
                                @else
                                    <span class="fw-bold text-success">gratuit</span>
                                @endif
                            @endif --}}




                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Téléphone:</h4>
                        <p>
                            <a href="tel:+216 {{ $resto->phone }}">+216 {{ $resto->phone }}</a>

                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="menu">
            <div class="container">

                <div class="bg-white mb-3">
                    <div class="section-title">
                        <h2 class="">Verifiez notre délicieux <span>Menu</span></h2>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="menu-flters">
                                <li data-filter="*" class="filter-active">Tous</li>
                                @forelse ($categories as $cat)
                                    <li data-filter=".{{ str_replace(' ', '', $cat->label) }}">{{ $cat->label }}</li>
                                @empty
                                    Aucune catégorie encore
                                @endforelse
                                {{-- <li data-filter=".filter-starters">Starters</li>
                                <li data-filter=".filter-salads">Salads</li>
                                <li data-filter=".filter-specialty">Specialty</li> --}}
                            </ul>
                        </div>
                    </div>
                    <form action="" class="mb-2">
                        <div class="input-group rounded-pill border-1 shadow-sm  justify-content-between align-items-center  "
                            style="background-color:#f8f5f5">
                            <button type="submit" class="btn  mx-2 bg-transparent border-none color-dark ">
                                <i class="fas fa-search text-muted "></i>
                            </button>
                            <input type="text" placeholder="Rechercher dans {{ $resto->name }}"
                                class="rounded-pill p-2 color-dark px-2 bg-transparent form-control border-0  shadow-none" />
                        </div>
                    </form>
                </div>
                <div class="row menu-container">

                    @forelse ($resto->products as $product)
                        <div class="col-lg-6  menu-item {{ str_replace(' ', '', $product->category->label) }} "
                            id="productsCont{{ $product->product_id }}">

                            <div class="d-flex align-items-center h-auto shadow p-3 m-2" style="border-radius: 30px">
                                <img class="flex-shrink-0 img-fluid rounded " width="120px"
                                    style="max-height: 120px;height: 120px"
                                    src="{{ asset("uploads/products/$product->picture") }}" alt="">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2 flex-wrap">
                                        <span>{{ $product->label }}</span>
                                        <br />

                                        <span class="fw-light fs-5 color-1"> <i class="fal fa-coins"></i>
                                            {{ $product->price }} DT</span>

                                    </h5>
                                    @if ($product->description != '')
                                        <small style="min-height: 60px;height:auto;position: relative;">
                                            {{ $product->description }}
                                            {{-- Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                        Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a> --}}
                                        </small>
                                    @else
                                        <small>
                                            {{ $product->label }}
                                            {{-- Piment jalapeño, pepperoni, Boulettes de viande et pizza sauce.
                                        Piment jalapeño, pepperoni, Bo.... <a href="" class="fw-bold">More</a> --}}
                                        </small>
                                    @endif

                                    <div class="col-lg-12 " style="text-align: right">

                                        @if (Auth::check())
                                            @if ($resto->onDuty)
                                                @if (Auth::user()->city != '')
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#AddtoCartModal{{ $product->product_id }}"
                                                        class="btn color-dark fs-4 align-self-end"
                                                        style="border-radius: 12px"><i
                                                            class="fal fa-cart-plus"></i></button>
                                                @else
                                                    <button type="button" onclick="Position(true)"
                                                        class="btn color-dark fs-4 align-self-end"
                                                        style="border-radius: 12px"><i
                                                            class="fal fa-cart-plus"></i></button>
                                                @endif
                                            @else
                                                <button type="button" id="notAvailable{{ $product->product_id }}"
                                                    class="btn color-dark fs-4 align-self-end"
                                                    style="border-radius: 12px"><i class="fal fa-cart-plus"></i></button>
                                                <script>
                                                    $("#notAvailable{{ $product->product_id }}").on("click", (e) => {
                                                        toastr.error("Ce restaurant est hors service pour le moment")
                                                    })
                                                </script>
                                            @endif
                                        @else
                                            <button type="button" id="loginMust{{ $product->product_id }}"
                                                class="btn color-dark fs-4 align-self-end" style="border-radius: 12px"><i
                                                    class="fal fa-cart-plus"></i></button>
                                            <script>
                                                $("#loginMust{{ $product->product_id }}").on("click", (e) => {
                                                    toastr.error("Il faudra que vous se connecter d'abord !")
                                                })
                                            </script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="AddtoCartModal{{ $product->product_id }}"
                            aria-labelledby="AddtoCartModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content text-center mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>


                                            <h6 for="" class="mb-3 fs-3 color-3">{{ $product->label }}<br>
                                                <small class="text-muted" style="font-size: 17px">{{ $product->price }}
                                                    DT</small>

                                            </h6>

                                            <form action="#" class="formsModal"
                                                id="addtocart{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_id }}"
                                                    name="product_id">
                                                <input type="hidden" value="{{ $resto->user_id }}" name="resto_id">
                                                <div class="border rounded p-3">
                                                    <div
                                                        class="input-group my-auto mb-1 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"
                                                            style="width: auto">Quantité : </label>
                                                        <input type="number" value="1"
                                                            class="form-control disabled shadow-none border-0 text-center bg-transparent"
                                                            placeholder="How much you want ?"
                                                            id="quantity{{ $product->product_id }}{{ $resto->user_id }}"
                                                            name="quantity{{ $product->product_id }}">
                                                        <div class="d-flex flex-column align-items-center px-3 py-auto">
                                                            <a class=" fw-bold" id="incr{{ $product->product_id }}">
                                                                <i class="fas fa-plus"></i>

                                                            </a>
                                                            <a class=" fw-bold" id="decr{{ $product->product_id }}">
                                                                <i class="fas fa-minus"></i>

                                                            </a>

                                                        </div>
                                                        <script>
                                                            $("#incr{{ $product->product_id }}").on("click", (e) => {
                                                                Increment('quantity{{ $product->product_id }}{{ $resto->user_id }}',
                                                                    'Total{{ $product->product_id }}',
                                                                    'UnitTotal{{ $product->product_id }}')
                                                            })
                                                            $("#decr{{ $product->product_id }}").on("click", (e) => {
                                                                Decrement('quantity{{ $product->product_id }}{{ $resto->user_id }}',
                                                                    'Total{{ $product->product_id }}',
                                                                    'UnitTotal{{ $product->product_id }}')
                                                            })
                                                        </script>
                                                    </div>
                                                </div>


                                                @if ($product->have_toppings)
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-sandwich"></i> Choisissez vos garnitures :
                                                            <br> <small class="text-success">Maximum :
                                                                {{ $resto->configs[0]->perTopp }}</small>
                                                        </h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            @foreach ($resto->toppings as $topping)
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="topping{{ $topping->id . $product->product_id }}"
                                                                        value="{{ $topping->id }}"
                                                                        name="topping{{ $product->product_id }}[]">
                                                                    <label class=" text-left" style="width: auto"
                                                                        for="topping{{ $topping->id . $product->product_id }}">{{ $topping->label }}
                                                                        <span class="text-success ">
                                                                            {{ $topping->price != 0 ? '+ ' . $topping->price . ' DT' : 'gratuit' }}
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#topping{{ $topping->id . $product->product_id }}").on("change", (e) => {
                                                                        if ($("#topping{{ $topping->id . $product->product_id }}").is(":checked")) {
                                                                            // let total = parseFloat($("#Total{{ $product->product_id }}").html())
                                                                            // let newTotal = total + parseFloat("{{ $topping->price }}")
                                                                            // $("#Total{{ $product->product_id }}").html(newTotal)
                                                                            InrementTotal("{{ $topping->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')
                                                                        } else {

                                                                            // $("#Total{{ $product->product_id }}").html(parseFloat($(
                                                                            //     "#Total{{ $product->product_id }}").html()) - parseFloat(
                                                                            //     "{{ $topping->price }}"))
                                                                            DecrementTotal("{{ $topping->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')

                                                                        }
                                                                    })
                                                                    $("input[name='topping{{ $product->product_id }}[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("{{ $resto->configs[0]->perTopp }}");
                                                                        var cnt = $("input[name='topping{{ $product->product_id }}[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='topping{{ $product->product_id }}[]']").filter(':not(:checked)').prop('disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='topping{{ $product->product_id }}[]']").prop('disabled',
                                                                                false)
                                                                        }


                                                                    })
                                                                </script>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif



                                                @if ($product->have_supplement)
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-utensils-alt"></i> Choisissez vos suppléments
                                                            <br> <small class="text-success">Maximum :
                                                                {{ $resto->configs[0]->perSupp }}</small>
                                                        </h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            @foreach ($resto->supplements as $supplement)
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="supplement{{ $supplement->id . $product->product_id }}"
                                                                        value="{{ $supplement->id }}"
                                                                        name="supplement{{ $product->product_id }}[]">
                                                                    <label class="text-left" style="width: auto"
                                                                        for="supplement{{ $supplement->id . $product->product_id }}">{{ $supplement->label }}
                                                                        <span class="text-success fw-bold">
                                                                            +{{ $supplement->price }} DT
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#supplement{{ $supplement->id . $product->product_id }}").on("change", (e) => {
                                                                        if ($("#supplement{{ $supplement->id . $product->product_id }}").is(":checked")) {

                                                                            InrementTotal("{{ $supplement->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')
                                                                        } else {


                                                                            DecrementTotal("{{ $supplement->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')

                                                                        }
                                                                    })
                                                                    $("input[name='supplement{{ $product->product_id }}[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("{{ $resto->configs[0]->perSupp }}");;
                                                                        var cnt = $("input[name='supplement{{ $product->product_id }}[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='supplement{{ $product->product_id }}[]']").filter(':not(:checked)').prop(
                                                                                'disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='supplement{{ $product->product_id }}[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($product->have_sauces)
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-hat-chef"></i> Choisissez vos
                                                            sauces<br> <small class="text-success">Maximum :
                                                                {{ $resto->configs[0]->perSauce }}</small></h6>
                                                        </h6>

                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            @foreach ($resto->sauces as $sauce)
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="sauce{{ $sauce->id . $product->product_id }}"
                                                                        value="{{ $sauce->id }}"
                                                                        name="sauces{{ $product->product_id }}[]">
                                                                    <label class=" text-left" style="width: auto"
                                                                        for="sauce{{ $sauce->id . $product->product_id }}">{{ $sauce->label }}
                                                                        <span class="text-success ">
                                                                            {{ $sauce->price != 0 ? '+ ' . $sauce->price . ' DT' : 'gratuit' }}
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#sauce{{ $sauce->id . $product->product_id }}").on("change", (e) => {
                                                                        if ($("#sauce{{ $sauce->id . $product->product_id }}").is(":checked")) {

                                                                            InrementTotal("{{ $sauce->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')
                                                                        } else {


                                                                            DecrementTotal("{{ $sauce->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')

                                                                        }
                                                                    })
                                                                    $("input[name='sauces{{ $product->product_id }}[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("{{ $resto->configs[0]->perSauce }}");;
                                                                        var cnt = $("input[name='sauces{{ $product->product_id }}[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='sauces{{ $product->product_id }}[]']").filter(':not(:checked)').prop('disabled',
                                                                                true)
                                                                        } else {
                                                                            $("input[name='sauces{{ $product->product_id }}[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($product->have_drinks)
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-cocktail"></i> Choisissez vos boissons :<br>
                                                            <small class="text-success">Maximum :
                                                                {{ $resto->configs[0]->perDrink }}</small>
                                                        </h6>


                                                        <div
                                                            class="d-flex flex-column justify-content-start align-items-center">
                                                            @foreach ($resto->drinks as $drink)
                                                                <div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="drink{{ $drink->id . $product->product_id }}"
                                                                        value="{{ $drink->id }}"
                                                                        name="drink{{ $product->product_id }}[]">
                                                                    <label class="text-left" style="width: auto"
                                                                        for="drink{{ $drink->id . $product->product_id }}">{{ $drink->label }}
                                                                        <span class="text-success fw-bold">
                                                                            +{{ $drink->price }} DT
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#drink{{ $drink->id . $product->product_id }}").on("change", (e) => {
                                                                        if ($("#drink{{ $drink->id . $product->product_id }}").is(":checked")) {

                                                                            InrementTotal("{{ $drink->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')
                                                                        } else {


                                                                            DecrementTotal("{{ $drink->price }}", "Total{{ $product->product_id }}",
                                                                                'UnitTotal{{ $product->product_id }}',
                                                                                'quantity{{ $product->product_id }}{{ $resto->user_id }}')

                                                                        }
                                                                    })
                                                                    $("input[name='drink{{ $product->product_id }}[]']").on("change", (e) => {
                                                                        var maxAllowed = parseInt("{{ $resto->configs[0]->perDrink }}");;
                                                                        var cnt = $("input[name='drink{{ $product->product_id }}[]']:checked").length;
                                                                        if (cnt == maxAllowed) {
                                                                            $("input[name='drink{{ $product->product_id }}[]']").filter(':not(:checked)').prop('disabled',
                                                                                true);
                                                                        } else {
                                                                            $("input[name='drink{{ $product->product_id }}[]']").prop('disabled',
                                                                                false)
                                                                        }

                                                                    })
                                                                </script>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- <div class="border rounded p-3 mt-2">
                                                    Total : 20
                                                </div> --}}
                                                @csrf
                                            </form>

                                        </div>
                                    </div>
                                    <div
                                        class="modal-footer bg-white d-flex align-items-center justify-content-between w-100">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <strong class="color-1">
                                                <i class="fal fa-coins"></i>
                                                Total &nbsp;(DT):
                                            </strong>
                                            <input type="number" disabled
                                                class="form-control border-0 shadow-none bg-white text-dark"
                                                style="width: 100px" id="Total{{ $product->product_id }}"
                                                value="{{ $product->price }}" step="0.1" />
                                            <input type="hidden" id="UnitTotal{{ $product->product_id }}"
                                                value="{{ $product->price }}" step="0.1" />


                                        </div>
                                        <button class="btn "
                                            onclick="submitForm('addtocart{{ $product->product_id }}')"> <i
                                                class="fal fa-cart-plus "></i>Ajoutez au panier </button>
                                    </div>
                                    <script></script>

                                </div>
                            </div>
                        </div>
                        <script>
                            $("#AddtoCartModal{{ $product->product_id }}").appendTo("body")
                        </script>
                        <script>
                            function submitForm(id) {
                                $("#" + id).trigger("submit")
                            }
                            $("#addtocart{{ $product->product_id }}").on('submit', (e) => {
                                e.preventDefault();

                                let form = $("#addtocart{{ $product->product_id }}")[0]
                                let formData = new FormData(form)
                                formData.append("total", $("#Total{{ $product->product_id }}").val())
                                formData.append("UnitTotal", $("#UnitTotal{{ $product->product_id }}").val())
                                axios.post("/cart/add", formData)
                                    .then(res => {
                                        toastr.info(res.data)
                                        $(".modal").modal("hide");
                                        $("#addtocart{{ $product->product_id }}").trigger("reset");
                                        $("#cart").load("/cartContent")
                                        $("#UnitTotal{{ $product->product_id }}").val('{{ $product->price }}')
                                        $("#Total{{ $product->product_id }}").val('{{ $product->price }}')
                                    })
                                    .catch(err => {
                                        toastr.error(err.response.data)
                                    })
                            })
                        </script>
                    @empty
                        @include('main/layouts/notfound')
                        <span class="text-center fs-4 fw-bold mx-auto">Il n'ya pas des produits !</span>
                    @endforelse




                    <script>
                        function Increment(id, idTotal, unitP) {
                            let inp = document.getElementById(id)
                            inp.value++
                            let unitprice = document.getElementById(unitP)
                            let valueTotal = parseFloat(document.getElementById(idTotal).value);
                            let newval = unitprice.value * inp.value
                            document.getElementById(idTotal).value = newval
                        }


                        function Decrement(id, idTotal, unitP) {
                            let inp = document.getElementById(id);
                            let unitprice = document.getElementById(unitP)

                            if (parseInt(inp.value) != 1) {
                                inp.value--
                                let valueTotal = parseFloat(document.getElementById(idTotal).value);
                                let newval = valueTotal - parseFloat(unitprice.value)
                                document.getElementById(idTotal).value = parseFloat(newval)
                            }

                        }
                    </script>
                    <script>
                        function InrementTotal(label, id, unitP, qte) {
                            let input = document.getElementById(id)
                            let val = parseFloat($("#" + id).val())
                            let quantity = parseFloat(document.getElementById(qte).value)
                            let unitprice = document.getElementById(unitP)

                            unitprice.value = parseFloat(unitprice.value) + (parseFloat(label))
                            // $("#" + id).attr("value", parseFloat(label))
                            let newval = val + (parseFloat(label) * quantity)
                            input.value = newval



                            // input.value = input.value + parseFloat(label);
                            // $("#" + id).val(label + $("#" + id).val())
                            // $("#" + id).html(parseFloat($("#" + id).html()) + parseFloat(label))
                        }

                        function DecrementTotal(label, id, unitP, qte) {
                            let input = document.getElementById(id)
                            let quantity = parseFloat(document.getElementById(qte).value)
                            let val = parseFloat($("#" + id).val())
                            let newval = val - (parseFloat(label) * quantity)

                            let unitprice = document.getElementById(unitP)
                            unitprice.value = parseFloat(unitprice.value) - (parseFloat(label))
                            input.value = newval

                            // $("#" + id).val( $("#" + id).val()-label)
                            // $("#" + id).html(parseFloat($("#" + id).html()) - parseFloat(label))
                        }
                    </script>
                    {{-- <div class="col-lg-6 menu-item filter-starters">
                        <div class="menu-content">
                            <a href="#">Crab Cake</a><span>$7.95</span>
                        </div>
                        <div class="menu-ingredients">
                            A delicate crab cake served on a toasted roll with lettuce and tartar sauce
                        </div>
                    </div> --}}



                </div>

            </div>
        </section>
    </div>
@endsection
