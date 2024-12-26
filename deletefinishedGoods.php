<?php
// Database connection
include("config.php");

// Check if 'id' is set and is a valid integer
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Simple integer sanitization

    // Start by selecting qtyPack and other details
    $selectQuery = "SELECT qtyPack, groupName, description, length FROM goodsRawMetrial WHERE id = $id";
    $selectResult = $conn->query($selectQuery);

    if ($selectResult->rowCount()>0) {
        $row = $selectResult->fetch(PDO::FETCH_ASSOC);
        // Extract values from the selected row
        $qtyPack = $row['qtyPack'];
        $groupName = $row['groupName'];
        $description = $row['description'];
        $length = $row['length'];

        // Update quantity in quantityData table based on selected values
        $updateQuery = "UPDATE quantityData 
                        SET quantity = quantity + $qtyPack 
                        WHERE prodCat = '$groupName' 
                        AND description = '$description' 
                        AND length = '$length' 
                        LIMIT 1";
        $updateResult = $conn->query($updateQuery);

        // Check if the update was successful
        if ($updateResult) {
            // Proceed to delete the row from goodsRawMetrial table
            $deleteQuery = "DELETE FROM goodsRawMetrial WHERE id = $id";
            $deleteResult = $conn->query($deleteQuery);

            // Check if the row was successfully deleted
            if ($deleteResult) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting row: Row not found or already deleted']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed: Row not found in quantityData or no rows affected']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Row not found in goodsRawMetrial']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}
?>
