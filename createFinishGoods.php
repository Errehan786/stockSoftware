<?php
include_once('config.php');
include_once('include/auth.php');

if (isset($_REQUEST['main_submit'])) {
	$group_name = $_REQUEST['group_name'];
	$description = $_REQUEST['description'];
	$stock = $_REQUEST['stock'];
	$stockLimit = $_REQUEST['stockLimit'];
	$units = $_REQUEST['units'];
	$cpUnit = $_REQUEST['cpUnit'];
	$type_name = $_REQUEST['type_name'];
	$factor_name = $_REQUEST['factor_name'];
	$stands = $_REQUEST['stands'];
	$gauge_name = $_REQUEST['gauge_name'];
	$coreIs = $_REQUEST['coreIs'];
	$twisting_name = $_REQUEST['twisting_name'];
	$coilWt = $_REQUEST['coilWt'];
	$length = $_REQUEST['length'];
	$metalWt = $_REQUEST['metalWt'];
	$drawing = $_REQUEST['drawing'];
	$rRateField = $_REQUEST['rRateField'];
	$grade1 = $_REQUEST['grade1'];
	$grade2 = $_REQUEST['grade2'];
	$grade3 = $_REQUEST['grade3'];
	$grade4 = $_REQUEST['grade4'];
	$grade5 = $_REQUEST['grade5'];
	$grade6 = $_REQUEST['grade6'];
	$avgRate1 = $_REQUEST['avgRate1'];
	$avgRate2 = $_REQUEST['avgRate2'];
	$avgRate3 = $_REQUEST['avgRate3'];
	$avgRate4 = $_REQUEST['avgRate4'];
	$avgRate5 = $_REQUEST['avgRate5'];
	$avgRate6 = $_REQUEST['avgRate6'];
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
	$amount1 = $_REQUEST['amount1'];
	$amount2 = $_REQUEST['amount2'];
	$amount3 = $_REQUEST['amount3'];
	$amount4 = $_REQUEST['amount4'];
	$amount5 = $_REQUEST['amount5'];
	$amount6 = $_REQUEST['amount6'];
	$pvcWt = $_REQUEST['pvcWt'];
	$avrateTotal = $_REQUEST['avrateTotal'];
	$finalTotalAmount = $_REQUEST['finalTotalAmount'];
	$labourPercentage = $_REQUEST['labourPercentage'];
	$packagingCharges = $_REQUEST['packagingCharges'];
	$finalProductRate = $_REQUEST['finalProductRate'];
	$completeFinalAmount_is = $_REQUEST['completeFinalAmount_is'];
	
	$sql = "INSERT INTO `finishGoods`(`groupName`, `description`, `openingStock`, `stockLimit`, `Unit`, `costPrice`, `Rate`, `type`, `factor`, `strand`, `guage`, `core`, `twisting`, `coilWt`, `length`, `metalWt`, `drawing`, `rRate`, `grade1`, `grade2`, `grade3`, `grade4`, `grade5`, `grade6`, `avgRate1`, `avgRate2`, `avgRate3`, `avgRate4`, `avgRate5`, `avgRate6`, `percentage1`, `percentage2`, `percentage3`, `percentage4`, `percentage5`, `percentage6`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `weight6`, `amount1`, `amount2`, `amount3`, `amount4`, `amount5`, `amount6`, `PVCWt`, `avjWt`, `totalAmount`, `labourCharge`, `pacCharge`, `ratePer`) VALUES ('$group_name','$description','$stock','$stockLimit','$units','$cpUnit','$completeFinalAmount_is','$type_name','$factor_name','$stands','$gauge_name','$coreIs','$twisting_name','$coilWt','$length','$metalWt','$drawing','$rRateField','$grade1','$grade2','$grade3','$grade4','$grade5','$grade6','$avgRate1','$avgRate2','$avgRate3','$avgRate4','$avgRate5','$avgRate6','$percentage1','$percentage2','$percentage3','$percentage4','$percentage5','$percentage6','$weight1','$weight2','$weight3','$weight4','$weight5','$weight6','$amount1','$amount2','$amount3','$amount4','$amount5','$amount6','$pvcWt','$avrateTotal','$finalTotalAmount','$labourPercentage','$packagingCharges','$finalProductRate')";
	if ($conn->exec($sql)) {
		echo '<script>alert("Data has been saved successfully");window.location = "createFinishGoods.php";</script>';
?>
	<?php
	} else { 
	    echo '<script>alert("Data has been not saved");window.location = "createFinishGoods.php";</script>';
	}
}

///delete item
if (isset($_REQUEST['metrialId'])) {
	$metrialId = $_REQUEST['metrialId'];
	$delSql = "DELETE FROM `finishGoods` WHERE id='$metrialId'";
	if ($delResult = $conn->exec($delSql)) {
	    echo '<script>window.location = "createFinishGoods.php";</script>';
	} else {
	    echo '<script>alert("Data has been not Deleted");window.location = "createFinishGoods.php";</script>';
	}
}

/// get description
$descriptionSql = "SELECT * FROM `rawMeterial` where groupName='PVC'";
$descResult = $conn->query($descriptionSql);

