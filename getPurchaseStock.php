<?php
include_once('config.php');
include_once('include/auth.php');

$description = $_GET['q'];
$qbIs = $_REQUEST['qb'];



// Query to sum baseQty from sales where groupName and description match
$saleSql = "SELECT SUM(totalQty) AS totalBaseQty, SUM(qtyPack) AS totalqtyPack FROM goodsRawMetrial WHERE description = '$description' AND type = 'salesFinishedGoods'";
$saleStmt = $conn->query($saleSql);
$SaleCableProd = $saleStmt->fetch(PDO::FETCH_ASSOC);

// Query to sum baseQty from goodsRawMetrial where groupName and description match
$sql = "SELECT SUM(totalQty) AS totalBaseQty FROM goodsRawMetrial WHERE description = '$description' AND type = 'purchaseFinishedGoods'";
$stmt = $conn->query($sql);

// Query to sum baseQty from goodsRawMetrial where groupName and description match
$salesGoodsSql = "SELECT SUM(totalQty) AS salesTotalBaseQty FROM goodsRawMetrial WHERE description = '$description' AND type = 'salesReturnFinishedGoods'";
$salesGoodStmt = $conn->query($salesGoodsSql);

// Query to sum baseQty from finishGoods where groupName and description match
$sql1 = "SELECT SUM(openingStock) AS totalBaseQty FROM finishGoods WHERE description = '$description'";
$stmt1 = $conn->query($sql1);

// Cable Production
$cableProdSql = "SELECT quantity FROM cableProduction WHERE description = '$description'";
$cableProdResult = $conn->query($cableProdSql);
$cableProd = $cableProdResult->fetch(PDO::FETCH_ASSOC);

///get box Stock
$boxSql = "SELECT openingStock FROM `rawMeterial` WHERE description = '$description'";
$boxStmt = $conn->query($boxSql);
$boxRow = $boxStmt->fetch(PDO::FETCH_ASSOC);
$boxRowData = $boxRow['openingStock'];

///get purchase box Stock
$purchaseBoxSql = "SELECT sum(baseQty) baseQtyIs FROM `purchaseRawMaterial` WHERE description = '$description' and type='purchase'";
$purchaseBoxStmt = $conn->query($purchaseBoxSql);
$purchaseBoxRow = $purchaseBoxStmt->fetch(PDO::FETCH_ASSOC);
$purchaseBoxRowData = $purchaseBoxRow['baseQtyIs'];

// Fetch the total baseQty
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$salesGoodRow = $salesGoodStmt->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

/// Select length
$lengthSql = "SELECT DISTINCT length FROM quantityData WHERE description = '$description'";
$lengthResult = $conn->query($lengthSql);

// Quantity Data for productCat and length
$quantitySql = "SELECT SUM(quantity * length) AS quantityIs FROM quantityData WHERE description = '$description'";

// Get quantityIs
$quantityIs = $conn->query($quantitySql)->fetch(PDO::FETCH_ASSOC)['quantityIs'] ?? 0;

// Sale and total quantity values
$saleData = $SaleCableProd['totalqtyPack'];
$totalBaseQty1 = $row['totalBaseQty']; // If no rows match, default to 0
$cableProdQty = $cableProd['quantity']; // If no rows match, default to 0
$totalBaseQty = $quantityIs;

///final box quantity
$finalBoxRowData = $boxRowData - $saleData + $purchaseBoxRowData;
// Initialize the length options
$lengthOption = "";

// Only display the length options if quantityIs is greater than 0
if ($quantityIs > 0) {
    // Generate the length dropdown
    while($lengthRow = $lengthResult->fetch(PDO::FETCH_ASSOC)){
        // Check if the quantity for the current length is greater than 0
        $lengthQuantitySql = "SELECT SUM(quantity) AS totalQuantity FROM quantityData WHERE description = '$description' AND length = '" . $lengthRow['length'] . "'";
        $lengthQuantityResult = $conn->query($lengthQuantitySql);
        $lengthQuantity = $lengthQuantityResult->fetch(PDO::FETCH_ASSOC)['totalQuantity'] ?? 0;

        // Only show lengths with a quantity greater than 0
        if ($lengthQuantity > 0) {
            $lengthOption .= "<option value='" . $lengthRow['length'] . "'>" . $lengthRow['length'] . "</option>";
        }
    }
}

// If quantityIs is 0 or less, skip rendering the dropdown
if ($quantityIs <= 0) {
    $lengthOption = ""; // No lengths to display
}

// Return total baseQty and the length dropdown options (if any)
echo $totalBaseQty . "*" . $lengthOption . "*" . $finalBoxRowData;
?>
