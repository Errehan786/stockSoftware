<?php
include_once('config.php'); 
include_once('include/auth.php');
    $sql = "SELECT * FROM `expense` WHERE id={$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC); 

    if(isset($_REQUEST['exp_update'])){
        $name = $_REQUEST['name'];
        $category = $_REQUEST['category'];
        $cost = $_REQUEST['cost'];
        $sql = "UPDATE expense SET name='$name',category='$category',cost='$cost' WHERE id={$_REQUEST['id']}";
            if($conn->query($sql)){
                $msg = ' <div class="mx-3 mt-3">
                <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfull</h6>
                </div>';
                ?>
                <script>
                setTimeout(
                    function(){
                        window.location = "Expense.php"; 
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
                        window.location = "Expense.php"; 
                    },
                3000);
                </script>
                <?php
             }
    }
       
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Expense & Tax List | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">EXPENSES & TAX CATEGORY LIST</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Expense & TAX Category List
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row" id="addNewItem">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Expense / TAX Category</h4>
                                </div>
                                <!-- end card header -->
                                <?php
                                if(isset($msg)){
                                    echo $msg;
                                }
                                ?>
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label" >Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Expense / Tax Name" value="<?php if(isset($row['name'])){echo $row['name'];}?>" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select id="ForminputState" name="category" class="form-select" value="<?php if(isset($row['category'])){echo $row['category'];}?>" data-choices
                                                            data-choices-sorting="true" required>
                                                            <option value="Expense" <?php if($row['category']=="Expense") echo 'selected'?> >Expense</option>
                                                            <option value="TAX" <?php if($row['category']=="TAX") echo 'selected'?> >TAX</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class=" mb-3">
                                                        <label class="form-label">Cost
                                                        </label>
                                                        <input type="text" class="form-control" name="cost" value='<?php if(isset($row['cost'])){echo $row['cost'];} ?>'
                                                            placeholder="Enter Description" required/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <input type="submit" name="exp_update" class="btn btn-primary" class="btn btn-primary" value="Update">
                                                        <a href="Expense.php" class="btn btn-info">Back</a>
                                                    </div>
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