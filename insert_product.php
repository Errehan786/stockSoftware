<?php
include_once('config.php'); 
include_once('include/auth.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $prodCat = $_POST['prodCat'];
    $description_get = $_POST['description'];
    $cDate = $_POST['cDate'];
    $unit = $_POST['unit'];
    $newRate = $_POST['newRate'];
    $editId = $_POST['editId'];

    // Insert data into semiGoodsProduct table
    $stmt1 = $conn->exec("INSERT INTO semiGoodsProduct (quantity, prodCat, description, cDate, unit, newRate) 
                          VALUES ('$quantity', '$prodCat', '$description_get', '$cDate', '$unit', '$newRate')");
    $insertedId = $conn->lastInsertId();

    if ($stmt1) {
        // Fetch current stock for the description from productCalculation table
        $query_qty = $conn->query("SELECT * FROM productCalculation WHERE pvcDescription = '$description_get'");
        
        while ($rowData = $query_qty->fetch(PDO::FETCH_ASSOC)) {
            if(empty($rowData['prodQuantity'])){
              $queryRaw_Q = $conn->query("SELECT prodQuantity FROM productCalculation WHERE description = '{$rowData['description']}' and prodQuantity IS NOT NULL order by id");
              $rawQuantity = $queryRaw_Q->fetch(PDO::FETCH_ASSOC);
              $qtyIs = $rowData['quantity'];
              $newQtyIs = $rowData['totalQuantity'];
              $prodQty = ($newQtyIs != 0) ? ($qtyIs / $newQtyIs) * $quantity : 0;
              $oldProdQtyIs = $rawQuantity['prodQuantity'];
              $prodQtyIs = number_format($oldProdQtyIs+$prodQty, 2);
            }else{
              $qtyIs = $rowData['quantity'];
              $newQtyIs = $rowData['totalQuantity'];
              $prodQty = ($newQtyIs != 0) ? ($qtyIs / $newQtyIs) * $quantity : 0;
              $oldProdQtyIs = $rowData['prodQuantity'];
              $prodQtyIs = number_format($oldProdQtyIs+$prodQty, 2);
            }

            // Update prodQuantity in productCalculation
            $conn->exec("UPDATE productCalculation SET prodQuantity = '$prodQtyIs' WHERE description = '{$rowData['description']}'");

            // Fetch opening stock from rawMeterial table
            $query_qty_get_opening_stock = $conn->query("SELECT openingStock FROM rawMeterial WHERE description = '{$rowData['description']}'");
            $openingStock_qry = $query_qty_get_opening_stock->fetch(PDO::FETCH_ASSOC);

            if ($openingStock_qry) {
                $openingStock = $openingStock_qry['openingStock'];
                $stock = $openingStock;

                // Update opening stock in rawMeterial table
                $conn->exec("UPDATE rawMeterial SET openingStock = '$stock' WHERE description = '{$rowData['description']}'");
            }
        }

        // Prepare response data
        $response = [
            'success' => true,
            'data' => [
                'id' => $insertedId,
                'quantity' => $quantity,
                'prodCat' => $prodCat,
                'description' => $description_get,
                'cDate' => $cDate,
                'unit' => $unit,
                'rate' => $newRate
            ]
        ];
        echo json_encode($response);
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Error inserting data into semiGoodsProduct']);
    }
}
?>
