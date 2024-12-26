<?php
include_once('config.php');
include_once('include/auth.php');
include_once('include/auth.php');
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

    $sql = "INSERT INTO `cableProduction`(`productCat`, `description`, `quantity`, `unit`, `tranId`, `date`, `type`, `factor`, `strand`, `guage`, `core`, `twisting`, `coilWt`, `length`, `grade1`, `grade2`, `grade3`, `grade4`, `grade5`, `grade6`, `percentage1`, `percentage2`, `percentage3`, `percentage4`, `percentage5`, `percentage6`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `weight6`, `copper`, `copper1`, `PVCWeight1`, `PVCWeight2`, `gullaText`, `wasteText`, `gullaAmount`, `wasteAmount`) VALUES ('$prodCat','$descriptionSelect','$quantityField','$unit','$tranId','$curDate','$type','$factor','$stand','$gauge','$core','$twisting','$coil_wt','$length','$grade1','$grade2','$grade3','$grade4','$grade5','$grade6','$percentage1','$percentage2','$percentage3','$percentage4','$percentage5','$percentage6','$weight1','$weight2','$weight3','$weight4','$weight5','$weight6','$metalWt','$metalWt1','$pvcWeightField','$pvcWeightField1','$gulla1','$gulla2','$waste1','$waste2')";
    if ($conn->exec($sql)) {
        echo '<script>alert("Data has been saved successfully");window.location = "cableProduction.php";</script>';
?>
<?php
    } else {
        $messageAction1 = '<div class="mx-3 mt-3">
       <h6 class="alert alert-danger"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Data has been not saved</h6></div>';
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
                                                                <option value="<?php echo $rowGroup['name']; ?>"><?php echo $rowGroup['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label class="form-label">Description</label>
                                                        <select id="descriptionSelect" name="descriptionSelect" class="form-select descriptionSelect" required>
                                                            <option value="">Select Description</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="quantityField" class="form-label">Quantity</label>
                                                        <input type="text" class="form-control" id="quantityField" name="quantityField" placeholder="Quantity" required readonly />
                                                    </div>
                                                </div>


                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Unit</label>
                                                        <input type="text" class="form-control" name="unit" placeholder="Unit" data-provider="flatpickr" required />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Trans. ID</label>
                                                        <?php
                                                        $rand = rand(999, 100);
                                                        $tranNo = substr(strtotime(date('h:i:s')) + $rand, -4);
                                                        ?>
                                                        <input type="text" class="form-control" name="tranId" placeholder="Trans. ID" value="<?php echo $tranNo; ?>" required />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-4">
                                                        <label for="" class="form-label">Trans. Date</label>
                                                        <input type="date" class="form-control" name="curDate" value="<?php echo date('Y-m-d') ?>" required />
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
                                                                                        <input type="text" class="form-control" name="type" style="width: 120px;" placeholder="Type" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="factor" style="width: 120px;" placeholder="Factor" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="stand" style="width: 120px;" placeholder="Stand" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="gauge" style="width: 120px;" placeholder="Gauge" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="core" style="width: 120px;" placeholder="Core" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="twisting" style="width: 120px;" placeholder="Twisting" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="coil_wt" style="width: 120px;" placeholder="Coil Wt." autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="length" id="lengthData" style="width: 120px;" placeholder="Length" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="stock" style="width: 120px;" placeholder="Stock" autocomplete="off" />
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
                                            <script>
                                                document.getElementById('descriptionSelect').addEventListener('change', function() {
                                                    var description = this.value;

                                                    if (description !== "") {
                                                        //alert(description);
                                                        document.getElementById('prodDescdataIs').value=description;
                                                        // Send AJAX request to check if the description exists
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.open("POST", "checkDescriptionData.php", true);
                                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                        xhr.onreadystatechange = function() {
                                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                                try {
                                                                    var response = JSON.parse(xhr.responseText); // Parse JSON
                                                                    if (response.status === 'success') {
                                                                        // Update the fields in the table
                                                                        document.querySelector('input[name="unit"]').value = response.tableData.unit;
                                                                        document.querySelector('input[name="type"]').value = response.tableData.type;
                                                                        document.querySelector('input[name="factor"]').value = response.tableData.factor;
                                                                        document.querySelector('input[name="stand"]').value = response.tableData.stand;
                                                                        document.querySelector('input[name="gauge"]').value = response.tableData.gauge;
                                                                        document.querySelector('input[name="core"]').value = response.tableData.core;
                                                                        document.querySelector('input[name="twisting"]').value = response.tableData.twisting;
                                                                        document.querySelector('input[name="coil_wt"]').value = response.tableData.coil_wt;
                                                                        document.querySelector('input[name="length"]').value = response.tableData.length;
                                                                        document.querySelector('input[name="stock"]').value = response.tableData.stock;
                                                                        document.querySelector('input[name="grade1"]').value = response.tableData.grade1;
                                                                        document.querySelector('input[name="grade2"]').value = response.tableData.grade2;
                                                                        document.querySelector('input[name="grade3"]').value = response.tableData.grade3;
                                                                        document.querySelector('input[name="grade4"]').value = response.tableData.grade4;
                                                                        document.querySelector('input[name="grade5"]').value = response.tableData.grade5;
                                                                        document.querySelector('input[name="grade6"]').value = response.tableData.grade6;
                                                                        document.querySelector('input[name="percentage1"]').value = response.tableData.percentage1;
                                                                        document.querySelector('input[name="percentage2"]').value = response.tableData.percentage2;
                                                                        document.querySelector('input[name="percentage3"]').value = response.tableData.percentage3;
                                                                        document.querySelector('input[name="percentage4"]').value = response.tableData.percentage4;
                                                                        document.querySelector('input[name="percentage5"]').value = response.tableData.percentage5;
                                                                        document.querySelector('input[name="percentage6"]').value = response.tableData.percentage6;
                                                                        document.querySelector('input[name="metalWt"]').value = response.tableData.metalWt;
                                                                        document.querySelector('input[name="metalWt1"]').value = response.tableData.metalWt1;
                                                                    } else {
                                                                        // Show alert if data not available
                                                                        alert(response.message);
                                                                    }
                                                                } catch (e) {
                                                                    console.error('Error parsing JSON:', e.message); // Catch JSON parsing errors
                                                                    alert('Error parsing JSON: ' + e.message); // Alert for debugging
                                                                }
                                                            }
                                                        };

                                                        xhr.send("description=" + description);
                                                    }
                                                });
                                            </script>
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
                                                                                        <input type="text" class="form-control" name="grade1" style="width: 120px;" placeholder="Grade" autocomplete="off" required />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage1" id="percentage1" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight1" id="weight1" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="grade2" style="width: 120px;" placeholder="Grade" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage2" id="percentage2" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight2" id="weight2" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="grade3" style="width: 120px;" placeholder="Grade" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage3" id="percentage3" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight3" id="weight3" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="grade4" style="width: 120px;" placeholder="Grade" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage4" id="percentage4" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight4" id="weight4" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="grade5" style="width: 120px;" placeholder="Grade" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage5" id="percentage5" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight5" id="weight5" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="grade6" style="width: 120px;" placeholder="Grade" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="percentage6" id="percentage6" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>

                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="weight6" id="weight6" placeholder="" autocomplete="off" />
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
                                                                                        <input type="text" class="form-control" name="metalWt" id="metalWt" placeholder="" autocomplete="off" readonly />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
    <div class="form-group" id="">
        <input type="text" class="form-control" name="metalWt1" id="metalWt1" placeholder="" autocomplete="off" required="" onkeypress="calculateOnKeyPress(event)">
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
                                                                                        <input type="text" class="form-control" name="pvcWeightField" id="pvcWeightField" placeholder="PVC Weight" autocomplete="off" required readonly>
                                                                                    </div>
                                                                                </td>


                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="pvcWeightField1" id="pvcWeightField1" placeholder="" autocomplete="off" required readonly/>
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
                                                                                        <input type="text" class="form-control" name="gulla1" id="" placeholder="Enter Gulla Text" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        <input type="text" class="form-control" name="gulla2" id="" placeholder="" autocomplete="off" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-bottom-0">
                                                                                    <div class="form-group" id="">
                                                                                        Metal Weight
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="customerList">
                                    <!--========================== Show Data ==========================-->

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap" id="example">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Qty</th>
                                                    <th>Units</th>
                                                    <th>Copper Wt.</th>
                                                    <th>PVC Wt.</th>
                                                    <th>Gulla</th>
                                                    <th>Waste</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php
                                                while ($productionRow = $productionResult->fetch(PDO::FETCH_ASSOC)) {
                                                    @extract($productionRow);
                                                ?>
                                                    <tr>
                                                        <td><?= $date ?></td>
                                                        <td><?= $productCat ?></td>
                                                        <td><?= $description ?></td>
                                                        <td><?= $quantity ?></td>
                                                        <td><?= $unit ?></td>
                                                        <td><?= $copper1 ?></td>
                                                        <td><?= $PVCWeight2 ?></td>
                                                        <td><?= $gullaAmount ?></td>
                                                        <td><?= $wasteAmount ?></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
																    <a href="editcableProduction.php?cableProductionId=<?= $id ?>" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
															    </div>
                                                                <div class="mx-2">
                                                                    <a href="?delCalbleProduction=<?= $id ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger remove-item-btn" name="purchase_delete">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for entering length, quantity, unit -->
    <div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        
                        <form action="" method="POST" id="quantityForm">
                            <div style="display:flex;">
                                    <input type="hidden" class="form-control" id="prodCatdata"/>
                                    <input type="hidden" class="form-control" id="prodDescdataIs"/>
                                <div class="form-group col-sm-3">
                                    <label for="lengthInput">Length</label>
                                    <input type="number" class="form-control" id="lengthInput" placeholder="Enter Length" required />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="quantityInput">Quantity</label>
                                    <input type="number" class="form-control" id="quantityInput" placeholder="Enter Quantity" required />
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="unitInput">Unit</label>
                                    <select id="unitInput" class="form-control">
                                        <option value="coil">Coil</option>
                                    </select>
                                    <!--<input type="text" class="form-control" id="unitInput" placeholder="Enter Unit" required />-->
                                </div>
                                <div class="form-group col-sm-2 align-content-end">
                                    <label for="unitInput">&nbsp; &nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-primary" id="addQuantity">Add</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <table class="table" id="quantityTable">
                        <thead>
                            <tr>
                                <th>Length</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Meter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <p>Total Meter: <span id="totalMeter">0</span></p>
                    <button type="button" class="btn btn-success" id="saveQuantity">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let totalMeter = 0; // Initialize total meter
        // Function to open the modal when Quantity field is clicked
        document.getElementById('quantityField').addEventListener('click', function() {
            $('#quantityModal').modal('show'); // Show the modal
        });

// Event listener for adding a new quantity entry
document.getElementById('addQuantity').addEventListener('click', function() {
    //alert(selectedDescription);
    const prodCatIs = document.getElementById('prodCatdata').value;
    const prodDescdata = document.getElementById('prodDescdataIs').value;
    const length = parseFloat(document.getElementById('lengthInput').value);
    const quantity = parseFloat(document.getElementById('quantityInput').value);
    const unit = document.getElementById('unitInput').value;

    if (!isNaN(length) && !isNaN(quantity) && unit && prodCatIs && prodDescdata) {
        const meter = length * quantity; // Calculate meter
        totalMeter += meter; // Update total meter

        // Create a new row for the table
        const newRow = `<tr>
                        <td>${length}</td>
                        <td>${quantity}</td>
                        <td>${unit}</td>
                        <td>${meter.toFixed(2)}</td>
                        <td><button class="btn btn-danger remove-row">Remove</button></td>
                      </tr>`;

        // Insert the new row into the table
        document.querySelector('#quantityTable tbody').insertAdjacentHTML('beforeend', newRow);
        document.getElementById('totalMeter').innerText = totalMeter.toFixed(2); // Update total meter display

        // Send the data to the server via AJAX to insert into the database
        const data = {
            length: length,
            quantity: quantity,
            unit: unit,
            prodCatIs: prodCatIs,
            prodDescdata: prodDescdata
        };

        jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "saveQuantityData.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:data, //Form variables
        	success:function(response){
        	//alert(response);
        		},
        	});

        // Clear the input fields after adding the entry
        document.getElementById('lengthInput').value = '';
        document.getElementById('quantityInput').value = '';
        document.getElementById('unitInput').value = '';
    } else {
        alert('Please enter valid data. & Select Prod Category');
    }
});



        // Event listener for removing a row from the table
        document.getElementById('quantityTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const row = e.target.closest('tr');
                const meter = parseFloat(row.querySelector('td:nth-child(4)').textContent);

                totalMeter -= meter; // Update total meter value
                document.getElementById('totalMeter').innerText = totalMeter.toFixed(2); // Update total meter display
                row.remove(); // Remove the row from the table
            }
        });


