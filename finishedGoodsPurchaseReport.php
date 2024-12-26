<?php
include_once('config.php');
include_once('include/auth.php');

//get accounts
$accountSql = "SELECT * FROM `account`";
$accountResult = $conn->query($accountSql);

// Get Purchase Details
if (isset($_REQUEST['searchData'])) {
    $partyAccountName = $_REQUEST['partyAccountName'] ?? '';

    // Convert input dates from Y-m-d to d-m-Y for database compatibility
    $fromDate = !empty($_REQUEST['from']) ? DateTime::createFromFormat('Y-m-d', $_REQUEST['from'])->format('d-m-Y') : '';
    $toDate = !empty($_REQUEST['To']) ? DateTime::createFromFormat('Y-m-d', $_REQUEST['To'])->format('d-m-Y') : '';

    // Base SQL query
    $purchaseSql = "SELECT * FROM `purchaseGoodsRawMaterial` WHERE type='purchaseFinishedGoods'";

    // Append conditions dynamically
    $conditions = [];
    if (!empty($partyAccountName)) {
        $conditions[] = "partyAccountName='$partyAccountName'";
    }
    if (!empty($fromDate) && !empty($toDate)) {
        // Convert database date format for comparison
        $conditions[] = "STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$fromDate', '%d-%m-%Y') AND STR_TO_DATE('$toDate', '%d-%m-%Y')";
    } elseif (!empty($fromDate)) {
        $conditions[] = "STR_TO_DATE(date, '%d-%m-%Y') >= STR_TO_DATE('$fromDate', '%d-%m-%Y')";
    } elseif (!empty($toDate)) {
        $conditions[] = "STR_TO_DATE(date, '%d-%m-%Y') <= STR_TO_DATE('$toDate', '%d-%m-%Y')";
    }

    // Add conditions to the SQL query
    if (count($conditions) > 0) {
        $purchaseSql .= ' AND ' . implode(' AND ', $conditions);
    }


    // Execute the query
    $purchaseSqlResult = $conn->query($purchaseSql);
}



