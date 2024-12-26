<?php
include_once('config.php');
include_once('include/auth.php');
$q = $_REQUEST["q"];

// Initialize arrays to hold data from both tables
$descriptions = [];
$productCalculationData = [];
$lengths = [];  // This will store length data

// Query 1: Fetch from finishGoods (description, rate, and unit for each description)
$sql1 = "SELECT * FROM finishGoods WHERE groupName = '$q'";
$result1 = $conn->query($sql1);

while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
    $descriptions[] = [
        'description' => $row1['description'],
        'rate' => $row1['Rate'],
        'unit' => $row1['Unit']
    ];
}

// Query 2: Fetch from another table for lengths based on productCat
$sql2 = "SELECT length FROM quantityData WHERE prodCat = '$q'"; // Replace 'lengthTable' with your actual table name
$result2 = $conn->query($sql2);

while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
    $lengths[] = $row2['length'];
}

// Send JSON response with data from both tables
$response = [
    "descriptions" => $descriptions,
    "lengths" => $lengths // Send lengths as a separate field
];

echo json_encode($response);

?>
