@extends('dash/base')
@section('title')
    Utilisateurs
@endsection
@section('header_path')
    Utilisateurs
@endsection
@section('header_title')
    Utilisateurs
@endsection
@section('content')
    <div class="row">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Listes des utilisateurs </h4>
                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="requestDel">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Matricule</th>
                                    <th class="border-top-0">Nom</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Téléphone</th>
                                    <th class="border-top-0">Type</th>
                                    <th class="border-top-0">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    
                                @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td><strong>#{{ $user->username }}</strong></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">
                                                        <img src="{{ asset('uploads/logos/' . $user->avatar) }}"
                                                            alt="" class="img-fluid " width="80px">
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <h4 class="m-b-0 font-16">{{ $user->name }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td id="datePassDemande{{ $user->user_id }}"></td>
                                        <script>
                                            $('#datePassDemande{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
                                        </script> --}}
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            @switch($user->type)
                                                @case(1)
                                                    Client
                                                @break

                                                @case(2)
                                                    Restaurant
                                                @break

                                                @case(3)
                                                    Livreur
                                                @break

                                                @default
                                            @endswitch
                                        </td>


                                        <td>
                                            @if ($user->type == 2 || $user->type == 3)
                                                <a href="{{ url('/dash/profile/' . $user->user_id) }}"
                                                    class="btn shadow-none text-primary"><i class="fas fa-eye"></i></a>
                                            @endif
                                            <a href="#!" id="deleteUser{{ $user->user_id }}"
                                                class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                                            <script>
                                                $("#deleteUser{{ $user->user_id }}").on("click", (e) => {
                                                    e.preventDefault()
                                                    alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cet utilisateur ?", () => {
                                                        axios.delete("/user/delete/{{ $user->user_id }}", {


                                                            })
                                                            .then(res => {
                                                                console.log(res)
                                                                toastr.info(res.data.message)
                                                                // LoadContentMain()

                                                            })
                                                            .catch(err => {
                                                                console.error(err);
                                                                toastr.error("Quelque chose s'est mal passé")

                                                            })

                                                    }, () => {})
                                                })
                                            </script>
                                        </td>
                                    </tr>

                                    @empty
                                    @endforelse



                                </tbody>
                            </table>
                            <script>
                                $("#requestDel").DataTable({
                                    "pageLength": 4,

                                    "language": {
                                        "decimal": ".",
                                        "emptyTable": "Il n'ya aucun enregistrement encore",
                                        "info": "",
                                        "infoFiltered": "",
                                        "infoEmpty": "",
                                        "lengthMenu": "",
                                    }
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
