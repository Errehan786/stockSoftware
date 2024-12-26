<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['proCalculationSubmit'])) {
    $productCat = $_POST['productCat'];
    $voucherNo = $_POST['voucherNo'];
    $description = $_POST['calDescription'];
    $packingUnit = $_POST['packingUnit'];
    $length = $_POST['length'];
    $qtyPack = $_POST['qtyPack'];
    $totalQty = $_POST['totalQty'];
    $coilWt = $_POST['coilWt'];
    $rateIs = $_POST['rateIs'];
    $lrNo = $_REQUEST['lrNo'];
    $transport = $_REQUEST['transport'];
    $lotNo = $_REQUEST['lotNo'];
    $purchaseFinishedGoods = $_REQUEST['purchaseFinishedGoods'];

    try {
        // First query: Insert data into goodsRawMetrial table
        $stmt = "INSERT INTO `goodsRawMetrial`(`voucherNo`, `groupName`, `description`, `packingUnit`, `length`, `qtyPack`, `totalQty`, `coilWt`, `rate`, `lrNo`, `transport`, `lotNo`, `type`) 
                 VALUES ('$voucherNo','$productCat','$description','$packingUnit','$length','$qtyPack','$totalQty','$coilWt','$rateIs','$lrNo','$transport','$lotNo','$purchaseFinishedGoods')";
        echo $stmt;
        $conn->exec($stmt); // Execute the first query

        // Second query: Insert data into quantityData table
        $stmt1 = "INSERT INTO `quantityData`(`prodCat`, `description`, `unit`, `length`, `quantity`) 
                  VALUES ('$productCat','$description','$packingUnit','$length','$qtyPack')";
        echo $stmt1;
        $conn->exec($stmt1); // Execute the second query
        
        // Optionally, print success message
        //echo "Data inserted successfully!";
    } catch (PDOException $e) {
        // Catch and display any errors
        echo "Error: " . $e->getMessage();
    }
}
?>
