<?php
include_once('config.php'); 
include_once('include/auth.php');
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Order Sheet List | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">ORDER SHEET LIST</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Order Sheet List</li>
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
                                                                <i class="ri-search-line search-icon"></i>
                                                            </div>
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
                                                <a href="./orderSheetForm.php"> <button class="btn btn-sm btn-success edit-item-btn"> Add New Order</button>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="messageTxt" style="position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;"></div>
                                        <?php
                                        $sql = "SELECT * FROM `order_sheet` where user_reg_id='$_SESSION[id]'";
                                        $result = $conn->query($sql);
                                        if($result->rowCount()>0){
                                        ?>
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Date</th>
                                                        <th>Customer Name</th>
                                                        <th>Date of Delivery</th>
                                                        <th>Status</th>
                                                        <th>Delivery Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                                    //sel customer name
                                                     $sl_customer_name_Q = $conn->query("select name from `customer` where reg_id='$row[customer_name]'");
                                                     $customerName = $sl_customer_name_Q->fetch(PDO::FETCH_ASSOC);
                                                     //get order exists in product manufacture or not
                                                     $result_product_manufacture = $conn->query("SELECT id,customer_name,batch_code FROM `product_batch` where user_reg_id='$_SESSION[id]' and order_id='$row[order_ID]' and customer_name='$row[customer_name]' and purpose='Pre order from customer'");
                                                    if($result_product_manufacture->rowCount()>0){
                                                      $manufactureData = $result_product_manufacture->fetch(PDO::FETCH_ASSOC);
                                                        $Pagelink = "<br><small><a href='editmanufactureBatch.php?id=$manufactureData[id]'><font color='green'><u>Manufacture Batch Code: ".$manufactureData['batch_code']."</u></font></a></small>";
                                                     }else $Pagelink = "<br><small><a href='productmanufacturebatch.php?orderid=$row[order_ID]&custid=$row[customer_name]'><font color='red'><u>For Product Manufacturing</u></font></a></small>";
                                                    ?>
                                                    <tr id="messageTxtHide<?php echo $row['id']?>">
                                                        <?php
                                                        echo '<td>' .$row['order_ID']. '</td>';
                                                        echo '<td>' .$row['date']. '</td>';
                                                        echo '<td>' .$customerName['name']."<br>".$Pagelink. '</td>';
                                                        echo '<td>' .$row['delivery_date']. '</td>';
                                                        echo '<td>' .$row['status']. '</td>';
                                                        echo '<td>' .$row['delivery_status']. '</td>';
                                                        echo '<td>
                                                        <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="editOrderSheet.php?productnewid='.$row['id'].'" name="productnewid" class="btn btn-sm btn-success remove-item-btn">edit</a>
                                                        </div>
                                                        <div class="remove">
                                                            <input type="button" class="btn btn-sm btn-danger remove-item-btn" onClick="return dataOrderSheetdelete'.$row['id'].'('.$row['id'].')" value="Delete">
                                                        </div>
                                                        </td>';
                                                        ?>
                                            <script>
                                             function dataOrderSheetdelete<?php echo $row['id'] ?>(rowID){
                                              var r = confirm('Are you want to delete?');
                                              if(!r){
                                                  return false;
                                              }else{
                                                        var myData = "rid="+rowID+"&action=deleteOrderSheetRow";
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php } ?>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We
                                                        did not find any orders for you search.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#">

                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#">

                                                </a>
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