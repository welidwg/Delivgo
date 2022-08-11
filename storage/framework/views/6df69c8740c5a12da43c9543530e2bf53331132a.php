  <?php
      use App\Models\Supplement;
      use App\Models\Sauce;
      use App\Models\Drink;
      use App\Models\Garniture;
      use App\Models\Cart;
  ?>

  <div class="offcanvas-header">
      <button type="button" class="btn text-dark  bg-light rounded-circle border-1 "
          style="position: absolute;top: 20px;left: -15px;z-index: 2;" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fad fa-angle-right" style="font-size: 25px"></i></button>
  </div>
  <div class="offcanvas-body">
      <div class="container py-1">
          <div class="row d-flex justify-content-center align-items-center">
              <div class="d-flex justify-content-between align-items-center mb-4">
                  <h3 class="fw-normal mb-0 text-black">Panier</h3>
                  <div>
                      <p class="mb-0"><span class="text-muted"></span> <a href="#!" class="text-body"
                              id="emptyCart">Vider <i class="fal fa-trash mt-1"></i></a></p>
                      <script>
                          $("#emptyCart").on("click", (e) => {
                              e.preventDefault()
                              axios.delete("/cart/delete/all/<?php echo e(Auth::user()->user_id); ?>")
                                  .then(res => {
                                      console.log(res)
                                      $("#cart").load("/cartContent");
                                  })
                                  .catch(err => {
                                      console.error(err);
                                  })
                          })
                      </script>
                  </div>
              </div>
              <script>
                  $("#empty").click((e) => {
                      e.preventDefault()
                      if ($(".counterCart").length != 0) {

                          // toastr["info"]("test")
                          const boxes = document.querySelectorAll('.counterCart');

                          boxes.forEach(box => {
                              box.remove();
                          });
                          localStorage.setItem("total", 0)
                          $("#total").html(localStorage.getItem("total"))
                          $("#cartMain").append("<p style='text-align:center'>You cart is empty</p>")
                          $('#cartFooter').fadeOut()
                          toastr["info"]("Empty")

                      }



                  })
              </script>
              <div class="col shadow-sm  " id="cartMain" style="max-height: 300px;overflow-y: auto;">
                  <script>
                      let sum = 0;
                      localStorage.setItem("total", 0)
                      setInterval(() => {
                          $("#numItems , #numItems1").html($(".counterCart").length)
                      }, 1000);
                  </script>

                  <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                      <div class="card rounded-3 mb-4 counterCart shadow-sm text-wrap"
                          id="productno<?php echo e($item->product_id); ?>" style="zoom: 0.85">
                          <div class="card-body ">
                              <div class="row d-flex justify-content-between align-items-center">
                                  <div class="col-md-2 col-lg-2 col-xl-2 mx-auto text-center align-center">
                                      <img src="<?php echo e(asset('/uploads/products/' . $item->product->picture)); ?>"
                                          class="img-fluid rounded-3 " alt="<?php echo e($item->product->label); ?>">
                                      <p class="lead fw-normal mb-2 text-wrap"><?php echo e($item->product->label); ?></p>

                                  </div>
                                  <div
                                      class="col-md-3 col-lg-3 col-xl-3 mx-auto d-flex justify-content-center flex-column align-items-center align-center">
                                      <script></script>
                                      <p>
                                          <span class="text-muted">Restaurant: </span><?php echo e($item->resto->name); ?>

                                          <br>

                                          <span class="text-muted">Prix :
                                          </span>
                                          <span id="unit<?php echo e($item->product_id); ?>"><?php echo e($item->product->price); ?></span>
                                          TND
                                          <br>
                                          <?php if($item->toppings != ''): ?>
                                              <span class="text-muted">Garnitures: </span>
                                              <?php
                                                  $toppings = json_decode($item->toppings);
                                                  
                                              ?>
                                              <?php $__currentLoopData = $toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <?php
                                                      $topp = Garniture::where('id', $topping)->first();
                                                  ?>
                                                  <?php echo e($topp->label); ?>

                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <br>
                                          <?php endif; ?>
                                          <?php if($item->supplements != ''): ?>
                                              <span class="text-muted">Supplements: </span>
                                              <?php
                                                  $supplements = json_decode($item->supplements);
                                                  
                                              ?>
                                              <?php $__currentLoopData = $supplements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <?php
                                                      $supp = Supplement::where('id', $supplement)->first();
                                                  ?>
                                                  <?php echo e($supp->label); ?>

                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <br>
                                          <?php endif; ?>
                                          <?php if($item->sauces != ''): ?>
                                              <span class="text-muted">Sauces: </span>
                                              <?php
                                                  $sauces = json_decode($item->sauces);
                                                  
                                              ?>
                                              <?php $__currentLoopData = $sauces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sauce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <?php
                                                      $sauc = Sauce::where('id', $sauce)->first();
                                                  ?>
                                                  <?php echo e($sauc->label); ?>

                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <br>
                                          <?php endif; ?>
                                          <?php if($item->drinks != ''): ?>
                                              <span class="text-muted">Boissons: </span>
                                              <?php
                                                  $drinks = json_decode($item->drinks);
                                                  
                                              ?>
                                              <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <?php
                                                      $drnk = Drink::where('id', $drink)->first();
                                                  ?>
                                                  <?php echo e($drnk->label); ?>

                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <br>
                                          <?php endif; ?>
                                          <span class="text-muted">Frais de livraison:
                                              <span class="fw-bold text-dark">
                                                  <?php if($is_night): ?>
                                                      <?php echo e($frais_nuit->frais_nuit); ?> TND
                                                  <?php else: ?>
                                                      <?php if(Auth::user()->city != null): ?>
                                                          <?php echo e(Auth::user()->region->deliveryPrice); ?>

                                                      <?php else: ?>
                                                          <?php echo e($item->resto->deliveryPrice); ?>

                                                      <?php endif; ?>
                                                      TND
                                                  <?php endif; ?>

                                              </span>
                                          </span>


                                      </p>
                                  </div>

                                  <div
                                      class="col-md-4 col-lg-3 col-xl-2 d-flex justify-content-center align-items-center mx-auto">
                                      <button class="btn px-2" id="decrement<?php echo e($item->id); ?>" onclick="">
                                          <i class="fal fa-minus"></i>
                                      </button>
                                      <input id="quantityCart<?php echo e($item->id); ?>" min="0"
                                          name="quantity<?php echo e($item->id); ?>" value="<?php echo e($item->quantity); ?>"
                                          type="number" class="form-control"
                                          style="width: 50px !important;text-align: center" disabled />

                                      <button class="btn  px-2" id="increment<?php echo e($item->id); ?>">
                                          <i class="fal fa-plus"></i>
                                      </button>
                                      <script>
                                          $("#decrement<?php echo e($item->id); ?>").on("click", () => {
                                              decrementInput('quantityCart<?php echo e($item->id); ?>', '<?php echo e($item->product_id); ?>', '<?php echo e($item->id); ?>')
                                          })
                                          $("#increment<?php echo e($item->id); ?>").on("click", () => {
                                              incrementInput('quantityCart<?php echo e($item->id); ?>', '<?php echo e($item->product_id); ?>', '<?php echo e($item->id); ?>')
                                          })
                                      </script>


                                  </div>
                                  <div
                                      class="col-md-2 col-lg-2 col-xl-2 offset-lg-1 d-flex justify-content-center align-items-center mx-auto mt-4 mt-lg-0">
                                      <h5 class="mb-0" id=""><span id=""><?php echo e($item->total); ?></span>
                                          TND
                                      </h5>
                                  </div>

                                  <div
                                      class="col-md-1 col-lg-1 col-xl-1 text-end d-flex justify-content-center align-items-center mx-auto mt-4 mt-lg-0">
                                      <a href="" id="rm<?php echo e($item->product_id); ?>" class="text-danger disabled"><i
                                              class="fal fa-minus-circle fa-lg"></i></a>
                                  </div>
                                  <script>
                                      $("#rm<?php echo e($item->product_id); ?>").click((e) => {
                                          e.preventDefault()
                                          console.log("<?php echo e($item->id); ?>");
                                          axios.delete(`/cart/delete/<?php echo e($item->id); ?>`, {
                                                  _token: "<?php echo e(csrf_token()); ?>",
                                                  idCart: "<?php echo e($item->id); ?>",
                                              })
                                              .then(res => {
                                                  console.log(res)
                                                  $("#cart").load("/cartContent")
                                              })
                                              .catch(err => {
                                                  console.error(err);
                                              })
                                      })
                                  </script>
                              </div>
                          </div>
                      </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <?php echo $__env->make('main/layouts/notfound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      <p style='text-align:center'>Votre panier est vide</p>
                  <?php endif; ?>



              </div>
          </div>
          <div id="cartFooter">



              <div class="d-flex align-items-center mt-4 justify-content-center my-auto mx-auto text-center">
                  <div class="col-md-6">
                      <?php
                          $cart = Cart::where('user_id', Auth::user()->user_id)
                              ->distinct('resto_id')
                              ->with('resto')
                              ->get();
                          
                          //   $totalDelivery = 0;
                          
                          $total = 0;
                          foreach ($items as $item) {
                              $total += $item->total;
                          }
                          $livr = 0;
                          foreach ($cart as $restoC) {
                              if ($is_night) {
                                  $livr += $frais_nuit->frais_nuit;
                              } else {
                                  $livr += Auth::user()->region->deliveryPrice;
                              }
                          }
                          
                      ?>
                      <h3 class="offcanvas-title fs-5 mt-2 mb-1" style="font-weight: bolder;text-align: right">Total
                          :
                          <span class="fw-bold" for=""><?php echo e($total + $livr); ?> TND</span>
                          <?php
                              //   echo $total;
                              //   echo '<br>';
                              //   echo $totalDelivery;
                              //   echo '<br>';
                              
                              //   echo $livr;
                          ?>

                      </h3>

                  </div>
                  <div class="col-md-6">

                      <input type="hidden" value="<?php echo e($total + $livr); ?>" readonly id="totalCart" name="totalCart"
                          class="form-control bg-transparent w-50 fs-5  border-0 shadow-none" />

                  </div>

              </div>

              <small class="text-center fw-bold d-block">(compris les frais de livraison)</small>

              

              <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-center" id="passCommande">
                      <button type="button" class="btn btn-warning w-100">Passer la commande</button>
                  </div>
              </div>
              <script>
                  $("#passCommande").on("click", (e) => {
                      e.preventDefault()
                      let formData = new FormData();
                      let adresse = "<?php echo e(Auth::user()->address); ?>"
                      formData.append("total", $("#totalCart").val())
                      formData.append("_token", "<?php echo e(csrf_token()); ?>")
                      if (localStorage.region == undefined) {
                          Position()
                      } else {
                          alertify.prompt("Adresse de livraison",
                              "Veuillez préciser votre adresse afin qu'on peut livrer votre commande", adresse,
                              (ev, val) => {
                                  if (val != "") {
                                      adresse = val
                                      formData.append("address", adresse)

                                      axios.post("/commande/add", formData)
                                          .then(res => {
                                              console.log(res)
                                              $("#cart").load("/cartContent")

                                          })
                                          .catch(err => {
                                              console.error(err);
                                              toastr.error(err.response.data)
                                          })
                                  } else {
                                      toastr.error("Vous devez préciser votre adresse de livraison afin de commander!")

                                  }

                              }, () => {
                                  toastr.error("Vous devez préciser votre adresse de livraison afin de commander!")
                              }).set({
                              labels: {
                                  ok: "Commander",
                                  cancel: "Annuler"
                              }
                          })
                      }




                  })
                  //   $("body").appendChild("body")
              </script>
          </div>
      </div>
      <script>
          // toastr["info"]("test")
      </script>

      <script>
          function incrementInput(id, counter, idCart) {
              let inp = document.getElementById(id)
              inp.value++;
              axios.post("/cart/increment", {
                      _token: "<?php echo e(csrf_token()); ?>",
                      idCart: idCart

                  })
                  .then(res => {
                      console.log(res)
                      $("#cart").load("/cartContent")
                  })
                  .catch(err => {
                      console.error(err);
                  })
              // $("#total").html(sum)



          }

          function decrementInput(id, counter, idCart) {
              let inp = document.getElementById(id)

              if (inp.value != 1) {
                  inp.value--;
                  axios.post("/cart/decrement", {
                          _token: "<?php echo e(csrf_token()); ?>",
                          idCart: idCart

                      })
                      .then(res => {
                          console.log(res)
                          $("#cart").load("/cartContent")
                      })
                      .catch(err => {
                          console.error(err);
                      })



              }
          }
      </script>
  </div>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/pages/cart.blade.php ENDPATH**/ ?>