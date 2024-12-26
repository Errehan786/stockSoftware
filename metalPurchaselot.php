<?php
include_once('config.php');
include_once('include/auth.php');

//get accounts
$accountSql = "SELECT * FROM `account`";
$accountResult = $conn->query($accountSql);

if (isset($_REQUEST['main_submit'])) {
	$partyAccountName = $_REQUEST['partyAccountName'];
	$accountName = $_REQUEST['accountName'];
	$voucherNo = $_REQUEST['voucherNo'];
	$cDate = $_REQUEST['cDate'];
	$invoiceNo = $_REQUEST['invoiceNo'];
	$remark = $_REQUEST['remark'];
	$metalType = $_REQUEST['metalType'];
	$type = $_REQUEST['type'];
	$typeSize = $_REQUEST['sizeType'];
	$noOfReel = $_REQUEST['noOfReel'];
	$grossWt = $_REQUEST['grossWt'];
	$rRateField = $_REQUEST['rRateField'];
	$sizeField = $_REQUEST['sizeField'];
	$currentDate = $_REQUEST['currentDate'];
	$emptyNoOfReel = $_REQUEST['emptyNoOfReel'];
	$reelWt = $_REQUEST['reelWt'];
	$netWeight = $_REQUEST['netWeight'];
	$totalAmount = $_REQUEST['totalAmount'];
	$interestField = $_REQUEST['interestField'];
	$netAmtField = $_REQUEST['netAmtField'];
	$purchaseSql = "INSERT INTO `purchaseLotWise`(`partyAccount`, `accountName`, `voucherNo`, `cDate`, `invoiceNo`, `remark`, `metal`, `type`,`typeSize`, `noOfReel`, `grossWt`, `rodRate`, `drawing`, `emptyDate`, `emptyNoOfReel`, `reelWt`, `netWeight`, `totalAmount`, `interest`, `netAmount`) VALUES ('$partyAccountName','$accountName','$voucherNo','$cDate','$invoiceNo','$remark','$metalType','$type','$typeSize','$noOfReel','$grossWt','$rRateField','$sizeField','$currentDate','$emptyNoOfReel','$reelWt','$netWeight','$totalAmount','$interestField','$netAmtField')";
    if ($result = $conn->exec($purchaseSql)) {
      echo '<script>alert("Data has been saved successfully!");window.location = "metalPurchaselot.php";</script>';
  } else {
    echo '<script>alert("Failed!");window.location = "metalPurchaselot.php";</script>';
  }
    
}
////delete finished goods lot wise 
if(isset($_REQUEST['delMetalPurchaseId'])){
    $delMetalPurchaseId = $_REQUEST['delMetalPurchaseId'];
    $metalPurchaseSql = $conn->query("DELETE FROM `purchaseLotWise` WHERE id='$delMetalPurchaseId'");
    if($metalPurchaseSql==true){
        echo '<script>window.location = "metalPurchaselot.php";</script>';
    }else {
    echo '<script>alert("Failed!");window.location = "metalPurchaselot.php";</script>';
  }
}
$sql3 = "SELECT * FROM purchaseLotWise";
$result3 = $conn->query($sql3);
?>
<script>
	function selectPartyAccount(str) {
		if (str == "") {
			document.getElementById("accountName").innerHTML = "";
			return;
		}

		if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari

			xmlhttp = new XMLHttpRequest();

		} else { // code for IE6, IE5

			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		}

		xmlhttp.onreadystatechange = function()

		{

			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)

			{

				document.getElementById("accountName").innerHTML = xmlhttp.responseText;
				//alert(document.getElementById("accountName").innerHTML=xmlhttp.responseText);

			}

		}

		xmlhttp.open("GET", "getAccountDetails.php?q=" + str, true);

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
	<!-- Vertical Overlay-->
	<div class="vertical-overlay"></div>
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<!-- start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<h4 class="mb-sm-0">Metal Purchase</h4>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
									<li class="breadcrumb-item active">Metal Purchase</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end page title -->
				<div class="row" id="addNewPurchase">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Add New </h4>
							</div>
							<!-- end card header -->
							<div class="card-body">
								<div class="live-preview">
									<form action="" method="post">
										<div class="row">
											<div class="col-lg-4">
												<div class="mb-4">
													<label class="form-label">Party Account</label>
													<select id="vendorList" name="partyAccountName" class="form-select" onChange="selectPartyAccount(this.value)" required>
														<option value="">Select Party Account</option>
														<?php while ($accountData = $accountResult->fetch(PDO::FETCH_ASSOC)) { ?>
															<option value="<?php echo $accountData['accountName']; ?>"><?php echo $accountData['accountName']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<!--end col-->
											<div class="col-lg-4">
												<div class="mb-4">
													<label class="form-label">Account</label>
													<select name="accountName" id="accountName" class="form-select" required>
														<option value="">Select Account</option>
													</select>
												</div>
											</div>
											<!--end col-->
											<div class="col-lg-4">
												<div class="mb-4">
													<label for="" class="form-label">V.No.</label>
													<?php
													$rand = rand(999, 100);
													$vNo = substr(strtotime(date('h:i:s')) + $rand, -4);
													?>
													<input type="text" class="form-control" name="voucherNo" placeholder="Enter V.No." value="<?php echo $vNo; ?>" required />
												</div>
											</div>
											<!--end col-->
											<div class="col-lg-4">
												<div class="mb-4">
													<label for="StartleaveDate" class="form-label">Date</label>
													<input type="text" class="form-control" name="cDate" value="<?php echo date('d-m-Y'); ?>" required />
												</div>
											</div>
											<!--end col-->
											<div class="col-lg-4">
												<div class="mb-4">
													<?php
													$rand1 = rand(9999, 1000);
													$invoiceNo = substr(strtotime(date('h:i:s')) + $rand1,-4);
													?>
													<label for="" class="form-label">Invoice No.</label>
													<input type="text" class="form-control" name="invoiceNo" placeholder="Enter Invoice No." value="<?php echo $invoiceNo; ?>" required />
												</div>
											</div>
											<!--end col-->
											<div class="col-lg-4">
												<div class="mb-4">
													<label for="" class="form-label">Remark</label>
													<input type="text" class="form-control" name="remark" placeholder="Enter remark" id="" />
												</div>
											</div>
											<!--end col-->
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="card mb-0">
													<div class="card-header align-items-center d-flex">
														<h4 class="card-title mb-0 flex-grow-1">Purchase Details</h4>
													</div>
													<div class="card-body">
														<div id="customerList">
															<div class="table-responsive table-card mt-3 mb-1">
																<table class="table align-middle table-nowrap" id="customerTable">
																	<thead class="table-light">
																		<tr>
																			<th>Metal</th>
																			<th>Type</th>
																			<th>Size</th>
																			<th>No. of Reel</th>
																			<th>Gross Wt.</th>
																			<th>Rod Rate</th>
																			<th>Drawing</th>
																		</tr>
																	</thead>
																	<tbody class="list form-check-all">
																		<tr>
																			<td>
																				<div class="form-group">
																					<?php
																					// vendor name select code
																					$sql = "SELECT * FROM `metalType`";
																					$result = $conn->query($sql);
																					?>
																					<select id="typeList" name="metalType" class="form-select" onChange="createType(this.value)" style="width:150px;" required>
																						<option value="">Type</option>
																						<?php echo '<optgroup label="For a new Type"></optgroup><option value="Add New">Add New</option>'; ?>
																						<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
																							<option value="<?php echo $row['type']; ?>">
																								<?php echo htmlspecialchars($row['type']); ?>
																							</option>
																						<?php } ?>
																					</select>

																				</div>
																				<!-- JavaScript -->
																			</td>
																			<td>
																				<div class="form-group" id="textarea1">
																					<select id="iteamList0" class="form-select" name="type" style="width:150px;" required1>
																						<option value="">Select Type</option>
																						<option value="Charak">Charak</option>
																						<option value="Coil">Coil</option>
																						<option value="Drum">Drum</option>
																						<option value="P.Reel">P.Reel</option>
																						<option value="Reel">Reel</option>
																					</select>
																				</div>
																			</td>
																			<td>
    <div class="form-group">
        <?php
        // Fetch sizes from the 'productSize' table
        $sql = "SELECT * FROM `productSize`";
        $result = $conn->query($sql);
        ?>
        <select id="sizeTypeList" name="sizeType" class="form-select" onChange="createSize(this.value)" style="width:150px;" required>
            <option value="">--Select Size--</option>
            <optgroup label="For a new Size"></optgroup>
            <option value="Add New">Add New</option>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $row['size']; ?>">
                    <?php echo htmlspecialchars($row['size']); ?>
                </option>
            <?php } ?>
        </select>
    </div>
