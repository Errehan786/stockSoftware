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

    // Update data in the semiGoodsProduct table where id = $editId
    $stmt1 = $conn->exec("UPDATE semiGoodsProduct 
                          SET quantity = '$quantity', prodCat = '$prodCat', description = '$description_get', 
                              cDate = '$cDate', unit = '$unit', newRate = '$newRate'
                          WHERE id = '$editId'");

    // Check if the update was successful
    if ($stmt1) {
        echo json_encode([
            'success' => true,
            'data' => [
                'id' => $editId,
                'quantity' => $quantity,
                'prodCat' => $prodCat,
                'description' => $description_get,
                'cDate' => $cDate,
                'unit' => $unit,
                'rate' => $newRate
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating data in semiGoodsProduct']);
    }
}
?>
