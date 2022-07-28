@extends('dash/base')





@section('title')
    Tableau de bord
@endsection
@section('header_path')
    Tableau de bord
@endsection
@section('header_title')
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
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error("Quelque chose s'est mal passé")

                        })
                })
            </script>

        </div>

    </span>
@endsection

@section('content')
    <ul class="nav justify-content-end flex-column">
        <li class="nav-item" style="">
            <a class="nav-link  text-primary" href="#commandes"><i class="fal fa-angle-double-right"></i>&nbsp;Commandes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="#demandes"><i class="fal fa-angle-double-right"></i>&nbsp;Demandes de
                livreurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="#"><i class="fal fa-angle-double-right"></i>&nbsp;Commande par
                message</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> --}}
    </ul>
    <div id="mainContent">

    </div>
    <script>
        function LoadContentMain() {
            $("#mainContent").load("/dash/mainContent")
            setTimeout(() => {
                LoadContentMain()
            }, 14000);

        }
        LoadContentMain()
    </script>
@endsection
