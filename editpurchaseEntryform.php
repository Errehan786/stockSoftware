<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['update'])){
  $vender_name = $_REQUEST['vender_name'];
  $date = $_REQUEST['date'];
  $invoice_no = $_REQUEST['invoice_no'];
  $currency = $_REQUEST['currency'];
  $currency_conversion = $_REQUEST['currency_conversion'];
  $ciscellaneous_cost = $_REQUEST['ciscellaneous_cost'];
  $shipping_cost = $_REQUEST['shipping_cost'];
  $admin_cost_for_custom = $_REQUEST['admin_cost_for_custom'];
  $custom_tax = $_REQUEST['custom_tax'];
  $total_weight_of_shippment = $_REQUEST['total_weight_of_shippment'];
  $sql = "UPDATE `purchase_entry` SET vendor_name='$vender_name',date='$date', invoice_no='$invoice_no',currency='$currency',currency_conversion='$currency_conversion',miscellaneous_cost='$ciscellaneous_cost',shipping_cost='$shipping_cost',admin_cost_custom='$admin_cost_for_custom',custom_tax='$custom_tax',total_wet_shippment='$total_weight_of_shippment' WHERE id={$_REQUEST['id']}";
  if($conn->query($sql)){
     
    $orderID = $conn->lastInsertId();
    for($i=0;$i<sizeof($_REQUEST['item_name']);$i++){
     $item_name = $_REQUEST['item_name'][$i];
     $qty = $_REQUEST['quantity'][$i];
     $cost = $_REQUEST['cost'][$i];
     $localCurrency = $_REQUEST['localCurrency'][$i];
     $unitCost = $_REQUEST['unitCost'][$i];
     $batchNo = $_REQUEST['batchNo'][$i];
     $childRowId = $_REQUEST['hidden_id'][$i];
     if(!empty($childRowId)){
      $sql4 = "UPDATE `new_item` SET `item_name`='$item_name',`qty`='$qty',`cost`='$cost',`local_currency`='$localCurrency',`acquire_per/unit`='$unitCost',`batch_no`='$batchNo' WHERE id={$childRowId} && items_id = {$_REQUEST['id']}";
     }else{
      $sql4 = "INSERT INTO `new_item` SET `user_reg_id`='$_SESSION[id]',`item_name`='$item_name',`qty`='$qty',`cost`='$cost',`local_currency`='$localCurrency',`acquire_per/unit`='$unitCost',`batch_no`='$batchNo',items_id={$_REQUEST['id']}";   
     }
     $result4 = $conn->exec($sql4);
    } 
     
    $messageAction = '<div class="mx-3 mt-3">
      <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been updated successfully</h6>
     </div>'; 
    //echo '<script>alert("Data Updated Successfully");<//script>';
    //echo '<script>location.href="purchaseEntryForm.php"<//script>';
  }else{
    echo '<script>alert("Data Not Updated");</script>';
  }
}

