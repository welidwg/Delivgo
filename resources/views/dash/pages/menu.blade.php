@extends('dash/base')

@php
use App\Models\Category;
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
                    <div class="table-responsive" id="categoriesTable">


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

                                <a href="" class="btn" data-bs-target="#addSuppModal" data-bs-toggle="modal"><i
                                        class="fas fa-plus"></i></a>

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

                                <a href="" class="btn" data-bs-target="#addSaucesModal" data-bs-toggle="modal"><i
                                        class="fas fa-plus"></i></a>

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

                                <a href="" class="btn" data-bs-target="#addDrinksModal" data-bs-toggle="modal"><i
                                        class="fas fa-plus"></i></a>

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
