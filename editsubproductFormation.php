<?php
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['subproductnewid'])){
    $sql7 = "SELECT * FROM `product_sub_item` WHERE id = {$_REQUEST['subproductnewid']}";
    $result7 = $conn->query($sql7);
    $row7 = $result7->fetch(PDO::FETCH_ASSOC);   
 }

if(isset($_REQUEST['subFormulaUpdate'])){
            $category = $_REQUEST['category'];
            $formula_Qty = $_REQUEST['formulaQty'];
            $Item = $_REQUEST['Item'];
            $sql1 = "UPDATE `product_sub_item` SET `product_category`='$category',`product_item`='$Item',`product_qty`='$formula_Qty' WHERE id={$_REQUEST['subproductnewid']}";
            if($conn->query($sql1)){
            $msg = '<div class="mx-3 mt-3">
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfull</h6>
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
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data Not Updated</h6>
            </div>';
      }
}

if(isset($_REQUEST['deletes'])){
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
   $msg1 = '<div class="mx-3 mt-3">
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
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
    <meta charset="utf-8" />
    <title>Product Formulation Entry Form & List | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">PRODUCT FORMULATION COMPONENT LIST & ENTRY FORM</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Product Formulation</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row" id="newFormula">
                        <div class="col-xxl-12">
                            <div class="card">
                                <?php
                                if(isset($msg)){
                                    echo $msg;
                                }
                                ?>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">  
                                                <div class="col-12">
                                                    <div class="table-responsive table-card mt-3 mb-1">
                                                        <table class="table align-middle table-nowrap" id="customerTable">
                                                            <thead class="table-light">
                                                            </thead>
                                                            <tbody class="list form-check-all">
                                                                <tr>
                                                                    <td>
                                                                        <div class="mb-3" id="container_Type">
                                                                        <?php
                                                                            $categoryName =  $row7['product_category'];
                                                                            $itemId = $row7['id'];
                                                                            $sql4 = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
                                                                            $result4 = $conn->query($sql4);
                                                                            ?>
                                                                            <select id="ForminputState" name="category" class="form-select">
                                                                                <?php
                                                                                while($row2 = $result4->fetch(PDO::FETCH_ASSOC)){
                                                                                ?>
                                                                                <option value="<?php echo $row2['id'] ?>"<?php if($row2['id']==$row7['product_category'])echo "selected"?>><?php if(isset($row2['Category_Name'])){echo $row2['Category_Name'];}?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3" id="item_name">
                                                                            <?php
                                                                            $itemName =  $row7['product_item'];
                                                                            $itemId = $row7['id'];
                                                                            $sql3 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
                                                                            $result3 = $conn->query($sql3);
                                                                            ?>
                                                                            <select id="ForminputState" name="Item" class="form-select">
                                                                                <?php
                                                                                while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
                                                                                ?>
                                                                                <option value="<?php echo $row1['id']?>"<?php if($row1['id']==$row7['product_item'])echo "selected" ?>><?php if(isset($row1['item_name'])){echo $row1['item_name'];}?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="mb-3" id="formula_qty">     
                                                                            <input type="text" class="form-control" name="formulaQty" value="<?php if(isset($row7['product_qty'])){echo $row7['product_qty'];}?>" placeholder="Enter Qty" id="compnayNameinput" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <fieldset id="account" class="containerForm1"></fieldset>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="subFormulaUpdate" class="btn btn-primary">Update</button>
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