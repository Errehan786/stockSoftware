<?php
include 'config.php';
$q=$_REQUEST["q"];
$sql="SELECT * FROM `items` WHERE category= '".$q."'";
$result = $conn->query($sql);
?> 
  <select class="form-select" id="iteamList" name="all_item[]" onchange="createItem(this.value)" data-choices="" data-choices-sorting="true" required="">
    <option value="" selected="selected">Select Item</option>
    <?php
	 while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
    ?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['item_name']." - ".$row['measurement_unit'];?></option>
      <?php } ?>
  </select>

