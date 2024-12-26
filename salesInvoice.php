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
<title>Sales Invoice | <?php echo $_SESSION['userName']?> </title>
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
    height:30px;
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
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex gap-2"><tbody class="list form-check-all"> <tr><td style="width:260px;padding-left: 0px;"> <div class="form-group" id="textarea1"> <select id="iteamList0" class="form-select" name="" data-choices="" data-choices-sorting="true" style="width:220px" required=""> <option value="">Select Prod Category</option> <option value="">Prod Category1</option> <option value="">Prod Category2</option> </select> </div></td> <td> <div class="form-group" id="textarea1"> <select id="iteamList0" class="form-select" name="" data-choices="" data-choices-sorting="true" style="width:220px" required=""> <option value="">Select Description</option> <option value="">Description1</option> <option value="">Description2</option> </select> </div> </td> <td> <div class="form-group" id=""> <select id="iteamList0" class="form-select" name="" data-choices="" data-choices-sorting="true" style="width:220px" required=""> <option value="">Select Packing Unit</option> <option value="">Kg</option> <option value="">Liter</option> <option value="">Pcs</option> </select> </div> </td> <td> <div class="form-group" id=""> <select id="iteamList0" class="form-select" name="" data-choices="" data-choices-sorting="true" style="width:220px" required=""> <option value="">Select Length</option> <option value="">Length1</option> <option value="">Length2</option> </select> </div></td> <td><div class="form-group" id=""> <input type="text" class="form-control" name="" id="" style="width: 120px;" placeholder="Qty/Pack" autocomplete="off" required=""> </div></td> <td><div class="form-group" id=""> <input type="text" class="form-control" name="" placeholder="Qty/Unit" style="width: 120px;" autocomplete="off" required=""> </div> </td> <td><div class="form-group" id=""> <input type="text" class="form-control" name="" id="" placeholder="Unit" style="width: 120px;" autocomplete="off" required=""> </div></td> <td><div class="form-group" id=""> <input type="text" class="form-control" name="" placeholder="Price/Unit" style="width: 120px;" autocomplete="off" required=""> </div> </td> <td><div class="form-group" id=""> <input type="text" class="form-control" name="" placeholder="LR No." style="width: 120px;" autocomplete="off" required=""> </div> </td> <td> <div class="form-group" id=""> <select id="iteamList0" class="form-select" name="" data-choices="" data-choices-sorting="true" style="width:220px" required=""> <option value="">Select Transport</option> <option value="">Car</option> <option value="">Bus</option> </select> </div> </td> <td><div class="form-group" id="unitCost"> <input type="text" class="form-control" name="" id="" placeholder="Lot No." style="width: 120px;" autocomplete="off" required=""> </div></td> <td><div class="d-flex"> </div> </td> </tr> </tbody><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete">Remove</a></div>'); 
               //alert('Fields added');
            }
            
            
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
              <h4 class="mb-sm-0">SALES INVOICE </h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">Sales Invoice</li>
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
                              <i class="ri-search-line search-icon"></i> </div>
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
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center"> <a href="#addNewPurchase">
                      <button class="btn btn-sm btn-success edit-item-btn"> Add New
                      </button>
                      </a> 
                    </div>
                  </div>
                  <!--========================== Show Data ==========================-->
                  <?php
                    if(isset($messageAction)){
                        echo '<div id="entryID">'.$messageAction.'</div>';
                     ?>
                  <script>
                         setTimeout(function(){
                          document.getElementById('entryID').innerHTML='';
                         },2000);
                     </script>
                  <?php
                     }
                    ?>
                  <div id="childRDelete"></div>
                  <?php
                    $sql="SELECT * FROM `purchase_entry` where user_reg_id='$_SESSION[id]'";
                    $result=$conn->query($sql);
                    if($result->rowCount()>0){
                    ?>
                  <div class="table-responsive">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>S.NO.</th>
                          <th>Description</th>
                          <th>Qty</th>
                          <th>Units</th>
                          <th>Rate</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                       
                        <tr>
                        <td>1</td>
                        <td>Description</td>
                        <td>2</td>
                        <td>Kg</td>
                        <td>4%</td>
                        <td>400</td>
                           <td> <div class="d-flex gap-2">
                                <div class="view mx-2">
                              <a href="salesInvoiceView.php" class="btn btn-sm bg-info edit-item-btn text-white">View</a>
                            </div>
                            <div class="edit mx-2">
                              <a href="editpurchaseEntryform.php" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                            </div>
                            <div class="mx-2">
                              <a style="cursor:pointer" onClick="return dataRdelete'.$row['id'].'('.$row['id'].')" class="btn btn-sm btn-danger remove-item-btn" name="purchase_delete">Delete</a>
                             </div>
                            </div>
                           </td>
                          <script>
							function dataRdelete<?php echo $row['id'] ?>(rowID){
								var myData = "rid="+rowID+"&action=deleteParentRow";
								//alert(myData);
								 jQuery.ajax({
								   type: "POST", // HTTP method POST or GET
								   url: "action.php", //Where to make Ajax calls
									dataType:"text", // Data type, HTML, json etc.
									data:myData, //Form variables
									success:function(response){
									//alert(response);
									  $("#childRDelete").html(response); 
										  setTimeout(function(){
											   $("#childRDelete").html(''); 
											   $("#rowParent<?php echo $row['id'] ?>").html=('');
											   window.location='purchaseEntryForm.php';
										},1000);
										 
										},
										error:function (xhr, ajaxOptions, thrownError){
										reg("#submitbtn").show(); //show submit button
										reg("#LoadingImage").hide(); //hide loading image
											alert(thrownError);
										 }
										});
									   }
									</script>
                        </tr>
                        <tr>
                        <td>2</td>
                        <td>Description</td>
                        <td>2</td>
                        <td>Kg</td>
                        <td>4%</td>
                        <td>400</td>
                           <td> <div class="d-flex gap-2">
                                 <div class="view mx-2">
                              <a href="salesInvoiceView.php" class="btn btn-sm bg-info edit-item-btn text-white">View</a>
                            </div>
                            <div class="edit mx-2">
                              <a href="editpurchaseEntryform.php" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                            </div>
                            <div class="mx-2">
                              <a style="cursor:pointer" onClick="return dataRdelete'.$row['id'].'('.$row['id'].')" class="btn btn-sm btn-danger remove-item-btn" name="purchase_delete">Delete</a>
                             </div>
                            </div>
                           </td>
                          <script>
							function dataRdelete<?php echo $row['id'] ?>(rowID){
								var myData = "rid="+rowID+"&action=deleteParentRow";
								//alert(myData);
								 jQuery.ajax({
								   type: "POST", // HTTP method POST or GET
								   url: "action.php", //Where to make Ajax calls
									dataType:"text", // Data type, HTML, json etc.
									data:myData, //Form variables
									success:function(response){
									//alert(response);
									  $("#childRDelete").html(response); 
										  setTimeout(function(){
											   $("#childRDelete").html(''); 
											   $("#rowParent<?php echo $row['id'] ?>").html=('');
											   window.location='purchaseEntryForm.php';
										},1000);
										 
										},
										error:function (xhr, ajaxOptions, thrownError){
										reg("#submitbtn").show(); //show submit button
										reg("#LoadingImage").hide(); //hide loading image
											alert(thrownError);
										 }
										});
									   }
									</script>
                        </tr>
                      
                      </tbody>
                    </table>
                    <?php } ?>
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
          <div class="row" id="addNewPurchase">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Add New Sales Invoice</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="post">
                      <div class="row">
                      <div class="col-lg-3">
                        <div class="mb-4">
                          <label class="form-label">Party Account</label>
                          <select id="vendorList" name="vendor_name" class="form-select" onChange="createVendor(this.value)" required>
                            <option value="">Select Party Account</option>
                            <option name="" value="">Capital Accounts</option>
                            <option name="" value="">Bank Accounts</option>
                            <option name="" value="">Cash Accounts</option>
                          </select>
                        </div>
                      </div>
                      <!--end col-->
                       <div class="col-lg-3">
                        <div class="mb-4">
                          <label class="form-label">Account</label>
                          <select id="vendorList" name="vendor_name" class="form-select" onChange="createVendor(this.value)" required>
                            <option value="">Select Account</option>
                            <option name="" value="">sale Accounts</option>
                            <option name="" value="">sale Accounts</option>
                            <option name="" value="">sale Accounts</option>
                          </select>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-3">
                        <div class="mb-4">
                          <label for="" class="form-label">V.No.</label>
                          <input type="text" class="form-control" name="" data-provider="flatpickr" id="" required/>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-3">
                        <div class="mb-4">
                          <label for="StartleaveDate" class="form-label">Date</label>
                          <input type="date" class="form-control" name="date" data-provider="flatpickr" id="StartleaveDate" required/>
                        </div>
                      </div>
                      <!--end col-->
                     
                
                      <div class="row">
                      <div class="col-lg-12">
                      <div class="card">
                      <div class="card-body">
                      <div id="customerList">
                      <div class="table-responsive table-card mt-3 mb-1">
                      <table class="table align-middle table-nowrap" id="customerTable">
                        <thead class="table-light">
                          <tr>
                            <!-- <th>Purchase Entry Id<th> -->
                            <!--<th>Invoice No</th>-->
                            <th>Prod Category</th>
                            <th>Description</th>
                            <th>Packing Unit</th>
                            <th>Length</th>
                            <th>Qty/Pack</th>
                            <th>Qty/Unit</th>
                            <th>Unit</th>
                            <th>Price/Unit</th>
                            <th>LR No.</th>
                            <th>Transport</th>
                            <th>Lot No.</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="list form-check-all">
                        <td style="width:260px;padding-left: 0px;">
                           
                            <div class="form-group" id="textarea1">
                              <select id="iteamList0" class="form-select" name="" data-choices data-choices-sorting="true" style="width:220px"  required>
                                <option value="">Select Prod Category</option>
                                <option value="">Prod Category1</option>
                                 <option value="">Prod Category2</option>
                              </select>
                             
                            </div></td>
                          <td >
                               <div class="form-group" id="textarea1">
                              <select id="iteamList0" class="form-select" name="" data-choices data-choices-sorting="true" style="width:220px" required>
                                <option value="">Select Description</option>
                                <option value="">Description1</option>
                                 <option value="">Description2</option>
                              </select>
                            </div>
                             </td>
                          <td> 
                             <div class="form-group" id="">
                              <select id="iteamList0" class="form-select" name="" data-choices data-choices-sorting="true" style="width:220px"  required>
                                <option value="">Select Packing Unit</option>
                                <option value="">Kg</option>
                                 <option value="">Liter</option>
                                 <option value="">Pcs</option>
                              </select>
                             </div>
                         </td>
                          <td>
                          <div class="form-group" id="">
                              <select id="iteamList0" class="form-select" name="" data-choices data-choices-sorting="true" style="width:220px" required>
                                <option value="">Select Length</option>
                                <option value="">Length1</option>
                                 <option value="">Length2</option>
                              </select>
                            </div></td>
                          <td><div class="form-group" id="">
                              <input type="text" class="form-control" name="" id="" style="width: 120px;" placeholder="Qty/Pack" autocomplete="off" required />
                            </div></td>
                          <td><div class="form-group" id="">
                              <input type="text" class="form-control" name="" placeholder="Qty/Unit" style="width: 120px;" autocomplete="off" required/>
                            </div>
                          </td>
                           <td><div class="form-group" id="">
                              <input type="text" class="form-control" name="" id="" placeholder="Unit" style="width: 120px;" autocomplete="off" required />
                            </div></td>
                          <td><div class="form-group" id="">
                              <input type="text" class="form-control" name="" placeholder="Price/Unit" style="width: 120px;" autocomplete="off" required/>
                            </div>
                          </td>
                            <td><div class="form-group" id="">
                              <input type="text" class="form-control" name="" placeholder="LR No." style="width: 120px;" autocomplete="off" required/>
                            </div>
                          </td>
                           <td>
                              <div class="form-group" id="">
                              <select id="iteamList0" class="form-select" name="" data-choices data-choices-sorting="true" style="width:220px" required>
                                <option value="">Select Transport</option>
                                <option value="">Car</option>
                                 <option value="">Bus</option>
                              </select>
                            </div>
                           </td>
                        
                           <td><div class="form-group" id="unitCost">
                              <input type="text" class="form-control" name="" id="" placeholder="Lot No."  style="width: 120px;" autocomplete="off" required />
                            </div></td>
                         
                          <td><div class="d-flex">
                              <div class="edit">
                                <button type="button" class="btn btn-sm btn-success edit-item-btn add_form_field1" id="addColum">Add&nbsp;New</button>
                              </div>
                            </div>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                      <fieldset id="account" class="containerForm1">
                      </fieldset>
                      <br>
                      <div class="col-sm-3 mb-3 mx-auto" style="text-align:center">
                        <input type="submit" name="main_submit" class="btn btn-info" style="background-color:#0ab39c;">
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
</div>
</div>
</div>
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
