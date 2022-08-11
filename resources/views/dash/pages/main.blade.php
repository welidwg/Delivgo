@extends('dash/base')





@section('title')
    Tableau de bord
@endsection
@section('header_path')
    Tableau de bord
@endsection
@section('header_title')
    @if (Auth::user()->type == 2 || Auth::user()->type == 3)
        <span class="d-flex align-items-center justify-content-between"> Bienvenue , {{ $user->name }}
            <div class="form-check form-switch">
                <label class="form-check-label fs-4 text-dark" id="ondutylabel" for="onduty"></label>

                <input class="form-check-input" type="checkbox" role="switch" id="onduty"
                    {{ Auth::user()->onDuty ? 'checked' : '' }}>
                <script>
                    if ($('#onduty').is(":checked")) {
                        $("#ondutylabel").html("En service")
                    } else {
                        $("#ondutylabel").html("Hors service")

                    }
                    $('#onduty').on("change", (e) => {
                        if ($('#onduty').is(":checked")) {
                            $("#ondutylabel").html("En service")
                        } else {
                            $("#ondutylabel").html("Hors service")

                        }
                        axios.post("/user/update/duty/{{ Auth::user()->user_id }}")
                            .then(res => {
                                console.log(res)
                                toastr.info(res.data.message)
                                LoadContentMain()
                            })
                            .catch(err => {
                                console.error(err);
                                toastr.error("Quelque chose s'est mal passé")

                            })
                    })
                </script>

            </div>

        </span>
    @endif
@endsection

