

<?php
use App\models\User;
use App\models\Commande;
use App\models\commande_ref;
use App\models\RequestResto;
use Carbon\Carbon;
?>





<?php $__env->startSection('title'); ?>
    Statistiques
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_path'); ?>
    Mes statistiques
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_title'); ?>
    Mes statistiques
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
    $type = Auth::user()->type;
    $user = Auth::user();
    $frequent = [];

    switch (Auth::user()->type) {
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
            $response = commande_ref::where('deliverer_id', $user->user_id)
                ->where('is_message', 1)
                ->get();
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
    ?>
    <div class="row">
        <?php if(Auth::user()->type == 4): ?>
            <div class="row">

                <div class="col-md-4 col-xl-3 mb-2">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                        <span>Clients</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0">
                                        <span>
                                            <?php
                                                $Clients = User::where('type', 1)->get();
                                                echo $Clients->count();
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3 mb-2">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                        <span>Restaurants</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0">
                                        <span>
                                            <?php
                                                $Clients = User::where('type', 2)->get();
                                                echo $Clients->count();
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-store-alt fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3 mb-2">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                        <span>Livreurs</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0">
                                        <span>
                                            <?php
                                                $Clients = User::where('type', 3)->get();
                                                echo $Clients->count();
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-biking-mountain fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6" id="demandes">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Statistiques des livreurs</h4>
                                
                            </div>

                        </div>
                        <!-- title -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover align-middle text-wrap" id="StatsLivreur">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Matricule</th>
                                        <th class="border-top-0">Livreur</th>
                                        <th class="border-top-0 d-none d-lg-table-cell">Date de recrutement</th>
                                        <th class="border-top-0 d-none d-lg-table-cell">Total des livraison</th>
                                        <th class="border-top-0 d-none d-lg-table-cell">Total des frais</th>
                                        <th class="border-top-0 d-lg-none">Détails</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        
                                        $requests = User::where('type', 3)->get();
                                        
                                    ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <strong>#<?php echo e($demande->username); ?></strong>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a
                                                            class="btn btn-circle d-flex btn-info text-white">
                                                            <img src="<?php echo e(asset('uploads/logos/' . $demande->avatar)); ?>"
                                                                alt="" class="img-fluid " width="80px">
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"><?php echo e($demande->name); ?><br>
                                                            <label class="mt-2"><a
                                                                    href="tel:<?php echo e($demande->phone); ?><"><?php echo e($demande->phone); ?></a></span>
                                                        </h4>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-none d-lg-table-cell"
                                                id="daterecrutlivreir2<?php echo e($demande->user_id); ?>">
                                            </td>

                                            <td class="d-none d-lg-table-cell">
                                                <?php
                                                    $countcmd = commande_ref::where('deliverer_id', $demande->user_id)->get();
                                                ?>
                                                <?php echo e($countcmd->count()); ?>

                                            </td>
                                            <td class="d-none d-lg-table-cell">
                                                <?php
                                                    $frais = 0;
                                                    if ($countcmd->count() > 0) {
                                                        foreach ($countcmd as $cmd) {
                                                            $frais += $cmd->user->region->deliveryPrice;
                                                        }
                                                    }
                                                    
                                                ?>
                                                <?php echo e($frais); ?> TND
                                            </td>

                                            <td class="d-lg-none">
                                                <a href="#!" id="" data-bs-toggle="modal"
                                                    data-bs-target="#detailsSTATlIVREUR<?php echo e($demande->user_id); ?>"
                                                    class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detailsSTATlIVREUR<?php echo e($demande->user_id); ?>"
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
                                                                    <span>Date de recrutement : <strong
                                                                            id="daterecrutlivreir<?php echo e($demande->user_id); ?>">


                                                                        </strong></span>
                                                                    <script>
                                                                        $('#daterecrutlivreir<?php echo e($demande->user_id); ?>,#daterecrutlivreir2<?php echo e($demande->user_id); ?>').html(moment(
                                                                            "<?php echo e($demande->created_at); ?>").format('LL'))
                                                                    </script>


                                                                </div>
                                                                <div class="col mb">
                                                                    <label class="">Total de livraisons:</label>
                                                                    <?php echo e($countcmd->count()); ?>



                                                                </div>
                                                                <div class="col mb">
                                                                    <label class="">Total de frais:</label>
                                                                    <?php echo e($frais); ?> TND


                                                                </div>






                                                            </div>



                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                            $frais = 0;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>



                                </tbody>
                            </table>
                            <script>
                                $("#StatsLivreur").DataTable({
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
            <div class="col-md-6" id="demandes">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Statistiques de jours des livreurs</h4>
                                
                            </div>

                        </div>
                        <!-- title -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover align-middle text-wrap" id="StatsLivreurToday">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Matricule</th>
                                        <th class="border-top-0">Livreur</th>
                                        <th class="border-top-0 d-none d-lg-table-cell">Date de recrutement</th>
                                        <th class="border-top-0 d-none d-lg-table-cell">Total des livraison</th>
                                        <th class="border-top-0">Total des frais</th>
                                        <th class="border-top-0 d-lg-none">Détails</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        
                                        $requests = User::where('type', 3)->get();
                                        
                                    ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <strong>#<?php echo e($demande->username); ?></strong>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a
                                                            class="btn btn-circle d-flex btn-info text-white">
                                                            <img src="<?php echo e(asset('uploads/logos/' . $demande->avatar)); ?>"
                                                                alt="" class="img-fluid " width="80px">
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"><?php echo e($demande->name); ?><br>
                                                            <label class="mt-2"><a
                                                                    href="tel:<?php echo e($demande->phone); ?><"><?php echo e($demande->phone); ?></a></span>
                                                        </h4>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-none d-lg-table-cell"
                                                id="daterecrutlivreir2<?php echo e($demande->user_id); ?>">
                                            </td>

                                            <td class="d-none d-lg-table-cell">
                                                <?php
                                                    $countcmd = commande_ref::where('deliverer_id', $demande->user_id)
                                                        ->whereDate('created_at', Carbon::today())
                                                        ->get();
                                                ?>
                                                <?php echo e($countcmd->count()); ?>

                                            </td>
                                            <td class="">
                                                <?php
                                                    $frais = 0;
                                                    if ($countcmd->count() > 0) {
                                                        foreach ($countcmd as $cmd) {
                                                            $frais += $cmd->user->region->deliveryPrice;
                                                        }
                                                    }
                                                    
                                                ?>
                                                <?php echo e($frais); ?> TND
                                            </td>

                                            <td class="d-lg-none">
                                                <a href="#!" id="" data-bs-toggle="modal"
                                                    data-bs-target="#detailsSTATlIVREURtoday<?php echo e($demande->user_id); ?>"
                                                    class="btn shadow-none text-danger"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detailsSTATlIVREURtoday<?php echo e($demande->user_id); ?>"
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
                                                                    <span>Date de recrutement : <strong
                                                                            id="daterecrutlivreir<?php echo e($demande->user_id); ?>">


                                                                        </strong></span>
                                                                    <script>
                                                                        $('#daterecrutlivreir<?php echo e($demande->user_id); ?>,#daterecrutlivreir2<?php echo e($demande->user_id); ?>').html(moment(
                                                                            "<?php echo e($demande->created_at); ?>").format('LL'))
                                                                    </script>


                                                                </div>
                                                                <div class="col mb">
                                                                    <label class="">Total de livraisons:</label>
                                                                    <?php echo e($countcmd->count()); ?>



                                                                </div>
                                                                <div class="col mb">
                                                                    <label class="">Total de frais:</label>
                                                                    <?php echo e($frais); ?> TND


                                                                </div>






                                                            </div>



                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                            $frais = 0;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>



                                </tbody>
                            </table>
                            <script>
                                $("#StatsLivreurToday").DataTable({
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
        <?php else: ?>
            <div class="col-md-4 col-xl-3 mb-2">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <span><?php echo e($type == 2 ? 'Produits' : 'Commandes livrée'); ?></span>
                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    <span><?php echo e($type == 2 ? count(Auth::user()->products) : count($delivered)); ?></span>
                                </div>
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
                                <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                    <span><?php echo e($type == 2 ? 'Commandes effectuées' : 'Réponse au demande'); ?></span>

                                </div>
                                <div class="text-dark fw-bold h5 mb-0">
                                    <span><?php echo e($type == 2 ? count($commandes) : count($response)); ?></span>
                                </div>
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
                                <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                    <span><?php echo e($type == 2 ? 'Revenue' : 'Restaurant fréquent'); ?></span>

                                </div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h5 mb-0 me-3">
                                            <?php if($type == 2): ?>
                                                <span><?php echo e($revenue . ' Dt'); ?></span>
                                            <?php else: ?>
                                                <?php if(count($frequent) > 0): ?>
                                                    <span><?php echo e($frequent[0]->resto->name); ?></span>
                                                <?php else: ?>
                                                    Pas encore
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>
    <?php if($type != 4): ?>
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
            <?php if($type == 2): ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Statistiques générale</h4>
                            <div class="mt-5 pb-3 d-flex align-items-center">
                                <span class="btn btn-primary btn-circle d-flex align-items-center">
                                    <i class="mdi mdi-cart-outline fs-4"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Top produit</h5>
                                    <?php if($topProduct != null): ?>
                                        <span class="text-muted fs-6 "><?php echo e($topProduct->product->label); ?></span>
                                    <?php else: ?>
                                        Pas encore
                                    <?php endif; ?>

                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-light text-muted">
                                        <?php if($topProduct != null): ?>
                                            <?php
                                                $count = Commande::where('product_id', $topProduct->product->product_id)
                                                    ->get()
                                                    ->count();
                                                echo $count;
                                            ?>
                                    </span>
            <?php endif; ?>

        </div>
        </div>
        <div class="py-3 d-flex align-items-center">
            <span class="btn btn-warning btn-circle d-flex align-items-center">
                <i class="fal fa-biking-mountain fs-4"></i> </span>
            <div class="ms-3">
                <h5 class="mb-0 fw-bold">Top livreur</h5>
                <?php if($topdilev->deliverer): ?>
                    <span class="text-muted fs-6"><?php echo e($topdilev->deliverer->name); ?></span>
                <?php else: ?>
                    Pas encore
                <?php endif; ?>
            </div>
            <div class="ms-auto">

                <span class="badge bg-light text-muted">
                    <?php if($topdilev->deliverer != null): ?>
                        <?php
                            $countLiv = commande_ref::where('resto_id', $user->user_id)
                                ->where('deliverer_id', $topdilev->deliverer->user_id)
                                ->get()
                                ->count();
                            echo $countLiv;
                        ?>
                    <?php endif; ?>

                </span>
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
    <?php endif; ?>

    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/stats.blade.php ENDPATH**/ ?>