<?php
include_once('config.php');
include_once('include/auth.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partyAccountName = $_POST['partyAccountName'] ?? '';
    $fromDate = !empty($_POST['from']) ? DateTime::createFromFormat('Y-m-d', $_POST['from'])->format('d-m-Y') : '';
    $toDate = !empty($_POST['To']) ? DateTime::createFromFormat('Y-m-d', $_POST['To'])->format('d-m-Y') : '';

    // Build the SQL query dynamically
    $purchaseSql = "SELECT * FROM `SemiMaterialFinal` WHERE type='return'";
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
    echo "<tr><th>S.No</th><th>Date</th><th>Product Category</th><th>Description</th><th>Base Qty</th><th>Container Type</th><th>Content</th><th>Net Qty</th><th>Unit</th><th>Rate</th></tr>";

    
    while ($purchaseData = $purchaseSqlResult->fetch(PDO::FETCH_ASSOC)) {
        $purchaseRawSql = "SELECT * FROM `purchaseRawMaterial` WHERE voucherNo='$purchaseData[voucherNo]' AND type='return'";
        $purchaseRawResult = $conn->query($purchaseRawSql);
        $totalPurchaseData += $purchaseData['totalBill'];
        $sr = 1;
        while ($purchaseRawData = $purchaseRawResult->fetch(PDO::FETCH_ASSOC)) {
            
            echo "<tr>";
            echo "<td>{$sr}</td>";
            echo "<td>{$purchaseRawData['cDate']}</td>";
            echo "<td>{$purchaseRawData['prodCat']}</td>";
            echo "<td>{$purchaseRawData['description']}</td>";
            echo "<td>{$purchaseRawData['baseQty']}</td>";
            echo "<td>{$purchaseRawData['containerType']}</td>";
            echo "<td>{$purchaseRawData['content']}</td>";
            echo "<td>{$purchaseRawData['netQty']}</td>";
            echo "<td>{$purchaseRawData['unit']}</td>";
            echo "<td>{$purchaseRawData['rate']}</td>";
            echo "</tr>";
            $sr++;
        }

        // Add nested details for each purchase
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td colspan='6'>";
        echo "<table border='1'>";
        echo "<tr><td><b>Bill Amount</td><td>{$purchaseData['totalBill']}</b></td>";
        echo "<tr><td>Addl. Charges [+]</td><td>{$purchaseData['addChargesRemark']}</td>";
        echo "<td>Deductions [-]</td><td>{$purchaseData['deductionChargeRemark']}</td></tr>";
        echo "<tr><td>Total Amount</td><td>{$purchaseData['totalAmountBase']}</td>";
        echo "<td>Addl. Charges Amount</td><td>{$purchaseData['addCharges']}</td></tr>";
        echo "<tr><td>Deductions Amount</td><td>{$purchaseData['deductionCharge']}</td>";
        echo "<td>Remarks</td><td>{$purchaseData['remark']}</td></tr>";
        echo "</table>";
        echo "</td>";
        echo "</tr>";
        echo "<tr></tr>";
    }

    echo "</table>";
    echo "<h2>Total Bill Amount: {$totalPurchaseData}</h2>";
    
    
}
?>
