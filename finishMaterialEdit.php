<?php include_once('config.php'); 
include_once('include/auth.php'); 
if(isset($_REQUEST['edit_category_item'])){
    $sql1 = "SELECT * FROM `items` WHERE id = {$_REQUEST['edit_category_item']}";
    $result = $conn->query($sql1);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
 }
 //Update Table
if(isset($_REQUEST['item_submit'])){
    $c_id = $_REQUEST['edit_category_item'];
    $item_code=$_REQUEST['item_code'];
    $item_name=$_REQUEST['item_name'];
    $item_description=$_REQUEST['item_description'];
    $vender_name=$_REQUEST['vender_name'];
    $category=$_REQUEST['category'];
    $measurement_unit=$_REQUEST['measurement_unit'];
    $weight_unit=$_REQUEST['weight_unit'];
    $location=$_REQUEST['location'];
    $sql = "UPDATE items SET item_code='$item_code', item_name='$item_name', vender_name='$vender_name', category='$category', item_desc='$item_description', measurement_unit='$measurement_unit', weight_unit='$weight_unit', location_name='$location' WHERE id='$c_id'";
        if($conn->query($sql)){
            $msg = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfully</h6>
        </div>';
        ?>
        <script>
        setTimeout(
            function(){
                window.location = "categoryItemsPurchaseList.php"; 
            },
        2000);
    </script>
    <?php
        }else{
            $msg = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has Not Updated</h6>
        </div>';
    }
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Finished Goods Edit | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">Finished Goods</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                          Finished Goods
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="addNewItem">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit Finished Goods</h4>
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
                  <label class="form-label">Product Group</label>
                  <select id="" name="" class="form-select"  required>
                     <option value="">Select Product Group </option>
                     <option name ="" value="">Product Group1</option>
                     <option name ="" value="">Product Group2</option>
                     <option name ="" value="">Product Group3</option>
                  </select>
               </div>
            </div>
                      <div class="col-lg-3">
               <div class="mb-3">
                  <label class="form-label">Description
                  </label>
                  <input type="text" class="form-control" name="" placeholder="Enter Description"  required/>
               </div>
            </div>
                      <div class="col-lg-3">
               <div class="mb-3">
                  <label class="form-label">Opening Stock
                  </label>
                  <input type="text" class="form-control" name="" placeholder="Op. stock"  required/>
               </div>
            </div>
                      <div class="col-lg-3">
               <div class="mb-3">
                  <label class="form-label">Stock Limit
                  </label>
                  <input type="text" class="form-control" name="" placeholder="stock Limit"  required/>
               </div>
            </div>
                      <div class="col-lg-3" style="padding-right: 0;">
               <div class="mb-4">
                  <label for="compnayNameinput" class="form-label">Units</label>
                  <select class="form-select"  name="" required/>
                     <option value="">Select Units </option>
                     <option name ="" value="">Kg</option>
                     <option name ="" value="">Liter</option>
                     <option name ="" value="">Pcs</option>
                  </select>
               </div>
            </div>
                      <div class="col-lg-3">
               <div class=" mb-3">
                  <label class="form-label">Cost Price/Unit</label>
                  <input type="text" class="form-control" name="" placeholder="Enter Cost Price" />
               </div>
            </div>
                      <div class="col-lg-3">
               <div class=" mb-3">
                  <label class="form-label">Rate</label>
                  <input type="text" class="form-control" name="" placeholder="Enter Rate" />
               </div>
            </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <input type="submit" name="item_submit" class="btn btn-primary" value="Update">
                                                        <a href="rawmaterialList.php" class="btn btn-info">Back</a>
                                                    </div>
                                                </div>

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