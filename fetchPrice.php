<?php
include("config.php");

if(isset($_POST['type'])) {
    // Get form inputs
    $type = $_POST['type'];

    $sl_vendor_list = "SELECT * FROM `type_tbl` where type='$type'";
    $vendorList_Q = $conn->query($sl_vendor_list);
    $response = ['price' => ''];
    if ($row = $vendorList_Q->fetch(PDO::FETCH_ASSOC)) {
        $response['price'] = $row['price'];
    }

    echo json_encode($response);
    } else {
        // If insertion fails, return 0 as the error response
        echo 0;
    }
?>
