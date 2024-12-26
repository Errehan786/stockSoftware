<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['proCalculationSubmit'])) {
    $editId = $_POST['editId'];
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
    
    // Assuming you're updating the data based on 'voucherNo' (or another unique identifier)
    $stmt = "UPDATE `goodsRawMetrial` 
             SET `groupName` = '$productCat', 
                 `description` = '$description', 
                 `packingUnit` = '$packingUnit', 
                 `length` = '$length', 
                 `qtyPack` = '$qtyPack', 
                 `totalQty` = '$totalQty', 
                 `coilWt` = '$coilWt', 
                 `rate` = '$rateIs', 
                 `lrNo` = '$lrNo', 
                 `transport` = '$transport', 
                 `lotNo` = '$lotNo', 
                 `type` = '$purchaseFinishedGoods' 
             WHERE `id` = '$editId' and type='$purchaseFinishedGoods'";

    try {
        $conn->exec($stmt);
        // echo "Data updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
