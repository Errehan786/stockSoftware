<?php
include_once('config.php');
include_once('include/auth.php');

//get accounts
$sql1 = "SELECT description, rate, unit FROM rawMeterial WHERE groupName = 'PVC'";
$result1 = $conn->query($sql1);

if (isset($_REQUEST['searchData'])) {
    $description = $_REQUEST['description'] ?? '';

    // Use input dates in Y-m-d format
    $fromDate = $_REQUEST['from'] ?? '';
    $toDate = $_REQUEST['To'] ?? '';

    // Base SQL query
    $purchaseSql = "SELECT * FROM `semiGoodsProduct`";

    // Append conditions dynamically
    $conditions = [];
    if (!empty($description)) {
        $conditions[] = "description = '$description'";
    }
    if (!empty($fromDate) && !empty($toDate)) {
        $conditions[] = "cDate BETWEEN '$fromDate' AND '$toDate'";
    } elseif (!empty($fromDate)) {
        $conditions[] = "cDate >= '$fromDate'";
    } elseif (!empty($toDate)) {
        $conditions[] = "cDate <= '$toDate'";
    }

    // Add conditions to the SQL query
    if (count($conditions) > 0) {
        $purchaseSql .= ' WHERE ' . implode(' AND ', $conditions);
    }


    // Execute the query
    $purchaseSqlResult = $conn->query($purchaseSql);


}






?>

<!-- ========== Header Start ========== -->
<?php include_once('include/header.php'); ?>
<!-- ========== Header End ========== -->

<!-- ========== Left Sidebar Start ========== -->
<?php include_once('include/left-side-menu.php'); ?>
<!-- ========== Left Sidebar End ========== -->

<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">PVC Production Report</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="./dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">PVC Production Report</li>
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
              <!--<h5 >Purchase Report</h5>-->

              <!-- Table Section -->
              <div class="table-responsive table-card">

                <div class="row">
                  <div class="col-8 m-2">
                    <h3 class="mb-4">PVC Production Report</h3>
                  </div>
                  <!-- Export to Excel Button -->
                  <div class="col-3 m-2">
                    <form action="exportToExcelPVCProduction.php" method="post">
                        <input type="hidden" name="description" value="<?php echo $_REQUEST['description'] ?? ''; ?>">
                        <input type="hidden" name="from" value="<?php echo $_REQUEST['from'] ?? ''; ?>">
                        <input type="hidden" name="To" value="<?php echo $_REQUEST['To'] ?? ''; ?>">
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                </div>
                <hr>
                </div>

                <form action="" method="post">
        <div class="form-section p-3">
            <div class="row g-4">
                <div class="col-lg-4">
                    <label class="form-label">Description</label>
                    <select id="vendorList" name="description" class="form-select">
                        <option value="">Select Description</option>
                        <?php while ($descRow = $result1->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $descRow['description']; ?>"
                                <?php echo ($description === $descRow['description']) ? 'selected' : ''; ?>>
                                <?php echo $descRow['description']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label class="form-label">From</label>
                    <input type="date" class="form-control" name="from" value="<?php if(isset($_REQUEST['from']))echo $_REQUEST['from']; ?>">
                </div>
                <div class="col-lg-3">
                    <label class="form-label">To</label>
                    <input type="date" class="form-control" name="To" value="<?php if(isset($_REQUEST['To']))echo $_REQUEST['To']; ?>">
                </div>
                <div class="col-lg-2">
                    <label class="form-label">&nbsp;&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" name="searchData" value="Search">
                </div>
            </div>
        </div>
    </form>

    <table class="table table-sm table-bordered align-middle mt-4">
        <thead class="table-light">
        <tr>
            <th>Sr.No</th>
            <th>Prod. Qty</th>
            <th>Description</th>
            <th>Date</th>
            <th>Unit</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sr = 1;
        while ($purchaseData = $purchaseSqlResult->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $sr; ?></td>
                <td><?php echo $purchaseData['quantity']; ?></td>
                <td><?php echo $purchaseData['description']; ?></td>
                <td><?php echo $purchaseData['cDate']; ?></td>
                <td><?php echo $purchaseData['unit']; ?></td>
                <td><?php echo $purchaseData['newRate']; ?></td>
                <td><?php echo $purchaseData['newRate'] * $purchaseData['quantity']; ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="toggleDetails(<?php echo $purchaseData['id']; ?>)">View Details</button>
                </td>
            </tr>
            <tr id="details-row-<?php echo $purchaseData['id']; ?>" style="display: none;">
                <td colspan="8">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Description</th>
                            <th>Prod. Qty</th>
                            <th>Rate</th>
                            <!--<th>Amount</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $purchaseRawResult = $conn->query("SELECT * FROM productCalculation WHERE pvcDescription = '{$purchaseData['description']}'");
                        $sr1 = 1;
                        while ($purchaseRawData = $purchaseRawResult->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $sr1; ?></td>
                                <td><?php echo $purchaseRawData['description']; ?></td>
                                <td><?php echo $purchaseRawData['qtyKg']; ?></td>
                                <td><?php echo $purchaseRawData['rate']; ?></td>
                                <!--<td><?php echo $purchaseRawData['totalQuantity']; ?></td>-->
                            </tr>
                            <?php $sr1++;
                        } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <?php $sr++;
        } ?>
        </tbody>
    </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
        function toggleDetails(rowId) {
            const detailsRow = document.getElementById(`details-row-${rowId}`);
            if (detailsRow) {
                detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
            } else {
                console.error(`Details row with ID details-row-${rowId} not found.`);
            }
        }
    </script>

<!-- footer start -->
<?php include_once('include/footer.php'); ?>