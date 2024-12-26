<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <title>New Product Formula Design Details | <?php echo $_SESSION['userName']?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content=" Admin & Dashboard " name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

       <!-- ========== Header Start ========== -->

       <?php include_once ('include/header.php');?>

<!-- ========== Header End ========== -->

<!-- ========== Left Sidebar Start ========== -->
<?php include_once ('include/left-side-menu.php');?>
<!-- ========== Left Sidebar End ========== -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">NEW PRODUCT FORMULA DESIGN DETAILS </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            New Product Formula Design Details
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">


                                <div class="card-body">
                                    <div id="customerList">
                                        <div class="row g-4 mb-4">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center ">
                                                    <div class="search-box ms-2">

                                                        <input type="text" class="form-control search"
                                                            placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <!-- <div class="row">
                                                    <div class="col-6">
                                                        <label for="StartleaveDate" class="form-label">From Date</label>
                                                        <input type="date" class="form-control"
                                                            data-provider="flatpickr" id="StartleaveDate" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="StartleaveDate" class="form-label">To Date</label>
                                                        <input type="date" class="form-control"
                                                            data-provider="flatpickr" id="StartleaveDate" />
                                                    </div>
                                                </div> -->
                                            </div>

                                        </div>

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap a" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>
                                                            Formula Name
                                                        </th>
                                                        <th>
                                                            Description
                                                        </th>
                                                        <th>
                                                            Update
                                                        </th>
                                                    </tr>

                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <tr>
                                                        <td>Scented candle</td>
                                                        <td style="white-space:normal;">Lorem, ipsum dolor sit amet
                                                            consectetur adipisicing elit.
                                                            Deleniti ex earum explicabo reiciendis delectus perspiciatis
                                                            quas alias voluptates, atque quisquam repudiandae, vel
                                                            assumenda voluptatem exercitationem ullam facilis beatae
                                                            quasi vero!</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#showModal">Edit</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal">Remove</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Massage Candle
                                                        </td>
                                                        <td>N/A</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#showModal">Edit</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal">Remove</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Essential Oil
                                                        </td>
                                                        <td>N/A</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#showModal">Edit</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal">Remove</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lotion</td>
                                                        <td>N/A</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#showModal">Edit</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal">Remove</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We
                                                        did not find any
                                                        orders for you search.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled">

                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>



                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Entry</h4>
                                </div>
                                <!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="javascript:void(0);">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">
                                                            Product name
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Product Name" id="vendorName" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Container</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty</label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">WAX</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">WAX percentage
                                                        </label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Oil Name</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Oil percentage
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Oil %." id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Rent For Godown
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Rent." id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Labour Cost
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Labour Cost." id="compnayNameinput" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">CLP</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty
                                                        </label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Electricity
                                                            Expense
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Electricity Expense."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Miscellaneous
                                                            Cost
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Miscellaneous Cost."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Jute Bag</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty</label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Front
                                                            Table</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty</label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Top Table</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty</label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Box Table</label>
                                                        <select id="ForminputState" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <option selected>Item 1
                                                            </option>
                                                            <option value="">Item 2
                                                            </option>
                                                            <option value="">Item 3
                                                            </option>
                                                            <option value="">Item 4
                                                            </option>
                                                            <option value="">Item 5
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Qty</label>
                                                        <input type="text" class="form-control" placeholder="Enter Qty."
                                                            id="compnayNameinput" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>
                                                <!--end col-->


                                                <hr>



                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- footer start -->
            <?php include_once ('include/footer.php');?>
        </div>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div> -->





    <style>
        .form-control1 {
            display: block;

            padding: .5rem .9rem;
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--vz-body-color);
            background-color: var(--vz-input-bg);
            background-clip: padding-box;
            border: 1px solid var(--vz-input-border);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }
    </style>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>