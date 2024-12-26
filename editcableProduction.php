<?php
include_once('config.php');
include_once('include/auth.php');

////get cable production data
$cableProductionSql = "SELECT * FROM `cableProduction` where id='$_REQUEST[cableProductionId]'";
$cableProductionResult = $conn->query($cableProductionSql);
$cableProductionrow = $cableProductionResult->fetch(PDO::FETCH_ASSOC);

$sl_group_list = "SELECT * FROM `goodsGroup`";
$groupList_Q = $conn->query($sl_group_list);

if (isset($_REQUEST['main_submit'])) {
    $prodCat = $_REQUEST['prodCat'];
    $descriptionSelect = $_REQUEST['descriptionSelect'];
    $quantityField = $_REQUEST['quantityField'];
    $unit = $_REQUEST['unit'];
    $tranId = $_REQUEST['tranId'];
    $curDate = $_REQUEST['curDate'];
    $type = $_REQUEST['type'];
    $factor = $_REQUEST['factor'];
    $stand = $_REQUEST['stand'];
    $gauge = $_REQUEST['gauge'];
    $core = $_REQUEST['core'];
    $twisting = $_REQUEST['twisting'];
    $coil_wt = $_REQUEST['coil_wt'];
    $length = $_REQUEST['length'];
    $stock = $_REQUEST['stock'];
    $grade1 = $_REQUEST['grade1'];
    $grade2 = $_REQUEST['grade2'];
    $grade3 = $_REQUEST['grade3'];
    $grade4 = $_REQUEST['grade4'];
    $grade5 = $_REQUEST['grade5'];
    $grade6 = $_REQUEST['grade6'];
    $percentage1 = $_REQUEST['percentage1'];
    $percentage2 = $_REQUEST['percentage2'];
    $percentage3 = $_REQUEST['percentage3'];
    $percentage4 = $_REQUEST['percentage4'];
    $percentage5 = $_REQUEST['percentage5'];
    $percentage6 = $_REQUEST['percentage6'];
    $weight1 = $_REQUEST['weight1'];
    $weight2 = $_REQUEST['weight2'];
    $weight3 = $_REQUEST['weight3'];
    $weight4 = $_REQUEST['weight4'];
    $weight5 = $_REQUEST['weight5'];
    $weight6 = $_REQUEST['weight6'];
    $metalWt = $_REQUEST['metalWt'];
    $metalWt1 = $_REQUEST['metalWt1'];
    $pvcWeightField = $_REQUEST['pvcWeightField'];
    $pvcWeightField1 = $_REQUEST['pvcWeightField1'];
    $gulla1 = $_REQUEST['gulla1'];
    $gulla2 = $_REQUEST['gulla1'];
    $waste1 = $_REQUEST['waste1'];
    $waste2 = $_REQUEST['waste2'];

    $sql = "UPDATE `cableProduction` 
        SET `productCat` = '$prodCat', 
            `description` = '$descriptionSelect', 
            `quantity` = '$quantityField', 
            `unit` = '$unit', 
            `date` = '$curDate', 
            `type` = '$type', 
            `factor` = '$factor', 
            `strand` = '$stand', 
            `guage` = '$gauge', 
            `core` = '$core', 
            `twisting` = '$twisting', 
            `coilWt` = '$coil_wt', 
            `length` = '$length', 
            `grade1` = '$grade1', 
            `grade2` = '$grade2', 
            `grade3` = '$grade3', 
            `grade4` = '$grade4', 
            `grade5` = '$grade5', 
            `grade6` = '$grade6', 
            `percentage1` = '$percentage1', 
            `percentage2` = '$percentage2', 
            `percentage3` = '$percentage3', 
            `percentage4` = '$percentage4', 
            `percentage5` = '$percentage5', 
            `percentage6` = '$percentage6', 
            `weight1` = '$weight1', 
            `weight2` = '$weight2', 
            `weight3` = '$weight3', 
            `weight4` = '$weight4', 
            `weight5` = '$weight5', 
            `weight6` = '$weight6', 
            `copper` = '$metalWt', 
            `copper1` = '$metalWt1', 
            `PVCWeight1` = '$pvcWeightField', 
            `PVCWeight2` = '$pvcWeightField1', 
            `gullaText` = '$gulla1', 
            `wasteText` = '$gulla2', 
            `gullaAmount` = '$waste1', 
            `wasteAmount` = '$waste2' 
        WHERE `tranId` = '$tranId'"; // Update based on transaction ID or any unique identifier

if ($conn->exec($sql)) {
    echo '<script>alert("Data has been updated successfully");window.location = "cableProduction.php";</script>';
} else {
    echo '<script>alert("Failed");window.location = "cableProduction.php";</script>';
}

}

