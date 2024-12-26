<?php 
include_once('config.php'); 
include_once('include/auth.php'); 
include_once('include/auth.php');

$messageAction = '';
if(isset($_REQUEST['main_submit'])){
  $vender_name = $_REQUEST['vendor_name'];
  $date = $_REQUEST['date'];
  $invoice_no = $_REQUEST['invoice_no'];
  $currency = $_REQUEST['currency'];
  $currency_conversion = $_REQUEST['currency_conversion'];
  $miscellaneous_cost = $_REQUEST['ciscellaneous_cost'];
  $shipping_cost = $_REQUEST['shipping_cost'];
  $admin_cost_for_custom = $_REQUEST['admin_cost_for_custom'];
  $custom_tax = $_REQUEST['custom_tax'];
  
  if($_REQUEST['miscellaneousCost_Currency']!="NOK")$miscellaneous_cost = $currency_conversion*$_REQUEST['ciscellaneous_cost'];
  if($_REQUEST['ShippingCost_Currency']!="NOK")$shipping_cost = $currency_conversion*$_REQUEST['shipping_cost'];
  if($_REQUEST['AdminCost_Currency']!="NOK")$admin_cost_for_custom = $currency_conversion*$_REQUEST['admin_cost_for_custom'];
  if($_REQUEST['CustomTax_Currency']!="NOK")$custom_tax = $currency_conversion*$_REQUEST['custom_tax'];
  
  $total_weight_of_shippment = ''; 
  if($_REQUEST['status']=="Delivered")$deliveryData = ",delivery_date='$date'";else $deliveryData='';
  
  $sql = "INSERT INTO `purchase_entry` SET user_reg_id='$_SESSION[id]', vendor_name='$vender_name', date='$date', invoice_no='$invoice_no', currency='$currency', currency_conversion='$currency_conversion', miscellaneous_cost='$miscellaneous_cost', shipping_cost='$shipping_cost', admin_cost_custom='$admin_cost_for_custom', custom_tax='$custom_tax', total_wet_shippment='$total_weight_of_shippment',status='$_REQUEST[status]',miscellaneousCost_Currency='$_REQUEST[miscellaneousCost_Currency]',ShippingCost_Currency='$_REQUEST[ShippingCost_Currency]',AdminCost_Currency='$_REQUEST[AdminCost_Currency]',CustomTax_Currency='$_REQUEST[CustomTax_Currency]' $deliveryData";
  if($conn->exec($sql)){
    //insert multiple data
    $insID = $conn->lastInsertId();
	$finalTotalwt = 0;
	$total_number_of_items=sizeof($_REQUEST['all_item']);
    for($i=0,$totalWtShipment=0;$i<sizeof($_REQUEST['all_item']);$i++){
      $all_item = $_REQUEST['all_item'][$i];
      $quantity = $_REQUEST['quantity'][$i];
      $cost = $_REQUEST['cost'][$i];
      $currency = $_REQUEST['localCurrency'][$i];
      $batchNo = $_REQUEST['batchNo'][$i];
      
	//check unit 
	 $sl_unit_Q = $conn->query("select measurement_unit,weight_unit from `items` where id='$all_item'");
	 $unitData = $sl_unit_Q->fetch(PDO::FETCH_ASSOC);
	  
	if($unitData['measurement_unit']=="Grams")$totalWtShipment = $quantity;else if($unitData['measurement_unit']=="kg")$totalWtShipment = $quantity*1000;else $totalWtShipment = $quantity*$unitData['weight_unit'];
	 $finalTotalwt = $finalTotalwt+$totalWtShipment;
    }

    $per_unit_shipment_cost = $shipping_cost/$finalTotalwt;//Shipping cost should be devided by total weight.
    $per_item_admin_cost = $admin_cost_for_custom/$total_number_of_items;//Admin cost should be devided by total number of items.
    $per_item_miscellaneous_cost = $miscellaneous_cost/$total_number_of_items;//Miscellaneous cost should be devided by total number of items.
    
	//update total weight of shipment
	$conn->query("update `purchase_entry` set total_wet_shippment='$finalTotalwt',per_unit_shipment_cost='$per_unit_shipment_cost',per_item_admin_cost='$per_item_admin_cost',per_item_miscellaneous_cost='$per_item_miscellaneous_cost' where id='$insID'");
	
	for($i=0;$i<sizeof($_REQUEST['all_item']);$i++){
	    $all_item = $_REQUEST['all_item'][$i];
	    $quantity = $_REQUEST['quantity'][$i];
	    $cost = $_REQUEST['cost'][$i];
	    $Cost_in_local_currency = $_REQUEST['localCurrency'][$i];
	    $batchNo = $_REQUEST['batchNo'][$i];
	    //check unit 
	    $sl_unit_Q = $conn->query("select measurement_unit,weight_unit from `items` where id='$all_item'");
	    $unitData = $sl_unit_Q->fetch(PDO::FETCH_ASSOC);
	 
	    if($unitData['measurement_unit']=="Grams")$total_wt_of_item = $quantity;else if($unitData['measurement_unit']=="kg")$total_wt_of_item = $quantity*1000;else $total_wt_of_item = $quantity*$unitData['weight_unit'];
	     
	    $per_item_shippment_cost = $total_wt_of_item*$per_unit_shipment_cost;
	    
	    $per_unit_cost_item = ($Cost_in_local_currency+$per_item_shippment_cost+$per_item_admin_cost+$per_item_miscellaneous_cost)/$quantity;
                 
	    $sql1 = "INSERT INTO `new_item` SET user_reg_id='$_SESSION[id]',`items_id`='$insID', `item_name`='$all_item', `qty`='$quantity', `cost`='$cost', `local_currency`='$Cost_in_local_currency', `batch_no`='$batchNo',per_item_shippment_cost='$per_item_shippment_cost',per_unit_cost_item='$per_unit_cost_item',date='$date' $deliveryData";
	                                                                                                                                                                                                                                    
        $result1 = $conn->exec($sql1);
	}
    
    $messageAction = '<div class="mx-3 mt-3">
      <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been saved successfully</h6>
     </div>';
     @$conn->NULL;
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
<title>Raw/Semi Material Sales | <?php echo $_SESSION['userName']?> </title>
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
<style>
.add_form_field
{
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
<?php
$sql = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
$result = $conn->query($sql);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
        $(document).ready(function() {
        
        var max_fields1      = 500;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        var x = 1; 
        $(add_button1).click(function(e){
            var myData = "action=allItem&seqNo="+x;
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
              <h4 class="mb-sm-0">Raw/Semi Material Sales </h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">Raw/Semi Material Sales</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
       
          <!-- end row -->
          <div class="row" id="addNewPurchase">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Raw/Semi Material Sales</h4>
                </div>
                <!-- end card header -->
                 <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="post">
                      <div class="row">
                      <div class="col-lg-3">
                        <div class="mb-4">
                        <p>Party Account <span>:</span> <strong>Capital Accounts</strong></p>
                        </div>
                      </div>
                      <!--end col-->
                       <div class="col-lg-3">
                        <div class="mb-4">
                          <p> Account <span>:</span> <strong>Sale Accounts</strong></p>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-3">
                        <div class="mb-4">
                          <p>V.No. <span>:</span> <strong>09456</strong></p>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-3">
                        <div class="mb-4">
                         <p>Date <span>:</span> <strong>25-07-2024</strong></p>
                        </div>
                      </div>
                      <!--end col-->
                      </div>
                       <div class="row my-3">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive table-card">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">C.Type</th>
                                                        <th scope="col">Content</th>
                                                        <th scope="col">Net Qty.</th>
                                                         <th scope="col">Units</th>
                                                        <th scope="col">Rate</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#" class="fw-medium">Description</a></td>
                                                        <td>2</td>
                                                        <td>c.Type</td>
                                                        <td>Content</td>
                                                        <td>2Kg</td>
                                                         <td>Kg</td>
                                                        <td>4%</td>
                                                        <td>400</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                  
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->

                       <div class="row">
                      <div class="col-sm-4 align-content-end">
                         <div class="form-group">
                             <label for="comment">Remarks</label>
                                  <textarea class="form-control"  id="comment" name="text"></textarea>
                         </div>
                      </div>
                      <div class="col-sm-4">
                          
                            <div class="row g-3 align-items-center mt-4">
                             <div class="col-5">
                               <label for="" class="col-form-label">Addl. Charges</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                            <div class="row g-3 align-items-center">
                             <div class="col-5">
                               <label for="" class="col-form-label">Deductions</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                      </div>
                     <div class="col-sm-4">
                         <div class="row g-3 align-items-center">
                             <div class="col-5">
                               <label for="" class="col-form-label">Total Amount</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                          
                            <div class="row g-3 align-items-center">
                             <div class="col-5">
                               <label for="" class="col-form-label">  Amount</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                            <div class="row g-3 align-items-center">
                             <div class="col-5">
                               <label for="" class="col-form-label">  Amount</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                            <div class="row g-3 align-items-center">
                             <div class="col-5">
                               <label for="" class="col-form-label">Bill  Amount</label>
                             </div>
                             <div class="col-7">
                               <input type="number" id="" class="form-control" aria-describedby="passwordHelpInline">
                             </div>
                           </div>
                           
                     </div>
                     <div class="col-sm-12 mt-4 text-end">
                          <button type="button" class="btn btn-info">Print</button>
                           <button type="button" class="btn btn-info">Cancel</button>
                          <input type="submit" name="main_submit" class="btn btn-info" style="background-color:#0ab39c;">
                     </div>
                     </div>
                     </form>
</div>
</div>
             
</div>
</div>
</div>
</div>

 
                      
                      
</div>
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
