<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/icons/favicon.ico" />


    <link href="https://cdn.jsdelivr.ne
    t/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fa/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <style>
        a {
            text-decoration: none !important;
        }
    </style> --}}
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js
                    "></script>
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
        alertify.defaults.theme.ok = "btn btn-success"
        alertify.defaults.theme.cancel = "btn btn-light"
    </script>
</head>

<body>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="">
        <div class="offcanvas-header">
            <button type="button" class="btn text-dark  bg-light rounded-circle border-1 "
                style="position: absolute;top: 20px;left: -15px;z-index: 2;" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="fad fa-angle-right" style="font-size: 25px"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="container py-1">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Your Cart</h3>
                        <div>
                            <p class="mb-0"><span class="text-muted"></span> <a href="#!" class="text-body"
                                    id="empty">Empty <i class="fal fa-trash mt-1"></i></a></p>
                        </div>
                    </div>
                    <script>
                        $("#empty").click((e) => {
                            e.preventDefault()
                            if ($(".counterCart").length != 0) {

                                // toastr["info"]("test")
                                const boxes = document.querySelectorAll('.counterCart');

                                boxes.forEach(box => {
                                    box.remove();
                                });
                                localStorage.setItem("total", 0)
                                $("#total").html(localStorage.getItem("total"))
                                $("#cartMain").append("<p style='text-align:center'>You cart is empty</p>")
                                $('#cartFooter').fadeOut()
                                toastr["info"]("Empty")

                            }



                        })
                    </script>
                    <div class="col shadow  " id="cartMain" style="max-height: 300px;overflow-y: auto">
                        <script>
                            let sum = 0;
                            localStorage.setItem("total", 0)
                            setInterval(() => {
                                $("#numItems , #numItems1").html($(".counterCart").length)
                            }, 1000);
                        </script>

                        @for ($k = 1; $k < 5; $k++)
                            <div class="card rounded-3 mb-4 counterCart shadow-sm" id="productno{{ $k }}"
                                style="zoom: 0.85">
                                <div class="card-body ">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">Basic T-shirt</p>
                                            <p><span class="text-muted">Size: </span>M
                                                <br>
                                                <span class="text-muted">Color:
                                                </span>Grey
                                                <br>
                                                <span class="text-muted">Prix :
                                                </span><span id="unit{{ $k }}">10</span> DT

                                            </p>
                                        </div>
                                        <script>
                                            function incrementInput(id, counter) {
                                                let inp = document.getElementById(id)
                                                let unit = document.getElementById(`unit${counter}`).innerHTML;
                                                inp.value++;
                                                sum += parseInt(unit)
                                                localStorage.setItem("total", sum)
                                                $("#total").html(localStorage.getItem("total"))
                                                // $("#total").html(sum)



                                            }

                                            function decrementInput(id, counter) {
                                                let inp = document.getElementById(id)
                                                let unit = document.getElementById(`unit${counter}`).innerHTML;

                                                if (inp.value != 1) {
                                                    inp.value--;
                                                    sum -= parseInt(unit)
                                                    //$("#total").html(sum)
                                                    localStorage.setItem("total", sum)
                                                    $("#total").html(localStorage.getItem("total"))


                                                }
                                            }
                                        </script>
                                        <div class="col-md-4 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn px-2"
                                                onclick="decrementInput('quantity{{ $k }}','{{ $k }}')">
                                                <i class="fal fa-minus"></i>
                                            </button>
                                            <input id="quantity{{ $k }}" min="0"
                                                name="quantity{{ $k }}" value="2" type="number"
                                                class="form-control" style="width: 50px !important;text-align: center"
                                                disabled />

                                            <button class="btn  px-2"
                                                onclick="incrementInput('quantity{{ $k }}','{{ $k }}')">
                                                <i class="fal fa-plus"></i>
                                            </button>


                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0" id=""><span
                                                    id="price{{ $k }}"></span> DT</h5>
                                        </div>

                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="" id="rm{{ $k }}"
                                                class="text-danger disabled"><i
                                                    class="fal fa-minus-circle fa-lg"></i></a>
                                        </div>
                                        <script>
                                            $("#rm{{ $k }}").click((e) => {
                                                console.log("rm");
                                                let tots = parseInt($("#price{{ $k }}").html())

                                                sum -= tots
                                                localStorage.setItem("total", sum)
                                                $("#total").html(localStorage.getItem("total"))
                                                // $("#total").html(sum)
                                                $("#productno{{ $k }}").fadeOut()
                                                setTimeout(() => {
                                                    $("#productno{{ $k }}").remove()
                                                }, 1000);
                                                console.log();
                                                if ($(".CounterCart").length == 0) {

                                                    $('#cartFooter').fadeOut()
                                                    $("#cartMain").append("<p style='text-align:center'>You cart is empty</p>")


                                                }
                                                e.preventDefault()
                                            })
                                            sum += parseInt($("#unit{{ $k }}").html()) * parseInt($("#quantity{{ $k }}").val())
                                            localStorage.setItem("total", sum)

                                            function sumF{{ $k }}() {
                                                let tot = parseInt($("#unit{{ $k }}").html()) * parseInt($("#quantity{{ $k }}").val())
                                                $("#price{{ $k }}").html(tot)
                                            }
                                            setInterval(() => {
                                                sumF{{ $k }}()
                                            }, 500);
                                            $("#quantity{{ $k }}").bind("change paste keyup mouseup", function() {
                                                console.log($(this).val());
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <script>
                // toastr["info"]("test")
            </script>
            <div id="cartFooter">



                <h3 class="offcanvas-title mt-2 mb-1" style="font-weight: bolder;text-align: center"
                    id="offcanvasExampleLabel">Total
                    : <span id="total"></span> DT</h3>
                555
                <div class="input-group mb-3 mt-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Coupon code</span>
                    <input type="text" style="border-radius: 0px" class="form-control"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-warning w-100">Proceed to Pay</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('main/nav')
    <main id="main" style="min-height: 100vh">
        @section('content')

        @show
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('main/footer')

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Vendor JS Files -->
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script></script>

</html>
