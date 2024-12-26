<?php
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['orderid']) && !empty($_REQUEST['orderid']))$order_id = $_REQUEST['orderid'];else $order_id=''; 
if(isset($_REQUEST['custid']) && !empty($_REQUEST['custid']))$customer_id = $_REQUEST['custid'];else $customer_id=''; 

$result_sl_product = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]'");
//sel customer
$result_sl_customer = $conn->query("SELECT name,reg_id FROM `customer` where user_reg_id='$_SESSION[id]'");
$customerList = '<option value="">Select Customer</option>';
while($data=$result_sl_customer->fetch(PDO::FETCH_ASSOC)){
    if(!empty($customer_id) && $customer_id==$data['reg_id'])$sl = "selected";else$sl = '';
    $customerList .='<option '.$sl.' value="'.$data['reg_id'].'">'.$data['name'].' '.$data['mobile_no'].'</option>';
}

$messageAction = '';
if(isset($_REQUEST['submitData'])){
  $purpose = $_REQUEST['purpose'];
  $manufacturing_date = $_REQUEST['manufacturing_date'];
  $batch_code = $_REQUEST['batch_code'];
  if(isset($_REQUEST['customer_name']) && !empty($_REQUEST['customer_name']))$customer_name = $_REQUEST['customer_name'];
  if(isset($_REQUEST['stock_maintenance']) && !empty($_REQUEST['stock_maintenance']))$stock_maintenance = $_REQUEST['stock_maintenance'];
  
  $sql = "INSERT INTO `product_batch` SET user_reg_id='$_SESSION[id]',purpose='$purpose',manufacturing_date='$manufacturing_date', customer_name='$customer_name', batch_code='$batch_code', stock_maintenance='$stock_maintenance', order_id='$order_id'";
  if($conn->exec($sql)){
    //insert multiple data
    $insID = $conn->lastInsertId();
	$finalTotalwt = 0;
	$product_id=sizeof($_REQUEST['product_id']);

    for($i=0;$i<sizeof($_REQUEST['product_id']);$i++){
      $product_id = $_REQUEST['product_id'][$i];
      $quantity = $_REQUEST['quantity'][$i];
      $work_status = $_REQUEST['work_status'][$i];
      $costPerUnit = $_REQUEST['costPerUnit'][$i];
      $totalCost = $_REQUEST['totalCost'][$i];
            
	    $sql1 = "INSERT INTO `product_batch_sub_iteam` SET `user_reg_id`='$_SESSION[id]',`batch_id`='$insID',`product_id`='$product_id', `quantity`='$quantity', `work_status`='$work_status', `costPerUnit`='$costPerUnit', `totalCost`='$totalCost'";
        $result1 = $conn->exec($sql1);
        $productBatchID = $conn->lastInsertId(); 
        
      //manufacture product entry
	  $sel_product_formula = $conn->query("select item,item_qty from `product_sub_item` where product_id='$product_id'");
	  while($productDta = $sel_product_formula->fetch(PDO::FETCH_ASSOC)){
	      $item = $productDta['item'];
	      $manufacture_date = $manufacturing_date;
	      $item_qty = $productDta['item_qty']*$quantity;
	      $raw_material_manufacture_Q = "insert into `raw_material_overview` set batch_sub_id='$productBatchID',item='$item',item_qty='$item_qty',status='$work_status',manufacture_date='$manufacture_date',user_reg_id='$_SESSION[id]'";
	      $row_insert = $conn->exec($raw_material_manufacture_Q);
	   }
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
<title>Product Manufacture Batch | <?php echo $_SESSION['userName']?> </title>
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script>
        $(document).ready(function() {
        var max_fields1      = 500;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        var x = 1; 
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
                  <li class="breadcrumb-item active"> Product Manufacture Batch </li>
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
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center">
					 <a href="#addNewPurchase">
                      <button class="btn btn-sm btn-success edit-item-btn"> Add New Product Batch</button>
                      </a> 
                    </div>
                  </div>
                  
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
                    $sql="SELECT * FROM `product_batch` where user_reg_id='$_SESSION[id]' order by id desc";
                    $result=$conn->query($sql);
                    if($result->rowCount()>0){
                    ?>
                  <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th> Batch Code </th>
                          <th> Date </th>
                          <th> Customer Name </th>
                          <th> Stock </th>
                          <th> Status </th>
                          <th> Total Cost </th>
                          <th> Update </th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        <?php 
                          $totalAmount = 0;
                          while($row=$result->fetch(PDO::FETCH_ASSOC)){ 
                          //sel status
                          $sl_product_batch_sts_Q = $conn->query("select work_status from `product_batch_sub_iteam` where batch_id='$row[id]'");
                          $productBatchSts = $sl_product_batch_sts_Q->fetch(PDO::FETCH_ASSOC);
                          //sel customer name
                          $sl_customer_name_Q = $conn->query("select name from `customer` where reg_id='$row[customer_name]'");
                          $customerName = $sl_customer_name_Q->fetch(PDO::FETCH_ASSOC);
                          if(!empty($row['order_id']))$orderMessage = "<br><font color='green'>Order Id:".$row['order_id']."</font>";
                          ?> 
                        <tr>
                          <td><?php echo $row['batch_code']?></td>
                          <td><?php echo $row['manufacturing_date']?></td>
                          <td><?php echo $customerName['name'].$orderMessage?></td>
                          <td><?php echo $row['stock_maintenance']?></td>
                          <td><?php if($productBatchSts['work_status']=="Work in progress")echo '<span class="badge badge-soft-danger text-uppercase">'.$productBatchSts['work_status'].'</span>';
                                    if($productBatchSts['work_status']=="Completed")echo '<span class="badge badge-soft-success text-uppercase">'.$productBatchSts['work_status'].'</span>';
                                ?></td>
                          <td><?php echo $row['totalManufacringCost']?></td>
                          <td><div class="d-flex gap-2">
                              <div class="edit">
                                 <a href="editmanufactureBatch.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                              </div>
                              <div class="edit">
                                 <a href="print-manufacture-batch-availability.php?id=<?php echo $row['id']?>&action=print" class="btn btn-sm btn-success edit-item-btn">Print</a>
                              </div>
                              <div class="remove">
                                <a style="cursor:pointer" onClick="return dataRdelete<?php echo $row['id']?>(<?php echo $row['id']?>)" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                              </div>
                            </div>
                         </td>
                        </tr>
                        <script>
							function dataRdelete<?php echo $row['id'] ?>(rowID){
								var myData = "rid="+rowID+"&action=deleteManufactureBatchRow";
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
											   window.location='productmanufacturebatch.php';
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
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  <?php }else{?>
                  <div class="noresult" style="display: none">
                      <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"> </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                      </div>
                    </div>
                  <?php }?>
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
                <h4 class="card-title mb-0 flex-grow-1">Add New Product Batch</h4>
              </div>
              <!-- end card header -->
              <div class="card-body">
                <form method="post">
                <div class="live-preview">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="firstNameinput" class="form-label"> Purpose</label>
                          <select name="purpose" class="form-select" onchange="showHide(this.value)" required>
                            <option>Pre order from customer</option>
                            <option>Stock Maintenance</option>
                          </select>
                        </div>
                      </div>
                      <script>
                          function showHide(getVal){
                            if(getVal=="Pre order from customer"){
                              var customerList = '<?php echo $customerList?>';    
                               document.getElementById('custumId').innerHTML='<div class="mb-3"><label for="compnayNameinput" class="form-label">Customer Name</label><select name="customer_name" class="form-control" required/>'+customerList+'</select></div>'; 
                            }else{
                               document.getElementById('custumId').innerHTML='<div class="mb-3"><label for="compnayNameinput" class="form-label">Stock Maintenance</label><input type="text" name="stock_maintenance" class="form-control" placeholder="Stock Maintenance" required /></div>'; 
                            }   
                          }
                      </script>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="StartleaveDate" class="form-label">Select Date</label>
                          <input type="date" name="manufacturing_date" class="form-control" id="manufacturing_date" required/>
                        </div>
                      </div>
                      <div class="col-lg-4" id="custumId">
                        <div class="mb-3">
                          <label for="compnayNameinput" class="form-label">Customer Name</label>
                          <select name="customer_name" class="form-control" required/>
                           <?php echo $customerList?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-2">
                        <div class="mb-3">
                          <label for="compnayNameinput" class="form-label">Batch Code </label>
                          <input type="text" name="batch_code" class="form-control disabled" placeholder="Batch Code"/>
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
                                          <th> Product name </th>
                                          <th> Qty </th>
                                          <th> Status </th>
                                          <!----<th> Raw Material Status </th>--->
                                          <th> Cost per unit </th>
                                          <th> Total Cost </th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody class="list form-check-all">
                                        <tr>
                                          <td style="width: 275px;">
                                            <select class="form-select" data-choices data-choices-sorting="true" name="product_id[]" id="all_product0" onchange="getProduct(this.value,0)" required>
                                              <option value=''>Select Product</option>
                                              <?php while($data=$result_sl_product->fetch(PDO::FETCH_ASSOC)){?>
                                              <option value="<?php echo $data['id']?>"><?php echo $data['product_name']?></option>
                                              <?php }?>
                                            </select>
                                          </td>
                                          <td style="width: 100px;">
                                            <input type="text" class="form-control1" style="width: 100px;" onkeyUP="getProQty(this.value,0)" name="quantity[]" id="quantity0" placeholder="Enter Qty"  required/>
                                          </td>
                                          <td style="width: 165px;">
                                             <select class="form-select" name="work_status[]" data-choices data-choices-sorting="true" required>
                                              <option selected>Work in progress</option>
                                              <option>Completed</option>
                                            </select>
                                          </td>
                                          <!----
                                          <td>
                                           <span class="badge badge-soft-success d-none text-uppercase">Available</span>
                                           <span class="badge badge-soft-danger text-uppercase"> LOW AVAILABILITY</span>
                                          </td>
                                          ---->
                                          <td><input type="text" class="form-control" name="costPerUnit[]" placeholder="Cost Per Unit" id="costPerUnit0"  required/>
                                          </td>
                                          <td><input type="text" class="form-control" name="totalCost[]" placeholder="Total Cost" id="totalCost0"  required/>
                                          </td>
                                          <td><div class="d-flex gap-2" style="margin-top: 0;">
                                              <div class="edit">
                                                <button type="button" class="btn btn-sm btn-success edit-item-btn add_form_field1"> Add&nbsp;New </button>
                                              </div>
                                            </div></td>
                                        </tr>
                                      </tbody>
                                    </table>
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
                  <div class="col-lg-12">
                    <div class="text-center">
                      <button type="submit" name="submitData" class="btn btn-primary"> Submit </button>
                      <a href="orderSheetList.php" class="btn btn-danger"> Cancel </a>
                    </div>
                  </div>
                <!--end col-->
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
