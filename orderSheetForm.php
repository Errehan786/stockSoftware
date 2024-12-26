<?php
include_once('config.php'); 
include_once('include/auth.php');
$result_sl_product = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]'");
$productCount = $result_sl_product->rowCount();
$productList = "<option value=''>Select Product</option>";
while($data=$result_sl_product->fetch(PDO::FETCH_ASSOC)){
    $productList .="<option value=$data[id]>$data[product_name]</option>"; 
}
//sel customer list
$result_sl_customer = $conn->query("SELECT name,reg_id FROM `customer` where user_reg_id='$_SESSION[id]'");
$customerList = '<option value="">Select Customer</option>';while($data=$result_sl_customer->fetch(PDO::FETCH_ASSOC)){$customerList .='<option value="'.$data['reg_id'].'">'.$data['name'].' '.$data['mobile_no'].'</option>';}

$messageAction = '';
if(isset($_REQUEST['main_submit'])){
$customerName = $_REQUEST['customer_name'];
$date = $_REQUEST['date'];
$orderID = $_REQUEST['order_id'];
$status = $_REQUEST['status'];
$deliveryStatus = $_REQUEST['delivery_status'];
$sql = "INSERT INTO `order_sheet`(`user_reg_id`,`customer_name`, `date`, `order_ID`, `status`, `delivery_status`) VALUES ('$_SESSION[id]','$customerName','$date','$orderID','$status','$deliveryStatus')";

if($result = $conn->exec($sql)){
  $orderID = $conn->lastInsertId();
  for($i=0;$i<sizeof($_REQUEST['product_id']);$i++){
    $productID = $_REQUEST['product_id'][$i];
    $qty = $_REQUEST['qty'][$i];
    $cost = $_REQUEST['cost'][$i];
    $sql1 = "INSERT INTO `sub_order_list`(`order_list_id`, `product_id`, `qty`, `cost`) VALUES ('$orderID','$productID','$qty','$cost')";
    $result1 = $conn->query($sql1);
  }
  
  $messageAction = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spin me-2"></i>Data has been Save Successfull</h6>
        </div>';
    @$conn->NULL;    
  //echo '<script>alert ("Data has been save successfull");<//script>';
  //echo '<script>window.location = "orderSheetList.php"<//script>'; 
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
        var max_fields1      = '<?php echo $productCount?>';
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        var x = 1;
        
        $(add_button1).click(function(e){
            var myData = "action=allOrderSheetProductList&seqNo="+x;
                //alert(myData);
                  jQuery.ajax({
		            type: "POST", // HTTP method POST or GET
			        url: "action.php", //Where to make Ajax calls
		            dataType:"text", // Data type, HTML, json etc.
		            data:myData, //Form variables
	                success:function(response){
	                   e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append(response); 
           //alert('Fields added');
            }
        else
        {
        alert('You have only '+max_fields1+' products')
        }
	                },
                 error:function (xhr, ajaxOptions, thrownError){
			      reg("#submitbtn").show(); //show submit button
			      reg("#LoadingImage").hide(); //hide loading image
				   alert(thrownError);
			     }
		       	});

        });
        
        $(wrapper1).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
        //alert('Fields removed');
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
                <h4 class="mb-sm-0">ORDER SHEET FORM</h4>
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
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Add New Entry</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="mb-3">
                            <label for="firstNameinput" class="form-label">Customer Name</label>
                            <select name="customer_name" onchange="checkOrderSheetList(this.value)" class="form-control" required/>
                             <?php echo $customerList?>
                            </select>
                          </div>
                          <div id="orderAvailabilityMessage"></div>
                        </div>
                        <script>
                            function checkOrderSheetList(getCustomerRegId){
                                var myData = "action=checkOrderList&customerId="+getCustomerRegId;
                  //alert(myData);
                  jQuery.ajax({
		            type: "POST", // HTTP method POST or GET
			        url: "action.php", //Where to make Ajax calls
		            dataType:"text", // Data type, HTML, json etc.
		            data:myData, //Form variables
	                success:function(response){
	                    //alert(response);
	                    document.getElementById('orderAvailabilityMessage').innerHTML=response;
	                },
                 error:function (xhr, ajaxOptions, thrownError){
			      reg("#submitbtn").show(); //show submit button
			      reg("#LoadingImage").hide(); //hide loading image
				   alert(thrownError);
			     }
		       	});
		       	
            }
                                            </script>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="StartleaveDate" class="form-label">Select Date</label>
                            <input type="date" class="form-control" name="date" data-provider="flatpickr" id="StartleaveDate" autocomplete="off" required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Order ID</label>
                            <input type="text" class="form-control" name="order_id" placeholder="Enter Order ID" value="<?php echo $currentTime?>" id="compnayNameinput" autocomplete="off" required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Delivery Status</label>
                            <select class="form-control" name="delivery_status" required/>
                             <option value="">Delivery Status</option>
                             <option>Not delivered</option>
                             <option>Pending</option>
                            </select>
                          </div>
                        </div>

                    <?php
                    if(isset($messageAction) && !empty($messageAction)){
                        echo '<div id="entryID">'.$messageAction.'</div>';
                     ?>
                     <script>
                         setTimeout(function(){
                          document.getElementById('entryID').innerHTML='';
                          window.location='orderSheetList.php';
                         },2000);
                     </script> 
                    <?php
                     }
                    ?>

                        <!--end col-->
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                <div class="card-body">
                                  <div id="customerList">
                                    <div class="table-responsive">
                                      <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                          <tr>
                                            <th>Product name</th>
                                            <th>Qty</th>
                                            <th>Checking</th>
                                            <th>Availability Status</th>
                                            <th>Cost</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                          <tr>
                                            <td>
                                              <select class="form-select" data-choices data-choices-sorting="true" name="product_id[]" id="product_id0" style="width: 200px;" required>
                                              <?php
                                               echo $productList;
                                              ?>
                                            </select>
                                            </td>
                                            <td>
                                              <input type="text" class="form-control" name="qty[]" onkeyup="getAvailability(this.value,0)" placeholder="Enter Qty" autocomplete="off" required/>
                                        <script>
                                                function getAvailability(getQuantity,seqId){
                                                if(getQuantity>0){    
                                                var productId = "product_id"+seqId; 
                                                var getProductId = document.getElementById(productId).value;
                                                var myData = "action=checkProductAvailability&productId="+getProductId+"&quantity="+getQuantity;
                  //alert(myData);
                  jQuery.ajax({
		            type: "POST", // HTTP method POST or GET
			        url: "action.php", //Where to make Ajax calls
		            dataType:"text", // Data type, HTML, json etc.
		            data:myData, //Form variables
	                success:function(response){
	                    //alert(response);
	                    avlMessage = "availabilityMsg"+seqId;
	                    document.getElementById(avlMessage).innerHTML=response;
	                },
                 error:function (xhr, ajaxOptions, thrownError){
			      reg("#submitbtn").show(); //show submit button
			      reg("#LoadingImage").hide(); //hide loading image
				   alert(thrownError);
			     }
		       	});
		       	
                                              }
                                            }
                                            </script>
                                            </td>
                                            <td style="text-align: center;font-size: 9px;">
                                              <div id="availabilityMsg0"></div>    
                                            </td>
                                            <td>
                                            <select class="form-control" name="status[]" required/>
                                               <option value="">Select Availability</option>
                                               <option>Work in progress</option>
                                               <option>Completed</option>
                                               <option>Pending</option>
                                               <option>In stock</option>
                                            </select>
                                            </td>
                                            <td>
                                              <input type="number" class="form-control" name="cost[]" placeholder="Cost" autocomplete="off" required/>
                                            </td>
                                            <td>
                                              <div class="d-flex" style="margin-top: 3px;">
                                                <div class="edit">
                                                  <button class="btn btn-sm btn-success edit-item-btn add_form_field1" type="button">Add New </button>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <fieldset id="account" class="containerForm1 me-4"></fieldset>
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
                            <button type="submit" name="main_submit" class="btn btn-primary">Submit</button>
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