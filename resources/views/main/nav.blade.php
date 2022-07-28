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
  @php
      use App\Models\Notification;
  @endphp
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <div class="logo navbar-brand me-auto">
              <a href="index.html" class="d-flex text-primary align-items-center ">
                  <img src="{{ asset('images/logo/logowhite.png') }}" alt="" class="img-fluid w-50">
                  <h1 class="">Delivgo</h1>

              </a>
          </div>

          <nav id="navbar" class="navbar order-last order-lg-0 mx-3">
              <ul>
                  <li><a class="nav-link scrollto " href="{{ url('/') }}">Home</a></li>
                  @if (request()->routeIs('main'))
                      <li><a class="nav-link scrollto" href="#menu">Restaurants</a></li>

                      <li><a class="nav-link scrollto" href="#why-us">Why delivgo </a></li>
                  @endif

                  @auth
                      @if (Auth::user()->type == 1)
                          <li><a class="nav-link {{ request()->routeIs('main.orders') ? 'active' : '' }}"
                                  href="{{ url('/orders') }}">My orders</a></li>
                      @endif


                  @endauth




              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

          <a class="scrollto fs-5 mx-3" data-bs-toggle="offcanvas" href="#cart"><i
                  class="fas fa-shopping-cart"></i></a>
          @if (!Auth::check())

              <div class="dropdown">
                  <a href="#!" class="btn   shadow-none rounded-pill  bg-color-1 mx-2 ">Start</a>
                  <ul>
                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal1"> <i
                                  class="fal fa-sign-in-alt"></i> Login</a></li>

                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"><i
                                  class="fal fa-user-plus"></i> Register</a></li>

                  </ul>
              </div>
          @else
              <li class="dropdown"><a href="#" class="fs-5"><i class="fas fa-bell"></i></a>
                  <ul class="" style="width: 400px;right:-150px">
                      <div>
                          <h6 class="text-center fs-5">Notifications</h6>
                          <hr>
                      </div>

                      <div class="" style="max-height: 200px;overflow: auto" id="notifCont">


                      </div>

                  </ul>
              </li>
              <script>
                  function notifLoad() {
                      $("#notifCont").load("/notif")
                      setTimeout(() => {
                          notifLoad()
                      }, 5000);
                  }
                  notifLoad()
              </script>
              <div class="dropdown">
                  <a href="#!" class="btn    mx-2 d-flex align-items-center justify-content-between">
                      <img src="{{ asset('uploads/logos/' . Auth::user()->avatar) }}" alt=""
                          class="rounded-circle shadow mx-2" width="30px">
                      <span class="text-white d-none d-lg-flex"> {{ Auth::user()->username }}</span></a>
                  <ul>
                      @if (Auth::user()->type != 1)
                          <li><a href={{ url('/dash') }}> <i class="fal fa-tachometer"></i> Dashboard</a></li>
                      @endif
                      <li><a href={{ Auth::user()->type == 1 ? url('/profile') : url('/dash/profile') }}> <i
                                  class="fal fa-user"></i> My profile</a></li>


                      <li><a href={{ url('/logout') }}><i class="fal fa-sign-out-alt"></i> Logout</a></li>

                  </ul>
              </div>
          @endif



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


                      <form action="#" class="formsModal" id="loginForm">
                          <h6 for="" class="mb-3 fs-3 color-3">Log in to Delivgo</h6>

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
                              <a role="button" data-bs-target="#passwrodResetModal" data-bs-toggle="modal"
                                  class=" w-100">Forget your password ?</a>
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


                      <form action="# " class="formsModal" id="registerForm" enctype="multipart/form-data">
                          @csrf

                          <h6 for="" class="mb-3 fs-3 color-3">Join Delivgo </h6>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                              <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                  placeholder="Your name (exp: Paul John)" name="name" id="name">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i
                                      class="fal fa-user-circle"></i></label>
                              <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                  placeholder="Your username (exp: paul_john)" name="username" id="username">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                              <input type="email" id="email"
                                  class="form-control shadow-none border-0 bg-transparent"
                                  placeholder="Email (exp:paul_john@domain.com)" name="email">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-id-badge"></i></label>
                              <select id="type" name="type"
                                  class="form-control form-select shadow-none border-0 text-center bg-transparent">
                                  <option value="">You are ?</option>
                                  <option value="1">Client</option>
                                  <option value="2">Restaurant</option>
                                  <option value="3">Deliverer</option>

                              </select>
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center justify-content-center"
                              id="avatarContainer" style="display: none">

                              <label for="avatar" class="test-center" style="width: auto"> <i
                                      class="fal fa-camera"></i> Please add
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


                      <form action="#" class="formsModal" id="checkCodeForm">
                          <h6 for="" class="mb-3 fs-3 color-3">Confirm your email</label>
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
                                  <button href="#!" type="submit" id="checkBtnSubmit" class="btn w-100">Check
                                      <i class="fal fa-sign-in-alt"></i></button>
                              </div>
                              <div class="mx-auto mt-3">
                                  <a role="button" id="resendBtn" class=" w-100 fs-5">resend the code</a>
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
                  localStorage.removeItem("email")

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

  <div class="modal fade" id="passwrodResetModal" aria-labelledby="passwrodResetModal" tabindex="-1"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-0">
              <div class="modal-body p-4 px-5 ">


                  <div class="main-content text-center mb-3 py-auto">

                      <a href="#" style="" class="close-btn" id="closeModalConfirm">
                          <span aria-hidden="true"><span class="fal fa-times"></span></span>
                      </a>

                      <h6 for="" class="mb-3 fs-3 color-3">Password Recovery</label>

                          <form action="#" class="formsModal" id="verifEmailForm">
                              <p class="fw-bold">Please type your email below <br>

                              </p>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                                  <input type="email" name="email"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="paul_john@domain.com" id="email">
                              </div>
                              <div class="mx-auto mt-3">
                                  <button href="#!" type="submit" id="verifBtnSubmit" class="btn w-100">Send
                                      <i class="fal fa-paper-plane"></i></button>
                              </div>
                              @csrf
                              {{-- <div class="mx-auto mt-3">
                              <a role="button" id="resendBtn" class=" w-100">resend the code</a>
                          </div> --}}
                          </form>
                          <form action="#" class="formsModal" id="codeVerifPasswordForm" style="display: none">
                              <p class="fw-bold">Please insert the received code below<br>

                              </p>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i
                                          class="fal fa-lock-alt"></i></label>
                                  <input type="text" name="code"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Code field" id="code">
                              </div>
                              <div class="mx-auto mt-3">
                                  <button href="#!" type="submit" id="verifCodeBtnSubmit"
                                      class="btn w-100">Verify
                                      <i class="fal fa-check"></i></button>
                              </div>
                              @csrf
                              {{-- <div class="mx-auto mt-3">
                              <a role="button" id="resendBtn" class=" w-100">resend the code</a>
                          </div> --}}
                          </form>
                          <form class="formsModal" action="#" id="newPassForm" style="display: none">
                              <p class="fw-bold">Set up your new password<br>

                              </p>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i
                                          class="fal fa-lock-alt"></i></label>
                                  <input type="password" name="password"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="New Password" id="newPassword">
                              </div>
                              <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                  <label for="" class="px-2 color-3 fs-5"><i
                                          class="fal fa-lock-alt"></i></label>
                                  <input type="password"
                                      class="form-control shadow-none border-0 text-center bg-transparent"
                                      placeholder="Repeat your password" id="confirm">
                              </div>
                              <div class="mx-auto mt-3">
                                  <button href="#!" type="submit" id="newPassBtnSubmit"
                                      class="btn w-100">Confirm
                                      <i class="fal fa-check"></i></button>
                              </div>
                              @csrf
                              {{-- <div class="mx-auto mt-3">
                              <a role="button" id="resendBtn" class=" w-100">resend the code</a>
                          </div> --}}
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

