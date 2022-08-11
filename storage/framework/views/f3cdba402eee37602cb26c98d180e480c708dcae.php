 <?php
     use App\Models\User;
     use App\Models\Commande;
     use App\Models\commande_ref;
     use App\Models\Garniture;
     use App\Models\Sauce;
     use App\Models\Drink;
     use App\Models\Supplement;
     use App\Models\OtherCommande;
     use Illuminate\Support\Carbon;
     
 ?>
 <?php
     
     $cmds = commande_ref::where('user_id', Auth::user()->user_id)
         ->with('user')
         ->with('messages')
         ->with('resto')
         ->orderBy('statut', 'asc')
         ->get();
     $total = 0;
     
 ?>
 <h3 class="px-5 py-3">Vos commande des restaurants</h3>
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
             <?php $__empty_1 = true; $__currentLoopData = $cmds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                 <tr>
                     <td><strong>#<?php echo e($cmd->reference); ?></strong></td>
                     <td class="d-none d-lg-table-cell">
                         <div class="d-flex align-items-center">
                             <div class="m-r-10"><a class="btn btn-circle d-flex btn-white text-white"
                                     href="/resto/<?php echo e($cmd->resto->user_id); ?>">
                                     <img src="<?php echo e(asset('uploads/logos/' . $cmd->resto->avatar)); ?>" alt=""
                                         class="img-fluid rounded" width="80px">
                                 </a>
                             </div>
                             <div class="">
                                 <h4 class="m-b-0  fs-5 fw-bold"><?php echo e($cmd->resto->name); ?>


                                 </h4>

                                 <small>Tel:<?php echo e($cmd->resto->phone); ?></small>
                             </div>
                         </div>
                     </td>
                     <td class="d-none d-lg-table-cell text-wrap">
                         <?php
                             // $commandes = Commande::where('id', $cmd->commande_id)
                             //     ->with('product')
                             //     ->get();
                             ${'total' . $cmd->id} = 0;
                         ?>

                         <?php if($cmd->is_message): ?>
                             <p class="w-50">
                                 <?php echo e($cmd->messages[0]->message); ?></p>
                         <?php else: ?>
                             <?php $__currentLoopData = $cmd->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $command): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 
                                 <?php
                                     $total += $command->total;
                                 ?>

                                 <?php
                                     ${'total' . $cmd->id} += $command->total;
                                 ?>
                                 <div class="accordion bg-transparent accordion-flush"style="background:transparent !important"
                                     id="accordionExample<?php echo e($command->id); ?>">
                                     <div class="accordion-item bg-transparent">
                                         <h2 class="accordion-header" id="pr<?php echo e($command->id); ?>">
                                             <button
                                                 class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2"
                                                 style="background: transparent !important" type="button"
                                                 data-bs-toggle="collapse" data-bs-target="#product<?php echo e($command->id); ?>"
                                                 aria-expanded="true" aria-controls="collapseOne">
                                                 <?php echo e($command->product->label); ?>

                                                 (<?php echo e($command->quantity); ?>)
                                             </button>
                                         </h2>
                                         <div id="product<?php echo e($command->id); ?>" class="accordion-collapse collapse "
                                             aria-labelledby="" data-bs-parent="#accordionExample<?php echo e($command->id); ?>"
                                             style="">
                                             <div class="accordion-body h-100">
                                                 <span class="text-muted fw-bold">Totale:
                                                 </span> <?php echo e($command->total); ?> DT
                                                 <br>

                                                 <?php if($command->garnitures != ''): ?>
                                                     <span class="text-muted fw-bold">Garnitures: </span>
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
                                                     <span class="text-muted fw-bold">Suppléments:
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
                                                         <span class="text-muted fw-bold">Sauces: </span>
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
                                                     <span class="text-muted fw-bold">Boissons: </span>
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


                     </td>

                     <td class="d-none d-lg-table-cell" id="date_passed<?php echo e($cmd->id); ?>">
                     </td>
                     <script>
                         $('#date_passed<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format('LL | LT'))
                     </script>
                     <td class="">

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
                         <?php if($cmd->taken): ?>
                             <div class="d-flex align-items-center">
                                 <div class="m-r-10"><a class="btn btn-circle d-flex btn-white text-white">
                                         <img src="<?php echo e(asset('uploads/logos/' . $cmd->deliverer->avatar)); ?>"
                                             alt="" class="img-fluid rounded" width="80px">
                                     </a>
                                 </div>
                                 <div class="">
                                     <h4 class="m-b-0  fs-5 fw-bold"><?php echo e($cmd->deliverer->name); ?>


                                     </h4>

                                     <small>Tel:<?php echo e($cmd->deliverer->phone); ?></small>
                                 </div>
                             </div>
                         <?php else: ?>
                             en attente de livreur
                         <?php endif; ?>

                     </td>
                     <td class="d-none d-lg-table-cell">
                         <?php if($cmd->by_night): ?>
                             <?php echo e(${'total' . $cmd->id} + $frais_nuit->frais_nuit); ?> TND
                         <?php else: ?>
                             <?php if($cmd->is_message): ?>
                                 Livraison : <?php echo e(Auth::user()->region->deliveryPrice); ?> Dt
                             <?php else: ?>
                                 <?php echo e(${'total' . $cmd->id} + Auth::user()->region->deliveryPrice); ?> Dt
                             <?php endif; ?>
                         <?php endif; ?>


                     </td>


                     <td class="d-none d-lg-table-cell">

                         <?php if($cmd->statut == 1): ?>
                             <a href="#!" id="cancelCmd<?php echo e($cmd->id); ?>" class="btn shadow-none text-danger"><i
                                     class="fas fa-times"></i></a>
                         <?php else: ?>
                             Non annulable
                         <?php endif; ?>

                     </td>
                     <td class="d-lg-none">
                         <a href="#!" id="seeMore<?php echo e($cmd->id); ?>"
                             data-bs-target="#DetailsModal<?php echo e($cmd->id); ?>" data-bs-toggle="modal"
                             class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                     </td>
                 </tr>

                 <script>
                     $("#cancelCmd<?php echo e($cmd->id); ?>").on("click", (e) => {
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
                 <div class="modal fade" id="DetailsModal<?php echo e($cmd->id); ?>" aria-labelledby="DetailsModal"
                     tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content rounded-0">
                             <div class="modal-body p-4 px-0 ">


                                 <div class="main-content text-center mb-3 py-auto">

                                     <a href="#" style="" class="close-btn" id="closeModalConfirm"
                                         data-bs-toggle="Close">
                                         <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                     </a>
                                     <h6 class="text-center">Référence : <strong>#<?php echo e($cmd->reference); ?></strong></h6>
                                     <div class="row flex-column justify-content-start align-items-center">
                                         <div class="col mb">
                                             <label class="">Restaurant:</label>
                                             <strong>
                                                 <a href="<?php echo e(url('/resto/' . $cmd->resto->user_id)); ?>">
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
                                         <div class="col mb-2">
                                             <span>Date : <strong id="dateTel<?php echo e($cmd->id); ?>">


                                                 </strong></span>
                                             <script>
                                                 $('#dateTel<?php echo e($cmd->id); ?>').html(moment("<?php echo e($cmd->created_at); ?>").format('LL | LT'))
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
                                                             <h2 class="accordion-header" id="pr<?php echo e($command->id); ?>">
                                                                 <button
                                                                     class="accordion-button collapsed bg-transparent rounded-pill shadow-sm mb-2 text-nowrap"
                                                                     style="background: transparent !important"
                                                                     type="button" data-bs-toggle="collapse"
                                                                     data-bs-target="#product<?php echo e($command->id); ?>"
                                                                     aria-expanded="true" aria-controls="collapseOne">
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
                                                                     <span class="text-muted fw-bold">Totale:
                                                                     </span> <?php echo e($command->total); ?> DT
                                                                     <br>

                                                                     <?php if($command->garnitures != ''): ?>
                                                                         <span class="text-muted fw-bold">Garnitures:
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
                                                                         <span class="text-muted fw-bold">Suppléments:
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
                                                                             <span class="text-muted fw-bold">Sauces:
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
                                                                         <span class="text-muted fw-bold">Boissons:
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
                                                     <?php if($cmd->by_night): ?>
                                                         <?php echo e(${'total' . $cmd->id} + $frais_nuit->frais_nuit); ?> TND
                                                     <?php else: ?>
                                                         <?php if($cmd->is_message): ?>
                                                             Livraison : <?php echo e(Auth::user()->region->deliveryPrice); ?> Dt
                                                         <?php else: ?>
                                                             <?php echo e(${'total' . $cmd->id} + Auth::user()->region->deliveryPrice); ?>

                                                             Dt
                                                         <?php endif; ?>
                                                     <?php endif; ?>



                                                 </strong></span>



                                         </div>
                                         <?php if($cmd->statut == 1): ?>
                                             <a class="btn btn-danger w-75"
                                                 id="cancel<?php echo e($cmd->id); ?>">Annuler</a>
                                             <script>
                                                 $("#cancel<?php echo e($cmd->id); ?>").on("click", (e) => {
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
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                 <?php endif; ?>




             </tbody>
         </table>

     </div>
     <h3 class="px-5 py-3 mt-3">Vos demandes des livreurs</h3>

     <div class="table-responsive shadow p-1 text-nowrap " style="border-radius: 12px;">
         <table class="table mb-0 table-hover mx-auto align-middle  py-3 px-3 " id="orders2">
             <thead>
                 <tr>
                     <th class="border-top-0">Date</th>
                     <th class="border-top-0 d-none d-lg-table-cell">Message</th>
                     <th class="border-top-0 d-none d-lg-table-cell">Image</th>
                     <th class="border-top-0 ">Statut</th>
                     <th class="border-top-0 d-none d-lg-table-cell">Livreur</th>
                     <th class="border-top-0 d-none d-lg-table-cell">Frais</th>
                     <th class="border-top-0 d-none d-lg-table-cell">Annuler</th>
                     <th class="border-top-0  d-lg-none">Détails</th>
                 </tr>
             </thead>
             <?php
                 
                 $cmds = OtherCommande::where('user_id', Auth::user()->user_id)
                     ->with('user')
                     ->with('deliverer')
                     ->orderBy('statut', 'asc')
                     ->get();
             ?>
             <tbody>
                 <?php $__empty_1 = true; $__currentLoopData = $cmds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>



                         <td class="">
                             <?php echo e('date'); ?>

                         </td>
                         <td class="d-none d-lg-table-cell">
                             <?php echo e($cmd->message); ?>

                         </td>
                         <td class="d-none d-lg-table-cell">
                             <?php if($cmd->picture != ''): ?>
                                 <img class="img-fluit " width="50px"
                                     src="<?php echo e(asset('uploads/commandes/' . $cmd->picture)); ?>" alt="image ">
                             <?php else: ?>
                                 -
                             <?php endif; ?>
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
                         <td class="d-none d-lg-table-cell">
                             <div class="d-flex align-items-center">


                                 <?php if($cmd->taken): ?>
                                     <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">
                                             <img src="<?php echo e(asset('uploads/logos/' . $cmd->deliverer->avatar)); ?>"
                                                 alt="" class="img-fluid " width="80px">
                                         </a>
                                     </div>
                                     <div class="">
                                         <h4 class="m-b-0 font-16"><?php echo e($cmd->deliverer->name); ?>


                                             <br>
                                             <small>N° Téléphone : <a
                                                     href="tel:<?php echo e($cmd->deliverer->phone); ?>"><?php echo e($cmd->deliverer->phone); ?></a></small>
                                             <br>



                                         </h4>
                                     </div>
                                 <?php else: ?>
                                     en attente de livreur
                                 <?php endif; ?>
                             </div>
                         </td>
                         <td class="d-none d-lg-table-cell">
                             <?php echo e($cmd->frais); ?> TND
                         </td>






                         <td class="d-none d-lg-table-cell">

                             <?php if($cmd->statut == 1): ?>
                                 <a href="#!" id="cancelCmdDemand<?php echo e($cmd->id); ?>"
                                     class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                             <?php else: ?>
                                 Non annulable
                             <?php endif; ?>

                         </td>
                         <td class="d-lg-none">
                             <a href="#!" id="seeMoreDd<?php echo e($cmd->id); ?>"
                                 data-bs-target="#DetailsModalDemande<?php echo e($cmd->id); ?>" data-bs-toggle="modal"
                                 class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                         </td>
                     </tr>

                     <script>
                         $("#cancelCmdDemand<?php echo e($cmd->id); ?>").on("click", (e) => {
                             e.preventDefault()
                             alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette commande ?", () => {
                                 axios.post("/otherCommande/cancel", {
                                         id: "<?php echo e($cmd->id); ?>"
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
                     <div class="modal fade" id="DetailsModalDemande<?php echo e($cmd->id); ?>"
                         aria-labelledby="DetailsModalDemande" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content rounded-0">
                                 <div class="modal-body p-4 px-0 ">


                                     <div class="main-content text-center mb-3 py-auto">

                                         <a href="#" style="" class="close-btn" id="closeModalConfirm"
                                             data-bs-toggle="Close">
                                             <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                         </a>
                                         <h6 class="text-center">Date de passation :
                                             <strong><?php echo e($cmd->created_at); ?></strong>
                                         </h6>
                                         <div class="row flex-column justify-content-start align-items-center">
                                             <div class="col mb">
                                                 <label class="">Message:</label>
                                                 <strong>
                                                     <?php echo e($cmd->message); ?>


                                                 </strong>



                                             </div>
                                             <div class="col mb-2">
                                                 <span>Image: <strong>
                                                         <?php if($cmd->picture != ''): ?>
                                                             <img class="img-fluit " width="50px"
                                                                 src="<?php echo e(asset('uploads/commandes/' . $cmd->picture)); ?>"
                                                                 alt="image ">
                                                         <?php else: ?>
                                                             -
                                                         <?php endif; ?>

                                                     </strong></span>



                                             </div>

                                             <div class="col mb-2">
                                                 <span>Livreur : <strong>
                                                         <?php if($cmd->taken): ?>
                                                             <?php echo e($cmd->deliverer->name); ?><br>
                                                             Téléphone: <strong><?php echo e($cmd->deliverer->phone); ?></strong>
                                                         <?php else: ?>
                                                             <span class="text-warning">
                                                                 en attente de livreur

                                                             </span>
                                                         <?php endif; ?>


                                                     </strong></span>



                                             </div>

                                             <div class="col mb-2">
                                                 <span>Frais : <strong>
                                                         <?php echo e($cmd->frais); ?> TND
                                                     </strong></span>



                                             </div>
                                             <?php if($cmd->statut == 1): ?>
                                                 <a class="btn btn-danger w-75"
                                                     id="cancelcmddem<?php echo e($cmd->id); ?>">Annuler</a>
                                                 <script>
                                                     $("#cancelcmddem<?php echo e($cmd->id); ?>").on("click", (e) => {
                                                         e.preventDefault()
                                                         alertify.confirm("Confirmation", "Vous êtes sûr d'annuler cette commande ?", () => {
                                                             axios.post("/otherCommande/cancel", {
                                                                     id: "<?php echo e($cmd->id); ?>"
                                                                 })
                                                                 .then(res => {
                                                                     console.log(res)
                                                                     toastr.info("Votre commande est annulée")
                                                                     $(".modal").modal("hide");
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
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <?php endif; ?>




                 </tbody>
             </table>

         </div>
         <script>
             $("#orders,#orders2").DataTable({
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
             $(".modal").appendTo("body");
         </script>

         
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/layouts/ordersTable.blade.php ENDPATH**/ ?>