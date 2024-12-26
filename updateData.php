<?php
include_once('config.php');
include_once('include/auth.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $pvcDescription = $_POST['pvcDescription'];
    $editId = isset($_POST['editId']) ? intval($_POST['editId']) : 0;
    $productCat = isset($_POST['productCat']) ? $_POST['productCat'] : '';
    $calDescription = isset($_POST['calDescription']) ? $_POST['calDescription'] : '';
    $proQty = isset($_POST['proQty']) ? floatval($_POST['proQty']) : 0;
    $coilWt = isset($_POST['coilWt']) ? floatval($_POST['coilWt']) : 0;
    $rateIs = $_POST['rateIs'];

    // Validate the data (you can add more validation as needed)
    if (!empty($productCat)) {
        // Prepare an SQL statement for updating the record
        $stmt = $conn->query("UPDATE productCalculation SET rate='$rateIs',groupName = '$productCat', description = '$calDescription', quantity = '$proQty', qtyKg = '$proQty' WHERE id = '$editId'");
        // Execute the statement
        if ($stmt) {
            $sqlData = "SELECT sum(quantity) as totalQty FROM `productCalculation` WHERE pvcDescription='$pvcDescription'";
            $resultData = $conn->query($sqlData);
            $qtyRow = $resultData->fetch(PDO::FETCH_ASSOC);
            $totalQty =  $qtyRow['totalQty'];
            $updateQtySql = "UPDATE `productCalculation` SET `totalQuantity`='$totalQty' WHERE pvcDescription='$pvcDescription'";
            //echo $updateQtySql;
            $conn->query($updateQtySql);
            //echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
