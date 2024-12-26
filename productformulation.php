<?php
include_once('config.php'); 
include_once('include/auth.php');
$messageAction = '';
if(isset($_REQUEST['main_submit'])){
    $formula_Name = $_REQUEST['formulaName'];
    $formula_Desc = $_REQUEST['formulaDesc'];
    $sql = "INSERT INTO `formula_entry`(user_reg_id,formula_name, formula_description) VALUES ('$_SESSION[id]','$formula_Name','$formula_Desc')";
    if($conn->exec($sql)){
        $formulaID = $conn->lastInsertId();
        for($i=0;$i<sizeof($_REQUEST['containerType']);$i++){
            $container_Type = $_REQUEST['containerType'][$i];
            $item_Name = $_REQUEST['all_item'][$i];
            $formula_Qty = $_REQUEST['formulaQty'][$i];
            $sql1 = "INSERT INTO `formula_sub_items`(`formula_id`, `category`, `Item`, `qty`) VALUES ('$formulaID','$container_Type','$item_Name','$formula_Qty')";
            $result1 = $conn->exec($sql1);
        }
        
        $messageAction = '<div class="mx-3 mt-3">
         <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been saved successfully</h6>
        </div>';
        @$conn->NULL;
        //echo '<script>alert ("Data has been save successfull")<//script>';
        //echo '<script>location.href="productformulation.php"<//script>';
       }else{
        echo '<script>alert("Data Not Inserted");</script>';
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
</head>
<?php
        $sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
        $result = $conn->query($sql);
    ?>
<?php
        $sql1 = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
        $result1 = $conn->query($sql1);
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
        $(document).ready(function(){
      //alert('ok');
        var max_fields1      = 10;
        var wrapper1         = $(".containerForm1"); 
        var add_button1      = $(".add_form_field1"); 
        
        var x = 1; 
        $(add_button1).click(function(e){ 
            e.preventDefault();
            if(x < max_fields1){ 
                x++; 
                $(wrapper1).append('<div class="d-flex gap-2"><tr><td><div class="mb-3" style="width:280px;"><select  class="form-select" name="containerType[]" id="containerType'+x+'" onchange="return addNewCategory'+x+'(this.value)" data-choices data-choices-sorting="true"><option selected>Select Container Type</option><?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?> <option value="<?php echo $row['id'];?>"><?php if($row['percentage']=="Yes")$pr="(In %)";else $pr='';  if(isset($row['Category_Name']))echo $row['Category_Name'].$pr;?></option> <?php } ?></select></div></td><td><div class="mb-3 ms-2" style="width:190px;" id="item_name"><select class="form-select" name="all_item[]" id="iteamList'+x+'" data-choices data-choices-sorting="true"><option selected>Select Item</option><?php while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){ ?> <option value="<?php echo $row1['id'];?>"><?php if(isset($row1['item_name']))echo $row1['item_name'];?></option> <?php } ?></select></div></td><td><div class="mb-3 ms-2" style="width:260px;" id="formula_qty"><input type="text" class="form-control" name="formulaQty[]" placeholder="Enter Qty" id="compnayNameinput"/></div></td><td><div class="d-flex gap-2"><div class="edit"></div></div></td></tr><a class="btn btn-sm btn-success edit-item-btn add_form_field1 delete" style="height:30px;">Remove</a></div>'); 
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
    </script>
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
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div id="customerList">
                  <div class="row g-4 mb-4">
                    <div class="col-lg-8 col-12">
                      <div class="row">
                        <div class="col-12 col-lg-4 mb-3  mb-md-0">
                          <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="search-box  w-100 m-0">
                              <label class="form-label">Search</label>
                              <input type="text" class="form-control search" placeholder="Search...">
                              <i class="ri-search-line search-icon"></i> </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <!-- <label for="StartleaveDate" class="form-label">To Date</label>
                                                        <input type="date" class="form-control"
                                                            data-provider="flatpickr" id="StartleaveDate" /> -->
                        </div>
                        <div class="col-12 col-lg-4 mb-2  mb-md-0">
                          <!-- <label for="StartleaveDate" class="form-label">To Date</label>
                                                        <input type="date" class="form-control"
                                                            data-provider="flatpickr" id="StartleaveDate" /> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-lg-end justify-content-center"> <a href="#newFormula">
                      <button class="btn btn-sm btn-success edit-item-btn"> Add New Product Formulation</button>
                      </a> </div>
                  </div>
                  <?php
                    if(isset($messageAction)){
                        echo '<div id="entryID">'.$messageAction.'</div>';
                     ?>
                  <script>
                         setTimeout(function(){
                          document.getElementById('entryID').innerHTML='';
                         },2000);
                     </script>
                  <?php
                     }
                    ?>
                  <div id="childRDelete"></div>
                  <?php
                                        $sql = "SELECT * FROM `formula_entry` where user_reg_id='$_SESSION[id]'";
                                        $result = $conn->query($sql);
                                        if($result->rowCount()>0){
                                        ?>
                  <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>Formula Name</th>
                          <th>Description</th>
                          <th>Update</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                        <tr id="rowParent<?php echo $row['id'] ?>">
                          <?php
                                                        echo '<td>' . $row['formula_name'] . '</td>';
                                                        echo '<td>' . $row['formula_description'] . '</td>';
                                                        echo '<td> <div class="d-flex gap-2">
                                                         <div class="edit">
                                                           <a href="editproductformulation.php?id=' . $row['id'] . '" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                         </div>
                                                          <div class="mx-3">
                                                           <a style="cursor:pointer" onClick="return dataRdelete'.$row['id'].'('.$row['id'].')" class="btn btn-sm btn-danger remove-item-btn" name="purchase_delete">Delete</a>
                                                          </div>
                                                         </div>
                                                        </td>';
                   ?>
                      <script>
						function dataRdelete<?php echo $row['id'] ?>(rowID){
							var myData = "rid="+rowID+"&action=deleteParentFormulaRow";
							//alert(myData);
							 jQuery.ajax({
							   type: "POST", // HTTP method POST or GET
							   url: "action.php", //Where to make Ajax calls
								dataType:"text", // Data type, HTML, json etc.
								data:myData, //Form variables
								success:function(response){
								//alert(response);
								  $("#childRDelete").html(response); 
									  setTimeout(function(){
											   $("#childRDelete").html(''); 
											   $("#rowParent<?php echo $row['id'] ?>").html=('');
										},1000);
										 
										},
										error:function (xhr, ajaxOptions, thrownError){
										reg("#submitbtn").show(); //show submit button
										reg("#LoadingImage").hide(); //hide loading image
											alert(thrownError);
										 }
										});
									   }
							</script>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    <?php } ?>
                    <div class="d-flex justify-content-end">
                      <div class="pagination-wrap hstack gap-2"> <a class="page-item pagination-prev disabled"></a>
                        <ul class="pagination listjs-pagination mb-0">
                        </ul>
                        <a class="page-item pagination-next"></a> </div>
                    </div>
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end col -->
          </div>
          <div class="row" id="newFormula">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Add New Formula</h4>
                </div>
                <?php
						if(isset($msg1)){
							echo $msg1;
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
                            <input type="text" name="formulaName" class="form-control" placeholder="Enter Formula Name" autocomplete="off" required/>
                          </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block">
                          <div class="mb-3">
                            <label for="firstNameinput" class="form-label">Description</label>
                            <input type="text" name="formulaDesc" class="form-control" placeholder="Enter Formula Description" autocomplete="off"/>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                          <div class="table-responsive">
                            <table class="table align-middle table-nowrap" id="customerTable">
                              <thead class="table-light">
                               <!-- <tr>
									<th>Category</th>
									<th>Item</th>
									<th>Qty</th>
								</tr> -->
                              </thead>
                              <tbody class="list form-check-all">
                                <?php
									$sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
									$result = $conn->query($sql);
									?>
                                <tr>
                                  <td><div class="mb-3" id="container_Type">
                                      <select class="form-select" name="containerType[]" id="containerType" onChange="return addNewCategory(this.value)" data-choices data-choices-sorting="true" required>
                                        <option value="">Select Category Name</option>
                                        <?php
										 while($row = $result->fetch(PDO::FETCH_ASSOC)){
										 if($row['percentage']=="Yes")$pr="(In %)";else $pr=''; 
										?>
                                        <option value="<?php echo $row['id'];?>">
                                        <?php echo $row['Category_Name']." - ".$row['Measuring_Units'].$pr;
                                        echo '</option>';
										 }
										echo '<optgroup label="For a container type"></optgroup><option>Add New</option>';
										 
									  ?>
                                    </select>
                                <script>
function addNewCategory(getVType){
if(getVType=="Add New"){
  $("#addNewCategory1").addClass("show");
  document.getElementById("addNewCategory1").style.display="block";
}else{

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
document.getElementById("iteamList").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
						
					}
				}
				
//add item list after add more fields
function addNewCategory2(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList2").innerHTML="";

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
document.getElementById("iteamList2").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
						
						
					
				}
				
function addNewCategory3(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList3").innerHTML="";

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
document.getElementById("iteamList3").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory4(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList4").innerHTML="";

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
document.getElementById("iteamList4").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory5(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList5").innerHTML="";

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
document.getElementById("iteamList5").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory6(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList6").innerHTML="";

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
document.getElementById("iteamList6").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory7(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList7").innerHTML="";

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
document.getElementById("iteamList7").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory8(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList8").innerHTML="";

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
document.getElementById("iteamList8").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory9(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList9").innerHTML="";

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
document.getElementById("iteamList9").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
function addNewCategory10(getVType){
					
if (getVType=="")

{

document.getElementById("iteamList10").innerHTML="";

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
document.getElementById("iteamList10").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","getItemlist.php?q="+getVType,true);

xmlhttp.send();
					
	}
	
	
	function closeCategoryModel(){
		$("#addNewCategory1").removeClass("show");
		document.getElementById("addNewCategory1").style.display="none";
	}
</script>
                               </div></td>
                                  <?php
										$sql = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
										$result= $conn->query($sql);
										?>
                                  <td><div class="mb-3" id="item_name">
                                      <select class="form-select" id="iteamList" name="all_item[]" onChange="createItem(this.value)" data-choices data-choices-sorting="true" required>
                                        <option value="">Select Item</option>
                                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['item_name']." - ".$row['measurement_unit'];?>
                                        </option>
                                        <?php } 
                                            echo '<optgroup label="For a new item"></optgroup><option>Add New</option>';
                                         ?>
                                      </select>
                               <script>
								function createItem(getVType){
									if(getVType=="Add New"){
									  $("#addeNewItem").addClass("show");
									  document.getElementById("addeNewItem").style.display="block";
									}
								}
                                    
								function closeItemModel(){
									$("#addeNewItem").removeClass("show");
									document.getElementById("addeNewItem").style.display="none";
								}
							</script>
                                    </div></td>
                                  <td><div class="mb-3" id="formula_qty">
                                      <input type="number" class="form-control" name="formulaQty[]" placeholder="Enter Qty" id="compnayNameinput" autocomplete="off" required/>
                                    </div></td>
                                  <td><div class="d-flex" style="margin-top: -18px;">
                                      <div class="edit">
                                        <button class="btn btn-sm btn-success edit-item-btn add_form_field1" id="addColum">Add</button>
                                      </div>
                                    </div></td>
                                </tr>
                              </tbody>
                            </table>
                            <fieldset id="account" class="containerForm1">
                            </fieldset>
                          </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                          <div class="text-center">
                            <button type="submit" name="main_submit" class="btn btn-primary">Submit</button>
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
        </div>
        <!-- container-fluid -->
      </div>
      <!-- End Page-content -->
      <div class="modal fade" id="addeNewItem" tabindex="-1"
                                              aria-labelledby="addeNewItem" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Item</h5>
              <button type="button" class="btn-close" onClick="closeItemModel()" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form name="itemForm" method="post">
                <div class="row" id="addNewItem">
                <div class="col-xxl-12">
                <div>
                <div style="text-align: justify;">
                <div class="live-preview">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="firstNameinput" class="form-label">Item Code</label>
                      <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Enter Item Code" autocomplete="off" required/>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Name of Item </label>
                      <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Item Name" autocomplete="off" required/>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class=" mb-3">
                      <label class="form-label">Description </label>
                      <input type="text" class="form-control" name="item_description" id="item_description" placeholder="Enter Description" autocomplete="off" required/>
                    </div>
                  </div>
                  <?php
					  // vender name select code
					  $sql = "SELECT * FROM `vendor` where user_reg_id='$_SESSION[id]'";
					  $result = $conn->query($sql);
					  ?>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Vendor Name</label>
                      <select name="vendor_name1" id="vendor_name1" class="form-select" data-choices data-choices-sorting="true" required>
                        <option value="">Select Vendor</option>
                        <?php
							while($row = $result->fetch(PDO::FETCH_ASSOC)){
							?>
                        <option name ="category_ids" value="<?php echo $row['id'];?>">
                        <?php if(isset($row['name'])){echo $row['name'];}?>
                        </option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <?php
					  $sql = "SELECT * FROM `category` where user_reg_id='$_SESSION[id]'";
					  $result = $conn->query($sql);
					  ?>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Category</label>
                      <select name="category1" id="category1" class="form-select" data-choices data-choices-sorting="true" required>
                        <option value="">Select Category</option>
                        <?php
							while($row = $result->fetch(PDO::FETCH_ASSOC)){
							?>
                        <option value="<?php echo $row['id'];?>">
                        <?php if(isset($row['Category_Name'])){echo $row['Category_Name'];}?>
                        </option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Measurement Unit</label>
                      <select name="measurement_unit" id="measurement_unit" onChange="checkUnit(this.value)" class="form-select" data-choices data-choices-sorting="true" required>
                        <option value="">Select Unit</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Litres">Litres</option>
                        <option value="Grams">Grams</option>
                        <option value="cm">cm</option>
                        <option value="meters">metres</option>
                        <option value="kg">kg</option>
                      </select>
                    </div>
                  </div>
                  <script>
					function checkUnit(unitVal){
						if(unitVal=="Grams"){
							document.getElementById('weightEachUnit').style.display = "none";
							document.getElementById('weightEachUnit').innerHTML = '<div class="col-lg-6" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit</label><input type="text" class="form-control" name="weight_unit" id="weight_unit" placeholder="Enter Weight Of Each Unit" autocomplete="off"/></div></div>';
							}else{
							  document.getElementById('weightEachUnit').style.display = "contents"; 
							  document.getElementById('weightEachUnit').innerHTML = '<div class="col-lg-6" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit</label><input type="text" class="form-control" name="weight_unit" id="weight_unit" placeholder="Enter Weight Of Each Unit" required autocomplete="off"/></div></div>';
							}
					}
				   </script>
                  <div id="weightEachUnit" style="display: contents;"></div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Location Name </label>
                      <input type="text" class="form-control" name="location1" id="location1"
                                                                        placeholder="Enter Location" required/>
                    </div>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <div class="text-center" style="margin-bottom: 15px;">
                      <button type="submit" name="new_submit" class="btn btn-primary"  onClick="return itemRsubmit()"> <i class="fa " id="btnIbutton"></i> Submit</button>
                    </div>
                    <p id="messageItemTxt" style="text-align: center;">&nbsp;</p>
                  </div>
                </div>
              </form>
              <script>
				function itemRsubmit(){
				 if(document.itemForm.item_code.value==''){
					 $("#messageItemTxt").html('<span style="color: red;"> Enter Item Code</span>');
					 return false;
				 }else if(document.itemForm.item_name.value==''){
					 $("#messageItemTxt").html('<span style="color: red;"> Enter Item Name</span>');
					 return false;
				 }else if(document.itemForm.vendor_name1.value==''){
					 $("#messageItemTxt").html('<span style="color: red;"> Select Vendor</span>');
					 return false;
				 }else if(document.itemForm.category1.value==''){
					 $("#messageItemTxt").html('<span style="color: red;"> Select Category</span>');
					 return false;
				 }else{    
				 $("#btnIbutton").addClass('fa-spinner fa-spin');    
				 var myData = "item_code="+document.itemForm.item_code.value+"&item_name="+document.itemForm.item_name.value+"&item_description="+document.itemForm.item_description.value+"&vendor_name1="+document.itemForm.vendor_name1.value+"&category1="+document.itemForm.category1.value+"&measurement_unit="+document.itemForm.measurement_unit.value+"&weight_unit="+document.itemForm.weight_unit.value+"&location1="+document.itemForm.location1.value;
					//alert(myData);
					jQuery.ajax({
					 type: "POST", // HTTP method POST or GET
					 url: "submitModelData.php", //Where to make Ajax calls
					   dataType:"text", // Data type, HTML, json etc.
					   data:myData, //Form variables
					success:function(response){
					//alert(response);
					if(response==0){
					  $("#messageItemTxt").html('<span style="color: red;"> Some error!</span>');
					}else{
					 $("#messageItemTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
					 document.getElementById("iteamList").innerHTML=response;
					 
					 $("#btnIbutton").removeClass('fa-spinner fa-spin');
					  setTimeout(function(){
						   $("#addeNewItem").removeClass("show");
						   document.getElementById("addeNewItem").style.display="none";
						   $("#messageItemTxt").html(''); 
					  },2000);
					  
					 }
					},

					error:function (xhr, ajaxOptions, thrownError){
					reg("#submitbtn").show(); //show submit button
					reg("#LoadingImage").hide(); //hide loading image
						alert(thrownError);
					 }
					});
				   }
					return false;
				  }
			  </script>
              <!--end col-->
            </div>
            <!--end row-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addNewCategory1" tabindex="-1"
                                              aria-labelledby="addNewCategory1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Category</h5>
        <button type="button" class="btn-close" onClick="closeCategoryModel()" data-bs-dismiss="modal"
                                                      aria-label="Close"></button>
      </div>
      <div class="modal-body" id="pops">
        <?php
			  if(isset($msg)){
				echo $msg;
			  }
			  ?>
        <div class="row">
          <form name="categoryForm" method="post">
            <div class="col-xxl-12">
            <div>
            <div style="text-align: justify;">
            <div class="live-preview">
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="firstNameinput" class="form-label"> Category Name</label>
                  <input type="text" class="form-control" name="c_name" id="c_name" placeholder="Enter Category Name" required/>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="compnayNameinput" class="form-label">Description No.</label>
                  <input type="text" class="form-control" name="c_description" id="c_description" placeholder="Enter Description" required/>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="compnayNameinput" class="form-label">Measuring Units</label>
                  <select class="form-select" name="c_units" onChange="checkUnit_2(this.value)" id="c_units" data-choices data-choices-sorting="true" required>
                  <option value="">-----Measuring Units-----</option>
                  <option value="Pcs">Pcs</option>
                  <option value="Liters">Litres</option>
                  <option value="Grams">Grams</option>
                  <option value="cm">cm</option>
                  <option value="meters">metres</option>
                  <option value="kg">kg</option>
                  </select>
                </div>
              </div>
              <script>
				function checkUnit_2(unitVal){
					if(unitVal=="Grams"){
						document.getElementById('weightEachUnit_2').style.display = "none";
						document.getElementById('weightEachUnit_2').innerHTML = '<div class="col-lg-6" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit</label><input type="text" class="form-control" name="weights" id="weights" placeholder="Enter Weight Of Each Unit" autocomplete="off"/></div></div>';
						}else{
						  document.getElementById('weightEachUnit_2').style.display = "contents"; 
						  document.getElementById('weightEachUnit_2').innerHTML = '<div class="col-lg-6" style="padding-left: 15px;"><div class="mb-3"><label for="compnayNameinput" class="form-label" required>Weight Of Each Unit</label><input type="text" class="form-control" name="weights" id="weights" placeholder="Enter Weight Of Each Unit" required autocomplete="off"/></div></div>';
						}
				}
			</script>
              <div id="weightEachUnit_2" style="display: contents;"></div>
              <hr>
              <div class="col-lg-12">
                <div class="text-center" style="margin-bottom:15px">
                  <button type="submit" class="btn btn-primary" name="c_submit" onClick="return categoryRsubmit()"> <i class="fa " id="btnCbutton"></i> Submit</button>
                </div>
                <p id="messageCategoryTxt" style="text-align: center;">&nbsp;</p>
              </div>
              <!--end col-->
            </div>
            <!--end row-->
          </form>
        <script>
		function categoryRsubmit(){
		 if(document.categoryForm.c_name.value==''){
			 $("#messageCategoryTxt").html('<span style="color: red;"> Enter Category Name</span>');
			 return false;
		 }else if(document.categoryForm.c_units.value==''){
			 $("#messageCategoryTxt").html('<span style="color: red;"> Select Measuring Units</span>');
			 return false;
		 }else{    
		 $("#btnCbutton").addClass('fa-spinner fa-spin');    
		 var myData = "c_name="+document.categoryForm.c_name.value+"&c_units="+document.categoryForm.c_units.value+"&c_description="+document.categoryForm.c_description.value+"&weights="+document.categoryForm.weights.value;
			//alert(myData);
			jQuery.ajax({
			 type: "POST", // HTTP method POST or GET
			 url: "submitModelData.php", //Where to make Ajax calls
			   dataType:"text", // Data type, HTML, json etc.
			   data:myData, //Form variables
			success:function(response){
			//alert(response);
			if(response==0){
			  $("#messageCategoryTxt").html('<span style="color: red;"> Some error!</span>');
			}else{
			 $("#messageCategoryTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
			 document.getElementById("category1").innerHTML=response;
			 document.getElementById("containerType").innerHTML=response;
			 $("#btnCbutton").removeClass('fa-spinner fa-spin');
			  setTimeout(function(){
				   document.categoryForm.c_name.value='';
				   document.categoryForm.c_description.value='';
				   document.categoryForm.c_units.value=''; 
				   document.categoryForm.weights.value='';
				   $("#addNewCategory1").removeClass("show");
				   document.getElementById("addNewCategory1").style.display="none";
				   $("#messageCategoryTxt").html(''); 
			  },2000);
			  return false;
			 }
			},

			error:function (xhr, ajaxOptions, thrownError){
			reg("#submitbtn").show(); //show submit button
			reg("#LoadingImage").hide(); //hide loading image
				alert(thrownError);
			 }
			});
		   }
			return false;
		  }
	  </script>
        </div>
      </div>
    </div>
  </div>
  <!-- end col -->
</div>
</div>
</div>
</div>
</div>
<!-- footer start -->
<?php include_once ('include/footer.php');?>
</div>
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"> <i class="ri-arrow-up-line"></i> </button>
<!--end back-to-top-->
<!-- <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div> -->
<style>
.form-control1 {
	display: block;
	padding: .5rem .9rem;
	font-size: .8125rem;
	font-weight: 400;
	line-height: 1.5;
	color: var(--vz-body-color);
	background-color: var(--vz-input-bg);
	background-clip: padding-box;
	border: 1px solid var(--vz-input-border);
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	border-radius: .25rem;
	-webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
	transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
	transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }
    </style>
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