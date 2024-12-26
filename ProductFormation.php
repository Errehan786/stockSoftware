<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['main_submit'])){
   $productName = $_REQUEST['product_name'];
   $productWeight = $_REQUEST['proWeight'];
   $productDesc = $_REQUEST['product_description'];
   $formula = $_REQUEST['formula'];
   $sql = "INSERT INTO `products`(`user_reg_id`,`product_name`, `product_qty`, `description`, `formula_name`) VALUES ('$_SESSION[id]','$productName','$productWeight','$productDesc','$formula')";
   if($conn->exec($sql)){
    $productID = $conn->lastInsertId();
    for($i=0;$i<sizeof($_REQUEST['categoryType']);$i++){
        $categoryType = $_REQUEST['categoryType'][$i];
        $categoryIn = $_REQUEST['categoryIn'][$i];
        $item = $_REQUEST['item'][$i];
        $item_qty = $_REQUEST['item_qty'][$i];
        $chooseDate = $_REQUEST['chooseDate'][$i];
        $costPerUnit = $_REQUEST['costPerUnit'][$i];
        $itemCost = $_REQUEST['itemCost'][$i];
        $sql1 = "INSERT INTO `product_sub_item` SET product_id='$productID',category='$categoryType',category_in='$categoryIn',item='$item',item_qty='$item_qty',item_selected_date='$chooseDate',unit_price='$costPerUnit',item_cost='$itemCost'"; 
        $result1 = $conn->exec($sql1);
        }
      
        $messageAction = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spin me-2"></i>Data has been Save Successfull</h6>
        </div>';
        @$conn->NULL;
        //echo '<script>alert ("Data has been save successfull");<//script>';
        //echo '<script>window.location = "ProductFormation.php"<//script>'; 
        
      }else{
        echo '<script>alert("Data Not Inserted");</script>';
      }
}