///get cable production
$productionSql = "SELECT * FROM `cableProduction`";
$productionResult = $conn->query($productionSql);

if (isset($_REQUEST['delCalbleProduction'])) {
    $delCalbleProduction = $_REQUEST['delCalbleProduction'];
    $delSql = "DELETE FROM `cableProduction` WHERE id='$delCalbleProduction'";
    $delResult = $conn->exec($delSql);
    if ($delResult == true) {
        echo 'window.location = "cableProduction.php";</script>';
    } else {
        echo '<script>alert("Failed");window.location = "cableProduction.php";</script>';
    }
}
?>
<script>
    ///for get description
    function showUser1234(str) {
        document.getElementById('prodCatdata').value = str;
        if (str === "") {
            // Clear inputs and table rows
            document.querySelector(".descriptionSelect").innerHTML = "<option value=''>Select Description</option>";
            document.querySelector(".rateInput").style.display = "none";
            document.querySelector(".unitInput").style.display = "none";
            var tableBody = document.querySelector("#itemTable tbody");
            if (tableBody) {
                tableBody.innerHTML = ""; // Clear all rows within tbody
            }
            return;
        }

        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest(); // code for modern browsers
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // code for older IE
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var response = JSON.parse(xmlhttp.responseText);

                // Save descriptions data for later use
                descriptionsData = response.descriptions;

                var totalQuantity = 0;
                var grossTotal = 0;

                // Populate table with items
                var tableBody = document.querySelector("#itemTable tbody");

                // Update description dropdown
                var descriptionSelect = document.querySelector(".descriptionSelect");
                descriptionSelect.innerHTML = "<option value=''>Select Description</option>" +
                    response.descriptions.map(function(descriptionData) {
                        return "<option value='" + descriptionData.description + "'>" + descriptionData.description + "</option>";
                    }).join("");

                // Hide rate and unit inputs initially
                document.querySelector(".rateInput").style.display = "none";
                document.querySelector(".unitInput").style.display = "none";

                // Show rate and unit inputs when a description is selected
                descriptionSelect.addEventListener("change", function() {
                    var selectedDescription = this.value;
                    var selectedData = descriptionsData.find(desc => desc.description === selectedDescription);

                    if (selectedData) {
                        document.querySelector(".rateInput").value = selectedData.rate;
                        document.querySelector(".unitInput").value = selectedData.unit;
                        document.querySelector(".rateInput").style.display = "block";
                        document.querySelector(".unitInput").style.display = "block";
                    } else {
                        document.querySelector(".rateInput").style.display = "none";
                        document.querySelector(".unitInput").style.display = "none";
                    }
                });
            }
        };

        xmlhttp.open("GET", "getGoodsGroupData.php?q=" + encodeURIComponent(str), true);
        xmlhttp.send();
    }
