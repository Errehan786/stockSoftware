<?php
include("config.php");
if(isset($_POST['v_name'])){
    $v_name = $_POST['v_name'];
    $sql = "INSERT INTO `goodsGroup`(`name`) VALUES ('$v_name')";
    if($conn->exec($sql)){
       //sel all vendor list
       $sl_vendor_list = "SELECT * FROM `goodsGroup`";
       $vendorList_Q = $conn->query($sl_vendor_list);
       $dataList = '<select id="vendorList" name="vendor_name" class="form-select" onChange="createVendor(this.value)" required><option value="">Select Group</option>';
       while($data = $vendorList_Q->fetch(PDO::FETCH_ASSOC)){
          $dataList .= '<option value="'.$data['id'].'">'.$data['name'].'</option>';
       }
      $dataList .= '<optgroup label="For a new vendor"></optgroup><option>Add New</option></select>'; 
      echo $dataList;
    }else{
        echo 0;
    }
}
?>