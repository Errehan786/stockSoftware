<?php include_once('config.php');
include_once('include/auth.php');
///raw material
$sql3 = "SELECT * FROM `group`";
$result3 = $conn->query($sql3);
////finished goods
$goodsGroupsql = "SELECT * FROM `goodsGroup`";
$goodsGroupresult = $conn->query($goodsGroupsql);

//////delete item
if(isset($_REQUEST['groupId'])){
    $groupId = $_REQUEST['groupId'];
    $delSql = "DELETE FROM `group` WHERE id='$groupId'";
    if ($delResult = $conn->exec($delSql)) {
        echo '<script>window.location = "groupDataDelete.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "groupDataDelete.php";</script>';
  }
}
////////finished Goods item
if(isset($_REQUEST['goodsGroupId'])){
    $goodsGroupId = $_REQUEST['goodsGroupId'];
    $delSql = "DELETE FROM `goodsGroup` WHERE id='$goodsGroupId'";
    if ($delResult = $conn->exec($delSql)) {
        echo '<script>window.location = "groupDataDelete.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "groupDataDelete.php";</script>';
  }
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
                <h4 class="mb-sm-0">Group List</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Group List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-lg-6">
                <h3>Raw Matrial Group</h3>
              <div class="card">
                <div class="card-body">
                  <div id="customerList">
                    <div class="row g-4 mb-4">
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                      <table class="table align-middle table-nowrap">
                        <thead class="table-light">
                          <tr>
                             <th>Sr No.</th>
                            <th>Group Name</th>
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
                            <td><?php echo $name; ?></td>
                            <td>
                              <div class="d-flex gap-2">
                                <div class="remove">
                                  <a href="?groupId=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
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
            <div class="col-lg-6">
                <h3>Finished Goods Group</h3>
              <div class="card">
                <div class="card-body">
                  <div id="customerList">
                    <div class="row g-4 mb-4">
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                      <table class="table align-middle table-nowrap">
                        <thead class="table-light">
                          <tr>
                             <th>Sr No.</th>
                            <th>Group Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="list form-check-all">
                        <?php
                        $a=1;
                        while($goodsGroupRow = $goodsGroupresult->fetch(PDO::FETCH_ASSOC)){
                            @extract($goodsGroupRow);
                        ?>
                          <tr id="messageTxtHide">
                              <td><?php echo $a; ?></td>
                            <td><?php echo $name; ?></td>
                            <td>
                              <div class="d-flex gap-2">
                                <div class="remove">
                                  <a href="?goodsGroupId=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
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
          <!-- end col -->
        </div>
      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Footer start -->
    <?php include_once('include/footer.php'); ?>