$sql = "SELECT * FROM `purchase_entry` WHERE id={$_REQUEST['id']} and user_reg_id='$_SESSION[id]'";
$result=$conn->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
  <meta charset="utf-8" />
  <title>Purchase Entry Form | <?php echo $_SESSION['userName']?> </title>
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
                <h4 class="mb-sm-0">PURCHASE ENTRY DETAILS </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Purchase Entry Details & Form</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row" id="addNewPurchase">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Add New Purchase Entry</h4>
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

                <div class="card-body">
                  <div class="live-preview">
                    <form method="post">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="firstNameinput" class="form-label">Name of Vendor</label>
                            <?php
                                $vendorId =  $row['vendor_name'];
                                $itemId = $row['id'];
                                $sql3 = "SELECT * FROM `vendor` where user_reg_id='$_SESSION[id]'";
                                $result3 = $conn->query($sql3);
                            ?>
                            <select id="ForminputState" name="vender_name" class="form-select" disable readonly>
                            <?php
                                while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $row1['id'] ?>" <?php if($row1['id']==$row['vendor_name']) echo "selected"?>><?php if(isset($row1['name'])){echo $row1['name'];}?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="StartleaveDate" class="form-label">Select Date</label>
                            <input type="date" disable readonly class="form-control" name="date" data-provider="flatpickr" id="StartleaveDate" value='<?php if(isset($row['date'])){echo $row['date'];}?>' required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Invoice No.</label>
                            <input type="text" disable readonly class="form-control" name="invoice_no" placeholder="Enter Invoice No." id="compnayNameinput" value='<?php if(isset($row['invoice_no'])){echo $row['invoice_no'];}?>' required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Currency</label>
                            <input type="text" disable readonly class="form-control" name="currency" placeholder="Enter Currency" id="compnayNameinput" value='<?php if(isset($row['currency'])){echo $row['currency'];}?>' required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2">
                          <div class="mb-2">
                            <label for="compnayNameinput" class="form-label">Conversion</label>
                            <input type="text" disable readonly class="form-control" name="currency_conversion" placeholder="Currency Conversion." value='<?php if(isset($row['currency_conversion'])){echo $row['currency_conversion'];}?>' id="compnayNameinput" required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-2" style="padding-right: 0;">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Miscellaneous Cost</label>
                            <input type="text" disable readonly class="form-control" name="ciscellaneous_cost" placeholder="Miscellaneous Cost" value='<?php if(isset($row['miscellaneous_cost'])){echo $row['miscellaneous_cost'];}?>' id="compnayNameinput" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" required/>
                          </div>
                        </div>
                        <div class="col-lg-1" style="padding-left: 0;">
                        <div class="mb-4">
                          <label for="compnayNameinput" class="form-label">&nbsp;</label>
                          <select disable readonly class="form-select" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="ShippingCost_Currency" onchange="calculateShippingCost(this.value)" required/>
                           <?php 
                           echo '<option>'.$row['miscellaneousCost_Currency'].'</option>';?>
                          </select>
                        </div>
                      </div>
                      
                        <div class="col-lg-2" style="padding-right: 0;">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Shipping Cost</label>
                            <input type="text" disable readonly class="form-control" name="shipping_cost" placeholder="Shipping Cost" id="compnayNameinput" value='<?php if(isset($row['shipping_cost'])){echo $row['shipping_cost'];}?>' style="border-top-right-radius: 0;border-bottom-right-radius: 0;" required/>
                          </div>
                        </div>
                        <div class="col-lg-1" style="padding-left: 0;">
                        <div class="mb-4">
                          <label for="compnayNameinput" class="form-label">&nbsp;</label>
                          <select class="form-select" disable readonly style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="ShippingCost_Currency" onchange="calculateShippingCost(this.value)" required/>
                           <?php 
                           echo '<option>'.$row['ShippingCost_Currency'].'</option>';?>
                          </select>
                        </div>
                      </div>
                        <!--end col-->
                        
                        <div class="col-lg-2" style="padding-right: 0;">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Admin Custom Cost</label>
                            <input type="text" disable readonly class="form-control" name="admin_cost_for_custom" placeholder="Admin Cost For Custom" id="compnayNameinput" value='<?php if(isset($row['admin_cost_custom'])){echo $row['admin_cost_custom'];}?>' style="border-top-right-radius: 0;border-bottom-right-radius: 0;" required/>
                          </div>
                        </div>
                        <div class="col-lg-1" style="padding-left: 0;">
                        <div class="mb-4">
                          <label for="compnayNameinput" class="form-label">&nbsp;</label>
                          <select class="form-select" disable readonly style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="ShippingCost_Currency" onchange="calculateShippingCost(this.value)" required/>
                           <?php 
                           echo '<option>'.$row['AdminCost_Currency'].'</option>';?>
                          </select>
                        </div>
                      </div>
                        <!--end col-->
                        <div class="col-lg-2" style="padding-right: 0;">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Custom Tax</label>
                            <input type="text" disable readonly class="form-control" name="custom_tax" placeholder="Custom Tax" id="compnayNameinput" value='<?php if(isset($row['custom_tax'])){echo $row['custom_tax'];}?>' style="border-top-right-radius: 0;border-bottom-right-radius: 0;" required/>
                          </div>
                        </div>
                        <div class="col-lg-1" style="padding-left: 0;">
                        <div class="mb-4">
                          <label for="compnayNameinput" class="form-label">&nbsp;</label>
                          <select class="form-select" disable readonly style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="ShippingCost_Currency" onchange="calculateShippingCost(this.value)" required/>
                           <?php 
                           echo '<option>'.$row['CustomTax_Currency'].'</option>';?>
                          </select>
                        </div>
                      </div>
                        <!--end col-->
                        
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Total Weight Of Shippment</label>
                            <input type="text" disable readonly class="form-control" name="total_weight_of_shippment" placeholder="Total Weight Of Shippment"id="compnayNameinput" value='<?php if(isset($row['total_wet_shippment'])){echo $row['total_wet_shippment'];}?>' required/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Per Unit Shipment Cost</label>
                            <input type="text" disable readonly class="form-control" value='<?php echo $row['per_unit_shipment_cost'];?>' required/>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Per Item Admin Cost</label>
                            <input type="text" disable readonly class="form-control" value='<?php echo $row['per_item_admin_cost'];?>' required/>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="compnayNameinput" class="form-label">Per Item Miscellaneous Cost</label>
                            <input type="text" disable readonly class="form-control" value='<?php echo $row['per_item_miscellaneous_cost'];?>' required/>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="mb-4">
                            <label for="compnayNameinput" class="form-label">Status</label>
                            <?php if($row['status']=="Delivered")echo "<input type='text' disable readonly class='form-control' value='Delivered'>";else{?>
                            <div style="display: flex;">
                            <select class="form-control" name="status" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" required="">
                            <option <?php if($row['status']=="Waiting for delivery")echo "selected";?>>Waiting for delivery</option>
                            <option <?php if($row['status']=="Delivered")echo "selected";?>>Delivered</option>
                           </select>
                           <button type="button" class="btn btn-info" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" onClick="changeStatus()">Apply</button>
                           </div>
                           <script>
                               function changeStatus(){
                                   var getStatus = "Delivered";
                                   if(getStatus=="Delivered"){
                                   var myData = "rid=<?php echo $_REQUEST['id']?>&status="+getStatus+"&action=updatePurchageEntrySts";
                                                        //alert(myData);
                                                         jQuery.ajax({
		                                                   type: "POST", // HTTP method POST or GET
			                                               url: "action.php", //Where to make Ajax calls
		                                                    dataType:"text", // Data type, HTML, json etc.
		                                                    data:myData, //Form variables
	                                                        success:function(response){
	                                                        alert('Data updated successfully.');
	                                                        window.location='http://rssindia.in.net/rss-demo/new_dashboard/editpurchaseEntryform.php?id=<?php echo $_REQUEST['id']?>';
	                                                      
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
                           <?php }?>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                <div class="card-body">
                                  <div id="customerList">
                                    <div class="table-responsive">
                                        <?php
                                        if(isset($_REQUEST['id'])){
                                            $purchase_sql1 = "SELECT * FROM `new_item` WHERE items_id={$row['id']}";
                                            $purchase_result1 = $conn->query($purchase_sql1);
                                        ?>
                                      <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                          <tr>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Local Currency Cost</th>
                                            <th>Batch No.</th>
                                            <th>Per Item Shipping Cost</th>
                                            <th>Per Unit Cost<br>(<small>Including All Expenses</small>)</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php 
                                            if($purchase_result1->rowCount()>0){
                                            while($purchase_row = $purchase_result1->fetch(PDO::FETCH_ASSOC)){?>
                                        <tr id="messageTxt<?php echo $purchase_row['id'] ?>">
                                          <td style="width: 160px;">
                                        <?php
                                            $itemName =  $purchase_row['item_name'];
                                            $itemId = $row['id'];
                                            $sql3 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
                                            $result3 = $conn->query($sql3);
                                        ?>
                                            <select disable readonly id="ForminputState" name="item_name[]" class="form-select">
                                        <?php
                                            while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                            <option value="<?php echo $row1['id'] ?>" <?php if($row1['id']==$purchase_row['item_name'])echo "selected"?>><?php if(isset($row1['item_name']))echo $row1['item_name']." (".$row1['measurement_unit'].")";?></option>
                                            <?php } ?>
                                            </select>
                                          </div></td>
                                          <td>
                                          <div class="form-group" id="textarea2">
                                            <input type="text" disable readonly class="form-control" name="quantity[]" value="<?php if(isset($purchase_row['item_name'])){echo $purchase_row['qty'];}?>" placeholder="Enter Qty"/>
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="costInput">
                                            <input type="text" disable readonly class="form-control" name="cost[]" value="<?php if(isset($purchase_row['cost'])){echo $purchase_row['cost'];}?>" placeholder="Cost"/>
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="CurrencyNmae">
                                            <input type="text" disable readonly class="form-control" name="localCurrency[]" value="<?php if(isset($purchase_row['local_currency'])){echo $purchase_row['local_currency'];}?>" placeholder="Local Currency Cost" />
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="batchNo">
                                            <input type="text" disable readonly class="form-control" name="batchNo[]" value="<?php if(isset($purchase_row['batch_no'])){echo $purchase_row['batch_no'];}?>" placeholder="Batch No." />
                                          </div>
                                          </td>
                                          <td><?php echo $purchase_row['per_item_shippment_cost']?></td>
                                          <td>
                                          <div class="form-group" id="textarea2">
                                            <input type="text" disable readonly class="form-control" name="per_unit_cost_item[]" value="<?php if(isset($purchase_row['per_unit_cost_item']))echo $purchase_row['per_unit_cost_item'];?>" placeholder="Enter Qty" id="compnayNameinput" />
                                          </div>
                                          </td>
                                          <td style="display:none">
                                            <input type="hidden" disable readonly name="hidden_id[]" value="<?php if(isset($purchase_row['id'])){echo $purchase_row['id'];} ?>">
                                          </td>
                                          <td style="display:none"><a style="cursor:pointer;background-color: #3c8dbc;border: none;color: white;padding: 5px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;margin: 4px 2px;cursor: pointer;border-radius: 20px;" class="btn btn-sm btn-success" onClick="return dataRdelete<?php echo $purchase_row['id'] ?>(<?php echo $purchase_row['id'] ?>)">Delete</a></td>
                                        </tr>
                                        <script>
                                            function dataRdelete<?php echo $purchase_row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
                                                        var myData = "rid="+rowID+"&action=deletePurchageEntryChild";
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
		                                                      $("#messageTxt<?php echo $purchase_row['id'] ?>").html('<td colspan="7"><span style="color: red;"><i class="fa fa-spinner fa-spin"></i> Data has been deleted successfully</span></td>');
		                                                            
		                                                            setTimeout(function(){
                                                                           $("#messageTxt<?php echo $purchase_row['id'] ?>").html(''); 
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
                                        <?php }
                                         //echo '<tr><td colspan="7" style="text-align: center;cursor:pointer"><button class="edit-item-btn add_form_field1" id="addColum" style="background: #fff;border: 0;"><i class="fa fa-plus" style="text-align: center;color: #a5a1a1;font-size: 25px;border: 1px solid #ccc;width: 50px;height: 50px;border-radius: 100%;line-height: 2;"></i></button></td></tr>';
                                        } ?>
                                        <tr><td colspan="7">
                                            <?php $listItem = $conn->query($sql3);?>
                                            <script>
        $(document).ready(function() {
      //alert('ok');
        var max_fields1      = 500;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        
        var x = 1; 
        $(add_button1).click(function(e){ 
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex gap-2"><div class="form-group" id="textarea1" style="width:265px"><select id="ForminputState" class="form-select" name="item_name[]" data-choicesdata-choices-sorting="true" required><?php while($row = $listItem->fetch(PDO::FETCH_ASSOC)){?><option value="<?php echo $row['id']?>"><?php if(isset($row['item_name']))echo $row['item_name']." (".$row['measurement_unit'].")";?></option><?php } ?></select></div></td><td><div class="form-group" id="textarea2"><input type="number" class="form-control" name="quantity[]" placeholder="Enter Qty" id="compnayNameinput" required/></div><div class="form-group" id="costInput"><input type="number" class="form-control" name="cost[]" placeholder="Cost" id="compnayNameinput" required/></div><div class="form-group" id="CurrencyNmae"><input type="text" class="form-control" name="localCurrency[]" placeholder="Currency Value" id="compnayNameinput" required /></div><div class="form-group" id="batchNo"><input type="text" class="form-control" name="batchNo[]" placeholder="Batch No."id="compnayNameinput" /><input type="hidden" name="hidden_id[]"></div><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete">Remove</a></div></div>'); 
           //alert('Fields added');
            }
        else
        {
        alert('You Reached the limits')
        }
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
                                      <?php } ?>
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
                        <div class="col-sm-3 mx-auto" style="text-align:center">
                            <!----<input type="submit" name="update" class="btn btn-info" Value="Update">--->
                            <a href="purchaseEntryForm.php" class="btn btn-info">Back</a>
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