  
  <script>
      const spinner = `   <div class="spinner-grow spinner-grow-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;
  </script>
  <?php
      use App\Models\Notification;
  ?>
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <div class="logo navbar-brand me-auto">
              <a href="<?php echo e(url('/')); ?>" class="d-flex text-primary align-items-center ">
                  <img src="<?php echo e(asset('images/logo/logo2.png')); ?>" alt="" class="img-fluid ">
                  <h1 class="d-none d-lg-block">Delivgo</h1>

              </a>
          </div>

          <nav id="navbar" class="navbar order-last order-lg-0 mx-3">
              <ul>
                  <li><a class="nav-link scrollto " href="<?php echo e(url('/')); ?>">Accueil</a></li>
                  <?php if(request()->routeIs('main')): ?>
                      <li><a class="nav-link scrollto" href="#menu">Restaurants</a></li>

                      <li><a class="nav-link scrollto" href="#why-us">Pourquoi delivgo ? </a></li>
                      <li><a class="nav-link scrollto" href="#join-us">Rejoignez-nous </a></li>
                  <?php else: ?>
                      <li><a class="nav-link scrollto" href="<?php echo e(url('/#menu')); ?>">Restaurants</a></li>
                  <?php endif; ?>

                  <?php if(auth()->guard()->check()): ?>
                      <?php if(Auth::user()->type == 1): ?>
                          <li><a class="nav-link <?php echo e(request()->routeIs('main.orders') ? 'active' : ''); ?>"
                                  href="<?php echo e(url('/orders')); ?>">Mes commandes</a></li>
                      <?php endif; ?>


                  <?php endif; ?>




              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

          <?php if(!Auth::check()): ?>

              <div class="dropdown">
                  <a href="#!" class="btn   shadow-none rounded-pill  bg-color-1 mx-2 ">Commencez</a>
                  <ul>
                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal1"> <i
                                  class="fal fa-sign-in-alt"></i> Se connecter</a></li>

                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"><i
                                  class="fal fa-user-plus"></i>S'inscrire</a></li>

                  </ul>
              </div>
          <?php else: ?>
              <a class="scrollto fs-5 mx-3" data-bs-toggle="offcanvas" href="#cart"><i
                      class="fas fa-shopping-cart"></i></a>
              <div class="dropdown"><a href="#" class="fs-5"><i class="fas fa-bell"></i></a>
                  <ul class="" style="width: 400px;right:-190px">
                      <div>
                          <h6 class="text-center fs-5">Notifications

                              <a href="#" class="text-danger EmptyNotif"><i class="fas fa-trash"></i></a>
                          </h6>
                          <hr>
                      </div>
                      <script></script>

                      <div class=""
                          style="max-height: 200px;height:200px;max-width: 100%;width:100%;overflow: auto;"
                          id="notifCont">


                      </div>

                  </ul>
              </div>
              <script>
                  function notifLoad() {
                      $("#notifCont").load("/notif")
                      setTimeout(() => {
                          notifLoad()
                      }, 10 * 1000);
                  }
                  notifLoad()
                  $('.EmptyNotif').on("click", (e) => {
                      alertify.confirm("Confirmation", "Vous êtes sûr d'effacer vos notifications ?", () => {
                              axios.post("/notif/empty", {
                                      _token: "<?php echo e(csrf_token()); ?>"
                                  })
                                  .then(res => {
                                      console.log(res)
                                      toastr.info("Toutes vos notifications sont supprimées")
                                      notifLoad()
                                  })
                                  .catch(err => {
                                      console.error(err);
                                      toastr.error("Erreur inconnue,ressayer plus tard")
                                  })
                          }, () => {})
                          .set({
                              labels: {
                                  ok: "Oui",
                                  cancel: "Annuler"
                              }
                          })
                  })
              </script>
              <div class="dropdown">
                  <a href="#!" class="btn    mx-2 d-flex align-items-center justify-content-between">
                      <img src="<?php echo e(asset('uploads/logos/' . Auth::user()->avatar)); ?>" alt=""
                          class="rounded-circle shadow mx-2" width="30px">
                      <span class="text-white d-none d-lg-flex"> <?php echo e(Auth::user()->name); ?></span></a>
                  <ul>
                      <?php if(Auth::user()->type != 1): ?>
                          <li><a href=<?php echo e(url('/dash')); ?>> <i class="fal fa-tachometer"></i>&nbsp;Mon espace</a></li>
                      <?php endif; ?>
                      <li><a
                              href=<?php echo e(Auth::user()->type == 1 ? url('/profile/' . Auth::user()->user_id) : url('/dash/profile/' . Auth::user()->user_id)); ?>>
                              <i class="fal fa-user"></i> Mon profile</a></li>


                      <li><a href=<?php echo e(url('/logout')); ?>><i class="fal fa-sign-out-alt"></i> Déconnexion</a></li>

                  </ul>
              </div>
          <?php endif; ?>



      </div>
  </header>
  <?php if(!Auth::check()): ?>
      <div class="modal fade" id="loginModal1" tabindex="-1" role="dialog" aria-labelledby="loginModal"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content rounded-0">
                  <div class="modal-body p-4 px-5 ">


                      <div class="main-content text-center mb-3 py-auto">

                          <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><span class="fal fa-times"></span></span>
                          </a>


                          <form action="#" class="formsModal" id="loginForm">
                              <h6 for="" class="mb-3 fs-3 color-3">Se connectez au Delivgo</h6>

                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                  <input type="text"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Votre numéro" name="phone">
                              </div>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                                  <input type="password" name="password"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Mot de passe">
                              </div>
                              <div class="mx-auto mt-3">
                                  <button type="submit" class="btn w-100" id="btnLogin">Connexion<i
                                          class="fal fa-sign-in-alt"></i></button>
                              </div>
                              <div class="mx-auto mt-3">
                                  <a role="button" data-bs-target="#passwrodResetModal" data-bs-toggle="modal"
                                      class=" w-100">Mot de passe oublié?</a>
                              </div>
                      </div>

                      <div class="d-flex flex-column ">

                          
                          <p class="mt-2 mx-auto" style="text-align: center">TVous n'a pas encore un compte ?&nbsp;<a
                                  style="text-decoration: none" class="color-1" data-bs-target="#registerModal"
                                  data-bs-toggle="modal" data-bs-dismiss="modal">Créez un maintenant !</a></p>

                      </div>
                      </form>

                  </div>
                  <script>
                      $("#loginForm").on("submit", (e) => {
                          e.preventDefault();
                          $('#btnLogin').html(spinner);
                          axios.post("/login", $('#loginForm').serialize()).then((res) => {
                              toastr.success("Bien connecté ! ")

                              setTimeout(() => {
                                  if (res.data.user == 1) {
                                      window.location.href = "/"

                                  } else {
                                      window.location.href = "/dash"

                                  }
                                  if (localStorage.region != undefined) {
                                      axios.post("/user/updateAddress/" + res.data.id, {
                                          address: localStorage.region
                                      }).then((res) => {
                                          console.log(res);

                                      }).catch((err) => {
                                          console.log(err.response.data);
                                      })
                                  }

                              }, 700);
                              $("#loginForm").trigger("reset")

                          }).catch((err) => {
                              console.log(err.response.data);
                              if (err.response.data.email != undefined) {
                                  localStorage.setItem("email", err.response.data.email);
                                  toastr.error(err.response.data.message)
                                  $('#confirmModal').modal('show');
                                  return false;

                              }
                              if (err.response.data.type != undefined) {
                                  toastr.error(err.response.data.message)
                                  return false;


                              } else {
                                  for (let k in err.response.data) {
                                      toastr.error(err.response.data[k])
                                  }
                                  return false;

                              }
                              //   toastr.error(err.response.data)
                          }).finally(() => {
                              $('#btnLogin').html(`Connexion <i
                                      class="fal fa-sign-in-alt"></i>`);

                          })
                      })
                  </script>

              </div>
          </div>
      </div>


      <div class="modal fade" id="registerModal" role="dialog" aria-labelledby="registerModal1"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content rounded-0">
                  <div class="modal-body p-4 px-5 ">


                      <div class="main-content text-center mb-3 py-auto">

                          <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                              aria-label="Close">
                              <span aria-hidden="true"><span class="fal fa-times"></span></span>
                          </a>


                          <form action="# " class="formsModal" id="registerForm" enctype="multipart/form-data">
                              <?php echo csrf_field(); ?>

                              <h6 for="" class="mb-3 fs-3 color-3">Inscription </h6>

                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                                  <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                      placeholder="Votre nom (exp: Paul John)" name="name" id="name">
                              </div>

                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                                  <input type="email" id="email"
                                      class="form-control shadow-none border-0 bg-transparent"
                                      placeholder="Email (exp:paul_john@domain.com)" name="email">
                              </div>

                              
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i
                                          class="fal fa-phone"></i></label>
                                  <input type="tel"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Votre numéro mobile/fixe" required name="phone" id="phone">
                              </div>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i
                                          class="fal fa-phone"></i></label>
                                  <input type="tel"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Confirmez votre numéro" required name="phone2" id="phone2">
                              </div>

                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                                  <input type="password" name="password" id="passwordReg"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Donnez un mot de passe ">
                              </div>


                              <div class="mx-auto mt-3">
                                  <button type="submit" id="btnSubmitRegister" class="btn w-100 disabled">S'inscrire
                                  </button>
                              </div>

                      </div>

                      <div class="d-flex flex-column ">

                          <p class="mt-4 mx-auto" style="text-align: center">Vous avez déjà un compte ?&nbsp;<a
                                  style="text-decoration: none" class="color-1" data-bs-target="#loginModal1"
                                  data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close">Connectez-vous
                                  maintenant
                                  !</a></p>

                      </div>
                      </form>
                      <script>
                          $('#passwordReg').on("keyup", (e) => {
                              if (e.target.value == "") {
                                  $("#btnSubmitRegister").addClass("disabled")
                              } else {
                                  $("#btnSubmitRegister").removeClass("disabled")

                              }
                              console.log(e.target.value);
                          })

                          $("#registerForm").on("submit", (e) => {
                              e.preventDefault()
                              let form = $("#registerForm")[0]
                              let formData = new FormData(form)
                              formData.append("type", 1)


                              $("#btnSubmitRegister").html(spinner)
                              if ($("#phone2").val() !== $("#phone").val()) {
                                  toastr.error("Veuillez confirmer attentivement votre numéro")
                                  $("#btnSubmitRegister").html(`S'inscrire`)
                                  $("#phone2").css("border", "1px solid red !important")

                              } else {
                                  $("#phone2").css("border", "1px solid green !important")
                                  setTimeout(() => {
                                      $("#phone2").css("border", "1px solid #ccc !important")
                                  }, 500);

                                  axios.post('/register', formData, {
                                      headers: {
                                          'Content-Type': 'multipart/form-data',
                                          'processData': false

                                      }
                                  }).then(function(response) {
                                      toastr.success(response.data.message)
                                      $("#registerForm").trigger("reset");
                                      $("#registerModal").modal("hide");
                                      $("#loginModal1").modal("show");

                                  }).catch((err) => {
                                      if (err.response.data.message != undefined) {
                                          toastr.error(err.response.data.message)


                                      } else {
                                          for (let k in err.response.data) {
                                              toastr.error(err.response.data[k])
                                          }
                                      }

                                      console.log(err);

                                  }).finally(() => {
                                      $("#btnSubmitRegister").html(`S'inscrire`)
                                  });
                              }


                          })



                          $('#avatar').change(function() {
                              var i = $(this).prev('label').clone();
                              var file = $('#avatar')[0].files[0].name;
                              $(this).prev('label').text("Tap to change");
                              var reader = new FileReader();
                              reader.onload = function(e) {
                                  $('#imageCont').fadeIn("slow")
                                  $('#imageCont').attr('src', e.target.result)
                              };
                              reader.readAsDataURL($('#avatar')[0].files[0]);


                          });
                          $("#type").on("change", () => {
                              if ($('#type').val() == "2") {
                                  $("#avatarContainer").fadeIn("slow")
                                  $("#avatar").attr("required", true)

                              } else {
                                  $("#avatarContainer").fadeOut("slow")
                                  $("#avatar").attr("required", false)


                              }
                          })
                      </script>

                  </div>

              </div>
          </div>
      </div>
      

      <div class="modal fade" id="passwrodResetModal" aria-labelledby="passwrodResetModal" tabindex="-1"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content rounded-0">
                  <div class="modal-body p-4 px-5 ">


                      <div class="main-content text-center mb-3 py-auto">

                          <a href="#" style="" class="close-btn" id="closeModalConfirm">
                              <span aria-hidden="true"><span class="fal fa-times"></span></span>
                          </a>

                          <h6 for="" class="mb-5 fs-3 color-3">Récuperation du mot de passe</label>
                              <br>

                              <form action="#" class="formsModal mt-2" id="verifEmailForm">
                                  <p class="fw-bold">Saisissez votre email au dessus<br>

                                  </p>
                                  <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                      <label for="" class="px-2 color-3 fs-5"><i
                                              class="fal fa-at"></i></label>
                                      <input type="email" name="email"
                                          class="form-control shadow-none border-0 text-center bg-transparent"
                                          placeholder="paul_john@domain.com" id="email">
                                  </div>
                                  <div class="mx-auto mt-3">
                                      <button href="#!" type="submit" id="verifBtnSubmit"
                                          class="btn w-100">Vérifier
                                          <i class="fal fa-paper-plane"></i></button>
                                  </div>
                                  <?php echo csrf_field(); ?>
                                  
                              </form>
                              <form action="#" class="formsModal" id="codeVerifPasswordForm"
                                  style="display: none">
                                  <p class="fw-bold">Saisissez le code réçu au dessus<br>

                                  </p>
                                  <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                      <label for="" class="px-2 color-3 fs-5"><i
                                              class="fal fa-lock-alt"></i></label>
                                      <input type="text" name="code"
                                          class="form-control shadow-none border-0 text-center bg-transparent"
                                          placeholder="Champ de code" id="code">
                                  </div>
                                  <div class="mx-auto mt-3">
                                      <button href="#!" type="submit" id="verifCodeBtnSubmit"
                                          class="btn w-100">Vérifier
                                          <i class="fal fa-check"></i></button>
                                  </div>
                                  <?php echo csrf_field(); ?>
                                  
                              </form>
                              <form class="formsModal" action="#" id="newPassForm" style="display: none">
                                  <p class="fw-bold">Nouveau mot de passe<br>

                                  </p>
                                  <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                      <label for="" class="px-2 color-3 fs-5"><i
                                              class="fal fa-lock-alt"></i></label>
                                      <input type="password" name="password"
                                          class="form-control shadow-none border-0 text-center bg-transparent"
                                          placeholder="Saissez votre nouveau mot de passe" id="newPassword">
                                  </div>
                                  <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                      <label for="" class="px-2 color-3 fs-5"><i
                                              class="fal fa-lock-alt"></i></label>
                                      <input type="password"
                                          class="form-control shadow-none border-0 text-center bg-transparent"
                                          placeholder="Confirmez le " id="confirm">
                                  </div>
                                  <div class="mx-auto mt-3">
                                      <button href="#!" type="submit" id="newPassBtnSubmit"
                                          class="btn w-100">Changer
                                          <i class="fal fa-check"></i></button>
                                  </div>
                                  <?php echo csrf_field(); ?>
                                  
                              </form>

                      </div>




                  </div>
                  <script>
                      $("#verifEmailForm").on("submit", (e) => {
                          e.preventDefault()
                          let oldval = $("#verifBtnSubmit").html()
                          $("#verifBtnSubmit").html(spinner)
                          axios.post("/password_recovery", $("#verifEmailForm").serialize())
                              .then(res => {
                                  console.log(res)
                                  if (res.data.type != undefined) {
                                      toastr.success(res.data.message)
                                      $("#verifEmailForm").fadeOut()
                                      setTimeout(() => {
                                          $("#codeVerifPasswordForm").fadeIn('slow')

                                      }, 500);
                                  }
                              })
                              .catch(err => {
                                  console.error(err);
                                  if (err.response.data.type != undefined) {
                                      toastr.error(err.response.data.message)
                                  }
                              })
                              .finally(() => {
                                  $("#verifBtnSubmit").html(oldval)
                              })
                      })

                      $('#codeVerifPasswordForm').on("submit", (e) => {
                          e.preventDefault()
                          let btn = $("#verifCodeBtnSubmit")
                          let oldval = $("#verifCodeBtnSubmit").html()
                          btn.html(spinner)
                          axios.post("/verify_code_password", $("#codeVerifPasswordForm").serialize())
                              .then(res => {
                                  console.log(res)
                                  if (res.data.type != undefined) {
                                      toastr.success(res.data.message)
                                      localStorage.setItem("email", res.data.email)
                                  }
                                  $('#codeVerifPasswordForm').fadeOut()
                                  setTimeout(() => {
                                      $('#newPassForm').fadeIn("slow")

                                  }, 500);
                              })
                              .catch(err => {
                                  console.error(err.response.data);
                                  if (err.response.data.type != undefined) {
                                      toastr.error(err.response.data.message)
                                  }
                              }).finally(() => {
                                  btn.html(oldval)
                              })

                      })

                      $('#newPassForm').on("submit", (e) => {
                          e.preventDefault()
                          let btn = $("#newPassBtnSubmit")
                          let oldval = $("#newPassBtnSubmit").html()
                          btn.html(spinner)
                          let password = $("#newPassword").val()
                          let confirm = $("#confirm").val()
                          let email = localStorage.getItem("email")
                          if (password !== confirm) {
                              toastr.error("Please repeat correcly your new password !")
                              btn.html(oldval)

                          } else {
                              axios.post("/password_update", {
                                      email: email,
                                      password: password
                                  })
                                  .then(res => {
                                      console.log(res)
                                      if (res.data.type != undefined) {
                                          toastr.success(res.data.message)
                                      }
                                      $("#passwrodResetModal").modal("hide")
                                      $("#loginModal1").modal("show")
                                      localStorage.removeItem("email")
                                  })
                                  .catch(err => {
                                      if (err.response.data.type != undefined) {
                                          toastr.error(err.response.data.message)
                                      } else {
                                          for (let k in err.response.data) {
                                              toastr.error(err.response.data[k])
                                          }
                                      }
                                      console.error(err.response.data);

                                  }).finally(() => {
                                      btn.html(oldval)
                                  })

                          }



                      })
                  </script>

              </div>
          </div>
      </div>
  <?php endif; ?>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/main/nav.blade.php ENDPATH**/ ?>