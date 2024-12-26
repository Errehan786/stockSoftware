<?php
include_once('config.php'); 
include_once('include/auth.php');
//sel customer
$result_sl_customer = $conn->query("SELECT name,reg_id FROM `customer` where user_reg_id='$_SESSION[id]'");

if(isset($_REQUEST['productnewid'])){
$sql = "SELECT * FROM `order_sheet` WHERE id={$_REQUEST['productnewid']}";
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
}

//get order exists in product manufacture or not
$result_product_manufacture = $conn->query("SELECT id,customer_name,batch_code FROM `product_batch` where user_reg_id='$_SESSION[id]' and order_id='$row[order_ID]' and customer_name='$row[customer_name]' and purpose='Pre order from customer'");

if(isset($_REQUEST['main_update'])){
  $customerName = $_REQUEST['customer_name'];
  $date = $_REQUEST['date'];
  $orderID = $_REQUEST['order_id'];
  $status = $_REQUEST['status'];
  $deliveryStatus = $_REQUEST['delivery_status'];
  $sql3 = "UPDATE `order_sheet` SET `customer_name`='$customerName',`date`='$date',`order_ID`='$orderID',`status`='$status',`delivery_status`='$deliveryStatus' WHERE id={$_REQUEST['productnewid']}";
  if($result3 = $conn->query($sql3)){
    $orderID = $conn->lastInsertId();
    for($i=0;$i<sizeof($_REQUEST['product_id']);$i++){
    $productID = $_REQUEST['product_id'][$i];
    $qty = $_REQUEST['qty'][$i];
    $cost = $_REQUEST['cost'][$i];
    $childRowId = $_REQUEST['hidden_id'][$i];
    $sql4 = "UPDATE `sub_order_list` SET `product_id`='$productID',`qty`='$qty',`cost`='$cost' WHERE id={$childRowId} && order_list_id = {$_REQUEST['productnewid']}";
    $result4 = $conn->exec($sql4);
    }
    $msg3 = '<h6 class="alert alert-success mx-3 mt-3">Data has been Updated successfull</h6>';
    // echo '<script>window.location = "orderSheetList.php"</script>'; 
    ?>
    <script>
    setTimeout(
        function(){
            window.location = "orderSheetList.php"; 
        },
    1000);
    </script>
    <?php
        }else{
        $msg3 = '<div class="mx-3 mt-3">
        <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data not Updated</h6> </div>';
    ?>
    <script>
     setTimeout(
        function(){
            window.location = "orderSheetList.php"; 
        },
    1000);
    </script>
<?php
  }
 }

?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
  <meta charset="utf-8" />
  <title>Order Sheet Form | <?php echo $_SESSION['userName']?> </title>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>	
