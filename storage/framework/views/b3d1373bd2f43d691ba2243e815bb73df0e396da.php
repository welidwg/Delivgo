

<?php $__env->startSection('title'); ?>
    Mes ordres
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="inner-page-hero bg-image  bg-color-3 shadow-sm "
        style="position: sticky;top:0px;left:0;right:0;z-index: -998 !important;">
        <div class="profile mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <!-- <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="image-wrap">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <figure><img id="logoResto" src="images/cabane.jpg" alt="" style="width:10rem"></figure>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div> -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 profile-desc animate__animated animate__fadeInDown">

                        <div class=" p-3 ">
                            <div class="row align-items-center justify-content-center">
                                
                                <div style="" class="col col-sm-12 col-lg-4 col-md-5">
                                    <h4 class="display-5 text-white fw-bold text-center">Vos commandes</h4>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="card ">
        <div class="card-body ">
            <div class="bg-white p-0  " style="z-index: 1 !important;position: relative;min-height: 100vh" id="ordersCont">



            </div>
        </div>
    </div>
    <script>
        function load() {
            $("#ordersCont").load('/ordersTable')
        }
        timer = setInterval(load(), 5000);


        // function startSetInterval() {

        //     console.log(timer);
        // }


        // startSetInterval();

        $('#ordersCont').hover(function() {
            clearInterval(timer);
        }, function() {
            timer = setInterval(load, 5000);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main/base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/pages/orders.blade.php ENDPATH**/ ?>