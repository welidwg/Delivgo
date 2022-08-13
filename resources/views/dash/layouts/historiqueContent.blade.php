   @php
       use App\models\User;
       use App\models\Commande;
       use App\models\commande_ref;
       use App\models\RequestResto;
       use App\models\Region;
       use App\models\Config;
       use App\models\IsNight;
   @endphp
   @php
       use App\Models\Garniture;
       use App\Models\Sauce;
       use App\Models\Drink;
       use App\Models\Supplement;
       use App\Models\Demande;
   @endphp
   @if (Auth::user()->type == 2)

       <div class="col-12 mb-3" id="ff">
           <div class="card ">
               <div class="card-body">
                   <!-- title -->
                   <div class="d-md-flex p-0">
                       <div>
                           <h4 class="card-title">Liste des commandes</h4>
                           {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                       </div>

                   </div>
                   <!-- title -->
                   <div class="table-responsive">
                       <table class="table mb-0 table-hover align-middle text-nowrap" id="ordersResto">
                           <thead>
                               <tr>
                                   <th class="border-top-0 d-none d-lg-table-cell">Référence</th>
                                   <th class="border-top-0">Client</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">Produits</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">N° Client</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">Date de passation</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">Date de livraison</th>
                                   <th class="border-top-0 ">Statut</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">Total</th>
                                   <th class="border-top-0 d-none d-lg-table-cell">Livreur</th>
                                   <th class="border-top-0 d-lg-none ">Details</th>
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
                                   $cmds = commande_ref::where('resto_id', Auth::user()->user_id)
                                       ->where('statut', '=', 5)
                                       ->with('items')
                                       ->orderBy('statut', 'asc')
                                       ->get();
                                   
                               @endphp
                               @forelse ($cmds as $cmd)
                                   @if (!$cmd->is_message)
                                       @php
                                           $total = 0;
                                       @endphp
                                       <tr>
                                           <td class="d-none d-lg-table-cell">
                                               <strong>#{{ $cmd->reference }}</strong>
                                           </td>
                                           <td>
                                               <div class="d-flex align-items-center">
                                                   <div class="m-r-10"><a
                                                           class="btn btn-circle d-flex btn-info text-white">
                                                           <img src="{{ asset('uploads/logos/' . $cmd->user->avatar) }}"
                                                               alt="" class="img-fluid " width="80px">
                                                       </a>
                                                   </div>
                                                   <div class="">
                                                       <h4 class="m-b-0 font-16">{{ $cmd->user->name }}</h4>
                                                   </div>
                                               </div>
                                           </td>
                                           <td class="d-none d-lg-table-cell">


                                               @foreach ($cmd->items as $passed)
                                                   @php
                                                       $total += $passed->total;
                                                   @endphp
                                                   <div class="accordion accordion-flush"style="max-width: 200px !important;word-wrap: break-word"
                                                       id="accordionExample{{ $passed->id }}">
                                                       <div class="accordion-item">
                                                           <h2 class="accordion-header" id="pr{{ $passed->id }}">
                                                               <button class="accordion-button collapsed" type="button"
                                                                   data-bs-toggle="collapse"
                                                                   data-bs-target="#product{{ $passed->id }}"
                                                                   aria-expanded="true" aria-controls="collapseOne">
                                                                   {{ $passed->product->label }}
                                                                   ({{ $passed->quantity }})
                                                               </button>
                                                           </h2>
                                                           <div id="product{{ $passed->id }}"
                                                               class="accordion-collapse collapse " aria-labelledby=""
                                                               data-bs-parent="#accordionExample{{ $passed->id }}"
                                                               style="max-width: 200px !important;word-wrap: break-word">
                                                               <div class="accordion-body h-100">
                                                                   <span class="text-muted fw-bold">Total:
                                                                   </span> {{ $passed->total }} DT
                                                                   <br>

                                                                   @if ($passed->garnitures != '')
                                                                       <span class="text-muted fw-bold">Granitures:
                                                                       </span>
                                                                       @php
                                                                           $toppings = json_decode($passed->garnitures);
                                                                           
                                                                       @endphp
                                                                       @foreach ($toppings as $topping)
                                                                           @php
                                                                               $topp = Garniture::where('id', $topping)->first();
                                                                           @endphp
                                                                           {{ $topp->label }},
                                                                       @endforeach
                                                                       <br>
                                                                   @endif
                                                                   @if ($passed->supplements != '')
                                                                       <span class="text-muted fw-bold">Supplements:
                                                                       </span>
                                                                       @php
                                                                           $supplements = json_decode($passed->supplements);
                                                                           
                                                                       @endphp
                                                                       @foreach ($supplements as $supplement)
                                                                           @php
                                                                               $sp = Supplement::where('id', $supplement)->first();
                                                                           @endphp
                                                                           {{ $sp->label }},
                                                                       @endforeach
                                                                       <br>
                                                                       @if ($passed->sauces != '')
                                                                           <span class="text-muted fw-bold">Sauces:
                                                                           </span>
                                                                           @php
                                                                               $sauces = json_decode($passed->sauces);
                                                                               
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

                                                                   @if ($passed->drinks != '')
                                                                       <span class="text-muted fw-bold">Boissons:
                                                                       </span>
                                                                       @php
                                                                           $drinks = json_decode($passed->drinks);
                                                                           
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
                                           <td class="d-none d-lg-table-cell"><a
                                                   href="tel:{{ $cmd->user->phone }}">{{ $cmd->user->phone }}</a>
                                           </td>
                                           <td id="datepass{{ $cmd->id }}" class="d-none d-lg-table-cell">
                                           </td>
                                           <td id="dateLiv{{ $cmd->id }}" class="d-none d-lg-table-cell">
                                           </td>
                                           <script>
                                               $('#datepass{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
                                               $('#dateLiv{{ $cmd->id }}').html(moment("{{ $cmd->updated_at }}").format("LL | LT"))
                                           </script>
                                           <td>
                                               @switch($cmd->statut)
                                                   @case(1)
                                                       <label class="badge bg-warning">En attente</label>
                                                   @break

                                                   @case(2)
                                                       <label class="badge bg-info">Traitement</label>
                                                   @break

                                                   @case(3)
                                                       <label class="badge bg-primary">Prêt</label>
                                                   @break

                                                   @case(4)
                                                       <label class="badge bg-warning">En livraison</label>
                                                   @break

                                                   @case(5)
                                                       <label class="badge bg-success">Livrée

                                                       </label>
                                                   @break

                                                   @case(6)
                                                       <label class="badge bg-danger">Annulée</label>
                                                   @break

                                                   @default
                                               @endswitch
                                           </td>
                                           <td class="d-none d-lg-table-cell">
                                               {{ $total }} TND</td>
                                           <td class="d-none d-lg-table-cell">
                                               {{ $cmd->deliverer_id == null ? '' : $cmd->deliverer->name }}</td>

                                           <td class="d-lg-none">
                                               <a href="#!" data-bs-toggle="modal"
                                                   data-bs-target="#DetailsModal{{ $cmd->id }}"
                                                   class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                           </td>
                                       </tr>
                                       <div class="modal fade" id="DetailsModal{{ $cmd->id }}"
                                           aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                           <div class="modal-dialog modal-dialog-centered" role="document">
                                               <div class="modal-content rounded-0">
                                                   <div class="modal-body p-4 px-0 ">


                                                       <div class="main-content text-center mb-3 py-auto">

                                                           <a href="#" style="" class="close-btn"
                                                               id="closeModalConfirm" data-bs-toggle=""
                                                               data-bs-dismiss="modal">
                                                               <span aria-hidden="true"><span
                                                                       class="fal fa-times"></span></span>
                                                           </a>
                                                           <h6 class="text-center">Référence :
                                                               <strong>#{{ $cmd->reference }}</strong>
                                                           </h6>
                                                           <div
                                                               class="row flex-column justify-content-start align-items-center">
                                                               @if (Auth::user()->user_id !== $cmd->resto->user_id)
                                                                   <div class="col mb">
                                                                       <label class="">Restaurant:</label>
                                                                       <strong>
                                                                           <a
                                                                               href="{{ url('/resto/' . $cmd->resto->user_id) }}">
                                                                               {{ $cmd->resto->name }}

                                                                           </a>

                                                                       </strong>



                                                                   </div>
                                                                   <div class="col mb-2">
                                                                       <span>N° Restaurant: <strong>
                                                                               <a
                                                                                   href="tel:+216{{ $cmd->resto->phone }}">
                                                                                   {{ $cmd->resto->phone }}

                                                                               </a>

                                                                           </strong></span>



                                                                   </div>
                                                               @endif

                                                               <div class="col mb-2">
                                                                   <span>Date de passation : <strong
                                                                           id="dateTelff{{ $cmd->id }}">


                                                                       </strong></span>
                                                                   <script>
                                                                       $('#dateTelff{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
                                                                   </script>


                                                               </div>
                                                               <div class="col mb-2">
                                                                   <span>Livreur : <strong>
                                                                           @if ($cmd->taken)
                                                                               {{ $cmd->deliverer->name }}
                                                                           @else
                                                                               <span class="text-warning">
                                                                                   en attente de livreur

                                                                               </span>
                                                                           @endif


                                                                       </strong></span>



                                                               </div>

                                                               <div class="col mb-2">
                                                                   <span>Date de livraison : <strong
                                                                           id="dateLivff{{ $cmd->id }}">


                                                                       </strong></span>
                                                                   <script>
                                                                       $('#dateLivff{{ $cmd->id }}').html(moment("{{ $cmd->updated_at }}").format('LL | LT'))
                                                                   </script>


                                                               </div>
                                                               <div class="col mb-2">
                                                                   <span class="fw-bold">Produits/Message:</span>

                                                                   @if ($cmd->is_message)
                                                                       <p class="text-center">
                                                                           {{ $cmd->messages[0]->message }}</p>
                                                                   @else
                                                                       @foreach ($cmd->items as $command)
                                                                           <div class="accordion bg-transparent accordion-flush mx-auto"style="max-width: 200px !important;word-wrap: break-word;background:transparent !important"
                                                                               id="accordionExample{{ $command->id }}">
                                                                               <div class="accordion-item">
                                                                                   <h2 class="accordion-header"
                                                                                       id="pr{{ $command->id }}">
                                                                                       <button
                                                                                           class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2 text-nowrap"
                                                                                           style="background: transparent !important"
                                                                                           type="button"
                                                                                           data-bs-toggle="collapse"
                                                                                           data-bs-target="#product{{ $command->id }}"
                                                                                           aria-expanded="true"
                                                                                           aria-controls="collapseOne">
                                                                                           {{ $command->product->label }}
                                                                                           ({{ $command->quantity }})
                                                                                       </button>
                                                                                   </h2>
                                                                                   <div id="product{{ $command->id }}"
                                                                                       class="accordion-collapse collapse "
                                                                                       aria-labelledby=""
                                                                                       data-bs-parent="#accordionExample{{ $command->id }}"
                                                                                       style="max-width: 200px !important;word-wrap: break-word">
                                                                                       <div
                                                                                           class="accordion-body h-100">
                                                                                           <span
                                                                                               class="text-muted fw-bold">Totale:
                                                                                           </span>
                                                                                           {{ $command->total }} DT
                                                                                           <br>

                                                                                           @if ($command->garnitures != '')
                                                                                               <span
                                                                                                   class="text-muted fw-bold">Garnitures:
                                                                                               </span>
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
                                                                                               <span
                                                                                                   class="text-muted fw-bold">Suppléments:
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
                                                                                                   <span
                                                                                                       class="text-muted fw-bold">Sauces:
                                                                                                   </span>
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
                                                                                               <span
                                                                                                   class="text-muted fw-bold">Boissons:
                                                                                               </span>
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
                                                                   @endif


                                                               </div>
                                                               <div class="col mb-2">
                                                                   <span>Total : <strong>
                                                                           @if ($cmd->is_message)
                                                                               Livraison :
                                                                               {{ $cmd->user->region->deliveryPrice }}
                                                                               TND
                                                                           @else
                                                                               {{ $total }}
                                                                               TND
                                                                           @endif


                                                                       </strong></span>



                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>

                                           </div>
                                       </div>

                                       <script>
                                           $('#DetailsModal{{ $cmd->id }}').appendTo("body")
                                       </script>
                                       @php
                                           $total = 0;
                                       @endphp
                                   @endif

                                   @empty
                                   @endforelse



                               </tbody>
                           </table>
                           <script>
                               $("#ordersResto").DataTable({
                                   "order": [],
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
       @else
           @if (Auth::user()->type == 3)
               <div class="col-12" id="commandes">
                   <div class="card">
                       <div class="card-body">
                           <!-- title -->
                           <div class="d-md-flex">
                               <div>
                                   <h4 class="card-title">Vos commandes livrées</h4>
                                   {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                               </div>

                           </div>
                           <!-- title -->
                           <div class="table-responsive" style="zoom: 1">
                               <table class="table mb-0 table-hover align-middle text-nowrap" id="DeliveringTable">
                                   <thead>
                                       <tr>
                                           <th class="border-top-0 d-none d-lg-table-cell">Référence</th>
                                           <th class="border-top-0 d-none d-lg-table-cell">Restaurant</th>
                                           <th class="border-top-0">Client</th>
                                           <th class="border-top-0 d-none d-lg-table-cell">Date de passation</th>
                                           <th class="border-top-0 d-none d-lg-table-cell">Date de livraison</th>
                                           <th class="border-top-0">Statut</th>
                                           <th class="border-top-0 d-none d-lg-table-cell">Frais de livraison</th>
                                           <th class="border-top-0 d-none d-lg-table-cell">Total (compris les frais)</th>
                                           <th class="d-lg-none">Détails</th>
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
                                           
                                           $commandes = commande_ref::where('deliverer_id', Auth::user()->user_id)
                                               ->where('statut', '=', 5)
                                               ->get();
                                           
                                       @endphp
                                       @forelse ($commandes as $cmd)
                                           @php
                                               $total = 0;
                                           @endphp
                                           @foreach ($cmd->items as $passed)
                                               @php
                                                   $total += $passed->total;
                                               @endphp
                                           @endforeach
                                           <tr>
                                               <td class="d-none d-lg-table-cell">
                                                   <strong>#{{ $cmd->reference }} </strong>

                                               </td>
                                               <td class="d-none d-lg-table-cell">
                                                   <div class="d-flex align-items-center">
                                                       <div class="m-r-10"><a
                                                               class="btn btn-circle d-flex btn-info text-white">
                                                               <img src="{{ asset('uploads/logos/' . $cmd->resto->avatar) }}"
                                                                   alt="" class="img-fluid " width="80px">
                                                           </a>
                                                       </div>
                                                       <div class="">
                                                           <h4 class="m-b-0 font-16">{{ $cmd->resto->name }}</h4>
                                                           <small>Tel : <a
                                                                   href="tel:{{ $cmd->resto->phone }}">{{ $cmd->resto->phone }}</a>
                                                           </small>
                                                           <br>
                                                           <small>Adresse :
                                                               {{ $cmd->resto->address == '' ? 'N\A' : $cmd->resto->address }}
                                                           </small>
                                                       </div>
                                                   </div>

                                               </td>
                                               <td>
                                                   <div class="d-flex align-items-center">
                                                       <div class="m-r-10"><a
                                                               class="btn btn-circle d-flex btn-info text-white">
                                                               <img src="{{ asset('uploads/logos/' . $cmd->user->avatar) }}"
                                                                   alt="" class="img-fluid " width="80px">
                                                           </a>
                                                       </div>
                                                       <div class="">
                                                           <h4 class="m-b-0 font-16">{{ $cmd->user->name }}</h4>
                                                           <small>Tel : <a
                                                                   href="tel:{{ $cmd->user->phone }}">{{ $cmd->user->phone }}</a>
                                                           </small>
                                                           <br>
                                                           <small>Adresse :
                                                               {{ $cmd->address == '' ? 'N\A' : $cmd->address }}
                                                           </small>

                                                       </div>
                                                   </div>
                                               </td>


                                               <td class="d-none d-lg-table-cell" id="datepass{{ $cmd->id }}">
                                               </td>
                                               <td class="d-none d-lg-table-cell" id="dateLiv{{ $cmd->id }}">
                                               </td>
                                               <script>
                                                   $('#datepass{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
                                                   $('#dateLiv{{ $cmd->id }}').html(moment("{{ $cmd->updated_at }}").format("LL | LT"))
                                               </script>
                                               <td>
                                                   @switch($cmd->statut)
                                                       @case(1)
                                                           <label class="badge bg-warning">En attente</label>
                                                       @break

                                                       @case(2)
                                                           <label class="badge bg-info">Traitement</label>
                                                       @break

                                                       @case(3)
                                                           <label class="badge bg-primary">Prêt</label>
                                                       @break

                                                       @case(4)
                                                           <label class="badge bg-warning">En livraison</label>
                                                       @break

                                                       @case(5)
                                                           <label class="badge bg-success">Livrée</label>
                                                       @break

                                                       @case(6)
                                                           <label class="badge bg-danger">Annulée</label>
                                                       @break

                                                       @default
                                                   @endswitch
                                               </td>
                                               <td class="d-none d-lg-table-cell">
                                                   {{ $cmd->frais }} TND
                                               </td>
                                               <td class="d-none d-lg-table-cell">
                                                   {{ $cmd->total + $cmd->frais }} TND
                                               </td>


                                               <td class="d-lg-none">
                                                   <a href="#!" id="seeDetails{{ $cmd->id }}"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#DetaildLivAccepted{{ $cmd->id }}"
                                                       class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                               </td>
                                           </tr>
                                           <div class="modal fade" id="DetaildLivAccepted{{ $cmd->id }}"
                                               aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                               <div class="modal-dialog modal-dialog-centered" role="document">
                                                   <div class="modal-content rounded-0">
                                                       <div class="modal-body p-4 px-0 ">


                                                           <div class="main-content text-center mb-3 py-auto">

                                                               <a href="#" style="" class="close-btn"
                                                                   id="closeModalConfirm" data-bs-dismiss="modal">
                                                                   <span aria-hidden="true"><span
                                                                           class="fal fa-times"></span></span>
                                                               </a>
                                                               <h6 class="text-center">Référence :
                                                                   <strong>{{ $cmd->reference }}</strong>
                                                               </h6>
                                                               <div
                                                                   class="row flex-column justify-content-start align-items-center">
                                                                   <div class="col mb">
                                                                       <label class="">Restaurant:</label>
                                                                       <span>{{ $cmd->resto->name }}</span>




                                                                   </div>
                                                                   <div class="col mb-2">
                                                                       <span>N° Restaurant: <strong>
                                                                               <a href="tel:{{ $cmd->resto->phone }}">
                                                                                   {{ $cmd->resto->phone }}

                                                                               </a>

                                                                           </strong></span>



                                                                   </div>
                                                                   <div class="col mb-2">
                                                                       <span>Date de passation :
                                                                           <strong id="datepassLivr{{ $cmd->id }}">


                                                                           </strong>
                                                                       </span>
                                                                       <script>
                                                                           $('#datepassLivr{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
                                                                       </script>


                                                                   </div>
                                                                   <div class="col mb-2">
                                                                       <span>Date de livraison :
                                                                           <strong id="dateLivr2{{ $cmd->id }}">


                                                                           </strong>
                                                                       </span>
                                                                       <script>
                                                                           $('#dateLivr2{{ $cmd->id }}').html(moment("{{ $cmd->updated_at }}").format('LL | LT'))
                                                                       </script>


                                                                   </div>

                                                                   <div class="col mb-2">
                                                                       <span>Frais de livraison: <strong>
                                                                               {{ $cmd->frais }} TND

                                                                           </strong></span>



                                                                   </div>
                                                                   <div class="col mb-2">
                                                                       <span>Total (compris les frais): <strong>
                                                                               {{ $cmd->total + $cmd->frais }} TND

                                                                           </strong></span>



                                                                   </div>




                                                               </div>



                                                           </div>

                                                       </div>
                                                   </div>

                                               </div>
                                           </div>
                                           @php
                                               $total = 0;
                                           @endphp
                                           @empty
                                           @endforelse



                                       </tbody>
                                   </table>
                                   <script>
                                       $("#DeliveringTable").DataTable({
                                           order: [],
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
               @endif
           @endif
