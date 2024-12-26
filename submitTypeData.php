<?php
include("config.php");

if (isset($_POST['v_name']) && isset($_POST['amount'])) {
    $v_name = $_POST['v_name'];
    $amount = $_POST['amount'];

    // Insert both the type and the amount into the database
    $sql = "INSERT INTO `type_tbl`(`type`, `price`) VALUES ('$v_name', '$amount')";
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
