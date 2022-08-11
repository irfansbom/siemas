@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Dashboard 01</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
                        </ol>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <a href="javascript:void(0);" class="btn btn-primary btn-icon text-white me-2">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> Add Account
                        </a>
                        <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
                            <span>
                                <i class="fe fe-log-in"></i>
                            </span> Export
                        </a>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                @include('alert')
                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Sales</h6>
                                                <h3 class="mb-2 number-font">34,516</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary"><i
                                                            class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                        3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="fe fe-trending-up text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Leads</h6>
                                                <h3 class="mb-2 number-font">56,992</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-secondary"><i
                                                            class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                        3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="icon icon-rocket text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Profit</h6>
                                                <h3 class="mb-2 number-font">$42,567</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-success"><i
                                                            class="fa fa-chevron-circle-down text-success me-1"></i>
                                                        0.5%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                    <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Cost</h6>
                                                <h3 class="mb-2 number-font">$34,789</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-danger"><i
                                                            class="fa fa-chevron-circle-down text-danger me-1"></i>
                                                        0.2%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-success-gradient box-shadow-success brround  ms-auto">
                                                    <i class="fe fe-briefcase text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Total Transactions</h3>
                            </div>
                            <div class="card-body pb-0">
                                <div id="chartArea" class="chart-donut"></div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="card custom-card ">
                            <div class="card-header">
                                <h3 class="card-title">Recent Orders</h3>
                            </div>
                            <div class="card-body pt-0 ps-0 pe-0">
                                <div id="recentorders" class="apex-charts ht-150"></div>
                                <div class="row sales-product-infomation pb-0 mb-0 mx-auto wd-100p mt-6">
                                    <div class="col-md-6 col justify-content-center text-center">
                                        <p class="mb-0 d-flex justify-content-center"><span
                                                class="legend bg-primary"></span>Delivered</p>
                                        <h3 class="mb-1 fw-bold">5238</h3>
                                        <div class="d-flex justify-content-center ">
                                            <p class="text-muted mb-0">Last 6 months</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col text-center float-end">
                                        <p class="mb-0 d-flex justify-content-center "><span
                                                class="legend bg-background2"></span>Cancelled</p>
                                        <h3 class="mb-1 fw-bold">3467</h3>
                                        <div class="d-flex justify-content-center ">
                                            <p class="text-muted mb-0">Last 6 months</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                </div>
                <!-- ROW-1 END -->

                <!-- ROW-3 -->
                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">Timeline</h3>
                                </div>
                            </div>
                            <div class="card-body pb-0 pt-4">
                                <div class="activity1">
                                    <div class="activity-blog">
                                        <div class="activity-img brround bg-primary-transparent text-primary">
                                            <i class="fa fa-user-plus fs-20"></i>
                                        </div>
                                        <div class="activity-details d-flex">
                                            <div><b><span class="text-dark"> Mr John </span> </b> Started
                                                following you <span class="d-flex text-muted fs-11">01 June
                                                    2020</span></div>
                                            <div class="ms-auto fs-13 text-dark fw-semibold"><span
                                                    class="badge bg-primary text-white">1m</span></div>
                                        </div>
                                    </div>
                                    <div class="activity-blog">
                                        <div class="activity-img brround bg-secondary-transparent text-secondary">
                                            <i class="fa fa-comment fs-20"></i>
                                        </div>
                                        <div class="activity-details d-flex">
                                            <div><b><span class="text-dark"> Lily </span> </b> 1 Commented
                                                applied <span class="d-flex text-muted fs-11">01 July
                                                    2020</span> </div>
                                            <div class="ms-auto fs-13 text-dark fw-semibold"><span
                                                    class="badge bg-danger text-white">3m</span></div>
                                        </div>
                                    </div>
                                    <div class="activity-blog">
                                        <div class="activity-img brround bg-success-transparent text-success">
                                            <i class="fa fa-thumbs-up fs-20"></i>
                                        </div>
                                        <div class="activity-details d-flex">
                                            <div><b><span class="text-dark"> Kevin </span> </b> liked your site
                                                <span class="d-flex text-muted fs-11">05 July 2020</span>
                                            </div>
                                            <div class="ms-auto fs-13 text-dark fw-semibold"><span
                                                    class="badge bg-warning text-white">5m</span></div>
                                        </div>
                                    </div>
                                    <div class="activity-blog">
                                        <div class="activity-img brround bg-info-transparent text-info">
                                            <i class="fa fa-envelope fs-20"></i>
                                        </div>
                                        <div class="activity-details d-flex">
                                            <div><b><span class="text-dark"> Andrena </span> </b> posted a new
                                                article <span class="d-flex text-muted fs-11">09 October
                                                    2020</span></div>
                                            <div class="ms-auto fs-13 text-dark fw-semibold"><span
                                                    class="badge bg-info text-white">5m</span></div>
                                        </div>
                                    </div>
                                    <div class="activity-blog">
                                        <div class="activity-img brround bg-danger-transparent text-danger">
                                            <i class="fa fa-shopping-bag fs-20"></i>
                                        </div>
                                        <div class="activity-details d-flex">
                                            <div><b><span class="text-dark"> Sonia </span> </b> Delivery in
                                                progress <span class="d-flex text-muted fs-11">12 October
                                                    2020</span></div>
                                            <div class="ms-auto fs-13 text-dark fw-semibold"><span
                                                    class="badge bg-warning text-white">5m</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title fw-semibold ">Browser Usage</h4>
                            </div>
                            <div class="card-body pt-2 pb-2">
                                <div class="d-md-flex align-items-center browser-stats">
                                    <div class="d-flex">
                                        <i class="fa fa-chrome bg-secondary-gradient text-white me-2"></i>
                                        <p class="fs-16 my-auto mb-0">Chrome</p>
                                    </div>
                                    <div class="ms-auto my-auto">
                                        <div class="d-flex">
                                            <span class="my-auto fs-16">35,502</span>
                                            <span class="text-success fs-15"><i class="fe fe-arrow-up"></i>12.75%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center browser-stats">
                                    <div class="d-flex">
                                        <i class="fa fa-opera text-white bg-danger-gradient me-2"></i>
                                        <p class="fs-16 my-auto mb-0">Opera</p>
                                    </div>
                                    <div class="ms-auto my-auto">
                                        <div class="d-flex">
                                            <span class="my-auto fs-16">12,563</span>
                                            <span class="text-danger fs-15"><i class="fe fe-arrow-down"></i>15.12%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center browser-stats">
                                    <div class="d-flex">
                                        <i class="fa fa-firefox text-white bg-purple-gradient me-2"></i>
                                        <p class="fs-16 my-auto mb-0">IE</p>
                                    </div>
                                    <div class="ms-auto my-auto">
                                        <div class="d-flex">
                                            <span class="my-auto fs-16">25,364</span>
                                            <span class="text-success fs-15"><i class="fe fe-arrow-up"></i>24.37%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center browser-stats">
                                    <div class="d-flex">
                                        <i class="fa fa-edge text-white bg-info-gradient me-2"></i>
                                        <p class="fs-16 my-auto mb-0">Firefox</p>
                                    </div>
                                    <div class="ms-auto my-auto">
                                        <div class="d-flex">
                                            <span class="my-auto fs-16">14,635</span>
                                            <span class="text-success fs-15"><i class="fe fe-arrow-up"></i>15,63%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center browser-stats">
                                    <div class="d-flex">
                                        <i class="fa fa-android text-white bg-success-gradient me-2"></i>
                                        <p class="fs-16 my-auto mb-0">Android</p>
                                    </div>
                                    <div class="ms-auto my-auto">
                                        <div class="d-flex">
                                            <span class="my-auto fs-16">15,453</span>
                                            <span class="text-danger fs-15"><i class="fe fe-arrow-down"></i>23.70%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title fw-semibold ">Daily Activity</h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="task-list">
                                    <li>
                                        <i class="task-icon bg-primary"></i>
                                        <h6>Task Finished<span class="text-muted fs-11 mx-2">29 Oct 2020</span>
                                        </h6>
                                        <p class="text-muted fs-12">Adam Berry finished task on<a
                                                href="javascript:void(0);" class="fw-semibold"> Project
                                                Management</a></p>
                                    </li>
                                    <li>
                                        <i class="task-icon bg-secondary"></i>
                                        <h6>New Comment<span class="text-muted fs-11 mx-2">25 Oct 2020</span>
                                        </h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a
                                                href="javascript:void(0);" class="fw-semibold"> AngularJS
                                                Template</a></p>
                                    </li>
                                    <li>
                                        <i class="task-icon bg-primary"></i>
                                        <h6>New Comment<span class="text-muted fs-11 mx-2">25 Oct 2020</span>
                                        </h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a
                                                href="javascript:void(0);" class="fw-semibold"> AngularJS
                                                Template</a></p>
                                    </li>
                                    <li>
                                        <i class="task-icon bg-secondary"></i>
                                        <h6>Task Overdue<span class="text-muted fs-11 mx-2">14 Oct 2020</span>
                                        </h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a
                                                href="javascript:void(0);" class="fw-semibold"> Integrated
                                                management</a></p>
                                    </li>
                                    <li>
                                        <i class="task-icon bg-primary"></i>
                                        <h6>Task Overdue<span class="text-muted fs-11 mx-2">29 Oct 2020</span>
                                        </h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a
                                                href="javascript:void(0);" class="fw-semibold"> Integrated
                                                management</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <!-- ROW-3 END -->

                <!-- ROW-5 -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Product Sales</h3>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table  border text-nowrap text-md-nowrap mg-b-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Gavin Gibson</td>
                                                <td>Account manager</td>
                                                <td>$230,540</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Julian Kerr</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>$55,300</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Cedric Kelly</td>
                                                <td>Accountant</td>
                                                <td>$234,100</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Samantha May</td>
                                                <td>Junior Technical Author</td>
                                                <td>$43,198</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
@endsection

@section('script')
@endsection