<script>
        $(document).ready(function() {
      //alert('ok');
        var max_fields1      = 50;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        
        var x = 1; 
        $(add_button1).click(function(e){ 
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex gap-2"><tr> <td> <input type="text" class="form-control" name="product_name[]" placeholder="Product Name "/> </td> <td> <input type="text" class="form-control" name="qty[]" placeholder="Enter Qty"/></td><td><input type="text" class="form-control" name="cost[]" placeholder="Cost" /></td><td></td></tr><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete" style="height:30px;">Remove</a></div>'); 
           //alert('Fields added');
            }
        else
        {
        alert('You Reached the limits')
        }
        });
        
        $(wrapper1).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
        alert('Fields removed');
        })
     });
    </script>

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
                <h4 class="mb-sm-0">ORDER SHEET FORM </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Order Sheet Form</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          
          <!-- end page title -->
          <div class="row">
            <div class="col-xxl-12">
              <div class="card">
                  <?php
                  if(isset($msg3)){
                      echo $msg3;
                  }
                  ?>
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Order Details 
                    <?php if($result_product_manufacture->rowCount()>0){
                    $manufactureData = $result_product_manufacture->fetch(PDO::FETCH_ASSOC);
                      echo "<br><small><a href='editmanufactureBatch.php?id=$manufactureData[id]'><font color='green'>Manufacturing Batch Code: ".$manufactureData['batch_code']."</font></a></small>";
                    }else echo "<br><small><a href='productmanufacturebatch.php?orderid=$row[order_ID]&custid=$row[customer_name]'><font color='red'><u>For Product Manufacturing</u></font></a></small>";?></h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="firstNameinput" class="form-label">Customer Name</label>
                            <select name="customer_name" class="form-control" required/>
                            <?php 
                            $customerList = '<option value="">Select Customer</option>';
                            while($data=$result_sl_customer->fetch(PDO::FETCH_ASSOC)){
                                if($row['customer_name']==$data['reg_id'])$slSts = "selected";else $slSts = '';
                                $customerList .='<option '.$slSts.' value="'.$data['reg_id'].'">'.$data['name'].' '.$data['mobile_no'].'</option>';
                            }
                            echo $customerList;
                            ?>
                          </select>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label for="StartleaveDate" class="form-label">Select Date</label>
                            <input type="date" class="form-control" name="date" value="<?php if(isset($row['date'])){echo $row['date'];}?>" data-provider="flatpickr" id="StartleaveDate" required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Order ID</label>
                            <input type="text" class="form-control" name="order_id" value="<?php if(isset($row['order_ID'])){echo $row['order_ID'];}?>" readonly placeholder="Enter Order ID" id="compnayNameinput" required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Product Availability</label>
                            <select class="form-control" name="status" required/>
                             <option <?php if($row['status']=="Work in progress")echo "selected"?>>Work in progress</option>
                             <option <?php if($row['status']=="Work in progress")echo "selected"?>>Completed</option>
                             <option <?php if($row['status']=="Work in progress")echo "selected"?>>Pending</option>
                             <option <?php if($row['status']=="Work in progress")echo "selected"?>>Cancelled</option>
                             <option <?php if($row['status']=="Work in progress")echo "selected"?>>In stock</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Delivery Status</label>
                            <select class="form-control" name="delivery_status" required/>
                             <option <?php if($row['delivery_status']=="Delivered")echo "selected";?>>Delivered</option>
                             <option <?php if($row['delivery_status']=="Not delivered")echo "selected";?>>Not delivered</option>
                             <option <?php if($row['delivery_status']=="Cancelled")echo "selected";?>>Cancelled</option>
                             <option <?php if($row['delivery_status']=="Pending")echo "selected";?>>Pending</option>
                            </select>
                          </div>
                        </div>

                        <!--end col-->
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                <div class="card-body">
                                  <div id="customerList">
                                    <div class="table-responsive table-card mt-3 mb-1">
                                      <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                          <tr>
                                            <th>Product name</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <!--<th>Action</th>-->
                                          </tr>
                                        </thead>
                                        <?php
                                        if(isset($_REQUEST['productnewid'])){
                                            $sql1 = "SELECT * FROM `sub_order_list` WHERE order_list_id={$row['id']}";
                                            $result1 = $conn->query($sql1);
                                            if($result->rowCount()>0){
                                         
                                        ?>
                                        <tbody class="list form-check-all">
                                          <?php
                                           while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
                                              $result_sl_product = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]'"); 
                                          ?>
                                          <tr>
                                            <td>
                                             <select class="form-select" data-choices="" data-choices-sorting="true" name="product_id[]" id="all_product<?php echo $k?>" onchange="getProduct(this.value,<?php echo $k?>)" required="">
											 <?php while($data=$result_sl_product->fetch(PDO::FETCH_ASSOC)){?>
                                                <option value="<?php echo $data['id']?>" <?php if($row1['product_id']==$data['id'])echo "selected"?>><?php echo $data['product_name']?></option>
											 <?php }?>
                                             </select>
                                            </td>

                                            <td>
                                              <input type="text" class="form-control" name="qty[]" value="<?php if(isset($row1['qty'])){echo $row1['qty'];}?>" placeholder="Enter Qty" required/>
                                            </td>

                                            <td>
                                              <input type="text" class="form-control" name="cost[]" value="<?php if(isset($row1['cost'])){echo $row1['cost'];}?>" placeholder="Cost" required/>
                                            </td>
                                            <td>
                                                <input type="hidden" name="hidden_id[]" value="<?php if(isset($row1['id'])){echo $row1['id'];} ?>">
                                            </td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                      <?php } 
                                    }?>
                                      <fieldset id="account" class="containerForm1"></fieldset>
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
                        <div class="col-lg-12">
                          <div class="text-center">
                            <button type="submit" name="main_update" class="btn btn-info">Update</button>
                            <a href="orderSheetList.php" class="btn btn-info">Back</a>
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