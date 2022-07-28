@extends('dash/base')

@php
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplement;
use App\Models\Garniture;
use App\Models\Sauce;
use App\Models\Drink;
$categs = Category::where('resto_id', Auth::user()->user_id)->get();

@endphp
@section('title')
    Menu
@endsection
@section('header_path')
    Menu
@endsection
@section('header_title')
    <i class="fal fa-burger-soda"></i>&nbsp; My Menu
@endsection

@section('content')
    @include('dash/modals/menuModals')

    <div class="row">
        <!-- column -->
        <div class="col col-md-8 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Products&nbsp;

                                <a href="" class="btn " data-bs-target="#addProductModal" data-bs-toggle="modal"><i
                                        class="fas fa-plus"></i></a>

                            </h4>


                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="productsTable">
                        </table>

                    </div>
                    <script>
                        $("#productsTable").load("/dash/productsTable")
                    </script>
                    @php
                        $products = Product::where('resto_id', Auth::user()->user_id)->get();
                    @endphp
                    @forelse ($products as $product)
                        {{-- Product Edit --}}
                        <div class="modal fade" id="editProductModal{{ $product->product_id }}" tabindex="-1"
                            role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>



                                            <h6 for="" class="mb-3 fs-3 color-3 text-center">{{ $product->label }}
                                            </h6>
                                            <div>
                                                @php
                                                    $catges1 = Category::where('id', '!=', $product->category->id)->get();
                                                @endphp
                                                <form action="" method="POST"
                                                    id="editProductForm{{ $product->product_id }}" class="formsModal"
                                                    enctype="multipart/form-data">

                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Product label" name="label"
                                                            value="{{ $product->label }}">
                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-pen"></i></label>
                                                        <textarea class="form-control shadow-none border-0  bg-transparent" name="description"
                                                            placeholder="Product Description (Optional )" cols="" rows="2" style="resize: none">{{ $product->description }}</textarea>

                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" min="1"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Product price" name="price"
                                                            value="{{ $product->price }}" step="0.1">
                                                    </div>

                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-list"></i></label>

                                                        <select id="category" name="category"
                                                            class="form-control shadow-none border-0  bg-transparent">
                                                            <option value="{{ $product->category->id }}">
                                                                {{ $product->category->label }}
                                                            </option>


                                                            @foreach ($catges1 as $cat)
                                                                <option value={{ $cat->id }}>{{ $cat->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                Have Supplements ?</label>
                                                            <input class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckDefault" name="supplement"
                                                                {{ $product->have_supplement ? 'checked' : '' }}>

                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                Have topping ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="topping"
                                                                {{ $product->have_toppings ? 'checked' : '' }}>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                Have sauces ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="sauce"
                                                                {{ $product->have_sauces ? 'checked' : '' }}>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-utensils-alt"></i></label>
                                                        <div class="form-check form-switch">
                                                            <label style="width: auto" class="form-check-label"
                                                                for="flexSwitchCheckDefault">
                                                                Have drinks ?</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" id="flexSwitchCheckDefault" name="drink"
                                                                {{ $product->have_drinks ? 'checked' : '' }}>

                                                        </div>
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->product_id }}">
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="picture" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-camera"></i>
                                                        </label>
                                                        <label style="width: auto;text-align: left"
                                                            for="picture{{ $product->product_id }}">&nbsp;&nbsp;Please
                                                            select
                                                            product image</label>
                                                        <input type="file" min="1" hidden
                                                            id="picture{{ $product->product_id }}"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Product pic" name="picture" accept="image/*">
                                                    </div>
                                                    <input type="hidden" name="resto_id"
                                                        value="{{ Auth::user()->user_id }}">
                                                    <div class="mx-auto mt-3">
                                                        <button type="submit"
                                                            id="editProductBtnSubmit{{ $product->product_id }}"
                                                            class="btn w-100">Update&nbsp;
                                                            <i class="fal fa-check"></i></button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldval{{ $product->product_id }} = $("#editProductBtnSubmit{{ $product->product_id }}").html()

                                            $("#editProductForm{{ $product->product_id }}").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editProductBtnSubmit{{ $product->product_id }}").html(spinner)
                                                let form{{ $product->product_id }} = $("#editProductForm{{ $product->product_id }}")[0]
                                                let formdata{{ $product->product_id }} = new FormData(form{{ $product->product_id }})

                                                axios.post("/product/update/{{ $product->product_id }}", formdata{{ $product->product_id }})
                                                    .then(res => {
                                                        toastr.info(res.data.message)
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
                                                        $("#editProductBtnSubmit{{ $product->product_id }}").html(
                                                            oldval{{ $product->product_id }})
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                        {{-- END PRODUCT Edit --}}
                    @empty
                    @endforelse


                </div>
            </div>
        </div>
        <div class="col col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Categories&nbsp;

                                <a href="" class="btn" data-bs-target="#addCategoryModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="categoriesTable" style="max-height: 500px;overflow: auto">


                    </div>
                    <script>
                        $("#categoriesTable").load("/dash/categoriesTable")
                    </script>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Supplements&nbsp;

                                <a href="" class="btn" data-bs-target="#addSuppModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="tableSupps">

                    </div>
                    <script>
                        $("#tableSupps").load("/dash/supplementsTable")
                    </script>
                    @php
                        $supplements = Supplement::where('resto_id', Auth::user()->user_id)->get();
                    @endphp
                    @forelse ($supplements as $supplement)
                        {{-- Product Edit --}}
                        <div class="modal fade" id="editSuppModal{{ $supplement->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editSuppForm{{ $supplement->id }}"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Edit
                                                        Supplement</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="{{ $supplement->label }}"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Supplement label" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1"
                                                            value="{{ $supplement->price }}"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Unit price" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editSuppBtn{{ $supplement->id }}"
                                                            class="btn w-100">Update&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEdit{{ $supplement->id }} = $("#editSuppBtn{{ $supplement->id }}").html()

                                            $("#editSuppForm{{ $supplement->id }}").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editSuppBtn{{ $supplement->id }}").html(spinner)
                                                let formEditSupp{{ $supplement->id }} = $("#editSuppForm{{ $supplement->id }}")[0]
                                                let formdataEditSupp{{ $supplement->id }} = new FormData(formEditSupp{{ $supplement->id }})

                                                axios.post("/supplement/update/{{ $supplement->id }}", formdataEditSupp{{ $supplement->id }})
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#tableSupps").load("/dash/supplementsTable")
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
                                                        $("#editSuppBtn{{ $supplement->id }}").html(
                                                            oldvalEdit{{ $supplement->id }})
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div> <!-- column -->
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Toppings&nbsp;

                                <a href="" class="btn" data-bs-target="#addGarnitureModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->

                    <div class="table-responsive" id="toppingsTable">

                    </div>
                    <script>
                        $("#toppingsTable").load("/dash/toppingsTable")
                    </script>
                    @php
                        $toppings = Garniture::where('resto_id', Auth::user()->user_id)->get();
                    @endphp
                    @forelse ($toppings as $topping)
                        {{-- Product Edit --}}
                        <div class="modal fade" id="editToppingModal{{ $topping->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-body p-4 px-5 ">


                                        <div class="main-content  mb-3 py-auto">

                                            <a href="#" style="" class="close-btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true"><span class="fal fa-times"></span></span>
                                            </a>




                                            <div>
                                                <form action="#" id="editToppForm{{ $topping->id }}"
                                                    class="formsModal">
                                                    <h6 for="" class="mb-3 fs-3 color-3 text-center">Edit
                                                        Topping</h6>

                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-tag"></i></label>
                                                        <input type="text" value="{{ $topping->label }}"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Supplement label" name="label" required>
                                                    </div>
                                                    <div
                                                        class="input-group mb-2 rounded-pill bg-light  align-items-center">
                                                        <label for="" class="px-2 color-3 fs-5"><i
                                                                class="fal fa-coins"></i></label>
                                                        <input type="number" step="0.1"
                                                            value="{{ $topping->price }}"
                                                            class="form-control shadow-none border-0  bg-transparent"
                                                            placeholder="Unit price" name="price" required>
                                                    </div>


                                                    <div class="mx-auto mt-3">
                                                        <button href="#!" type="submit"
                                                            id="editToppBtn{{ $topping->id }}"
                                                            class="btn w-100">Update&nbsp;
                                                            <i class="fal fa-check"></i></button>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>

                                        </div>
                                        <script>
                                            let oldvalEditTopp{{ $topping->id }} = $("#editToppBtn{{ $topping->id }}").html()

                                            $("#editToppForm{{ $topping->id }}").on("submit", (e) => {
                                                e.preventDefault()
                                                $("#editToppBtn{{ $topping->id }}").html(spinner)
                                                let formEditTopp{{ $topping->id }} = $("#editToppForm{{ $topping->id }}")[0]
                                                let formEditTopp{{ $topping->id }} = new FormData(formEditTopp{{ $topping->id }})

                                                axios.post("/toppings/update/{{ $topping->id }}", formEditTopp{{ $topping->id }})
                                                    .then(res => {
                                                        toastr.info(res.data.message)
                                                        $(".modal").modal("hide")
                                                        setTimeout(() => {
                                                            $("#toppingsTable").load("/dash/toppingsTable")
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
                                                        $("#editSuppBtn{{ $supplement->id }}").html(
                                                            oldvalEdit{{ $supplement->id }})
                                                    })


                                            })
                                        </script>


                                    </div>


                                </div>
                            </div>

                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Sauces&nbsp;

                                <a href="" class="btn" data-bs-target="#addSaucesModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="tableSauces">
                        <table class="table mb-0 table-hover align-middle text-nowrap" id="saucesTable">
                        </table>
                    </div>
                    <script>
                        $("#saucesTable").load("/dash/saucesTable")
                    </script>
                </div>
            </div>
        </div>
        <div class="col col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Drinks&nbsp;

                                <a href="" class="btn" data-bs-target="#addDrinksModal"
                                    data-bs-toggle="modal"><i class="fas fa-plus"></i></a>

                            </h4>


                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>

                    </div>
                    <!-- title -->
                    <div class="table-responsive" id="drinksTable">


                    </div>
                    <script>
                        $("#drinksTable").load("/dash/drinksTable")
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        // function LoadDataTable() {
        //     $(".table").DataTable({
        //         "language": {
        //             "decimal": ".",
        //             "emptyTable": "There is no records yet",
        //             "info": "",
        //             "infoFiltered": "",
        //             "infoEmpty": "",
        //             "lengthMenu": "",
        //         }
        //     });
        // }
        // $(window).on("load", function() {
        //     $(".table").DataTable({
        //         "language": {
        //             "decimal": ".",
        //             "emptyTable": "There is no records yet",
        //             "info": "",
        //             "infoFiltered": "",
        //             "infoEmpty": "",
        //             "lengthMenu": "",
        //         }
        //     });
        // });
        // setInterval(() => {
        //     $('.table').DataTable().ajax.reload();
        // }, 1000);
    </script>
@endsection