?>
<style>
  .form-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .table-card table {
    border-collapse: separate;
    border-spacing: 0 10px;
  }

  .table-card table thead {
    background-color: #007bff;
    color: white;
  }

  .table-card table tbody tr {
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  .table-card table tbody tr:hover {
    background-color: #f1f1f1;
  }
</style>


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
            <h4 class="mb-sm-0">Finished Goods Purchase Report</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="./dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Finished Goods Purchase Report</li>
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
                    <h3 class="mb-4">Finished Goods Purchase Report</h3>
                  </div>
                  <!-- Export to Excel Button -->
                  <div class="col-3 m-2">
                    <form action="exportToExcelFinishedGoods.php" method="post">
                        <input type="hidden" name="partyAccountName" value="<?php echo $_REQUEST['partyAccountName'] ?? ''; ?>">
                        <input type="hidden" name="from" value="<?php echo $_REQUEST['from'] ?? ''; ?>">
                        <input type="hidden" name="To" value="<?php echo $_REQUEST['To'] ?? ''; ?>">
                        <button type="submit" class="btn btn-success">Export to Excel</button>
                    </form>
                </div>
                <hr>
                </div>

                <form action="" method="post">
                  <!-- Section: Party Account -->
                  <div class="form-section p-3">
                    <div class="row g-4">
                      <div class="col-lg-4">
                        <label class="form-label">Party Account</label>
                        <select id="vendorList" name="partyAccountName" class="form-select">
                          <option value="">Select Party Account</option>
                          <?php while ($accountData = $accountResult->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $accountData['accountName']; ?>"
                              <?php echo (isset($_REQUEST['partyAccountName']) && $_REQUEST['partyAccountName'] === $accountData['accountName']) ? 'selected' : ''; ?>>
                              <?php echo $accountData['accountName']; ?>
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
                        <input type="submit" class="form-control" name="searchData">
                      </div>
                    </div>
                  </div>
                </form>

                <table class="table table-sm table-bordered align-middle">
                  <thead class="table-light">
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Prod Category</th>
                        <th>Description</th>
                        <th>Packing Unit</th>
                        <th>Length</th>
                        <th>Qty/Pack</th>
                        <th>Qty/Unit</th>
                        <th>Unit</th>
                        <th>Price/Unit</th>
                        <th>LR No.</th>
                        <th>Transport</th>
                        <th>Lot No.</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($purchaseData = $purchaseSqlResult->fetch(PDO::FETCH_ASSOC)) {
                      $purchaseRawSql = "SELECT * FROM `goodsRawMetrial` WHERE voucherNo='$purchaseData[voucherNo]' and type='purchaseFinishedGoods'";
                      $purchaseRawResult = $conn->query($purchaseRawSql);
                      $sr = 1;
                      while ($purchaseRawData = $purchaseRawResult->fetch(PDO::FETCH_ASSOC)) {
                        $amountData = +$purchaseRawData['rate'];
                    ?>
                        <tr>
                          <td><?php echo $sr; ?></td>
                          <td><?php echo $purchaseData['date']; ?></td>
                          <td><?php echo $purchaseRawData['groupName']; ?></td>
                          <td><?php echo $purchaseRawData['description']; ?></td>
                          <td><?php echo $purchaseRawData['packingUnit']; ?></td>
                          <td><?php echo $purchaseRawData['length']; ?></td>
                          <td><?php echo $purchaseRawData['qtyPack']; ?></td>
                          <td><?php echo $purchaseRawData['totalQty']; ?></td>
                          <td><?php echo $purchaseRawData['coilWt']; ?></td>
                          <td><?php echo $purchaseRawData['rate']; ?></td>
                          <td><?php echo $purchaseRawData['lrNo']; ?></td>
                          <td><?php echo $purchaseRawData['transport']; ?></td>
                          <td><?php echo $purchaseRawData['lotNo']; ?></td>
                        </tr>
                      <?php $sr++;
                      } ?>
                      <tr>
                        <td colspan="13">
                          <table class="table table-sm table-bordered">
                            <tbody>
                              <tr>

                                <td class="text-end">Bill Amount</td>
                                <?php $totalPurchaseData += $purchaseData['totalBill']?>
                                <td class="text-center"><b><?php echo $purchaseData['totalBill']; ?></b></td>
                                <td colspan="2">
                                  <button class="btn btn-primary btn-sm" onclick="toggleDetails(<?php echo $purchaseData['id']; ?>)">View Details</button>
                                </td>
                              </tr>
                              <tr id="details-row-<?php echo $purchaseData['id']; ?>" style="display: none;">
                                <td colspan="4">
                                  <table class="table table-sm table-bordered">
                                    <tbody>
                                      <tr>
                                        <td>Total Amount</td>
                                        <td><b><?php if (isset($purchaseData['totalAmount'])) echo $purchaseData['totalAmount']; ?></b></td>
                                        <td>Discount [-] Percentage</td>
                                        <td><b><?php if (isset($purchaseData['discountPer'])) echo $purchaseData['discountPer']; ?></b></td>
                                        <?php
                                        $discoutPrice = $purchaseData['totalAmount']*$purchaseData['discountPer']/100;
                                        ?>
                                        <td>Discount Amount</td>
                                        <td><b><?php if (isset($discoutPrice)) echo $discoutPrice; ?></b></td>
                                      </tr>
                                      <tr>
                                        <td>Total Amount</td>
                                        <td><b><?php if (isset($purchaseData['totalAmount'])) echo $purchaseData['totalAmount']-$discoutPrice; ?></b></td>
                                        <td>Deductions Amount</td>
                                        <td><b><?php if (isset($purchaseData['dudChargeAmount'])) echo $purchaseData['dudChargeAmount']; ?></b></td>
                                        <td>Addl. Charges Amount</td>
                                        <td><b><p class="mb-0"><?php if (isset($purchaseData['addChargeAmount'])) echo $purchaseData['addChargeAmount']; ?></p></b></td>
                                      </tr>
                                      <tr>
                                        <td>Bill Amount</td>
                                        <td><b><?php if (isset($purchaseData['totalBill'])) echo $purchaseData['totalBill']; ?></b></td>
                                        <td>Discount [-] Remark</td>
                                        <td><b><?php if (isset($purchaseData['dudChargeRemark'])) echo $purchaseData['dudChargeRemark']; ?></b></td>
                                        <td>Addl. Charges [+] Remark</td>
                                        <td><b><p class="mb-0"><?php if (isset($purchaseData['addChargeRemark'])) echo $purchaseData['addChargeRemark']; ?></p><b></td>
                                      </tr>
                                      <tr id="details-row-<?php echo $purchaseData['id']; ?>" style="display: none;">
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

                <div class="text-center">
                  <h2>Total Bill Amount: <?php echo $totalPurchaseData ?></h2>
                </div>

                <div class="noresult" style="display: none">
                  <div class="text-center">
                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                    <h5 class="mt-2">Sorry! No Result Found</h5>
                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for your search.</p>
                  </div>
                </div>
              </div>

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