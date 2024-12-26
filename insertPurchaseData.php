<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['proCalculationSubmit'])) {
    $productCat = $_POST['productCat'];
    $voucherNo = $_POST['voucherNo'];
    $description = $_POST['calDescription'];
    $baseQty = $_POST['baseQty'];
    $containerType = $_POST['containerType'];
    $content = $_POST['content'];
    $netQty = $_POST['netQty'];
    $coilWt = $_POST['coilWt'];
    $rateIs = $_POST['rateIs'];
    $typeIs = $_REQUEST['typeIs'];
    $cDate = date('y-m-d');
    $stmt = "INSERT INTO `purchaseRawMaterial`(`prodCat`, `description`, `baseQty`, `containerType`, `content`, `netQty`, `unit`, `rate`,`voucherNo`,`type`,`cDate`) VALUES ('$productCat','$description','$baseQty','$containerType','$content','$netQty','$coilWt','$rateIs','$voucherNo','$typeIs','$cDate')";
    try {
        $conn->exec($stmt);
        //echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
