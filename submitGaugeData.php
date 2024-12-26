<?php
include("config.php");

if(isset($_POST['g_name'])) {
    // Get form inputs
    $g_name = $_POST['g_name'];

    // Insert both type and amount into the database
    $sql = "INSERT INTO `gauge_tbl`(`name`) VALUES ('$g_name')";

    if($conn->exec($sql)){
        // Retrieve updated vendor list after insertion
        $sl_vendor_list = "SELECT * FROM `gauge_tbl`";
        $vendorList_Q = $conn->query($sl_vendor_list);

        // Build updated gauge list HTML
            $dataList = '<select id="gaugeList" name="gauge_name" class="form-select" onChange="createGauge(this.value)" required>
                            <option value="">Select Gauge</option>';
        
        // Loop through and populate the options
        while($data = $vendorList_Q->fetch(PDO::FETCH_ASSOC)){
            $dataList .= '<option value="'.$data['id'].'">'.$data['name'].'</option>';
        }

        $dataList .= '<optgroup label="For a new vendor"></optgroup><option>Add New</option></select>'; 

        // Return the updated vendor list as a response
        echo $dataList;
    } else {
        // If insertion fails, return 0 as the error response
        echo 0;
    }
}
?>
