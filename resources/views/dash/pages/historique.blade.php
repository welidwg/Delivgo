@extends('dash/base')

@section('title')
    Historique
@endsection

@section('header_path')
    Historique
@endsection

@section('header_title')
    Historique
@endsection

@section('content')
    <div class="row">
        <div id="mainct">

        </div>
    </div>
    <script>
        function LoadContentMain() {
            try {
                $("#mainct").load("/dash/historiqueContent")
                setTimeout(() => {
                    LoadContentMain()
                }, 14000);
            } catch (error) {
                console.error(error);
            }


        }
        LoadContentMain()
    </script>
@endsection
