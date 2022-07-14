@extends('dash/base')


@section('title')
    Dashboard
@endsection
@section('header_path')
    Dashboard
@endsection
@section('header_title')
    Hello , {{ $user->name }}
@endsection

@section('content')
 
    {{-- <div class="row">
        <div class="col-md-4 col-xl-3 mb-2">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Earnings (monthly)</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>$40,000</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Earnings (annual)</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>$215,000</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 mb-4">
            <div class="card shadow border-start-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Tasks</span></div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>50%</span></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Deliveries list</h4>
                            {{-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> --}}
                        </div>
                        <div class="ms-auto">
                            <div class="dl">
                                <select class="form-select shadow-none">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- title -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover align-middle text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Product</th>
                                    <th class="border-top-0">Client</th>
                                    <th class="border-top-0">Mobile Phone</th>
                                    <th class="border-top-0">Address</th>
                                    <th class="border-top-0">Quantity</th>
                                    <th class="border-top-0">Total Price</th>
                                    <th class="border-top-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white">EA</a>
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16">Baguette</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Single Use</td>
                                    <td>John Doe</td>
                                    <td>
                                        <label class="badge bg-danger">Angular</label>
                                    </td>
                                    <td>46</td>
                                    <td>356</td>
                                    <td>
                                        <h5 class="m-b-0">$2850.06</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a
                                                    class="btn btn-circle d-flex btn-orange text-white">MA</a>
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16">Monster Admin</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Single Use</td>
                                    <td>Venessa Fern</td>
                                    <td>
                                        <label class="badge bg-info">Vue Js</label>
                                    </td>
                                    <td>46</td>
                                    <td>356</td>
                                    <td>
                                        <h5 class="m-b-0">$2850.06</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a
                                                    class="btn btn-circle d-flex btn-success text-white">MP</a>
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16">Material Pro Admin</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Single Use</td>
                                    <td>John Doe</td>
                                    <td>
                                        <label class="badge bg-success">Bootstrap</label>
                                    </td>
                                    <td>46</td>
                                    <td>356</td>
                                    <td>
                                        <h5 class="m-b-0">$2850.06</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a
                                                    class="btn btn-circle d-flex btn-purple text-white">AA</a>
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16">Ample Admin</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Single Use</td>
                                    <td>John Doe</td>
                                    <td>
                                        <label class="badge bg-purple">React</label>
                                    </td>
                                    <td>46</td>
                                    <td>356</td>
                                    <td>
                                        <h5 class="m-b-0">$2850.06</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Sales Summary</h4>
                            <h6 class="card-subtitle">Ample admin Vs Pixel admin</h6>
                        </div>
                        <div class="ms-auto d-flex no-block align-items-center">
                            <ul class="list-inline dl d-flex align-items-center m-r-15 m-b-0">
                                <li class="list-inline-item d-flex align-items-center text-info"><i
                                        class="fa fa-circle font-10 me-1"></i> Ample
                                </li>
                                <li class="list-inline-item d-flex align-items-center text-primary"><i
                                        class="fa fa-circle font-10 me-1"></i> Pixel
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="amp-pxl mt-4" style="height: 350px;">
                        <div class="chartist-tooltip"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Weekly Stats</h4>
                    <h6 class="card-subtitle">Average sales</h6>
                    <div class="mt-5 pb-3 d-flex align-items-center">
                        <span class="btn btn-primary btn-circle d-flex align-items-center">
                            <i class="mdi mdi-cart-outline fs-4"></i>
                        </span>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">Top Sales</h5>
                            <span class="text-muted fs-6">Johnathan Doe</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-muted">+68%</span>
                        </div>
                    </div>
                    <div class="py-3 d-flex align-items-center">
                        <span class="btn btn-warning btn-circle d-flex align-items-center">
                            <i class="mdi mdi-star-circle fs-4"></i>
                        </span>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">Best Seller</h5>
                            <span class="text-muted fs-6">MaterialPro Admin</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-muted">+68%</span>
                        </div>
                    </div>
                    <div class="py-3 d-flex align-items-center">
                        <span class="btn btn-success btn-circle d-flex align-items-center">
                            <i class="mdi mdi-comment-multiple-outline text-white fs-4"></i>
                        </span>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">Most Commented</h5>
                            <span class="text-muted fs-6">Ample Admin</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-muted">+68%</span>
                        </div>
                    </div>
                    <div class="py-3 d-flex align-items-center">
                        <span class="btn btn-info btn-circle d-flex align-items-center">
                            <i class="mdi mdi-diamond fs-4 text-white"></i>
                        </span>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">Top Budgets</h5>
                            <span class="text-muted fs-6">Sunil Joshi</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-muted">+15%</span>
                        </div>
                    </div>

                    <div class="pt-3 d-flex align-items-center">
                        <span class="btn btn-danger btn-circle d-flex align-items-center">
                            <i class="mdi mdi-content-duplicate fs-4 text-white"></i>
                        </span>
                        <div class="ms-3">
                            <h5 class="mb-0 fw-bold">Best Designer</h5>
                            <span class="text-muted fs-6">Nirav Joshi</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge bg-light text-muted">+90%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
