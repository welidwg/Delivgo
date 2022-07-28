 <div class="row" id="content">
     <!-- Column -->
     <div class="col-lg-4 col-xlg-3 col-md-5">
         <div class="card">
             <div class="card-body">
                 <center class="m-t-30">
                     <form action="" id="avatarForm" class="" enctype="multipart/form-data">
                         <div class="position-relative">

                             <img id="avatarContainer"
                                 src={{ $user->avatar == '' ? asset('images/users/1.jpg') : asset('uploads/logos/' . $user->avatar) }}
                                 class="rounded shadow" width="150" />
                             <br>
                             <label for="avatar" class="btn text-dark position-relative fs-4 fw-bold"><i
                                     class="fas fa-edit"></i></label>
                             <input type="file" id="avatar" accept="image/*" hidden name="avatar">
                         </div>
                         @csrf
                         <button id="submitAvatar" style="display: none" type="submit"
                             class="btn btn-primary mt-3 ">Save</button>

                     </form>
                     <script>
                         $("#avatarForm").on("submit", (e) => {
                             e.preventDefault();
                             let form = $("#avatarForm")[0]
                             let formData = new FormData(form)
                             $("#submitAvatar").html(spinner)
                             axios.post("/user/update/logo/{{ Auth::user()->user_id }}", formData)
                                 .then(res => {

                                     console.log(res)
                                     $("#submitAvatar").fadeOut()
                                     toastr.success(res.data.message)
                                     $('#profileCont').load("/layouts/profile")

                                 })
                                 .catch(err => {
                                     console.error(err.response.data);
                                     toastr.error("Sorry, something went wrong !")

                                 }).finally(() => {
                                     $("#submitAvatar").html("save")

                                 })
                         })
                     </script>
                     <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                     <h6 class="card-subtitle">{{ '@' . $user->username }}</h6>
                     {{-- <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                    <font class="font-medium">254</font>
                                </a></div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                    <font class="font-medium">54</font>
                                </a></div>
                        </div> --}}
                 </center>
                 <script>
                     $('#avatar').change(function() {
                         var i = $(this).prev('label').clone();
                         console.log("cheange");
                         var file = $('#avatar')[0].files[0].name;
                         var reader = new FileReader();
                         reader.onload = function(e) {
                             $('#submitAvatar').fadeIn("slow")
                             $('#avatarContainer').attr('src', e.target.result)
                         };
                         reader.readAsDataURL($('#avatar')[0].files[0]);
                         console.log();


                     });
                 </script>
             </div>
             <div>
                 <hr>
             </div>
             <div class="card-body"> <small class="text-muted">E-mail </small>
                 <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Téléphone</small>
                 <h6>+216 {{ $user->phone }}</h6> <small class="text-muted p-t-30 db">Adresse</small>
                 <h6>{{ $user->address != '' ? $user->address : 'inconnue' }}</h6>
                 {{-- <div class="map-box">
                     <iframe
                         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                         width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                 </div> <small class="text-muted p-t-30 db">Social Profile</small>
                 <br />
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                 <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button> --}}
             </div>
         </div>

     </div>
     <!-- Column -->
     <!-- Column -->
     <div class="col-lg-8 col-xlg-9 col-md-7">
         <div class="card">
             <div class="card-body">
                 <form class="form-horizontal form-material mx-2" id="updateForm">
                     <div class="form-group">
                         <label class="col-md-12">Nom complet</label>
                         <div class="col-md-12">
                             <input type="text" name="name" placeholder="Johnathan Doe"
                                 value="{{ $user->name }}" class="form-control form-control-line">
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="col-md-12">Nom d'utilisateur</label>
                         <div class="col-md-12">
                             <input type="text" name="username" placeholder="Johnathan_doe"
                                 value="{{ $user->username }}" class="form-control form-control-line">
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="example-email" class="col-md-12">E-mail</label>
                         <div class="col-md-12">
                             <input type="email" name="email" value="{{ $user->email }}"
                                 placeholder="johnathan@admin.com" class="form-control form-control-line"
                                 name="example-email" id="example-email">
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="col-md-12">Mot de passe</label>
                         <div class="col-md-12">
                             <input type="password" name="password" placeholder="New Password (optional)"
                                 name="password" class="form-control form-control-line">
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="col-md-12">N° Téléphone:</label>
                         <div class="col-md-12">
                             <input type="tel" name="phone" value="{{ $user->phone }}"
                                 placeholder="123 456 7890" class="form-control form-control-line">
                         </div>
                     </div>
                     @if ($user->type == 2)
                         <div class="form-group">
                             <label class="col-md-12">Prix de livraison (DT)</label>
                             <small class="fw-bold text-info">NB:écrire 0 si vous livrez sans frais.
                             </small>

                             <div class="col-md-12">
                                 <input type="number" name="deliveryPrice" value="{{ $user->deliveryPrice }}"
                                     placeholder="(ex:7 )" required class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Suppléments maximum :</label>
                             <div class="col-md-12">
                                 <input type="number" name="perSupp" placeholder="(ex:5 )" required
                                     value="{{ count($user->configs) != 0 ? $user->configs[0]->perSupp : '' }}"
                                     class="form-control form-control-line">
                             </div>

                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Garnitures maximum :</label>
                             <div class="col-md-12">
                                 <input type="number" name="perTopp"
                                     value="{{ count($user->configs) != 0 ? $user->configs[0]->perTopp : '' }}"
                                     placeholder="(ex:5 )" required class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Sauces maximum :</label>
                             <div class="col-md-12">
                                 <input type="number" name="perSauce"
                                     value="{{ count($user->configs) != 0 ? $user->configs[0]->perSauce : '' }}"
                                     placeholder="(ex:5 )" required class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Boissons maximum :</label>
                             <div class="col-md-12">
                                 <input type="number" name="perDrink"
                                     value="{{ count($user->configs) != 0 ? $user->configs[0]->perDrink : '' }}"
                                     placeholder="(ex:5 )" required class="form-control form-control-line">
                             </div>
                         </div>
                         @foreach ($user->configs as $config)
                         @endforeach


                     @endif
                     <div class="form-group">
                         <label class="col-sm-12">Selectionnez votre ville</label>
                         <div class="col-sm-12">
                             <select required class="form-select shadow-none form-control-line" name="city">
                                 @if ($user->city != '')
                                     <option>{{ $user->city }}</option>
                                 @endif
                                 <option>Mahdia</option>
                                 <option>Monastir</option>
                                 <option>Sousse</option>

                             </select>
                         </div>
                     </div>

                     <div class="form-group">
                         <label class="col-md-12">adresse</label>
                         <div class="col-md-12">
                             <textarea rows="3" name="address" class="form-control form-control-line" required
                                 placeholder="Précisez votre adresse">{{ $user->address != '' ? $user->address : null }}</textarea>
                         </div>
                     </div>
                     <input type="hidden" name="id" id="id" value={{ $user->user_id }}>

                     @csrf

                     <div class="form-group">
                         <div class="col-sm-12">
                             <button type="submit" id="btnUpdate"
                                 class="btn btn-success text-white">Enregistrer</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <script>
         $("#updateForm").on("submit", (e) => {
             e.preventDefault();
             let form = $("updateForm")[0]
             let formData = new FormData(form)
             let id = $("#id").val()
             $("#btnUpdate").html(spinner)
             axios.post(`/user/update/${id}`, $("#updateForm").serialize())
                 .then(res => {
                     console.log(res.data.message)
                     toastr.success(res.data.message)
                     $('#profileCont').load("/layouts/profile");
                 })
                 .catch(err => {
                     console.error(err.response.data);
                     if (err.response.data.message != undefined) {

                     } else {
                         for (const k in err.response.data) {

                             toastr.error(err.response.data[k])
                         }
                     }
                 })
                 .finally(() => {
                     $("#btnUpdate").html("Update Profile")

                 })
         })
     </script>
     <!-- Column -->
 </div>
