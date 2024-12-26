<?php
include("config.php");

if (isset($_POST['description'])) {
    $description = $_POST['description'];
    $groupName = $_POST['group'] ?? '';

    $query = "SELECT * FROM `productCalculation` WHERE `pvcDescription` = '$description' ORDER BY id ASC";
    $stmt = $conn->query($query);
    
    ////description
    $queryIs = "SELECT * FROM `rawMeterial` WHERE `description` = '$description'";
    $stmtIs = $conn->query($queryIs);
    $stock_rowIs = $stmtIs->fetch(PDO::FETCH_ASSOC);

    $response = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $query_qty = $conn->query("SELECT openingStock FROM `rawMeterial` WHERE `description` = '$row[description]' ");
        $stock_row = $query_qty->fetch(PDO::FETCH_ASSOC);
        
        $descriptionQuery = "SELECT prodQuantity prodQuantityIs  FROM `productCalculation` WHERE `description` = '$row[description]'";
        $descriptionStmt = $conn->query($descriptionQuery);
        $descriptionRow = $descriptionStmt->fetch(PDO::FETCH_ASSOC);

        $purchaseQuery_qty = "SELECT SUM(netQty) AS purtotalBaseQty FROM purchaseRawMaterial WHERE description = '$row[description]' AND type = 'purchase'";
        $purchase_query = $conn->query($purchaseQuery_qty);
        $purchaseStock_row = $purchase_query->fetch(PDO::FETCH_ASSOC);

        $returnQuery_qty = "SELECT SUM(netQty) AS RettotalBaseQty FROM purchaseRawMaterial WHERE description = '$row[description]' AND type = 'return'";
        $return_query = $conn->query($returnQuery_qty);
        $return_row = $return_query->fetch(PDO::FETCH_ASSOC);

        $rawSale = "SELECT SUM(netQty) AS rawTotalBaseQty FROM purchaseRawMaterial WHERE description = '$row[description]' AND type = 'rawSale'";
        $rawSale_query = $conn->query($rawSale);
        $rawSale_row = $rawSale_query->fetch(PDO::FETCH_ASSOC);

        // Using the row-specific `prodQuantity` value from each iteration
        $prodQuantity = $descriptionRow['prodQuantityIs'] ?? 0;
        

        // Calculating final stock using this row's `prodQuantity`
                            // + ($row['quantity'] ?? 0) 
        $finalStock = $stock_row['openingStock'] - $return_row['RettotalBaseQty'] + $purchaseStock_row['purtotalBaseQty']  - $prodQuantity - $rawSale_row['rawTotalBaseQty'];

        $response[] = [
            'id' => $row['id'],
            'description' => $row['description'],
            'quantity' => $row['quantity'],
            'stock' => $finalStock,
            'qtyKg' => $row['qtyKg'],
            'totalQuantity' => $row['totalQuantity'],
            'units' => $row['units'],
            'rate' => $row['rate'],
            'newRate' => $stock_rowIs['rate'] ?? 'N/A',
        ];
    }

    // Return the response as a JSON array
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Description not provided']);
}


?>
