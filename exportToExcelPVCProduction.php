<?php
include_once('config.php');
include_once('include/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Set headers for Excel file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=PVC Production" . date("Y-m-d") . ".xls");

    // Start Excel table
    echo "<table border='1'>";
    echo "<tr><th>Sr.No</th>
            <th>Prod. Qty</th>
            <th>Description</th>
            <th>Date</th>
            <th>Unit</th>
            <th>Rate</th>
            <th>Amount</th></tr>";

    $sr = 1;
    while ($purchaseData = $purchaseSqlResult->fetch(PDO::FETCH_ASSOC)) {
        $totalPurchaseData = $purchaseData['newRate'] * $purchaseData['quantity'];

        echo "<tr>";
        echo "<td>{$sr}</td>";
        echo "<td>{$purchaseData['quantity']}</td>";
        echo "<td>{$purchaseData['description']}</td>";
        echo "<td>{$purchaseData['cDate']}</td>";
        echo "<td>{$purchaseData['unit']}</td>";
        echo "<td>{$purchaseData['newRate']}</td>";
        echo "<td>{$totalPurchaseData}</td>";
        echo "</tr>";

        // Fetch nested product details
        $purchaseRawSql = "SELECT * FROM productCalculation WHERE pvcDescription = '$purchaseData[description]'";
        $purchaseRawResult = $conn->query($purchaseRawSql);

        if (!$purchaseRawResult) {
            echo "Error executing nested query: " . $conn->error;
            exit;
        }
    
    echo "<tr><th></th>
            <th>Sr.No</th>
    <th>Description</th>
            <th>Prod. Qty</th>
            <th>Rate</th>
            <th></th>
            <th></th>
            </tr>";
    $sr1 = 1;
        while ($purchaseRawData = $purchaseRawResult->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td></td>";
            echo "<td>{$sr1}</td>";
            echo "<td>{$purchaseRawData['description']}</td>";
            echo "<td>{$purchaseRawData['qtyKg']}</td>";
            echo "<td>{$purchaseRawData['rate']}</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
        $sr1++; }

        $sr++;
    }

    echo "</table>";
}
?>
