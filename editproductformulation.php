<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['id'])){
$sql5 = "SELECT * FROM `formula_entry` WHERE id={$_REQUEST['id']} and user_reg_id='$_SESSION[id]'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch(PDO::FETCH_ASSOC);
}

 if(isset($_REQUEST['edit_submit'])){
    $formula_Name = $_REQUEST['formulaName'];
    $formula_Desc = $_REQUEST['formulaDesc'];
    $sql = "UPDATE `formula_entry` SET `formula_name`='$formula_Name',`formula_description`='$formula_Desc' WHERE id={$row5['id']}";
    if($conn->query($sql)){
    $orderID = $conn->lastInsertId();
    
   for($i=0;$i<sizeof($_REQUEST['p_category']);$i++){
    $p_category = $_REQUEST['p_category'][$i];
    @$p_item = $_REQUEST['p_item'][$i];
    $formulaQty = $_REQUEST['formulaQty'][$i];
    @$childRowId = $_REQUEST['hidden_id'][$i];
    
    if(!empty($childRowId)){
      $sql4 = "UPDATE `formula_sub_items` SET `category`='$p_category',`Item`='$p_item',`qty`='$formulaQty' WHERE id={$childRowId} && formula_id={$_REQUEST['id']}";
     }else{
      $sql4 = "INSERT INTO `formula_sub_items` SET `category`='$p_category',`Item`='$p_item',`qty`='$formulaQty',formula_id='$_REQUEST[id]'";   
     }
     $result4 = $conn->exec($sql4);
    }
    
    
   //add expense
   if(!empty($_REQUEST['p_expense'][0])){
   for($i=0;$i<sizeof($_REQUEST['p_expense']);$i++){
    @$expenseRowId = $_REQUEST['expenseHidden_id'][$i];   
    $p_expense = $_REQUEST['p_expense'][$i];
    if(!empty($expenseRowId)){
      $sql4 = "UPDATE `expense_sub_items` SET `expense_id`='$p_expense' WHERE id={$expenseRowId} && formula_id={$_REQUEST['id']}";
     }else{
      $sql4 = "INSERT INTO `expense_sub_items` SET `expense_id`='$p_expense',formula_id='$_REQUEST[id]'";   
     }
     $result4 = $conn->exec($sql4);
    }
  }
  
   $messageAction = '<div class="mx-3 mt-3">
      <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been updated successfully</h6>
     </div>'; 
  }else{
    echo '<script>alert("Data Not Updated");</script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>
<meta charset="utf-8" />
<title>Product Formulation Entry Form & List | <?php echo $_SESSION['userName']?> </title>
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
<style>
.add_form_field{
    background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border: 1px solid #186dad;

}
.delete{
   background-color: #3c8dbc;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    //float: right;
    border-radius: 20px;
}
@media(max-width:769px){
.delete{float: right!important;}
}
@media(max-width:480px){
.delete{float: right!important;}
}
@media(max-width:320px){
.delete{float: right!important;}
}
</style>
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
      <h4 class="mb-sm-0">PRODUCT FORMULATION COMPONENT LIST & ENTRY FORM</h4>
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"> <a href="./dashboard.php">Dashboard</a> </li>
          <li class="breadcrumb-item active">Product Formulation</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- end page title -->
<div class="row" id="newFormula">
  <div class="col-xxl-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Add New Formula</h4>
      </div>
      <?php
				if(isset($messageAction)){
					echo '<div id="entryID" style="position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;">'.$messageAction.'</div>';
				 ?>
                <script>
					 setTimeout(function(){
					  document.getElementById('entryID').innerHTML='';
					  //window.location='purchaseEntryForm.php';
					 },1000);
				</script>
             <?php
				 }
               ?>
      <!-- end card header -->
      <div class="card-body">
        <div class="live-preview">
          <form action="" method="POST">
            <div class="row">
              <div class="col-lg-5">
                <div class="mb-3">
                  <label for="firstNameinput" class="form-label">Formula name</label>
                  <input type="text" name="formulaName" class="form-control" value="<?php if(isset($row5['formula_name'])){echo $row5['formula_name'];}?>" placeholder="Enter Formula Name" required/>
                </div>
              </div>
              <div class="col-lg-7 d-none d-lg-block">
                <div class="mb-3">
                  <label for="firstNameinput" class="form-label">Formula Description</label>
                  <input type="text" name="formulaDesc" class="form-control" value="<?php if(isset($row5['formula_description'])){echo $row5['formula_description'];}?>" placeholder="Enter Formula Name" required/>
                </div>
              </div>
              <!--end col-->
              <div class="card-body">
                <div class="live-preview">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table align-middle table-nowrap" id="customerTable">
                        <thead class="table-light">
                        </thead>
                        <tbody class="list form-check-all">
                          <tr>
                            <td>Category Name</td>
                            <td>Item Type</td>
                            <td>Quantity</td>
                            <td>Action</td>
                          </tr>
                          <?php 
						$sql_sub_formula_Q = "SELECT * FROM formula_sub_items WHERE formula_id={$_REQUEST['id']}";
						$innerSubFormula = $conn->query($sql_sub_formula_Q);
						while($formulaSubRow = $innerSubFormula->fetch(PDO::FETCH_ASSOC)){?>
<tr id="messageTxt<?php echo $formulaSubRow['id'] ?>">
<td><div class="mb-3" id="container_Type">
                          <?php
									//$categoryName =  $row5['category'];
									$itemId = $row5['id'];
									$sql4 = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
									$result4 = $conn->query($sql4);
									?>
<select name="p_category[]" class="form-select" onChange="return addNewCategory<?php echo $formulaSubRow['id'] ?>(this.value)" data-choices data-choices-sorting="true" required>
                           <?php
							while($row2 = $result4->fetch(PDO::FETCH_ASSOC)){
							?>
                              <option value="<?php echo $row2['id'] ?>" <?php if($row2['id']==$formulaSubRow['category'])echo "selected"?>>
<?php 
									  if($row2['percentage']=="Yes")$pr="(In %)";else $pr=''; 
									  echo $row2['Category_Name']." - ".$row2['Measuring_Units'].$pr;?>
</option>
						   <?php
							 }
							?>
</select>

<script>
function addNewCategory<?php echo $formulaSubRow['id'] ?>(getVType){
  
					
if (getVType=="")

{

document.getElementById("iteamListEdit<?php echo $formulaSubRow['id'] ?>").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("iteamListEdit<?php echo $formulaSubRow['id'] ?>").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	
 }
</script>
                              </div></td>
                            <td><div class="mb-3" id="item_name">
                                <?php
									//$itemName =  $row5['Item'];
									$itemId = $row5['id'];
									$sql3 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
									$result3 = $conn->query($sql3);
									?>
                                <select id="iteamListEdit<?php echo $formulaSubRow['id'] ?>" name="p_item[]" class="form-select" data-choices data-choices-sorting="true" required>
                                  <?php
									while($row1 = $result3->fetch(PDO::FETCH_ASSOC)){
									?>
                                  <option value="<?php echo $row1['id']?>"<?php if($row1['id']==$formulaSubRow['Item']) echo "selected"?>>
                                  <?php if(isset($row1['item_name'])){echo $row1['item_name'];}?>
                                  </option>
                                  <?php
									}
								  ?>
                                </select>
                              </div></td>
                            <td><div class="mb-3" id="formula_qty">
                                <input type="text" class="form-control" name="formulaQty[]" value="<?php if(isset($formulaSubRow['qty'])){echo $formulaSubRow['qty'];}?>" placeholder="Enter Qty" id="compnayNameinput" required/>
                              </div></td>
                            <td style="display:none"><input type="hidden" name="hidden_id[]" value="<?php if(isset($formulaSubRow['id'])){echo $formulaSubRow['id'];} ?>">
                            </td>
                            <td><a style="cursor:pointer;background-color: #3c8dbc;border: none;color: white;padding: 5px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;margin: 4px 2px;cursor: pointer;border-radius: 20px;" class="btn btn-sm btn-success" onClick="return dataRdelete<?php echo $formulaSubRow['id'] ?>(<?php echo $formulaSubRow['id'] ?>)">Delete</a></td>
                          </tr>
                        <script>
						function dataRdelete<?php echo $formulaSubRow['id'] ?>(rowID){
						  var r = confirm('Are you want to delete?');
						  if(!r){
							  return false;
						  }else{
									var myData = "rid="+rowID+"&action=deleteFormulaEntry";
									//alert(myData);
									 jQuery.ajax({
									   type: "POST", // HTTP method POST or GET
									    url: "action.php", //Where to make Ajax calls
										dataType:"text", // Data type, HTML, json etc.
										data:myData, //Form variables
										success:function(response){
										//alert(response);
										if(response==0){
										   alert('Data not deleted.');
										}else{
										  $("#messageTxt<?php echo $formulaSubRow['id'] ?>").html('<td colspan="7"><span style="color: red;"><i class="fa fa-spinner fa-spin"></i> Data has been deleted successfully</span></td>');
												
								setTimeout(function(){
									   $("#messageTxt<?php echo $formulaSubRow['id'] ?>").html(''); 
								},1000);
								  
								 }
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
                       <?php } 
                        echo '<tr><td colspan="5" style="text-align: center;cursor:pointer"><button type="button" class="edit-item-btn add_form_field1" id="addColum" style="background: #fff;border: 0;"><center><i class="fa fa-plus" style="text-align: center;color: #a5a1a1;font-size: 25px;border: 1px solid #ccc;width: 50px;height: 50px;border-radius: 100%;line-height: 2;"></i> Add More</center></button></td></tr>';?>
                          <?php
							 $sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
							 $result_cat = $conn->query($sql);
							?>
                          <?php
					$sql1 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
					$result_item = $conn->query($sql1);
				?>
				
        <script>
        $(document).ready(function() {
        //alert('ok');
        var max_fields1      = 10;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        
        var x = 1; 
        $(add_button1).click(function(e){ 
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex"><tr><td><div class="mb-3" style="width: 200px;"><select  class="form-select" name="p_category[]" onChange="return addNewCat'+x+'(this.value)" data-choices data-choices-sorting="true" required><option value="">Select Category Name</option><?php while($row = $result_cat->fetch(PDO::FETCH_ASSOC)){if($row['percentage']=="Yes")$pr="(In %)";else $pr=''; ?> <option value="<?php echo $row['id'];?>"><?php if(isset($row['Category_Name']))echo $row['Category_Name']." - ".$row['Measuring_Units'].$pr?></option> <?php } ?></select></div></td><td><div class="mb-3 ms-2" style="width:190px;" id="item_name"><select class="form-select" name="all_item[]" id="itemListData'+x+'" data-choices data-choices-sorting="true" required><option value="">Select Item</option><?php while($row1 = $result_item->fetch(PDO::FETCH_ASSOC)){ ?> <option value="<?php echo $row1['id'];?>"><?php if(isset($row1['item_name']))echo $row1['item_name'];?></option> <?php } ?></select></div></td><td><div class="mb-3 ms-2" style="width:285px;" id="formula_qty"><input type="text" class="form-control" name="formulaQty[]" placeholder="Enter Qty" id="compnayNameinput" required/></div></td><td><div class="d-flex ms-2"><div class="edit"></div></div></td></tr><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete" style="height:30px;">Remove</a></div>'); 
           //alert('Fields added');
            }
        else
        {
        alert('You Reached the limits')
        }
        });
        
        $(wrapper1).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
          //alert('Fields removed');
        })
     });
	 
	 
	 //add item list after add more fields
function addNewCat2(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData2").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData2").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
			}
				
function addNewCat3(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData3").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData3").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
		}
				
function addNewCat4(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData4").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData4").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
 }

function addNewCat5(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData5").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData5").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
	}
				
function addNewCat6(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData6").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData6").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
	}
				