// Function to calculate the total meter based on all rows
function updateTotalMeter() {
    let totalMeter = 0;
    document.querySelectorAll('.meter-cell').forEach(cell => {
        totalMeter += parseFloat(cell.innerText);
    });
    document.getElementById('totalMeter').innerText = totalMeter.toFixed(2);
}

// Event listener for the Add button to add data to the table
document.getElementById('addQuantity').addEventListener('click', function() {
    const length = parseFloat(document.getElementById('lengthInput').value);
    const quantity = parseFloat(document.getElementById('quantityInput').value);
    const unit = document.getElementById('unitInput').value;

    if (!isNaN(length) && !isNaN(quantity)) {
        const meter = length * quantity;
        const tableRow = `
            <tr>
                <td>${length}</td>
                <td>${quantity}</td>
                <td>${unit}</td>
                <td class="meter-cell">${meter}</td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
            </tr>`;
        
        document.querySelector('#quantityTable tbody').insertAdjacentHTML('beforeend', tableRow);
        updateTotalMeter();

        document.getElementById('lengthInput').value = '';
        document.getElementById('quantityInput').value = '';
    } else {
        // alert('Please enter valid Length and Quantity.');
    }
});

// Event listener for the OK button to calculate PVC Weight and update Quantity field
document.getElementById('saveQuantity').addEventListener('click', function() {
    const totalMeter = parseFloat(document.getElementById('totalMeter').innerText); // Updated to fetch from display
    const coilWt = parseFloat(document.querySelector('[name="coil_wt"]').value);
    const metalWt1 = parseFloat(document.querySelector('[name="metalWt1"]').value);
    const lengthData = parseFloat(document.getElementById('lengthData').value);

    if (!isNaN(totalMeter) && !isNaN(coilWt) && !isNaN(metalWt1) && !isNaN(lengthData)) {
        const constmetalWtIs = (totalMeter / lengthData) * metalWt1;
        const pvcWeight = (totalMeter / lengthData) * coilWt - constmetalWtIs;

        // Calculate each weight based on percentages (if provided)
        const percentageFields = ['percentage1', 'percentage2', 'percentage3', 'percentage4', 'percentage5', 'percentage6'];
        percentageFields.forEach((id, index) => {
            const percentage = parseFloat(document.getElementById(id).value);
            if (!isNaN(percentage)) {
                document.getElementById(`weight${index + 1}`).value = ((percentage / 100) * pvcWeight).toFixed(2);
            }
        });

        // Set final calculated values
        document.getElementById('metalWt').value = constmetalWtIs.toFixed(2);
        document.getElementById('pvcWeightField').value = pvcWeight.toFixed(2);
        document.getElementById('quantityField').value = totalMeter.toFixed(2);

        $('#quantityModal').modal('hide');  // Close the modal
    } else {
        alert('Please ensure all values are filled correctly.');
    }
});

