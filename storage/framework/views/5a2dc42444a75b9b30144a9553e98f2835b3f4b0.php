 <?php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
     use App\models\Region;
     use App\models\Config;
     use App\models\OtherCommande;
     
 ?>
 <?php
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
     use App\Models\Demande;
     use Nette\Utils\Random;
     use Carbon\Carbon;
     
 ?>
 <?php if(Auth::user()->type == 4): ?>
     <div class="row">
         <div class="col-md-6" id="demandes" style="zoom: 1">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Demandes de partenariat</h4>
                             
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
                                 <?php
                                     
                                     $requests = Demande::where('type', 2)->get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <tr>
                                         <td>
                                             <?php echo e($demande->name); ?>

                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             <?php echo e($demande->phone); ?>

                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             <?php echo e($demande->email); ?>

                                         </td>





                                         <td class="d-none d-lg-table-cell">

                                             <a href="#!" id="cancelreq<?php echo e($demande->id); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#cancelreq<?php echo e($demande->id); ?>").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande  ?", () => {
                                                         axios.post("/demande/delete/<?php echo e($demande->id); ?>", {
                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                 id: "<?php echo e($demande->id); ?>"


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
                                         <?php
                                             $hash = Random::generate(2, '0-9');
                                         ?>
                                         <td class="d-lg-none">
                                             <a href="#!" id="" data-bs-toggle="modal"
                                                 data-bs-target="#DetailsModal<?php echo e($demande->id + $hash); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal<?php echo e($demande->id + $hash); ?>"
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
                                                             <strong><?php echo e($demande->name); ?></strong>
                                                         </h6>
                                                         <div
                                                             class="row flex-column justify-content-start align-items-center">
                                                             <div class="col mb">
                                                                 <label class="">N° Téléphone:</label>
                                                                 <strong>
                                                                     <a href="tel:<?php echo e($demande->phone); ?>">
                                                                         <?php echo e($demande->phone); ?>

                                                                     </a>

                                                                 </strong>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Email: <strong>
                                                                         <a href="mailto:<?php echo e($demande->email); ?>">
                                                                             <?php echo e($demande->email); ?>


                                                                         </a>

                                                                     </strong></span>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Date : <strong id="dateTel<?php echo e($demande->id); ?>">


                                                                     </strong></span>
                                                                 <script>
                                                                     $('#dateTel<?php echo e($demande->id); ?>').html(moment("<?php echo e($demande->created_at); ?>").format('LL | LT'))
                                                                 </script>


                                                             </div>



                                                             <a class="btn btn-danger w-75"
                                                                 id="canceldemande<?php echo e($demande->id); ?>">Supprimer</a>
                                                             <script>
                                                                 $("#canceldemande<?php echo e($demande->id); ?>").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande ?", () => {
                                                                         axios.post("/demande/delete/<?php echo e($demande->id); ?>", {
                                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                                 id: "<?php echo e($demande->id); ?>"
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

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                 <?php endif; ?>



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
                                 <?php
                                     
                                     $requests = Demande::where('type', 3)->get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <tr>
                                         <td>
                                             <?php echo e($demande->name); ?>

                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             <?php echo e($demande->phone); ?>

                                         </td>
                                         <td class="d-none d-lg-table-cell">
                                             <?php echo e($demande->email); ?>

                                         </td>




                                         <td class="d-none d-lg-table-cell">

                                             <a href="#!" id="cancelreqDeliv<?php echo e($demande->id); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#cancelreqDeliv<?php echo e($demande->id); ?>").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande  ?", () => {
                                                         axios.post("/demande/delete/<?php echo e($demande->id); ?>", {
                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                 id: "<?php echo e($demande->id); ?>"


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
                                             <a href="#!" data-bs-target="#DetailsModal<?php echo e($demande->id); ?>"
                                                 data-bs-toggle="modal" class="btn shadow-none text-danger"><i
                                                     class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal<?php echo e($demande->id); ?>"
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
                                                             <strong><?php echo e($demande->name); ?></strong>
                                                         </h6>
                                                         <div
                                                             class="row flex-column justify-content-start align-items-center">
                                                             <div class="col mb">
                                                                 <label class="">N° Téléphone:</label>
                                                                 <strong>
                                                                     <a href="tel:<?php echo e($demande->phone); ?>">
                                                                         <?php echo e($demande->phone); ?>

                                                                     </a>

                                                                 </strong>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Email: <strong>
                                                                         <a href="mailto:<?php echo e($demande->email); ?>">
                                                                             <?php echo e($demande->email); ?>


                                                                         </a>

                                                                     </strong></span>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Date : <strong id="dateTel<?php echo e($demande->id); ?>">


                                                                     </strong></span>
                                                                 <script>
                                                                     $('#dateTel<?php echo e($demande->id); ?>').html(moment("<?php echo e($demande->created_at); ?>").format('LL | LT'))
                                                                 </script>


                                                             </div>



                                                             <a class="btn btn-danger w-75"
                                                                 id="canceldemande<?php echo e($demande->id); ?>">Supprimer</a>
                                                             <script>
                                                                 $("#canceldemande<?php echo e($demande->id); ?>").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette demande ?", () => {
                                                                         axios.post("/demande/delete/<?php echo e($demande->id); ?>", {
                                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                                 id: "<?php echo e($demande->id); ?>"
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

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                 <?php endif; ?>



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
                                 <?php
                                     
                                     $requests22 = Region::get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $requests22; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <tr>
                                         <td>
                                             <?php echo e($demande->label); ?>

                                         </td>
                                         <td class="">
                                             <?php echo e($demande->deliveryPrice); ?>

                                         </td>
                                         <td class="">

                                             <a href="#!" id="editReg<?php echo e($demande->id); ?>"
                                                 class="btn shadow-none text-primary" data-bs-toggle="modal"
                                                 data-bs-target="#EditRegModal<?php echo e($demande->id); ?>"><i
                                                     class="fas fa-edit"></i></a>
                                             <a href="#!" id="deleteReg<?php echo e($demande->id); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <script>
                                                 $("#deleteReg<?php echo e($demande->id); ?>").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cette région/ville  ?", () => {
                                                         axios.delete("/region/delete/<?php echo e($demande->id); ?>", {
                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                 id: "<?php echo e($demande->id); ?>"


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

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                 <?php endif; ?>



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
                         <?php $__currentLoopData = $requests22; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="modal fade" id="EditRegModal<?php echo e($demande->id); ?>"
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
                                                         placeholder="Nom" value="<?php echo e($demande->label); ?>"
                                                         name="label<?php echo e($demande->id); ?>"
                                                         id="labels<?php echo e($demande->id); ?>" required>

                                                 </div>

                                                 <div
                                                     class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                                     <label for="" class="px-2 color-3 fs-5"><i
                                                             class="fal fa-coins"></i></label>
                                                     <input type="number" step="0.1"
                                                         class="form-control shadow-none border-0  bg-transparent"
                                                         placeholder="frais de livraison"
                                                         name="prix<?php echo e($demande->id); ?>" id="prix<?php echo e($demande->id); ?>"
                                                         value="<?php echo e($demande->deliveryPrice); ?>" required>
                                                 </div>


                                                 <div class="mx-auto mt-3">
                                                     <button href="#!" type="submit"
                                                         id="ediregbtn<?php echo e($demande->id); ?>"
                                                         class="btn w-100">Modifier&nbsp;
                                                         <i class="fal fa-check"></i></button>
                                                 </div>
                                                 <?php echo csrf_field(); ?>
                                                 <script>
                                                     $('#ediregbtn<?php echo e($demande->id); ?>').on("click", (e) => {
                                                         e.preventDefault()

                                                         axios.post("/region/update/<?php echo e($demande->id); ?>", {
                                                                 label: $("#labels<?php echo e($demande->id); ?>").val(),
                                                                 prix: $("#prix<?php echo e($demande->id); ?>").val(),
                                                                 _token: "<?php echo e(csrf_token()); ?>"
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
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 <?php endif; ?>

 <?php if(Auth::user()->type == 2): ?>
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
                                 <?php
                                     $cmds = commande_ref::where('resto_id', Auth::user()->user_id)
                                         ->where('statut', '!=', 5)
                                         ->with('items')
                                         ->with('user')
                                         ->orderBy('statut', 'asc')
                                         ->get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $cmds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <?php if(!$cmd->is_message): ?>
                                         <?php
                                             $total = 0;
                                         ?>
                                         <tr>
                                             <td class="d-none d-lg-table-cell">
                                                 <strong>#<?php echo e($cmd->reference); ?></strong>
                                             </td>
                                             <td>
                                                 <div class="d-flex align-items-center">
                                                     <div class="m-r-10"><a
                                                             class="btn btn-circle d-flex btn-info text-white">
                                                             <img src="<?php echo e(asset('uploads/logos/' . $cmd->user->avatar)); ?>"
                                                                 alt="" class="img-fluid " width="80px">
                                                         </a>
                                                     </div>
                                                     <div class="">
                                                         <h4 class="m-b-0 font-16"><?php echo e($cmd->user->name); ?></h4>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="d-none d-lg-table-cell">


                                                 <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php
                                                         $total += $passed->total;
                                                     ?>
                                                     <div class="accordion accordion-flush"style="max-width: 200px !important;word-wrap: break-word"
                                                         id="accordionExample<?php echo e($passed->id); ?>">
                                                         <div class="accordion-item">
                                                             <h2 class="accordion-header" id="pr<?php echo e($passed->id); ?>">
                                                                 <button class="accordion-button collapsed"
                                                                     type="button" data-bs-toggle="collapse"
                                                                     data-bs-target="#product<?php echo e($passed->id); ?>"
                                                                     aria-expanded="true" aria-controls="collapseOne">
                                                                     <?php echo e($passed->product->label); ?>

                                                                     (<?php echo e($passed->quantity); ?>)
                                                                 </button>
                                                             </h2>
                                                             <div id="product<?php echo e($passed->id); ?>"
                                                                 class="accordion-collapse collapse "
                                                                 aria-labelledby=""
                                                                 data-bs-parent="#accordionExample<?php echo e($passed->id); ?>"
                                                                 style="max-width: 200px !important;word-wrap: break-word">
                                                                 <div class="accordion-body h-100">
                                                                     <span class="text-muted fw-bold">Total:
                                                                     </span> <?php echo e($passed->total); ?> TND
                                                                     <br>

                                                                     <?php if($passed->garnitures != ''): ?>
                                                                         <span class="text-muted fw-bold">Granitures:
                                                                         </span>
                                                                         <?php
                                                                             $toppings = json_decode($passed->garnitures);
                                                                             
                                                                         ?>
                                                                         <?php $__currentLoopData = $toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                             <?php
                                                                                 $topp = Garniture::where('id', $topping)->first();
                                                                             ?>
                                                                             <?php echo e($topp->label); ?>,
                                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                         <br>
                                                                     <?php endif; ?>
                                                                     <?php if($passed->supplements != ''): ?>
                                                                         <span class="text-muted fw-bold">Supplements:
                                                                         </span>
                                                                         <?php
                                                                             $supplements = json_decode($passed->supplements);
                                                                             
                                                                         ?>
                                                                         <?php $__currentLoopData = $supplements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                             <?php
                                                                                 $sp = Supplement::where('id', $supplement)->first();
                                                                             ?>
                                                                             <?php echo e($sp->label); ?>,
                                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                         <br>
                                                                         <?php if($passed->sauces != ''): ?>
                                                                             <span class="text-muted fw-bold">Sauces:
                                                                             </span>
                                                                             <?php
                                                                                 $sauces = json_decode($passed->sauces);
                                                                                 
                                                                             ?>
                                                                             <?php $__currentLoopData = $sauces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sauce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                 <?php
                                                                                     $sc = Sauce::where('id', $sauce)->first();
                                                                                 ?>
                                                                                 <?php echo e($sc->label); ?>,
                                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                             <br>
                                                                         <?php endif; ?>
                                                                     <?php endif; ?>

                                                                     <?php if($passed->drinks != ''): ?>
                                                                         <span class="text-muted fw-bold">Boissons:
                                                                         </span>
                                                                         <?php
                                                                             $drinks = json_decode($passed->drinks);
                                                                             
                                                                         ?>
                                                                         <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                             <?php
                                                                                 $dr = Drink::where('id', $drink)->first();
                                                                             ?>
                                                                             <?php echo e($dr->label); ?>,
                                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                         <br>
                                                                     <?php endif; ?>

                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </td>
                                             <td class="d-none d-lg-table-cell"><a
                                                     href="tel:<?php echo e($cmd->user->phone); ?>"><?php echo e($cmd->user->phone); ?></a>
                                             </td>
                                             <td id="datepass<?php echo e($cmd->id); ?>" class="d-none d-lg-table-cell">
                                             </td>
                                             <script>
                                                 $('#datepass<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format("LL | LT"))
                                             </script>
                                             <td>
                                                 <?php switch($cmd->statut):
                                                     case (1): ?>
                                                         <label class="badge bg-warning">En attente</label>
                                                     <?php break; ?>

                                                     <?php case (2): ?>
                                                         <label class="badge bg-info">Traitement</label>
                                                     <?php break; ?>

                                                     <?php case (3): ?>
                                                         <label class="badge bg-primary">Prêt</label>
                                                     <?php break; ?>

                                                     <?php case (4): ?>
                                                         <label class="badge bg-warning">En livraison</label>
                                                     <?php break; ?>

                                                     <?php case (5): ?>
                                                         <label class="badge bg-success">Livrée

                                                         </label>
                                                     <?php break; ?>

                                                     <?php case (6): ?>
                                                         <label class="badge bg-danger">Annulée</label>
                                                     <?php break; ?>

                                                     <?php default: ?>
                                                 <?php endswitch; ?>
                                             </td>
                                             <td class="d-none d-lg-table-cell">
                                                 <?php echo e($total); ?> TND</td>
                                             <td class="d-none d-lg-table-cell">
                                                 <?php echo e($cmd->deliverer_id == null ? '' : $cmd->deliverer->name); ?></td>
                                             <td class="d-none d-lg-table-cell">
                                                 <?php if($cmd->statut != 5): ?>
                                                     <?php switch($cmd->statut):
                                                         case (1): ?>
                                                             <a href="#!" id="startCmd<?php echo e($cmd->id); ?>"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-play"></i></a>

                                                             <a href="#!" id="cancel<?php echo e($cmd->id); ?>"
                                                                 class="btn shadow-none text-danger"><i
                                                                     class="fas fa-trash"></i></a>
                                                             <script>
                                                                 $("#startCmd<?php echo e($cmd->id); ?>,#startCmd1<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     let arr = []

                                                                     axios.post("/commande/statut", {
                                                                             "_token": "<?php echo e(csrf_token()); ?>",
                                                                             user_id: "<?php echo e($cmd->user_id); ?>",
                                                                             resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                             ref: "<?php echo e($cmd->reference); ?>",
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
                                                         <?php break; ?>

                                                         <?php case (2): ?>
                                                             <a href="#!" id="completeCmd<?php echo e($cmd->id); ?>"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-check"></i></a>
                                                             <script>
                                                                 $("#completeCmd<?php echo e($cmd->id); ?>,#completeCmd1<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                     e.preventDefault()
                                                                     axios.post("/commande/statut", {
                                                                             "_token": "<?php echo e(csrf_token()); ?>",
                                                                             user_id: "<?php echo e($cmd->user_id); ?>",
                                                                             resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                             ref: "<?php echo e($cmd->reference); ?>",

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
                                                         <?php break; ?>

                                                         <?php default: ?>
                                                     <?php endswitch; ?>
                                                 <?php else: ?>
                                                     -
                                                 <?php endif; ?>
                                             </td>
                                             <td class="d-lg-none">
                                                 <a href="#!" id="details<?php echo e($cmd->id); ?>"
                                                     class="btn shadow-none text-danger" data-bs-toggle="modal"
                                                     data-bs-target="#DetailsModal<?php echo e($cmd->id); ?>"><i
                                                         class="fas fa-eye"></i></a>
                                             </td>
                                         </tr>


                                         <div class="modal fade" id="DetailsModal<?php echo e($cmd->id); ?>"
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
                                                                 <strong>#<?php echo e($cmd->reference); ?></strong>
                                                             </h6>
                                                             <?php if(Auth::user()->user_id != $cmd->resto->user_id): ?>
                                                                 <div
                                                                     class="row flex-column justify-content-start align-items-center">
                                                                     <div class="col mb">
                                                                         <label class="">Restaurant:</label>
                                                                         <strong>
                                                                             <a
                                                                                 href="<?php echo e(url('/resto/' . $cmd->resto->user_id)); ?>">
                                                                                 <?php echo e($cmd->resto->name); ?>


                                                                             </a>

                                                                         </strong>



                                                                     </div>
                                                                     <div class="col mb-2">
                                                                         <span>N° Restaurant: <strong>
                                                                                 <a
                                                                                     href="tel:+216<?php echo e($cmd->resto->phone); ?>">
                                                                                     <?php echo e($cmd->resto->phone); ?>


                                                                                 </a>

                                                                             </strong></span>



                                                                     </div>
                                                             <?php endif; ?>
                                                             <div class="col mb-2">
                                                                 <span>Date : <strong
                                                                         id="dateTelff<?php echo e($cmd->id); ?>">


                                                                     </strong></span>
                                                                 <script>
                                                                     $('#dateTelff<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format('LL | LT'))
                                                                 </script>


                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Livreur : <strong>
                                                                         <?php if($cmd->taken): ?>
                                                                             <?php echo e($cmd->deliverer->name); ?>

                                                                         <?php else: ?>
                                                                             <span class="text-warning">
                                                                                 en attente de livreur

                                                                             </span>
                                                                         <?php endif; ?>


                                                                     </strong></span>



                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span class="fw-bold">Produits/Message:</span>

                                                                 <?php if($cmd->is_message): ?>
                                                                     <p class="text-center">
                                                                         <?php echo e($cmd->messages[0]->message); ?></p>
                                                                 <?php else: ?>
                                                                     <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                         <div class="accordion bg-transparent accordion-flush mx-auto"style="max-width: 200px !important;word-wrap: break-word;background:transparent !important"
                                                                             id="accordionExample<?php echo e($command->id); ?>">
                                                                             <div class="accordion-item">
                                                                                 <h2 class="accordion-header"
                                                                                     id="pr<?php echo e($command->id); ?>">
                                                                                     <button
                                                                                         class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2 text-nowrap"
                                                                                         style="background: transparent !important"
                                                                                         type="button"
                                                                                         data-bs-toggle="collapse"
                                                                                         data-bs-target="#product<?php echo e($command->id); ?>"
                                                                                         aria-expanded="true"
                                                                                         aria-controls="collapseOne">
                                                                                         <?php echo e($command->product->label); ?>

                                                                                         (<?php echo e($command->quantity); ?>)
                                                                                     </button>
                                                                                 </h2>
                                                                                 <div id="product<?php echo e($command->id); ?>"
                                                                                     class="accordion-collapse collapse "
                                                                                     aria-labelledby=""
                                                                                     data-bs-parent="#accordionExample<?php echo e($command->id); ?>"
                                                                                     style="max-width: 200px !important;word-wrap: break-word">
                                                                                     <div class="accordion-body h-100">
                                                                                         <span
                                                                                             class="text-muted fw-bold">Totale:
                                                                                         </span>
                                                                                         <?php echo e($command->total); ?> DT
                                                                                         <br>

                                                                                         <?php if($command->garnitures != ''): ?>
                                                                                             <span
                                                                                                 class="text-muted fw-bold">Garnitures:
                                                                                             </span>
                                                                                             <?php
                                                                                                 $toppings = json_decode($command->garnitures);
                                                                                                 
                                                                                             ?>
                                                                                             <?php $__currentLoopData = $toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                 <?php
                                                                                                     $topp = Garniture::where('id', $topping)->first();
                                                                                                 ?>
                                                                                                 <?php echo e($topp->label); ?>,
                                                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                             <br>
                                                                                         <?php endif; ?>
                                                                                         <?php if($command->supplements != ''): ?>
                                                                                             <span
                                                                                                 class="text-muted fw-bold">Suppléments:
                                                                                             </span>
                                                                                             <?php
                                                                                                 $supplements = json_decode($command->supplements);
                                                                                                 
                                                                                             ?>
                                                                                             <?php $__currentLoopData = $supplements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                 <?php
                                                                                                     $sp = Supplement::where('id', $supplement)->first();
                                                                                                 ?>
                                                                                                 <?php echo e($sp->label); ?>,
                                                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                             <br>
                                                                                             <?php if($command->sauces != ''): ?>
                                                                                                 <span
                                                                                                     class="text-muted fw-bold">Sauces:
                                                                                                 </span>
                                                                                                 <?php
                                                                                                     $sauces = json_decode($command->sauces);
                                                                                                     
                                                                                                 ?>
                                                                                                 <?php $__currentLoopData = $sauces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sauce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                     <?php
                                                                                                         $sc = Sauce::where('id', $sauce)->first();
                                                                                                     ?>
                                                                                                     <?php echo e($sc->label); ?>,
                                                                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                 <br>
                                                                                             <?php endif; ?>
                                                                                         <?php endif; ?>

                                                                                         <?php if($command->drinks != ''): ?>
                                                                                             <span
                                                                                                 class="text-muted fw-bold">Boissons:
                                                                                             </span>
                                                                                             <?php
                                                                                                 $drinks = json_decode($command->drinks);
                                                                                                 
                                                                                             ?>
                                                                                             <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                 <?php
                                                                                                     $dr = Drink::where('id', $drink)->first();
                                                                                                 ?>
                                                                                                 <?php echo e($dr->label); ?>,
                                                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                             <br>
                                                                                         <?php endif; ?>

                                                                                     </div>
                                                                                 </div>

                                                                             </div>
                                                                         </div>
                                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                 <?php endif; ?>


                                                             </div>
                                                             <div class="col mb-2">
                                                                 <span>Total : <strong>
                                                                         <?php if($cmd->is_message): ?>
                                                                             Livraison :
                                                                             <?php echo e($cmd->user->region->deliveryPrice); ?>

                                                                             TND
                                                                         <?php else: ?>
                                                                             <?php echo e($total); ?>

                                                                             TND
                                                                         <?php endif; ?>


                                                                     </strong></span>



                                                             </div>
                                                             <?php if($cmd->statut != 5): ?>
                                                                 <?php switch($cmd->statut):
                                                                     case (1): ?>
                                                                         <button href="#!"
                                                                             id="startCmd1<?php echo e($cmd->id); ?>"
                                                                             class="btn-success shadow-none text-white w-75 rounded-pill shadow-none border-0 p-2 mb-2"><i
                                                                                 class="fas fa-play"></i>
                                                                             Confirmer</button>
                                                                         
                                                                     <?php break; ?>

                                                                     <?php case (2): ?>
                                                                         <button href="#!"
                                                                             id="completeCmd1<?php echo e($cmd->id); ?>"
                                                                             class="btn-success shadow-none text-white w-75 rounded-pill shadow-none border-0 p-2"><i
                                                                                 class="fas fa-check"></i>Terminer</button>
                                                                         
                                                                     <?php break; ?>

                                                                     <?php default: ?>
                                                                 <?php endswitch; ?>
                                                             <?php endif; ?>
                                                             <?php if($cmd->statut == 1): ?>
                                                                 <button
                                                                     class="btn-danger shadow-none text-white  rounded-pill shadow-none border-0 p-2 w-75"
                                                                     id="cancel1<?php echo e($cmd->id); ?>">Annuler</button>
                                                                 <script>
                                                                     $("#cancel1<?php echo e($cmd->id); ?>,#cancel<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                         e.preventDefault()
                                                                         alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette commande ?", () => {
                                                                             axios.post("/commande/statut", {
                                                                                     "_token": "<?php echo e(csrf_token()); ?>",
                                                                                     user_id: "<?php echo e($cmd->user_id); ?>",
                                                                                     resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                                     ref: "<?php echo e($cmd->reference); ?>",
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
                                                             <?php else: ?>
                                                                 <span class="text-danger">Non annulable</span>
                                                             <?php endif; ?>

                                                         </div>



                                                     </div>

                                                 </div>
                                             </div>

                                         </div>
                     </div>

                     <script>
                         $('#DetailsModal<?php echo e($cmd->id); ?>').appendTo("body")
                     </script>
                     <?php
                         $total = 0;
                     ?>
 <?php endif; ?>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
     <?php endif; ?>



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
                             <?php
                                 $cmdsMsg = commande_ref::where('resto_id', Auth::user()->user_id)
                                     ->where('statut', '!=', 5)
                                     ->where('is_message', 1)
                                     ->with('items')
                                     ->orderBy('statut', 'asc')
                                     ->get();
                                 
                             ?>
                             <?php $__empty_1 = true; $__currentLoopData = $cmdsMsg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                 <?php if($cmd->is_message): ?>
                                     <?php
                                         $total = 0;
                                     ?>
                                     <tr>
                                         <td>
                                             <strong>#<?php echo e($cmd->reference); ?></strong>
                                         </td>
                                         <td>
                                             <div class="d-flex align-items-center">
                                                 <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">
                                                         <img src="<?php echo e(asset('uploads/logos/' . $cmd->user->avatar)); ?>"
                                                             alt="" class="img-fluid " width="80px">
                                                     </a>
                                                 </div>
                                                 <div class="">
                                                     <h4 class="m-b-0 font-16"><?php echo e($cmd->user->name); ?></h4>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>


                                             <?php echo e($cmd->messages[0]->message); ?>

                                         </td>
                                         <td><a href="tel:<?php echo e($cmd->user->phone); ?>"><?php echo e($cmd->user->phone); ?></a>
                                         </td>
                                         <td id="Demandedatepass<?php echo e($cmd->id); ?>"></td>
                                         <script>
                                             $('#Demandedatepass<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format("LL | LT"))
                                         </script>
                                         <td>
                                             <?php switch($cmd->statut):
                                                 case (1): ?>
                                                     <label class="badge bg-warning">En attente</label>
                                                 <?php break; ?>

                                                 <?php case (2): ?>
                                                     <label class="badge bg-info">Traitement</label>
                                                 <?php break; ?>

                                                 <?php case (3): ?>
                                                     <label class="badge bg-primary">Prêt</label>
                                                 <?php break; ?>

                                                 <?php case (4): ?>
                                                     <label class="badge bg-warning">En livraison</label>
                                                 <?php break; ?>

                                                 <?php case (5): ?>
                                                     <label class="badge bg-success">Livrée

                                                     </label>
                                                 <?php break; ?>

                                                 <?php case (6): ?>
                                                     <label class="badge bg-danger">Annulée</label>
                                                 <?php break; ?>

                                                 <?php default: ?>
                                             <?php endswitch; ?>
                                         </td>
                                         <td><?php echo e($cmd->deliverer_id == null ? '' : $cmd->deliverer->name); ?></td>
                                         <td>
                                             <?php if($cmd->statut != 5): ?>
                                                 <?php switch($cmd->statut):
                                                     case (1): ?>
                                                         <a href="#!" id="startCmd<?php echo e($cmd->id); ?>"
                                                             class="btn shadow-none text-success"><i class="fas fa-play"></i></a>
                                                         <script>
                                                             $("#startCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                 e.preventDefault()
                                                                 let arr = []

                                                                 axios.post("/commande/statut", {
                                                                         "_token": "<?php echo e(csrf_token()); ?>",
                                                                         user_id: "<?php echo e($cmd->user_id); ?>",
                                                                         resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                         ref: "<?php echo e($cmd->reference); ?>",

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
                                                     <?php break; ?>

                                                     <?php case (2): ?>
                                                         <a href="#!" id="completeCmd<?php echo e($cmd->id); ?>"
                                                             class="btn shadow-none text-success"><i class="fas fa-check"></i></a>
                                                         <script>
                                                             $("#completeCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                 e.preventDefault()
                                                                 axios.post("/commande/statut", {
                                                                         "_token": "<?php echo e(csrf_token()); ?>",
                                                                         user_id: "<?php echo e($cmd->user_id); ?>",
                                                                         resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                         ref: "<?php echo e($cmd->reference); ?>",

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
                                                     <?php break; ?>

                                                     <?php default: ?>
                                                 <?php endswitch; ?>


                                                 <a href="#!" id="deleteCmd<?php echo e($cmd->id); ?>"
                                                     class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                                             <?php else: ?>
                                                 -
                                             <?php endif; ?>
                                         </td>
                                     </tr>

                                     <?php
                                         $total = 0;
                                     ?>
                                 <?php endif; ?>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                 <?php endif; ?>



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
                                 <?php
                                     
                                     $requests = RequestResto::where('resto_id', Auth::user()->user_id)->get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <tr>
                                         <td id="datePassDemande<?php echo e($cmd->id); ?>"></td>
                                         <script>
                                             $('#datePassDemande<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format("LL | LT"))
                                         </script>

                                         <td>
                                             <?php switch($cmd->statut):
                                                 case (1): ?>
                                                     <label class="badge bg-warning">En attente</label>
                                                 <?php break; ?>

                                                 <?php case (2): ?>
                                                     <label class="badge bg-success">Acceptée</label>
                                                 <?php break; ?>

                                                 <?php case (3): ?>
                                                     <label class="badge bg-danger">Annulée</label>
                                                 <?php break; ?>

                                                 <?php default: ?>
                                             <?php endswitch; ?>
                                         </td>
                                         <td>
                                             <?php if($cmd->deliverer_id == null): ?>
                                                 -
                                             <?php else: ?>
                                                 <?php echo e($cmd->deliverer->name); ?>

                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <?php if($cmd->deliverer_id == null): ?>
                                                 -
                                             <?php else: ?>
                                                 <?php echo e($cmd->deliverer->phone); ?>

                                             <?php endif; ?>
                                         </td>


                                         <td>
                                             <a href="#!" id="cancelreq<?php echo e($cmd->id); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                                             <script>
                                                 $("#cancelreq<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                     e.preventDefault()
                                                     alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette demande  ?", () => {
                                                         axios.post("/request/cancel", {
                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                 resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                 req_id: "<?php echo e($cmd->id); ?>",
                                                                 ref: "<?php echo e($cmd->reference); ?>",

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

                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                     <?php endif; ?>



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
             <?php endif; ?>
             <?php if(Auth::user()->type == 3): ?>
                 <div class="row">
                     <!-- column -->
                     <div class="col-12" id="commandes">
                         <div class="card">
                             <div class="card-body">
                                 <!-- title -->
                                 <div class="d-md-flex">
                                     <div>
                                         <h4 class="card-title">Vos commandes acceptées</h4>
                                         
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
                                                 <th class="border-top-0 d-none d-lg-table-cell">Frais de livraison</th>
                                                 <th class="border-top-0 d-none d-lg-table-cell">Total (compris les frais)</th>
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
                                             <?php
                                                 $me = User::where('user_id', Auth::user()->user_id)
                                                     ->with('commandesReceived')
                                                     ->get();
                                                 $commandes = commande_ref::where('deliverer_id', Auth::user()->user_id)
                                                     ->where('statut', '!=', 5)
                                                     ->get();
                                                 
                                             ?>
                                             <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                 <?php
                                                     $total = 0;
                                                 ?>
                                                 <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php
                                                         $total += $passed->total;
                                                     ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <tr>
                                                     <td class="d-none d-lg-table-cell">
                                                         <strong>#<?php echo e($cmd->reference); ?> </strong>

                                                     </td>
                                                     <td class="d-none d-lg-table-cell">
                                                         <div class="d-flex align-items-center">
                                                             <div class="m-r-10"><a
                                                                     class="btn btn-circle d-flex btn-info text-white">
                                                                     <img src="<?php echo e(asset('uploads/logos/' . $cmd->resto->avatar)); ?>"
                                                                         alt="" class="img-fluid " width="80px">
                                                                 </a>
                                                             </div>
                                                             <div class="">
                                                                 <h4 class="m-b-0 font-16"><?php echo e($cmd->resto->name); ?></h4>
                                                                 <small>Tel : <a
                                                                         href="tel:<?php echo e($cmd->resto->phone); ?>"><?php echo e($cmd->resto->phone); ?></a>
                                                                 </small>
                                                                 <br>
                                                                 <small>Adresse :
                                                                     <?php echo e($cmd->resto->address == '' ? 'N\A' : $cmd->resto->address); ?>

                                                                 </small>
                                                             </div>
                                                         </div>

                                                     </td>
                                                     <td>
                                                         <div class="d-flex align-items-center">
                                                             <div class="m-r-10"><a
                                                                     class="btn btn-circle d-flex btn-info text-white">
                                                                     <img src="<?php echo e(asset('uploads/logos/' . $cmd->user->avatar)); ?>"
                                                                         alt="" class="img-fluid " width="80px">
                                                                 </a>
                                                             </div>
                                                             <div class="">
                                                                 <h4 class="m-b-0 font-16"><?php echo e($cmd->user->name); ?></h4>
                                                                 <small>Tel : <a
                                                                         href="tel:<?php echo e($cmd->user->phone); ?>"><?php echo e($cmd->user->phone); ?></a>
                                                                 </small>
                                                                 <br>
                                                                 <small>Adresse :
                                                                     <?php echo e($cmd->address == '' ? 'N\A' : $cmd->address); ?>

                                                                 </small>

                                                             </div>
                                                         </div>
                                                     </td>


                                                     <td class="d-none d-lg-table-cell" id="datepass<?php echo e($cmd->id); ?>">
                                                     </td>
                                                     <script>
                                                         $('#datepass<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format("LL | LT"))
                                                     </script>
                                                     <td>
                                                         <?php switch($cmd->statut):
                                                             case (1): ?>
                                                                 <label class="badge bg-warning">En attente</label>
                                                             <?php break; ?>

                                                             <?php case (2): ?>
                                                                 <label class="badge bg-info">Traitement</label>
                                                             <?php break; ?>

                                                             <?php case (3): ?>
                                                                 <label class="badge bg-primary">Prêt</label>
                                                             <?php break; ?>

                                                             <?php case (4): ?>
                                                                 <label class="badge bg-warning">En livraison</label>
                                                             <?php break; ?>

                                                             <?php case (5): ?>
                                                                 <label class="badge bg-success">Livrée</label>
                                                             <?php break; ?>

                                                             <?php case (6): ?>
                                                                 <label class="badge bg-danger">Annulée</label>
                                                             <?php break; ?>

                                                             <?php default: ?>
                                                         <?php endswitch; ?>
                                                     </td>
                                                     <td class="d-none d-lg-table-cell">
                                                         <?php echo e($cmd->frais); ?> TND
                                                     </td>
                                                     <td class="d-none d-lg-table-cell">
                                                         <?php echo e($cmd->total + $cmd->frais); ?> TND
                                                     </td>

                                                     <td class="d-none d-lg-table-cell">
                                                         <?php if(!Auth::user()->onDuty): ?>
                                                             Vous êtes hors service
                                                         <?php else: ?>
                                                             <?php if(!$cmd->taken): ?>
                                                             <?php else: ?>
                                                                 <?php if($cmd->taken && $cmd->deliverer_id == Auth::user()->user_id): ?>
                                                                     <?php if($cmd->statut == 4): ?>
                                                                         <a href="#!" id="completeCmd<?php echo e($cmd->id); ?>"
                                                                             class="btn shadow-none text-success"><i
                                                                                 class="fas fa-check"></i></a>
                                                                         <script>
                                                                             $("#completeCmd<?php echo e($cmd->id); ?>,#completeCmdModal<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                 e.preventDefault()
                                                                                 axios.post("/commande/statut", {
                                                                                         "_token": "<?php echo e(csrf_token()); ?>",
                                                                                         user_id: "<?php echo e($cmd->user_id); ?>",
                                                                                         resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                                         ref: "<?php echo e($cmd->reference); ?>",

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
                                                                     <?php endif; ?>



                                                                     <a href="#!" id="cancelCmd<?php echo e($cmd->id); ?>"
                                                                         class="btn shadow-none text-danger"><i
                                                                             class="fas fa-times"></i></a>
                                                                     <script>
                                                                         $("#cancelCmd<?php echo e($cmd->id); ?>,#cancelCmdModal<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                             e.preventDefault()
                                                                             alertify.confirm("Confirmation", "Annule la livraison ?", () => {
                                                                                 axios.post("/commande/statut", {
                                                                                         "_token": "<?php echo e(csrf_token()); ?>",
                                                                                         user_id: "<?php echo e($cmd->user_id); ?>",
                                                                                         resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                                         ref: "<?php echo e($cmd->reference); ?>",

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
                                                                 <?php else: ?>
                                                                     -
                                                                 <?php endif; ?>
                                                             <?php endif; ?>
                                                         <?php endif; ?>
                                                     </td>
                                                     <td class="d-lg-none">
                                                         <a href="#!" id="seeDetails<?php echo e($cmd->id); ?>"
                                                             data-bs-toggle="modal"
                                                             data-bs-target="#DetaildLivAccepted<?php echo e($cmd->id); ?>"
                                                             class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                                     </td>
                                                 </tr>
                                                 <div class="modal fade" id="DetaildLivAccepted<?php echo e($cmd->id); ?>"
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
                                                                         <strong><?php echo e($cmd->reference); ?></strong>
                                                                     </h6>
                                                                     <div
                                                                         class="row flex-column justify-content-start align-items-center">
                                                                         <div class="col mb">
                                                                             <label class="">Restaurant:</label>
                                                                             <span><?php echo e($cmd->resto->name); ?></span>




                                                                         </div>
                                                                         <div class="col mb-2">
                                                                             <span>N° Restaurant: <strong>
                                                                                     <a href="tel:<?php echo e($cmd->resto->phone); ?>">
                                                                                         <?php echo e($cmd->resto->phone); ?>


                                                                                     </a>

                                                                                 </strong></span>



                                                                         </div>
                                                                         <div class="col mb-2">
                                                                             <span>Date :
                                                                                 <strong id="datepassLivr<?php echo e($cmd->id); ?>">


                                                                                 </strong>
                                                                             </span>
                                                                             <script>
                                                                                 $('#datepassLivr<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format('LL | LT'))
                                                                             </script>


                                                                         </div>

                                                                         <div class="col mb-2">
                                                                             <span>Frais de livraison: <strong>
                                                                                     <?php echo e($cmd->frais); ?> TND

                                                                                 </strong></span>



                                                                         </div>
                                                                         <div class="col mb-2">
                                                                             <span>Total (compris les frais): <strong>
                                                                                     <?php echo e($cmd->total + $cmd->frais); ?> TND

                                                                                 </strong></span>



                                                                         </div>


                                                                         <?php if($cmd->statut == 4): ?>
                                                                             <button
                                                                                 class="btn-outline btn-success  mb-2 rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                                 id="completeCmdModal<?php echo e($cmd->id); ?>">Terminé</button>
                                                                         <?php endif; ?>

                                                                         <button
                                                                             class="btn-outline btn-danger mb-2 rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                             id="cancelCmdModal<?php echo e($cmd->id); ?>">Annuler la
                                                                             livraison</button>
                                                                         


                                                                     </div>



                                                                 </div>

                                                             </div>
                                                         </div>

                                                     </div>
                                                 </div>
                                                 <?php
                                                     $total = 0;
                                                 ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                 <?php endif; ?>



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
                                                     <th class="border-top-0 d-none d-lg-table-cell">Frais de livraison</th>
                                                     <th class="border-top-0 d-none d-lg-table-cell">Total (compris les frais)</th>
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
                                                 <?php
                                                     $me = User::where('user_id', Auth::user()->user_id)
                                                         ->with('commandesReceived')
                                                         ->get();
                                                     $commandes = commande_ref::where('statut', '!=', 6)
                                                         ->where('taken', 0)
                                                         ->where('statut', '!=', 5)
                                                         ->get();
                                                     
                                                 ?>
                                                 <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                     <?php
                                                         $total = 0;
                                                     ?>
                                                     <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         <?php
                                                             $total += $passed->total;
                                                         ?>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     <tr>
                                                         <td class="d-none d-lg-table-cell">
                                                             <strong>#<?php echo e($cmd->reference); ?> </strong>

                                                         </td>
                                                         <td class="d-none d-lg-table-cell">
                                                             <div class="d-flex align-items-center">
                                                                 <div class="m-r-10"><a
                                                                         class="btn btn-circle d-flex btn-info text-white">
                                                                         <img src="<?php echo e(asset('uploads/logos/' . $cmd->resto->avatar)); ?>"
                                                                             alt="" class="img-fluid " width="80px">
                                                                     </a>
                                                                 </div>
                                                                 <div class="">
                                                                     <h4 class="m-b-0 font-16"><?php echo e($cmd->resto->name); ?></h4>
                                                                     <small>Tel : <a
                                                                             href="tel:<?php echo e($cmd->resto->phone); ?>"><?php echo e($cmd->resto->phone); ?></a>
                                                                     </small>
                                                                     <br>
                                                                     <small>Adresse :
                                                                         <?php echo e($cmd->resto->address == '' ? 'N\A' : $cmd->resto->address); ?>

                                                                     </small>
                                                                 </div>
                                                             </div>

                                                         </td>
                                                         <td>
                                                             <div class="d-flex align-items-center">
                                                                 <div class="m-r-10"><a
                                                                         class="btn btn-circle d-flex btn-info text-white">
                                                                         <img src="<?php echo e(asset('uploads/logos/' . $cmd->user->avatar)); ?>"
                                                                             alt="" class="img-fluid " width="80px">
                                                                     </a>
                                                                 </div>
                                                                 <div class="">
                                                                     <h4 class="m-b-0 font-16"><?php echo e($cmd->user->name); ?></h4>
                                                                     <small>Tel : <a
                                                                             href="tel:<?php echo e($cmd->user->phone); ?>"><?php echo e($cmd->user->phone); ?></a>
                                                                     </small>
                                                                     <br>
                                                                     <small>Adresse :
                                                                         <?php echo e($cmd->address == '' ? 'N\A' : $cmd->address); ?>

                                                                     </small>

                                                                 </div>
                                                             </div>
                                                         </td>


                                                         <td class="d-none d-lg-table-cell" id="datepass<?php echo e($cmd->id); ?>">
                                                         </td>
                                                         <script>
                                                             $('#datepass<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format("LL | LT"))
                                                         </script>
                                                         <td>
                                                             <?php switch($cmd->statut):
                                                                 case (1): ?>
                                                                     <label class="badge bg-warning">En attente</label>
                                                                 <?php break; ?>

                                                                 <?php case (2): ?>
                                                                     <label class="badge bg-info">Traitement</label>
                                                                 <?php break; ?>

                                                                 <?php case (3): ?>
                                                                     <label class="badge bg-primary">Prêt</label>
                                                                 <?php break; ?>

                                                                 <?php case (4): ?>
                                                                     <label class="badge bg-warning">En livraison</label>
                                                                 <?php break; ?>

                                                                 <?php case (5): ?>
                                                                     <label class="badge bg-success">Livrée</label>
                                                                 <?php break; ?>

                                                                 <?php case (6): ?>
                                                                     <label class="badge bg-danger">Annulée</label>
                                                                 <?php break; ?>

                                                                 <?php default: ?>
                                                             <?php endswitch; ?>
                                                         </td>
                                                         <td class="d-none d-lg-table-cell">
                                                             <?php echo e($cmd->frais); ?> TND
                                                         </td>
                                                         <td class="d-none d-lg-table-cell">
                                                             <?php echo e($cmd->total + $cmd->frais); ?> TND
                                                         </td>
                                                         <td class="d-none d-lg-table-cell">
                                                             <?php if(!Auth::user()->onDuty): ?>
                                                                 Vous êtes hors service
                                                             <?php else: ?>
                                                                 <?php if(!$cmd->taken): ?>
                                                                     <a href="#!" id="startCmd<?php echo e($cmd->id); ?>"
                                                                         class="btn shadow-none text-success"><i
                                                                             class="fas fa-play"></i></a>
                                                                     <script>
                                                                         $("#startCmd<?php echo e($cmd->id); ?>,#startCmd1<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                             e.preventDefault()
                                                                             let arr = []

                                                                             axios.post("/commande/statut", {
                                                                                     "_token": "<?php echo e(csrf_token()); ?>",
                                                                                     req_id: "<?php echo e($cmd->id); ?>",
                                                                                     user_id: "<?php echo e($cmd->user_id); ?>",
                                                                                     resto_id: "<?php echo e($cmd->resto_id); ?>",
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
                                                                 <?php else: ?>
                                                                     <a href="#!" id="cancelCmd<?php echo e($cmd->id); ?>"
                                                                         class="btn shadow-none text-danger"><i
                                                                             class="fas fa-times"></i></a>
                                                                 <?php endif; ?>
                                                             <?php endif; ?>
                                                         </td>
                                                         <td class="d-lg-none">
                                                             <a href="#!" id="seeDetails<?php echo e($cmd->id); ?>"
                                                                 data-bs-toggle="modal"
                                                                 data-bs-target="#DetaildLiv<?php echo e($cmd->id); ?>"
                                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                                         </td>
                                                     </tr>
                                                     <div class="modal fade" id="DetaildLiv<?php echo e($cmd->id); ?>"
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
                                                                             <strong><?php echo e($cmd->reference); ?></strong>
                                                                         </h6>
                                                                         <div
                                                                             class="row flex-column justify-content-start align-items-center">
                                                                             <div class="col mb">
                                                                                 <label class="">Restaurant:</label>
                                                                                 <span><?php echo e($cmd->resto->name); ?></span>




                                                                             </div>
                                                                             <div class="col mb-2">
                                                                                 <span>N° Restaurant: <strong>
                                                                                         <a href="tel:<?php echo e($cmd->resto->phone); ?>">
                                                                                             <?php echo e($cmd->resto->phone); ?>


                                                                                         </a>

                                                                                     </strong></span>



                                                                             </div>
                                                                             <div class="col mb-2">
                                                                                 <span>Date :
                                                                                     <strong id="datepassLivr<?php echo e($cmd->id); ?>">


                                                                                     </strong>
                                                                                 </span>
                                                                                 <script>
                                                                                     $('#datepassLivr<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format('LL | LT'))
                                                                                 </script>


                                                                             </div>
                                                                             <div class="col mb-2">
                                                                                 <span>Frais de livraison: <strong>
                                                                                         <?php echo e($cmd->frais); ?> TND

                                                                                     </strong></span>



                                                                             </div>

                                                                             <div class="col mb-2">
                                                                                 <span>Total (compris frais de livraison): <strong>
                                                                                         <?php echo e($cmd->total + $cmd->frais); ?> TND

                                                                                     </strong></span>



                                                                             </div>



                                                                             <button
                                                                                 class="btn-outline btn-success rounded-pill p-2 shadow-none text-white border-0 w-75"
                                                                                 id="startCmd1<?php echo e($cmd->id); ?>">Accepter</button>



                                                                         </div>



                                                                     </div>

                                                                 </div>
                                                             </div>

                                                         </div>
                                                     </div>
                                                     <?php
                                                         $total = 0;
                                                     ?>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                     <?php endif; ?>



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
                                                     <?php
                                                         
                                                         $requests = RequestResto::get();
                                                         
                                                     ?>
                                                     <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                         <tr>
                                                             <td>
                                                                 <div class="d-flex align-items-center">
                                                                     <div class="m-r-10"><a
                                                                             class="btn btn-circle d-flex btn-info text-white">
                                                                             <img src="<?php echo e(asset('uploads/logos/' . $cmd->resto->avatar)); ?>"
                                                                                 alt="" class="img-fluid " width="80px">
                                                                         </a>
                                                                     </div>
                                                                     <div class="">
                                                                         <h4 class="m-b-0 font-16"><?php echo e($cmd->resto->name); ?></h4>
                                                                     </div>
                                                                 </div>
                                                             </td>
                                                             <td>
                                                                 <?php echo e($cmd->resto->phone); ?>

                                                             </td>
                                                             <td>
                                                                 <?php switch($cmd->statut):
                                                                     case (1): ?>
                                                                         <label class="badge bg-warning">En attente</label>
                                                                     <?php break; ?>

                                                                     <?php case (2): ?>
                                                                         <label class="badge bg-success">Acceptée</label>
                                                                     <?php break; ?>

                                                                     <?php case (3): ?>
                                                                         <label class="badge bg-danger">Annulée</label>
                                                                     <?php break; ?>

                                                                     <?php default: ?>
                                                                 <?php endswitch; ?>
                                                             </td>
                                                             <td><?php echo e(date('l \t\h\e jS | H:i a', strtotime($cmd->created_at))); ?></td>

                                                             <td>
                                                                 <?php if(!Auth::user()->onDuty): ?>
                                                                     Vous êtes hors service
                                                                 <?php else: ?>
                                                                     <?php if($cmd->deliverer_id == null): ?>
                                                                         <a href="#!" id="acceptReq<?php echo e($cmd->id); ?>"
                                                                             class="btn shadow-none text-success"><i
                                                                                 class="fas fa-play"></i></a>
                                                                         <script>
                                                                             $("#acceptReq<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                 e.preventDefault()

                                                                                 axios.post("/request/accept", {
                                                                                         "_token": "<?php echo e(csrf_token()); ?>",
                                                                                         resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                                         req_id: "<?php echo e($cmd->id); ?>",
                                                                                         ref: "<?php echo e($cmd->reference); ?>",

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
                                                                     <?php else: ?>
                                                                         <?php if($cmd->statut == 2 && $cmd->deliverer_id == Auth::user()->user_id): ?>
                                                                             <a href="#!" id="cancelreq<?php echo e($cmd->id); ?>"
                                                                                 class="btn shadow-none text-danger"><i
                                                                                     class="fas fa-times"></i></a>
                                                                             <script>
                                                                                 $("#cancelreq<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                     e.preventDefault()
                                                                                     alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette demande  ?", () => {
                                                                                         axios.post("/request/cancel", {
                                                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                                                 resto_id: "<?php echo e($cmd->resto_id); ?>",
                                                                                                 req_id: "<?php echo e($cmd->id); ?>",
                                                                                                 ref: "<?php echo e($cmd->reference); ?>",

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
                                                                         <?php else: ?>
                                                                             -
                                                                         <?php endif; ?>
                                                                     <?php endif; ?>
                                                                 <?php endif; ?>
                                                             </td>
                                                         </tr>

                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                         <?php endif; ?>



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
                                                         <?php
                                                             
                                                             $requests = OtherCommande::with('user')->get();
                                                             
                                                         ?>
                                                         <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                             <tr>
                                                                 <td>
                                                                     <div class="d-flex align-items-center">
                                                                         <div class="m-r-10"><a
                                                                                 class="btn btn-circle d-flex btn-info text-white">
                                                                                 <img src="<?php echo e(asset('uploads/logos/' . $cmd->user->avatar)); ?>"
                                                                                     alt="" class="img-fluid " width="80px">
                                                                             </a>
                                                                         </div>
                                                                         <div class="">
                                                                             <h4 class="m-b-0 font-16"><?php echo e($cmd->user->name); ?>


                                                                                 <br>
                                                                                 <small>N° Téléphone : <a
                                                                                         href="tel:<?php echo e($cmd->user->phone); ?>"><?php echo e($cmd->user->phone); ?></a></small>
                                                                                 <br>
                                                                                 <small>Adresse :
                                                                                     <strong><?php echo e($cmd->user->address == '' ? 'N/A' : $cmd->user->address); ?></strong>
                                                                                 </small>


                                                                             </h4>
                                                                         </div>
                                                                     </div>
                                                                 </td>
                                                                 <td>
                                                                     <?php echo e($cmd->message); ?>

                                                                 </td>
                                                                 <td>
                                                                     <?php if($cmd->picture != ''): ?>
                                                                         <img class="img-fluit " width="50px"
                                                                             src="<?php echo e(asset('uploads/commandes/' . $cmd->picture)); ?>"
                                                                             alt="image ">
                                                                     <?php else: ?>
                                                                         -
                                                                     <?php endif; ?>
                                                                 </td>
                                                                 <td>
                                                                     <?php echo e($cmd->frais); ?> TND

                                                                 </td>
                                                                 <td>
                                                                     <?php switch($cmd->statut):
                                                                         case (1): ?>
                                                                             <label class="badge bg-warning">En attente</label>
                                                                         <?php break; ?>

                                                                         <?php case (2): ?>
                                                                             <label class="badge bg-info">Acceptée</label>
                                                                         <?php break; ?>

                                                                         <?php case (3): ?>
                                                                             <label class="badge bg-success">Livrée</label>
                                                                         <?php break; ?>

                                                                         <?php default: ?>
                                                                     <?php endswitch; ?>
                                                                 </td>
                                                                 <td>
                                                                     <?php echo e(Carbon::parse($cmd->created_at)->translatedFormat(' j F Y | H:i')); ?>

                                                                     

                                                                 <td>
                                                                     <?php if(!Auth::user()->onDuty): ?>
                                                                         Vous êtes hors service
                                                                     <?php else: ?>
                                                                         <?php if($cmd->deliverer_id == null): ?>
                                                                             <a href="#!" id="acceptCmdOther<?php echo e($cmd->id); ?>"
                                                                                 class="btn shadow-none text-success"><i
                                                                                     class="fas fa-play"></i></a>
                                                                             <script>
                                                                                 $("#acceptCmdOther<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                     e.preventDefault()

                                                                                     axios.post("/otherCommande/accept", {
                                                                                             "_token": "<?php echo e(csrf_token()); ?>",
                                                                                             "id": "<?php echo e($cmd->id); ?>"

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
                                                                         <?php else: ?>
                                                                             <?php if($cmd->statut == 2 && $cmd->deliverer_id == Auth::user()->user_id): ?>
                                                                                 <a href="#!"
                                                                                     id="termineDemandeOther<?php echo e($cmd->id); ?>"
                                                                                     class="btn shadow-none text-success"><i
                                                                                         class="fas fa-check"></i></a>
                                                                                 <a href="#!"
                                                                                     id="cancelDemandeOther<?php echo e($cmd->id); ?>"
                                                                                     class="btn shadow-none text-danger"><i
                                                                                         class="fas fa-times"></i></a>
                                                                                 <script>
                                                                                     $("#termineDemandeOther<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                         e.preventDefault()
                                                                                         axios.post("/otherCommande/termine", {
                                                                                                 "_token": "<?php echo e(csrf_token()); ?>",
                                                                                                 "id": "<?php echo e($cmd->id); ?>"
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
                                                                                     $("#cancelDemandeOther<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                                         e.preventDefault()
                                                                                         alertify.confirm("Confirmation", "Vous êtes sûr d'annuler la livraison de  cette demande  ?", () => {
                                                                                             axios.post("/otherCommande/cancel", {
                                                                                                     "_token": "<?php echo e(csrf_token()); ?>",
                                                                                                     "id": "<?php echo e($cmd->id); ?>"
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
                                                                             <?php else: ?>
                                                                                 <?php if($cmd->statut == 2): ?>
                                                                                 <?php endif; ?>
                                                                                 -
                                                                             <?php endif; ?>
                                                                         <?php endif; ?>
                                                                     <?php endif; ?>
                                                                 </td>
                                                             </tr>

                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                             <?php endif; ?>



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
                             <?php endif; ?>
                             <script>
                                 $(".modal").appendTo('body')
                             </script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/indexContent.blade.php ENDPATH**/ ?>