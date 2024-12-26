<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_POST['newStock']) && isset($_POST['productCat']) && isset($_POST['length'])) {
    $newStock = $_POST['newStock'];
    //echo $newStock;
    $productCat = $_POST['productCat'];
    $length = $_POST['length'];
    $calDescription = $_POST['calDescription'];
    //echo "SELECT quantity FROM quantityData WHERE prodCat = '$productCat' AND length = '$length' limit 1";
    $qtySqlIs = "SELECT quantity FROM quantityData WHERE prodCat = '$productCat' AND description = '$calDescription' AND length = '$length' limit 1";
    $resultData = $conn->query($qtySqlIs);
    $rowData = $resultData->fetch(PDO::FETCH_ASSOC);
    $finalQtyStock = $rowData['quantity'] - $newStock;
    //echo $finalQtyStock;
    // Update the stock for the product based on description, productCat, and length
    $sql = "UPDATE quantityData SET quantity = '$finalQtyStock' WHERE prodCat = '$productCat' AND description = '$calDescription' AND length = '$length' limit 1";
    echo $sql;
    // Execute the query
    if ($conn->query($sql) == true) {
        //echo "Stock updated successfully.";
    } else {
        echo "Error updating stock: " . $conn->error;
    }
}
?>