// Event listener to delete row and update totalMeter
document.querySelector('#quantityTable tbody').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-row')) {
        event.target.closest('tr').remove();
        updateTotalMeter(); // Recalculate total meter after deletion
    }
});

// Function to update the total meter
function updateTotalMeter() {
    let totalMeter = 0;
    document.querySelectorAll('.meter-cell').forEach(cell => {
        totalMeter += parseFloat(cell.innerText);
    });
    document.getElementById('totalMeter').innerText = totalMeter.toFixed(2);
}

document.getElementById('saveQuantity').addEventListener('click', function() {
            const coilWt = parseFloat(document.querySelector('[name="coil_wt"]').value); // Assuming you have a coil weight input
            const metalWt1 = parseFloat(document.querySelector('[name="metalWt1"]').value); // Assuming you have a metal weight input
            const lengthData = parseFloat(document.getElementById('lengthData').value); // Assuming you have a metal weight input
            const percentage1 = parseFloat(document.getElementById('percentage1').value);
            const percentage2 = parseFloat(document.getElementById('percentage2').value);
            const percentage3 = parseFloat(document.getElementById('percentage3').value);
            const percentage4 = parseFloat(document.getElementById('percentage4').value);
            const percentage5 = parseFloat(document.getElementById('percentage5').value);
            const percentage6 = parseFloat(document.getElementById('percentage6').value);
            const metalWt = parseFloat(document.querySelector('[name="metalWt"]').value);
            if (!isNaN(totalMeter) && !isNaN(coilWt) && !isNaN(metalWt1)) {
                // Calculate PVC Weight
                const constmetalWtIs = (totalMeter / lengthData) * metalWt1;
                const pvcWeight = (totalMeter / lengthData) * coilWt - constmetalWtIs; // Assuming totalMeter is already in meters
                const percentageIs1 = (percentage1 / 100) * pvcWeight;
                const percentageIs2 = (percentage2 / 100) * pvcWeight;
                const percentageIs3 = (percentage3 / 100) * pvcWeight;
                const percentageIs4 = (percentage4 / 100) * pvcWeight;
                const percentageIs5 = (percentage5 / 100) * pvcWeight;
                const percentageIs6 = (percentage6 / 100) * pvcWeight;
                // Set the calculated PVC Weight in the PVC Weight field
                document.getElementById('metalWt').value = constmetalWtIs.toFixed(2); // Display the calculated PVC Weight
                document.getElementById('metalWt1').value = constmetalWtIs.toFixed(2); // Display the calculated PVC Weight
                document.getElementById('pvcWeightField').value = pvcWeight.toFixed(2); // Display the calculated PVC Weight
                document.getElementById('pvcWeightField1').value = pvcWeight.toFixed(2); // Display the calculated PVC Weight
                // weight 1
                document.getElementById('weight1').value = percentageIs1.toFixed(2);
                // weight 2
                document.getElementById('weight2').value = percentageIs2.toFixed(2);
                // weight 3
                document.getElementById('weight3').value = percentageIs3.toFixed(2);
                // weight 4
                document.getElementById('weight4').value = percentageIs4.toFixed(2);
                // weight 5
                document.getElementById('weight5').value = percentageIs5.toFixed(2);
                // weight 6
                document.getElementById('weight6').value = percentageIs6.toFixed(2);
                // Set the total meter in the Quantity field
                document.getElementById('quantityField').value = totalMeter.toFixed(2);
                $('#quantityModal').modal('hide'); // Close the modal
                // Optionally: Send the data to the server using AJAX to save in the database
            } else {
                alert('Please ensure all values are valid numbers before saving.');
            }
        });

// Event listener to delete row and update totalMeter
document.querySelector('#quantityTable tbody').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-row')) {
        event.target.closest('tr').remove();
        updateTotalMeter();
    }
});

        
        
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