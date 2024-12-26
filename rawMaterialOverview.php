<?php
include_once('config.php'); 
include_once('include/auth.php');
$sel_item_avl_Q = $conn->query("select * from `items` where user_reg_id='$_SESSION[id]'");
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
<meta charset="utf-8" />
<title>Raw Material Overview | <?php echo $_SESSION['userName']?> </title>
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
              <h4 class="mb-sm-0">RAW MATERIAL OVERVIEW</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"> <a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active"> Raw Material Overview </li>
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
                    <div class="col-12 col-lg-3">
                      <div class="d-flex  justify-content-center h-100  ">
                        <div class="search-box  w-100 m-0">
                          <label class="form-label">Search</label>
                          <input type="text" class="form-control search" placeholder="Search...">
                          <i class="ri-search-line search-icon"></i> </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-9">
                      <div class="row">
                        <div class="col-lg-4 col-12 mb-3">
                          <label for="StartleaveDate" class="form-label">From Date</label>
                          <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                        </div>
                        <div class="col-lg-4 col-12 ">
                          <label for="StartleaveDate" class="form-label">To Date</label>
                          <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr style="border-style: none;">
                          <th>&nbsp;</th>
                          <th style="text-align: center;border-right: 1px solid #cccccc30;border-left: 1px solid #cccccc30;" colspan="2"> Material Purchased </th>
                          <!---<th rowspan="2"> Transfered Item <br>
                            (Previous Year) </th>---->
                          
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                        
                        <tr>
                          <th> Item Name </th>
                          <th> Delivered </th>
                          <th> Waiting for delivery </th>
                          <th> Material Used </th>
                          <th> Reserved Materials </th>
                          <th> Available to Use </th>
                          <th> Total Available </th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
					  <?php
					  while($data=$sel_item_avl_Q->fetch(PDO::FETCH_ASSOC)){
					   //purchage material sum in grame
					   $sl_quantity_sum_Q = $conn->query("select SUM(qty) as totalWeight,(SELECT SUM(qty) from `new_item` where item_name='$data[id]' AND delivery_date IS NOT NULL) AS totalWeightDlv,(SELECT SUM(qty) from `new_item` where item_name='$data[id]' AND delivery_date IS NULL) AS totalWeightWlt from `new_item` where item_name='$data[id]'");
					   $wtData = $sl_quantity_sum_Q->fetch(PDO::FETCH_ASSOC);
					   //sel item name 
					       //$itemName_Q = $conn->query("select item_name,measurement_unit from `items` where id='$data[item_name]'");
					       //$itemData = $itemName_Q->fetch(PDO::FETCH_ASSOC);
					   //material used and reserve
					   $sl_material_used_and_reserve_Q = $conn->query("select SUM(item_qty) as totalUsedMaterial,(SELECT SUM(item_qty) from `raw_material_overview` where item='$data[item_name]' AND status='Work in progress' and user_reg_id='$_SESSION[id]') AS totalReserveMaterial from `raw_material_overview` where item='$data[item_name]' AND status='Completed' and user_reg_id='$_SESSION[id]'");
					   $manufactureData = $sl_material_used_and_reserve_Q->fetch(PDO::FETCH_ASSOC);

					  ?>
                        <tr>
                          <td><?php echo $data['item_name']?></td>
                          <td><?php if(!empty($wtData['totalWeightDlv'])){
                            $totalWeightDlv = $wtData['totalWeightDlv']; 
                            echo $wtData['totalWeightDlv']." ".$data['measurement_unit'];
                          }else $totalWeightDlv=0;?></td>
                          <td><?php if(!empty($wtData['totalWeightWlt'])){
                            $totalWeightWlt = $wtData['totalWeightWlt'];  
                            echo $wtData['totalWeightWlt']." ".$data['measurement_unit'];
                          }else $totalWeightWlt=0;?></td>
                          <!---<td>Product</td>--->
                          <td><?php if(!empty($manufactureData['totalUsedMaterial'])){
                             $totalUsedMaterial = $manufactureData['totalUsedMaterial']; 
                             echo $manufactureData['totalUsedMaterial']." ".$data['measurement_unit'];
                           }else $totalUsedMaterial=0;?></td>
                          <td>
                          <?php if(!empty($manufactureData['totalReserveMaterial'])){
                             $totalReserveMaterial = $manufactureData['totalReserveMaterial'];  
                             echo $manufactureData['totalReserveMaterial']." ".$data['measurement_unit'];
                           }else $totalReserveMaterial=0;?>
                          </td>
                          <td><?php 
                          $availableToUse = $totalWeightDlv-$totalUsedMaterial-$totalReserveMaterial;
                          echo $availableToUse." ".$data['measurement_unit']?>
                          </td>
                          <td>
                          <?php 
                          $availableTotal = $totalWeightDlv-$totalUsedMaterial;
                          echo $availableTotal." ".$data['measurement_unit']?>
                          </td>
                        </tr>
                       <?php }?>
                      </tbody>
                    </table>
                    <div class="noresult" style="display: none">
                      <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"> </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end">
                    <div class="pagination-wrap hstack gap-2"> <a class="page-item pagination-prev disabled" href="#"> </a>
                      <ul class="pagination listjs-pagination mb-0">
                      </ul>
                      <a class="page-item pagination-next" href="#"> </a> </div>
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
<button onClick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"> <i class="ri-arrow-up-line"></i> </button>
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