function addNewCat7(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData7").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData7").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
	}																

function addNewCat8(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData8").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData8").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
	}	 
	 
function addNewCat9(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData9").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData9").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
}
				
function addNewCat10(getVType){
					
if (getVType=="")

{

document.getElementById("itemListData10").innerHTML="";

return;

}

if (window.XMLHttpRequest)

{// code for IE7+, Firefox, Chrome, Opera, Safari

xmlhttp=new XMLHttpRequest();

}

else

{// code for IE6, IE5

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200)

{
//alert(iteamList);
document.getElementById("itemListData10").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
	}
				
    </script>
                          <tr>
                            <td colspan="5"><fieldset id="account" class="containerForm1">
                              </fieldset></td>
                          </tr>
                          <tr>
                            <td colspan="5" style="text-align: center;cursor:pointer">
                            <button type="button" class="edit-item-btn add_form_field2" id="addColum" style="background: #fff;border: 0;">
                              <center>
                                <i class="fa fa-plus" style="text-align: center;color: #a5a1a1;font-size: 25px;border: 1px solid #ccc;width: 50px;height: 50px;border-radius: 100%;line-height: 2;"></i> Add Expense
                              </center>
                              </button></td>
                          </tr>
                          <?php
			 $expense_sql1 = "SELECT * FROM `expense` where user_reg_id='$_SESSION[id]'";
			 $expense_data = $conn->query($expense_sql1);
			//sl expanse 
			$sl_exp_Q = $conn->query("select * from `expense_sub_items` where formula_id='$_REQUEST[id]'");
			while($expenseData = $sl_exp_Q->fetch(PDO::FETCH_ASSOC)){
				$expense_data_1 = $conn->query($expense_sql1);
			?>
                          <tr id="messageEpenseTxt<?php echo $expenseData['id'] ?>">
                            <td colspan="5"><div class="row">
                                <div class="col-lg-5">
                                  <div class="mb-3">
                                    <select class="form-select" name="p_expense[]" data-choices="" data-choices-sorting="true" required="">
                                      <?php while($expData=$expense_data_1->fetch(PDO::FETCH_ASSOC)){?>
                                      <option value="<?php echo $expData['id']?>" <?php if($expData['id']==$expenseData['expense_id'])echo "selected"?>><?php echo $expData['name']?></option>
                                      <?PHP }?>
                                    </select>
                                    <input type="hidden" name="expenseHidden_id[]" value="<?php if(isset($expenseData['id'])){echo $expenseData['id'];} ?>">
                                  </div>
                                </div>
                                <div class="col-lg-5">
                                  <div class=""><a style="cursor:pointer;background-color: #3c8dbc;border: none;color: white;padding: 5px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;margin: 10px 2px;cursor: pointer;border-radius: 20px;" class="btn btn-sm btn-success" onClick="return dataExpensedelete<?php echo $expenseData['id']?>(<?php echo $expenseData['id']?>)">Delete</a></div>
                                </div>
                              </div></td>
                          </tr>
                          <script>
						function dataExpensedelete<?php echo $expenseData['id']?>(rowID){
						  var r = confirm('Are you want to delete?');
						  if(!r){
							  return false;
						  }else{
							var myData = "rid="+rowID+"&action=deleteExpenseEntry";
							//alert(myData);
							 jQuery.ajax({
							   type: "POST", // HTTP method POST or GET
							   url: "action.php", //Where to make Ajax calls
								dataType:"text", // Data type, HTML, json etc.
								data:myData, //Form variables
								success:function(response){
								//alert(response);
								if(response==0){
								   alert('Data not deleted.');
								}else{
								  $("#messageEpenseTxt<?php echo $expenseData['id'] ?>").html('<td colspan="7"><span style="color: red;"><i class="fa fa-spinner fa-spin"></i> Data has been deleted successfully</span></td>');
										
							setTimeout(function(){
								   $("#messageEpenseTxt<?php echo $expenseData['id'] ?>").html(''); 
							},1000);
							  
							 }
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
                          <?php }?>
                          <script>
        $(document).ready(function(){
        //alert('ok');
        var max_fields2      = 10;
        var wrapper2         = $(".containerForm2"); 
        var add_button2      = $(".add_form_field2"); 
        
        var x = 1; 
        $(add_button2).click(function(e){ 
            e.preventDefault();
            if(x < max_fields2){ 
                x++; 
                $(wrapper2).append('<div class="row"><div class="col-lg-5" style="display: inherit;"><div class="mb-3"><select class="form-select" name="p_expense[]" data-choices data-choices-sorting="true" required><option value="">Select Expense Type</option><?php while($expenseIs=$expense_data->fetch(PDO::FETCH_ASSOC)){?><option value="<?php echo $expenseIs['id'];?>"><?php echo $expenseIs['name']; ?></option><?php }?></select></div>&nbsp;&nbsp;<a class="btn btn-sm btn-success edit-item-btn add_form_field2 delete" style="height:30px;">Remove</a></div></div>'); 
           //alert('Fields added');
            }
        else
        {
        alert('You Reached the limits')
        }
        });
        
        $(wrapper2).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
          //alert('Fields removed');
        })
     });
    </script>
                          <tr>
                            <td colspan="5"><fieldset id="account2" class="containerForm2">
                              </fieldset></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <div class="text-center">
                      <button type="submit" name="edit_submit" class="btn btn-primary">Update</button>
                      <a href="productformulation.php" class="btn btn-info">Back</a> </div>
                  </div>
                  <!--end col-->
                </div>
                <!--end row-->
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- footer start -->
<?php include_once ('include/footer.php');?>
<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
<script src="assets/libs/list.js/list.min.js"></script>
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