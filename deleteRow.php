<?php
// Database connection
include("config.php");

// Check if 'id' is set and is an integer
if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $id = intval($_POST['id']);

    // Prepare SQL query to delete the row with the given id
    $query = "DELETE FROM `productCalculation` WHERE id=:id";
    $stmt = $conn->prepare($query);
    
    try {
        $stmt->execute([':id' => $id]);
        // Check if the row was successfully deleted
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Row not found or already deleted']);
        }
    } catch (Exception $e) {
        // Return an error message if something goes wrong
        echo json_encode(['success' => false, 'message' => 'Error deleting row: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}
?>
