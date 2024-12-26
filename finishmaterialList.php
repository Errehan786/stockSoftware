<?php include_once('config.php'); 
include_once('include/auth.php'); 
$messageAction = '';
  if(isset($_REQUEST['item_submit'])){
    $item_code=$_REQUEST['item_code'];
    $item_name=$_REQUEST['item_name'];
    $item_description=$_REQUEST['item_description'];
    $vender_name=$_REQUEST['vendor_name'];
    $category=$_REQUEST['category'];
    $measurement_unit=$_REQUEST['measurement_unit'];
    $weight_unit=$_REQUEST['weight_unit'];
    $location=$_REQUEST['location'];
    $sql="INSERT INTO `items`(user_reg_id,item_code, item_name, item_desc, vender_name, category, measurement_unit, weight_unit, location_name) VALUES ('$_SESSION[id]','$item_code','$item_name','$item_description','$vender_name','$category','$measurement_unit','$weight_unit','$location')";
   
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
    <title>Raw Material List | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">Raw Material List</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Raw Material List</li>
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
                                                        <input type="text" class="form-control search"
                                                            placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-12">
                                                <div class=" d-flex justify-content-end h-100 align-items-center">
                                                    <a href="#addNewItem"> <button class="btn btn-sm btn-success edit-item-btn"> Add New Raw Material</button>
                                                    </a>
                                                </div>
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
                                        $sql = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
                                        $result = $conn->query($sql);
                                        ?>
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Op Stk</th>
                                                        <th>Units</th>
                                                        <th>Conv. in Pcs</th>
                                                        <th>Rate</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                   
                                                    <tr id="messageTxtHide<?php echo $row['id']?>">
                                                      
                                                       <td>Profit And Loss Acct. of Year</td>
                                                       <td>Capitals Account</td>
                                                       <td> 400 </td>
                                                       <td> Kg </td>
                                                       <td> 4 </td>
                                                       <td> 20</td>
                                                       <td>
                                                           <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <a href="finishmaterialListedit.php" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
                                                            </div>
                                                            <div class="remove">
                                                                        <input type="button" name="item_delete"  onClick="return dataIdelete'.$row['id'].'('.$row['id'].')" class="btn btn-sm btn-danger remove-item-btn" value="Remove">
                                                                    </div>
                                                            </div>
                                                        </td>
                                            <script>
                                             function dataIdelete<?php echo $row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
                                                        var myData = "rid="+rowID+"&action=deleteItemRow";
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
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#"></a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#"></a>
                                            </div>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Account</h4>
                                </div>
                                <?php
                                if(isset($msg)){
                                    echo $msg;
                                }
                                ?>

                                <div class="modal fade" id="addNewVendor" tabindex="-1"
                                              aria-labelledby="addNewVendor" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Add New Vendor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                      aria-label="Close" onClick="closeVendorModel()"></button>
                                                  </div>
                                                  <div class="modal-body" id="pops">
                                                  <?php
                                                  if(isset($msg)){
                                                    echo $msg;
                                                  }
                                                  ?>
                                                    <div class="row">
                                                      <form name="vendorForm" method="post">
                                                      <div class="col-xxl-12">
                                                        <div>
                                                          <div style="text-align: justify;">
                                                            <div class="live-preview">
                                                                <div class="row">
                                                                  <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                      <label for="firstNameinput" class="form-label">
                                                                        Name</label>
                                                                      <input type="text" class="form-control" name="v_name" id="v_name"
                                                                        placeholder="Enter Vendor Name" required/>
                                                                    </div>
                                                                  </div>

                                                                  <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Email Id</label>
                                                                      <input type="text" class="form-control" name="v_email" id="v_email"
                                                                        placeholder="Enter Email Id"/>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Mobile No</label>
                                                                      <input type="text" class="form-control" name="v_number" id="v_number"
                                                                        placeholder="Enter Mobile No" maxlength="10" minlength="10" required/>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Address</label>
                                                                      <input type="text" class="form-control" name="v_address" id="v_address"
                                                                        placeholder="Enter Address"/>
                                                                    </div>
                                                                  </div>
                                                                  <hr>
                                                                  <div class="col-lg-12">
                                                                    <div class="text-center" style="margin-bottom: 15px;">
                                                                      <button type="submit" class="btn btn-primary" name="v_submit" onClick="return vendorRsubmit()"><i class="fa " id="btnVbutton"></i> Submit</button>
                                                                    </div>
                                                                    <p id="messageVendorTxt" style="text-align: center;">&nbsp;</p>
                                                                  </div>
                                                                  <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                              </form>
                                                              <script>
                                                                function vendorRsubmit(){
                                                                 if(document.vendorForm.v_name.value==''){
                                                                     $("#messageVendorTxt").html('<span style="color: red;"> Enter Vendor Name</span>');
                                                                     return false;
                                                                 }else if(document.vendorForm.v_number.value==''){
                                                                     $("#messageVendorTxt").html('<span style="color: red;"> Enter Vendor Mobile No</span>');
                                                                     return false;
                                                                 }else{    
                                                                 $("#btnVbutton").addClass('fa-spinner fa-spin');    
                                                                 var myData = "v_name="+document.vendorForm.v_name.value+"&v_email="+document.vendorForm.v_email.value+"&v_number="+document.vendorForm.v_number.value+"&v_address="+document.vendorForm.v_address.value;
                                                                    //alert(myData);
                                                                    jQuery.ajax({
		                                                          	 type: "POST", // HTTP method POST or GET
			                                                         url: "submitModelData.php", //Where to make Ajax calls
		                                                               dataType:"text", // Data type, HTML, json etc.
		                                                               data:myData, //Form variables
	                                                                success:function(response){
	                                                                //alert(response);
	                                                                if(response==0){
	                                                                  $("#messageVendorTxt").html('<span style="color: red;"> Some error!</span>');
	                                                                }else{
		                                                             $("#messageVendorTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
		                                                             document.getElementById("vendorList").innerHTML=response;
		                                                             $("#btnVbutton").removeClass('fa-spinner fa-spin');
		                                                              setTimeout(function(){
		                                                                   $("#addNewVendor").removeClass("show");
                                                                           document.getElementById("addNewVendor").style.display="none";
                                                                           $("#messageVendorTxt").html(''); 
		                                                              },2000);
	                                                                  
	                                                                 }
	                                                                },
		
                                                                    error:function (xhr, ajaxOptions, thrownError){
			                                                        reg("#submitbtn").show(); //show submit button
			                                                    	reg("#LoadingImage").hide(); //hide loading image
				                                                        alert(thrownError);
			                                                         }
		                                                        	});
                                                                   }
		                                                            return false;
                                                                  }
                                                              </script>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <!-- end col -->
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                           
                                            <div class="modal fade" id="addNewCategory" tabindex="-1"
                                              aria-labelledby="addNewCategory" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Add New Raw Material</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                      aria-label="Close" onClick="closeCategoryModel()"></button>
                                                  </div>
                                                  <div class="modal-body" id="pops">
                                                  <?php
                                                  if(isset($msg)){
                                                    echo $msg;
                                                  }
                                                  ?>
                                                    <div class="row">
                                                     <form name="categoryForm" method="post">
                                                      <div class="col-xxl-12">
                                                        <div>
                                                          <div style="text-align: justify;">
                                                            <div class="live-preview">
                                                                <div class="row">
                                                                  <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                      <label for="firstNameinput" class="form-label">
                                                                        Category Name</label>
                                                                      <input type="text" class="form-control" name="c_name" id="c_name"
                                                                        placeholder="Enter Category Name" required/>
                                                                    </div>
                                                                  </div>

                                                                  <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Description No.</label>
                                                                      <input type="text" class="form-control" name="c_description" id="c_description"
                                                                        placeholder="Enter Description"/>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Measuring Units</label>
                                                                      <select id="ForminputState" class="form-select" name="c_units" id="c_units" data-choices data-choices-sorting="true" required>
                                                                        <option value="">-----Measuring Units-----</option>
                                                                        <option value="Pcs">Pcs</option>
                                                                        <option value="Liters">Litres</option>
                                                                        <option value="Grams">Grams</option>
                                                                        <option value="cm">cm</option>
                                                                        <option value="meters">metres</option>
                                                                        <option value="kg">kg</option>
                                                                      </select>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                      <label for="compnayNameinput"
                                                                        class="form-label">Percentage(%)</label>
                                                                      <select id="percentageType" name="percentage" class="form-select" data-choices data-choices-sorting="true" required>
                                                                        <option value="">--(%)--</option>
                                                                        <option>No</option>
                                                                        <option>Yes</option>
                                                                      </select>
                                                                    </div>
                                                                  </div>
                                                                  
                                                                  <hr>
                                                                  <div class="col-lg-12">
                                                                    <div class="text-center" style="margin-bottom:15px">
                                                                      <button type="submit" class="btn btn-primary" name="c_submit" onClick="return categoryRsubmit()"> <i class="fa " id="btnCbutton"></i> Submit</button>
                                                                    </div>
                                                                    <p id="messageCategoryTxt" style="text-align: center;">&nbsp;</p>
                                                                  </div>
                                                                  <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                              </form>
                                                             <script>
                                                                function categoryRsubmit(){
                                                                 if(document.categoryForm.c_name.value==''){
                                                                     $("#messageCategoryTxt").html('<span style="color: red;"> Enter Category Name</span>');
                                                                     return false;
                                                                 }else if(document.categoryForm.c_units.value==''){
                                                                     $("#messageCategoryTxt").html('<span style="color: red;"> Select Measuring Units</span>');
                                                                     return false;
                                                                 }else if(document.categoryForm.percentageType.value==''){
                                                                     $("#messageCategoryTxt").html('<span style="color: red;"> Select Percentage Type</span>');
                                                                     return false;
                                                                 }else{    
                                                                 $("#btnCbutton").addClass('fa-spinner fa-spin');    
                                                                 var myData = "category_name="+document.categoryForm.c_name.value+"&c_units="+document.categoryForm.c_units.value+"&c_description="+document.categoryForm.c_description.value+"&percentageType="+document.categoryForm.percentageType.value;
                                                                    //alert(myData);
                                                                    jQuery.ajax({
		                                                          	 type: "POST", // HTTP method POST or GET
			                                                         url: "submitModelData.php", //Where to make Ajax calls
		                                                               dataType:"text", // Data type, HTML, json etc.
		                                                               data:myData, //Form variables
	                                                                success:function(response){
	                                                                //alert(response);
	                                                                if(response==0){
	                                                                  $("#messageCategoryTxt").html('<span style="color: red;"> Some error!</span>');
	                                                                }else{
		                                                             $("#messageCategoryTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
		                                                             document.getElementById("category").innerHTML=response;
		                                                             $("#btnCbutton").removeClass('fa-spinner fa-spin');
		                                                              setTimeout(function(){
		                                                                   $("#addNewCategory").removeClass("show");
                                                                           document.getElementById("addNewCategory").style.display="none";
                                                                           
		                                                                   document.categoryForm.c_name.value='';
		                                                                   document.categoryForm.c_description.value='';
		                                                                   document.categoryForm.c_units.value=''; 
		                                                                   document.categoryForm.weights.value=''; 
                                                                           $("#messageCategoryTxt").html(''); 
		                                                              },2000);
	                                                                  return false;
	                                                                 }
	                                                                },
		
                                                                    error:function (xhr, ajaxOptions, thrownError){
			                                                        reg("#submitbtn").show(); //show submit button
			                                                    	reg("#LoadingImage").hide(); //hide loading image
				                                                        alert(thrownError);
			                                                         }
		                                                        	});
                                                                   }
		                                                            return false;
                                                                  }
                                                              </script>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <!-- end col -->
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            <!-- end card header -->
<div class="card-body">
   <div class="live-preview">
      <form action="" method="POST">
         <div class="row">
            <div class="col-lg-4">
               <div class="mb-3">
                  <label class="form-label">Product Group</label>
                  <select id="" name="" class="form-select"  required>
                     <option value="">Select Product Group </option>
                     <option name ="" value="">Product Group1</option>
                     <option name ="" value="">Product Group2</option>
                     <option name ="" value="">Product Group3</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="mb-3">
                  <label class="form-label">Description
                  </label>
                  <input type="text" class="form-control" name="" placeholder="Enter Description" autocomplete="off" required/>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="mb-3">
                  <label class="form-label">Opening Stock
                  </label>
                  <input type="text" class="form-control" name="" placeholder="" autocomplete="off" required/>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="mb-3">
                  <label class="form-label">Stock Limit
                  </label>
                  <input type="text" class="form-control" name="" placeholder="" autocomplete="off" required/>
               </div>
            </div>
            <div class="col-lg-4">
               <div class=" mb-3">
                  <label class="form-label">Cost Price/Unit
                  </label>
                  <input type="text" class="form-control" name=""
                     placeholder="Enter Cost Price" autocomplete="off"/>
               </div>
            </div>
            <div class="col-lg-4">
               <div class=" mb-3">
                  <label class="form-label">Rate
                  </label>
                  <input type="text" class="form-control" name=""
                     placeholder="Enter Rate" autocomplete="off"/>
               </div>
            </div>
            <div class="col-lg-2" style="padding-right: 0;">
               <div class="mb-4">
                  <label for="compnayNameinput" class="form-label">Units</label>
                  <select class="form-select"  style="border-top-right-radius: 0;border-bottom-right-radius: 0;" name="" required/>
                     <option value="">Select Units </option>
                     <option name ="" value="">Kg</option>
                     <option name ="" value="">Liter</option>
                     <option name ="" value="">Pcs</option>
                  </select>
               </div>
            </div>
            <div class="col-lg-2" style="padding-left: 0;">
               <div class="mb-4">
                  <label for="compnayNameinput" class="form-label">&nbsp;</label>
                  <input type="text" class="form-control" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="" id="" placeholder="Pcs in" autocomplete="off" required/>
                  <small><span id="getMiscellaneousCost" style="margin-left: 15px;"></span></small>
               </div>

            </div>
                           <hr>
               <div class="col-lg-12">
                  <div class="text-center">
                     <input type="submit" name="item_submit" class="btn btn-primary" value="Submit">
                  </div>
               </div>
      </form>
      <!--end col-->
      </div>
      <!--end row-->
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