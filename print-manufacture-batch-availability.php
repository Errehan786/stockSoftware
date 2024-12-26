<body onload="window.print1()">
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding:5px;
  text-align:center;
}
@page {
    size: auto;
    margin: 10;
}
</style>
<?php
 if(isset($_REQUEST['action']) && !empty($_REQUEST['action']) && isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
    include('config.php');
    //sel manufacture data
    $batch_manufacture_array_Q = $conn->query("SELECT * FROM `product_batch_sub_iteam` WHERE batch_id='$_REQUEST[id]'");
    $productList = array();
    $itemNameList = array();
    $itemQtyList = array();
    while($data=$batch_manufacture_array_Q->fetch(PDO::FETCH_ASSOC)){
        $productList [] = $data['product_id'];
        //item list
        $item_arr__Q = $conn->query("SELECT * FROM `product_sub_item` WHERE product_id='$data[product_id]'");
        while($itemData = $item_arr__Q->fetch(PDO::FETCH_ASSOC)){
            
        }
    }
    
    //print_r($productList);
    //die();
    
    $batch_manufacture_item_Q = $conn->query("SELECT * FROM `product_batch_sub_iteam` WHERE batch_id='$_REQUEST[id]'");
    ?>
	<table width="100%" border="1">
	  <tr>
		<th scope="col">Product Name</th>
		<th scope="col">Quantity</th>
		<th scope="col">Required Item(s) & Weight</th>
		<th scope="col">Available Weight(s) & Need Weight(s)</th>
		<th scope="col">Availability</th>
	  </tr>
	  <?php while($data = $batch_manufacture_item_Q->fetch(PDO::FETCH_ASSOC)){
		 //sel product name
		 $product__Q = $conn->query("SELECT product_name FROM `products` WHERE id='$data[product_id]'");
		 $productData = $product__Q->fetch(PDO::FETCH_ASSOC);
	  ?>
	  <tr>
		<td style="box-shadow: -1px 4px 5px 0px #44424247;padding-bottom: 5px;">
		<?php echo $productData['product_name']?>
	   </td>
		<td style="box-shadow: -1px 4px 5px 0px #44424247;padding-bottom: 5px;"><?php echo $data['quantity']?></td>
		<td style="box-shadow: -1px 4px 5px 0px #44424247;padding-bottom: 5px;">
		<table border="0" style="width:100%"><?php 
		//item(s) have to required for manufacturing
		$item_req__Q = $conn->query("SELECT * FROM `product_sub_item` WHERE product_id='$data[product_id]'");
		$l=0;
		$lastID = $item_req__Q->rowCount();
		$totalQty = $data['quantity'];
		$totManufacturedQtyItem = 0;
		while($itemData = $item_req__Q->fetch(PDO::FETCH_ASSOC)){
		  $quantityRequired = $totalQty*$itemData['item_qty'];
		  $totManufacturedQtyItem = $totManufacturedQtyItem+$quantityRequired;
		  if($l==0)$bcolor = "border-top-color: #fff;";
		  if($l==($lastID-1))$bcolor = "border-bottom-color: #fff;";
		  if($itemData['category_in']=="Yes")$pr = " gram";else $pr = " Pcs";  
		  echo '<tr><td style="width:70%; border-left-color: #fff;'.$bcolor.'">'.$itemData['item'].'</td><td  style="border-right-color: #fff;'.$bcolor.'">'.$quantityRequired.$pr.'</td></tr>';
		 $l++;   
		}
		?>
	    </table>
		</td>
		<td style="box-shadow: -1px 4px 5px 0px #44424247;padding-bottom: 5px;">
		<table border="0" style="width:100%">
		<?php 
		//item(s) available for manufacturing
		$item_avl__Q = $conn->query("SELECT item_qty,item,category_in FROM `product_sub_item` WHERE product_id='$data[product_id]'");
		$l=0;
		$lastID = $item_avl__Q->rowCount();
		$totAvailabilityItem = 0;
		while($itemData = $item_avl__Q->fetch(PDO::FETCH_ASSOC)){
		    //get id
		    $item_sel_id__Q = $conn->query("SELECT id FROM `items` WHERE item_name='$itemData[item]' and user_reg_id='$_SESSION[id]'");
		    $dataItem = $item_sel_id__Q->fetch(PDO::FETCH_ASSOC);
		    $itemIdIs = $dataItem['id'];
		    //sel sum qty
		    $item_avl_quantity__Q = $conn->query("SELECT SUM(qty) AS itemTotal FROM `new_item` WHERE item_name='$itemIdIs'");
		    $totalAvlQtyData = $item_avl_quantity__Q->fetch(PDO::FETCH_ASSOC);
		    $totalAvlQty = $totalAvlQtyData['itemTotal'];
		    $requiredItemQuantity = $totalQty*$itemData['item_qty'];

		    if(!isset($_SESSION["itemIDs$itemIdIs"]) && empty($_SESSION["itemIDs$itemIdIs"])){
		        if($totalAvlQty>=$requiredItemQuantity){
		           $itemTotalQty = $requiredItemQuantity;     
		           $_SESSION["itemIDs$itemIdIs"]=$totalAvlQty-$requiredItemQuantity; 
		        }else{
		           $_SESSION["itemIDs$itemIdIs"]=0; 
		           $itemTotalQty = $totalAvlQty;
		        }
		    }else{
		        if($_SESSION["itemIDs$itemIdIs"]>=$requiredItemQuantity){
		           $itemTotalQty = $requiredItemQuantity;     
		           $_SESSION["itemIDs$itemIdIs"]=$_SESSION["itemIDs$itemIdIs"]-$requiredItemQuantity; 
		        }else{
		           $itemTotalQty = $_SESSION["itemIDs$itemIdIs"];
		        }
		    }
		    
		    
		  if($l==0)$bcolor = "border-top-color: #fff;";
		  if($l==($lastID-1))$bcolor = "border-bottom-color: #fff;";
		  if($itemData['category_in']=="Yes")$pr = " gram";else $pr = " Pcs";
		  ?>
		
		 <?php
		  $needQuantity = $itemTotalQty-$requiredItemQuantity;
		  if($needQuantity<0)$bgNeedColor = "rgba(240, 101, 72, 0.1)";else $bgNeedColor ='';
		  echo '<tr>
		  <td style="width:50%;border-right-color: #fff;border-left-color: #fff;'.$bcolor.'">'.$itemTotalQty.$pr.'</td>
		  <td style="width:50%;border-right-color: #fff;border-left-color: #fff;'.$bcolor.'"><span style="background-color:'.$bgNeedColor.'">'.$needQuantity.$pr.'</span></td></tr>';
		 $totAvailabilityItem = $totAvailabilityItem+$itemTotalQty; 
		 $l++;   
		}
		?>
	    </table>
		</td>
		
		<td style="box-shadow: -1px 4px 5px 0px #44424247;padding-bottom: 5px;">
		 <?php if($totAvailabilityItem==$totManufacturedQtyItem){?>
		 <span class="badge badge-soft-success d-none text-uppercase" style="color: #0ab39c;background-color: rgba(10, 179, 156, 0.1);padding: 0.35em 0.65em;font-size: .75em;font-weight: 600;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25rem;
">Available</span> 
		 <?php }else{?>
		 <span class="badge badge-soft-danger text-uppercase" style="color: #f06548;background-color: rgba(240, 101, 72, 0.1);padding: 0.35em 0.65em;font-size: .75em;font-weight: 600;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25rem;"> Low Available</span> 
		 <?php }?>
	    </td>
	  </tr>
	 <?php }?>
	</table>
	<?php
   }
   
   //print_r($_SESSION);
?>
</body>