</script>
<!-- Begin page -->
<div id="layout-wrapper">
    <!-- ========== Header Start ========== -->
    <?php include_once('include/header.php'); ?>
    <!-- ========== Header End ========== -->
    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once('include/left-side-menu.php'); ?>
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
                            <h4 class="mb-sm-0">Cable Production </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                                    <li class="breadcrumb-item active">Cable Production</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <!-- end row -->
                    <div class="row" id="addNewPurchase">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Add New Cable Production</h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label class="form-label">Prod Category</label>
                                                        <select id="vendorList" name="prodCat" class="form-select" onChange="showUser1234(this.value)" required>
                                                            <option value="">Select Prod Category</option>
                                                            <?php
                                                            while ($rowGroup = $groupList_Q->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                                <option value="<?php echo $rowGroup['name']; ?>" <?php if($cableProductionrow['productCat'] == $rowGroup['name']) echo "selected";?>><?php echo $rowGroup['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label class="form-label">Description</label>
                                                        <select id="descriptionSelect" name="descriptionSelect" class="form-select descriptionSelect" required>
                                                            <option value="<?php echo $cableProductionrow['description'];?>"><?php echo $cableProductionrow['description'];?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="quantityField" class="form-label">Quantity</label>
                                                        <input type="text" class="form-control" id="quantityField" name="quantityField" value="<?php echo $cableProductionrow['quantity'];?>" placeholder="Quantity" required />
                                                    </div>
                                                </div>


                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Unit</label>
                                                        <input type="text" class="form-control" name="unit" placeholder="Unit" value="<?php echo $cableProductionrow['unit'];?>" data-provider="flatpickr" required />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Trans. ID</label>
                                                        <input type="text" class="form-control" name="tranId"  value="<?php echo $cableProductionrow['tranId'];?>" readonly required />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Trans. Date</label>
                                                        <input type="date" class="form-control" name="curDate" value="<?php echo $cableProductionrow['date'];?>" required />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Metal</h4>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div id="customerList">
                                                                <div class="table-responsive table-card mt-3 mb-1">
                                                                    <table class="table align-middle table-nowrap" id="customerTable">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Type</th>
                                                                                <th>Factor</th>
                                                                                <th>Stand</th>
                                                                                <th>Guage</th>
                                                                                <th>Core</th>
                                                                                <th>Twisting(%)</th>
                                                                                <th>Coil Wt.</th>
                                                                                <th>Length</th>
                                                                                <th>Stock</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="list form-check-all">
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="type" style="width: 120px;" value="<?php echo $cableProductionrow['type'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="factor" style="width: 120px;" value="<?php echo $cableProductionrow['factor'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="stand" style="width: 120px;" value="<?php echo $cableProductionrow['strand'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="gauge" style="width: 120px;" value="<?php echo $cableProductionrow['guage'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="core" style="width: 120px;" value="<?php echo $cableProductionrow['core'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="twisting" style="width: 120px;" value="<?php echo $cableProductionrow['twisting'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="coil_wt" style="width: 120px;" value="<?php echo $cableProductionrow['coilWt'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="length" id="lengthData" style="width: 120px;" value="<?php echo $cableProductionrow['length'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="stock" style="width: 120px;" value="<?php echo $cableProductionrow['stocks'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>

                                                                    </table>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">PVC</h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="card">
                                                        <div class="card-body border mt-4">
                                                            <div id="customerList">
                                                                <div class="table-responsive table-card  mb-1">
                                                                    <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th></th>
                                                                                <th>Grade</th>
                                                                                <th>%</th>
                                                                                <th>Weight</th>
                                                                                <th>Stock</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="list form-check-all">
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        inner
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade1" style="width: 120px;" value="<?php echo $cableProductionrow['grade1'];?>" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage1" id="percentage1" value="<?php echo $cableProductionrow['percentage1'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight1" id="weight1" value="<?php echo $cableProductionrow['weight1'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Middle
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade2" style="width: 120px;" value="<?php echo $cableProductionrow['grade2'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage2" id="percentage2" value="<?php echo $cableProductionrow['percentage2'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight2" id="weight2" value="<?php echo $cableProductionrow['weight2'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Sheater
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade3" style="width: 120px;" value="<?php echo $cableProductionrow['grade3'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage3" id="percentage3" value="<?php echo $cableProductionrow['percentage3'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight3" id="weight3" value="<?php echo $cableProductionrow['weight3'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        M.B/
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade4" style="width: 120px;" value="<?php echo $cableProductionrow['grade4'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage4" id="percentage4" value="<?php echo $cableProductionrow['percentage4'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight4" id="weight4" value="<?php echo $cableProductionrow['weight4'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Other 1
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade5" style="width: 120px;" value="<?php echo $cableProductionrow['grade5'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage5" id="percentage5" value="<?php echo $cableProductionrow['percentage5'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight5" id="weight5" value="<?php echo $cableProductionrow['weight5'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Other 2
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="grade6" style="width: 120px;" value="<?php echo $cableProductionrow['grade6'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage6" id="percentage6" value="<?php echo $cableProductionrow['percentage6'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight6" id="weight6" value="<?php echo $cableProductionrow['weight6'];?>" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="card">
                                                        <div class="card-body border mt-4">
                                                            <div id="customerList">
                                                                <div class="table-responsive table-card  mb-1">
                                                                    <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th></th>
                                                                                <th>Actual</th>
                                                                                <th>Production</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="list form-check-all">
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Copper
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="metalWt" id="metalWt" value="<?php echo $cableProductionrow['copper'];?>" autocomplete="off" readonly />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
    <div class="form-group" id="">
        <input type="text" class="form-control" name="metalWt1" id="metalWt1" placeholder="" autocomplete="off" value="<?php echo $cableProductionrow['copper1'];?>" onkeypress="calculateOnKeyPress(event)">
    </div>
</td>

                                                                                
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        PVC Weight
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="pvcWeightField" id="pvcWeightField" value="<?php echo $cableProductionrow['PVCWeight1'];?>" autocomplete="off" required readonly>
                                                                                    </div>
                                                                                </td>


                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="pvcWeightField1" id="pvcWeightField1" value="<?php echo $cableProductionrow['PVCWeight2'];?>" autocomplete="off" required readonly/>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Gulla Weight
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="gulla1" value="<?php echo $cableProductionrow['gullaText'];?>" placeholder="Enter Gulla Text" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="gulla2" value="<?php echo $cableProductionrow['wasteText'];?>" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Waste Weight
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="textarea1">
                                                                                        <input type="text" class="form-control" name="waste1" id="" placeholder="Enter Waste Text" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="waste2" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <input type="submit" name="main_submit" class="btn btn-info" style="background-color:#0ab39c;">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
function calculateOnKeyPress() {
    // Get the values and parse them
    const coilWt = parseFloat(document.querySelector('[name="coil_wt"]').value); // Coil weight input
    const metalWt1 = parseFloat(document.querySelector('[name="metalWt1"]').value); // Metal weight input
    const lengthData = parseFloat(document.getElementById('lengthData').value); // Length data input
    const totalMeter = parseFloat(document.getElementById('quantityField').value); // Assuming totalMeter is set somewhere

    // Calculate PVC Weight
    const constmetalWtIs = (totalMeter / lengthData) * metalWt1; // Intermediate value
    const pvcWeight = (totalMeter / lengthData) * coilWt - constmetalWtIs; // Final PVC weight

    // Get percentage values
    const percentage1 = parseFloat(document.getElementById('percentage1').value) || 0;
    const percentage2 = parseFloat(document.getElementById('percentage2').value) || 0;
    const percentage3 = parseFloat(document.getElementById('percentage3').value) || 0;
    const percentage4 = parseFloat(document.getElementById('percentage4').value) || 0;
    const percentage5 = parseFloat(document.getElementById('percentage5').value) || 0;
    const percentage6 = parseFloat(document.getElementById('percentage6').value) || 0;

    // Calculate percentages based on pvcWeight
    const percentageIs1 = (percentage1 / 100) * metalWt1;
    const percentageIs2 = (percentage2 / 100) * metalWt1;
    const percentageIs3 = (percentage3 / 100) * metalWt1;
    const percentageIs4 = (percentage4 / 100) * metalWt1;
    const percentageIs5 = (percentage5 / 100) * metalWt1;
    const percentageIs6 = (percentage6 / 100) * metalWt1;
    const pvcWtIs = (totalMeter / lengthData) * coilWt - metalWt1; // Assuming totalMeter is already in meters

    // Set the calculated values in the respective fields
    document.getElementById('pvcWeightField1').value = pvcWtIs.toFixed(2);
    document.getElementById('weight1').value = percentageIs1.toFixed(2);
    document.getElementById('weight2').value = percentageIs2.toFixed(2);
    document.getElementById('weight3').value = percentageIs3.toFixed(2);
    document.getElementById('weight4').value = percentageIs4.toFixed(2);
    document.getElementById('weight5').value = percentageIs5.toFixed(2);
    document.getElementById('weight6').value = percentageIs6.toFixed(2);
}

// Event listener for the metalWt1 input field
document.querySelector('[name="metalWt1"]').addEventListener('input', function () {
    // Call the calculation function
    calculateOnKeyPress();
});


        
    </script>

    <!-- End Page-content -->
    <!-- footer start -->
    <?php include_once('include/footer.php'); ?>