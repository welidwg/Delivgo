 @php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
     use App\models\Region;
     use App\models\OtherCommande;
     
 @endphp
 @php
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
     use App\Models\Demande;
     use Nette\Utils\Random;
     use Carbon\Carbon;
     
 @endphp
 @if (Auth::user()->type == 4)
     <div class="row">
         <div class="col-md-6" id="demandes" style="zoom: 1">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Demandes de partenariat</h4>
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
                                         @php
                                             $hash = Random::generate(2, '0-9');
                                         @endphp
                                         <td class="d-lg-none">
                                             <a href="#!" id="" data-bs-toggle="modal"
                                                 data-bs-target="#DetailsModal{{ $demande->id + $hash }}"
                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal{{ $demande->id + $hash }}"
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

         <div class="col-md-6" id="demandes" style="zoom: 1">
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
                                                             id="closeModalConfirm" data-bs-dismiss="modal">
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
         <div class="col-md-6" id="listeregion" style="zoom: 1">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Régions/Ville supportées </h4>
                             {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                         </div>

                     </div>
                     <!-- title -->
                     <div class="table-responsive">
                         <table class="table mb-0 table-hover align-middle text-nowrap" id="reg">
                             <thead>
                                 <tr>
                                     <th class="border-top-0">Nom de ville/région</th>
                                     <th class="border-top-0">Frais de livraison</th>
                                     <th class="border-top-0 ">Actions</th>

                                 </tr>
                             </thead>

                             <tbody>
                                 @php
                                     
                                     $requests22 = Region::get();
                                     
                                 @endphp
                                 @forelse ($requests22 as $demande)
                                     <tr>
                                         <td>
                                             {{ $demande->label }}
                                         </td>
                                         <td class="">
                                             {{ $demande->deliveryPrice }}
                                         </td>
                                         <td class="">

                                             <a href="#!" id="editReg{{ $demande->id }}"
                                                 class="btn shadow-none text-primary" data-bs-toggle="modal"
                                                 data-bs-target="#EditRegModal{{ $demande->id }}"><i
                                                     class="fas fa-edit"></i></a>
                                             <a href="#!" id="deleteReg{{ $demande->id }}"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#deleteReg{{ $demande->id }}").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette région/ville  ?", () => {
                                                         axios.delete("/region/delete/{{ $demande->id }}", {
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

                                     </tr>

                                 @empty
                                 @endforelse



                             </tbody>
                         </table>
                         <script>
                             $("#reg").DataTable({
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
                         @foreach ($requests22 as $demande)
                             <div class="modal fade" id="EditRegModal{{ $demande->id }}"
                                 aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                     <div class="modal-content rounded-0">
                                         <div class="modal-body p-4 px-0 ">


                                             <div class="main-content text-center mb-3 p-3 py-auto">

                                                 <a href="#" style="" class="close-btn" id=""
                                                     data-bs-dismiss="modal">
                                                     <span aria-hidden="true"><span
                                                             class="fal fa-times"></span></span>
                                                 </a>

                                                 <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                                     Modifier région/ville</h6>

                                                 <div
                                                     class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                     <label for="" class="px-2 color-3 fs-5"><i
                                                             class="fal fa-tag"></i></label>
                                                     <input type="text"
                                                         class="form-control shadow-none border-0  bg-transparent"
                                                         placeholder="Nom" value="{{ $demande->label }}"
                                                         name="label{{ $demande->id }}"
                                                         id="labels{{ $demande->id }}" required>

                                                 </div>

                                                 <div
                                                     class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                                     <label for="" class="px-2 color-3 fs-5"><i
                                                             class="fal fa-coins"></i></label>
                                                     <input type="number" step="0.1"
                                                         class="form-control shadow-none border-0  bg-transparent"
                                                         placeholder="frais de livraison"
                                                         name="prix{{ $demande->id }}" id="prix{{ $demande->id }}"
                                                         value="{{ $demande->deliveryPrice }}" required>
                                                 </div>


                                                 <div class="mx-auto mt-3">
                                                     <button href="#!" type="submit"
                                                         id="ediregbtn{{ $demande->id }}"
                                                         class="btn w-100">Modifier&nbsp;
                                                         <i class="fal fa-check"></i></button>
                                                 </div>
                                                 @csrf
                                                 <script>
                                                     $('#ediregbtn{{ $demande->id }}').on("click", (e) => {
                                                         e.preventDefault()

                                                         axios.post("/region/update/{{ $demande->id }}", {
                                                                 label: $("#labels{{ $demande->id }}").val(),
                                                                 prix: $("#prix{{ $demande->id }}").val(),
                                                                 _token: "{{ csrf_token() }}"
                                                             })
                                                             .then(res => {
                                                                 toastr.info(res.data.message)
                                                                 LoadContentMain()
                                                                 $(".modal").modal("hide")


                                                             })
                                                             .catch(err => {
                                                                 console.error(err);
                                                                 toastr.error("Quelque chose s'est mal passé")

                                                             })
                                                     })
                                                 </script>




                                             </div>



                                         </div>

                                     </div>
                                 </div>

                             </div>
                         @endforeach
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
                     <div class="table-responsive" style="zoom: 1">
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
                                     <th class="border-top-0 d-none d-lg-table-cell">Actions</th>
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
                                         ->with('user')
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
                                                 {{ $total }} Dt</td>
                                             <td class="d-none d-lg-table-cell">
                                                 {{ $cmd->deliverer_id == null ? '' : $cmd->deliverer->name }}</td>
                                             <td class="d-none d-lg-table-cell">
                                                 @if ($cmd->statut != 5)
                                                     @switch($cmd->statut)
                                                         @case(1)
                                                             <a href="#!" id="startCmd{{ $cmd->id }}"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-play"></i></a>
                                                             <script>
                                                                 $("#startCmd{{ $cmd->id }},#startCmd1{{ $cmd->id }}").on("click", (e) => {
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
                                                                 $("#completeCmd{{ $cmd->id }},#completeCmd1{{ $cmd->id }}").on("click", (e) => {
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
                                             <td class="d-lg-none">
                                                 <a href="#!" id="details{{ $cmd->id }}"
                                                     class="btn shadow-none text-danger" data-bs-toggle="modal"
                                                     data-bs-target="#DetailsModal{{ $cmd->id }}"><i
                                                         class="fas fa-eye"></i></a>
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
                                                             @if (Auth::user()->user_id != $cmd->resto->user_id)
                                                                 <div
                                                                     class="row flex-column justify-content-start align-items-center">
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
                                                                 <span>Date : <strong
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
                                                                                     <div class="accordion-body h-100">
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
                                                             @if ($cmd->statut != 5)
                                                                 @switch($cmd->statut)
                                                                     @case(1)
                                                                         <button href="#!"
                                                                             id="startCmd1{{ $cmd->id }}"
                                                                             class="btn-outline shadow-none text-success"><i
                                                                                 class="fas fa-play"></i>
                                                                             Confirmer</button>
                                                                         {{-- <script>
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
                                                                             </script> --}}
                                                                     @break

                                                                     @case(2)
                                                                         <button href="#!"
                                                                             id="completeCmd1{{ $cmd->id }}"
                                                                             class="btn-success shadow-none text-white w-75 rounded-pill shadow-none border-0 p-2"><i
                                                                                 class="fas fa-check"></i>Terminer</button>
                                                                         {{-- <script>
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
                                                                             </script> --}}
                                                                     @break

                                                                     @default
                                                                 @endswitch
                                                             @endif
                                                             @if ($cmd->statut == 1)
                                                                 <a class="btn btn-danger w-75"
                                                                     id="cancel{{ $cmd->id }}">Annuler</a>
                                                                 <script>
                                                                     $("#cancel1{{ $cmd->id }}").on("click", (e) => {
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
                                                 <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">
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
                                                             class="btn shadow-none text-success"><i class="fas fa-play"></i></a>
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
                                                             class="btn shadow-none text-success"><i class="fas fa-check"></i></a>
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
                                                     class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
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
                                         <h4 class="card-title">Vos commandes acceptées</h4>
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
                                                 <th class="border-top-0">Statut</th>
                                                 <th class="border-top-0 d-none d-lg-table-cell">Total</th>
                                                 <th class="border-top-0 d-none d-lg-table-cell">Actions</th>
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
                                                 $me = User::where('user_id', Auth::user()->user_id)
                                                     ->with('commandesReceived')
                                                     ->get();
                                                 $commandes = commande_ref::where('deliverer_id', Auth::user()->user_id)
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
                                                     <td class="d-none d-lg-table-cell">
                                                         {{ $total + $cmd->user->region->deliveryPrice }}
                                                         Dt</td>

                                                     <td class="d-none d-lg-table-cell">
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
                                                                             $("#completeCmd{{ $cmd->id }},#completeCmd1{{ $cmd->id }}").on("click", (e) => {
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
                                                                                         $(".modal").modal("hide")


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
                                                                         $("#cancelCmd{{ $cmd->id }},#cancelCmd1{{ $cmd->id }}").on("click", (e) => {
                                                                             e.preventDefault()
                                                                             alertify.confirm("Confirmation", "Annule la livraison ?", () => {
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
                                                                                         $(".modal").modal("hide")

                                                                                     })
                                                                                     .catch(err => {
                                                                                         console.error(err);
                                                                                         toastr.error("Quelque chose s'est mal passé")

                                                                                     })

                                                                             }, () => {}).set({
                                                                                 labels: {
                                                                                     ok: "Oui",
                                                                                     cancel: "Non"
                                                                                 }
                                                                             })
                                                                         })
                                                                     </script>
                                                                 @else
                                                                     -
                                                                 @endif
                                                             @endif
                                                         @endif
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
                                                                             <span>Date :
                                                                                 <strong id="datepassLivr{{ $cmd->id }}">


                                                                                 </strong>
                                                                             </span>
                                                                             <script>
                                                                                 $('#datepassLivr{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
                                                                             </script>


                                                                         </div>
                                                                         <div class="col mb-2">
                                                                             <span>Total: <strong>
                                                                                     {{ $total + $cmd->user->region->deliveryPrice }}
                                                                                     TND

                                                                                 </strong></span>



                                                                         </div>


                                                                         @if ($cmd->statut == 4)
                                                                             <button
                                                                                 class="btn-outline btn-success  mb-2 rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                                 id="completeCmd1{{ $cmd->id }}">Terminé</button>
                                                                         @endif

                                                                         <button
                                                                             class="btn-outline btn-danger mb-2 rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                             id="cancelCmd1{{ $cmd->id }}">Annuler la
                                                                             livraison</button>
                                                                         {{-- <a href="#!" class="btn shadow-none text-success"><i
                                                                                 class="fas fa-check"></i></a> --}}


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
                                     <div class="table-responsive" style="zoom: 1">
                                         <table class="table mb-0 table-hover align-middle text-nowrap" id="ordersResto">
                                             <thead>
                                                 <tr>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Référence</th>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Restaurant</th>
                                                     <th class="border-top-0">Client</th>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Date de passation</th>
                                                     <th class="border-top-0">Statut</th>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Total</th>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Actions</th>
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
                                                     $me = User::where('user_id', Auth::user()->user_id)
                                                         ->with('commandesReceived')
                                                         ->get();
                                                     $commandes = commande_ref::where('statut', '!=', 6)
                                                         ->where('taken', 0)
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
                                                         <td class="d-none d-lg-table-cell">
                                                             {{ $total + $cmd->user->region->deliveryPrice }}
                                                             TND</td>

                                                         <td class="d-none d-lg-table-cell">
                                                             @if (!Auth::user()->onDuty)
                                                                 Vous êtes hors service
                                                             @else
                                                                 @if (!$cmd->taken)
                                                                     <a href="#!" id="startCmd{{ $cmd->id }}"
                                                                         class="btn shadow-none text-success"><i
                                                                             class="fas fa-play"></i></a>
                                                                     <script>
                                                                         $("#startCmd{{ $cmd->id }},#startCmd1{{ $cmd->id }}").on("click", (e) => {
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
                                                                                     $(".modal").modal("hide")
                                                                                     LoadContentMain()

                                                                                 })
                                                                                 .catch(err => {
                                                                                     console.error(err);
                                                                                     toastr.error("Quelque chose s'est mal passé")

                                                                                 })
                                                                         })
                                                                     </script>
                                                                 @else
                                                                     <a href="#!" id="cancelCmd{{ $cmd->id }}"
                                                                         class="btn shadow-none text-danger"><i
                                                                             class="fas fa-times"></i></a>
                                                                 @endif
                                                             @endif
                                                         </td>
                                                         <td class="d-lg-none">
                                                             <a href="#!" id="seeDetails{{ $cmd->id }}"
                                                                 data-bs-toggle="modal"
                                                                 data-bs-target="#DetaildLiv{{ $cmd->id }}"
                                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                                         </td>
                                                     </tr>
                                                     <div class="modal fade" id="DetaildLiv{{ $cmd->id }}"
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
                                                                                 <span>Date :
                                                                                     <strong id="datepassLivr{{ $cmd->id }}">


                                                                                     </strong>
                                                                                 </span>
                                                                                 <script>
                                                                                     $('#datepassLivr{{ $cmd->id }}').html(moment("{{ $cmd->created_at }}").format('LL | LT'))
                                                                                 </script>


                                                                             </div>
                                                                             <div class="col mb-2">
                                                                                 <span>Total: <strong>
                                                                                         {{ $total + $cmd->user->region->deliveryPrice }}
                                                                                         TND

                                                                                     </strong></span>



                                                                             </div>



                                                                             <button
                                                                                 class="btn-outline btn-success rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                                 id="startCmd1{{ $cmd->id }}">Accepter</button>



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
                                                 $("#ordersResto").DataTable({
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
                             <div class="col-12" id="demandes">
                                 <div class="card">
                                     <div class="card-body">
                                         <!-- title -->
                                         <div class="d-md-flex">
                                             <div>
                                                 <h4 class="card-title"> Liste des demandes des restaurants</h4>
                                                 {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                                             </div>

                                         </div>
                                         <!-- title -->
                                         <div class="table-responsive" style="zoom: 1">
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
                                 <div class="col-12" id="demandes">
                                     <div class="card">
                                         <div class="card-body">
                                             <!-- title -->
                                             <div class="d-md-flex">
                                                 <div>
                                                     <h4 class="card-title"> Liste des demandes des clients</h4>
                                                     {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                                                 </div>

                                             </div>
                                             <!-- title -->
                                             <div class="table-responsive" style="zoom: 1">
                                                 <table class="table mb-0 table-hover align-middle text-nowrap" id="requestCmdLivr">
                                                     <thead>
                                                         <tr>
                                                             <th class="border-top-0">Client</th>
                                                             <th class="border-top-0">Message</th>
                                                             <th class="border-top-0">Image</th>
                                                             <th class="border-top-0">Frais</th>
                                                             <th class="border-top-0">Statut</th>
                                                             <th class="border-top-0">Date de passation</th>
                                                             <th class="border-top-0">Actions</th>
                                                         </tr>
                                                     </thead>

                                                     <tbody>
                                                         @php
                                                             
                                                             $requests = OtherCommande::with('user')->get();
                                                             
                                                         @endphp
                                                         @forelse ($requests as $cmd)
                                                             <tr>
                                                                 <td>
                                                                     <div class="d-flex align-items-center">
                                                                         <div class="m-r-10"><a
                                                                                 class="btn btn-circle d-flex btn-info text-white">
                                                                                 <img src="{{ asset('uploads/logos/' . $cmd->user->avatar) }}"
                                                                                     alt="" class="img-fluid " width="80px">
                                                                             </a>
                                                                         </div>
                                                                         <div class="">
                                                                             <h4 class="m-b-0 font-16">{{ $cmd->user->name }}

                                                                                 <br>
                                                                                 <small>N° Téléphone : <a
                                                                                         href="tel:{{ $cmd->user->phone }}">{{ $cmd->user->phone }}</a></small>
                                                                                 <br>
                                                                                 <small>Adresse :
                                                                                     <strong>{{ $cmd->user->address == '' ? 'N/A' : $cmd->user->address }}</strong>
                                                                                 </small>


                                                                             </h4>
                                                                         </div>
                                                                     </div>
                                                                 </td>
                                                                 <td>
                                                                     {{ $cmd->message }}
                                                                 </td>
                                                                 <td>
                                                                     @if ($cmd->picture != '')
                                                                         <img class="img-fluit " width="50px"
                                                                             src="{{ asset('uploads/commandes/' . $cmd->picture) }}"
                                                                             alt="image ">
                                                                     @else
                                                                         -
                                                                     @endif
                                                                 </td>
                                                                 <td>
                                                                     {{ $cmd->frais }} TND

                                                                 </td>
                                                                 <td>
                                                                     @switch($cmd->statut)
                                                                         @case(1)
                                                                             <label class="badge bg-warning">En attente</label>
                                                                         @break

                                                                         @case(2)
                                                                             <label class="badge bg-info">Acceptée</label>
                                                                         @break

                                                                         @case(3)
                                                                             <label class="badge bg-success">Livrée</label>
                                                                         @break

                                                                         @default
                                                                     @endswitch
                                                                 </td>
                                                                 <td>
                                                                     {{ Carbon::parse($cmd->created_at)->translatedFormat(' j F Y | H:i') }}
                                                                     {{-- {{ date('l \t\h\e jS | H:i a', strtotime($cmd->created_at)) }}</td> --}}

                                                                 <td>
                                                                     @if (!Auth::user()->onDuty)
                                                                         Vous êtes hors service
                                                                     @else
                                                                         @if ($cmd->deliverer_id == null)
                                                                             <a href="#!" id="acceptCmdOther{{ $cmd->id }}"
                                                                                 class="btn shadow-none text-success"><i
                                                                                     class="fas fa-play"></i></a>
                                                                             <script>
                                                                                 $("#acceptCmdOther{{ $cmd->id }}").on("click", (e) => {
                                                                                     e.preventDefault()

                                                                                     axios.post("/otherCommande/accept", {
                                                                                             "_token": "{{ csrf_token() }}",
                                                                                             "id": "{{ $cmd->id }}"

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
                                                                                 <a href="#!"
                                                                                     id="termineDemandeOther{{ $cmd->id }}"
                                                                                     class="btn shadow-none text-success"><i
                                                                                         class="fas fa-check"></i></a>
                                                                                 <a href="#!"
                                                                                     id="cancelDemandeOther{{ $cmd->id }}"
                                                                                     class="btn shadow-none text-danger"><i
                                                                                         class="fas fa-times"></i></a>
                                                                                 <script>
                                                                                     $("#termineDemandeOther{{ $cmd->id }}").on("click", (e) => {
                                                                                         e.preventDefault()
                                                                                         axios.post("/otherCommande/termine", {
                                                                                                 "_token": "{{ csrf_token() }}",
                                                                                                 "id": "{{ $cmd->id }}"
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
                                                                                     $("#cancelDemandeOther{{ $cmd->id }}").on("click", (e) => {
                                                                                         e.preventDefault()
                                                                                         alertify.confirm("Confirmation", "Vous êtes sûr d'annuler la livraison de  cette demande  ?", () => {
                                                                                             axios.post("/otherCommande/cancel", {
                                                                                                     "_token": "{{ csrf_token() }}",
                                                                                                     "id": "{{ $cmd->id }}"
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
                                                                                 @if ($cmd->statut == 2)
                                                                                 @endif
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
                                                         $("#requestCmdLivr").DataTable({
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
