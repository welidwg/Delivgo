  {{-- <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
      <div
          class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
          <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
          <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Mon-Sat: 11:00 AM - 23:00
                  PM</span></i>
      </div>
  </section> --}}
  <script>
      const spinner = `   <div class="spinner-grow spinner-grow-sm" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;
  </script>
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <div class="logo navbar-brand me-auto">
              <!-- Uncomment below if you prefer to use an image logo -->
              <a href="index.html" class="d-flex text-primary align-items-center ">
                  <img src="images/logo/logowhite.png" alt="" class="img-fluid w-100">
                  <h1 class="">Delivgo</h1>

              </a>
          </div>

          <nav id="navbar" class="navbar order-last order-lg-0">
              <ul>
                  <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                  <li><a class="nav-link scrollto" href="#about">About</a></li>
                  <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
                  @if (Auth::check())
                      <li><a class="nav-link scrollto" href={{ url('/logout') }}>Logout</a></li>
                  @endif

                  <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <li><a href="#">Drop Down 1</a></li>
                          <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                      class="bi bi-chevron-right"></i></a>
                              <ul>
                                  <li><a href="#">Deep Drop Down 1</a></li>
                                  <li><a href="#">Deep Drop Down 2</a></li>
                                  <li><a href="#">Deep Drop Down 3</a></li>
                                  <li><a href="#">Deep Drop Down 4</a></li>
                                  <li><a href="#">Deep Drop Down 5</a></li>
                              </ul>
                          </li>
                          <li><a href="#">Drop Down 2</a></li>
                          <li><a href="#">Drop Down 3</a></li>
                          <li><a href="#">Drop Down 4</a></li>
                      </ul>
                  </li>

              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          <a class="scrollto fs-5" data-bs-toggle="offcanvas" href="#cart"><i class="fas fa-shopping-cart"></i></a>

          <div class="dropdown">
              <a href="#!" class="btn   shadow-none rounded-pill  bg-color-1 mx-2 ">Start</a>
              <ul>
                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal1"> <i
                              class="fal fa-sign-in-alt"></i> Login</a></li>

                  <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"><i
                              class="fal fa-user-plus"></i> Register</a></li>

              </ul>
          </div>


      </div>
  </header>

  <div class="modal fade" id="loginModal1" tabindex="-1" role="dialog" aria-labelledby="loginModal"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-0">
              <div class="modal-body p-4 px-5 ">


                  <div class="main-content text-center mb-3 py-auto">

                      <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><span class="fal fa-times"></span></span>
                      </a>


                      <form action="#" id="loginForm">
                          <label for="" class="mb-3 fs-3 color-3">Log in to Delivgo</label>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                              <input type="text" class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Email" name="email">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                              <input type="password" name="password"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Password">
                          </div>
                          <div class="mx-auto mt-3">
                              <button type="submit" class="btn w-100" id="btnLogin">Log in <i
                                      class="fal fa-sign-in-alt"></i></button>
                          </div>
                          <div class="mx-auto mt-3">
                              <a role="button" class=" w-100">Forget your password ?</a>
                          </div>
                  </div>

                  <div class="d-flex flex-column ">

                      {{-- <div class="mx-auto d-flex flex-column justify-content-around">
                          <h5 style="text-align: center">or</h5>

                          <a class="btn btn-block btn-social btn-twitter mb-2" href="{{ url('auth/google') }}">
                              <span class="fab fa-google"></span> Sign UP with Google
                          </a>

                          <a class="btn btn-block btn-social btn-facebook  mb-2">
                              <span class="fab fa-facebook"></span> Sign UP with Facebook
                          </a>
                      </div> --}}
                      <p class="mt-2 mx-auto" style="text-align: center">Dont't have an account ?&nbsp;<a
                              style="text-decoration: none" class="color-1" data-bs-target="#registerModal"
                              data-bs-toggle="modal" data-bs-dismiss="modal">Create one now !</a></p>

                  </div>
                  </form>

              </div>
              <script>
                  $("#loginForm").on("submit", (e) => {
                      e.preventDefault();
                      $('#btnLogin').html(spinner);
                      axios.post("/login", $('#loginForm').serialize()).then((res) => {
                          toastr.success("Logged in")

                          setTimeout(() => {
                              if (res.data.user == 1) {
                                  window.location.href = "/"

                              } else {
                                  window.location.href = "/dash"

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
                          $('#btnLogin').html(`Log in <i
                                      class="fal fa-sign-in-alt"></i>`);

                      })
                  })
              </script>

          </div>
      </div>
  </div>


  <div class="modal fade" id="registerModal" role="dialog" aria-labelledby="registerModal1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-0">
              <div class="modal-body p-4 px-5 ">


                  <div class="main-content text-center mb-3 py-auto">

                      <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                          aria-label="Close">
                          <span aria-hidden="true"><span class="fal fa-times"></span></span>
                      </a>


                      <form action="#" id="registerForm" enctype="multipart/form-data">
                          @csrf

                          <label for="" class="mb-3 fs-3 color-3">Join Delivgo </label>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                              <input type="text"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Your name (exp: Paul John)" name="name" id="name">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i
                                      class="fal fa-user-check"></i></label>
                              <input type="text"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Your username (exp: paul_john)" name="username" id="username">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                              <input type="email" id="email"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Email (exp:paul_john@domain.com)" name="email">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-id-badge"></i></label>
                              <select id="type" name="type"
                                  class="form-control form-select shadow-none border-0 text-center bg-transparent">
                                  <option value="">You are ?</option>
                                  <option value="1">Client</option>
                                  <option value="2">Restaurant</option>

                              </select>
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center justify-content-center"
                              id="avatarContainer" style="display: none">

                              <label for="avatar" class="test-center"> <i class="fal fa-camera"></i> Please add
                                  your logo</label>

                              <input type="file"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  accept="image/*" id="avatar" name="avatar" hidden>

                              <img id="imageCont" src="#" alt="" width="35px"
                                  class="img-fluid rounded" style="display: none">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                              <input type="tel"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Phone Number" name="phone" id="phone">
                          </div>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                              <input type="password" name="password" id="passwordReg"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Type a secured password">
                          </div>


                          <div class="mx-auto mt-3">
                              <button type="submit" id="btnSubmitRegister" class="btn w-100 disabled">Register
                              </button>
                          </div>

                  </div>

                  <div class="d-flex flex-column ">

                      <p class="mt-4 mx-auto" style="text-align: center">already have an account ?&nbsp;<a
                              style="text-decoration: none" class="color-1" data-bs-target="#loginModal1"
                              data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close">Log in now
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
                      //   $("#btnSubmitRegister").on("click", () => {



                      //       axios.post('/first_register', {
                      //           email: $("#email").val(),
                      //           name: $("€name").val()
                      //       }, {
                      //           headers: {
                      //               'Content-Type': 'application/json',

                      //           }
                      //       }).then(function(response) {
                      //           //response
                      //           console.log(response);
                      //           $('#confirmModal').modal('show');
                      //           $('#registerModal').modal('hide');

                      //       }).catch((err) => {
                      //           console.log(err.response.data);

                      //       });

                      //   })
                      $("#registerForm").on("submit", (e) => {
                          e.preventDefault()
                          let form = $("#registerForm")[0]
                          let formData = new FormData(form)
                          //   let avatar = document.getElementById("avatar").files[0]

                          //   formData.append('avatar', avatar, avatar.name)

                          //   console.log(formData);

                          $("#btnSubmitRegister").html(spinner)

                          axios.post('/register', formData, {
                              headers: {
                                  'Content-Type': 'multipart/form-data',
                                  'processData': false

                              }
                          }).then(function(response) {
                              $('#confirmModal').modal('show');
                              $('#registerModal').modal('hide');

                              console.log(response);
                          }).catch((err) => {
                              for (let k in err.response.data) {
                                  toastr.error(err.response.data[k])
                              }
                              console.log(err.response.data);

                          }).finally(() => {
                              $("#btnSubmitRegister").html(`Register`)
                          });

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
  <div class="modal fade" id="confirmModal" aria-labelledby="confimModal" data-bs-backdrop="static"
      data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-0">
              <div class="modal-body p-4 px-5 ">


                  <div class="main-content text-center mb-3 py-auto">

                      <a href="#" style="" class="close-btn" id="closeModalConfirm">
                          <span aria-hidden="true"><span class="fal fa-times"></span></span>
                      </a>


                      <form action="#" id="checkCodeForm">
                          <label for="" class="mb-3 fs-3 color-3">Confirm your email</label>
                          <p class="fw-bold">We have sent a code to your email.<br> Please check it and type it
                              below<br>
                              <span class="text-danger fw-bold">PS: the code will be expired in 15 minutes</span>

                          </p>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                              <input type="text"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Code field" id="code">
                          </div>
                          <div class="mx-auto mt-3">
                              <button href="#!" type="submit" id="checkBtnSubmit" class="btn w-100">Check <i
                                      class="fal fa-sign-in-alt"></i></button>
                          </div>
                          <div class="mx-auto mt-3">
                              <a role="button" id="resendBtn" class=" w-100">resend the code</a>
                          </div>
                  </div>



                  </form>

              </div>

          </div>
      </div>
      <script>
          $("#resendBtn").on("click", (e) => {
              $("#resendBtn").html(spinner)
              let email = localStorage.getItem("email");
              axios.post("/resend_code", {
                  email: email,
                  type: "email"
              }).then((res) => {
                  toastr.success(res.data.message)
              }).catch((err) => {
                  console.log(err.response.data);
                  toastr.error("Sorry , something went wrong! Please try again later")
              }).finally(() => {
                  $("#resendBtn").html("Resend the code")
              })
          })
          $("#checkCodeForm").on("submit", (e) => {
              e.preventDefault()
              $("#checkBtnSubmit").html(spinner)
              console.log("res");
              axios.post("/verify_code", {
                  code: $("#code").val()
              }, {
                  headers: {
                      'Content-Type': 'application/json',

                  }
              }).then((res) => {
                  console.log(res);
                  $('#confirmModal').modal('hide');
                  $("#registerForm").trigger("reset");
                  toastr.success(res.data.message)

              }).catch((err) => {
                  console.log(err.response.data);
                  if (err.response.data.message != undefined) {
                      toastr.error(err.response.data.message)
                  } else {
                      for (let k in err.response.data) {
                          toastr.error(err.response.data[k])
                      }

                  }
              }).finally(() => {
                  $("#checkBtnSubmit").html(`Check <i  class="fal fa-sign-in-alt"></i>`)
              })
          });
      </script>
      <script>
          $("#closeModalConfirm").on("click", () => {
              alertify.confirm("Confirmarion", 'Are you sure that you want to cancel the operation ?', () => {
                  $('#confirmModal').modal('hide');
                  $('#registerModal').modal('hide');
                  $('#registerForm').trigger("reset");
                  $('#checkCodeForm').trigger("reset");

              }, () => {}).set({
                  labels: {
                      ok: "Yes",
                      cancel: "No"
                  }
              })
          })
      </script>
  </div>
