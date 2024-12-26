<?php
include_once('config.php');

// Check if group_name is passed
if (isset($_POST['group_name']) && !empty($_POST['group_name'])) {
    $groupName = $_POST['group_name'];
    //echo "SELECT * FROM rawMeterial WHERE groupName = '$groupName'";
    // Prepare a query to fetch materials by group name
    $stmt = $conn->query("SELECT * FROM rawMeterial WHERE groupName = '$groupName'");

    $sr = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <td>' . $sr . '</td>
                <td>' . htmlspecialchars($row['groupName']) . '</td>
                <td>' . htmlspecialchars($row['description']) . '</td>
                <td>' . htmlspecialchars($row['openingStock']) . '</td>
                <td>' . htmlspecialchars($row['unit']) . '</td>
                <td>' . htmlspecialchars($row['pcs']) . '</td>
                <td>' . htmlspecialchars($row['rate']) . '</td>
                <td>
                    <div class="d-flex gap-2">
                        <div class="edit">
                            <a href="rawMaterialEdit.php?editMetrialId=' . $row['id'] . '" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                        </div>
                        <div class="remove">
                            <a href="?metrialId=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                        </div>
                    </div>
                </td>
            </tr>';
        $sr++;
    }
}
?>
