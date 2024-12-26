<?php
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['main_submit'])){
    $customer_name = $_REQUEST['customer_name'];
    $delivery_date = $_REQUEST['delivery_date'];
    $orderID = $_REQUEST['orderID'];
    $status = $_REQUEST['status'];
    $delivery_status = $_REQUEST['delivery_status'];
    $sql = "INSERT INTO `delivery_sheet`(`user_reg_id`,`customer_name`, `select_date`, `Order_ID`, `status`, `delivery_status`) VALUES ('$_SESSION[id]','$customer_name','$delivery_date','$orderID', '$status', '$delivery_status')";
    if($conn->exec($sql)){
     $deliveryId = $conn->lastInsertId();
     for($i=0;$i<sizeof($_REQUEST['product_name']);$i++){
         $productName = $_REQUEST['product_name'][$i];
         $productQTY = $_REQUEST['deliveryQTY'][$i];
         $sql1 = "INSERT INTO `sub_delivery_sheet`(user_reg_id,delivery_sheet_id, product_name, qty) VALUES ('$_SESSION[id]','$deliveryId','$productName','$productQTY')";
        //  echo $sql;
        //  die();
         $result1 = $conn->exec($sql1);
         }
         $msg = '<div class="mx-3 mt-3">
         <h6 class="alert alert-success"><i class="fa fa-solid fa-spin me-2"></i>Data has been Save Successfull</h6>
         </div>';
         echo '<script>alert ("Data has been save successfull");</script>';
         echo '<script>window.location = "deliverSheetForm.php"</script>'; 
         ?>
         <script>
         // setTimeout(
         // function(){
         //     window.location = "productformulation.php"; 
         // },
         // 3000);
         </script>
         <?php
       }else{
         echo '<script>alert("Data Not Inserted");</script>';
       }
 }

?>

<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Delivery Sheet Form | <?php echo $_SESSION['userName']?> </title>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>	
        <script>
        $(document).ready(function() {
      //alert('ok');
        var max_fields1      = 50;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        
        var x = 1; 
        $(add_button1).click(function(e){ 
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex gap-2 mb-2"><tr> <td> <input type="text" class="form-control" name="product_name[]" placeholder="Product Name"/> </td> <td> <input type="text" name="deliveryQTY[]" class="form-control" placeholder="Enter Qty" /> </td> <td></tr><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete" style="height:30px;">Remove</a></div>'); 
           //alert('Fields added');
            }
        else
        {
        alert('You Reached the limits')
        }
        });
        
        $(wrapper1).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
        alert('Fields removed');
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
                                <h4 class="mb-sm-0">DELIVERY SHEET FORM</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Delivery Sheet Form
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Entry</h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Customer Name</label>
                                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name" required/>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="StartleaveDate" class="form-label">Select Date</label>
                                                        <input type="date" class="form-control" name="delivery_date" placeholder="Select Date" data-provider="flatpickr" id="StartleaveDate" required/>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-5">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Order ID</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Order ID" name="orderID" id="compnayNameinput" required/>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Status</label>
                                                        <input type="text" name="status" class="form-control"placeholder="Enter Status" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Delivery Status</label>
                                                        <input type="text" class="form-control" name="delivery_status" placeholder="Enter Delivery Status" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block"></div>

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
                                                                                        <th>Product name</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="list form-check-all">
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" class="form-control" name="product_name[]" placeholder="Product Name" required/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control" name="deliveryQTY[]" placeholder="Enter Qty" required/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <button class="btn btn-sm btn-success edit-item-btn add_form_field1">Add New</button>
                                                                                        </br>
                                                                                    </br>
                                                                                    </td>
                                                                                        
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <fieldset id="account" class="containerForm1" style="    margin-right: 94px; margin-left: 16px;"></fieldset>
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