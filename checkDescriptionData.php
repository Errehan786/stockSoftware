<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_POST['description'])) {
    $description = $_POST['description'];

    // Prepare and execute a query to check if the description exists
    $stmt = $conn->prepare("SELECT * FROM finishGoods WHERE description = :description");
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Return unit and table data as a JSON response
        echo json_encode([
            'status' => 'success',
            'tableData' => [
                'unit' => $result['Unit'],
                'type' => $result['type'],
                'factor' => $result['factor'],
                'stand' => $result['strand'],
                'gauge' => $result['guage'],
                'core' => $result['core'],
                'twisting' => $result['twisting'],
                'coil_wt' => $result['coilWt'],
                'length' => $result['length'],
                'stock' => $result['stock'],
                'grade1' => $result['grade1'],
                'grade2' => $result['grade2'],
                'grade3' => $result['grade3'],
                'grade4' => $result['grade4'],
                'grade5' => $result['grade5'],
                'grade6' => $result['grade6'],
                'percentage1' => $result['percentage1'],
                'percentage2' => $result['percentage2'],
                'percentage3' => $result['percentage3'],
                'percentage4' => $result['percentage4'],
                'percentage5' => $result['percentage5'],
                'percentage6' => $result['percentage6'],
                'metalWt' => $result['metalWt'],
                'metalWt1' => $result['metalWt'],
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data not available']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

?>