@section('content')
    @if (Auth::user()->type == 4)
        <div class="row">
            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a data-bs-toggle="modal" data-bs-target="#addUserModal">Restaurant</a>

                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    {{-- <span>{{ $type == 2 ? count($commandes) : count($response) }}</span> --}}
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-layer-plus fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a data-bs-toggle="modal" data-bs-target="#addUserModal">Livreur</a>

                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    {{-- <span>{{ $type == 2 ? count($commandes) : count($response) }}</span> --}}
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-user-plus fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="addUserModal" role="dialog" aria-labelledby="registerModal1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-body p-4 px-5 ">


                            <div class="main-content text-center mb-3 py-auto">

                                <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                </a>


                                <form action="# " class="formsModal" id="registerForm" enctype="multipart/form-data">
                                    @csrf

                                    <h6 for="" class="mb-3 fs-3 color-3">Ajoutez utilisateur </h6>

                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                        <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                            placeholder="Nom" name="name" id="name">
                                    </div>

                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                                        <input type="email" id="email"
                                            class="form-control shadow-none border-0 bg-transparent"
                                            placeholder="Email (exp:paul_john@domain.com)" name="email">
                                    </div>
                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i
                                                class="fal fa-user-cog"></i></label>
                                        <select name="type" class="form-control shadow-none border-0 bg-transparent"
                                            id="type">
                                            <option value="">Choisissez le type d'utilisateur</option>
                                            <option value="2">Restaurant</option>
                                            <option value="3">Livreur</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center justify-content-center"
                                        id="avatarContainer" style="display: none">

                                        <label for="avatar" class="test-center" style="width: auto"> <i
                                                class="fal fa-camera"></i> Ajoutez le logo de l'entreprise</label>

                                        <input type="file"
                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                            accept="image/*" id="avatar" name="avatar" hidden>

                                        <img id="imageCont" src="#" alt="" width="35px"
                                            class="img-fluid rounded" style="display: none">
                                    </div>
                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i
                                                class="fal fa-phone"></i></label>
                                        <input type="tel"
                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                            placeholder="Numéro d'utilisateur" required name="phone" id="phone">
                                    </div>
                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i
                                                class="fal fa-phone"></i></label>
                                        <input type="tel"
                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                            placeholder="Confirmez le numéro" required name="phone2" id="phone2">
                                    </div>

                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                        <label for="" class="px-2 color-3 fs-5"><i
                                                class="fal fa-lock"></i></label>
                                        <input type="password" name="password" id="passwordReg"
                                            class="form-control shadow-none border-0 text-center bg-transparent"
                                            placeholder="Donnez un mot de passe ">
                                    </div>


                                    <div class="mx-auto mt-3">
                                        <button type="submit" id="btnSubmitRegister" class="btn w-100 disabled">Ajouter
                                        </button>
                                    </div>

                            </div>


                            </form>
                            <script>
                                $('#passwordReg').on("keyup", (e) => {
                                    if (e.target.value == "") {
                                        $("#btnSubmitRegister").addClass("disabled")
                                    } else {
                                        $("#btnSubmitRegister").removeClass("disabled")

                                    }
                                    console.log(e.target.value);
                                })

                                $("#registerForm").on("submit", (e) => {
                                    e.preventDefault()
                                    let form = $("#registerForm")[0]
                                    let formData = new FormData(form)
                                    //   let avatar = document.getElementById("avatar").files[0]

                                    //   formData.append('avatar', avatar, avatar.name)

                                    //   console.log(formData);

                                    $("#btnSubmitRegister").html(spinner)
                                    if ($("#phone2").val() !== $("#phone").val()) {
                                        toastr.error("Veuillez confirmer attentivement votre numéro")
                                        $("#btnSubmitRegister").html(`S'inscrire`)
                                        $("#phone2").css("border", "1px solid red !important")

                                    } else {
                                        $("#phone2").css("border", "1px solid green !important")
                                        setTimeout(() => {
                                            $("#phone2").css("border", "1px solid #ccc !important")
                                        }, 500);

                                        axios.post('/register', formData, {
                                            headers: {
                                                'Content-Type': 'multipart/form-data',
                                                'processData': false

                                            }
                                        }).then(function(response) {
                                            toastr.success(response.data.message)
                                            $("#avatarContainer").fadeOut("slow")
                                            $("#registerForm").trigger("reset");

                                        }).catch((err) => {
                                            if (err.response.data.message != undefined) {
                                                toastr.error(err.response.data.message)


                                            } else {
                                                for (let k in err.response.data) {
                                                    toastr.error(err.response.data[k])
                                                }
                                            }

                                            console.log(err);

                                        }).finally(() => {
                                            $("#btnSubmitRegister").html(`Ajouter`)
                                        });
                                    }


                                })



                                $('#avatar').change(function() {
                                    var i = $(this).prev('label').clone();
                                    var file = $('#avatar')[0].files[0].name;
                                    $(this).prev('label').text("Tap to change");
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#imageCont').fadeIn("slow")
                                        $('#imageCont').attr('src', e.target.result)
                                    };
                                    reader.readAsDataURL($('#avatar')[0].files[0]);


                                });
                                $("#type").on("change", () => {
                                    if ($('#type').val() == "2") {
                                        $("#avatarContainer").fadeIn("slow")
                                        $("#avatar").attr("required", true)

                                    } else {
                                        $("#avatarContainer").fadeOut("slow")
                                        $("#avatar").attr("required", false)


                                    }
                                })
                            </script>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xl-3 mb-2">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a id="addRegBtn" data-bs-toggle="modal" data-bs-target="#addReg">
                                        Région/Ville</a>
                                    <div class="modal fade" id="addReg" tabindex="-1" role="dialog"
                                        aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-0">
                                                <div class="modal-body p-4 px-5 ">


                                                    <div class="main-content  mb-3 py-auto">

                                                        <a href="#" style="" class="close-btn"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><span
                                                                    class="fal fa-times"></span></span>
                                                        </a>




                                                        <div>
                                                            <form action="#" id="AddRegForm" class="formsModal">
                                                                <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                                                    Ajouter région/ville</h6>
                                                                <small class="text-muted text-center mb-2"
                                                                    style="font-size: 12px">*
                                                                    Séparez les noms par des
                                                                    virgules ' <strong style="font-size: 11px">,</strong> '
                                                                    si vous
                                                                    voulez
                                                                    ajouter
                                                                    plusieurs</small>
                                                                <div
                                                                    class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                                    <label for="" class="px-2 color-3 fs-5"><i
                                                                            class="fal fa-tag"></i></label>
                                                                    <input type="text"
                                                                        class="form-control shadow-none border-0  bg-transparent"
                                                                        placeholder="Nom" name="label" required>

                                                                </div>

                                                                <div
                                                                    class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                                                    <label for="" class="px-2 color-3 fs-5"><i
                                                                            class="fal fa-coins"></i></label>
                                                                    <input type="number" step="0.1"
                                                                        class="form-control shadow-none border-0  bg-transparent"
                                                                        placeholder="frais de livraison" name="prix"
                                                                        required>
                                                                </div>


                                                                <div class="mx-auto mt-3">
                                                                    <button href="#!" type="submit"
                                                                        id="aDDrEGsUBMIT" class="btn w-100">Ajouter&nbsp;
                                                                        <i class="fal fa-check"></i></button>
                                                                </div>
                                                                @csrf
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <script>
                                                        let oldvalEdit = $("#aDDrEGsUBMIT").html()

                                                        $("#AddRegForm").on("submit", (e) => {
                                                            e.preventDefault()
                                                            $("#aDDrEGsUBMIT").html(spinner)

                                                            axios.post("/region/add", $("#AddRegForm").serialize())
                                                                .then(res => {
                                                                    toastr.info(res.data.message)
                                                                    $(".modal").modal("hide")


                                                                })
                                                                .catch(err => {
                                                                    console.error(err);
                                                                    if (err.response.data.type != undefined) {

                                                                        toastr.error(err.response.data.message)
                                                                    } else {
                                                                        for (const k in err.response.data) {
                                                                            toastr.error(err.response.data[k])

                                                                        }
                                                                    }
                                                                }).finally(() => {
                                                                    $("#aDDrEGsUBMIT").html(oldvalEdit)
                                                                })


                                                        })
                                                    </script>


                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-auto"><i class="fas fa-map-marker-plus fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <a data-bs-toggle="modal" data-bs-target="#addFrais">Frais de nuit</a>

                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    {{-- <span>{{ $type == 2 ? count($commandes) : count($response) }}</span> --}}
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endif
    <ul class="nav justify-content-end flex-column">
        @if (Auth::user()->type != 4)
            @if (Auth::user()->type == 2)
                <li class="nav-item" style="">
                    <a class="nav-link  text-primary" href="#commandes"><i
                            class="fal fa-angle-double-right"></i>&nbsp;Commandes non terminées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#ordersRestoMessage"><i
                            class="fal fa-angle-double-right"></i>&nbsp;Commande
                        par
                        message</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#demandes"><i
                            class="fal fa-angle-double-right"></i>&nbsp;Demandes
                        de
                        livreurs</a>
                </li>
            @endif
            @if (Auth::user()->type == 3)
            @endif
        @endif

        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> --}}
    </ul>
    <div id="mainContent">

    </div>
    <div class="modal fade" id="addFrais" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">


                    <div class="main-content  mb-3 py-auto">

                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>




                        <div>
                            <form action="#" method="post" id="AddFraisForm" class="formsModal">
                                <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                    Frais de nuit</h6>
                                @php
                                    use App\Models\Config;
                                    $check = Config::where('id', '!=', null)->first();
                                    $frais = null;
                                    $du = null;
                                    $to = null;
                                    $old = false;
                                    
                                    if ($check) {
                                        $frais = $check->frais_nuit;
                                        $du = $check->du;
                                        $to = $check->to;
                                        $old = true;
                                    }
                                    
                                @endphp

                                <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                    <input type="number" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Frais" name="frais_nuit" required value="{{ $frais }}">

                                </div>
                                <div class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5">Du
                                    </label>
                                    <input type="time" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Du" name="du" required value="{{ $du }}">
                                </div>
                                <div class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                    <label for="" class="px-2 color-3 fs-5">
                                        Jusqu'à</label>&nbsp;
                                    <input type="time" class="form-control shadow-none border-0  bg-transparent"
                                        placeholder="Jusqu'à" name="to" required value="{{ $to }}">
                                </div>

                                @csrf


                                <div class="mx-auto mt-3">
                                    <button href="#!" type="submit" id="addfraisbtn"
                                        class="btn w-100">{{ $old ? 'Modifier' : 'Ajouter' }}&nbsp;
                                        <i class="fal fa-check"></i></button>
                                </div>
                            </form>

                        </div>

                    </div>



                </div>


            </div>
        </div>

    </div>
    <script>
        let oldvalEditFrais = $("#addfraisbtn").html()


        $("#AddFraisForm").on("submit", (e) => {
            console.log("test");
            e.preventDefault()
            $("#addfraisbtn").html(spinner)


            axios.post("/configs/add", $("#AddFraisForm").serialize())
                .then(res => {
                    toastr.info(res.data.message)
                    $(".modal").modal("hide")


                })
                .catch(err => {
                    console.error(err);
                    if (err.response.data.type != undefined) {

                        toastr.error(err.response.data.message)
                    } else {
                        for (const k in err.response.data) {
                            toastr.error(err.response.data[k])

                        }
                    }
                }).finally(() => {
                    $("#addfraisbtn").html(oldvalEditFrais)
                })


        })
    </script>
    <script>
        function LoadContentMain() {
            $("#mainContent").load("/dash/mainContent")
        }
        timer = setInterval(LoadContentMain(), 100 * 5000);



        $('#mainContent').hover(function() {
            clearInterval(timer);
        }, function() {

            timer = setInterval(LoadContentMain, 100 * 5000);
        });



        LoadContentMain()
    </script>
@endsection
