<?php
include_once('config.php');
include_once('include/auth.php');
$q = $_REQUEST["q"];

// Initialize arrays to hold data from both tables
$descriptions = [];
$productCalculationData = [];

// Query 1: Fetch from rawMeterial (description, rate, and unit for each description)
$sql1 = "SELECT description, rate, unit FROM rawMeterial WHERE groupName = '$q'";
$result1 = $conn->query($sql1);

while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
    $descriptions[] = [
        'description' => $row1['description'],
        'rate' => $row1['rate'],
        'unit' => $row1['unit']
    ];
}

// Query 2: Fetch from productCalculation
$sql2 = "SELECT * FROM productCalculation WHERE groupName = '$q'";
$result2 = $conn->query($sql2);

while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
    $productCalculationData[] = $row2;
}

// Send JSON response with data from both tables
$response = [
    "descriptions" => $descriptions,
    "productCalculation" => $productCalculationData
];

echo json_encode($response);
?>
