<?php
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="formulaIs"){
    include('config.php');
    $formula_data_Q = $conn->query("SELECT * FROM `formula_sub_items` WHERE formula_id='$_REQUEST[formulaID]'");
    if($formula_data_Q->rowCount()>0){
    $flist = '';
    ?>
<?php
	$flist ='<div class="col-12">
		<div class="table-responsive table-card mt-3 mb-1">
			<table class="table align-middle table-nowrap" id="customerTable">
				<thead class="table-light">
					<tr>
						<th>Category</th>
						<th>Item</th>
						<th>Qty</th>
						<th>Select Date</th>
						<th>Unit Price</th>
						<th>Cost of Item</th>
					</tr>
				</thead>
				<tbody class="list form-check-all">';
	            $r=1;$totalProductCost=0;
				while($row = $formula_data_Q->fetch(PDO::FETCH_ASSOC)){
				        $perUnitCost = '';
						$categoryName = $row['category'];
						$sql1 = "SELECT Category_Name,percentage,Measuring_Units,id FROM `category` WHERE id='$categoryName' and user_reg_id='$_SESSION[id]'";
						$result1 = $conn->query($sql1);
						$row1 = $result1->fetch(PDO::FETCH_ASSOC);
						$itemName = $row['Item'];
						$sql2 = "SELECT item_name FROM `items` WHERE id='$itemName' and user_reg_id='$_SESSION[id]'";
						$result2 = $conn->query($sql2);
						$row2 = $result2->fetch(PDO::FETCH_ASSOC);
					 //sel date as raw matrial	
					$sl_date_r_mat_Q = $conn->query("select id,date from `new_item` where item_name='$itemName' and user_reg_id='$_SESSION[id]' AND qty>0");
					//sel item data
					$sl_item_mat_Q = $conn->query("select * from `items` where category='$row1[id]'");
					
					if($row1['percentage']=="Yes"){
					    $pr=" (".$row['qty']." %)";
					    $itemQty = $_REQUEST['productWeight']*$row['qty']/100;
					    $UnitIn =" gram";
					 }
					 
					 if($row1['percentage']=="No"){
					    $pr=" (".$row['qty']." ".$row1['Measuring_Units'].")"; 
					    $itemQty = $row['qty'];
					    $UnitIn = $row1['Measuring_Units'];
					 } 
					
					$flist .='<tr>
					   <td><input type="hidden" value="'.$row1['Category_Name'].'" name="categoryType[]">
					   <input type="hidden" value="'.$row1['percentage'].'" name="categoryIn[]">' . $row1['Category_Name']. '</td>
					   <td><select class="form-control" name="item[]" required=""">';
					   while($dateItem = $sl_item_mat_Q->fetch(PDO::FETCH_ASSOC)){
					     $flist .='<option>'.$dateItem['item_name']." - ".$dateItem['measurement_unit'].$pr.'</option>';
				       }
					   $flist .='</select>
					   </td>
					   <td><input type="hidden" class="form-control" value="'.$itemQty.'" id="item_qty'.$r.'" name="item_qty[]">'.$itemQty." ".$UnitIn.'</td>
					   <td><select class="form-control" name="chooseDate[]" required="" onChange="getDateId(this.value,'.$r.')">
					   <option value="">Select Date</option>';
					   while($dateAvailable = $sl_date_r_mat_Q->fetch(PDO::FETCH_ASSOC)){
					     $flist .='<option value="'.$dateAvailable['id'].'">'.$dateAvailable['date'].'</option>';
				       }
					   
					   $flist .='</select></td>
					   <td><input type="text" class="form-control" name="costPerUnit[]" id="costPerUnit'.$r.'" placeholder="Unit Cost" value="'.$perUnitCost.'" autocomplete="off" required=""></td>
					   <td><input type="text" class="form-control" name="itemCost[]" id="totalcostManufacturing'.$r.'" placeholder="Item Cost" autocomplete="off" required=""></td>
					  </tr>';
					  $r++;
					 } 
					 
					 //sel expenses
					  $sl_expenses_Q = $conn->query("select * from `expense_sub_items` where formula_id='$_REQUEST[formulaID]'");
					  $totalExpense=0;
					  while($data = $sl_expenses_Q->fetch(PDO::FETCH_ASSOC)){
					      $expenseData = $conn->query("select * from `expense` where id='$data[expense_id]'");
					      $expdataIs = $expenseData->fetch(PDO::FETCH_ASSOC);
					      $totalExpense += $expdataIs['cost'];
					      $flist .='<tr><td>Expense</td><td colspan="4">'.$expdataIs['name'].'</td><td><input type="text" name="expense[]" class="form-control" value="'.$expdataIs['cost'].'"></td></tr>'; 
					  }
				   $flist .='<tr><td colspan="5">Cost of Product</td><td><input type="text" readonly class="form-control" value="'.$totalExpense.'" id="totalitemCost"></td></tr>'; 	 
				   $flist .='</tbody>
					 </table>';
				echo $flist;
    }else echo 0;
 }
 
 //show calculation
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="getRowMatrial"){
    include('config.php'); 
    $get_raw_data_Q = $conn->query("SELECT * FROM `new_item` WHERE items_id='$_REQUEST[dateID]'");
    if($get_raw_data_Q->rowCount()>0){
       echo 10; 
    }else echo 0;
 }
 
 //get unit price and item 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="getPriceRaw"){
    include('config.php'); 
    $get_raw_data_Q = $conn->query("SELECT per_unit_cost_item FROM `new_item` WHERE id='$_REQUEST[selrowID]'");
    if($get_raw_data_Q->rowCount()>0){
       $dataIS =  $get_raw_data_Q->fetch(PDO::FETCH_ASSOC);  
       $itemPrice = $dataIS['per_unit_cost_item']*$_REQUEST['itemWeight'];
       $totalitemCost = $_REQUEST['totalitemCost']+$itemPrice;
       echo $dataIS['per_unit_cost_item']."M*M".$itemPrice."M*M".$totalitemCost; 
    }else echo 0;
 }
?>
