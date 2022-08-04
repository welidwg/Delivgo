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
     use App\Models\Demande;
 @endphp
 @if (Auth::user()->type == 4)
     <div class="row">
         <div class="col-md-6" id="demandes" style="zoom: 0.8">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Demandes de partenariat </h4>
                             {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                         </div>

                     </div>
                     <!-- title -->
                     <div class="table-responsive">
                         <table class="table mb-0 table-hover align-middle text-nowrap" id="partn">
                             <thead>
                                 <tr>
                                     <th class="border-top-0">Nom d'entreprise</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">N° Téléphone</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">Email</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">Actions</th>
                                     <th class="border-top-0 d-lg-none">Détails</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 @php
                                     
                                     $requests = Demande::where('type', 2)->get();
                                     
                                 @endphp
                                 @forelse ($requests as $demande)
                                     <tr>
                                         <td>
                                             {{ $demande->name }}
                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             {{ $demande->phone }}
                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             {{ $demande->email }}
                                         </td>





                                         <td class="d-none d-lg-table-cell">

                                             <a href="#!" id="cancelreq{{ $demande->id }}"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#cancelreq{{ $demande->id }}").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande  ?", () => {
                                                         axios.post("/demande/delete/{{ $demande->id }}", {
                                                                 "_token": "{{ csrf_token() }}",
                                                                 id: "{{ $demande->id }}"


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
                                         <td class="d-lg-none">
                                             <a href="#!" id="" data-bs-toggle="modal"
                                                 data-bs-target="#DetailsModal{{ $demande->id }}"
                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal{{ $demande->id }}"
                                         aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered" role="document">
                                             <div class="modal-content rounded-0">
                                                 <div class="modal-body p-4 px-0 ">


                                                     <div class="main-content text-center mb-3 py-auto">

                                                         <a href="#" style="" class="close-btn"
                                                             id="closeModalConfirm" data-bs-toggle="Close">
                                                             <span aria-hidden="true"><span
                                                                     class="fal fa-times"></span></span>
                                                         </a>
                                                         <h6 class="text-center">Nom :
                                                             <strong>{{ $demande->name }}</strong>
                                                         </h6>
                                                         <div
                                                             class="row flex-column justify-content-start align-items-center">
                                                             <div class="col mb">
                                                                 <label class="">N° Téléphone:</label>
                                                                 <strong>
                                                                     <a href="tel:{{ $demande->phone }}">
                                                                         {{ $demande->phone }}
                                                                     </a>

                                                                 </strong>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Email: <strong>
                                                                         <a href="mailto:{{ $demande->email }}">
                                                                             {{ $demande->email }}

                                                                         </a>

                                                                     </strong></span>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Date : <strong id="dateTel{{ $demande->id }}">


                                                                     </strong></span>
                                                                 <script>
                                                                     $('#dateTel{{ $demande->id }}').html(moment("{{ $demande->created_at }}").format('LL | LT'))
                                                                 </script>


                                                             </div>



                                                             <a class="btn btn-danger w-75"
                                                                 id="canceldemande{{ $demande->id }}">Supprimer</a>
                                                             <script>
                                                                 $("#canceldemande{{ $demande->id }}").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande ?", () => {
                                                                         axios.post("/demande/delete/{{ $demande->id }}", {
                                                                                 "_token": "{{ csrf_token() }}",
                                                                                 id: "{{ $demande->id }}"
                                                                             })
                                                                             .then(res => {
                                                                                 console.log(res)
                                                                                 toastr.info("Demande supprimée")
                                                                             })
                                                                             .catch(err => {
                                                                                 console.error(err);
                                                                                 toastr.error("Erreur inconnue,réssayez plus tard")

                                                                             })

                                                                     }, () => {})
                                                                 })
                                                             </script>


                                                         </div>



                                                     </div>

                                                 </div>
                                             </div>

                                         </div>
                                     </div>
                                 @empty
                                 @endforelse



                             </tbody>
                         </table>
                         <script>
                             $("#partn").DataTable({
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

         <div class="col-md-6" id="demandes" style="zoom: 0.8">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Demandes des livreurs </h4>
                             {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                         </div>

                     </div>
                     <!-- title -->
                     <div class="table-responsive">
                         <table class="table mb-0 table-hover align-middle text-nowrap" id="deliv">
                             <thead>
                                 <tr>
                                     <th class="border-top-0">Nom </th>
                                     <th class="border-top-0 d-none d-lg-table-cell">N° Téléphone</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">Email</th>

                                     <th class="border-top-0 d-none d-lg-table-cell">Actions</th>
                                     <th class="border-top-0 d-lg-none">Détails</th>

                                 </tr>
                             </thead>

                             <tbody>
                                 @php
                                     
                                     $requests = Demande::where('type', 3)->get();
                                     
                                 @endphp
                                 @forelse ($requests as $demande)
                                     <tr>
                                         <td>
                                             {{ $demande->name }}
                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             {{ $demande->phone }}
                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             {{ $demande->email }}
                                         </td>




                                         <td class="d-none d-lg-table-cell">

                                             <a href="#!" id="cancelreqDeliv{{ $demande->id }}"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#cancelreqDeliv{{ $demande->id }}").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande  ?", () => {
                                                         axios.post("/demande/delete/{{ $demande->id }}", {
                                                                 "_token": "{{ csrf_token() }}",
                                                                 id: "{{ $demande->id }}"


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
                                         <td class="d-lg-none">
                                             <a href="#!" data-bs-target="#DetailsModal{{ $demande->id }}"
                                                 data-bs-toggle="modal" class="btn shadow-none text-danger"><i
                                                     class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal{{ $demande->id }}"
                                         aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered" role="document">
                                             <div class="modal-content rounded-0">
                                                 <div class="modal-body p-4 px-0 ">


                                                     <div class="main-content text-center mb-3 py-auto">

                                                         <a href="#" style="" class="close-btn"
                                                             id="closeModalConfirm" data-bs-toggle="Close">
                                                             <span aria-hidden="true"><span
                                                                     class="fal fa-times"></span></span>
                                                         </a>
                                                         <h6 class="text-center">Nom :
                                                             <strong>{{ $demande->name }}</strong>
                                                         </h6>
                                                         <div
                                                             class="row flex-column justify-content-start align-items-center">
                                                             <div class="col mb">
                                                                 <label class="">N° Téléphone:</label>
                                                                 <strong>
                                                                     <a href="tel:{{ $demande->phone }}">
                                                                         {{ $demande->phone }}
                                                                     </a>

                                                                 </strong>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Email: <strong>
                                                                         <a href="mailto:{{ $demande->email }}">
                                                                             {{ $demande->email }}

                                                                         </a>

                                                                     </strong></span>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Date : <strong id="dateTel{{ $demande->id }}">


                                                                     </strong></span>
                                                                 <script>
                                                                     $('#dateTel{{ $demande->id }}').html(moment("{{ $demande->created_at }}").format('LL | LT'))
                                                                 </script>


                                                             </div>



                                                             <a class="btn btn-danger w-75"
                                                                 id="canceldemande{{ $demande->id }}">Supprimer</a>
                                                             <script>
                                                                 $("#canceldemande{{ $demande->id }}").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande ?", () => {
                                                                         axios.post("/demande/delete/{{ $demande->id }}", {
                                                                                 "_token": "{{ csrf_token() }}",
                                                                                 id: "{{ $demande->id }}"
                                                                             })
                                                                             .then(res => {
                                                                                 console.log(res)
                                                                                 toastr.info("Demande supprimée")
                                                                             })
                                                                             .catch(err => {
                                                                                 console.error(err);
                                                                                 toastr.error("Erreur inconnue,réssayez plus tard")

                                                                             })

                                                                     }, () => {})
                                                                 })
                                                             </script>


                                                         </div>



                                                     </div>

                                                 </div>
                                             </div>

                                         </div>
                                     </div>

                                 @empty
                                 @endforelse



                             </tbody>
                         </table>
                         <script>
                             $("#deliv").DataTable({
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
         <div class="col-12 mb-3" id="commandes">
             <div class="card ">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex p-0">
                         <div>
                             <h4 class="card-title">Liste des commandes non terminée</h4>
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
                                     <th class="border-top-0 ">Statut</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">Total</th>
                                     <th class="border-top-0 d-none d-lg-table-cell">Livreur</th>
                                     <th class="border-top-0 ">Actions</th>
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
                                         ->where('statut', '!=', 5)
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
                                                                 <button class="accordion-button collapsed"
                                                                     type="button" data-bs-toggle="collapse"
                                                                     data-bs-target="#product{{ $passed->id }}"
                                                                     aria-expanded="true" aria-controls="collapseOne">
                                                                     {{ $passed->product->label }}
                                                                     ({{ $passed->quantity }})
                                                                 </button>
                                                             </h2>
                                                             <div id="product{{ $passed->id }}"
                                                                 class="accordion-collapse collapse "
                                                                 aria-labelledby=""
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
                                             <script>
                                                 $('#datepass{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
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
                                                 {{ $total + Auth::user()->deliveryPrice }} Dt</td>
                                             <td class="d-none d-lg-table-cell">
                                                 {{ $cmd->deliverer_id == null ? '' : $cmd->deliverer->name }}</td>
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
                                                                             ref: "{{ $cmd->reference }}",
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
                                                                             ref: "{{ $cmd->reference }}",

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
                                             <td>
                                                 <a href="#!" id="details{{ $cmd->id }}"
                                                     class="btn shadow-none text-danger"><i
                                                         class="fas fa-eye"></i></a>
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
             <div class="col-12 mb-3" id="commandes">
                 <div class="card ">
                     <div class="card-body">
                         <!-- title -->
                         <div class="d-md-flex">
                             <div>
                                 <h4 class="card-title">Liste des commandes par message non terminée </h4>
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
                                         $cmdsMsg = commande_ref::where('resto_id', Auth::user()->user_id)
                                             ->where('statut', '!=', 5)
                                             ->where('is_message', 1)
                                             ->with('items')
                                             ->orderBy('statut', 'asc')
                                             ->get();
                                         
                                     @endphp
                                     @forelse ($cmdsMsg as $cmd)
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
                                                 <td id="Demandedatepass{{ $cmd->id }}"></td>
                                                 <script>
                                                     $('#Demandedatepass{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
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
                                                                                 ref: "{{ $cmd->reference }}",

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
                                                                                 ref: "{{ $cmd->reference }}",

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
                                     <h4 class="card-title"> Vos demandes de livreurs</h4>
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
                                                 <td id="datePassDemande{{ $cmd->id }}"></td>
                                                 <script>
                                                     $('#datePassDemande{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
                                                 </script>

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
                                                                         ref: "{{ $cmd->reference }}",

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
                                                                     {{ $cmd->user->address == '' ? 'N\A' : $cmd->user->address }}
                                                                 </small>

                                                             </div>
                                                         </div>
                                                     </td>


                                                     <td id="datepass{{ $cmd->id }}">
                                                     </td>
                                                     <script>
                                                         $('#datepass{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format("LL | LT"))
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
                                                                                         ref: "{{ $cmd->reference }}",

                                                                                         statut: 5
                                                                                     })
                                                                                     .then(res => {
                                                                                         console.log(res)
                                                                                         toastr.success("Commande livrée avec succées")
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
                                                                                         ref: "{{ $cmd->reference }}",

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
                                                                                     ref: "{{ $cmd->reference }}",

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
                                                                                             ref: "{{ $cmd->reference }}",

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
                     <script>
                         $(".modal").appendTo('body')
                     </script>
