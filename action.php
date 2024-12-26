<?php
include('config.php');
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deletePurchageEntryChild"){
    $pur_ent_child_Q = $conn->query("DELETE FROM `new_item` WHERE id='$_REQUEST[rid]'");
    if($pur_ent_child_Q)echo 1;else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteManufactureBatchChild"){
    $pur_ent_child_Q = $conn->query("DELETE FROM `product_batch_sub_iteam` WHERE id='$_REQUEST[rid]'");
    if($pur_ent_child_Q){
        $raw_material_product_Q = $conn->query("DELETE FROM `raw_material_overview` WHERE batch_sub_id='$_REQUEST[rid]'");
        echo 1;
    }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="updatePurchageEntrySts"){
    $delivery_date = date('Y-m-d');
    $pur_ent_status_Q = $conn->query("UPDATE `purchase_entry` SET status='$_REQUEST[status]',delivery_date='$delivery_date' WHERE id='$_REQUEST[rid]'");
    //update child data
    $conn->query("UPDATE `new_item` SET delivery_date='$delivery_date' WHERE items_id='$_REQUEST[rid]'");
    if($pur_ent_child_Q)echo 1;else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteParentRow"){
    
    //CHK parent 
    /*
    $pa_data_Q = "SELECT items_id FROM `new_item` WHERE items_id={$_POST['rid']}";
    $parentData = $conn->query($pa_data_Q);
    if($parentData->rowCount()>0){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>First delete child data.</h6>
      </div>';
    }else{
    */ 
    $sql_child_Q = "DELETE FROM `new_item` WHERE items_id={$_POST['rid']}";
    $conn->exec($sql_child_Q);
        
    $sql = "DELETE FROM `purchase_entry` WHERE id={$_POST['rid']}";
    if($conn->exec($sql)){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data deleted successfully.</h6>
      </div>';
    }else{
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>No record found.</h6>
      </div>';
    }
   
        
    //}
  echo $messageAction;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteManufactureBatchRow"){
    //CHK parent data
    $pa_data_Q = "SELECT batch_id FROM `product_batch_sub_iteam` WHERE batch_id={$_POST['rid']}";
    $parentData = $conn->query($pa_data_Q);
    if($parentData->rowCount()>0){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>First delete child data.</h6>
      </div>';
    }else{
    $sql = "DELETE FROM `product_batch` WHERE id={$_POST['rid']}";
    if($conn->exec($sql)){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data deleted successfully.</h6>
      </div>';
    }else{
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>No record found.</h6>
      </div>';
    }
   }
  echo $messageAction;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteParentFormulaRow"){
    //CHK parent data
    $pa_data_Q = "SELECT formula_id FROM `formula_sub_items` WHERE formula_id={$_POST['rid']}";
    $parentData = $conn->query($pa_data_Q);
    if($parentData->rowCount()>0){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>First delete child data.</h6>
      </div>';
    }else{
    $sql = "DELETE FROM `formula_entry` WHERE id={$_POST['rid']}";
    if($conn->exec($sql)){
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data deleted successfully.</h6>
      </div>';
    }else{
      $messageAction = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>No record found.</h6>
      </div>';
    }
   }
  echo $messageAction;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteCategoryRow"){
      $delete_data = "DELETE FROM `category` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteProductRow"){
      $delete_data = "DELETE FROM `products` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteOrderSheetRow"){
      $delete_data = "DELETE FROM `order_sheet` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteItemRow"){
      $delete_data = "DELETE FROM `items` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteCurrencyRow"){
      $delete_data = "DELETE FROM `currency` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteFormulaEntry"){
      $delete_data = "DELETE FROM `formula_sub_items` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteExpenseEntry"){
      $delete_data = "DELETE FROM `expense_sub_items` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteExpenceRow"){
      $delete_data = "DELETE FROM `expense` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteVendorRow"){
      $delete_data = "DELETE FROM `vendor` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteCustomerRow"){
      $delete_data = "DELETE FROM `customer` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="deleteCustomer"){
      $delete_data = "DELETE FROM `company` WHERE id={$_POST['rid']}";
       if($conn->query($delete_data)){
         echo 1;  
       }else echo 0;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="allItem"){
    $seqNo = $_POST['seqNo'];
    $all_item_Q = $conn->query("SELECT * FROM `items` where user_reg_id='$_SESSION[id]'");
    $listItem = '<div class="d-flex gap-2"><div class="form-group" id="textarea1" style="width:255px"><select id="iteamList'.$seqNo.'" style="width:255px" class="form-select" name="all_item[]" data-choicesdata-choices-sorting="true" onChange="createItem(this.value,'.$seqNo.')" required>';
    $listItem .= '<option value="">Select Item Name</option>'; 
    while($row = $all_item_Q->fetch(PDO::FETCH_ASSOC)){
     $listItem .= '<option name ="itemName" value="'.$row['id'].'">'.$row['item_name']." (".$row['measurement_unit'].")".'</option>';
    }
    $listItem.= '<optgroup label="For a new item"></optgroup><option>Add New</option>'; 
    $listItem .= '</select></div></td><td style="width:100px"><div class="form-group" id="textarea2"><input type="number" class="form-control1" name="quantity[]" id="quantity'.$seqNo.'" placeholder="Enter Qty" style="width: 100px;" required/></div><div class="form-group"><input type="text" class="form-control" name="cost[]" onkeyUp="fillLocalCurrency(this.value,'.$seqNo.')" placeholder="Cost" required /></div><div class="form-group"><input type="text" class="form-control" name="localCurrency[]" placeholder="Local Currency" id="localCurrency'.$seqNo.'" /></div><div class="form-group"><input type="text" class="form-control" name="per_unit_cost_item[]" id="perUnitCost'.$seqNo.'" placeholder="Per/Unit Cost" autocomplete="off" required /></div><div class="form-group" id="batchNo"><input type="text" class="form-control" name="batchNo[]" placeholder="Batch No."id="compnayNameinput" /></div><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete">Remove</a></div></div>';
    echo $listItem;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="allProductList"){
    $seqNo=$_POST['seqNo'];
    $all_product_Q = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]' order by id desc");
    $listItem = '<div class="d-flex gap-2"><div class="form-group" id="textarea1" style="width:300px">
    <select class="form-select" name="product_id[]" id="all_product'.$seqNo.'" onchange="getProduct(this.value,'.$seqNo.')" data-choicesdata-choices-sorting="true" required>';
    $listItem .= '<option value="">Select Product</option>'; 
    while($row = $all_product_Q->fetch(PDO::FETCH_ASSOC)){
     $listItem .= '<option value="'.$row['id'].'">'.$row['product_name'].'</option>';
    }
    $seqNo = $_POST['seqNo'];
    $listItem .= '</select></div></td><td style="width:100px"><div class="form-group" id="textarea2"><input type="number" class="form-control1" onkeyUP="getProQty(this.value,'.$seqNo.')" name="quantity[]" id="quantity'.$seqNo.'" placeholder="Enter Qty" style="width: 100px;" required/></div><div class="form-group" style="width:240px;"><select class="form-select" name="work_status[]" data-choices="" data-choices-sorting="true" required><option selected="">Work in progress</option><option>Completed</option></select></div><div class="form-group"><input type="text" class="form-control" name="costPerUnit[]" id="costPerUnit'.$seqNo.'"  placeholder="Cost Per Unit" required></div><div class="form-group"><input type="text" class="form-control" name="totalCost[]" id="totalCost'.$seqNo.'" placeholder="Total Cost" required></div><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete">Remove</a></div></div>';
    echo $listItem;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="allOrderSheetProductList"){
    $seqNo=$_POST['seqNo'];
    $all_product_Q = $conn->query("SELECT * FROM `products` where user_reg_id='$_SESSION[id]' order by id desc");
    $listItem = '<div class="d-flex gap-2"><div class="form-group" id="textarea1" style="width:550px">
    <select class="form-select" name="product_id[]" id="product_id'.$seqNo.'" style="width: 200px;" data-choicesdata-choices-sorting="true" required>';
    $listItem .= '<option value="">Select Product</option>'; 
    while($row = $all_product_Q->fetch(PDO::FETCH_ASSOC)){
     $listItem .= '<option value="'.$row['id'].'">'.$row['product_name'].'</option>';
    }
    $seqNo = $_POST['seqNo'];
    $listItem .= '</select></div><input type="text" class="form-control" onkeyup="getAvailability(this.value,'.$seqNo.')" name="qty[]" placeholder="Enter Qty"/><div style="text-align: center;font-size: 9px;" id="availabilityMsg'.$seqNo.'"></div><select class="form-control" name="status[]" required><option value="">Select Availability</option><option>Work in progress</option><option>Completed</option><option>Pending</option><option>In stock</option></select><input type="text" class="form-control" name="cost[]" placeholder="Cost" /><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete" style="height:30px;">Remove</a></div></div>';
    echo $listItem;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="checkOrderList"){
    $customerId=$_POST['customerId'];
    $result_sl_customer = $conn->query("SELECT id,order_ID FROM `order_sheet` where user_reg_id='$_SESSION[id]' and customer_name='$customerId' and delivery_status!='Delivered'");
    if($result_sl_customer->rowCount()>0){
      $rowId = $result_sl_customer->fetch(PDO::FETCH_ASSOC);  
      echo "<span class='badge badge-soft-danger text-uppercase'>Already Order Taken, Order Id: $rowId[order_ID] </span><br><a href='editOrderSheet.php?productnewid=$rowId[id]' target='_blank'>Click for Checking</a>";
    }
 }    
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="checkProductAvailability"){
    $productID=$_POST['productId'];
    $quantity=$_POST['quantity'];
    
    $productReserve=0;     
    //sel pre order for customer
    $sl_all_product_Q = $conn->query("select batch_id from `product_batch_sub_iteam` where product_id='$productID' and work_status='Completed'");
        while($rdata = $sl_all_product_Q->fetch(PDO::FETCH_ASSOC)){
            $sl_pre_order_Q = $conn->query("select purpose,id from `product_batch` where id='$rdata[batch_id]'");
            $proData=$sl_pre_order_Q->fetch(PDO::FETCH_ASSOC);
            if($proData['purpose']=="Pre order from customer"){
                $sel_reserve_Q = $conn->query("SELECT quantity from `product_batch_sub_iteam` where batch_id='$proData[id]'");
                $reserve_data = $sel_reserve_Q->fetch(PDO::FETCH_ASSOC);
                $productReserve += $reserve_data['quantity'];
            }
        }
                           
    //sel product all data
    $sql_all_pro = $conn->query("SELECT *,(select SUM(quantity) from `product_batch_sub_iteam` where work_status='Work in progress' and product_id='$productID') underManufacturing,(select SUM(qty) from `sub_order_list` where product_id='$productID') soldProduct,(select SUM(quantity) from `product_batch_sub_iteam` where work_status='Completed' and product_id='$productID') ProductManufactured FROM `products` where id='$productID' order by id");
    $proDta = $sql_all_pro->fetch(PDO::FETCH_ASSOC);
        if(empty($proDta['ProductManufactured']))$ProductManufactured_1=0;else $ProductManufactured_1=$proDta['ProductManufactured'];
        if(empty($proDta['soldProduct']))$soldProduct_1=0;else $soldProduct_1=$proDta['soldProduct'];
        $totalProductQtyAvailability = $ProductManufactured_1-$soldProduct_1-$productReserve;
    
    if($quantity>$totalProductQtyAvailability)echo "<span class='badge badge-soft-danger text-uppercase'>Not Available</span>";
    else echo "<span class='badge badge-soft-success text-uppercase'>Available</span>";
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="getUnit"){
    $all_category_Q = $conn->query("SELECT * FROM `category` WHERE id='$_POST[categoryID]'");
    $categoryData = $all_category_Q->fetch(PDO::FETCH_ASSOC);
    
    $listItem = '<div class="col-lg-4">
                       <div class="mb-3">
						<label class="form-label">Measurement Unit</label>
						<select id="ForminputState" name="measurement_unit" onChange="checkUnit(this.value)" class="form-select" required>
							<option>'.$categoryData['Measuring_Units'].'</option>
						</select>
					</div>
				 </div>'; 
	
	if($categoryData['Measuring_Units']=="Grams" || $categoryData['Measuring_Units']=="kg"){
	  $listItem .='<div id="weightEachUnit" style="display:none"><div class="col-lg-4" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required="">Weight Of Each Unit(In Grams)</label><input type="number" class="form-control" name="weight_unit" placeholder="Enter Weight Of Each Unit In Grams" autocomplete="off"></div></div></div>';
	}else{
	  $listItem .='<div id="weightEachUnit" style="display:contents"><div class="col-lg-4" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required="">Weight Of Each Unit(In Grams)</label><input type="number" class="form-control" name="weight_unit" placeholder="Enter Weight Of Each Unit In Grams" autocomplete="off" required></div></div></div>';  
	}
    
    echo $listItem;
 }
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="getUnitProductMakingPrice"){
      $productID = $_POST['productID'];
      $all_data = $conn->query("SELECT SUM(item_cost) as totalUnitProCost FROM `product_sub_item` WHERE product_id={$productID}");
      $productData =  $all_data->fetch(PDO::FETCH_ASSOC);
      
      $sl_formulaID_Q = $conn->query("select formula_name from `products` where id='$productID'");
      $sl_formulaID = $sl_formulaID_Q->fetch(PDO::FETCH_ASSOC);
       //sel expenses
      $totalExpense=0; 
	  $sl_expenses_Q = $conn->query("select * from `expense_sub_items` where formula_id='$sl_formulaID[formula_name]'");
	  while($data = $sl_expenses_Q->fetch(PDO::FETCH_ASSOC)){
		$expenseData = $conn->query("select * from `expense` where id='$data[expense_id]'");
		$expdataIs = $expenseData->fetch(PDO::FETCH_ASSOC);
		$totalExpense += $expdataIs['cost'];
	  }
      
      echo $productData['totalUnitProCost']+$totalExpense;
 } 
 
 if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action']=="calTotalProPrice"){
      $getProductQty = $_POST['getProductQty'];
      $unitProductPrice = $_POST['unitProductPrice'];
      $totalPriceCal = $getProductQty*$unitProductPrice;
      echo number_format($totalPriceCal, 2, '.', '');
 }  
?>