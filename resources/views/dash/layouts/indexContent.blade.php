 @php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
 @endphp
 @php
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
 @endphp

 {{-- <div class="row">
        <div class="col-md-4 col-xl-3 mb-2">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Earnings (monthly)</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>$40,000</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Earnings (annual)</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>$215,000</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Tasks</span></div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>50%</span></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
 @if (Auth::user()->type == 2)
     <div class="m-4">
         <button class="btn btn-primary  " id="request">Demande un livreur</button>
         <script>
             $("#request").on("click", (e) => {
                 e.preventDefault()
                 axios.post("/request/add")
                     .then(res => {
                         console.log(res)
                         toastr.success("Demande bien envoyée")
                     })
                     .catch(err => {
                         toastr.error(err.response.data.message)

                         console.error(err);
                     })
             })
         </script>
     </div>
     <div class="row">
         <!-- column -->
         <div class="col-12" id="commandes">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
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
                                     <th class="border-top-0">Référence</th>
                                     <th class="border-top-0">Client</th>
                                     <th class="border-top-0">Produits</th>
                                     <th class="border-top-0">N° Client</th>
                                     <th class="border-top-0">Date de passation</th>
                                     <th class="border-top-0">Statut</th>
                                     <th class="border-top-0">Total</th>
                                     <th class="border-top-0">Livreur</th>
                                     <th class="border-top-0">Actions</th>
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
                                     
                                 @endphp
                                 @forelse (Auth::user()->commandesReceived as $cmd)
                                     @if (!$cmd->is_message)
                                         @php
                                             $total = 0;
                                         @endphp
                                         <tr>
                                             <td>
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
                                             <td>


                                                 @foreach ($cmd->items as $passed)
                                                     @php
                                                         $total += $passed->total;
                                                     @endphp
                                                     <div class="accordion accordion-flush"style="max-width: 200px !important;word-wrap: break-word"
                                                         id="accordionExample{{ $passed->id }}">
                                                         <div class="accordion-item">
                                                             <h2 class="accordion-header" id="pr{{ $passed->id }}">
                                                                 <button class="accordion-button collapsed"
                                                                     type="button" data-bs-toggle="collapse"
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
                                             <td><a href="tel:{{ $cmd->user->phone }}">{{ $cmd->user->phone }}</a>
                                             </td>
                                             <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>
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
                                             <td>{{ $total + Auth::user()->deliveryPrice }} Dt</td>
                                             <td>{{ $cmd->deliverer_id == null ? '' : $cmd->deliverer->name }}</td>
                                             <td>
                                                 @if ($cmd->statut != 5)
                                                     @switch($cmd->statut)
                                                         @case(1)
                                                             <a href="#!" id="startCmd{{ $cmd->id }}"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-play"></i></a>
                                                             <script>
                                                                 $("#startCmd{{ $cmd->id }}").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     let arr = []

                                                                     axios.post("/commande/statut", {
                                                                             "_token": "{{ csrf_token() }}",
                                                                             user_id: "{{ $cmd->user_id }}",
                                                                             resto_id: "{{ $cmd->resto_id }}",
                                                                             statut: 2
                                                                         })
                                                                         .then(res => {
                                                                             console.log(res)
                                                                             toastr.success("Commande confirmée")
                                                                             LoadContentMain()

                                                                         })
                                                                         .catch(err => {
                                                                             console.error(err);
                                                                             toastr.error("Quelque chose s'est mal passé")

                                                                         })
                                                                 })
                                                             </script>
                                                         @break

                                                         @case(2)
                                                             <a href="#!" id="completeCmd{{ $cmd->id }}"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-check"></i></a>
                                                             <script>
                                                                 $("#completeCmd{{ $cmd->id }}").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     axios.post("/commande/statut", {
                                                                             "_token": "{{ csrf_token() }}",
                                                                             user_id: "{{ $cmd->user_id }}",
                                                                             resto_id: "{{ $cmd->resto_id }}",
                                                                             statut: 3
                                                                         })
                                                                         .then(res => {
                                                                             console.log(res)
                                                                             toastr.info("Commande terminée")
                                                                             LoadContentMain()

                                                                         })
                                                                         .catch(err => {
                                                                             console.error(err);
                                                                             toastr.error("Quelque chose s'est mal passé")

                                                                         })
                                                                 })
                                                             </script>
                                                         @break

                                                         @default
                                                     @endswitch


                                                     <a href="#!" id="deleteCmd{{ $cmd->id }}"
                                                         class="btn shadow-none text-danger"><i
                                                             class="fas fa-trash"></i></a>
                                                 @else
                                                     -
                                                 @endif
                                             </td>
                                         </tr>

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
             <div class="col-12" id="commandes">
                 <div class="card">
                     <div class="card-body">
                         <!-- title -->
                         <div class="d-md-flex">
                             <div>
                                 <h4 class="card-title">Liste des commandes par message</h4>
                                 {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                             </div>

                         </div>
                         <!-- title -->
                         <div class="table-responsive">
                             <table class="table mb-0 table-hover align-middle " id="ordersRestoMessage">
                                 <thead>
                                     <tr>
                                         <th class="border-top-0">Référence</th>
                                         <th class="border-top-0">Client</th>
                                         <th class="border-top-0">Message</th>
                                         <th class="border-top-0">N° Client</th>
                                         <th class="border-top-0">Date de passation</th>
                                         <th class="border-top-0">Statut</th>
                                         <th class="border-top-0">Livreur</th>
                                         <th class="border-top-0">Actions</th>
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
                                         
                                     @endphp
                                     @forelse (Auth::user()->commandesReceived as $cmd)
                                         @if ($cmd->is_message)
                                             @php
                                                 $total = 0;
                                             @endphp
                                             <tr>
                                                 <td>
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
                                                 <td>


                                                     {{ $cmd->messages[0]->message }}
                                                 </td>
                                                 <td><a href="tel:{{ $cmd->user->phone }}">{{ $cmd->user->phone }}</a>
                                                 </td>
                                                 <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>
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
                                                 <td>{{ $cmd->deliverer_id == null ? '' : $cmd->deliverer->name }}</td>
                                                 <td>
                                                     @if ($cmd->statut != 5)
                                                         @switch($cmd->statut)
                                                             @case(1)
                                                                 <a href="#!" id="startCmd{{ $cmd->id }}"
                                                                     class="btn shadow-none text-success"><i
                                                                         class="fas fa-play"></i></a>
                                                                 <script>
                                                                     $("#startCmd{{ $cmd->id }}").on("click", (e) => {
                                                                         e.preventDefault()
                                                                         let arr = []

                                                                         axios.post("/commande/statut", {
                                                                                 "_token": "{{ csrf_token() }}",
                                                                                 user_id: "{{ $cmd->user_id }}",
                                                                                 resto_id: "{{ $cmd->resto_id }}",
                                                                                 statut: 2
                                                                             })
                                                                             .then(res => {
                                                                                 console.log(res)
                                                                                 toastr.success("Commande confirmée")
                                                                                 LoadContentMain()

                                                                             })
                                                                             .catch(err => {
                                                                                 console.error(err);
                                                                                 toastr.error("Quelque chose s'est mal passé")

                                                                             })
                                                                     })
                                                                 </script>
                                                             @break

                                                             @case(2)
                                                                 <a href="#!" id="completeCmd{{ $cmd->id }}"
                                                                     class="btn shadow-none text-success"><i
                                                                         class="fas fa-check"></i></a>
                                                                 <script>
                                                                     $("#completeCmd{{ $cmd->id }}").on("click", (e) => {
                                                                         e.preventDefault()
                                                                         axios.post("/commande/statut", {
                                                                                 "_token": "{{ csrf_token() }}",
                                                                                 user_id: "{{ $cmd->user_id }}",
                                                                                 resto_id: "{{ $cmd->resto_id }}",
                                                                                 statut: 3
                                                                             })
                                                                             .then(res => {
                                                                                 console.log(res)
                                                                                 toastr.info("Commande terminée")
                                                                                 LoadContentMain()

                                                                             })
                                                                             .catch(err => {
                                                                                 console.error(err);
                                                                                 toastr.error("Quelque chose s'est mal passé")

                                                                             })
                                                                     })
                                                                 </script>
                                                             @break

                                                             @default
                                                         @endswitch


                                                         <a href="#!" id="deleteCmd{{ $cmd->id }}"
                                                             class="btn shadow-none text-danger"><i
                                                                 class="fas fa-trash"></i></a>
                                                     @else
                                                         -
                                                     @endif
                                                 </td>
                                             </tr>

                                             @php
                                                 $total = 0;
                                             @endphp
                                         @endif

                                         @empty
                                         @endforelse



                                     </tbody>
                                 </table>
                                 <script>
                                     $("#ordersRestoMessage").DataTable({
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
                 <div class="col-12" id="demandes">
                     <div class="card">
                         <div class="card-body">
                             <!-- title -->
                             <div class="d-md-flex">
                                 <div>
                                     <h4 class="card-title"> Mes demandes de livreurs</h4>
                                     {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                                 </div>

                             </div>
                             <!-- title -->
                             <div class="table-responsive">
                                 <table class="table mb-0 table-hover align-middle text-nowrap" id="requestDel">
                                     <thead>
                                         <tr>
                                             <th class="border-top-0">Date</th>
                                             <th class="border-top-0">Statut</th>
                                             <th class="border-top-0">Livreur</th>
                                             <th class="border-top-0">N° livreur</th>
                                             <th class="border-top-0">Actions</th>
                                         </tr>
                                     </thead>

                                     <tbody>
                                         @php
                                             
                                             $requests = RequestResto::where('resto_id', Auth::user()->user_id)->get();
                                             
                                         @endphp
                                         @forelse ($requests as $cmd)
                                             <tr>
                                                 <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>


                                                 <td>
                                                     @switch($cmd->statut)
                                                         @case(1)
                                                             <label class="badge bg-warning">En attente</label>
                                                         @break

                                                         @case(2)
                                                             <label class="badge bg-success">Acceptée</label>
                                                         @break

                                                         @case(3)
                                                             <label class="badge bg-danger">Annulée</label>
                                                         @break

                                                         @default
                                                     @endswitch
                                                 </td>
                                                 <td>
                                                     @if ($cmd->deliverer_id == null)
                                                         -
                                                     @else
                                                         {{ $cmd->deliverer->name }}
                                                     @endif
                                                 </td>
                                                 <td>
                                                     @if ($cmd->deliverer_id == null)
                                                         -
                                                     @else
                                                         {{ $cmd->deliverer->phone }}
                                                     @endif
                                                 </td>

                                                 <td>
                                                     <a href="#!" id="cancelreq{{ $cmd->id }}"
                                                         class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                                                     <script>
                                                         $("#cancelreq{{ $cmd->id }}").on("click", (e) => {
                                                             e.preventDefault()
                                                             alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette demande  ?", () => {
                                                                 axios.post("/request/cancel", {
                                                                         "_token": "{{ csrf_token() }}",
                                                                         resto_id: "{{ $cmd->resto_id }}",
                                                                         req_id: "{{ $cmd->id }}",
                                                                     })
                                                                     .then(res => {
                                                                         console.log(res)
                                                                         toastr.info(res.data.message)
                                                                         LoadContentMain()

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

             @endif
             @if (Auth::user()->type == 3)
                 <div class="row">
                     <!-- column -->
                     <div class="col-12" id="commandes">
                         <div class="card">
                             <div class="card-body">
                                 <!-- title -->
                                 <div class="d-md-flex">
                                     <div>
                                         <h4 class="card-title"> Liste des commandes</h4>
                                         {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                                     </div>

                                 </div>
                                 <!-- title -->
                                 <div class="table-responsive">
                                     <table class="table mb-0 table-hover align-middle text-nowrap" id="ordersResto">
                                         <thead>
                                             <tr>
                                                 <th class="border-top-0">Référence</th>
                                                 <th class="border-top-0">Restaurant</th>
                                                 <th class="border-top-0">Client</th>
                                                 <th class="border-top-0">Produits</th>
                                                 <th class="border-top-0">Date de passation</th>
                                                 <th class="border-top-0">Statut</th>
                                                 <th class="border-top-0">Total</th>
                                                 <th class="border-top-0">Actions</th>
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
                                                     ->with('commandesReceived')
                                                     ->get();
                                                 $commandes = commande_ref::where('statut', '!=', 6)
                                                     ->where('statut', '!=', 5)
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
                                                         <td>
                                                             <strong>#{{ $cmd->reference }} </strong>

                                                         </td>
                                                         <td>
                                                             <div class="d-flex align-items-center">
                                                                 <div class="m-r-10"><a
                                                                         class="btn btn-circle d-flex btn-info text-white">
                                                                         <img src="{{ asset('uploads/logos/' . $cmd->resto->avatar) }}"
                                                                             alt="" class="img-fluid " width="80px">
                                                                     </a>
                                                                 </div>
                                                                 <div class="">
                                                                     <h4 class="m-b-0 font-16">{{ $cmd->resto->name }}</h4>
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
                                                                 </div>
                                                             </div>
                                                         </td>

                                                         <td><a href="tel:{{ $cmd->resto->phone }}">{{ $cmd->user->phone }}</a>
                                                         </td>
                                                         <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>
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
                                                         <td>{{ $total + $cmd->resto->deliveryPrice }} Dt</td>
                                                         <td>
                                                             @if (!Auth::user()->onDuty)
                                                                 Vous êtes hors service
                                                             @else
                                                                 @if (!$cmd->taken)
                                                                     <a href="#!" id="startCmd{{ $cmd->id }}"
                                                                         class="btn shadow-none text-success"><i
                                                                             class="fas fa-play"></i></a>
                                                                     <script>
                                                                         $("#startCmd{{ $cmd->id }}").on("click", (e) => {
                                                                             e.preventDefault()
                                                                             let arr = []

                                                                             axios.post("/commande/statut", {
                                                                                     "_token": "{{ csrf_token() }}",
                                                                                     req_id: "{{ $cmd->id }}",
                                                                                     user_id: "{{ $cmd->user_id }}",
                                                                                     resto_id: "{{ $cmd->resto_id }}",
                                                                                     statut: 4
                                                                                 })
                                                                                 .then(res => {
                                                                                     console.log(res)
                                                                                     toastr.info("Commande acceptée")
                                                                                     LoadContentMain()

                                                                                 })
                                                                                 .catch(err => {
                                                                                     console.error(err);
                                                                                     toastr.error("Quelque chose s'est mal passé")

                                                                                 })
                                                                         })
                                                                     </script>
                                                                 @else
                                                                     @if ($cmd->taken && $cmd->deliverer_id == Auth::user()->user_id)
                                                                         @if ($cmd->statut == 4)
                                                                             <a href="#!"
                                                                                 id="completeCmd{{ $cmd->id }}"
                                                                                 class="btn shadow-none text-success"><i
                                                                                     class="fas fa-check"></i></a>
                                                                             <script>
                                                                                 $("#completeCmd{{ $cmd->id }}").on("click", (e) => {
                                                                                     e.preventDefault()
                                                                                     axios.post("/commande/statut", {
                                                                                             "_token": "{{ csrf_token() }}",
                                                                                             user_id: "{{ $cmd->user_id }}",
                                                                                             resto_id: "{{ $cmd->resto_id }}",
                                                                                             statut: 5
                                                                                         })
                                                                                         .then(res => {
                                                                                             console.log(res)
                                                                                             toastr.success("Commande delivrée avec succées")
                                                                                             LoadContentMain()

                                                                                         })
                                                                                         .catch(err => {
                                                                                             console.error(err);
                                                                                             toastr.error("Quelque chose s'est mal passé")

                                                                                         })
                                                                                 })
                                                                             </script>
                                                                         @endif



                                                                         <a href="#!" id="cancelCmd{{ $cmd->id }}"
                                                                             class="btn shadow-none text-danger"><i
                                                                                 class="fas fa-times"></i></a>
                                                                         <script>
                                                                             $("#cancelCmd{{ $cmd->id }}").on("click", (e) => {
                                                                                 e.preventDefault()
                                                                                 alertify.confirm("Confirmation", "Ae you sure that you want to cancel your delivery  ?", () => {
                                                                                     axios.post("/commande/statut", {
                                                                                             "_token": "{{ csrf_token() }}",
                                                                                             user_id: "{{ $cmd->user_id }}",
                                                                                             resto_id: "{{ $cmd->resto_id }}",
                                                                                             statut: 6
                                                                                         })
                                                                                         .then(res => {
                                                                                             console.log(res)
                                                                                             toastr.info("La livraison du commande est annulée")
                                                                                             LoadContentMain()

                                                                                         })
                                                                                         .catch(err => {
                                                                                             console.error(err);
                                                                                             toastr.error("Quelque chose s'est mal passé")

                                                                                         })

                                                                                 }, () => {})
                                                                             })
                                                                         </script>
                                                                     @else
                                                                         -
                                                                     @endif
                                                                 @endif
                                                             @endif
                                                         </td>
                                                     </tr>
                                                     @php
                                                         $total = 0;
                                                     @endphp
                                                     @empty
                                                     @endforelse



                                             </tbody>
                                         </table>
                                         <script>
                                             $("#ordersResto").DataTable({
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
                         <div class="col-12" id="demandes">
                             <div class="card">
                                 <div class="card-body">
                                     <!-- title -->
                                     <div class="d-md-flex">
                                         <div>
                                             <h4 class="card-title"> Liste des demandes</h4>
                                             {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                                         </div>

                                     </div>
                                     <!-- title -->
                                     <div class="table-responsive">
                                         <table class="table mb-0 table-hover align-middle text-nowrap" id="requestDel">
                                             <thead>
                                                 <tr>
                                                     <th class="border-top-0">Restaurant</th>
                                                     <th class="border-top-0">N° Restaurant</th>
                                                     <th class="border-top-0">Statut</th>
                                                     <th class="border-top-0">Date de demande</th>
                                                     <th class="border-top-0">Actions</th>
                                                 </tr>
                                             </thead>

                                             <tbody>
                                                 @php
                                                     
                                                     $requests = RequestResto::get();
                                                     
                                                 @endphp
                                                 @forelse ($requests as $cmd)
                                                     <tr>
                                                         <td>
                                                             <div class="d-flex align-items-center">
                                                                 <div class="m-r-10"><a
                                                                         class="btn btn-circle d-flex btn-info text-white">
                                                                         <img src="{{ asset('uploads/logos/' . $cmd->resto->avatar) }}"
                                                                             alt="" class="img-fluid " width="80px">
                                                                     </a>
                                                                 </div>
                                                                 <div class="">
                                                                     <h4 class="m-b-0 font-16">{{ $cmd->resto->name }}</h4>
                                                                 </div>
                                                             </div>
                                                         </td>
                                                         <td>
                                                             {{ $cmd->resto->phone }}
                                                         </td>
                                                         <td>
                                                             @switch($cmd->statut)
                                                                 @case(1)
                                                                     <label class="badge bg-warning">En attente</label>
                                                                 @break

                                                                 @case(2)
                                                                     <label class="badge bg-success">Acceptée</label>
                                                                 @break

                                                                 @case(3)
                                                                     <label class="badge bg-danger">Annulée</label>
                                                                 @break

                                                                 @default
                                                             @endswitch
                                                         </td>
                                                         <td>{{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td>

                                                         <td>
                                                             @if (!Auth::user()->onDuty)
                                                                 Vous êtes hors service
                                                             @else
                                                                 @if ($cmd->deliverer_id == null)
                                                                     <a href="#!" id="acceptReq{{ $cmd->id }}"
                                                                         class="btn shadow-none text-success"><i
                                                                             class="fas fa-play"></i></a>
                                                                     <script>
                                                                         $("#acceptReq{{ $cmd->id }}").on("click", (e) => {
                                                                             e.preventDefault()

                                                                             axios.post("/request/accept", {
                                                                                     "_token": "{{ csrf_token() }}",
                                                                                     resto_id: "{{ $cmd->resto_id }}",
                                                                                     req_id: "{{ $cmd->id }}",
                                                                                 })
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
                                                                 @else
                                                                     @if ($cmd->statut == 2 && $cmd->deliverer_id == Auth::user()->user_id)
                                                                         <a href="#!" id="cancelreq{{ $cmd->id }}"
                                                                             class="btn shadow-none text-danger"><i
                                                                                 class="fas fa-times"></i></a>
                                                                         <script>
                                                                             $("#cancelreq{{ $cmd->id }}").on("click", (e) => {
                                                                                 e.preventDefault()
                                                                                 alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette demande  ?", () => {
                                                                                     axios.post("/request/cancel", {
                                                                                             "_token": "{{ csrf_token() }}",
                                                                                             resto_id: "{{ $cmd->resto_id }}",
                                                                                             req_id: "{{ $cmd->id }}",
                                                                                         })
                                                                                         .then(res => {
                                                                                             console.log(res)
                                                                                             toastr.info(res.data.message)
                                                                                             LoadContentMain()

                                                                                         })
                                                                                         .catch(err => {
                                                                                             console.error(err);
                                                                                             toastr.error("Quelque chose s'est mal passé")

                                                                                         })

                                                                                 }, () => {})
                                                                             })
                                                                         </script>
                                                                     @else
                                                                         -
                                                                     @endif
                                                                 @endif
                                                             @endif
                                                         </td>
                                                     </tr>

                                                     @empty
                                                     @endforelse



                                                 </tbody>
                                             </table>
                                             <script>
                                                 $("#requestDel").DataTable({
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
                     @endif
                     <div class="row">
                         <div class="col-lg-8">
                             <div class="card">
                                 <div class="card-body">
                                     <div class="d-md-flex align-items-center">
                                         <div>
                                             <h4 class="card-title">Sales Summary</h4>
                                             <h6 class="card-subtitle">Ample admin Vs Pixel admin</h6>
                                         </div>
                                         <div class="ms-auto d-flex no-block align-items-center">
                                             <ul class="list-inline dl d-flex align-items-center m-r-15 m-b-0">
                                                 <li class="list-inline-item d-flex align-items-center text-info"><i
                                                         class="fa fa-circle font-10 me-1"></i> Ample
                                                 </li>
                                                 <li class="list-inline-item d-flex align-items-center text-primary"><i
                                                         class="fa fa-circle font-10 me-1"></i> Pixel
                                                 </li>
                                             </ul>
                                         </div>
                                     </div>
                                     <div class="amp-pxl mt-4" style="height: 350px;">
                                         <div class="chartist-tooltip"></div>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="col-lg-4">
                             <div class="card">
                                 <div class="card-body">
                                     <h4 class="card-title">Weekly Stats</h4>
                                     <h6 class="card-subtitle">Average sales</h6>
                                     <div class="mt-5 pb-3 d-flex align-items-center">
                                         <span class="btn btn-primary btn-circle d-flex align-items-center">
                                             <i class="mdi mdi-cart-outline fs-4"></i>
                                         </span>
                                         <div class="ms-3">
                                             <h5 class="mb-0 fw-bold">Top Sales</h5>
                                             <span class="text-muted fs-6">Johnathan Doe</span>
                                         </div>
                                         <div class="ms-auto">
                                             <span class="badge bg-light text-muted">+68%</span>
                                         </div>
                                     </div>
                                     <div class="py-3 d-flex align-items-center">
                                         <span class="btn btn-warning btn-circle d-flex align-items-center">
                                             <i class="mdi mdi-star-circle fs-4"></i>
                                         </span>
                                         <div class="ms-3">
                                             <h5 class="mb-0 fw-bold">Best Seller</h5>
                                             <span class="text-muted fs-6">MaterialPro Admin</span>
                                         </div>
                                         <div class="ms-auto">
                                             <span class="badge bg-light text-muted">+68%</span>
                                         </div>
                                     </div>
                                     <div class="py-3 d-flex align-items-center">
                                         <span class="btn btn-success btn-circle d-flex align-items-center">
                                             <i class="mdi mdi-comment-multiple-outline text-white fs-4"></i>
                                         </span>
                                         <div class="ms-3">
                                             <h5 class="mb-0 fw-bold">Most Commented</h5>
                                             <span class="text-muted fs-6">Ample Admin</span>
                                         </div>
                                         <div class="ms-auto">
                                             <span class="badge bg-light text-muted">+68%</span>
                                         </div>
                                     </div>
                                     <div class="py-3 d-flex align-items-center">
                                         <span class="btn btn-info btn-circle d-flex align-items-center">
                                             <i class="mdi mdi-diamond fs-4 text-white"></i>
                                         </span>
                                         <div class="ms-3">
                                             <h5 class="mb-0 fw-bold">Top Budgets</h5>
                                             <span class="text-muted fs-6">Sunil Joshi</span>
                                         </div>
                                         <div class="ms-auto">
                                             <span class="badge bg-light text-muted">+15%</span>
                                         </div>
                                     </div>

                                     <div class="pt-3 d-flex align-items-center">
                                         <span class="btn btn-danger btn-circle d-flex align-items-center">
                                             <i class="mdi mdi-content-duplicate fs-4 text-white"></i>
                                         </span>
                                         <div class="ms-3">
                                             <h5 class="mb-0 fw-bold">Best Designer</h5>
                                             <span class="text-muted fs-6">Nirav Joshi</span>
                                         </div>
                                         <div class="ms-auto">
                                             <span class="badge bg-light text-muted">+90%</span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
