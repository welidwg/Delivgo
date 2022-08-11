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
   <div class="col-12 mb-3" id="ff">
       <div class="card ">
           <div class="card-body">
               <!-- title -->
               <div class="d-md-flex p-0">
                   <div>
                       <h4 class="card-title">Liste des commandes</h4>
                       
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
                                   ->where('statut', '=', 5)
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
                                       <td class="d-none d-lg-table-cell">


                                           <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <?php
                                                   $total += $passed->total;
                                               ?>
                                               <div class="accordion accordion-flush"style="max-width: 200px !important;word-wrap: break-word"
                                                   id="accordionExample<?php echo e($passed->id); ?>">
                                                   <div class="accordion-item">
                                                       <h2 class="accordion-header" id="pr<?php echo e($passed->id); ?>">
                                                           <button class="accordion-button collapsed" type="button"
                                                               data-bs-toggle="collapse"
                                                               data-bs-target="#product<?php echo e($passed->id); ?>"
                                                               aria-expanded="true" aria-controls="collapseOne">
                                                               <?php echo e($passed->product->label); ?>

                                                               (<?php echo e($passed->quantity); ?>)
                                                           </button>
                                                       </h2>
                                                       <div id="product<?php echo e($passed->id); ?>"
                                                           class="accordion-collapse collapse " aria-labelledby=""
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
                                           <?php echo e($total); ?> TND</td>
                                       <td class="d-none d-lg-table-cell">
                                           <?php echo e($cmd->deliverer_id == null ? '' : $cmd->deliverer->name); ?></td>
                                       <td class="d-none d-lg-table-cell">
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
                                       <td class="d-lg-none">
                                           <a href="#!" data-bs-toggle="modal"
                                               data-bs-target="#DetailsModal<?php echo e($cmd->id); ?>"
                                               class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
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
                                                       <div
                                                           class="row flex-column justify-content-start align-items-center">
                                                           <?php if(Auth::user()->user_id !== $cmd->resto->user_id): ?>
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
                                                                           <a href="tel:+216<?php echo e($cmd->resto->phone); ?>">
                                                                               <?php echo e($cmd->resto->phone); ?>


                                                                           </a>

                                                                       </strong></span>



                                                               </div>
                                                           <?php endif; ?>

                                                           <div class="col mb-2">
                                                               <span>Date : <strong id="dateTelff<?php echo e($cmd->id); ?>">


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
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/layouts/historiqueContent.blade.php ENDPATH**/ ?>