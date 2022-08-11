 @php
     use App\Models\Region;
 @endphp
 @php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
     use App\models\OtherCommande;
     use Carbon\Carbon;
     
 @endphp
 <script type="text/javascript"
     src="//maps.googleapis.com/maps/api/js?v=quarterly&region=GB&language=en-gb&key=AIzaSyB2F2iNc14AvTI9_I2zk9O4exeJ-eKxGGM&libraries=places">
 </script>



 <script type="text/javascript" src="//googlearchive.github.io/js-marker-clusterer/src/markerclusterer.js"></script>
 <div class="row" id="content">
     <!-- Column -->
     <div class="col-lg-4 col-xlg-3 col-md-5">
         <div class="card">
             <div class="card-body">
                 <center class="m-t-30">
                     <form action="" id="avatarForm" class="" enctype="multipart/form-data">
                         <div class="position-relative">

                             <img id="avatarContainer"
                                 src={{ $user->avatar == '' ? asset('images/users/1.jpg') : asset('uploads/logos/' . $user->avatar) }}
                                 class="rounded shadow" width="150" />
                             <br>
                             @if (Auth::user()->user_id == $user->user_id)
                                 <label for="avatar1" class="btn text-dark position-relative fs-4 fw-bold"><i
                                         class="fas fa-edit"></i></label>
                                 <input type="file" id="avatar1" accept="image/*" hidden name="avatar">
                             @endif

                         </div>
                         @csrf
                         <button id="submitAvatar" style="display: none" type="submit"
                             class="btn btn-primary mt-3 ">Save</button>

                     </form>
                     <script>
                         $("#avatarForm").on("submit", (e) => {
                             e.preventDefault();
                             let form = $("#avatarForm")[0]
                             let formData = new FormData(form)
                             $("#submitAvatar").html(spinner)
                             axios.post("/user/update/logo/{{ Auth::user()->user_id }}", formData)
                                 .then(res => {

                                     console.log(res)
                                     $("#submitAvatar").fadeOut()
                                     toastr.success(res.data.message)
                                     $('#profileCont').load("/layouts/profile")

                                 })
                                 .catch(err => {
                                     console.error(err.response.data);
                                     toastr.error("Erreur inconnue , réssayez plus tard !")

                                 }).finally(() => {
                                     $("#submitAvatar").html("save")

                                 })
                         })
                     </script>
                     <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                     <h6 class="card-subtitle">
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

                             @case(4)
                                 Admin
                             @break

                             @default
                                 N/A
                         @endswitch
                     </h6>
                     {{-- <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                    <font class="font-medium">254</font>
                                </a></div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                    <font class="font-medium">54</font>
                                </a></div>
                        </div> --}}
                 </center>
                 <script>
                     $('#avatar1').change(function() {
                         var i = $(this).prev('label').clone();
                         console.log("cheange");
                         var file = $('#avatar1')[0].files[0].name;
                         var reader = new FileReader();
                         reader.onload = function(e) {
                             $('#submitAvatar').fadeIn("slow")
                             $('#avatarContainer').attr('src', e.target.result)
                         };
                         reader.readAsDataURL($('#avatar1')[0].files[0]);
                         console.log($('#avatar1')[0].files[0]);


                     });
                 </script>
             </div>
             <div>
                 <hr>
             </div>
             <div class="card-body"> <small class="text-muted">E-mail </small>
                 <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Téléphone</small>
                 <h6>+216 {{ $user->phone }}</h6> <small class="text-muted p-t-30 db">Adresse</small>
                 <h6>{{ $user->address != '' ? $user->address : 'Pas encore configuré' }}</h6>


                 {{-- <small class="text-muted p-t-30 db">Social Profile</small>
                 <br />
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button> --}}
             </div>
         </div>

     </div>
     <!-- Column -->
     <!-- Column -->
     <div class="col-lg-8 col-xlg-9 col-md-7">
         <div class="card">
             <div class="card-body">
                 @if (Auth::user()->user_id == $user->user_id)

                     <form class="form-horizontal form-material mx-2" id="updateForm">
                         <div class="form-group">
                             <label class="col-md-12">Nom complet</label>
                             <div class="col-md-12">
                                 <input type="text" name="name" placeholder="Johnathan Doe"
                                     value="{{ $user->name }}" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Matricule</label>
                             <div class="col-md-12">
                                 <input type="text" name="username" placeholder="" disabled
                                     value="{{ $user->username }}" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="example-email" class="col-md-12">E-mail</label>
                             <div class="col-md-12">
                                 <input type="email" name="email" value="{{ $user->email }}"
                                     placeholder="johnathan@admin.com" class="form-control form-control-line"
                                     name="example-email" id="example-email">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Mot de passe</label>
                             <div class="col-md-12">
                                 <input type="password" name="password" placeholder="Nouveau mot de passe (optionel)"
                                     name="password" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">N° Téléphone:</label>
                             <div class="col-md-12">
                                 <input type="tel" name="phone" value="{{ $user->phone }}"
                                     placeholder="votre numéro" class="form-control form-control-line">
                             </div>
                         </div>
                         @if ($user->type == 2)
                             <div class="form-group">
                                 <label class="col-md-12">Frais de livraison (DT)</label>
                                 <small class="fw-bold text-info">NB:écrire 0 si vous livrez sans frais.
                                 </small>

                                 <div class="col-md-12">
                                     <input type="number" name="deliveryPrice" value="{{ $user->deliveryPrice }}"
                                         placeholder="(ex:7 )" required class="form-control form-control-line">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-md-12">Suppléments maximum :</label>
                                 <div class="col-md-12">
                                     <input type="number" name="perSupp" placeholder="(ex:5 )" required
                                         value="{{ count($user->configs) != 0 ? $user->configs[0]->perSupp : '' }}"
                                         class="form-control form-control-line">
                                 </div>

                             </div>
                             <div class="form-group">
                                 <label class="col-md-12">Garnitures maximum :</label>
                                 <div class="col-md-12">
                                     <input type="number" name="perTopp"
                                         value="{{ count($user->configs) != 0 ? $user->configs[0]->perTopp : '' }}"
                                         placeholder="(ex:5 )" required class="form-control form-control-line">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-md-12">Sauces maximum :</label>
                                 <div class="col-md-12">
                                     <input type="number" name="perSauce"
                                         value="{{ count($user->configs) != 0 ? $user->configs[0]->perSauce : '' }}"
                                         placeholder="(ex:5 )" required class="form-control form-control-line">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-md-12">Boissons maximum :</label>
                                 <div class="col-md-12">
                                     <input type="number" name="perDrink"
                                         value="{{ count($user->configs) != 0 ? $user->configs[0]->perDrink : '' }}"
                                         placeholder="(ex:5 )" required class="form-control form-control-line">
                                 </div>
                             </div>
                             @foreach ($user->configs as $config)
                             @endforeach


                         @endif
                         <div class="form-group">
                             <label class="col-sm-12">Selectionnez votre ville/région</label>
                             <div class="col-sm-12">
                                 <select required class="form-select shadow-none form-control-line" name="city">
                                     @php
                                         $regions = Region::get();
                                         
                                         if ($user->city != '') {
                                             $regions = Region::where('id', '!=', $user->city)->get();
                                         }
                                     @endphp
                                     @if ($user->city != '')
                                         <option value="{{ $user->region->id }}">{{ $user->region->label }}</option>
                                     @endif
                                     @foreach ($regions as $region)
                                         <option value="{{ $region->id }}">{{ $region->label }}</option>
                                     @endforeach



                                 </select>
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-md-12">adresse</label>
                             <div class="col-md-12">
                                 <textarea rows="3" name="address" class="form-control form-control-line" required
                                     placeholder="Précisez votre adresse">{{ $user->address != '' ? $user->address : null }}</textarea>
                             </div>
                         </div>
                         <input type="hidden" name="id" id="id" value={{ $user->user_id }}>

                         @csrf

                         <div class="form-group">
                             <div class="col-sm-12">
                                 <button type="submit" id="btnUpdate"
                                     class="btn btn-success text-white">Enregistrer</button>
                             </div>
                         </div>
                     </form>
                 @else
                     <h3>Statistiques</h3>
                     @if ($user->type == 3 || $user->type == 2)
                         @php
                             $type = $user->type;
                             $frequent = [];
                             $delivered = [];
                             $response = [];
                             
                             switch ($type) {
                                 case 2:
                                     # code...
                                     $commandes = commande_ref::where('resto_id', $user->user_id)
                                         ->where('statut', 5)
                                         ->with('items')
                                         ->get();
                             
                                     $revenue = 0;
                                     if ($commandes->count() > 0) {
                                         foreach ($commandes as $cmd) {
                                             foreach ($cmd->items as $item) {
                                                 $revenue += $item->total;
                                             }
                                         }
                                     }
                             
                                     $topProduct = Commande::whereHas('product', function ($query) use ($user) {
                                         return $query->where('resto_id', $user->user_id);
                                     })
                                         ->with('product')
                                         ->groupBy('product_id')
                                         ->orderByRaw('COUNT(*) DESC')
                                         ->limit(1)
                                         ->first();
                                     $topdilev = commande_ref::where('resto_id', $user->user_id)
                                         ->with('deliverer')
                                         ->groupBy('deliverer_id')
                                         ->orderByRaw('COUNT(*) DESC')
                                         ->limit(1)
                                         ->first();
                             
                                     break;
                                 case 3:
                                     # code...
                             
                                     $delivered = commande_ref::where('deliverer_id', $user->user_id)
                                         ->where('statut', 5)
                                         ->get();
                                     $response = RequestResto::where('deliverer_id', $user->user_id)->get();
                                     $frequent = commande_ref::where('deliverer_id', $user->user_id)
                                         ->with('resto')
                                         ->groupBy('resto_id')
                                         ->orderByRaw('COUNT(*) DESC')
                                         ->limit(1)
                                         ->get();
                                     break;
                             
                                 default:
                                     # code...
                                     break;
                             }
                         @endphp
                         <div class="row">

                             <div class="col-md-4 col-xl-3 mb-4">
                                 <div class="card shadow border-start-success py-2">
                                     <div class="card-body">
                                         <div class="row align-items-center no-gutters">
                                             <div class="col me-2">
                                                 <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                     <span>{{ $type == 2 ? 'Commandes ' : 'Réponse au demande des restaurants' }}</span>

                                                 </div>
                                                 <div class="text-dark fw-bold h5 mb-0">
                                                     <span>{{ $type == 2 ? count($commandes) : count($response) }}</span>
                                                 </div>
                                             </div>
                                             <div class="col-auto"><i
                                                     class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @if ($type == 3)
                                 <div class="col-md-4 col-xl-3 mb-4">
                                     <div class="card shadow border-start-success py-2">
                                         <div class="card-body">
                                             <div class="row align-items-center no-gutters">
                                                 <div class="col me-2">
                                                     <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                         <span>Réponse aux demandes clients</span>

                                                     </div>
                                                     <div class="text-dark fw-bold h5 mb-0">
                                                         <span>
                                                             @php
                                                                 $con = OtherCommande::where('deliverer_id', $user->user_id)->get();
                                                             @endphp
                                                             {{ $con->count() }}
                                                         </span>
                                                     </div>
                                                 </div>
                                                 <div class="col-auto"><i
                                                         class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-4 col-xl-3 mb-4">
                                     <div class="card shadow border-start-info py-2">
                                         <div class="card-body">
                                             <div class="row align-items-center no-gutters">
                                                 <div class="col me-2">
                                                     <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                         <span>{{ 'Restaurant fréquent' }}</span>

                                                     </div>
                                                     <div class="row g-0 align-items-center">
                                                         <div class="col-auto">
                                                             <div class="text-dark fw-bold h5 mb-0 me-3">
                                                                 @if (count($frequent) > 0)
                                                                     <span>{{ $frequent[0]->resto->name }}</span>
                                                                 @else
                                                                     Pas encore
                                                                 @endif
                                                             </div>
                                                         </div>

                                                     </div>
                                                 </div>
                                                 <div class="col-auto"><i
                                                         class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endif

                             <div class="col-md-4 col-xl-3 mb-4">
                                 <div class="card shadow border-start-success py-2">
                                     <div class="card-body">
                                         <div class="row align-items-center no-gutters">
                                             <div class="col me-2">
                                                 <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                     <span>Revenue d'aujourd'hui</span>

                                                 </div>
                                                 <div class="text-dark fw-bold h5 mb-0">
                                                     @php
                                                         $totalRevToday = 0;
                                                         
                                                         if ($type == 3) {
                                                             # code...
                                                             $revenue = commande_ref::where('deliverer_id', $user->user_id)
                                                                 ->where('statut', 5)
                                                                 ->whereDate('created_at', Carbon::today())
                                                                 ->get();
                                                             $revenue2 = OtherCommande::where('deliverer_id', $user->user_id)
                                                                 ->where('statut', 3)
                                                                 ->whereDate('created_at', Carbon::today())
                                                                 ->get();
                                                             foreach ($revenue as $rev) {
                                                                 $totalRevToday += $rev->user->region->deliveryPrice;
                                                             }
                                                             foreach ($revenue2 as $rev) {
                                                                 $totalRevToday += $rev->user->region->deliveryPrice;
                                                             }
                                                         } else {
                                                             $revenue = commande_ref::where('resto_id', $user->user_id)
                                                                 ->where('statut', 5)
                                                                 ->whereDate('created_at', Carbon::today())
                                                                 ->get();
                                                             foreach ($revenue as $rev) {
                                                                 foreach ($rev->items as $it) {
                                                                     $totalRevToday += $it->total;
                                                                 }
                                                             }
                                                         }
                                                         
                                                     @endphp

                                                     <span>{{ $totalRevToday }} TND</span>

                                                 </div>
                                             </div>
                                             <div class="col-auto"><i
                                                     class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4 col-xl-3 mb-4">
                                 <div class="card shadow border-start-success py-2">
                                     <div class="card-body">
                                         <div class="row align-items-center no-gutters">
                                             <div class="col me-2">
                                                 <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                     <span>Revenue Total</span>

                                                 </div>
                                                 <div class="text-dark fw-bold h5 mb-0">
                                                     @php
                                                         $totalRev = 0;
                                                         
                                                         if ($type == 3) {
                                                             # code...
                                                             $revenue = commande_ref::where('deliverer_id', $user->user_id)
                                                                 ->where('statut', 5)
                                                                 ->get();
                                                             $revenue2 = OtherCommande::where('deliverer_id', $user->user_id)
                                                                 ->where('statut', 3)
                                                                 ->get();
                                                             foreach ($revenue as $rev) {
                                                                 $totalRev += $rev->user->region->deliveryPrice;
                                                             }
                                                             foreach ($revenue2 as $rev) {
                                                                 $totalRev += $rev->user->region->deliveryPrice;
                                                             }
                                                         } else {
                                                             $revenue = commande_ref::where('resto_id', $user->user_id)
                                                                 ->where('statut', 5)
                                                                 ->get();
                                                             foreach ($revenue as $rev) {
                                                                 foreach ($rev->items as $it) {
                                                                     $totalRev += $it->total;
                                                                 }
                                                             }
                                                         }
                                                         
                                                     @endphp

                                                     <span>{{ $totalRev }} TND</span>
                                                 </div>
                                             </div>
                                             <div class="col-auto"><i
                                                     class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endif
                 @endif
             </div>
         </div>


     </div>
     <script>
         $("#updateForm").on("submit", (e) => {
             e.preventDefault();
             let form = $("updateForm")[0]
             let formData = new FormData(form)
             let id = $("#id").val()
             $("#btnUpdate").html(spinner)
             axios.post(`/user/update/${id}`, $("#updateForm").serialize())
                 .then(res => {
                     console.log(res.data.message)
                     toastr.success(res.data.message)
                     $('#profileCont').load("/layouts/profile");
                 })
                 .catch(err => {
                     console.error(err.response.data);
                     if (err.response.data.message != undefined) {

                     } else {
                         for (const k in err.response.data) {

                             toastr.error(err.response.data[k])
                         }
                     }
                 })
                 .finally(() => {
                     $("#btnUpdate").html("Update Profile")

                 })
         })
     </script>
     <!-- Column -->
 </div>
