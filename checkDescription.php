<?php
include_once('config.php');
include_once('include/auth.php');

// Fetch pvcDescription from GET request
$pvcDescriptionData = isset($_GET['pvcDescriptionData']) ? $_GET['pvcDescriptionData'] : '';

if (empty($pvcDescriptionData)) {
    echo json_encode(["error" => "No description provided"]);
    exit();
}

// Prepare the SQL statement
$sqlCheck = "SELECT * FROM productCalculation WHERE pvcDescription = :pvcDescription";
$stmt = $conn->prepare($sqlCheck);
$stmt->bindParam(':pvcDescription', $pvcDescriptionData);

try {
    $stmt->execute();

    // Check if any rows are found
    if ($stmt->rowCount() > 0) {
        echo json_encode(["exists" => true]);
    } else {
        echo json_encode(["exists" => false]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>