if(isset($_REQUEST['subproductdelid'])){
    $sql = "DELETE FROM product_sub_item WHERE id={$_REQUEST['subproductdelid']}";
       if($conn->exec($sql) == TRUE){
       $msg = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Deleted Successfull</h6>
       </div>';
?>
<script>
setTimeout(
   function(){
       window.location = "ProductFormation.php"; 
   },
1000);
</script>
<?php
   }else{
   $msg = '<div class="mx-3 mt-3">
   <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Deleted Successfull</h6> </div>';
?>
<script>
setTimeout(
   function(){
       window.location = "ProductFormation.php"; 
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
<title>Product Entry & List | <?php echo $_SESSION['userName']?> </title>
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
<?php
        $sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
        $result = $conn->query($sql);
    ?>
<?php
        $sql1 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
        $result1 = $conn->query($sql1);
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
              <h4 class="mb-sm-0">PRODUCT LIST & ENTRY FORM</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"> <a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">Product</li>
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
                          <!-- <label for="StartleaveDate" class="form-label">To Date</label>
                                                        <input type="date" class="form-control"
                                                            data-provider="flatpickr" id="StartleaveDate" /> -->
                        </div>
                        <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <label for="StartleaveDate" class="form-label">To Date</label>
                          <input type="date" class="form-control" data-provider="flatpickr" id="StartleaveDate" />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center">
                     <a href="#newProduct">
                      <button class="btn btn-sm btn-success edit-item-btn"> Add NewProducts </button>
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
                  <?php
                                        $sql = "SELECT * FROM `products` where user_reg_id='$_SESSION[id]' order by id desc";
                                        $result = $conn->query($sql);
                                        if($result->rowCount()>0){
                                        ?>
                  <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>Product Name</th>
                          <th>Description</th>
                          <th>Formula Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                                    $formulaName = $row['formula_name'];
                                                    $sql1 = "SELECT formula_name FROM formula_entry WHERE id='$formulaName'";
                                                    $result1 = $conn->query($sql1);
                                                    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                                                    ?>
                        <tr id="messageTxtHide<?php echo $row['id']?>">
                          <?php
                                                        echo '<td>' . $row['product_name'] . '</td>';
                                                        echo '<td>' . $row['description'] . '</td>';
                                                        echo '<td>' . @$row1['formula_name'] . '</td>';
                                                        echo '<td>
                                                        <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="editproductFormation.php?productnewid='. $row['id'] . '" name="productnewid" class="btn btn-sm btn-success remove-item-btn">edit</a>
                                                        </div>
                                                        <div class="remove">
                                                            <input type="button" class="btn btn-sm btn-danger remove-item-btn" onClick="return dataPdelete'.$row['id'].'('.$row['id'].')" value="Delete">
                                                        </div>
                                                        </td>';
                                                        ?>
                                            <script>
                                             function dataPdelete<?php echo $row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
                                                        var myData = "rid="+rowID+"&action=deleteProductRow";
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
		                                                      $("#messageTxt").html('<h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been deleted successfully</h6>');
		                                                            setTimeout(function(){
                                                                        $("#messageTxtHide<?php echo $row['id']?>").html(''); 
                                                                        $("#messageTxt").html(''); 
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
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <?php } ?>
                    <div class="noresult" style="display: none">
                      <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a"
style="width:75px;height:75px"> </lord-icon>
                        <h5 class="mt-2">Sorry! No Result Found</h5>
                        <p class="text-muted mb-0">We've searched more than 150+ Orders We
                          did not find any orders for you search.</p>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end">
                    <div class="pagination-wrap hstack gap-2"> <a class="page-item pagination-prev disabled"></a>
                      <ul class="pagination listjs-pagination mb-0">
                      </ul>
                      <a class="page-item pagination-next"></a> </div>
                  </div>
                </div>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
          </div>
          <!-- end col -->
        </div>
        <div class="row" id="newProduct">
          <div class="col-xxl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add New Product</h4>
              </div>
              <?php
					if(isset($msg)){
						echo $msg;
					}
					?>
              <!-- end card header -->
              <div class="card-body">
                <div class="live-preview">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label class="form-label">Product Name</label>
                          <input type="text"class="form-control" name="product_name" placeholder="Enter Product Name." autocomplete="off" required/>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label class="form-label">Weight(In Gram)</label>
                          <input type="number" class="form-control" name="proWeight" id="proWeight" placeholder="Enter Weight(In Gram)" autocomplete="off" required="">
                        </div>
                      </div>
                      <div class="col-lg-3 d-none d-lg-block">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <input type="text"class="form-control" name="product_description" placeholder="Enter Description" autocomplete="off" required/>
                        </div>
                      </div>
                      <?php
						// Formula Name select code
						  $sql = "SELECT * FROM `formula_entry` where user_reg_id='$_SESSION[id]'";
						  $result = $conn->query($sql);
						 ?>
                      <div class="col-lg-2">
                        <div class="mb-3">
                          <label for="firstNameinput" class="form-label">Formula name</label>
                          <select id="ForminputState" name="formula" class="form-select text-start" data-choices data-choices-sorting="true" onChange="getFormulaData(this.value)" required>
                            <option value="">Select Formula</option>
                            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                            <option name="product_formula" value="<?php echo $row['id'];?>">
                            <?php if(isset($row['formula_name'])){echo $row['formula_name'];}?>
                            </option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <script>
							function getFormulaData(getFormula){
							    var productWeight = document.getElementById("proWeight").value;
							    if(productWeight!=''){
								var myData = "formulaID="+getFormula+'&productWeight='+productWeight+'&action=formulaIs';
									//alert(myData);
									jQuery.ajax({
									 type: "POST", // HTTP method POST or GET
									 url: "getData.php", //Where to make Ajax calls
									   dataType:"text", // Data type, HTML, json etc.
									   data:myData, //Form variables
									success:function(response){
									//alert(response);
									if(response==0){
									  $("#formulaList").html('<span style="color: red;"> No recound found!</span>');
									}else{
									 document.getElementById("formulaList").innerHTML=response;
									 }
									},

									error:function (xhr, ajaxOptions, thrownError){
									reg("#submitbtn").show(); //show submit button
									reg("#LoadingImage").hide(); //hide loading image
										alert(thrownError);
									 }
									});
						    	}else{
						    	  document.getElementById("proWeight").focus();  
						    	}
							  }	
						    	
						    function getDateId(getStr,seNo){
						      var productWeight = document.getElementById("proWeight").value;
						      if(productWeight!='' && getStr!=''){
						      var totalitemCost = document.getElementById("totalitemCost").value;
						      var itemWeight = document.getElementById("item_qty"+seNo).value;
						      if(totalitemCost=='')totalitemCost=0;
						      var myData = "selrowID="+getStr+"&seNo="+seNo+'&itemWeight='+itemWeight+'&totalitemCost='+totalitemCost+'&action=getPriceRaw';
						      //alert(myData);
						      jQuery.ajax({
									 type: "POST", // HTTP method POST or GET
									 url: "getData.php", //Where to make Ajax calls
									   dataType:"text", // Data type, HTML, json etc.
									   data:myData, //Form variables
									success:function(response){
									   var expValue = response.split("M*M"); 
									   document.getElementById("costPerUnit"+seNo).value = expValue[0];
									   document.getElementById("totalcostManufacturing"+seNo).value = expValue[1];
									   document.getElementById("totalitemCost").value = expValue[2];
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
                      <div class="col-12" id="formulaList"></div>
                      <hr>
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
<!--start back-to-top-->
<button onClick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"> <i class="ri-arrow-up-line"></i> </button>
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
<script src="assets/libs/list.js/list.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
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