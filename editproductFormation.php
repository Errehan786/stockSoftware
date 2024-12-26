<?php
include_once('config.php'); 
include_once('include/auth.php');
if(isset($_REQUEST['productnewid'])){
    $sql7 = "SELECT * FROM `products` WHERE id = {$_REQUEST['productnewid']}";
    $result7 = $conn->query($sql7);
    $row7 = $result7->fetch(PDO::FETCH_ASSOC); 
 }

if(isset($_REQUEST['productUpdate'])){
   $productName = $_REQUEST['product_name'];
   $productWeight = $_REQUEST['proWeight'];
   $productDesc = $_REQUEST['product_description'];
   $p_formula = $_REQUEST['p_formula'];
        $sql1 = "UPDATE `products` SET formula_name='$p_formula',product_qty='$productWeight', product_name='$productName',description='$productDesc' WHERE id = {$_REQUEST['productnewid']}";
        if($conn->query($sql1)){
        $orderID = $conn->lastInsertId();
        for($i=0;$i<sizeof($_REQUEST['categoryType']);$i++){
        $categoryType = $_REQUEST['categoryType'][$i];
        $categoryIn = $_REQUEST['categoryIn'][$i];
        $item = $_REQUEST['item'][$i];
        $item_qty = $_REQUEST['item_qty'][$i];
        $chooseDate = $_REQUEST['chooseDate'][$i];
        $costPerUnit = $_REQUEST['costPerUnit'][$i];
        $itemCost = $_REQUEST['itemCost'][$i];
        $sql5 = "UPDATE `product_sub_item` SET item_qty='$item_qty',item_selected_date='$chooseDate',unit_price='$costPerUnit',item_cost='$itemCost',item='$item' WHERE category='$categoryType' AND product_id='$_REQUEST[productnewid]'";
        $result4 = $conn->exec($sql5);
        }
        $msg = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been Updated Successfull</h6>
        </div>';
        ?>
        <script>
        setTimeout(
        function(){
            window.location = "ProductFormation.php"; 
        },
        1000);
        </script>
        <?php
      }else{
        $msg = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data Not Deleted</h6>
        </div>';
      }
    }
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <title>Product Form Entry & List | <?php echo $_SESSION['userName']?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content=" Admin & Dashboard " name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- ========== Header Start ========== -->
        <?php include_once ('include/header.php');?>
        <!-- ========== Header End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        <?php include_once ('include/left-side-menu.php');?>
        <!-- ========== Left Sidebar End ========== -->
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">PRODUCT LIST & ENTRY FORM</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="./dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active">Product</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row" id="newProduct">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Product</h4>
                                </div>
                                <?php
                                if(isset($msg)){
                                    echo $msg;
                                }
                                ?>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Product Name</label>
                                                        <input type="text"class="form-control" name="product_name" value="<?php if(isset($row7['product_name'])){echo $row7['product_name'];}?>" placeholder="Enter Product Name." />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Weight(In Gram)</label>
                                                        <input type="number" class="form-control" name="proWeight" onkeyUp="resetbody()" value="<?php if(isset($row7['product_qty'])){echo $row7['product_qty'];}?>" id="proWeight" placeholder="Enter Weight(In Gram)" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 d-none d-lg-block">
                                                <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text"class="form-control" name="product_description" value="<?php if(isset($row7['description'])){echo $row7['description'];}?>" placeholder="Enter Description" />
                                                    </div>
                                                </div>
                                                <?php
                                                $formulaID = $row7['formula_name'];
                                                $sql8 = "SELECT * FROM formula_entry";
                                                $result8 = $conn->query($sql8);
                                                ?>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="firstNameinput" class="form-label">Formula name</label>
                                                        <select id="ForminputState" name="p_formula" class="form-select text-start" onChange="getFormulaData(this.value)" required>
                                                            <?php
                                                            $formularSet ='<option value="">Select Formula</option>';
                                                            while($formula_row = $result8->fetch(PDO::FETCH_ASSOC)){
                                                             $formularSet .='<option value="'.$formula_row['id'].'">'.$formula_row['formula_name'].'</option>';    
                                                            ?>
                                                            <option value="<?php echo $formula_row['id']?>"<?php if($formula_row['id']==$formulaID)echo "selected"?>><?php if(isset($formula_row['formula_name'])){echo $formula_row['formula_name'];}?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                            <script>
                            function resetbody(){
                             document.getElementById('formulaBody').innerHTML=''; 
                             document.getElementById('ForminputState').innerHTML='<?php echo $formularSet?>';
                            }
                            
							function getFormulaData(getFormula){
							    var productWeight = document.getElementById("proWeight").value;
							    if(productWeight!=''){
								var myData = "formulaID="+getFormula+'&productWeight='+productWeight+'&action=formulaIs';
									//alert(myData);
									jQuery.ajax({
									 type: "POST", // HTTP method POST or GET
									 url: "getData.php", //Where to make Ajax calls
									   dataType:"text", // Data type, HTML, json etc.
									   data:myData, //Form variables
									success:function(response){
									//alert(response);
									if(response==0){
									  $("#formulaList").html('<span style="color: red;"> No recound found!</span>');
									}else{
									 document.getElementById("formulaList").innerHTML=response;
									 }
									},

									error:function (xhr, ajaxOptions, thrownError){
									reg("#submitbtn").show(); //show submit button
									reg("#LoadingImage").hide(); //hide loading image
										alert(thrownError);
									 }
									});
						    	}else{
						    	  document.getElementById("proWeight").focus();  
						    	}
							  }	
						    	
						    function getDateId(getStr,seNo){
						      var productWeight = document.getElementById("proWeight").value;
						      if(productWeight!='' && getStr!=''){
						      var totalitemCost = document.getElementById("totalitemCost").value;
						      var itemWeight = document.getElementById("item_qty"+seNo).value;
						      if(totalitemCost=='')totalitemCost=0;
						      var myData = "selrowID="+getStr+"&seNo="+seNo+'&itemWeight='+itemWeight+'&totalitemCost='+totalitemCost+'&action=getPriceRaw';
						      //alert(myData);
						      jQuery.ajax({
									 type: "POST", // HTTP method POST or GET
									 url: "getData.php", //Where to make Ajax calls
									   dataType:"text", // Data type, HTML, json etc.
									   data:myData, //Form variables
									success:function(response){
									   var expValue = response.split("M*M"); 
									   document.getElementById("costPerUnit"+seNo).value = expValue[0];
									   document.getElementById("totalcostManufacturing"+seNo).value = expValue[1];
									   document.getElementById("totalitemCost").value = expValue[2];
									},

									error:function (xhr, ajaxOptions, thrownError){
									reg("#submitbtn").show(); //show submit button
									reg("#LoadingImage").hide(); //hide loading image
										alert(thrownError);
									 }
									});
						      }
						    }	
						</script>
                                                
                                                <div class="col-12" id="formulaList">
                                                    <div class="table-responsive table-card mt-3 mb-1">
                                                        <table class="table align-middle table-nowrap" id="customerTable">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Category</th>
                                                                    <th>Item</th>
                                                                    <th>Qty</th>
                                                                    <th>Selected Date</th>
                                                                    <th>Unit Price</th>
                                                                    <th>Cost of Item</th>
                                                                    <!--<th>Action</th>-->
                                                                </tr>
                                                                <?php
                                                                $sql_sub_formula_Q = "SELECT * FROM `formula_sub_items` WHERE formula_id = {$formulaID}";
                                                                $formula_data_Q = $conn->query($sql_sub_formula_Q);
                                                                ?> 
                                                            </thead>
                                                            <tbody class="list form-check-all" id="formulaBody">
                                                               <?php
                                                               $flist ='';
                                                               $k=1;
                                                               $itemTotal=0;
                                                               while($row = $formula_data_Q->fetch(PDO::FETCH_ASSOC)){
                                                                    $categoryName = $row['category'];
                                                                    $sql1 = "SELECT id,Category_Name,percentage FROM `category` WHERE id='$categoryName'";
                                                                    $result1 = $conn->query($sql1);
                                                                    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                                                                    $itemName = $row['Item'];
                                                                    $sql2 = "SELECT item_name FROM `items` WHERE id='$itemName'";
                                                                    $result2 = $conn->query($sql2);
                                                                    $row2 = $result2->fetch(PDO::FETCH_ASSOC);
                                                                    
                                                                  //sel sub formula data
                                                                    $sel_sub_formula_Q = $conn->query("SELECT * FROM `product_sub_item` WHERE product_id='$_REQUEST[productnewid]' AND category='$row1[Category_Name]'");
                                                                    $itemUseData = $sel_sub_formula_Q->fetch(PDO::FETCH_ASSOC);
                                                                    $itemTotal = $itemTotal+$itemUseData['item_cost'];
                                                                  //sel date
                                                                    $sel_date_Q = $conn->query("SELECT id,date FROM `new_item` WHERE item_name='$itemName' AND qty>0");
                                                                  //sel item data
					                                              $sl_item_mat_Q = $conn->query("select * from `items` where category='$row1[id]'");    
                                                                    
                                                                    if($row1['percentage']=="Yes"){
					                                                  $pr=" (".$row['qty']." %)";
					                                                  $itemQty = $row7['product_qty']*$row['qty']/100;
					                                                  $UnitIn =" gram";
					                                                 }else{
					                                                  $pr=" (".$row['qty']." Pcs)"; 
					                                                  $itemQty = $row['qty'];
					                                                  $UnitIn =" pcs";
					                                                }
                                                                     
                                                                $flist .='<tr>
                                                                    <td>
                                                                    <input type="hidden" value="'.$row1['Category_Name'].'" name="categoryType[]">
					                                                <input type="hidden" value="'.$row1['percentage'].'" name="categoryIn[]">' . $row1['Category_Name'] . '</td>
                                                                    <td><select class="form-control" name="item[]" required=""">';
					                                                  while($dateItem = $sl_item_mat_Q->fetch(PDO::FETCH_ASSOC)){
					                                                      if($dateItem['item_name']==$itemUseData['item'])$selectedSts="selected";else $selectedSts='';
					                                                      $flist .='<option value="'.$dateItem['item_name'].'" '.$selectedSts.'>'.$dateItem['item_name'].$pr.'</option>';
				                                                       }
					                                                 $flist .='</select>
                                                                    </td>
                                                                    <td><input type="hidden" class="form-control" value="'.$itemQty.'" name="item_qty[]">'.$itemQty." ".$UnitIn.'</td>
                                                                    <td><select class="form-control" name="chooseDate[]" onchange="getDateId(this.value,'.$k.')" required="">';
                                                                    while($DateName = $sel_date_Q->fetch(PDO::FETCH_ASSOC)){
                                                                        if($DateName['id']==$itemUseData['item_selected_date'])$sl="selected";else $sl='';
					                                            $flist .='<option value="'.$DateName['id'].'" '.$sl.'>'.$DateName['date'].'</option>';
                                                                }  
					                                            $flist .='</select></td>
                                                                    <td><input type="text" class="form-control" name="costPerUnit[]" id="costPerUnit'.$k.'" placeholder="Unit Cost" value="' . $itemUseData['unit_price'] . '" autocomplete="off" required=""></td>
                                                                    <td><input type="text" class="form-control" name="itemCost[]" id="totalcostManufacturing'.$k.'" placeholder="Item Cost" value="' . $itemUseData['item_cost'] . '" autocomplete="off" required=""></td>
                                                                 </tr>';
                                                                 $k++; 
                                                                 }
                                                                 
                                                                 //sel expenses
					                                            $sl_expenses_Q = $conn->query("select * from `expense_sub_items` where formula_id='$formulaID'");
					                                            $totalExpense=0;
					                                            while($data = $sl_expenses_Q->fetch(PDO::FETCH_ASSOC)){
					                                               $expenseData = $conn->query("select * from `expense` where id='$data[expense_id]'");
					                                               $expdataIs = $expenseData->fetch(PDO::FETCH_ASSOC);
					                                               $totalExpense += $expdataIs['cost'];
					                                               $flist .='<tr><td>Expense</td><td colspan="4">'.$expdataIs['name'].'</td><td><input type="text" name="expense[]" class="form-control" value="'.$expdataIs['cost'].'"></td></tr>'; 
					                                            }
					                                           $finalTotal = $totalExpense+$itemTotal;
                                                               $flist .='<tr><td colspan="5">Cost of Product</td><td><input type="text" readonly class="form-control" value="'.$finalTotal.'" id="totalitemCost"></td></tr>'; 	  
                                                               echo $flist;
                                                               ?> 
                                                                
                                                                
                                                            </tbody>
                                                        </table>
                                                        <fieldset id="account" class="containerForm1"></fieldset>
                                                    </div>
                                                </div>
                                                <hr>
                                                
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit" name="productUpdate" class="btn btn-primary">Update</button>
                                                        <a href="ProductFormation.php" class="btn btn-info">Back</a>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>
    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>
    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>
</html>