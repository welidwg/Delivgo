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
 @php
     
     $cmds = commande_ref::where('user_id', Auth::user()->user_id)
         ->with('user')
         ->with('messages')
         ->with('resto')
         ->orderBy('statut', 'asc')
         ->get();
     $total = 0;
     
 @endphp
 <div class="table-responsive shadow p-1 text-nowrap " style="border-radius: 12px;">
     <table class="table mb-0 table-hover mx-auto align-middle  py-3 px-3 " id="orders">
         <thead>
             <tr>
                 <th class="border-top-0">Référence</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Restaurant</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Produits/Message</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Date de passation</th>
                 <th class="border-top-0 ">Statut</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Livreur</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Total</th>
                 <th class="border-top-0 d-none d-lg-table-cell">Annuler</th>
                 <th class="border-top-0  d-lg-none">Détails</th>
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

             <script>
                 let ids = [];
             </script>
             @forelse ($cmds as $cmd)
                 <tr>
                     <td><strong>#{{ $cmd->reference }}</strong></td>
                     <td class="d-none d-lg-table-cell">
                         <div class="d-flex align-items-center">
                             <div class="m-r-10"><a class="btn btn-circle d-flex btn-white text-white"
                                     href="/resto/{{ $cmd->resto->user_id }}">
                                     <img src="{{ asset('uploads/logos/' . $cmd->resto->avatar) }}" alt=""
                                         class="img-fluid rounded" width="80px">
                                 </a>
                             </div>
                             <div class="">
                                 <h4 class="m-b-0  fs-5 fw-bold">{{ $cmd->resto->name }}

                                 </h4>

                                 <small>Tel:{{ $cmd->resto->phone }}</small>
                             </div>
                         </div>
                     </td>
                     <td class="d-none d-lg-table-cell text-wrap">
                         @php
                             // $commandes = Commande::where('id', $cmd->commande_id)
                             //     ->with('product')
                             //     ->get();
                             ${'total' . $cmd->id} = 0;
                         @endphp

                         @if ($cmd->is_message)
                             <p class="w-50">
                                 {{ $cmd->messages[0]->message }}</p>
                         @else
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
                                 <div class="accordion bg-transparent accordion-flush"style="background:transparent !important"
                                     id="accordionExample{{ $command->id }}">
                                     <div class="accordion-item bg-transparent">
                                         <h2 class="accordion-header" id="pr{{ $command->id }}">
                                             <button
                                                 class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2"
                                                 style="background: transparent !important" type="button"
                                                 data-bs-toggle="collapse" data-bs-target="#product{{ $command->id }}"
                                                 aria-expanded="true" aria-controls="collapseOne">
                                                 {{ $command->product->label }}
                                                 ({{ $command->quantity }})
                                             </button>
                                         </h2>
                                         <div id="product{{ $command->id }}" class="accordion-collapse collapse "
                                             aria-labelledby="" data-bs-parent="#accordionExample{{ $command->id }}"
                                             style="">
                                             <div class="accordion-body h-100">
                                                 <span class="text-muted fw-bold">Totale:
                                                 </span> {{ $command->total }} DT
                                                 <br>

                                                 @if ($command->garnitures != '')
                                                     <span class="text-muted fw-bold">Garnitures: </span>
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
                                                     <span class="text-muted fw-bold">Suppléments:
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
                                                     <span class="text-muted fw-bold">Boissons: </span>
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


                     </td>

                     <td class="d-none d-lg-table-cell" id="date_passed{{ $cmd->id }}">
                     </td>
                     <script>
                         $('#date_passed{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
                     </script>
                     <td class="">

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
                         @if ($cmd->taken)
                             <div class="d-flex align-items-center">
                                 <div class="m-r-10"><a class="btn btn-circle d-flex btn-white text-white">
                                         <img src="{{ asset('uploads/logos/' . $cmd->deliverer->avatar) }}"
                                             alt="" class="img-fluid rounded" width="80px">
                                     </a>
                                 </div>
                                 <div class="">
                                     <h4 class="m-b-0  fs-5 fw-bold">{{ $cmd->deliverer->name }}

                                     </h4>

                                     <small>Tel:{{ $cmd->deliverer->phone }}</small>
                                 </div>
                             </div>
                         @else
                             en attente de livreur
                         @endif

                     </td>
                     <td class="d-none d-lg-table-cell">
                         @if ($cmd->is_message)
                             Livraison : {{ $cmd->resto->deliveryPrice }} Dt
                         @else
                             {{ ${'total' . $cmd->id} + $cmd->resto->deliveryPrice }} Dt
                         @endif

                     </td>


                     <td class="d-none d-lg-table-cell">

                         @if ($cmd->statut == 1)
                             <a href="#!" id="cancelCmd{{ $cmd->id }}" class="btn shadow-none text-danger"><i
                                     class="fas fa-times"></i></a>
                         @else
                             Non annulable
                         @endif

                     </td>
                     <td class="d-lg-none">
                         <a href="#!" id="seeMore{{ $cmd->id }}"
                             data-bs-target="#DetailsModal{{ $cmd->id }}" data-bs-toggle="modal"
                             class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                     </td>
                 </tr>

                 <script>
                     $("#cancelCmd{{ $cmd->id }}").on("click", (e) => {
                         e.preventDefault()
                         alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette commande ?", () => {
                             axios.post("/commande/statut", {
                                     "_token": "{{ csrf_token() }}",
                                     user_id: "{{ $cmd->user_id }}",
                                     resto_id: "{{ $cmd->resto_id }}",
                                     ref: "{{ $cmd->reference }}",
                                     statut: 6
                                 })
                                 .then(res => {
                                     console.log(res)
                                     toastr.info("Votre commande est annulée")
                                 })
                                 .catch(err => {
                                     console.error(err);
                                     toastr.error("Erreur inconnue,réssayez plus tard")

                                 })

                         }, () => {})
                     })
                 </script>
                 <div class="modal fade" id="DetailsModal{{ $cmd->id }}" aria-labelledby="DetailsModal"
                     tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content rounded-0">
                             <div class="modal-body p-4 px-0 ">


                                 <div class="main-content text-center mb-3 py-auto">

                                     <a href="#" style="" class="close-btn" id="closeModalConfirm"
                                         data-bs-toggle="Close">
                                         <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                     </a>
                                     <h6 class="text-center">Référence : <strong>#{{ $cmd->reference }}</strong></h6>
                                     <div class="row flex-column justify-content-start align-items-center">
                                         <div class="col mb">
                                             <label class="">Restaurant:</label>
                                             <strong>
                                                 <a href="{{ url('/resto/' . $cmd->resto->user_id) }}">
                                                     {{ $cmd->resto->name }}

                                                 </a>

                                             </strong>



                                         </div>
                                         <div class="col mb-2">
                                             <span>N° Restaurant: <strong>
                                                     <a href="tel:+216{{ $cmd->resto->phone }}">
                                                         {{ $cmd->resto->phone }}

                                                     </a>

                                                 </strong></span>



                                         </div>
                                         <div class="col mb-2">
                                             <span>Date : <strong id="dateTel{{ $cmd->id }}">


                                                 </strong></span>
                                             <script>
                                                 $('#dateTel{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
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
                                             <span class="fw-bold">Produits/Message:</span>

                                             @if ($cmd->is_message)
                                                 <p class="text-center">
                                                     {{ $cmd->messages[0]->message }}</p>
                                             @else
                                                 @foreach ($cmd->items as $command)
                                                     <div class="accordion bg-transparent accordion-flush mx-auto"style="max-width: 200px !important;word-wrap: break-word;background:transparent !important"
                                                         id="accordionExample{{ $command->id }}">
                                                         <div class="accordion-item">
                                                             <h2 class="accordion-header" id="pr{{ $command->id }}">
                                                                 <button
                                                                     class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2 text-nowrap"
                                                                     style="background: transparent !important"
                                                                     type="button" data-bs-toggle="collapse"
                                                                     data-bs-target="#product{{ $command->id }}"
                                                                     aria-expanded="true" aria-controls="collapseOne">
                                                                     {{ $command->product->label }}
                                                                     ({{ $command->quantity }})
                                                                 </button>
                                                             </h2>
                                                             <div id="product{{ $command->id }}"
                                                                 class="accordion-collapse collapse "
                                                                 aria-labelledby=""
                                                                 data-bs-parent="#accordionExample{{ $command->id }}"
                                                                 style="max-width: 200px !important;word-wrap: break-word">
                                                                 <div class="accordion-body h-100">
                                                                     <span class="text-muted fw-bold">Totale:
                                                                     </span> {{ $command->total }} DT
                                                                     <br>

                                                                     @if ($command->garnitures != '')
                                                                         <span class="text-muted fw-bold">Garnitures:
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
                                                                         <span class="text-muted fw-bold">Suppléments:
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
                                                                             <span class="text-muted fw-bold">Sauces:
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
                                                                         <span class="text-muted fw-bold">Boissons:
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
                                                         Livraison : {{ $cmd->resto->deliveryPrice }} Dt
                                                     @else
                                                         {{ ${'total' . $cmd->id} + $cmd->resto->deliveryPrice }} Dt
                                                     @endif


                                                 </strong></span>



                                         </div>
                                         @if ($cmd->statut == 1)
                                             <a class="btn btn-danger w-75"
                                                 id="cancel{{ $cmd->id }}">Annuler</a>
                                             <script>
                                                 $("#cancel{{ $cmd->id }}").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette commande ?", () => {
                                                         axios.post("/commande/statut", {
                                                                 "_token": "{{ csrf_token() }}",
                                                                 user_id: "{{ $cmd->user_id }}",
                                                                 resto_id: "{{ $cmd->resto_id }}",
                                                                 ref: "{{ $cmd->reference }}",
                                                                 statut: 6
                                                             })
                                                             .then(res => {
                                                                 console.log(res)
                                                                 toastr.info("Votre commande est annulée")
                                                             })
                                                             .catch(err => {
                                                                 console.error(err);
                                                                 toastr.error("Erreur inconnue,réssayez plus tard")

                                                             })

                                                     }, () => {})
                                                 })
                                             </script>
                                         @else
                                             <span class="text-danger">Non annulable</span>
                                         @endif

                                     </div>



                                 </div>

                             </div>
                         </div>

                     </div>
                 </div>

                 <script>
                     $('#DetailsModal{{ $cmd->id }}').appendTo("body")
                 </script>
                 @empty
                 @endforelse




             </tbody>
         </table>

     </div>

     <script>
         $("#orders").DataTable({
             "order": [],
             "pageLength": 4,

             "language": {
                 "decimal": ".",
                 "emptyTable": "Vous n'avez pas aucune commande",
                 "info": "",
                 "infoFiltered": "",
                 "infoEmpty": "",
                 "lengthMenu": "",
             }
         })
     </script>
     {{-- <div class="table-responsive shadow p-0 d-block d-lg-none " style="border-radius: 12px;">
         <table class="table mb-0 table-hover align-middle  py-3 px-3 " id="ordersMobile">
             <thead>
                 <tr>
                     <th class="border-top-0">Référence</th>
                     <th class="border-top-0">Restaurant</th>
                     <th class="border-top-0">Statut</th>
                     <th class="border-top-0">Plus</th>

                 </tr>
                 @forelse ($cmds as $cmd)
                 @empty
                 @endforelse
             </thead>
         </table>
     </div> --}}
