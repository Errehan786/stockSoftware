<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if (isset($_REQUEST['submit'])) {
    $id = $_REQUEST['id']; // Assuming `id` is passed from the form for the record to update
    $name = $_REQUEST['name'];
    $category = $_REQUEST['category'];
    $cost = $_REQUEST['cost'];
    $date = date('Y-m-d');
    
    // Update query
    $updateSql = "UPDATE `expance` 
                  SET `name` = '$name', 
                      `category` = '$category', 
                      `cost` = '$cost', 
                      `currentDate` = '$date' 
                  WHERE `id` = '$_REQUEST[expanceId]'";
    
    // Execute the query
    if ($conn->query($updateSql)) {
        echo '<script>alert("Expense has been updated successfully!");window.location = "expense.php";</script>';
    } else {
        echo '<script>alert("Update failed!");window.location = "expense.php";</script>';
    }
}


// Query to fetch expense records
$expanceSql = "SELECT * FROM `expance` where id='$_REQUEST[expanceId]'";
$expanceResult = $conn->query($expanceSql);
$row = $expanceResult->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Expense & Tax List </title>
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
<!-- ========== Header Start ========== -->
    <?php include_once('include/header.php'); ?>

    <!-- ========== Header End ========== -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once('include/left-side-menu.php'); ?>
    <!-- ========== Left Sidebar End ========== -->
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
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
                                <h4 class="mb-sm-0">EDIT EXPENSES & TAX CATEGORY</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Edit Expense
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- end row -->
                    <div class="row" id="addNewItem">
                        <div class="col-xxl-12">
                            <div class="card">
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Expense Name" value="<?php if(isset($row['name'])) echo $row['name'];?>" autocomplete="off" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select id="ForminputState" class="form-select" name="category" data-choices data-choices-sorting="true" required>
                                                            <option value="">Select Category</option>
                                                            <option value="Labour" <?php echo (isset($row['category']) && $row['category'] == "Labour") ? "selected" : ""; ?>>Labour</option>
                                                            <option value="packing" <?php echo (isset($row['category']) && $row['category'] == "packing") ? "selected" : ""; ?>>Packing</option>
                                                            <option value="maintenance" <?php echo (isset($row['category']) && $row['category'] == "maintenance") ? "selected" : ""; ?>>Maintenance</option>
                                                            <option value="bill" <?php echo (isset($row['category']) && $row['category'] == "bill") ? "selected" : ""; ?>>Bill</option>
                                                            <option value="rent" <?php echo (isset($row['category']) && $row['category'] == "rent") ? "selected" : ""; ?>>Rent</option>
                                                            <option value="other expance" <?php echo (isset($row['category']) && $row['category'] == "other expance") ? "selected" : ""; ?>>Other Expance</option>
                                                            <option value="isi expance" <?php echo (isset($row['category']) && $row['category'] == "isi expance") ? "selected" : ""; ?>>ISI Expance</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class=" mb-3">
                                                        <label class="form-label">Cost
                                                        </label>
                                                        <input type="number" class="form-control" name="cost"
                                                            placeholder="Enter Cost" autocomplete="off" value="<?php if(isset($row['cost'])) echo $row['cost'];?>"/>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="submit" class="btn btn-primary">
                                                            update
                                                        </button>
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
            <!-- Footer start -->
    <?php include_once('include/footer.php'); ?>