<?php include_once('config.php'); 
include_once('include/auth.php'); 
$messageAction = '';
  if(isset($_REQUEST['currency_submit'])){
    $currency_name=$_REQUEST['currency_name'];
	
    $sql="INSERT INTO `currency`(user_reg_id,currency_name) VALUES ('$_SESSION[id]','$currency_name')";
    if($result=$conn->exec($sql)){
       $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been saved successfully</h6>
       </div>';
       @$conn->NULL;
    }else{
       $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been not saved</h6></div>';
    }
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
<meta charset="utf-8" />
<title>Currency | <?php echo $_SESSION['userName']?> </title>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
 [data-layout="vertical"][data-sidebar-size="sm"] {
   min-height:auto!important;
  }
  [data-layout="vertical"][data-sidebar-size="sm"] .main-content {
    margin-left: 70px;
  }    
</style>
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
              <h4 class="mb-sm-0">CURRENCY LIST</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"> <a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">Currency</li>
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
                    <div class="col-lg-3 col-12">
                      <div class="d-flex align-items-center justify-content-center h-100  ">
                        <div class="search-box  w-100 m-0">
                          <label class="form-label">Search</label>
                          <input type="text" class="form-control search" placeholder="Search...">
                          <i class="ri-search-line search-icon"></i> </div>
                      </div>
                    </div>
                    <div class="col-lg-9 col-12">
                      <div class=" d-flex justify-content-end h-100 align-items-center"> <a href="#addNewItem">
                        <button class="btn btn-sm btn-success edit-item-btn"> Add New Currency</button>
                        </a> </div>
                    </div>
                  </div>
                  <?php
                    if(isset($messageAction)){
                        echo '<div id="entryID" style="position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;">'.$messageAction.'</div>';
                     ?>
                  <script>
                         setTimeout(function(){
                          document.getElementById('entryID').innerHTML='';
                         },2000);
                     </script>
                  <?php
                     }
                    ?>
                  <div id="messageTxt" style="position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;"></div>
                  <?php 
							$sql = "SELECT * FROM `currency` where user_reg_id='$_SESSION[id]' order by id desc";
							$result = $conn->query($sql);
							?>
                  <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>Currency Code</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        <?php  while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                        <tr id="messageTxtHide<?php echo $row['id']?>">
                          <?php
									echo '<td>' . $row['currency_name'] . '</td>';
									echo '<td>
									   <div class="d-flex gap-2">
										<div class="edit">
											<a href="currencyedit.php?edit_currency='. $row['id'] .'" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
										</div>
										<div class="remove">
													<input type="button" name="currency_delete" onClick="return dataIdCurrency'.$row['id'].'('.$row['id'].')" class="btn btn-sm btn-danger remove-item-btn" value="Remove">
												</div>
										</div>
									</td>';
									?>
                          <script>
								 function dataIdCurrency<?php echo $row['id'] ?>(rowID){
								  var r = confirm('Are you want to delete?');
								  if(!r){
									  return false;
								  }else{
									var myData = "rid="+rowID+"&action=deleteCurrencyRow";
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
                  </div>
                  <div class="d-flex justify-content-end">
                    <div class="pagination-wrap hstack gap-2"> <a class="page-item pagination-prev disabled" href="#"></a>
                      <ul class="pagination listjs-pagination mb-0">
                      </ul>
                      <a class="page-item pagination-next" href="#"></a> </div>
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
        <div class="row" id="addNewItem">
          <div class="col-xxl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add New Currency</h4>
              </div>
              <?php  if(isset($msg)){
                        echo $msg;
                     }
                 ?>
              <div class="card-body">
                <div class="live-preview">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label for="firstNameinput" class="form-label"> Currency Code</label>
                          <input type="text" class="form-control" name="currency_name" id="currency_name"placeholder="Enter Currency Name" required/>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
						 <label for="compnayNameinput" class="form-label">&nbsp;</label>
                          <div class="text-center">
                            <input type="submit" name="currency_submit" class="btn btn-primary" value="Submit">
                          </div>
                        </div>
                      </div>
                      <hr>
                    </div>
                  </form>
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
  <!-- Footer start -->
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