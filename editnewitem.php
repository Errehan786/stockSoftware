<?php
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['edit_new_item'])){
    $sql = "SELECT * FROM `new_item` WHERE id={$_REQUEST['edit_new_item']} and user_reg_id='$_SESSION[id]'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
}
if(isset($_REQUEST['mainsubmit'])){
      $quantity = $_REQUEST['quantity'];
      $cost = $_REQUEST['cost'];
      $currency = $_REQUEST['localCurrency'];
      $unitCost = $_REQUEST['unitCost'];
      $batchNo = $_REQUEST['batchNo'];
      $tblid = $_REQUEST['edit_new_item'];
      
      $sql12 = "UPDATE `new_item` SET item_name='$_POST[item_name]',`qty`='$quantity',`cost`='$cost',`local_currency`='$currency',`acquire_per/unit`='$unitCost',`batch_no`='$batchNo' WHERE id='$tblid'";
      if($conn->query($sql12)){
        $msg = '<div class="mx-3 mt-3">
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfull</h6>
            </div>';
            ?>
            <script>
            setTimeout(
                function(){
                    window.location = "purchaseEntryForm.php"; 
                },
            1000);
            </script>
            <?php
        }else{
            $msg1 ='<div class="mx-3 mt-3">
            <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has Not Updated</h6>
            </div>';
    }
  }
      
// }

?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
  <meta charset="utf-8" />
  <title>Purchase Entry Form | <?php echo $_SESSION['userName']?> </title>
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
                <h4 class="mb-sm-0">PURCHASE ENTRY DETAILS </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Purchase Entry Details & Form</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end page title -->
          <div class="row" id="addNewPurchase">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1"> Edit New Purchase Entry</h4>
                </div>
                <?php
                if(isset($msg)){
                  echo $msg;
                }
                ?>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="post">
                      <div class="row">  
                        <div class="col-lg-3"></div>
                        <!--end col-->
                        <div class="col-lg-3"></div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-body">
                                <div id="customerList">
                                  <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                      <thead class="table-light">
                                        <tr>
                                          <!-- <th>Purchase Entry Id<th> -->
                                          <th>Item Name</th>
                                          <th>Qty</th>
                                          <th>Cost</th>
                                          <th>Local Currency</th>
                                          <th>Cost To Acquire Per/Unit</th>
                                          <th>Batch No.</th>
                                        </tr>
                                      </thead>
                                      <tbody class="list form-check-all">
                                          <td>
                                          <div class="form-group" id="textarea1">
                                        <?php
                                            $itemName =  $row['item_name'];
                                            $itemId = $row['id'];
                                            $sql3 = "SELECT * FROM items";
                                            $result3 = $conn->query($sql3);
                                                         
                                        ?>
                                            <select id="ForminputState" name="item_name" class="form-select">
                                                <?php
                                                    while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <option value="<?php echo $row1['id'] ?>" <?php if($row1['id']==$row['item_name'])echo "selected"?>><?php if(isset($row1['item_name'])){echo $row1['item_name'];}?></option>
                                                <?php
                                                }
                                                        
                                                ?>
                                            </select>
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="textarea2">
                                            <input type="text" class="form-control" name="quantity" value="<?php if(isset($row['item_name'])){echo $row['qty'];}?>" placeholder="Enter Qty"
                                              id="compnayNameinput" />
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="costInput">
                                            <input type="text" class="form-control" name="cost" value="<?php if(isset($row['cost'])){echo $row['cost'];}?>" placeholder="Cost"
                                              id="compnayNameinput" />
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="CurrencyNmae">
                                            <input type="text" class="form-control" name="localCurrency" value="<?php if(isset($row['local_currency'])){echo $row['local_currency'];}?>" placeholder="Local Currency"
                                              id="compnayNameinput" />
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="unitCost">
                                            <input type="text" class="form-control" name="unitCost" value="<?php if(isset($row['acquire_per/unit'])){echo $row['acquire_per/unit'];}?>" placeholder="Per/Unit Cost"
                                              id="compnayNameinput" />
                                          </div>
                                          </td>
                                          <td>
                                          <div class="form-group" id="batchNo">
                                            <input type="text" class="form-control" name="batchNo" value="<?php if(isset($row['batch_no'])){echo $row['batch_no'];}?>" placeholder="Batch No."
                                              id="compnayNameinput" />
                                          </div>
                                          </td>
                                        </tr>
                                      </tbody>

                                    </table>     
                                    <div class="col-sm-3 mx-auto">
                                            <input type="submit" name="mainsubmit" class="btn btn-info" value="Update" style="background-color:#0ab39c;">
                                          </div>        
                        
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  <!-- footer start -->
  <?php include_once ('include/footer.php');?>
        </div>
  </div>
  <!-- end main content-->
  </div>
  <!-- END layout-wrapper -->
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
  <script src="assets/libs/list.js/list.min.js"></script>

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