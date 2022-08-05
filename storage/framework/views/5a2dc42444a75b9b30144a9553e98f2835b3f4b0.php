 <?php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
     use App\models\Region;
 ?>
 <?php
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
     use App\Models\Demande;
 ?>
 <?php if(Auth::user()->type == 4): ?>
     <div class="row">
         <div class="col-md-6" id="demandes" style="zoom: 0.8">
             <div class="card">
                 <div class="card-body">
                     <!-- title -->
                     <div class="d-md-flex">
                         <div>
                             <h4 class="card-title">Demandes de partenariat </h4>
                             
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
                                         <td class="d-lg-none">
                                             <a href="#!" id="" data-bs-toggle="modal"
                                                 data-bs-target="#DetailsModal<?php echo e($demande->id); ?>"
                                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                         </td>
                                     </tr>
                                     <div class="modal fade" id="DetailsModal<?php echo e($demande->id); ?>"
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

         <div class="col-md-6" id="demandes" style="zoom: 0.8">
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
                                                             id="closeModalConfirm" data-bs-toggle="Close">
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
         <div class="col-md-6" id="listeregion" style="zoom: 0.8">
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
                                     <th class="border-top-0 d-none d-lg-table-cell">Actions</th>

                                 </tr>
                             </thead>

                             <tbody>
                                 <?php
                                     
                                     $requests = Region::get();
                                     
                                 ?>
                                 <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                     <tr>
                                         <td>
                                             <?php echo e($demande->label); ?>

                                         </td>
                                         <td class="">
                                             <?php echo e($demande->deliveryPrice); ?>

                                         </td>






                                         <td class="d-none d-lg-table-cell">

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

                                     </tr>
                                     <div class="modal fade" id="EditRegModal<?php echo e($demande->id); ?>"
                                         aria-labelledby="DetailsModal" tabindex="-1" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered" role="document">
                                             <div class="modal-content rounded-0">
                                                 <div class="modal-body p-4 px-0 ">


                                                     <div class="main-content text-center mb-3 p-3 py-auto">

                                                         <a href="#" style="" class="close-btn"
                                                             id="" data-bs-dismiss="modal">
                                                             <span aria-hidden="true"><span
                                                                     class="fal fa-times"></span></span>
                                                         </a>

                                                         <form action="#" id="ediregform" class="formsModal">
                                                             <h6 for="" class="mb-3 fs-3 color-3 text-center">
                                                                 Modifier région/ville</h6>

                                                             <div
                                                                 class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                                 <label for="" class="px-2 color-3 fs-5"><i
                                                                         class="fal fa-tag"></i></label>
                                                                 <input type="text"
                                                                     class="form-control shadow-none border-0  bg-transparent"
                                                                     placeholder="Nom" value="<?php echo e($demande->label); ?>"
                                                                     name="label" required>

                                                             </div>

                                                             <div
                                                                 class="input-group mb-2  rounded-pill bg-light  align-items-center">
                                                                 <label for="" class="px-2 color-3 fs-5"><i
                                                                         class="fal fa-coins"></i></label>
                                                                 <input type="number" step="0.1"
                                                                     class="form-control shadow-none border-0  bg-transparent"
                                                                     placeholder="frais de livraison" name="prix"
                                                                     value="<?php echo e($demande->deliveryPrice); ?>" required>
                                                             </div>


                                                             <div class="mx-auto mt-3">
                                                                 <button href="#!" type="submit" id="ediregbtn"
                                                                     class="btn w-100">Modifier&nbsp;
                                                                     <i class="fal fa-check"></i></button>
                                                             </div>
                                                             <?php echo csrf_field(); ?>
                                                         </form>




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
                                 <?php
                                     $cmds = commande_ref::where('resto_id', Auth::user()->user_id)
                                         ->where('statut', '!=', 5)
                                         ->with('items')
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
                                                                     </span> <?php echo e($passed->total); ?> DT
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
                                                 <?php echo e($total + Auth::user()->deliveryPrice); ?> Dt</td>
                                             <td class="d-none d-lg-table-cell">
                                                 <?php echo e($cmd->deliverer_id == null ? '' : $cmd->deliverer->name); ?></td>
                                             <td>
                                                 <?php if($cmd->statut != 5): ?>
                                                     <?php switch($cmd->statut):
                                                         case (1): ?>
                                                             <a href="#!" id="startCmd<?php echo e($cmd->id); ?>"
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-play"></i></a>
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
                                                                 class="btn shadow-none text-success"><i
                                                                     class="fas fa-check"></i></a>
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
                                                         class="btn shadow-none text-danger"><i
                                                             class="fas fa-trash"></i></a>
                                                 <?php else: ?>
                                                     -
                                                 <?php endif; ?>
                                             </td>
                                             <td>
                                                 <a href="#!" id="details<?php echo e($cmd->id); ?>"
                                                     class="btn shadow-none text-danger"><i
                                                         class="fas fa-eye"></i></a>
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
                                                                     class="btn shadow-none text-success"><i
                                                                         class="fas fa-play"></i></a>
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
                                                                     class="btn shadow-none text-success"><i
                                                                         class="fas fa-check"></i></a>
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
                                                             class="btn shadow-none text-danger"><i
                                                                 class="fas fa-trash"></i></a>
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
                                         <h4 class="card-title"> Liste des commandes</h4>
                                         
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
                                             <?php
                                                 $me = User::where('user_id', Auth::user()->user_id)
                                                     ->with('commandesReceived')
                                                     ->get();
                                                 $commandes = commande_ref::where('statut', '!=', 6)
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
                                                     <td>
                                                         <strong>#<?php echo e($cmd->reference); ?> </strong>

                                                     </td>
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
                                                                     <?php echo e($cmd->user->address == '' ? 'N\A' : $cmd->user->address); ?>

                                                                 </small>

                                                             </div>
                                                         </div>
                                                     </td>


                                                     <td id="datepass<?php echo e($cmd->id); ?>">
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
                                                     <td><?php echo e($total + $cmd->resto->deliveryPrice); ?> Dt</td>

                                                     <td>
                                                         <?php if(!Auth::user()->onDuty): ?>
                                                             Vous êtes hors service
                                                         <?php else: ?>
                                                             <?php if(!$cmd->taken): ?>
                                                                 <a href="#!" id="startCmd<?php echo e($cmd->id); ?>"
                                                                     class="btn shadow-none text-success"><i
                                                                         class="fas fa-play"></i></a>
                                                                 <script>
                                                                     $("#startCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
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
                                                                                 LoadContentMain()

                                                                             })
                                                                             .catch(err => {
                                                                                 console.error(err);
                                                                                 toastr.error("Quelque chose s'est mal passé")

                                                                             })
                                                                     })
                                                                 </script>
                                                             <?php else: ?>
                                                                 <?php if($cmd->taken && $cmd->deliverer_id == Auth::user()->user_id): ?>
                                                                     <?php if($cmd->statut == 4): ?>
                                                                         <a href="#!" id="completeCmd<?php echo e($cmd->id); ?>"
                                                                             class="btn shadow-none text-success"><i
                                                                                 class="fas fa-check"></i></a>
                                                                         <script>
                                                                             $("#completeCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
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
                                                                         $("#cancelCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                                             e.preventDefault()
                                                                             alertify.confirm("Confirmation", "Ae you sure that you want to cancel your delivery  ?", () => {
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
                                                 <?php
                                                     $total = 0;
                                                 ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                 <?php endif; ?>



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
                         </div>
                     <?php endif; ?>
                     <script>
                         $(".modal").appendTo('body')
                     </script>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/indexContent.blade.php ENDPATH**/ ?>