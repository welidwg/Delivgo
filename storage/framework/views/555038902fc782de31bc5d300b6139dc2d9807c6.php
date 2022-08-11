
<?php $__env->startSection('title'); ?>
    Utilisateurs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_path'); ?>
    Utilisateurs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_title'); ?>
    Utilisateurs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12" id="users">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Listes des utilisateurs </h4>
                            
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="requestDel">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Matricule</th>
                                    <th class="border-top-0">Nom</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Téléphone</th>
                                    <th class="border-top-0">Type</th>
                                    <th class="border-top-0">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><strong>#<?php echo e($user->username); ?></strong></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">
                                                        <img src="<?php echo e(asset('uploads/logos/' . $user->avatar)); ?>"
                                                            alt="" class="img-fluid " width="80px">
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <h4 class="m-b-0 font-16"><?php echo e($user->name); ?></h4>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <?php echo e($user->email); ?>

                                        </td>
                                        <td>
                                            <?php echo e($user->phone); ?>

                                        </td>
                                        <td>
                                            <?php switch($user->type):
                                                case (1): ?>
                                                    Client
                                                <?php break; ?>

                                                <?php case (2): ?>
                                                    Restaurant
                                                <?php break; ?>

                                                <?php case (3): ?>
                                                    Livreur
                                                <?php break; ?>

                                                <?php default: ?>
                                            <?php endswitch; ?>
                                        </td>


                                        <td>
                                            <?php if($user->type == 2 || $user->type == 3): ?>
                                                <a href="<?php echo e(url('/dash/profile/' . $user->user_id)); ?>"
                                                    class="btn shadow-none text-primary"><i class="fas fa-eye"></i></a>
                                            <?php endif; ?>
                                            <a href="#!" id="deleteUser<?php echo e($user->user_id); ?>"
                                                class="btn shadow-none text-danger"><i class="fas fa-times"></i></a>
                                            <script>
                                                $("#deleteUser<?php echo e($user->user_id); ?>").on("click", (e) => {
                                                    e.preventDefault()
                                                    alertify.confirm("Confirmation", "Vous êtes sûr de supprimer cet utilisateur ?", () => {
                                                        axios.delete("/user/delete/<?php echo e($user->user_id); ?>", {


                                                            })
                                                            .then(res => {
                                                                console.log(res)
                                                                toastr.info(res.data.message)
                                                                // LoadContentMain()

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
                                    "pageLength": 4,

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
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('dash/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/dash/pages/users.blade.php ENDPATH**/ ?>