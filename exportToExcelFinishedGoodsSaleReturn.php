<?php
include_once('config.php');
include_once('include/auth.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partyAccountName = $_POST['partyAccountName'] ?? '';
    $fromDate = !empty($_POST['from']) ? DateTime::createFromFormat('Y-m-d', $_POST['from'])->format('d-m-Y') : '';
    $toDate = !empty($_POST['To']) ? DateTime::createFromFormat('Y-m-d', $_POST['To'])->format('d-m-Y') : '';

    // Build the SQL query dynamically
    $purchaseSql = "SELECT * FROM `purchaseGoodsRawMaterial` WHERE type='salesReturnFinishedGoods'";
    $conditions = [];
    if (!empty($partyAccountName)) $conditions[] = "partyAccountName='$partyAccountName'";
    if (!empty($fromDate) && !empty($toDate)) {
        $conditions[] = "STR_TO_DATE(date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$fromDate', '%d-%m-%Y') AND STR_TO_DATE('$toDate', '%d-%m-%Y')";
    }
    if ($conditions) $purchaseSql .= ' AND ' . implode(' AND ', $conditions);

    $purchaseSqlResult = $conn->query($purchaseSql);

    // Set headers for Excel file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=purchase_data_" . date("Y-m-d") . ".xls");

    // Start Excel table
    echo "<table border='1'>";
    echo "<tr>
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
      </tr>";


    
    while ($purchaseData = $purchaseSqlResult->fetch(PDO::FETCH_ASSOC)) {
        $purchaseRawSql = "SELECT * FROM `goodsRawMetrial` WHERE voucherNo='$purchaseData[voucherNo]' AND type='salesReturnFinishedGoods'";
        $purchaseRawResult = $conn->query($purchaseRawSql);
        $totalPurchaseData += $purchaseData['totalBill'];
        $sr = 1;
        while ($purchaseRawData = $purchaseRawResult->fetch(PDO::FETCH_ASSOC)) {
            
            echo "<tr>";
            echo "<td>{$sr}</td>";
            echo "<td>{$purchaseData['date']}</td>";
            echo "<td>{$purchaseRawData['groupName']}</td>";
            echo "<td>{$purchaseRawData['description']}</td>";
            echo "<td>{$purchaseRawData['packingUnit']}</td>";
            echo "<td>{$purchaseRawData['length']}</td>";
            echo "<td>{$purchaseRawData['qtyPack']}</td>";
            echo "<td>{$purchaseRawData['totalQty']}</td>";
            echo "<td>{$purchaseRawData['coilWt']}</td>";
            echo "<td>{$purchaseRawData['rate']}</td>";
            echo "<td>{$purchaseRawData['lrNo']}</td>";
            echo "<td>{$purchaseRawData['transport']}</td>";
            echo "<td>{$purchaseRawData['lotNo']}</td>";
            echo "</tr>";
            $sr++;
        }
        $discoutPrice = $purchaseData['totalAmount']*$purchaseData['discountPer']/100;
        $newAmt = $purchaseData['totalAmount']-$discoutPrice;
        // Add nested details for each purchase
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td colspan='6'>";
        echo "<table border='1'>";
        echo "<tr><td>Total Amount</td><td>{$purchaseData['totalAmount']}</td>";
        echo "<td>Discount [-] Percentage</td><td>{$purchaseData['discountPer']}</td><td>Discount Amount</td><td>{$discoutPrice}</td></tr>";
        echo "<tr><td>Total Amount</td><td>{$newAmt}</td>";
        echo "<td>Deductions Amount</td><td>{$purchaseData['dudChargeAmount']}</td><td>Addl. Charges Amount</td><td>{$purchaseData['addChargeAmount']}</td></tr>";
        echo "<tr><td>Bill Amount</td><td>{$purchaseData['totalBill']}</td>";
        echo "<td>Discount [-] Remark</td><td>{$purchaseData['dudChargeRemark']}</td><td>Addl. Charges [+] Remark</td><td>{$purchaseData['addChargeRemark']}</td></tr>";
        echo "</table>";
        echo "</td>";
        echo "</tr>";
        echo "<tr></tr>";
    }

    echo "</table>";
    echo "<h2>Total Bill Amount: {$totalPurchaseData}</h2>";
    
    
}
?>
