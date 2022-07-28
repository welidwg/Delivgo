@extends('main/base')

@php
use App\Models\User;
use App\Models\Commande;
use App\Models\commande_ref;
use App\Models\Garniture;
use App\Models\Sauce;
use App\Models\Drink;
use App\Models\Supplement;
use Illuminate\Support\Carbon;

@endphp
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
                                {{-- <div class="col col-sm-12 col-lg-2 col-md-2">
                                    <img src="images/cabane.jpg" class="img-fluid  rounded-circle p-2">

                                </div> --}}
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-5 text-white fw-bold text-center">My Orders</h4>
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
    <div class="bg-white p-5  vh-100" style="z-index: 1 !important;position: relative;">

        <div class="table-responsive shadow p-3 " style="border-radius: 12px;">
            <table class="table mb-0 table-hover align-middle  py-3 px-3 " id="orders">
                <thead>
                    <tr>
                        <th class="border-top-0">Restaurant</th>
                        <th class="border-top-0">Products</th>
                        <th class="border-top-0">Restaurant Phone</th>
                        <th class="border-top-0">Date passed</th>
                        <th class="border-top-0">Statut</th>
                        <th class="border-top-0">Total Price</th>
                        <th class="border-top-0">Cancel</th>
                    </tr>
                </thead>
                <style>
                    .accordion-body {
                        max-width: 200px;
                        width: 200px;
                        overflow-y: auto;
                        word-wrap: break-word
                    }
                </style>
                <tbody>
                    @php
                        $me = User::where('user_id', Auth::user()->user_id)
                            ->with('commandesPassed')
                            ->get();
                        $cmds = commande_ref::where('user_id', Auth::user()->user_id)
                            ->with('user')
                            ->with('resto')
                            ->get();
                        $total = 0;
                        
                    @endphp
                    <script>
                        let ids = [];
                    </script>
                    @forelse ($cmds as $cmd)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><a class="btn btn-circle d-flex btn-white text-white"
                                            href="/resto/{{ $cmd->resto->user_id }}">
                                            <img src="{{ asset('uploads/logos/' . $cmd->resto->avatar) }}" alt=""
                                                class="img-fluid rounded" width="80px">
                                        </a>
                                    </div>
                                    <div class="">
                                        <h4 class="m-b-0 font-16">{{ $cmd->resto->name }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    // $commandes = Commande::where('id', $cmd->commande_id)
                                    //     ->with('product')
                                    //     ->get();
                                    ${'total' . $cmd->id} = 0;
                                @endphp

                                <script>
                                    console.log({{ count($cmd->items) }});
                                </script>
                                @foreach ($cmd->items as $command)
                                    {{-- <script>
                                        ids.push({{ $cmd->id }})
                                        console.log(ids);
                                    </script> --}}
                                    @php
                                        $total += $command->total;
                                    @endphp

                                    @php
                                        ${'total' . $cmd->id} += $command->total;
                                    @endphp
                                    <div class="accordion accordion-flush"style="max-width: 200px !important;word-wrap: break-word"
                                        id="accordionExample{{ $command->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="pr{{ $command->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#product{{ $command->id }}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    {{ $command->product->label }}
                                                    ({{ $command->quantity }})
                                                </button>
                                            </h2>
                                            <div id="product{{ $command->id }}" class="accordion-collapse collapse "
                                                aria-labelledby="" data-bs-parent="#accordionExample{{ $command->id }}"
                                                style="max-width: 200px !important;word-wrap: break-word">
                                                <div class="accordion-body h-100">
                                                    <span class="text-muted fw-bold">Total:
                                                    </span> {{ $command->total }} DT
                                                    <br>

                                                    @if ($command->garnitures != '')
                                                        <span class="text-muted fw-bold">Toppings: </span>
                                                        @php
                                                            $toppings = json_decode($command->garnitures);
                                                            
                                                        @endphp
                                                        @foreach ($toppings as $topping)
                                                            @php
                                                                $topp = Garniture::where('id', $topping)->first();
                                                            @endphp
                                                            {{ $topp->label }},
                                                        @endforeach
                                                        <br>
                                                    @endif
                                                    @if ($command->supplements != '')
                                                        <span class="text-muted fw-bold">Supplements:
                                                        </span>
                                                        @php
                                                            $supplements = json_decode($command->supplements);
                                                            
                                                        @endphp
                                                        @foreach ($supplements as $supplement)
                                                            @php
                                                                $sp = Supplement::where('id', $supplement)->first();
                                                            @endphp
                                                            {{ $sp->label }},
                                                        @endforeach
                                                        <br>
                                                        @if ($command->sauces != '')
                                                            <span class="text-muted fw-bold">Sauces: </span>
                                                            @php
                                                                $sauces = json_decode($command->sauces);
                                                                
                                                            @endphp
                                                            @foreach ($sauces as $sauce)
                                                                @php
                                                                    $sc = Sauce::where('id', $sauce)->first();
                                                                @endphp
                                                                {{ $sc->label }},
                                                            @endforeach
                                                            <br>
                                                        @endif
                                                    @endif

                                                    @if ($command->drinks != '')
                                                        <span class="text-muted fw-bold">Drinks: </span>
                                                        @php
                                                            $drinks = json_decode($command->drinks);
                                                            
                                                        @endphp
                                                        @foreach ($drinks as $drink)
                                                            @php
                                                                $dr = Drink::where('id', $drink)->first();
                                                            @endphp
                                                            {{ $dr->label }},
                                                        @endforeach
                                                        <br>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </td>

                            <td><a href="tel:{{ $cmd->resto->phone }}">{{ $cmd->resto->phone }}</a></td>
                            <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>
                            <td>
                                @switch($cmd->statut)
                                    @case(1)
                                        <label class="badge bg-warning">Waiting</label>
                                    @break

                                    @case(2)
                                        <label class="badge bg-info">Processing</label>
                                    @break

                                    @case(3)
                                        <label class="badge bg-primary">Ready</label>
                                    @break

                                    @case(4)
                                        <label class="badge bg-warning">Delivering</label>
                                    @break

                                    @case(5)
                                        <label class="badge bg-success">Delivered</label>
                                    @break

                                    @case(6)
                                        <label class="badge bg-danger">Cancelled</label>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>{{ ${'total' . $cmd->id} }} Dt</td>


                            <td>

                                @if ($cmd->statut == 1)
                                    <a href="#!" id="cancelCmd{{ $cmd->id }}"
                                        class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                                @else
                                    @if ($cmd->statut == 6)
                                        <a href="#!" id="deleteCmd{{ $cmd->id }}"
                                            class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                        <script>
                                            $("#deleteCmd{{ $cmd->id }}").on("click", (e) => {
                                                axios.delete("/commande/delete", {
                                                        ids: ids
                                                    })
                                                    .then(res => {
                                                        console.log(res)
                                                    })
                                                    .catch(err => {
                                                        console.error(err);
                                                    })
                                            })
                                        </script>
                                    @else
                                        Not cancellable
                                    @endif
                                @endif

                            </td>
                        </tr>

                        <script>
                            $("#cancelCmd{{ $cmd->id }}").on("click", (e) => {
                                e.preventDefault()
                                alertify.confirm("Confirmation", "Ae you sure that you want to cancel this order ?", () => {
                                    axios.post("/commande/statut", {
                                            "_token": "{{ csrf_token() }}",
                                            user_id: "{{ $cmd->user_id }}",
                                            resto_id: "{{ $cmd->resto_id }}",
                                            statut: 6
                                        })
                                        .then(res => {
                                            console.log(res)
                                            toastr.info("Order have been cancelled")
                                        })
                                        .catch(err => {
                                            console.error(err);
                                            toastr.error("Something went wrong")

                                        })

                                }, () => {})
                            })
                        </script>

                        @empty
                        @endforelse




                    </tbody>
                </table>
                <div class="text-end mt-5 px-5 fw-bold fs-5">
                    Total : {{ $total }} Dt
                </div>
            </div>

            <script>
                $("#orders").DataTable({
                    "language": {
                        "decimal": ".",
                        "emptyTable": "You have not passed any command yet",
                        "info": "",
                        "infoFiltered": "",
                        "infoEmpty": "",
                        "lengthMenu": "",
                    }
                })
            </script>

        </div>
    @endsection
