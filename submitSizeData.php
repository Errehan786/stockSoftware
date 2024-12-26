<?php
include("config.php");

if (isset($_POST['size_name']) && isset($_POST['sizeAmount'])) {
    $size_name = $_POST['size_name'];
    $sizeAmount = $_POST['sizeAmount'];

    // Insert both the type and the amount into the database
    $sql = "INSERT INTO `productSize`(`size`, `price`) VALUES ('$size_name', '$sizeAmount')";
    if ($conn->exec($sql)) {
        // Select all vendor list (group) after insertion
        $sl_vendor_list = "SELECT * FROM `group`";
        $vendorList_Q = $conn->query($sl_vendor_list);

        $dataList = '<select id="vendorList" name="vendor_name" class="form-select" onChange="createVendor(this.value)" required>
                      <option value="">Select Group</option>';

        while ($data = $vendorList_Q->fetch(PDO::FETCH_ASSOC)) {
            $dataList .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
        }

        $dataList .= '<optgroup label="For a new vendor"></optgroup><option>Add New</option></select>';
        echo $dataList;
    } else {
        echo 0;
    }
}
?>
