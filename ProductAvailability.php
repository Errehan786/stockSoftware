<?php
include_once('config.php'); 
include_once('include/auth.php');
$sql_product_avl = $conn->query("SELECT distinct product_id FROM `product_batch_sub_iteam` where user_reg_id='$_SESSION[id]' order by id");
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
  <meta charset="utf-8" />
  <title>Product Availability | <?php echo $_SESSION['userName']?> </title>
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
                <h4 class="mb-sm-0">PRODUCT AVAILABILITY DETAILS </h4>

                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                      Product Availability
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
                      <div class="col-lg-8 col-12">
                        <div class="row">
                          <div class="col-12 col-lg-4 mb-3  mb-md-0">
                            <div class="d-flex align-items-center justify-content-center h-100  ">
                              <div class="search-box  w-100 m-0">
                                <label class="form-label">Search</label>
                                <input type="text" class="form-control search" placeholder="Search...">
                                <i class="ri-search-line search-icon"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-lg-4 mb-2  mb-md-0">
                            <label for="StartleaveDate" class="form-label">To Date</label>
                            <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                          </div>
                          <div class="col-12 col-lg-4 mb-2  mb-md-0">
                            <label for="StartleaveDate" class="form-label">To Date</label>
                            <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                          </div>
                        </div>
                      </div>
                      <!-- <div
                        class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center">
                        <a href="#addNewPurchase"> <button class="btn btn-sm btn-success edit-item-btn"> Add New
                            Product Batch</button>
                        </a>
                      </div> -->
                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                      <table class="table align-middle table-nowrap" id="customerTable">
                        <thead class="table-light">
                          <tr>
                            <th>Product name</th>
                            <th>Product Manufactured</th>
                            <th>Product Sold</th>
                            <th>Reserved</th>
                            <th>Under Manufacturing</th>
                            <th>Available stock to sell</th>
                            <!-- <th>
                              Update
                            </th> -->
                          </tr>

                        </thead>
                        <tbody class="list form-check-all">
                         <?php while($data=$sql_product_avl->fetch(PDO::FETCH_ASSOC)){
                           $productReserve=0;     
                           //sel pre order for customer
                           $sl_all_product_Q = $conn->query("select batch_id from `product_batch_sub_iteam` where product_id='$data[product_id]' and work_status='Completed'");
                           while($rdata = $sl_all_product_Q->fetch(PDO::FETCH_ASSOC)){
                           $sl_pre_order_Q = $conn->query("select purpose,id from `product_batch` where id='$rdata[batch_id]'");
                           $proData=$sl_pre_order_Q->fetch(PDO::FETCH_ASSOC);
                               if($proData['purpose']=="Pre order from customer"){
                                 $sel_reserve_Q = $conn->query("SELECT quantity from `product_batch_sub_iteam` where batch_id='$proData[id]'");
                                 $reserve_data = $sel_reserve_Q->fetch(PDO::FETCH_ASSOC);
                                 $productReserve += $reserve_data['quantity'];
                               }
                           }
                           
                           //sel product all data
                           $sql_all_pro = $conn->query("SELECT *,(select SUM(quantity) from `product_batch_sub_iteam` where work_status='Work in progress' and product_id='$data[product_id]') underManufacturing,(select SUM(qty) from `sub_order_list` where product_id='$data[product_id]') soldProduct,(select SUM(quantity) from `product_batch_sub_iteam` where work_status='Completed' and product_id='$data[product_id]') ProductManufactured FROM `products` where id='$data[product_id]' order by id");
                           $proDta = $sql_all_pro->fetch(PDO::FETCH_ASSOC);
                         ?>    
                          <tr>
                          <td><a style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#itemProduct<?php echo $data['product_id'] ?>"><?php echo $proDta['product_name']?></a>
                          <div class="modal fade" id="itemProduct<?php echo $data['product_id'] ?>" tabindex="-1" aria-labelledby="addeNewItem" aria-hidden="true">
                           <div class="modal-dialog" style="max-width: 100%;">
                            <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Product Details</h5>
                            </div>
                           <div class="modal-body">
                     <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>Product</th>
                          <th>Qty</th>
                          <th>Customer Name</th>
                          <th>Stock</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        <?php
                        //get all product detils
                        $sl_all_pro_Q = $conn->query("select * from `product_batch_sub_iteam` where product_id='$data[product_id]'");
                        while($all_data = $sl_all_pro_Q->fetch(PDO::FETCH_ASSOC)){
                          //sel customer and stock
                          $sl_customer_pro_Q = $conn->query("select customer_name,stock_maintenance,id from `product_batch` where id='$all_data[batch_id]'");  
                          $productBaseDta = $sl_customer_pro_Q->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                          <td><?php echo $proDta['product_name']?></td>
                          <td><?php echo $all_data['quantity']?></td>
                          <td><?php echo $productBaseDta['customer_name']?></td>
                          <td><?php if(empty($productBaseDta['customer_name']))echo $productBaseDta['stock_maintenance']; ?></td>
                          <td><?php if($all_data['work_status']=="Work in progress")echo '<span class="badge badge-soft-danger text-uppercase">'.$all_data['work_status'].'</span>';
                                    if($all_data['work_status']=="Completed")echo '<span class="badge badge-soft-success text-uppercase">'.$all_data['work_status'].'</span>';
                                ?>
                          </td>
                          <td><a href="print-manufacture-batch-availability.php?id=<?php echo $productBaseDta['id']?>&action=print" class="btn btn-sm btn-success edit-item-btn">Print</a></td>
                        </tr>
                        <?php }?>    
                      </tbody>
                    </table>
                            
                            
                           </div>
                          </div>
                         </div>
                        </div>
                          
                          </td>
                          <td>
                          <?php if(empty($proDta['ProductManufactured']))$ProductManufactured_1=0;else $ProductManufactured_1=$proDta['ProductManufactured'];
                               echo $ProductManufactured_1;
                          ?></td>
                          <td><?php if(empty($proDta['soldProduct']))$soldProduct_1=0;else $soldProduct_1=$proDta['soldProduct'];
                               echo $soldProduct_1;
                          ?></td>
                          <td><?php echo $productReserve?></td>
                          <td><?php if(empty($proDta['underManufacturing']))$underManufacturing_1=0;else $underManufacturing_1=$proDta['underManufacturing'];
                           echo $underManufacturing_1;
                          ?></td>
                          <td><?php
                           $stockAvlUse = $ProductManufactured_1-$soldProduct_1-$productReserve;
                           echo $stockAvlUse;
                          ?></td>
                            <!-- <td>
                              <div class="d-flex gap-2">
                                <div class="edit">
                                  <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                    data-bs-target="#showModal">Edit</button>
                                </div>
                                <div class="remove">
                                  <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                    data-bs-target="#deleteRecordModal">Remove</button>
                                </div>
                              </div>
                            </td> -->
                          </tr>
                          <?php }?>
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
          <!-- end row -->
        </div>
      </div>
    </div>
  </div>
  </div>
  </td>
  </tr>
  </tfoot>
  </table>
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
  <!--end col-->
  </div>
  <!--end row-->
  </form>
  </div>
  </div>
  </div>
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

  <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>


  <script src="assets/libs/list.js/list.min.js"></script>

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