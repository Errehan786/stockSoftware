    <!-- ========== Header Start ========== -->
    <?php include_once('include/header.php'); ?>

    <!-- ========== Header End ========== -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once('include/left-side-menu.php'); ?>
    <!-- ========== Left Sidebar End ========== -->
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
                                <h4 class="mb-sm-0">Sales Credit Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                           Sales Credit Report
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
                        <h5>Sales Credit Report</h5>
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
                          <label for="StartleaveDate" class="form-label">Credit Limit</label>
                          <input type="text" class="form-control" data-provider="flatpickr" id="" />
                        </div>
                        <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <label for="StartleaveDate" class="form-label">Till Date</label>
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
                                    <th>Bill No.</th>
                                    <th>Date</th>
                                    <th>Bill Amount</th>
                                    <th>Amt. Received</th>
                                    <th>Balance</th>
                                    <th>Days</th>
                                </tr>

                            </thead>
                            <tbody class="list form-check-all">
                                <tr>
                                    <td>01234</td>
                                    <td>27 June 2024</td>
                                    <td>6000</td>
                                    <td>4000</td>
                                    <td>1200</td>
                                   <td>4</td>
                                </tr>
                                <tr>
                                    <td>01234</td>
                                    <td>27 June 2024</td>
                                    <td>6000</td>
                                    <td>4000</td>
                                    <td>1200</td>
                                   <td>4</td>
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
        </div>
            <!-- footer start -->
        <?php include_once ('include/footer.php');?>