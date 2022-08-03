

<?php
use App\models\User;
use App\models\Commande;
use App\models\commande_ref;
use App\models\RequestResto;
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
            foreach ($commandes as $cmd) {
                foreach ($cmd->items as $item) {
                    $revenue += $item->total;
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
            $frequent = commande_ref::with('resto')
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
                                        <?php if(count($frequent) > 0): ?>
                                            <span><?php echo e($type == 2 ? $revenue . ' Dt' : $frequent[0]->resto->name); ?></span>
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

    </div>
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
            <?php if($topdilev != null): ?>
                <span class="text-muted fs-6"><?php echo e($topdilev->deliverer->name); ?></span>
            <?php else: ?>
                Pas encore
            <?php endif; ?>
        </div>
        <div class="ms-auto">

            <span class="badge bg-light text-muted">
                <?php if($topdilev != null): ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/stats.blade.php ENDPATH**/ ?>