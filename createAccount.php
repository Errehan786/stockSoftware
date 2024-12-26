<?php include_once('config.php');
include_once('include/auth.php');
$messageAction = '';
if (isset($_REQUEST['item_submit'])) {
  $item_name = $_REQUEST['item_name'];
  $accountGroup = $_REQUEST['accountGroup'];
  $item_description = $_REQUEST['item_description'];
  $location = $_REQUEST['location'];
  $opeaning = $_REQUEST['opeaning'];
  
  $sql = "INSERT INTO `account`(`opeaning`,`accountName`, `accountGroup`, `remarks`, `creditPeriod`) VALUES ('$opeaning','$item_name','$accountGroup','$item_description','$location')";
  if ($result = $conn->exec($sql)) {
      echo '<script>alert("Data has been saved successfully!");window.location = "createAccount.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "createAccount.php";</script>';
  }
}

$sql3 = "SELECT * FROM account";
$result3 = $conn->query($sql3);

///delete item
if($_REQUEST['rateIs'] <= 0){
if(isset($_REQUEST['accountId'])){
    $accountId = $_REQUEST['accountId'];
    $delSql = "DELETE FROM `account` WHERE id='$accountId'";
    if ($delResult = $conn->exec($delSql)) {
        echo '<script>alert("Data has been Deleted successfully!");window.location = "createAccount.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "createAccount.php";</script>';
  }
}
}else{
    echo '<script>alert("Account Can Not Delete Because Customer Have Avilable Amount!");window.location = "createAccount.php";</script>';
}
?>
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
    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <!-- start page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Account Details List</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Account Details List</li>
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
                  <div id="customerList">
                    <div class="row g-4 mb-4">
                    </div>
                    <?php if(isset($messageAction1)) echo $messageAction1;?>
                    <div class="table-responsive table-card mt-3 mb-1">
                      <table class="table align-middle table-nowrap" id="example">
                        <thead class="table-light">
                          <tr>
                             <th>Sr No.</th>
                            <th>Account</th>
                            <th>Account Group</th>
                            <th>Remarks</th>
                            <th>Opeaning</th>
                            <th>Credit Period(No of Days)</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="list form-check-all">
                        <?php
                        $a=1;
                        while($acountRow = $result3->fetch(PDO::FETCH_ASSOC)){
                            @extract($acountRow);
                        ?>
                          <tr id="messageTxtHide">
                              <td><?php echo $a; ?></td>
                            <td><?php echo $accountName; ?></td>
                            <td><?php echo $accountGroup; ?></td>
                            <td><?php echo $remarks; ?></td>
                            <td><?php echo $opeaning; ?></td>
                            <td><?php echo $creditPeriod; ?></td>
                            <td>
                              <div class="d-flex gap-2">
                                <div class="edit">
                                  <a href="accountDetailsedit.php?accountId=<?php echo $id; ?>" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
                                </div>
                                <div class="remove">
                                  <a href="?accountId=<?php echo $id; ?>&rateIs=<?php echo $opeaning; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php
                        $a++; }
                        ?>
                        </tbody>
                      </table>
                    </div>
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
                  <h4 class="card-title mb-0 flex-grow-1">Add New Account</h4>
                </div>
                <div class="card-body">
                  <div class="live-preview">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control" name="item_name" placeholder="Enter Account Name" required />
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label class="form-label">Account Group</label>
                            <select id="" name="accountGroup" class="form-select" required>
                              <option value="">Select Account Group </option>
                              <option value="Bank Accounts">Bank Accounts</option>
                              <option value="Cash Accounts">Capital Accounts</option>
                              <option value="Cash Accounts">Cash Accounts</option>
                              <option value="Interest Accounts">Interest Accounts</option>
                              <option value="Misc. Expenditure">Misc. Expenditure</option>
                              <option value="Purchase Accounts">Purchase Accounts</option>
                              <option value="Purchase Return Accounts">Purchase Return Accounts</option>
                              <option value="Sales Accounts">Sales Accounts</option>
                              <option value="Sales Return Accounts">Sales Return Accounts</option>
                              <option value="sundry debitors">Sundry Debitors</option>
                              <option value="sundry creditors">Sundry Creditors</option>
                              <option value="unsecured loans">Unsecured Loans</option>
                            </select>

                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class=" mb-3">
                            <label class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="item_description" placeholder="Enter Remarks" />
                          </div>
                        </div>

                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label class="form-label">Credit Period (No of Days)</label>
                            <input type="number" class="form-control" name="location" placeholder="Enter Credit Period" />
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="mb-3">
                            <label class="form-label">Opeaning</label>
                            <input type="number" class="form-control" name="opeaning" placeholder="Enter Opeaning" />
                          </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                          <div class="text-center">
                            <input type="submit" name="item_submit" class="btn btn-primary" value="Submit">
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
    <?php include_once('include/footer.php'); ?>