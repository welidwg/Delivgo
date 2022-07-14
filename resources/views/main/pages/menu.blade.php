@extends('main/base')
@php

use App\Models\Category;
$categories = Category::where('resto_id', $resto->user_id)->get();

@endphp
@section('content')
    @if ($resto->address == '' || $categories->count() == 0)
        <div class="modal fade in" id="Astuces" aria-labelledby="astuces" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body p-4 px-5 ">



                        <div class="main-content text-center mb-3 py-auto">


                            @if (Auth::check())
                                <label for="" class="mb-3 fs-1 color-3">Hello dear<br>
                                    {{ Auth::user()->name }}</label>
                            @else
                                <label for="" class="mb-3 fs-1 color-3">Hello dear user</label>
                            @endif

                            <p class="fw-bold">This restaurant account is currently under maintenance.<br>
                                Comeback later if you want to order something from it.
                                <br>
                                Thank you !


                            </p>

                            <div class="mx-auto mt-3">
                                <a href={{ url('/') }} id="checkBtnSubmit" class="btn  w-100"><i
                                        class="fad fa-angle-double-left"></i> Go back to home </a>
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
                    <div class="col-lg-4 col-md-6 info">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>{{ $resto->address }}<br>{{ $resto->city }}, Tunisia</p>
                    </div>

                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-clock"></i>
                        <h4>Availability:</h4>
                        @if ($resto->onDuty)
                            <p><span class="text-success fw-bold">Available</span></p>
                        @else
                            <p><span class="text-danger fw-bold">Not Available</span></p>
                        @endif
                    </div>



                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>
                            <a href="tel:+216 {{ $resto->phone }}">+216 {{ $resto->phone }}</a>

                        </p>
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
                                @forelse ($categories as $cat)
                                    <li data-filter=".{{ $cat->label }}">{{ $cat->label }}</li>
                                @empty
                                    No categories yet
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
                            <input type="text" placeholder="Search in la cabane"
                                class="rounded-pill p-2 color-dark px-2 bg-transparent form-control border-0  shadow-none" />
                        </div>
                    </form>
                </div>
                <div class="row menu-container">

                    @forelse ($resto->products as $product)
                        <script>
                            function InrementTotal(label) {
                                $("#Total{{ $product->product_id }}").html(parseFloat($(
                                    "#Total{{ $product->product_id }}").html()) + parseFloat(label))
                            }

                            function DecrementTotal(label) {
                                $("#Total{{ $product->product_id }}").html(parseFloat($(
                                    "#Total{{ $product->product_id }}").html()) - parseFloat(label))
                            }
                        </script>
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
                                                    Dt</small>

                                            </h6>

                                            <form action="#" class="formsModal" id="addtocart">
                                                <div class="border rounded p-3">
                                                    <div
                                                        class="input-group my-auto mb-1 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"
                                                            style="width: auto">Quantity : </label>
                                                        <input type="number" value="1" min="1"
                                                            max="20"
                                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                                            placeholder="How much you want ?"
                                                            id="quantity{{ $product->product_id }}">
                                                        <script>
                                                            $("#quantity{{ $product->product_id }}").on("change keyup input", (e) => {
                                                                if ($("#quantity{{ $product->product_id }}").val() == "0") {
                                                                    toastr.error("error")
                                                                } else {
                                                                    let total = parseFloat($("#Total{{ $product->product_id }}").html())
                                                                    let qte = parseFloat($("#quantity{{ $product->product_id }}").val())
                                                                    let price = parseFloat("{{ $product->price }}")
                                                                    if (qte === 1) {
                                                                        $("#Total{{ $product->product_id }}").html(price)

                                                                    }
                                                                    $("#Total{{ $product->product_id }}").html(total * qte)
                                                                }
                                                            })
                                                        </script>
                                                    </div>
                                                </div>
                                                @if ($product->have_toppings)
                                                    <div class="border rounded p-3 mt-2">
                                                        <h6 class="text-center color-1 fw-bold"> <i
                                                                class="fal fa-sandwich"></i> Choose your
                                                            toppings</h6>

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
                                                                            {{ $topping->price != 0 ? '+ ' . $topping->price . ' DT' : 'free' }}
                                                                        </span></label>
                                                                </div>
                                                                <script>
                                                                    $("#topping{{ $topping->id . $product->product_id }}").on("change", (e) => {
                                                                        if ($("#topping{{ $topping->id . $product->product_id }}").is(":checked")) {
                                                                            // let total = parseFloat($("#Total{{ $product->product_id }}").html())
                                                                            // let newTotal = total + parseFloat("{{ $topping->price }}")
                                                                            // $("#Total{{ $product->product_id }}").html(newTotal)
                                                                            InrementTotal("{{ $topping->price }}")
                                                                        } else {

                                                                            // $("#Total{{ $product->product_id }}").html(parseFloat($(
                                                                            //     "#Total{{ $product->product_id }}").html()) - parseFloat(
                                                                            //     "{{ $topping->price }}"))
                                                                            DecrementTotal("{{ $topping->price }}")

                                                                        }
                                                                    })
                                                                    $("input[name='topping{{ $product->product_id }}[]']").on("change", (e) => {
                                                                        var maxAllowed = 1;
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
                                                    @if ($product->have_supplement == 1)
                                                        <div class="border rounded p-3 mt-2">
                                                            <h6 class="text-center color-1 fw-bold"> <i
                                                                    class="fal fa-utensils-alt"></i> Choose your
                                                                supplements</h6>

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

                                                                                InrementTotal("{{ $supplement->price }}")
                                                                            } else {


                                                                                DecrementTotal("{{ $supplement->price }}")

                                                                            }
                                                                        })
                                                                        $("input[name='supplement{{ $product->product_id }}[]']").on("change", (e) => {
                                                                            var maxAllowed = 1;
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
                                                                    class="fal fa-hat-chef"></i> Choose your
                                                                sauces</h6>

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
                                                                                {{ $sauce->price != 0 ? '+ ' . $sauce->price . ' DT' : 'free' }}
                                                                            </span></label>
                                                                    </div>
                                                                    <script>
                                                                        $("input[name='sauces{{ $product->product_id }}[]']").on("change", (e) => {
                                                                            var maxAllowed = 2;
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
                                                                    class="fal fa-cocktail"></i> Choose your
                                                                drinks</h6>

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
                                                                        $("input[name='drink{{ $product->product_id }}[]']").on("change", (e) => {
                                                                            var maxAllowed = 1;
                                                                            var cnt = $("input[name='drink{{ $product->product_id }}[]']:checked").length;
                                                                            if (cnt == maxAllowed) {
                                                                                $("input[name='drink{{ $product->product_id }}[]']").filter(':not(:checked)').prop('disabled',
                                                                                    true);
                                                                            }

                                                                        })
                                                                    </script>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                {{-- <div class="border rounded p-3 mt-2">
                                                    Total : 20
                                                </div> --}}

                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-white d-flex align-items-center justify-content-between">
                                        <p><strong class="color-1"><i class="fal fa-coins"></i> Total:</strong> <span
                                                id="Total{{ $product->product_id }}"></span> dt</p>
                                        <button class="btn "> <i class="fal fa-cart-plus "></i> Add to cart </button>
                                    </div>
                                    <script>
                                        $("#Total{{ $product->product_id }}").html(parseFloat("{{ $product->price }}"))
                                    </script>

                                </div>
                            </div>
                        </div>
                        <script>
                            $("#AddtoCartModal{{ $product->product_id }}").appendTo("body")
                        </script>
                        <div class="col-lg-6  menu-item {{ $product->category->label }}">
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
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#AddtoCartModal{{ $product->product_id }}"
                                                class="btn color-dark fs-4 align-self-end" style="border-radius: 12px"><i
                                                    class="fal fa-cart-plus"></i></button>
                                        @else
                                            <button type="button" id="loginMust{{ $product->product_id }}"
                                                class="btn color-dark fs-4 align-self-end" style="border-radius: 12px"><i
                                                    class="fal fa-cart-plus"></i></button>
                                            <script>
                                                $("#loginMust{{ $product->product_id }}").on("click", (e) => {
                                                    toastr.error("You should create an account and login first !")
                                                })
                                            </script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <span class="text-center fs-4 fw-bold">There is no products yet !</span>
                        <br>
                    @endforelse





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
