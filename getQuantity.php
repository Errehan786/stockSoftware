<?php
include_once('config.php');
include_once('include/auth.php');

// Retrieve parameters from GET request
$productCat = $_GET['productCat'] ?? '';
$length = $_GET['length'] ?? '';
//$description = $_GET['description'] ?? '';

try {
    // Sales Finished Goods
    $saleSql = "SELECT SUM(qtyPack) AS saleTotalQty FROM goodsRawMetrial WHERE description = '$productCat' AND type = 'salesFinishedGoods'";
    $saleData = $conn->query($saleSql)->fetch(PDO::FETCH_ASSOC)['saleTotalQty'] ?? 0;

    // Purchase Finished Goods
    $purchaseSql = "SELECT SUM(totalQty) AS purchaseTotalQty FROM goodsRawMetrial WHERE description = '$productCat' AND type = 'purchaseFinishedGoods'";
    $purchaseData = $conn->query($purchaseSql)->fetch(PDO::FETCH_ASSOC)['purchaseTotalQty'] ?? 0;

    // Sales Return Finished Goods
    $salesReturnSql = "SELECT SUM(totalQty) AS salesReturnTotalQty FROM goodsRawMetrial WHERE description = '$productCat' AND type = 'salesReturnFinishedGoods'";
    $salesReturnData = $conn->query($salesReturnSql)->fetch(PDO::FETCH_ASSOC)['salesReturnTotalQty'] ?? 0;

    // Opening Stock
    $openingStockSql = "SELECT SUM(openingStock) AS openingStockTotal FROM finishGoods WHERE description = '$productCat'";
    $openingStockData = $conn->query($openingStockSql)->fetch(PDO::FETCH_ASSOC)['openingStockTotal'] ?? 0;

    // Cable Production
    $cableProdSql = "SELECT quantity FROM cableProduction WHERE description = '$productCat'";
    $cableProdQty = $conn->query($cableProdSql)->fetch(PDO::FETCH_ASSOC)['quantity'] ?? 0;

    // Quantity Data for productCat and length
    $quantitySql = "SELECT SUM(quantity) AS quantityIs FROM quantityData WHERE description = '$productCat' AND length = '$length'";
    $quantityIs = $conn->query($quantitySql)->fetch(PDO::FETCH_ASSOC)['quantityIs'] ?? 0;

    // Calculate totalBaseQty
    $totalBaseQty = $quantityIs;

    // Return as JSON
    echo json_encode(["quantity" => $totalBaseQty]);

} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
