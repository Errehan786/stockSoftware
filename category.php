<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['submitData'])){
    $Category_Name = $_REQUEST['Category_Name'];
    $Category_Description = $_REQUEST['Category_Description'];
    $Measuring_Units = $_REQUEST['Measuring_Units'];
    //$Each_Unit = $_REQUEST['Each_Unit'];
    $sql = "INSERT INTO `category` (user_reg_id,Category_Name, Description_No, Measuring_Units,percentage) VALUES('$_SESSION[id]','$Category_Name', '$Category_Description', '$Measuring_Units', '$_POST[percentage]')";
    if($conn->exec($sql)){
     $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been saved successfully</h6>
      </div>';
      @$conn->NULL;
       //echo '<script>alert ("Data has been save successfully")<//script>';
       //echo '<script>location.href="category.php"<//script>';
    }else{
        echo '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been not saved</h6></div>';
    }
  }
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Category | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">CATEGORY DETAILS</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Category</li>
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
                                                <div class="d-flex justify-content-end align-items-center h-100">
                                                    <a href="#addNewCategory"> <button
                                                        class="btn btn-sm btn-success edit-item-btn"> Add New Category</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        if(isset($msg1)){
                                            echo $msg1;
                                        }else{
                                            echo '<div class="mx-3 mt-3"><h6>&nbsp;</h6></div>';
                                        }
                                        ?>
                                        <?php
                                        $sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
                                        $result = $conn->query($sql);
                                        if($result->rowCount()>0){
                                        ?>
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            
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
                    
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Description</th>
                                                        <th>Measuring Unit</th>
                                                        <th>In Percentage(%)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                                    <tr id="messageTxtHide<?php echo $row['id']?>">
                                                    <?php
                                                        // echo "<td>" . $row['id'] . "</td>";
                                                        echo "<td>" . $row['Category_Name'] . "</td>";
                                                        echo "<td>" . $row['Description_No'] . "</td>";
                                                        echo "<td>" . $row['Measuring_Units'] . "</td>";
                                                        echo "<td>" . $row['percentage'] . "</td>";
                                                        echo '<td>
                                                        <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="categoryedit.php?category_edit='.$row['id'] .'" class="btn btn-sm btn-success edit-item-btn"
                                                            >Edit</a>
                                                        </div>
                                                        <div class="remove">
                                                            <input type="button" class="btn btn-sm btn-danger remove-item-btn" onClick="return dataCdelete'.$row['id'].'('.$row['id'].')" value="Delete">
                                                        </div>
                                                        </td>';
                                                        ?>
                                            <script>
                                             function dataCdelete<?php echo $row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
                                                        var myData = "rid="+rowID+"&action=deleteCategoryRow";
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
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php }?>
                                        </div>
                                            <!--start back-to-top-->
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

                    <div class="row" id="addNewCategory">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Category</h4>
                                </div>
                                <div class="mx-3 mt-3">
                                <!-- <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been save Successfull</h6> -->
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
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Category Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Category_Name" placeholder="Enter Category Name" autocomplete="off" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Measuring Units</label>
                                                        <select id="ForminputState" name="Measuring_Units" class="form-select" data-choices
                                                            data-choices-sorting="true" required>
                                                            <option value="">---Measuring Units--</option>
                                                            <option value="Pcs">Pcs</option>
                                                            <option value="Litres">Litres</option>
                                                            <option value="Grams">Grams</option>
                                                            <option value="cm">cm</option>
                                                            <option value="metres">metres</option>
                                                            <option value="kg">kg</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Percentage(%)</label>
                                                        <select id="ForminputState" name="percentage" class="form-select" data-choices
                                                            data-choices-sorting="true" required>
                                                            <option value="">--(%)--</option>
                                                            <option>No</option>
                                                            <option>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Description No.</label>
                                                        <input type="text" class="form-control" name="Category_Description" placeholder="Enter Description" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                
                                                <div id="weightEachUnit" style="display: contents;"></div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="submitData" class="btn btn-primary">Submit</button>
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
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © .
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by RSS Infotech Pvt Ltd.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>



</html>