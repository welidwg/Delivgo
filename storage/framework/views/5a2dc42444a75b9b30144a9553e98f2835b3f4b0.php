 <?php
     use App\models\User;
     use App\models\Commande;
     use App\models\commande_ref;
     use App\models\RequestResto;
 ?>
 <?php
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
 ?>


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
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/indexContent.blade.php ENDPATH**/ ?>