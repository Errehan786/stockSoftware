<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>

    <meta charset="utf-8" />
    <title>Sales Returns Book | <?php echo $_SESSION['userName']?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
        <!-- Left Sidebar End -->
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
                                <h4 class="mb-sm-0">Sales Returns Book</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                           Sales Book
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
                <div class="row">
                        <div class="col-12 mb-2">
                        <h5>Sales Returns Book</h5>
                    <hr>
                </div>
            </div>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-8 col-12">
                            <div class="row">
                                <div class="col-12 col-lg-4 mb-3  mb-md-0">
                                   <label class="form-label">Account</label>
                                  <select id="" name="" class="form-select"  required>
                                     <option value="">Select Account</option>
                                     <option name="" value="">Cash Account</option>
                                     <option name="" value="">Cash Account</option>
                                     <option name="" value="">Cash Account</option>
                                  </select>
                                </div>
                            <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <label for="StartleaveDate" class="form-label">From Date</label>
                          <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                        </div>
                        <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <label for="StartleaveDate" class="form-label">To Date</label>
                          <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                        </div>
                            </div>
                        </div>
                        <div
                            class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center">
                            <a href="#"> <button class="btn btn-sm btn-success edit-item-btn"> 
                                <i class="ri-download-line"></i>
                                Print
                                </button>
                            </a>
                        </div>

                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>V.No.</th>
                                    <th>Account</th>
                                    <th>Gross. Amt.</th>
                                    <th>Addl.chrgs.</th>
                                    <th>Deductions</th>
                                    <th>Bill Amt.</th>
                                </tr>

                            </thead>
                            <tbody class="list form-check-all">
                                <tr>
                                    <td>1</td>
                                    <td>27 June 2024</td>
                                    <td>01234</td>
                                    <td>Cash Account</td>
                                    <td>4000</td>
                                    <td>200</td>
                                   <td>800</td>
                                   <td>1000</td>
                                </tr>
                                <tr>
                                   <td>2</td>
                                    <td>27 June 2024</td>
                                    <td>01234</td>
                                    <td>Cash Account</td>
                                    <td>4000</td>
                                    <td>200</td>
                                   <td>800</td>
                                   <td>1000</td>
                                </tr>
                                 <tr>
                                   <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                   <td>Total Amount</td>
                                   <td><input type="text" class="form-control" data-provider="flatpickr" id="" style="width:180px"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
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
                            <a class="page-item pagination-prev disabled" href="#">

                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">

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




    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>



</html>