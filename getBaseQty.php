<?php
include_once('config.php');
include_once('include/auth.php');

$description = $_GET['description'];
$groupName = $_GET['group'];

// rawmatrial
$rawMaterialsql = "SELECT openingStock FROM rawMeterial WHERE description = '$description'";
$rawMaterialstmt = $conn->query($rawMaterialsql);
$rawMaterialrow = $rawMaterialstmt->fetch(PDO::FETCH_ASSOC);

// Product Calculation
$Calculationsql = "SELECT prodQuantity FROM productCalculation WHERE description = '$description'";
$Calculationstmt = $conn->query($Calculationsql);
$Calculationrow = $Calculationstmt->fetch(PDO::FETCH_ASSOC);

// Query to sum baseQty from purchaseRawMaterial where groupName and description match
$sql = "SELECT SUM(netQty) AS totalBaseQty FROM purchaseRawMaterial WHERE description = '$description' AND type = 'purchase'";
$stmt = $conn->query($sql);

// Query to sum baseQty from purchaseRawMaterial where groupName and description match
$sql1 = "SELECT SUM(netQty) AS totalBaseQty FROM purchaseRawMaterial WHERE description = '$description' AND type = 'return'";
$stmt1 = $conn->query($sql1);

// Query to sum baseQty from purchaseRawMaterial where groupName and description match
$rawSalesql = "SELECT SUM(netQty) AS totalBaseQty FROM purchaseRawMaterial WHERE description = '$description' AND type = 'rawSale'";
$rawSaleStmt = $conn->query($rawSalesql);
$rawSaleRow = $rawSaleStmt->fetch(PDO::FETCH_ASSOC);

// PVC Production
$productionsql = "SELECT SUM(quantity) AS totalProductionQty FROM semiGoodsProduct WHERE description = '$description'";
$productionStmt = $conn->query($productionsql);
$productionRow = $productionStmt->fetch(PDO::FETCH_ASSOC);

// Fetch the total baseQty
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$totalBaseQty1 = $row['totalBaseQty']; // If no rows match, default to 0
$totalBaseQty2 = $row1['totalBaseQty']; // If no rows match, default to 0
$rawMaterialData = $rawMaterialrow['openingStock']; // If no rows match, default to 0
$CalculationData = $Calculationrow['prodQuantity'];
$rawSaleRowData = $rawSaleRow['totalBaseQty'];
$productionRowData = $productionRow['totalProductionQty'];
$totalBaseQty = $totalBaseQty1-$totalBaseQty2+$rawMaterialData+$productionRowData-$CalculationData-$rawSaleRowData;
// Return the total baseQty
echo $totalBaseQty;
?>
