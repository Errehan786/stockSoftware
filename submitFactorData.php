<?php
include("config.php");

if(isset($_POST['f_name'])) {
    // Get form inputs
    $f_name = $_POST['f_name'];

    // Insert both type and amount into the database
    $sql = "INSERT INTO `factor_tbl`(`name`) VALUES ('$f_name')";

    if($conn->exec($sql)){
        // Retrieve updated vendor list after insertion
        $sl_vendor_list = "SELECT * FROM `factor_tbl`";
        $vendorList_Q = $conn->query($sl_vendor_list);

        // Build updated vendor list HTML
        // Build updated factor list HTML
            $dataList = '<select id="factorList" name="factor_name" class="form-select" onChange="createFactor(this.value)" required>
                            <option value="">Select Factor</option>';
        
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
