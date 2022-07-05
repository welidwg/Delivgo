  {{-- <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
      <div
          class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
          <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
          <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Mon-Sat: 11:00 AM - 23:00
                  PM</span></i>
      </div>
  </section> --}}
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
                  <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
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


                      <form action="#">
                          <label for="" class="mb-3 fs-3 color-3">Log in to Delivgo</label>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-user"></i></label>
                              <input type="text" class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Email or Username">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                              <input type="passwrd" class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Password">
                          </div>
                          <div class="mx-auto mt-3">
                              <button type="submit" class="btn w-100">Log in <i
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

          </div>
      </div>
  </div>


  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal1"
      aria-hidden="true">
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
                                  placeholder="Your name (exp: Paul John)" name="name">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i
                                      class="fal fa-user-check"></i></label>
                              <input type="text"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Your username (exp: paul_john)" name="username">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                              <input type="email"
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
                                  accept="image/*" hidden id="avatar" name="avatar">
                              <img id="imageCont" src="#" alt="" width="35px"
                                  class="img-fluid rounded" style="display: none">
                          </div>
                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-at"></i></label>
                              <input type="tel"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Phone Number" name="phone">
                          </div>

                          <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                              <label for="" class="px-2 color-3 fs-5"><i class="fal fa-lock"></i></label>
                              <input type="password" name="password"
                                  class="form-control shadow-none border-0 text-center bg-transparent"
                                  placeholder="Type a secured password">
                          </div>


                          <div class="mx-auto mt-3">
                              <button type="submit" class="btn w-100">Register</button>
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
                      $("#registerForm").on("submit", (e) => {
                          e.preventDefault()
                          let form = $("#registerForm")[0]
                          let formData = new FormData(form)
                          axios.post('/register', formData, {
                              headers: {
                                  'Content-Type': 'application/json',
                              }
                          }).then(function(response) {
                              //response
                              console.log(response);
                          }).catch((err) => {
                              console.log(err.response.data);
                              //   for (const key in err.response.data) {
                              //       err.response.data[key].forEach(element => {
                              //           console.log(element);

                              //       });
                              //   }




                          });
                          //   $.ajax({
                          //       headers: {
                          //           'X-CSRF-TOKEN': "{{ csrf_token() }}"
                          //       },
                          //       type: "post",
                          //       url: "{{ url('register') }}",
                          //       data: JSON.stringify(formData),
                          //       contentType: "application/json",
                          //       dataType: "json",
                          //       success: function(response) {
                          //           console.log(response);
                          //       },
                          //       error: (err) => {
                          //           console.log(err.responseJSON);

                          //   for (const key in err.responseJSON) {

                          //       console.log(`${key}: ${ err.responseJSON[key]}`);
                          //   }
                          //       }
                          //   });
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
