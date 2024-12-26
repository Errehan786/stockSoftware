<?php include_once('config.php'); 
include_once('include/auth.php'); 
if(isset($_REQUEST['accountId'])){
    $sql1 = "SELECT * FROM `account` WHERE id = {$_REQUEST['accountId']}";
    $result = $conn->query($sql1);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
 }
 //Update Table
if(isset($_REQUEST['item_submit'])){
      $item_name = $_REQUEST['item_name'];
      $accountGroup = $_REQUEST['accountGroup'];
      $item_description = $_REQUEST['item_description'];
      $location = $_REQUEST['location'];
      $opeaning = $_REQUEST['opeaning'];
      $sql = "UPDATE account SET opeaning='$opeaning', accountName='$item_name', remarks='$item_description', accountGroup='$accountGroup', creditPeriod='$location' WHERE id='$_REQUEST[accountId]'";
        if($conn->query($sql)){
            echo "<script>alert('Data has been Updated Successfully');window.location = 'createAccount.php'; </script>";
        }else{
            echo "<script>alert('failed');window.location = 'createAccount.php'; </script>";
    }
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Account Details edit | <?php echo $_SESSION['userName']?> </title>
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
                                <h4 class="mb-sm-0">Account Details Edit</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Account Details Edit
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="addNewItem">
                        <div class="col-xxl-12">
                            <div class="card">
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                 <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Account Name
                                                        </label>
                                                        <input type="text" class="form-control" name="item_name" value="<?php echo $row['accountName']; ?>" placeholder="Enter Account Name" autocomplete="off" required/>
                                                    </div>
                                                </div>
                                                   <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Account Group</label>
                                                        <select id="" name="accountGroup" class="form-select" required="">
                                                          <option value="">Select Account Group </option>
                                                          <option value="Bank Accounts" <?php if($row['accountGroup'] == "Bank Accounts") echo "selected";?>>Bank Accounts</option>
                                                          <option value="Capital Accounts" <?php if($row['accountGroup'] == "Capital Accounts") echo "selected";?>>Capital Accounts</option>
                                                          <option value="Cash Accounts" <?php if($row['accountGroup'] == "Cash Accounts") echo "selected";?>>Cash Accounts</option>
                                                          <option value="Interest Accounts" <?php if($row['accountGroup'] == "Interest Accounts") echo "selected";?>>Interest Accounts</option>
                                                          <option value="Misc. Expenditure" <?php if($row['accountGroup'] == "Misc. Expenditure") echo "selected";?>>Misc. Expenditure</option>
                                                          <option value="Purchase Accounts" <?php if($row['accountGroup'] == "Purchase Accounts") echo "selected";?>>Purchase Accounts</option>
                                                          <option value="Purchase Return Accounts" <?php if($row['accountGroup'] == "Purchase Return Accounts") echo "selected";?>>Purchase Return Accounts</option>
                                                          <option value="Sales Accounts" <?php if($row['accountGroup'] == "Sales Accounts") echo "selected";?>>Sales Accounts</option>
                                                          <option value="Sales Return Accounts" <?php if($row['accountGroup'] == "Sales Return Accounts") echo "selected";?>>Sales Return Accounts</option>
                                                          <option value="sundry debitors" <?php if($row['accountGroup'] == "sundry debitors") echo "selected";?>>Sundry debitors</option>
                                                          <option value="sundry creditors" <?php if($row['accountGroup'] == "sundry creditors") echo "selected";?>>Sundry creditors</option>
                                                          <option value="unsecured loans" <?php if($row['accountGroup'] == "unsecured loans") echo "selected";?>>unsecured loans</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class=" mb-3">
                                                        <label class="form-label">Remarks
                                                        </label>
                                                        <input type="text" class="form-control" value="<?php echo $row['remarks']; ?>" name="item_description"
                                                            placeholder="Enter Remarks" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Credit Period (No of Days)</label>
                                                        <input type="number" class="form-control" name="location" value="<?php echo $row['creditPeriod']; ?>" placeholder="Enter Credit Period" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Opeaning</label>
                                                        <input type="number" class="form-control" name="opeaning" value="<?php echo $row['opeaning']; ?>" placeholder="Enter Opeaning" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <input type="submit" name="item_submit" class="btn btn-primary" value="Update">
                                                        <a href="createAccount.php" class="btn btn-info">Back</a>
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