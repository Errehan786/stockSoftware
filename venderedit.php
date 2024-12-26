<?php
//edit Table
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['id'])){
   $sql = "SELECT * FROM `vendor` WHERE id = {$_REQUEST['id']} and user_reg_id='$_SESSION[id]'";
   $result = $conn->query($sql);
   $row = $result->fetch(PDO::FETCH_ASSOC);
}

//Update Table
if(isset($_REQUEST['update'])){
    $vname = $_REQUEST['n_name'];
    $v_email = $_REQUEST['v_email'];
    $v_number = $_REQUEST['v_number'];
    $v_address = $_REQUEST['v_address'];
    $id = $_REQUEST['id'];
        $sql = "UPDATE vendor SET name='$vname', email='$v_email', mobile_no='$v_number', address='$v_address' WHERE id='$id'";
        if($conn->query($sql)){
            $msg = ' <div class="mx-3 mt-3">
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfull</h6>
            </div>';
            ?>
            <script>
            setTimeout(
                function(){
                    window.location = "vendor.php"; 
                },
            1000);
            </script>
            <?php
         }else{
            $msg ='<div class="mx-3 mt-3">
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has Not Updated</h6>
            </div>';
            ?>
            <script>
            setTimeout(
                function(){
                    window.location = "vendor.php"; 
                },
            5000);
            </script>
            <?php
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
                                        <li class="breadcrumb-item active">
                                            Category
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
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
                                <!-- end card header -->
                                <?php if(isset($msg)){echo $msg;}?>
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="n_name" placeholder="Enter Name" value="<?php if(isset($row['name'])){echo $row['name'];}?>" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Email</label>
                                                        <input type="email" class="form-control"
                                                            name="v_email" placeholder="Enter Description" value="<?php if(isset($row['email'])){echo $row['email'];}?>" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Mobile No</label>
                                                        <input type="text" name="v_number" class="form-control" class="form-control" value="<?php if(isset($row['mobile_no'])){echo $row['mobile_no'];}?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label" required>Address</label>
                                                        <input type="text" class="form-control" name="v_address" value="<?php if(isset($row['address'])){echo $row['address'];}?>"
                                                            placeholder="Enter Weight Of Each Unit" />
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                        <a href="vendor.php" class="btn btn-info">Back</a>
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