// Fetch all data into an array
$rows = $descResult->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
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
								<h4 class="mb-sm-0">Finished Goods List</h4>
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
										<li class="breadcrumb-item active">Finished Goods List</li>
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
										<div id="childRDelete"></div>
										<?php
										$sql = "SELECT * FROM `finishGoods` order by id desc";
										$result = $conn->query($sql);
										if ($result->rowCount() > 0) {
										?>
											<div class="table-responsive">
												<table class="table align-middle table-nowrap" id="example">
													<thead class="table-light">
														<tr>
														    <th>Sr No</th>
															<th>Group</th>
															<th>Description</th>
															<th>Opening Stock</th>
															<th>Stock Limit</th>
															<th>Conv. in PCS</th>
															<th>Rate</th>
															<th>Unit</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody class="list form-check-all" id="materialData">
														<?php
														$a=1;
														while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
															@extract($row);
														?>
															<tr>
																<td><?php echo $a; ?></td>
																<td><?php echo $groupName; ?></td>
																<td><?php echo $description; ?></td>
																<td><?php echo $openingStock; ?></td>
																<td><?php echo $stockLimit; ?></td>
																<td><?php echo $costPrice; ?></td>
																<td><?php echo $Rate; ?></td>
																<td><?php echo $Unit; ?></td>
																<td>
																	<div class="d-flex gap-2">
																		<div class="edit">
																			<a href="editcreateFinishGoods.php?finishedGoodsId=<?php echo $id; ?>" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
																		</div>
																		<div class="remove">
																			<a href="?metrialId=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
																		</div>
																	</div>
																</td>
															<?php $a++; } ?>
															</tr>
													</tbody>
												</table>
											<?php } ?>
											</div>
									</div>
									<!-- end card -->
								</div>
								<!-- end col -->
							</div>
							<!-- end col -->
						</div>
					</div>
					<!-- end row -->
				</div>


				<div class="container-fluid">
					<form action="" method="POST">
						<div class="row" id="addNewPurchase">
							<div class="col-xxl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Add Finished Goods</h4>
									</div>
									<!-- end card header -->
									<div class="card-body">
										<div class="live-preview">
											<div class="row">
												<div class="col-lg-4">
													<div class="mb-4">
														<?php
														// vender name select code
														$sql = "SELECT * FROM `goodsGroup`";
														$result = $conn->query($sql);
														?>
														<label class="form-label">Select Group</label>
														<select id="vendorList" name="group_name" class="form-select" onChange="createVendor(this.value);getFinishedGoodsData(this.value);" required>
															<option value="">Select Group</option>
															<?php echo '<optgroup label="For a new Group"></optgroup><option>Add New</option>'; ?>
															<hr>
															<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
																<option value="<?php echo $row['name']; ?>">
																	<?php echo htmlspecialchars($row['name']); ?>
																</option>
															<?php } ?>
														</select>
														<script>
														function getFinishedGoodsData(groupName) {
                                                            if (groupName == "") {
                                                                document.getElementById("materialData").innerHTML = ""; // Clear data if no group is selected
                                                                return;
                                                            }
                                                        
                                                            var xhr = new XMLHttpRequest();
                                                            xhr.open("POST", "finishedGoodsData.php", true); // Assuming you have a separate PHP file for fetching data
                                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                            xhr.onreadystatechange = function () {
                                                                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                                                    // Display the fetched data in the tbody
                                                                    document.getElementById("materialData").innerHTML = xhr.responseText;
                                                                }
                                                            };
                                                        
                                                            // Send the group name as POST data
                                                            xhr.send("group_name=" + encodeURIComponent(groupName));
                                                        }
															function createVendor(getVType) {
															    //alert(getVType);
															    document.getElementById('prodCatdata').value = getVType;
																if (getVType === "Add New") {
																	$("#addNewVendor").modal('show'); // Use Bootstrap modal method to show the modal
																}
															}

															function closeVendorModel() {
																$("#addNewVendor").modal('hide'); // Use Bootstrap modal method to hide the modal
															}

															function groupSubmit(event) {
																event.preventDefault(); // Prevent default form submission
																const vendorName = document.vendorForm1.groupName.value;
																if (vendorName === '') {
																	$("#messageVendorTxt1").html('<span style="color: red;"> Enter Group Name</span>');
																	return false;
																}

																$("#groupbutton").addClass('fa-spinner fa-spin');
																const myData = {
																	v_name: vendorName
																};

																jQuery.ajax({
																	type: "POST",
																	url: "submitGoodsData.php",
																	data: myData,
																	success: function(response) {
																		if (response === '0') {
																			$("#messageVendorTxt1").html('<span style="color: red;"> Some error!</span>');
																		} else {
																			$("#messageVendorTxt1").html('<span style="color: green;"> Data has been saved successfully</span>');
																			const newOption = `<option value="${vendorName}">${vendorName}</option>`;
																			$("#vendorList").append(newOption); // Add new option to the dropdown

																			setTimeout(function() {
																				document.vendorForm1.groupName.value = '';
																				$("#addNewVendor").modal('hide'); // Use Bootstrap method to hide modal
																				$("#messageVendorTxt1").html('');
																			}, 1000);
																		}
																		$("#groupbutton").removeClass('fa-spinner fa-spin');
																	},
																	error: function(xhr, ajaxOptions, thrownError) {
																		alert(thrownError);
																	}
																});
																return false;
															}
														</script>
														
													</div>
												</div>
												<script>
												    function myFunctionDesc(descValue){
												        document.getElementById('prodDescdataIs').value = descValue;
												    }
												</script>
												<div class="col-lg-4">
													<div class="mb-3">
														<label class="form-label">Description</label>
														<input type="text" class="form-control" name="description" oninput="myFunctionDesc(this.value)" placeholder="Enter Description" required />
													</div>
												</div>
												<div class="col-lg-4">
													<div class="mb-3">
														<label class="form-label">Opening Stock</label>
														<input type="text" class="form-control" name="stock" id="quantityField" placeholder="Opening stock" readonly required />
													</div>
												</div>
												<div class="col-lg-4">
													<div class=" mb-3">
														<label class="form-label">Stock Limit</label>
														<input type="text" class="form-control" name="stockLimit" placeholder="Enter Stock Limit" />
													</div>
												</div>
												<div class="col-lg-3" style="padding-right: 0;">
													<div class="mb-4">
														<label for="compnayNameinput" class="form-label">Unit</label>
														<select class="form-select" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" name="units" required />
														<option value="">Select Units </option>
														<option value="Kg">Kg</option>
														<option value="Meters">Meters</option>
														<option value="Pcs">Pcs</option>
														</select>
													</div>
												</div>
												<div class="col-lg-2">
													<div class=" mb-3">
														<label class="form-label">Cost Price/Unit</label>
														<input type="text" class="form-control" name="cpUnit" placeholder="Enter Cost Price/Unit" />
													</div>
												</div>
												<div class="col-lg-3" style="display:none;">
													<div class=" mb-3">
														<label class="form-label">Rate</label>
														<input type="text" class="form-control" name="rate" placeholder="Enter Rate" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="card-header align-items-center d-flex">
									<h4 class="card-title mb-0 flex-grow-1">Product Formulation</h4>
								</div>
								<div class="card">
									<div class="card-body">
										<div id="customerList">
											<div class="table-responsive table-card mt-3 mb-1">
												<table class="table align-middle table-nowrap" id="firstTable">
													<thead class="table-light">
														<tr>
															<th>Type</th>
															<th>Factor</th>
															<th>Strand</th>
															<th>Guage</th>
															<th>Core</th>
															<th>Twisting(%)</th>
															<th>Coil Wt.</th>
															<th>Length</th>
															<th>Metal Wt.</th>
															<th>Drawing</th>
															<th>R/Rate</th>
														</tr>
													</thead>
													<tbody class="list form-check-all">
														<td>
															<div class="form-group">
																<?php
																// vendor name select code
																$sql = "SELECT * FROM `type_tbl`";
																$result = $conn->query($sql);
																?>
																<select id="typeList" name="type_name" class="form-select" onChange="createType(this.value)" required>
																	<option value="">Type</option>
																	<?php echo '<optgroup label="For a new Type"></optgroup><option>Add New</option>'; ?>
																	<hr>
																	<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
																		<option value="<?php echo $row['type']; ?>">
																			<?php echo htmlspecialchars($row['type']); ?>
																		</option>
																	<?php } ?>
																</select>
															</div>
														</td>


														<td>
															<div class="form-group" id="textarea1">
																<select id="factorList" class="form-select" name="factor_name" style="width:140px"
																	onChange="createFactor(this.value); calculateMetalWt()" required>
																	<option value="">Select Factor</option>
																	<option value="Add New">Add New</option>
																	<?php
																	// Fetching factors from database
																	$sql = "SELECT * FROM `factor_tbl`";
																	$result = $conn->query($sql);
																	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
																		echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
																	}
																	?>
																</select>
															</div>
														</td>


														<td>
															<div class="form-group">
																<input type="text" class="form-control" name="stands" id="stands" style="width: 100px;" placeholder="strand" onInput="calculateMetalWt()" required />
															</div>
														</td>
														<td>
															<div class="form-group" id="">
																<select id="gaugeList" class="form-select" name="gauge_name" style="width:140px" onChange="createGauge(this.value); calculateMetalWt()" required>
																	<option value="">Select Gauge</option>
																	<option value="Add New">Add New</option>
																	<?php
																	// Fetching gauges from database
																	$sql = "SELECT * FROM `gauge_tbl`";
																	$result = $conn->query($sql);
																	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
																		echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
																	}
																	?>
																</select>
															</div>
														</td>

														<script>
															function createGauge(getGauge) {
																if (getGauge === "Add New") {
																	$("#addNewGauge").modal('show'); // Show the modal
																}
															}

															function gaugeSubmit(event) {
																event.preventDefault(); // Prevent default form submission
																const gaugeName = document.gaugeForm.g_name.value;

																if (gaugeName === '') {
																	$("#messageGaugeTxt").html('<span style="color: red;">Enter Gauge</span>');
																	return false;
																}

																$("#btnGbutton").addClass('fa-spinner fa-spin'); // Show loading spinner

																// AJAX call to submit gauge data
																const myData = {
																	g_name: gaugeName
																};

																jQuery.ajax({
																	type: "POST",
																	url: "submitGaugeData.php", // PHP script to handle data insertion
																	data: myData,
																	success: function(response) {
																		if (response === '0') {
																			$("#messageGaugeTxt").html('<span style="color: red;"> Some error occurred!</span>');
																		} else {
																			$("#messageGaugeTxt").html('<span style="color: green;"> Data saved successfully!</span>');
																			const newOption = `<option value="${gaugeName}">${gaugeName}</option>`;
																			$("#gaugeList").append(newOption); // Add new gauge to the dropdown

																			setTimeout(function() {
																				document.gaugeForm.g_name.value = '';
																				$("#addNewGauge").modal('hide'); // Hide modal after saving
																				$("#messageGaugeTxt").html('');
																			}, 1000);
																		}
																		$("#btnGbutton").removeClass('fa-spinner fa-spin');
																	},
																	error: function(xhr, ajaxOptions, thrownError) {
																		alert(thrownError);
																	}
																});

																return false;
															}
														</script>


														<td>
															<div class="form-group" id="">
																<input type="text" class="form-control" name="coreIs" id="coreIs" style="width: 100px;" placeholder="Core" onInput="calculateMetalWt()" required />
															</div>
														</td>
														<td>
															<div class="form-group">
																<select id="twistingList" class="form-select" name="twisting_name" style="width:140px" onChange="createTwisting(this.value); calculateMetalWt()" required>
																	<option value="">Select Twisting</option>
																	<option value="Add New">Add New</option>
																	<?php
																	// Fetching twisting options from the database
																	$sql = "SELECT * FROM `twisting_tbl`";
																	$result = $conn->query($sql);
																	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
																		echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
																	}
																	?>
																</select>
															</div>
														</td>

														<td>
															<div class="form-group">
																<input type="text" id="coilWt" name="coilWt" class="form-control" placeholder="Coil Wt." style="width: 100px;" required />
															</div>
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" id="length" name="length" placeholder="Length" style="width: 100px;" onInput="calculateMetalWt()" required />
															</div>
														</td>

														<td>
															<div class="form-group">
																<input type="text" id="metalWt" name="metalWt" class="form-control" placeholder="Metal Wt." style="width: 100px;" readonly />
															</div>
														</td>
														<td>
															<div class="form-group" id="">
																<input type="text" class="form-control" name="drawing" name="drawing" id="drawing" placeholder="Drawing" style="width: 100px;" required />
															</div>
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" name="rRateField" id="rRateField" placeholder="R/Rate" style="width: 100px;" required>
															</div>
														</td>
														</tr>

														<script>
															function calculateMetalWt() {
																// Get values from form fields
																const factor = parseFloat(document.getElementById('factorList').value) || 0;
																const stands = parseFloat(document.getElementById('stands').value) || 0;
																const length = parseFloat(document.getElementById('length').value) || 0;
																const gauge = parseFloat(document.getElementById('gaugeList').value) || 0;
																const core = parseFloat(document.getElementById('coreIs').value) || 0;

																// Ensure twisting percentage is parsed correctly
																let twistingPercentage = parseFloat(document.getElementById('twistingList').value) || 0;

																// Apply twisting percentage from the start and multiply the other factors
																let metalWt = (gauge * gauge * factor * stands * length * core) * (1 + twistingPercentage / 100);

																// Round the number and format to show only the first three significant digits
																let roundedMetalWt = Math.round(metalWt / Math.pow(10, Math.floor(Math.log10(metalWt)) - 2)) * Math.pow(10, Math.floor(Math.log10(metalWt)) - 2);

																let formattedMetalWt; // Declare here for wider scope

																if (roundedMetalWt < 100000000) {
																	// Convert to a string and prepend '0.'
																	formattedMetalWt = `0.${roundedMetalWt.toString().slice(0, 3)}`;
																} else {
																	// Add a decimal point after the first digit
																	let roundedString = roundedMetalWt.toString();
																	formattedMetalWt = `${roundedString[0]}.${roundedString.slice(1, 4)}`; // e.g., 1234 -> 1.234
																}

																// Display result in Metal Wt. field
																document.getElementById('metalWt').value = formattedMetalWt;
															}
														</script>


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
												<table class="table align-middle table-nowrap mb-0" id="secondTable">
													<thead class="table-light">
														<tr>
															<th></th>
															<th>Grade</th>
															<th>Avg Rate</th>
															<th>%</th>
															<th>Weight</th>
															<th>Amount</th>
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
																	<select id="iteamList0" class="form-select grade-select" name="grade1" style="width:160px;" required>
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate1" id="" placeholder="" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage1" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight1" placeholder="Weight" required />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount1" placeholder="Amount" required />
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
																	<select id="iteamList0" class="form-select grade-select" name="grade2" style="width:160px;" data-choices data-choices-sorting="true">
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate2" id="" placeholder="" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage2" onkeyup="getCalculation(this.value)" placeholder="Percentage" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight2" placeholder="Weight" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount2" placeholder="Amount" />
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
																	<select id="iteamList0" class="form-select grade-select" name="grade3" style="width:160px;" data-choices data-choices-sorting="true">
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate3" id="" placeholder=""/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage3" onkeyup="getCalculation(this.value)" placeholder="Percentage" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight3" placeholder="Weight" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount3" placeholder="Amount" />
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
																	<select id="iteamList0" class="form-select grade-select" name="grade4" style="width:160px;" data-choices data-choices-sorting="true">
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate4" id="" placeholder="" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage4" onkeyup="getCalculation(this.value)" placeholder="Percentage" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight4" placeholder="Weight" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount4" placeholder="Amount"/>
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
																	<select id="iteamList0" class="form-select grade-select" name="grade5" style="width:160px;" data-choices data-choices-sorting="true">
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate5" id="" placeholder=""/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage5" onkeyup="getCalculation(this.value)" placeholder="Percentage" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight5" placeholder="Weight" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount5" placeholder="Amount" />
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
																	<select id="iteamList0" class="form-select grade-select" name="grade6" style="width:160px;" data-choices data-choices-sorting="true">
																		<option value="">Select Grade</option>
																		<?php foreach ($rows as $row1) { ?>
																			<option value="<?php echo $row1['description']; ?>"><?php echo $row1['description']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control avg-rate" name="avgRate6" id="" placeholder="" />
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control percentage-field" name="percentage6" onkeyup="getCalculation(this.value)" placeholder="Percentage"/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control weight-field" name="weight6" placeholder="Weight"/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control amount-field" name="amount6" placeholder="Amount"/>
																</div>
															</td>
														</tr>
														<tr>
															<td class="border-bottom-0"></td>
															<td class="border-bottom-0"></td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<p class="text-end mb-0">Totals</p>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control totalPercentageIs" name="totalPercentageIs" id="totalPercentageIs" placeholder=""/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control totalWeightIs" name="totalWeightIs" id="totalWeightIs" placeholder=""/>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group">
																	<input type="text" class="form-control totalAmountIs" name="totalAmountIs" id="totalAmountIs" placeholder=""/>
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
															<th>PVC Wt. </th>
															<th class="d-flex">
																<input type="text" class="form-control inline-block w-50 me-1" name="pvcWt" id="pvcWt" placeholder="PVC Wt." required />
																<input type="text" class="form-control inline-block w-50" name="avrateTotal" id="totalAmount" placeholder="Total Amount" readonly />
															</th>
														</tr>
													</thead>
													<tbody class="list form-check-all">
														<tr>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	Total Amount
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control" name="finalTotalAmount" id="finalTotalAmount" placeholder=""/>
																</div>
															</td>
														</tr>
														<tr>
															<td class="border-bottom-0">
																<div class="form-group d-flex" id="">
																	<p class="mb-0 align-content-center me-1">Labour</p>
																	<input type="text" class="form-control w-25 labour-percentage" name="labourPercentage" id="labourPercentage" placeholder="Labour %" />
																	<p class="ms-1 mb-0 align-content-center">%</p>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control totalLaborAmount" id="totalLaborAmount" placeholder="Total Labour Amount" readonly />
																</div>
															</td>
														</tr>

														<tr>
															<td class="border-bottom-0">
																<div class="form-group d-flex" id="">
																	<p class="mb-0 align-content-center me-1">Labour</p> <input type="text" id="laboutWeight" name="laboutWeight" class="form-control w-25" />
																	<p class=" ms-1 mb-0 align-content-center">/Wt</p>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control" name="laboutWeightAmt" id="laboutWeightAmt" placeholder=""/>
																</div>
															</td>
														</tr>
														<tr>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	Packaging Charges
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control" id="packagingCharges" name="packagingCharges" placeholder=""/>
																</div>
															</td>
														</tr>
														<tr>
															<td class="border-bottom-0">
																<div class="form-group d-flex" id="">
																	<p class="mb-0 align-content-center me-1">Rate</p>
																	<input class="form-control" type="text" id="finalProductRate" name="finalProductRate" style="width: 50px;" required>
																	<p class="ms-1 mb-0 align-content-center">/Wt</p>
																</div>
															</td>
															<td class="border-bottom-0">
																<div class="form-group" id="">
																	<input type="text" class="form-control" name="completeFinalAmount" id="completeFinalAmount" placeholder="" readonly />
																</div>
																<div class="form-group" id="">
																	<input type="text" class="form-control" name="completeFinalAmount_is" id="completeFinalAmount_is" placeholder="" readonly />
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<!-- Modal footer -->
						<div class="modal-footer">
							<button type="submit" name="main_submit" class="btn btn-info">Submit</button>
						</div>
										</div>
									</div>
									
								</div>
							</div>
							
						</div>
						
					</form>
				</div>
				<script>
					function getCalculation(getper) {
						console.log('getCalculation function called with:', getper);

						function calculateTotals() {
							console.log('Calculating totals...');
							let totalPercentage = 0;
							let totalWeight = 0;
							let totalAmount = 0;

							// Sum up all the percentage fields
							document.querySelectorAll('.percentage-field').forEach(function(input) {
								let value = parseFloat(input.value) || 0;
								console.log(`Percentage input value: ${value}`);
								totalPercentage += value;
							});

							// Sum up all the weight fields
							document.querySelectorAll('.weight-field').forEach(function(input) {
								let value = parseFloat(input.value) || 0;
								console.log(`Weight input value: ${value}`);
								totalWeight += value;
							});

							// Sum up all the amount fields
							document.querySelectorAll('.amount-field').forEach(function(input) {
								let value = parseFloat(input.value) || 0;
								console.log(`Amount input value: ${value}`);
								totalAmount += value;
							});

							// Display totals in the corresponding fields
							document.getElementById('totalPercentageIs').value = totalPercentage.toFixed(2);
							document.getElementById('totalWeightIs').value = totalWeight.toFixed(2);
							document.getElementById('totalAmountIs').value = totalAmount.toFixed(2);


						}

						// Event listeners for input changes on percentage, weight, and amount fields
						document.querySelectorAll('.percentage-field, .weight-field, .amount-field').forEach(function(input) {
							input.addEventListener('input', calculateTotals);
						});

						// Initialize calculations when the page loads
						calculateTotals();
					}

					// Example of how to call getCalculation
					document.addEventListener('DOMContentLoaded', function() {
						getCalculation();
					});
				</script>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
    // Function to calculate labour weight amount
    function calculateLabourWeightAmount() {
        // Get values from input fields
        let laboutWeight = parseFloat(document.getElementById('laboutWeight').value) || 0;
        let coilWt = parseFloat(document.getElementById('coilWt').value) || 0;

        // Calculate labour weight amount (coilWt * laboutWeight)
        let labourWeightAmt = coilWt * laboutWeight;

        // Update labour weight amount field
        document.getElementById('laboutWeightAmt').value = labourWeightAmt.toFixed(2);

        return labourWeightAmt;
    }

    // Function to calculate the labour percentage amount
    function calculateLabourPercentageAmount() {
        // Get the final total amount
        let finalTotalAmount = parseFloat(document.getElementById('finalTotalAmount').value) || 0;
        let labourPercentage = parseFloat(document.getElementById('labourPercentage').value) || 0;

        // Calculate the total labour amount based on percentage
        let totalLabourAmount = (labourPercentage / 100) * finalTotalAmount;

        // Update the labour percentage amount field
        let totalLabourAmountField = document.getElementById('totalLaborAmount');
        if (totalLabourAmountField) {
            totalLabourAmountField.value = totalLabourAmount.toFixed(2);
        }

        return totalLabourAmount;
    }

    // Function to update the complete final amount
    function updateCompleteFinalAmount() {
        // Get existing final total amount and other necessary fields
        let finalTotalAmount = parseFloat(document.getElementById('finalTotalAmount').value) || 0;
        let packagingCharges = parseFloat(document.getElementById('packagingCharges').value) || 0;

        // Get the labour amounts from both calculations
        let labourWeightAmt = calculateLabourWeightAmount();  // Labour weight calculation
        let labourPercentageAmt = calculateLabourPercentageAmount();  // Labour percentage calculation

        // Calculate complete final amount (finalTotalAmount + packagingCharges + both labour amounts)
        let completeFinalAmount = finalTotalAmount + packagingCharges + labourWeightAmt + labourPercentageAmt;

        // Update the complete final amount field
        let completeFinalAmountField = document.getElementById('completeFinalAmount');
        if (completeFinalAmountField) {
            completeFinalAmountField.value = completeFinalAmount.toFixed(2);
        }

        return completeFinalAmount;
    }

    // Function to update the rate division result
    function updateRateDivisionResult() {
        let completeFinalAmount = updateCompleteFinalAmount();
        let finalProductRate = parseFloat(document.getElementById('finalProductRate').value) || 0;

        // Calculate rate division result
        let rateDivisionResult = finalProductRate ? (completeFinalAmount / finalProductRate).toFixed(2) : 0;

        // Update the final amount rate division field
        let completeFinalAmountIsField = document.getElementById('completeFinalAmount_is');
        if (completeFinalAmountIsField) {
            completeFinalAmountIsField.value = rateDivisionResult;
        }
    }

    // Event listeners for input fields to trigger calculations
    let laboutWeightField = document.getElementById('laboutWeight');
    let coilWtField = document.getElementById('coilWt');
    let labourPercentageField = document.getElementById('labourPercentage');
    let finalProductRateField = document.getElementById('finalProductRate');
    let packagingChargesField = document.getElementById('packagingCharges');
    let finalTotalAmountField = document.getElementById('finalTotalAmount');

    if (laboutWeightField) laboutWeightField.addEventListener('input', updateRateDivisionResult);
    if (coilWtField) coilWtField.addEventListener('input', updateRateDivisionResult);
    if (labourPercentageField) labourPercentageField.addEventListener('input', updateRateDivisionResult);
    if (finalProductRateField) finalProductRateField.addEventListener('input', updateRateDivisionResult);
    if (packagingChargesField) packagingChargesField.addEventListener('input', updateRateDivisionResult);
    if (finalTotalAmountField) finalTotalAmountField.addEventListener('input', updateRateDivisionResult);
});

				</script>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						function calculateAllFields() {
							// Function to calculate weight, amount, and total amount
							function updateCalculations() {
								var percentageFields = document.querySelectorAll('.percentage-field');

								// Function to calculate total amount based on avg-rate and percentage fields
								function calculateTotalAmount() {
									var totalAmount = 0;

									percentageFields.forEach(function(percentageField) {
										var row = percentageField.closest('tr'); // Get the current row
										var avgRateField = row.querySelector('.avg-rate'); // Get avg-rate for this row

										var percentage = parseFloat(percentageField.value) || 0;
										var avgRate = parseFloat(avgRateField.value) || 0;

										totalAmount += (avgRate / 100) * percentage; // Calculate amount for this row
									});

									// Update the Total Amount field
									var totalAmountField = document.getElementById('totalAmount');
									if (totalAmountField) {
										totalAmountField.value = totalAmount.toFixed(2);
									}
								}

								percentageFields.forEach(function(percentageField) {
									percentageField.addEventListener('input', function() {
										// Get the current row for amount and weight calculation
										var row = this.closest('tr');

										// Get Coil Wt. and Metal Wt. values
										var coilWt = parseFloat(document.getElementById('coilWt').value) || 0;
										var metalWt = parseFloat(document.getElementById('metalWt').value) || 0;

										// Get current percentage value
										var percentage = parseFloat(this.value) || 0;

										// Get avg-rate value from the current row
										var avgRateField = row.querySelector('.avg-rate');
										var avgRate = parseFloat(avgRateField.value) || 0;

										// Calculate PVC Wt.
										var pvcWt = coilWt - metalWt;
										var pvcWtField = document.getElementById('pvcWt');
										if (pvcWtField) {
											pvcWtField.value = pvcWt.toFixed(2);
										}

										// Calculate weight based on the percentage
										var calculatedWeight = (percentage / 100) * pvcWt;

										// Update the corresponding Weight field
										var weightField = row.querySelector('.weight-field');
										if (weightField) {
											weightField.value = calculatedWeight.toFixed(2);
										}

										// Calculate amount based on avgRate * weight-field for this row
										var weightValue = parseFloat(weightField.value) || 0;
										var calculatedAmount = avgRate * weightValue;

										// Update the corresponding Amount field
										var amountField = row.querySelector('.amount-field');
										if (amountField) {
											amountField.value = calculatedAmount.toFixed(2);
										}

										// Update total amounts
										calculateTotalAmount();
										updateFinalTotalAmount();
									});
								});

								// If avg-rate changes in any row, recalculate total amount
								document.querySelectorAll('.avg-rate').forEach(function(avgRateField) {
									avgRateField.addEventListener('input', function() {
										calculateTotalAmount(); // Recalculate total amount when avg-rate changes
									});
								});

								function updateFinalTotalAmount() {
									var metalWt = parseFloat(document.getElementById('metalWt').value) || 0;
									var rRate = parseFloat(document.getElementById('rRateField').value) || 0;
									var pvcWt = parseFloat(document.getElementById('pvcWt').value) || 0;
									var totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;
									var drawing = parseFloat(document.getElementById('drawing').value) || 0;

									// Calculate final total amount
									var finalTotalAmount = (metalWt * (rRate + drawing)) + (pvcWt * totalAmount);

									// Update the Final Total Amount field
									var finalTotalAmountField = document.getElementById('finalTotalAmount');
									if (finalTotalAmountField) {
										finalTotalAmountField.value = finalTotalAmount.toFixed(2);
									}
								}
							}

							// Initialize calculations
							updateCalculations();
						}

						// Call the function to set up event listeners
						calculateAllFields();
					});

					// Function to fetch rate for the selected grade
					function fetchRate(gradeSelect) {
						var gradeId = gradeSelect.value; // Get selected grade ID
						var row = gradeSelect.closest('tr'); // Get the current row
						var rateField = row.querySelector('.avg-rate'); // Find the Avg Rate field in the same row

						if (gradeId) {
							// AJAX request to fetch rate based on grade ID
							var xhr = new XMLHttpRequest();
							xhr.open("POST", "getRate.php", true);
							xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

							xhr.onreadystatechange = function() {
								if (xhr.readyState == 4 && xhr.status == 200) {
									rateField.value = xhr.responseText; // Update Avg Rate field with the response (rate)
								}
							};

							xhr.send("gradeId=" + gradeId);
						} else {
							rateField.value = ''; // Clear the field if no grade is selected
						}
					}

					// Attach event listener to all select elements with class 'grade-select'
					document.querySelectorAll('.grade-select').forEach(function(selectElement) {
						selectElement.addEventListener('change', function() {
							fetchRate(this);
						});
					});
				</script>
			</div>

			<!--all Modals-->
			<!-- Modal for Adding New Twisting -->
			<div class="modal fade" id="addNewTwisting" tabindex="-1" role="dialog" aria-labelledby="addNewTwistingLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addNewTwistingLabel">Add New Twisting</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form name="twistingForm" onsubmit="return twistingSubmit(event);">
								<div class="form-group">
									<label for="t_name">Twisting</label>
									<input type="text" class="form-control" id="t_name" name="t_name" placeholder="Enter Twisting" required>
									<div id="messageTwistingTxt"></div>
								</div>
								<button type="submit" class="btn btn-primary mt-2" id="btnTbutton">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				function createTwisting(getTwisting) {
					if (getTwisting === "Add New") {
						$("#addNewTwisting").modal('show'); // Show the modal
					}
				}

				function twistingSubmit(event) {
					event.preventDefault(); // Prevent default form submission
					const twistingName = document.twistingForm.t_name.value;

					if (twistingName === '') {
						$("#messageTwistingTxt").html('<span style="color: red;">Enter Twisting</span>');
						return false;
					}

					$("#btnTbutton").addClass('fa-spinner fa-spin'); // Show loading spinner

					// AJAX call to submit twisting data
					const myData = {
						t_name: twistingName
					};

					jQuery.ajax({
						type: "POST",
						url: "submitTwistingData.php", // PHP script to handle data insertion
						data: myData,
						success: function(response) {
							if (response === '0') {
								$("#messageTwistingTxt").html('<span style="color: red;"> Some error occurred!</span>');
							} else {
								$("#messageTwistingTxt").html('<span style="color: green;"> Data saved successfully!</span>');
								const newOption = `<option value="${twistingName}">${twistingName}</option>`;
								$("#twistingList").append(newOption); // Add new twisting to the dropdown

								setTimeout(function() {
									document.twistingForm.t_name.value = '';
									$("#addNewTwisting").modal('hide'); // Hide modal after saving
									$("#messageTwistingTxt").html('');
								}, 1000);
							}
							$("#btnTbutton").removeClass('fa-spinner fa-spin');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError);
						}
					});

					return false;
				}
			</script>

			<!-- Modal for Adding New Gauge -->
			<div class="modal fade" id="addNewGauge" tabindex="-1" role="dialog" aria-labelledby="addNewGaugeLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addNewGaugeLabel">Add New Gauge</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form name="gaugeForm" onsubmit="return gaugeSubmit(event);">
								<div class="form-group">
									<label for="g_name">Gauge</label>
									<input type="text" class="form-control" id="g_name" name="g_name" placeholder="Enter Gauge" required>
									<div id="messageGaugeTxt"></div>
								</div>
								<button type="submit" class="btn btn-primary mt-2" id="btnGbutton">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal for Adding New Factor -->
			<div class="modal fade" id="addNewFactor" tabindex="-1" role="dialog" aria-labelledby="addNewFactorLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addNewFactorLabel">Add New Factor</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form name="factorForm" onsubmit="return factorSubmit(event);">
								<div class="form-group">
									<label for="f_name">Factor</label>
									<input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter Factor" required>
									<div id="messageFactorTxt"></div>
								</div>
								<button type="submit" class="btn btn-primary mt-2" id="btnFbutton">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				function createFactor(getFactor) {
					if (getFactor === "Add New") {
						$("#addNewFactor").modal('show'); // Show the modal
					}
				}

				function factorSubmit(event) {
					event.preventDefault(); // Prevent default form submission
					const factorName = document.factorForm.f_name.value;

					if (factorName === '') {
						$("#messageFactorTxt").html('<span style="color: red;">Enter Factor</span>');
						return false;
					}

					$("#btnFbutton").addClass('fa-spinner fa-spin'); // Show loading spinner

					// AJAX call to submit factor data
					const myData = {
						f_name: factorName
					};

					jQuery.ajax({
						type: "POST",
						url: "submitFactorData.php", // PHP script to handle data insertion
						data: myData,
						success: function(response) {
							if (response === '0') {
								$("#messageFactorTxt").html('<span style="color: red;"> Some error occurred!</span>');
							} else {
								$("#messageFactorTxt").html('<span style="color: green;"> Data saved successfully!</span>');
								const newOption = `<option value="${factorName}">${factorName}</option>`;
								$("#factorList").append(newOption); // Add new factor to the dropdown

								setTimeout(function() {
									document.factorForm.f_name.value = '';
									$("#addNewFactor").modal('hide'); // Hide modal after saving
									$("#messageFactorTxt").html('');
								}, 1000);
							}
							$("#btnFbutton").removeClass('fa-spinner fa-spin');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError);
						}
					});

					return false;
				}
			</script>

			<!-- Modal Structure for Adding New Type with Amount -->
			<div class="modal fade" id="addNewType" tabindex="-1" role="dialog" aria-labelledby="addNewTypeLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addNewTypeLabel">Add New Type</h5>
							<!-- Close Button with proper attributes -->
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form name="vendorForm" onsubmit="return vendorRsubmit(event);">
								<!-- Input for Type Name -->
								<div class="form-group">
									<label for="v_name">Type</label>
									<input type="text" class="form-control" id="v_name" name="v_name" placeholder="Enter Type" required>
									<div id="messageVendorTxt"></div>
								</div>
								<!-- Input for Amount -->
								<div class="form-group">
									<label for="amount">Amount</label>
									<input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required>
								</div>
								<button type="submit" class="btn btn-primary mt-2" id="btnVbutton">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- JavaScript -->
			<script>
				function createType(getVType) {
					if (getVType === "Add New") {
						$("#addNewType").modal('show');
					} else {
						// Fetch the price based on the selected type
						jQuery.ajax({
							type: "POST",
							url: "fetchPrice.php", // Your PHP script to get the price
							data: {
								type: getVType
							},
							success: function(response) {
								try {
									const data = JSON.parse(response);
									if (data && data.price) {
										$("#rRateField").val(data.price); // Update the R/Rate field with the price
									} else {
										$("#rRateField").val(''); // Clear the field if no price is found
									}
								} catch (e) {
									console.error("Failed to parse response", e);
									$("#rRateField").val('');
								}
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(thrownError);
							}
						});
					}
				}

				function vendorRsubmit(event) {
					event.preventDefault();

					const vendorName = document.vendorForm.v_name.value;
					const amount = document.vendorForm.amount.value;

					if (vendorName === '' || amount === '') {
						$("#messageVendorTxt").html('<span style="color: red;"> Please fill all fields</span>');
						return false;
					}

					$("#btnVbutton").addClass('fa-spinner fa-spin');
					const myData = {
						v_name: vendorName,
						amount: amount
					};

					jQuery.ajax({
						type: "POST",
						url: "submitTypeData.php", // Ensure your backend processes both 'v_name' and 'amount'
						data: myData,
						success: function(response) {
							if (response === '0') {
								$("#messageVendorTxt").html('<span style="color: red;"> Some error!</span>');
							} else {
								$("#messageVendorTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
								const newOption = `<option value="${vendorName}">${vendorName}</option>`;
								$("#typeList").append(newOption);

								setTimeout(function() {
									document.vendorForm.v_name.value = '';
									document.vendorForm.amount.value = '';
									$("#addNewType").modal('hide');
									$("#messageVendorTxt").html('');
								}, 1000);
							}
							$("#btnVbutton").removeClass('fa-spinner fa-spin');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError);
						}
					});
					return false;
				}
			</script>
