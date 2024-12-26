<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['proCalculationSubmit'])) {
    $pvcDescription = $_POST['pvcDescription'];
    $productCat = $_POST['productCat'];
    $description = $_POST['calDescription'];
    $proQty = $_POST['proQty'];
    // $qtyKg = $_POST['qtyKg'];
    $coilWt = $_POST['coilWt'];
    $rate = $_POST['rateIs'];
    $stmt = "INSERT INTO `productCalculation`(`pvcDescription`,`groupName`, `description`, `quantity`, `qtyKg`, `units`, `rate`) VALUES ('$pvcDescription','$productCat','$description','$proQty','$proQty','$coilWt','$rate')";
    try {
        $conn->exec($stmt);
        //get all inserted data as pvcDescription
        $sqlData = "SELECT sum(quantity) as totalQty FROM `productCalculation` WHERE pvcDescription='$pvcDescription'";
        $resultData = $conn->query($sqlData);
        $qtyRow = $resultData->fetch(PDO::FETCH_ASSOC);
        $totalQty =  $qtyRow['totalQty'];
        $updateQtySql = "UPDATE `productCalculation` SET `totalQuantity`='$totalQty' WHERE pvcDescription='$pvcDescription'";
        $conn->query($updateQtySql);
        //echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
