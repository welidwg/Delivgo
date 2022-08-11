@if (Auth::user()->type == 2)

    {{-- Catgeory Add --}}

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">
                    <div class="main-content mb-3 py-auto">
                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" id="AddCategoryForm" class="formsModal">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajouter une catégorie</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Nom" name="label" required>
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">


                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addcategBtn" class="btn w-100">Add&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                        </form>

                        <script>
                            $("#AddCategoryForm").on("submit", (e) => {
                                e.preventDefault()
                                let btn = $("#addcategBtn")
                                let oldval = btn.html()
                                btn.html(spinner);
                                axios.post("/category/add", $("#AddCategoryForm").serialize())
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        $("#AddCategoryForm").trigger("reset")
                                        $(".modal").modal("hide")
                                        setTimeout(() => {
                                            $("#categoriesTable").load("/dash/categoriesTable")
                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)

                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            })
                        </script>

                    </div>

                </div>


            </div>
        </div>
    </div>
    {{-- END Category ADD --}}

    {{-- Product Add --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">


                    <div class="main-content  mb-3 py-auto">

                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" method="POST" id="AddProductForm" class="formsModal"
                            enctype="multipart/form-data">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajouter un produit</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Titre" name="label">
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-pen"></i></label>
                                <textarea class="form-control shadow-none border-0  bg-transparent" name="description"
                                    placeholder=" Description (Optionel )" cols="" rows="2" style="resize: none"></textarea>

                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                <input type="number" min="1"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Prix (5 équivalant à  5 dinars)" name="price" step="0.1">
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-list"></i></label>

                                <select id="category" name="category"
                                    class="form-control shadow-none border-0  bg-transparent">
                                    <option value="">Choisissez une catégorie</option>

                                    @foreach ($categs as $cat)
                                        <option value={{ $cat->id }}>{{ $cat->label }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i
                                        class="fal fa-utensils-alt"></i></label>
                                <div class="form-check form-switch">
                                    <label style="width: auto" class="form-check-label" for="flexSwitchCheckDefault">
                                        A des supplémnets ?</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="supplement">

                                </div>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i
                                        class="fal fa-utensils-alt"></i></label>
                                <div class="form-check form-switch">
                                    <label des style="width: auto" class="form-check-label"
                                        for="flexSwitchCheckDefault">
                                        A des garnitures ?</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="topping">

                                </div>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i
                                        class="fal fa-utensils-alt"></i></label>
                                <div class="form-check form-switch">
                                    <label style="width: auto" class="form-check-label" for="flexSwitchCheckDefault">
                                        A des sauces ?</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="sauce">

                                </div>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i
                                        class="fal fa-utensils-alt"></i></label>
                                <div class="form-check form-switch">
                                    <label style="width: auto" class="form-check-label" for="flexSwitchCheckDefault">
                                        A des boissons ?</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="drink">

                                </div>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="picture" class="px-2 color-3 fs-5"><i class="fal fa-camera"></i>
                                </label>
                                <label style="width: auto;text-align: left" for="picture">&nbsp;&nbsp;Choisissez une
                                    photo pour le produit</label>
                                <input type="file" min="1" hidden id="picture"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Product pic" name="picture" accept="image/*">
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">
                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addProductBtnSubmit"
                                    class="btn w-100">Ajouter&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                    </div>
                    </form>
                    <script>
                        let btn = $("#addProductBtnSubmit")
                        let oldval = btn.html()
                        $("#AddProductForm").on("submit", (e) => {
                            e.preventDefault()

                            if ($("#category").val() == "") {
                                toastr.error("Séléctionnez une catégorie")
                            } else {
                                btn.html(spinner)
                                let form = $("#AddProductForm")[0]
                                let formdata = new FormData(form)
                                axios.post("/product/add", formdata)
                                    .then(res => {
                                        console.log(res)
                                        toastr.success(res.data.message)
                                        $("#AddProductForm").trigger("reset")
                                        $(".modal").modal("hide")
                                        setTimeout(() => {
                                            $("#productsTable").load("/dash/productsTable")
                                        }, 700);

                                    })
                                    .catch(err => {
                                        console.error(err);
                                        if (err.response.data.type != undefined) {

                                            toastr.error(err.response.data.message)
                                        } else {
                                            for (const k in err.response.data) {
                                                toastr.error(err.response.data[k])

                                            }
                                        }
                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            }

                        })
                    </script>

                </div>


            </div>
        </div>
    </div>
    {{-- END PRODUCT ADD --}}


    {{-- START TOPPING ADD --}}

    <div class="modal fade" id="addGarnitureModal" tabindex="-1" role="dialog"
        aria-labelledby="addGarnitureModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">
                    <div class="main-content mb-3 py-auto">
                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" id="AddToppingForm" class="formsModal">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajoutez garniture</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Nom" name="label" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                <input type="number" step="0.1"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Prix unitaire (0 équivalent à gratuit)" name="price" required>
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">


                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addToppinggBtn"
                                    class="btn w-100">Ajouter&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                            @csrf
                        </form>

                        <script>
                            $("#AddToppingForm").on("submit", (e) => {
                                e.preventDefault()
                                let btn = $("#addToppinggBtn")
                                let oldval = btn.html()
                                btn.html(spinner);
                                axios.post("/topping/add", $("#AddToppingForm").serialize())
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        $("#AddToppingForm").trigger("reset")
                                        $(".modal").modal("hide")
                                        setTimeout(() => {
                                            $("#toppingsTable").load("/dash/toppingsTable");
                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)

                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            })
                        </script>

                    </div>

                </div>


            </div>
        </div>
    </div>

    {{-- END TOPPING ADD --}}


    {{-- START Sauces ADD --}}

    <div class="modal fade" id="addSaucesModal" tabindex="-1" role="dialog" aria-labelledby="addSaucesModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">
                    <div class="main-content mb-3 py-auto">
                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" id="AddSauceForm" class="formsModal">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajoutez une sauce</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Nom" name="label" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                <input type="number" step="0.1"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Prix unitaire (0 équivalent à gratuit)" name="price" required>
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">


                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addSauceBtn"
                                    class="btn w-100">Ajoutez&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                            @csrf
                        </form>

                        <script>
                            $("#AddSauceForm").on("submit", (e) => {
                                e.preventDefault()
                                let btn = $("#addSauceBtn")
                                let oldval = btn.html()
                                btn.html(spinner);
                                axios.post("/sauce/add", $("#AddSauceForm").serialize())
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        $("#AddSauceForm").trigger("reset")
                                        $(".modal").modal("hide")
                                        setTimeout(() => {
                                            $("#saucesTable").load("/dash/saucesTable")
                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)

                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            })
                        </script>

                    </div>

                </div>


            </div>
        </div>
    </div>

    {{-- END SUACES ADD --}}



    {{-- START DRINKS ADD --}}

    <div class="modal fade" id="addDrinksModal" tabindex="-1" role="dialog" aria-labelledby="addDrinksModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">
                    <div class="main-content mb-3 py-auto">
                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" id="AddDrinkForm" class="formsModal">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajouter un boisson</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Nom" name="label" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                <input type="number" step="0.1"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Prix unitaire (0 équivalent à gratuit)" name="price" required>
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">


                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addDrinkgBtn" class="btn w-100">Add&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                            @csrf
                        </form>

                        <script>
                            $("#AddDrinkForm").on("submit", (e) => {
                                e.preventDefault()
                                let btn = $("#addDrinkgBtn")
                                let oldval = btn.html()
                                btn.html(spinner);
                                axios.post("/drink/add", $("#AddDrinkForm").serialize())
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            $("#drinksTable").load("/dash/drinksTable");
                                            $("#AddDrinkForm").trigger("reset")
                                            $(".modal").modal("hide")

                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)

                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            })
                        </script>

                    </div>

                </div>


            </div>
        </div>
    </div>

    {{-- END DRINKS ADD --}}

    {{-- START Supplements ADD --}}

    <div class="modal fade" id="addSuppModal" tabindex="-1" role="dialog" aria-labelledby="addSuppsModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 ">
                    <div class="main-content mb-3 py-auto">
                        <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true"><span class="fal fa-times"></span></span>
                        </a>


                        <form action="#" id="AddSuppForm" class="formsModal">
                            <h6 for="" class="mb-3 fs-3 color-3 text-center">Ajouter un supplément</h6>

                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-tag"></i></label>
                                <input type="text" class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Nom" name="label" required>
                            </div>
                            <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                <label for="" class="px-2 color-3 fs-5"><i class="fal fa-coins"></i></label>
                                <input type="number" step="0.1"
                                    class="form-control shadow-none border-0  bg-transparent"
                                    placeholder="Prix unitaire (0 équivalent à gratuit)" name="price" required>
                            </div>
                            <input type="hidden" name="resto_id" value="{{ Auth::user()->user_id }}">


                            <div class="mx-auto mt-3">
                                <button href="#!" type="submit" id="addSuppBtn" class="btn w-100">Add&nbsp;
                                    <i class="fal fa-plus"></i></button>
                            </div>
                            @csrf
                        </form>

                        <script>
                            $("#AddSuppForm").on("submit", (e) => {
                                e.preventDefault()
                                let btn = $("#addSuppBtn")
                                let oldval = btn.html()
                                btn.html(spinner);
                                axios.post("/supplement/add", $("#AddSuppForm").serialize())
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            $("#tableSupps").load("/dash/supplementsTable");
                                            $("#AddSuppForm").trigger("reset")
                                            $(".modal").modal("hide")


                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)

                                    }).finally(() => {
                                        btn.html(oldval)
                                    })
                            })
                        </script>

                    </div>

                </div>


            </div>
        </div>
    </div>

    {{-- END Supplements ADD --}}

@endif
