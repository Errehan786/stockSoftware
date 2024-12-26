<?php
include_once('config.php');
include_once('include/auth.php');

// Fetch 'q' and 'pvcDescription' parameters from request
$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : '';

// Initialize array to hold data from productCalculation table
$productCalculationData = [];

// Query: Fetch from productCalculation and filter by pvcDescription
$sql2 = "SELECT * FROM goodsRawMetrial WHERE voucherNo = '$q'";
file_put_contents('query_log.txt', "SQL Query: $sql2\n", FILE_APPEND);

try {
    $result2 = $conn->query($sql2);

    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        $productCalculationData[] = $row2;
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
    exit();
}

// Send JSON response with data from productCalculation table
$response = [
    "productCalculation" => $productCalculationData
];

echo json_encode($response);
?>
