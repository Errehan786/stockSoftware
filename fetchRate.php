<?php
include("config.php");

if (isset($_POST['description_id'])) {
    $descriptionId = $_POST['description_id'];

    // Prepare and execute the query to fetch the data based on description ID
    $sql = "SELECT * FROM `rawMeterial` WHERE id = :description_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':description_id', $descriptionId, PDO::PARAM_INT);
    $stmt->execute();

    $response = [];
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response = [
            'inner' => $row['inner'],
            'middle' => $row['middle'],
            'sheater' => $row['sheater'],
            'mb' => $row['mb'],
            'other1' => $row['other1'],
            'other2' => $row['other2'],
            'price' => $row['price']
        ];
    }

    echo json_encode($response);
} else {
    echo json_encode([]);
}
?>
