<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['submit'])){
    $name = $_REQUEST['name'];
    $category = $_REQUEST['category'];
    $cost = $_REQUEST['cost'];
    $date = date('Y-m-d');
    $Insertsql = "INSERT INTO `expance`(`name`, `category`, `cost`, `currentDate`) VALUES('$name','$category','$cost','$date')";
    // echo $Insertsql;
    // die();
    if($conn->exec($Insertsql)){
    echo '<script>alert("Expance has been saved successfully!");window.location = "expense.php";</script>';
    }else{
      echo '<script>alert("Failed!");window.location = "expense.php";</script>';
   }
 }
 
if (isset($_REQUEST['searchSubmit'])) {
    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];
    $category = $_REQUEST['category'];
    if($category){
        // Construct the WHERE clause
    $q = "WHERE category='$category'";
    }elseif($fromDate){
        // Construct the WHERE clause
    $q = "WHERE `currentDate` BETWEEN '$fromDate' AND '$toDate'";
    }else{
        $q = "WHERE `currentDate` BETWEEN '$fromDate' AND '$toDate' and category='$category'";
    }
    
} else {
    $q = ""; // No filter applied
}

// Query to fetch expense records
$expanceSql = "SELECT * FROM `expance` $q";
$expanceResult = $conn->query($expanceSql);

// Calculate total cost
$totalCost = 0;
$expenses = [];
while ($row = $expanceResult->fetch(PDO::FETCH_ASSOC)) {
    $totalCost += $row['cost']; // Summing up the costs
    $expenses[] = $row; // Store rows for display
}
 
 ///delete expance
 if(isset($_REQUEST['expanceId'])){
     $expanceId = $_REQUEST['expanceId'];
     $getExpance = "SELECT * FROM `expance` WHERE id='$expanceId'";
     $getExpanceResult = $conn->query($getExpance);
     $row1 = $getExpanceResult->fetch(PDO::FETCH_ASSOC);
     $cost = $row1['cost'];
     if($cost>0){
         echo '<script>alert("Expance Grater than Current Amount!");window.location = "expense.php";</script>';
     }else{
    $delSql = "DELETE FROM `expance` WHERE id='$expanceId'";
    if ($delResult = $conn->exec($delSql)) {
        echo '<script>alert("Expance has been Deleted successfully!");window.location = "expense.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "expense.php";</script>';
  }
     }
 }
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
                                <h4 class="mb-sm-0">EXPENSES & TAX CATEGORY LIST</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Expense List
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
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category
                                                        </label>
                                                        <select id="ForminputState" class="form-select" name="category" data-choices
                                                            data-choices-sorting="true">
                                                            <option value="">Select Category</option>
                                                            <option value="Labour">Labour</option>
                                                            <option value="packing">Packing</option>
                                                            <option value="maintenance">Maintenance</option>
                                                            <option value="bill">Bill</option>
                                                            <option value="rent">Rent</option>
                                                            <option value="other expance">Other Expance</option>
                                                            <option value="isi expance">ISI Expance</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        <div class="col-sm-3">
                                        <label>From</label>
                                        <input type="date" name="fromDate" class="form-control">
                                        </div>
                                        <div class="col-sm-3">
                                        <label>To</label>
                                        <input type="date" name="toDate" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                        <label>.</label>
                                        <input type="submit" name="searchSubmit" class="form-control">
                                        </div>
                                        </div>
                                    </form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>SrNo</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th class="text-start">Cost</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a = 1;
                                            foreach ($expenses as $expanceRow) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $a++; ?></td>
                                                    <td><?php echo $expanceRow['name']; ?></td>
                                                    <td><?php echo $expanceRow['category']; ?></td>
                                                    <td class="text-start"><?php echo $expanceRow['cost']; ?></td>
                                                    <td><?php echo $expanceRow['currentDate']; ?></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="delete">
                                                                <a href="editExpance.php?expanceId=<?php echo $expanceRow['id']; ?>" onclick="return confirm('Are you sure you want to Edit this item?')" class="btn btn-sm btn-info mx-2">Edit</a>
                                                            </div>
                                                            <div class="remove">
                                                                <a href="?expanceId=<?php echo $expanceRow['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Display Total Cost -->
                                    <div class="total-cost mt-3" style="text-align:center; margin-right: 154px;">
                                        <strong>Total Cost: </strong> ₹<?php echo number_format($totalCost, 2); ?>
                                    </div>
                                    
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row" id="addNewItem">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Expense</h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label" >Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Expense Name" autocomplete="off" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category
                                                        </label>
                                                        <select id="ForminputState" class="form-select" name="category" data-choices
                                                            data-choices-sorting="true" required>
                                                            <option value="">Select Category</option>
                                                            <option value="Labour">Labour</option>
                                                            <option value="packing">Packing</option>
                                                            <option value="maintenance">Maintenance</option>
                                                            <option value="bill">Bill</option>
                                                            <option value="rent">Rent</option>
                                                            <option value="other expance">Other Expance</option>
                                                            <option value="isi expance">ISI Expance</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class=" mb-3">
                                                        <label class="form-label">Cost
                                                        </label>
                                                        <input type="number" class="form-control" name="cost"
                                                            placeholder="Enter Cost" autocomplete="off" required/>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="submit" class="btn btn-primary">
                                                            Submit
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