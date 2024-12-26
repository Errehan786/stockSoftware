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
    <title>Category Items Purchase List | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">CATEGORY ITEMS PURCHASE LIST</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Category items Purchase List
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
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Item</h4>
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
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Item Code</label>
                                                        <input type="text" class="form-control" name="item_code" value="<?php if(isset($row['item_code'])){echo $row['item_code'];}?>"
                                                            placeholder="Enter Item Code" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name of Item</label>
                                                        <input type="text" class="form-control" name="item_name" value="<?php if(isset($row['item_name'])){echo $row['item_name'];}?>" placeholder="Enter Item Name"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class=" mb-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" class="form-control" name="item_description" value="<?php if(isset($row['item_desc'])){echo $row['item_desc'];}?>"
                                                            placeholder="Enter Description" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Vendor Name</label>
                                                        <?php
                                                         $vendorId =  $row['vender_name'];
                                                         $itemId = $row['id'];
                                                         $sql3 = "SELECT * FROM `vendor` where user_reg_id='$_SESSION[id]'";
                                                         $result3 = $conn->query($sql3);
                                                        ?>
                                                        <select id="ForminputState" name="vender_name" class="form-select">
                                                            <?php
                                                            while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <option value="<?php echo $row1['id'] ?>" <?php if($row1['id']==$row['vender_name']) echo "selected"?>><?php if(isset($row1['name'])){echo $row1['name'];}?></option>
                                                            <?php
                                                        }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <?php
                                                         $categoryId =  $row['category'];
                                                         $itemId = $row['id'];
                                                         $sql4 = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
                                                         $result4 = $conn->query($sql4);
                                                        ?>
                                                        <select id="ForminputState" name="category" value="<?php if(isset($row['category'])){echo $row['category'];}?>" class="form-select" data-choices
                                                            data-choices-sorting="true">
                                                            <?php
                                                            while($row3 = $result4->fetch(PDO::FETCH_ASSOC)){
                                                                if($row3['percentage']=="Yes")$pr="(In %)";else $pr='';     
                                                            ?>
                                                            <option value="<?php echo $row3['id'] ?>" <?php if($row3['id']==$row['category'])echo "selected"?>><?php if(isset($row3['Category_Name']))echo $row3['Category_Name']." - ".$row3['Measuring_Units'].$pr;?></option>
                                                            <?php
                                                        }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Measurement Unit</label>
                                                        <select id="ForminputState" name="measurement_unit" class="form-select" onChange="checkUnit(this.value)" value="<?php if(isset($row['measurement_unit'])){echo $row['measurement_unit'];}?>" data-choices
                                                            data-choices-sorting="true" required>
                                                            <option selected>Select Unit
                                                            </option>
                                                            <option value="Pcs" <?php if($row['measurement_unit']=="Pcs") echo 'selected'?> >Pcs</option>
                                                            <option value="Liters" <?php if($row['measurement_unit']=="Litres") echo 'selected'?> >Litres</option>
                                                            <option value="Grams" <?php if($row['measurement_unit']=="Grams") echo 'selected'?> >Grams</option>
                                                            <option value="cm" <?php if($row['measurement_unit'] == "cm") echo 'selected'?> >cm</option>
                                                            <option value="metres" <?php if($row['measurement_unit'] == "meters") echo 'selected'?> >metres</option>
                                                            <option value="kg" <?php if($row['measurement_unit'] == "kg") echo 'selected'?> >kg</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <script>
                                                        function checkUnit(unitVal){
                                                            if(unitVal=="Grams" || unitVal=="kg"){
                                                                document.getElementById('weightEachUnit').style.display = "none";
                                                                document.getElementById('weightEachUnit').innerHTML = '<div class="col-lg-4" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit(In Gram)</label><input type="text" class="form-control" name="weight_unit" placeholder="Enter Weight Of Each Unit In Gram" autocomplete="off"/></div></div>';
                                                                }else{
                                                                  document.getElementById('weightEachUnit').style.display = "contents"; 
                                                                  document.getElementById('weightEachUnit').innerHTML = '<div class="col-lg-4" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit(In Gram)</label><input type="text" class="form-control" name="weight_unit" value="<?php if(isset($row['weight_unit'])){echo $row['weight_unit'];}?>" placeholder="Enter Weight Of Each Unit In Gram" required autocomplete="off"/></div></div>';
                                                                }
                                                        }
                                                </script>
                                                    
                                                <div class="col-lg-4" id="weightEachUnit" style="display:<?php if($row['measurement_unit']=="Grams")echo 'none' ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">Weight Of Each unit(In Gram)</label>
                                                        <input type="text" class="form-control" name="weight_unit" value="<?php if(isset($row['weight_unit']) && !empty($row['weight_unit'])){echo $row['weight_unit'];}?>" placeholder="Enter Weight / Unit In Gram" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Location Name</label>
                                                        <input type="text" class="form-control" name="location" value="<?php if(isset($row['location_name'])){echo $row['location_name'];}?>" placeholder="Enter Item Name" />
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <input type="submit" name="item_submit" class="btn btn-primary" value="Update">
                                                        <a href="categoryItemsPurchaseList.php" class="btn btn-info">Back</a>
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