<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['proCalculationSubmit'])) {
    $editId = $_POST['editId'];
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

    // Assuming you're updating based on the voucherNo or another unique identifier
    $stmt = "UPDATE `purchaseRawMaterial` 
             SET `prodCat` = '$productCat', 
                 `description` = '$description', 
                 `baseQty` = '$baseQty', 
                 `containerType` = '$containerType', 
                 `content` = '$content', 
                 `netQty` = '$netQty', 
                 `unit` = '$coilWt', 
                 `rate` = '$rateIs', 
                 `type` = '$typeIs' 
             WHERE `id` = '$editId' and type='$typeIs'";
             

    try {
        $conn->exec($stmt);
        // echo "Data updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