</td>
																			<td>
																				<div class="form-group" id="">
																					<input type="text" class="form-control" name="noOfReel" placeholder="No. of Reel"  required1 />
																				</div>
																			</td>
																			<td>
																				<div class="form-group">
																					<input type="text" class="form-control" id="grossWt" name="grossWt" placeholder="Gross Wt."  required />
																				</div>
																			</td>
																			<td>
																				<div class="form-group" id="">
																					<input type="text" class="form-control" name="rRateField" id="rRateField" placeholder="Rod Rate" required1 />
																				</div>
																			</td>
																			<td>
																				<div class="form-group" id="">
																					<input type="text" class="form-control" name="sizeField" id="sizeField" placeholder="Drawing" required1 />
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
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="card mb-0">
													<div class="card-header align-items-center d-flex">
														<h4 class="card-title mb-0 flex-grow-1">Empty Reel Details</h4>
													</div>
													<div class="card-body">
														<div id="customerList">
															<div class="table-responsive table-card mt-3 mb-1">
																<table class="table align-middle table-nowrap" id="customerTable">
																	<thead class="table-light">
																		<tr>
																			<th>Date</th>
																			<th>No. of Reel</th>
																			<th>Reel Wt.</th>
																			<th>Net Weight</th>
																		</tr>
																	</thead>
																	<tbody class="list form-check-all">
																		<td>
																			<div class="form-group" id="">
																				<input type="text" class="form-control" name="currentDate" value="<?php echo date('Y-m-d'); ?>" required1 />
																			</div>
																		</td>
																		<td>
																			<div class="form-group" id="">
																				<input type="text" class="form-control" name="emptyNoOfReel" placeholder="No. of Reel" required1 />
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<input type="text" class="form-control" id="reelWt" name="reelWt" placeholder="Reel Wt." required oninput="calculateNetWeight()" />
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<input type="text" class="form-control" id="netWeight" name="netWeight" placeholder="Net Weight" readonly />
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
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="card mb-0">
													<div class="card-header align-items-center d-flex">
														<h4 class="card-title mb-0 flex-grow-1">Amount Details</h4>
													</div>
													<div class="card-body">
														<div id="customerList">
															<div class="table-responsive table-card mt-3 mb-1">
																<table class="table align-middle table-nowrap" id="customerTable">
																	<thead class="table-light">
																		<tr>
																			<!-- <th>Purchase Entry Id<th> -->
																			<!--<th>Invoice No</th>-->
																			<th>Total Amount</th>
																			<th>Interest</th>
																			<th>Net Amount</th>
																		</tr>
																	</thead>
																	<tbody class="list form-check-all">
																		<td>
																			<div class="form-group">
																				<input type="text" class="form-control" name="totalAmount" id="totalAmount" placeholder="Total Amt." readonly />
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<input type="text" class="form-control" name="interestField" id="interestField" placeholder="Interest" oninput="calculateNetAmt()" required />
																			</div>
																		</td>

																		<td>
																			<div class="form-group">
																				<input type="text" class="form-control" name="netAmtField" id="netAmtField" placeholder="Net Amt." readonly />
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
											<div class="col-sm-12 mt-4 text-center">
												<input type="submit" name="main_submit" class="btn btn-info" style="background-color:#0ab39c;">
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div id="customerList">
									<!--========================== Show Data ==========================-->
									<div class="table-responsive">
										<table class="table align-middle table-nowrap" id="example">
											<thead class="table-light">
												<tr>
												    <th>Sr no</th>
													<th>Inv.NO.</th>
													<th>Date</th>
													<th>Metal</th>
													<th>Size</th>
													<th>Reel</th>
													<th>Type</th>
													<th>G.Wt.</th>
													<th>MT.Wt.</th>
													<th>Net Wt.</th>
													<th>R.Rate</th>
													<th>Net Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody class="list form-check-all">
                                                <?php
                                                $a = 1;
                                                while($acountRow = $result3->fetch(PDO::FETCH_ASSOC)){
                                                    @extract($acountRow);
                                                ?>
												<tr>
												    <td><?php echo $a; ?></td>
													<td><?php echo $invoiceNo; ?></td>
													<td><?php echo $cDate; ?></td>
													<td><?php echo $metal; ?></td>
													<td><?php echo $typeSize; ?></td>
													<td><?php echo $noOfReel; ?></td>
													<td><?php echo $type; ?></td>
													<td><?php echo $grossWt; ?></td>
													<td><?php echo $reelWt; ?></td>
													<td><?php echo $netWeight; ?></td>
													<td><?php echo $rodRate; ?></td>
													<td><?php echo $netAmount; ?></td>
													<td>
														<div class="d-flex gap-2">
															<div class="edit">
																<a href="editMetalPurchaselot.php?MetalPurchaseId=<?php echo $id; ?>" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
															</div>
															<div class="remove">
																<a href="?delMetalPurchaseId=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
															</div>
														</div>
													</td>
												</tr>
                                                <?php $a++; } ?>
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
				<!-- end row -->
			</div>
		</div>
	</div>
	<script>
		function calculateNetAmt() {
			// Get the Total Amount from the Total Amt. input field
			const totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;

			// Get the Interest value from the Interest input field
			const interest = parseFloat(document.getElementById('interestField').value) || 0;

			// Calculate the additional amount from the Interest percentage
			const additionalAmount = (totalAmount * interest) / 100;

			// Calculate the new Net Amount
			const netAmt = totalAmount + additionalAmount;

			// Set the calculated Net Amount in the Net Amt. input field
			document.getElementById('netAmtField').value = netAmt.toFixed(2); // Limit to 2 decimal places
		}

		function calculateNetWeight() {
			// Get values from Gross Wt. and Reel Wt. input fields
			const grossWt = parseFloat(document.getElementById('grossWt').value) || 0;
			const reelWt = parseFloat(document.getElementById('reelWt').value) || 0;

			// Calculate Net Weight as Gross Wt. - Reel Wt.
			const netWeight = grossWt - reelWt;

			// Set the calculated Net Weight in the Net Weight input field
			document.getElementById('netWeight').value = netWeight.toFixed(2); // Limit to 2 decimal places

			// Get values from Rod Rate and Drawing fields
			const rodRate = parseFloat(document.getElementById('rRateField').value) || 0;
			const drawing = parseFloat(document.getElementById('sizeField').value) || 0;

			// Calculate Total Amount as Rod Rate + (Drawing * Net Weight)
			const totalAmount = (rodRate + drawing) * netWeight;

			// Set the calculated Total Amount in the Total Amt. input field
			document.getElementById('totalAmount').value = totalAmount.toFixed(2); // Limit to 2 decimal places
		}
	</script>
	<!-- Modal Structure for Adding New Type with Amount -->
	<div class="modal fade" id="addNewType" tabindex="-1" role="dialog" aria-labelledby="addNewTypeLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addNewTypeLabel">Add New Type</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form name="vendorForm" method="post" onsubmit="return vendorRsubmit(event);">
						<div class="form-group">
							<label for="v_name">Type</label>
							<input type="text" class="form-control" id="v_name" name="v_name" placeholder="Enter Type" required>
							<div id="messageVendorTxt"></div>
						</div>
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

	<script>
		function createType(getVType) {
			if (getVType === "Add New") {
				$("#addNewType").modal('show');
			} else {
				// Fetch the price based on the selected type
				$.ajax({
					type: "POST",
					url: "fetchMetalPrice.php",
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
							alert("Failed to parse response: " + e.message);
							$("#rRateField").val('');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert("Error fetching price: " + thrownError);
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

			$.ajax({
				type: "POST",
				url: "submitMetalData.php",
				data: myData,
				success: function(response) {
					if (response === '0') {
						$("#messageVendorTxt").html('<span style="color: red;"> Some error!</span>');
						//alert("Submission failed. Please try again.");
					} else {
						$("#messageVendorTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
						//alert("Form submitted successfully!");

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
					alert("Submission error: " + thrownError);
				}
			});
			return false;
		}
	</script>

	<!-- Modal for Adding a New Size with Amount -->
<div class="modal fade" id="addNewSizePopup" tabindex="-1" role="dialog" aria-labelledby="addNewSizeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSizeLabel">Add New Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closePopupBtn"></button>
            </div>
            <div class="modal-body">
                <form id="sizeForm" method="post" onsubmit="return sizeSubmit(event);">
                    <div class="form-group">
                        <label for="newSizeName">Size</label>
                        <input type="text" class="form-control" id="newSizeName" name="newSizeName" placeholder="Enter Size" required>
                        <div id="sizeFormMessage"></div>
                    </div>
                    <div class="form-group">
                        <label for="newSizeAmount">Amount</label>
                        <input type="number" class="form-control" id="newSizeAmount" name="newSizeAmount" placeholder="Enter Amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" id="submitSizeButton">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to trigger the modal or fetch the price for the selected size
    function createSize(sizeType) {
        if (sizeType === "Add New") {
            // Show modal for adding new size
            $("#addNewSizePopup").modal('show');
        } else {
            // Fetch the price based on the selected size
            $.ajax({
                type: "POST",
                url: "fetchSizePrice.php",
                data: { type: sizeType },
                success: function(response) {
                    try {
                        const data = JSON.parse(response);
                        if (data && data.price) {
                            $("#sizeField").val(data.price); // Update the R/Rate field with the price
                        } else {
                            $("#sizeField").val(''); // Clear the field if no price is found
                        }
                    } catch (e) {
                        alert("Failed to parse response: " + e.message);
                        $("#sizeField").val('');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert("Error fetching price: " + thrownError);
                }
            });
        }
    }

    // Function to handle the submission of the new size
    function sizeSubmit(event) {
        event.preventDefault();

        const sizeName = document.getElementById('newSizeName');
        const sizeAmount = document.getElementById('newSizeAmount');

        if (!sizeName || !sizeAmount || sizeName.value === '' || sizeAmount.value === '') {
            $("#sizeFormMessage").html('<span style="color: red;">Please fill all fields</span>');
            return false;
        }

        $("#submitSizeButton").addClass('fa-spinner fa-spin'); // Spinner on submit
        const formData = {
            size_name: sizeName.value,
            sizeAmount: sizeAmount.value
        };

        // AJAX request to submit the new size data
        $.ajax({
            type: "POST",
            url: "submitSizeData.php",
            data: formData,
            success: function(response) {
                //const res = JSON.parse(response);
                
                //alert(res.status);
                
                if (response === '0') {
                    $("#sizeFormMessage").html('<span style="color: red;">Some error occurred!</span>');
                } else {
                    $("#sizeFormMessage").html('<span style="color: green;">Data has been saved successfully</span>');

                    // Append the new size to the dropdown list
                    const newOption = `<option value="${sizeName.value}">${sizeName.value}</option>`;
                    $("#sizeTypeList").append(newOption);

                    setTimeout(function() {
                        sizeName.value = '';
                        sizeAmount.value = '';
                        $("#addNewSizePopup").modal('hide'); // Close the modal
                        $("#sizeFormMessage").html('');
                    }, 1000);
                }
                $("#submitSizeButton").removeClass('fa-spinner fa-spin'); // Remove spinner after submission
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Submission error: " + thrownError);
            }
        });
        return false;
    }
</script>

	<!-- footer start -->
	<?php include_once('include/footer.php'); ?>

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