<div class="modal fade" id="addNewVendor" tabindex="-1" aria-labelledby="addNewVendor" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title">Add New Group</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="closeVendorModel()"></button>
                                                                </div>
                                                                <div class="modal-body" id="pops">
                                                                  <form name="vendorForm1" method="post" onSubmit="return groupSubmit(event)">
                                                                    <div class="mb-3">
                                                                      <label for="v_name" class="form-label">Name</label>
                                                                      <input type="text" class="form-control" name="groupName" id="groupName" placeholder="Enter Vendor Name" required />
                                                                    </div>
                                                                    <div class="text-center" style="margin-bottom: 15px;">
                                                                      <button type="submit" class="btn btn-primary" id="groupbutton"><i class="fa"></i> Submit</button>
                                                                    </div>
                                                                    <p id="messageVendorTxt1" style="text-align: center;"></p>
                                                                  </form>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
			</td>
			</tr>
			</tfoot>
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

    // Event listener for the OK button
    document.getElementById('saveQuantity').addEventListener('click', function() {
        // Set the total meter value in the #quantityField input
        document.getElementById('quantityField').value = totalMeter.toFixed(2);

        // Close the modal
        $('#quantityModal').modal('hide');
    });
</script>

	<!-- footer start -->
	<?php include_once('include/footer.php'); ?>