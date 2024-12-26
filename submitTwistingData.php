<?php
include("config.php");

if(isset($_POST['t_name'])) {
    // Get form inputs
    $t_name = $_POST['t_name'];

    // Insert both type and amount into the database
    $sql = "INSERT INTO `twisting_tbl`(`name`) VALUES ('$t_name')";

    if($conn->exec($sql)){
        // Retrieve updated vendor list after insertion
        $sl_vendor_list = "SELECT * FROM `twisting_tbl`";
        $vendorList_Q = $conn->query($sl_vendor_list);

        // Build updated twisting list HTML
            $dataList = '<select id="twistingList" name="twisting_name" class="form-select" onChange="createTwisting(this.value)" required>
                            <option value="">Select Twisting</option>';
        
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
