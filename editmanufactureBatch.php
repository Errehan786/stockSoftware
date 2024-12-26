<?php
include_once('config.php'); 
include_once('include/auth.php');
//sel customer
$result_sl_customer = $conn->query("SELECT name,reg_id FROM `customer` where user_reg_id='$_SESSION[id]'");
$messageAction = '';
if(isset($_REQUEST['update'])){
  $purpose = $_REQUEST['purpose'];
  $manufacturing_date = $_REQUEST['manufacturing_date'];
  $customer_name = $_REQUEST['customer_name'];
  $batch_code = $_REQUEST['batch_code'];
  $stock_maintenance = $_REQUEST['stock_maintenance'];
  $sql_Q = "UPDATE `product_batch` SET purpose='$purpose', manufacturing_date='$manufacturing_date', customer_name='$customer_name', batch_code='$batch_code', stock_maintenance='$stock_maintenance' WHERE id='$_REQUEST[id]'";
  
  if($conn->query($sql_Q)){
    //insert multiple data
    for($i=0;$i<sizeof($_REQUEST['product_id']);$i++){        
      $product_id = $_REQUEST['product_id'][$i];
      $quantity = $_REQUEST['quantity'][$i];
      $work_status = $_REQUEST['work_status'][$i];
      $costPerUnit = $_REQUEST['costPerUnit'][$i];
      $totalCost = $_REQUEST['totalCost'][$i];
      $childRowId = $_REQUEST['hidden_id'][$i];
      
      if(!empty($childRowId)){
       $sql1 = "UPDATE `product_batch_sub_iteam` SET `product_id`='$product_id', `quantity`='$quantity', `work_status`='$work_status', `costPerUnit`='$costPerUnit', `totalCost`='$totalCost'  WHERE id='$childRowId' && batch_id = '$_REQUEST[id]'";
	   $sql_avl = "UPDATE `raw_material_overview` SET `status`='$work_status' WHERE batch_sub_id='$_REQUEST[id]'";
	   $conn->exec($sql1);
       $conn->exec($sql_avl);
      }else{
       $sql1 = "INSERT INTO `product_batch_sub_iteam` SET `user_reg_id` ='$_SESSION[id]',`batch_id`='$_REQUEST[id]',`product_id`='$product_id', `quantity`='$quantity', `work_status`='$work_status', `costPerUnit`='$costPerUnit', `totalCost`='$totalCost', `user_reg_id`='$_SESSION[id]'";      
       $conn->exec($sql1);
       $lastinId = $conn->lastInsertId(); 
      $sel_product_formula = $conn->query("select item,item_qty from `product_sub_item` where product_id='$product_id'");
	  while($productDta = $sel_product_formula->fetch(PDO::FETCH_ASSOC)){
	      $item = $productDta['item'];
	      $manufacture_date = $manufacturing_date;
	      $item_qty = $productDta['item_qty']*$quantity;
	      $raw_material_manufacture_Q = "insert into `raw_material_overview` set user_reg_id='$_SESSION[id]',batch_sub_id='$lastinId',item='$item',item_qty='$item_qty',status='$work_status',manufacture_date='$manufacture_date'";
	      $row_insert = $conn->exec($raw_material_manufacture_Q);
	   }
      }
    }

	$messageAction = '<div class="mx-3 mt-3">
      <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been saved successfully</h6>
     </div>';
    //echo '<script>location.href="purchaseEntryForm.php";<//script>';
  }else{
    echo '<script>alert("Data Not Inserted");</script>';
  }

}
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
<meta charset="utf-8" />
<title>PRODUCT MANUFACTURE BATCH | <?php echo $_SESSION['userName']?> </title>
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
<style>
.add_form_field{
    background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;

    border: 1px solid #186dad;

}
.delete{
   background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    //float: right;
    border-radius: 20px;
}
@media(max-width:769px){
.delete{float: right!important;}
}
@media(max-width:480px){
.delete{float: right!important;}
}
@media(max-width:320px){
.delete{float: right!important;}
}
</style>
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
    
   .table-card td:last-child, .table-card th:last-child {
      padding-right:0px;
    }
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
              <h4 class="mb-sm-0">PRODUCT MANUFACTURE BATCH DETAILS </h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"> <a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">New Product Batch</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="addNewPurchase">
          <div class="col-xxl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add New Product Batch</h4>
              </div>
              <!-- end card header -->
              <?php
                    if(isset($messageAction)){
                        echo '<div id="entryID" style="position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;">'.$messageAction.'</div>';
                     ?>
              <script>
                         setTimeout(function(){
                          document.getElementById('entryID').innerHTML='';
                          //window.location='purchaseEntryForm.php';
                         },1000);
                     </script>
              <?php
                     }
                ?>
				<?php
					$ID = $_REQUEST['id'];
					$sql_Q = $conn->query("SELECT * FROM `product_batch` where id='$ID' and user_reg_id='$_SESSION[id]'");
					$result = $sql_Q->fetch(PDO::FETCH_ASSOC);
				?>
              <div class="card-body">
                <div class="live-preview">
                  <form method="post">
                    <div class="live-preview">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="firstNameinput" class="form-label"> Purpose</label>
                            <select name="purpose" class="form-select" data-choices="" data-choices-sorting="true" required="" disabled>
                              <option <?php if($result['purpose']=="Pre order from customer")echo "selected";?>>Pre order from customer</option>
                              <option> <?php if($result['purpose']=="Stock Maintenance")echo "selected";?>Stock Maintenance</option>
                            </select>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="StartleaveDate" class="form-label">Select Date</label>
                            <input type="date" name="manufacturing_date" class="form-control" data-provider="flatpickr" id="StartleaveDate" value="<?php echo $result['manufacturing_date']?>" required="">
                          </div>
                        </div>
                        <div class="col-lg-3" style="display:<?php if(empty($result['customer_name']))echo "none";?>">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Customer Name</label>
                            <select name="customer_name" class="form-control" required/>
                            <?php 
                            $customerList = '<option value="">Select Customer</option>';
                            while($data=$result_sl_customer->fetch(PDO::FETCH_ASSOC)){
                                if($result['customer_name']==$data['reg_id'])$slSts = "selected";else $slSts = '';
                                $customerList .='<option '.$slSts.' value="'.$data['reg_id'].'">'.$data['name'].' '.$data['mobile_no'].'</option>';
                            }
                            echo $customerList;
                            ?>
                          </select>
                          </div>
                        </div>
                        <div class="col-lg-3" style="display:<?php if(!empty($result['customer_name']))echo "none";?>">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Stock Maintenance </label>
                            <input type="text" name="stock_maintenance" value="<?php echo $result['stock_maintenance']?>" class="form-control" placeholder="Stock Maintenance">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Batch Code </label>
                            <input type="text" name="batch_code" value="<?php echo $result['batch_code']?>" class="form-control disabled" placeholder="Enter Batch Code">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                <div class="card-body">
                                  <div id="customerList">
                                    <div class="table-responsive table-card mt-3 mb-1">
									<?php
                                        if(isset($_REQUEST['id'])){
                                            $batch_sql1 = "SELECT * FROM `product_batch_sub_iteam` WHERE batch_id='$_REQUEST[id]'";
                                            $batch_result1 = $conn->query($batch_sql1);
                                        ?>
                                      <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                          <tr>
                                            <th>Product name </th>
                                            <th>Qty </th>
                                            <th>Status </th>
                                            <!----<th>Raw Material Status </th>--->
                                            <th>Cost per unit </th>
                                            <th>Total Cost </th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
										<?php 
                                           if($batch_result1->rowCount()>0){
										   $k=0;
                                           while($batch_row = $batch_result1->fetch(PDO::FETCH_ASSOC)){
                                           $result_sl_product = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]'");
                                           ?>
                                          <tr id="messageTxt<?php echo $batch_row['id'] ?>">
                                            <td style="width: 275px;">
											<select class="form-select" data-choices="" data-choices-sorting="true" name="product_id[]" id="all_product<?php echo $k?>" onchange="getProduct(this.value,<?php echo $k?>)" required="">
											 <?php while($data=$result_sl_product->fetch(PDO::FETCH_ASSOC)){?>
                                                <option value="<?php echo $data['id']?>" <?php if($batch_row['product_id']==$data['id'])echo "selected"?>><?php echo $data['product_name']?></option>
											 <?php }?>
                                             </select>
                                            </td>
                                            <td style="width: 100px;"><input type="text" class="form-control1" style="width: 100px;" onkeyup="getProQty(this.value,<?php echo $k?>)" value="<?php echo $batch_row['quantity']?>" name="quantity[]" id="quantity<?php echo $k?>" placeholder="Enter Qty" required="">
                                            </td>
                                            <td style="width: 165px;"><select class="form-select" name="work_status[]" data-choices="" data-choices-sorting="true" required="">
                                                <option selected="">Work in progress</option>
                                                <option <?php if($batch_row['work_status']=="Completed")echo "selected"?>>Completed</option>
                                                <option <?php if($batch_row['work_status']=="Canceled")echo "selected"?>>Canceled</option>
                                              </select>
                                            </td>
                                            <!----<td><span class="badge badge-soft-success d-none text-uppercase">Available</span> <span class="badge badge-soft-danger text-uppercase"> LOW AVAILABILITY</span> </td>---->
                                            <td><input type="text" class="form-control" value="<?php echo $batch_row['costPerUnit']?>" name="costPerUnit[]" placeholder="Cost Per Unit" id="costPerUnit<?php echo $k?>" required="">
                                            </td>
                                            <td><input type="text" class="form-control" value="<?php echo $batch_row['totalCost']?>" name="totalCost[]" placeholder="Total Cost" id="totalCost<?php echo $k?>" required="">
											<input type="hidden" name="hidden_id[]" value="<?php if(isset($batch_row['id'])){echo $batch_row['id'];} ?>">
                                            </td>
                                            <td><a style="cursor:pointer;background-color: #3c8dbc;border: none;color: white;padding: 5px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;margin: 4px 2px;cursor: pointer;border-radius: 20px;" class="btn btn-sm btn-success" onClick="return dataRdelete<?php echo $batch_row['id'] ?>(<?php echo $batch_row['id'] ?>)">Delete</a></td>
                                          </tr>
										  <script>
                                            function dataRdelete<?php echo $batch_row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
												var myData = "rid="+rowID+"&action=deleteManufactureBatchChild";
												//alert(myData);
												jQuery.ajax({
												type: "POST", // HTTP method POST or GET
												url: "action.php", //Where to make Ajax calls
												dataType:"text", // Data type, HTML, json etc.
												data:myData, //Form variables
												success:function(response){
												//alert(response);
												if(response==0){
												   alert('Data not deleted.');
												}else{
												  $("#messageTxt<?php echo $batch_row['id'] ?>").html('<td colspan="7"><span style="color: red;"><i class="fa fa-spinner fa-spin"></i> Data has been deleted successfully</span></td>');
														
													setTimeout(function(){
														   $("#messageTxt<?php echo $batch_row['id'] ?>").html(''); 
													},1000);
													  
													 }
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
										  <?php 
										  $k++;
										  }
										  echo '<tr><td colspan="7" style="text-align: center;cursor:pointer"><button type="button" class="edit-item-btn add_form_field1" id="addColum" style="background: #fff;border: 0;"><i class="fa fa-plus" style="text-align: center;color: #a5a1a1;font-size: 25px;border: 1px solid #ccc;width: 50px;height: 50px;border-radius: 100%;line-height: 2;"></i></button></td></tr>';
										  }?>
										 <tr>
										 <td colspan="7">
                                            <script>
												$(document).ready(function() {
												var max_fields1      = 500;
												var wrapper1         = $(".containerForm1"); 
												var add_button1      = $(".add_form_field1"); 
												var x = '<?php echo $k?>'; 
												$(add_button1).click(function(e){
													var myData = "action=allProductList&seqNo="+x;
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
													alert('You Reached the limits')
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
                                            <fieldset id="account" class="containerForm1"></fieldset>
                                            </td>
                                        </tr>
                                        </tbody>
                                      </table>
									  <?php }?>
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
               <script>
                function getProduct(getProductId,seqNo){
                var myData = "action=getUnitProductMakingPrice&productID="+getProductId+"&seqNo="+seqNo;
                //alert(myData);
                  jQuery.ajax({
		            type: "POST", // HTTP method POST or GET
			        url: "action.php", //Where to make Ajax calls
		            dataType:"text", // Data type, HTML, json etc.
		            data:myData, //Form variables
	                success:function(response){
	                   document.getElementById('costPerUnit'+seqNo).value=response;
	                },
                 error:function (xhr, ajaxOptions, thrownError){
			      reg("#submitbtn").show(); //show submit button
			      reg("#LoadingImage").hide(); //hide loading image
				   alert(thrownError);
			     }
		       	});
		       	
              }
                
               function getProQty(getProductQty,seqNo){
                if(document.getElementById('all_product'+seqNo).value==''){
                    document.getElementById('quantity'+seqNo).value='';
                    document.getElementById('all_product'+seqNo).focus();
                }else{   
                var unitProductPrice = document.getElementById('costPerUnit'+seqNo).value;    
                var myData = "action=calTotalProPrice&getProductQty="+getProductQty+"&unitProductPrice="+unitProductPrice+"&seqNo="+seqNo;
                //alert(myData);
                  jQuery.ajax({
		            type: "POST", // HTTP method POST or GET
			        url: "action.php", //Where to make Ajax calls
		            dataType:"text", // Data type, HTML, json etc.
		            data:myData, //Form variables
	                success:function(response){
	                   document.getElementById('totalCost'+seqNo).value=response;
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
                      <!--end col-->
                      <div class="col-sm-3 mx-auto" style="text-align:center">
                            <input type="submit" name="update" class="btn btn-info" Value="Update">
                            <a href="productmanufacturebatch.php" class="btn btn-info">Back</a>
                        </div>
                      <!--end col-->
                    </div>
                  </form>
                  <!--end col-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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