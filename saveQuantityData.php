<?php
// Include database configuration
include_once('config.php'); // Ensure this file sets up $conn properly

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $length = $_POST['length'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $prodCatIs = $_POST['prodCatIs'];
    $prodDescdata = $_POST['prodDescdata'];
    $sql = "INSERT INTO quantityData (prodCat,length, quantity, unit, description) VALUES ('$prodCatIs','$length', '$quantity', '$unit','$prodDescdata')";
    $stmt = $conn->exec($sql);
}
?>
