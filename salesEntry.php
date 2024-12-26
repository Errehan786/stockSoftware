<?php
include_once "config.php";
include_once "include/auth.php";

//get accounts
$accountSql = "SELECT * FROM `account`";
$accountResult = $conn->query($accountSql);

///get category
$getCatSql = "SELECT distinct(name) FROM `goodsGroup`";
$menu_details = $conn->query($getCatSql);

///get Voucher
$voucherSql = "SELECT voucherNo FROM `purchaseGoodsRawMaterial` where type='salesFinishedGoods' order by id desc";
$voucherResult = $conn->query($voucherSql);
$voucherRow = $voucherResult->fetch(PDO::FETCH_ASSOC);

if (isset($_REQUEST["purchaseGoodsMetrialSubmit"])) {
  $partyAccountName = $_REQUEST["partyAccountName"];
  $accountName = $_REQUEST["accountName"];
  $voucherNo = $_REQUEST["voucherNo"];
  $date = $_REQUEST["date"];
  $totalAmountBase = $_REQUEST['totalAmountBase'];
  $addChargesPercentage = $_REQUEST["addChargesPercentage"];
  $addChargesAmount = $_REQUEST["addChargesAmount"];
  $deductionChargeAmount = $_REQUEST["deductionChargeAmount"];
  $addChargesRemark = $_REQUEST["addChargesRemark"];
  $deductionChargeRemark = $_REQUEST["deductionChargeRemark"];
  $totalBill = $_REQUEST["totalBill"];
  $remark = $_REQUEST["remark"];
  $salesFinishedGoods = 'salesFinishedGoods';
  $metrialSql = "INSERT INTO `purchaseGoodsRawMaterial`(`partyAccountName`, `accountName`, `voucherNo`, `date`, `totalAmount`, `discountPer`, `addChargeAmount`, `dudChargeAmount`, `addChargeRemark`, `dudChargeRemark`, `totalBill`, `remark`,`type`) VALUES ('$partyAccountName','$accountName','$voucherNo','$date','$totalAmountBase','$addChargesPercentage','$addChargesAmount','$deductionChargeAmount','$addChargesRemark','$deductionChargeRemark','$totalBill','$remark','$salesFinishedGoods')";
  $metrialResult = $conn->exec($metrialSql);
  if ($metrialResult == true) {
    echo '<script>alert("Data Submited Successfull");location.href="salesEntry.php";</script>';
  } else {
    echo '<script>alert("Failed")</script>';
  }
}
?>

<script>

/// delete row
document.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("delete-row")) {
        event.preventDefault(); // Prevent default action, which can cause page reload
        var rowId = event.target.getAttribute("data-id");

        if (confirm("Are you sure you want to delete this row?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "deletefinishedGoods.php", true); // Server-side delete script
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Remove the row from the table
                            var row = document.querySelector(`tr[data-id="${rowId}"]`);
                            if (row) row.remove();
                        } else {
                            alert("Error deleting the row: " + response.message);
                        }
                        // Wait until static rows are added, then attach the event listener
                    } catch (e) {
                        console.error("Error parsing response: ", e);
                    }
                }
            };
            

            xhr.send("id=" + encodeURIComponent(rowId));
        }
    }
});

  // Function to update the total amount based on discount, additional charges, and deductions
  function updateTotalAmount() {
    // Get the base total amount
    var totalAmount = parseFloat(document.querySelector("#totalAmountBase").value) || 0;

    // Get the discount percentage and calculate the discount amount
    var addChargesPercentage = parseFloat(document.querySelector("#addChargesPercentage").value) || 0;
    var discountAmount = (totalAmount * addChargesPercentage) / 100;
    document.querySelector("#discountAmount").value = discountAmount.toFixed(2);

    // Calculate the amount after applying the discount
    var afterDiscountTotal = totalAmount - discountAmount;
    document.querySelector("#afterDiscountTotal").value = afterDiscountTotal.toFixed(2);

    // Get additional charges and deductions amounts
    var addChargesAmount = parseFloat(document.querySelector("#addChargesAmount").value) || 0;
    var deductionChargeAmount = parseFloat(document.querySelector("#deductionChargeAmount").value) || 0;

    // Calculate the final total
    var finalTotal = afterDiscountTotal + addChargesAmount - deductionChargeAmount;

    // Update the Bill Amount field
    document.querySelector("#totalBill").value = finalTotal.toFixed(2);
  }

  // Attach event listeners to trigger the calculation when values change
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#addChargesPercentage").addEventListener("input", updateTotalAmount);
    document.querySelector("#addChargesAmount").addEventListener("input", updateTotalAmount);
    document.querySelector("#deductionChargeAmount").addEventListener("input", updateTotalAmount);
    document.querySelector("#totalAmountBase").addEventListener("input", updateTotalAmount);

    // Initially calculate the total amount
    updateTotalAmount();
  });




  ///show instant data same description
  function showUser123(groupName, voucherNo) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        try {
          var response = JSON.parse(xmlhttp.responseText);

          var productCalculationData = response.productCalculation || [];
          var totalQuantity = 0;
          var grossTotal = 0;

          var tableBody = document.querySelector("#itemTable tbody.dynamicData");
          if (tableBody) {
            tableBody.innerHTML = ""; // Clear only the dynamic rows

            productCalculationData.forEach(function(item, index) {
              var rowTotal = item.totalQty * item.rate;
              totalQuantity += parseFloat(item.quantity);
              grossTotal += rowTotal;

              var row = `
                            <tr data-id="${item.id}">
                                <td><a href="#" class="fw-medium">${index + 1}</a></td>
                                <td style="display:none;">${item.groupName}</td>
                                <td>${item.description}</td>
                                <td style="display:none;">${item.packingUnit}</td>
                                <td style="display:none;">${item.length}</td>
                                <td style="display:none;">${item.qtyPack}</td>
                                <td>${item.totalQty}</td>
                                <td>${item.coilWt}</td>
                                <td>${item.rate}</td>
                                <td style="display:none;">${item.lrNo}</td>
                                <td style="display:none;">${item.transport}</td>
                                <td style="display:none;">${item.lotNo}</td>
                                <td>${rowTotal.toFixed(2)}</td>
                                <td style="display:flex;">
                                    <button class="edit-row" data-id="${item.id}" onclick="editRow(event, this)" style="margin-right:8px;">Edit</button>
                                    <button class="delete-row" data-id="${item.id}">Delete</button> <!-- Delete Button -->
                                </td>
                            </tr>`;
              tableBody.innerHTML += row;
            });
          }

          // Set the value of the total amount field
          var totalAmountField = document.querySelector("#totalAmountBase");
          if (totalAmountField) {
            totalAmountField.value = grossTotal.toFixed(2); // Set total amount value
          }

          // Optionally display additional sections like remarks, charges, etc.
          document.querySelector("#chargesSection").style.display = "block";

        } catch (e) {
          console.error("Error parsing JSON response: ", e);
        }
      } else if (xmlhttp.readyState === 4) {
        console.error("Request failed with status: ", xmlhttp.status);
      }
    };

    xmlhttp.open("GET", "getGoodsPurchaseMaterial.php?q=" + encodeURIComponent(groupName) + "&voucherNo=" + encodeURIComponent(voucherNo), true);
    xmlhttp.send();
  }


function showUser1234(str) {
  if (str === "") {
    document.querySelector(".descriptionSelect").innerHTML = "<option value=''>Select Description</option>";
    document.getElementById("quantity").textContent = ""; // Clear quantity
    return;
  }

  var xmlhttp = new XMLHttpRequest();
  
  
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      var response = JSON.parse(xmlhttp.responseText);
      //alert(response);

      // Update description dropdown
      var descriptionSelect = document.querySelector(".descriptionSelect");
      descriptionSelect.innerHTML = "<option value=''>Select Description</option>" +
        response.descriptions.map(function(descriptionData) {
          return "<option value='" + descriptionData.description + "' data-rate='" + descriptionData.rate + "' data-unit='" + descriptionData.unit + "'>" + descriptionData.description + "</option>";
        }).join("");

      // Add event listener to description select to update rate and unit
      descriptionSelect.addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        if (selectedOption) {
          var selectedDescription = selectedOption.value; // Get selected description
          document.getElementById('newDescriptionIs').value=selectedDescription;
          var selectedRate = selectedOption.getAttribute("data-rate");
          var selectedUnit = selectedOption.getAttribute("data-unit");

          // Update rate and unit inputs
          document.querySelector(".rateInput").value = selectedRate || ""; // Update rate field
          document.querySelector(".unitInput").value = selectedUnit || ""; // Update unit field
          
          // Make an AJAX request to get the baseQty for the selected description
          var xmlhttp2 = new XMLHttpRequest();
          xmlhttp2.onreadystatechange = function () {
             // alert(selectedDescription);
              
              if (xmlhttp2.readyState === 4 && xmlhttp2.status === 200) {
                  var responseIs =(xmlhttp2.responseText).split("*");
                //   alert(responseIs);
                  
                  // Assuming the response contains the total baseQty
                  var totalBaseQty = responseIs[0];
                  //length data
                  document.getElementById('length').innerHTML = '<select class="form-select length" id="length" name="length" style="width:170px" onchange="fetchQuantity(this.value)"><option>Select Length</option>' + responseIs[1] + '</select>';
                  var boxAllQtyData = responseIs[2]
                  // Display the total baseQty in an input field
                  document.querySelector(".baseQtyInput").value = totalBaseQty; // Add an input for baseQty in your HTML
                  document.querySelector(".boxAllQty").value = boxAllQtyData; // Add an input for baseQty in your HTML
              }
          };

          // Call the PHP script to get the baseQty, passing the selected description (not str)
          // Call the PHP script to get the baseQty, passing the selected description (not str)
          xmlhttp2.open("GET", "getPurchaseStock.php?q=" + encodeURIComponent(selectedDescription) + "&qb=" + encodeURIComponent(str), true);
          
        //   xmlhttp2.open("GET", "getPurchaseStock.php?q=" + encodeURIComponent(selectedDescription), true);
          xmlhttp2.send();
        }
      });

      // No length handling here
    }
  };

  
  xmlhttp.open("GET", "getGoodsGroupData.php?q=" + encodeURIComponent(str), true);
  xmlhttp.send();
  
  
}




function fetchQuantity(length) {
    var description = document.getElementById('newDescriptionIs').value;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var response = JSON.parse(xmlhttp.responseText);
            // Display quantity above the length field
            if (response.quantity) {
                document.getElementById("quantity").textContent = "Stocks: " + response.quantity;
            } else {
                document.getElementById("quantity").textContent = "Quantity not available";
            }
        }
    };

    // Send AJAX request with encoded productCat and length
    xmlhttp.open("GET", "getQuantity.php?productCat=" + encodeURIComponent(description) + "&length=" + encodeURIComponent(length), true);
    xmlhttp.send();
}


function insertData() {
    var productCat = document.querySelector('[name="productCat"]').value;
    var voucherNo = document.querySelector('[name="voucherNo"]').value;
    var calDescription = document.querySelector('[name="calDescription"]').value;
    var packingUnit = document.querySelector('[name="packingUnit"]').value;
    var length = document.querySelector('[name="length"]').value;
    var qtyPack = document.querySelector('[name="qtyPack"]').value;
    var totalQty = document.querySelector('[name="totalQty"]').value;
    var coilWt = document.querySelector('[name="coilWt"]').value;
    var rateIs = document.querySelector('[name="rateIs"]').value;
    var lrNo = document.querySelector('[name="lrNo"]').value;
    var transport = document.querySelector('[name="transport"]').value;
    var lotNo = document.querySelector('[name="lotNo"]').value;
    var baseQtyInput = document.querySelector(".baseQtyInput").value;

    // Get the edit ID if updating an existing record
    var editId = document.getElementById("editId").value;
    
    // Fetch stock value from the "Stocks" div
    var stockDiv = document.querySelector("#quantity");
    var stockValue = parseFloat(stockDiv.innerText.replace("Stocks: ", "").trim());

    // Client-side validation
    if (!productCat || !calDescription || !packingUnit || !length || !qtyPack || !totalQty || !coilWt || !rateIs || !voucherNo) {
        alert('Please fill out all required fields.');
        return;
    }
    
    var baseQtyNumber = parseFloat(totalQty);
    var baseQtyInputNumber = parseFloat(baseQtyInput);
    
    if (baseQtyNumber > baseQtyInputNumber) {
        alert('Total Qty (Qty/Unit) More Than Of Total Stocks');
        return;
    }
    
    // var qtyPackNumber = parseFloat(qtyPack);
    // var boxAllQtyNumber = parseFloat(boxAllQty);

    // if (qtyPackNumber > boxAllQtyNumber) {
    //     alert('Total Qty (Qty/Unit) More Than Of Total Stocks');
    //     return;
    // }

    // Skip stock validation when in edit mode
    if (!editId && qtyPack > stockValue) {
        alert('Quantity exceeds available stock of ' + stockValue + '. Please enter a smaller quantity.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", editId ? "updateFoodsPurchaseData.php" : "insertFoodsPurchaseData1.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);

            // Clear the form fields after successful insert/update
            document.querySelector('[name="productCat"]').value = '';
            document.querySelector('[name="calDescription"]').value = '';
            document.querySelector('[name="packingUnit"]').value = '';
            document.querySelector('[name="length"]').value = '';
            document.querySelector('[name="qtyPack"]').value = '';
            document.querySelector('[name="totalQty"]').value = '';
            document.querySelector('[name="coilWt"]').value = '';
            document.querySelector('[name="rateIs"]').value = '';
            document.querySelector('[name="lrNo"]').value = '';
            document.querySelector('[name="transport"]').value = '';
            document.querySelector('[name="lotNo"]').value = '';
            document.getElementById("editId").value = ''; // Reset edit ID
            document.querySelector('[name="qtyPack"]').readOnly = false; // Remove read-only attribute after edit

            if (!editId) {
                // Subtract totalQty from stockValue and update stock in the database
                var newStock = qtyPack;
                // Deduct stock only if not editing
                var newStock1 = stockValue - qtyPack;
                updateStockInDatabase(newStock, productCat, length, calDescription);
                stockDiv.innerText = "Stocks: " + newStock1;
            }

            showUser123(voucherNo);
        }
    };

    xhr.send(
        "productCat=" + encodeURIComponent(productCat) +
        "&voucherNo=" + encodeURIComponent(voucherNo) +
        "&calDescription=" + encodeURIComponent(calDescription) +
        "&packingUnit=" + encodeURIComponent(packingUnit) +
        "&length=" + encodeURIComponent(length) +
        "&qtyPack=" + encodeURIComponent(qtyPack) +
        "&totalQty=" + encodeURIComponent(totalQty) +
        "&coilWt=" + encodeURIComponent(coilWt) +
        "&rateIs=" + encodeURIComponent(rateIs) +
        "&lrNo=" + encodeURIComponent(lrNo) +
        "&transport=" + encodeURIComponent(transport) +
        "&lotNo=" + encodeURIComponent(lotNo) +
        "&editId=" + encodeURIComponent(editId) +
        "&purchaseFinishedGoods=" + encodeURIComponent("salesFinishedGoods") +
        "&proCalculationSubmit=true"
    );
}



// Function to update stock in the database
function updateStockInDatabase(newStock, productCat, length,calDescription) {
    //alert(calDescription);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "updateStock.php", true); // The PHP file to handle stock updates
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                //alert(xhr.responseText); // Log the response for debugging
            }
        };
    
        xhr.send(
            "newStock=" + encodeURIComponent(newStock) +
            "&productCat=" + encodeURIComponent(productCat) +
            "&length=" + encodeURIComponent(length) +
            "&calDescription=" + encodeURIComponent(calDescription)
        );
    }

</script>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">

<head>
  <meta charset="utf-8" />
  <title>Sale| <?php echo $_SESSION["userName"]; ?> </title>
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
<style>
  .add_form_field {
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

  .delete {
    background-color: #3c8dbc;
    border: none;
    height: 30px;
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

  @media(max-width:769px) {
    .delete {
      float: right !important;
    }
  }

  @media(max-width:480px) {
    .delete {
      float: right !important;
    }
  }

  @media(max-width:320px) {
    .delete {
      float: right !important;
    }
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

<body>
  <!-- Begin page -->
  <div id="layout-wrapper">
    <!-- ========== Header Start ========== -->
    <?php include_once "include/header.php"; ?>
    <!-- ========== Header End ========== -->
    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once "include/left-side-menu.php"; ?>
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
                <h4 class="mb-sm-0">Sales</h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                    <li class="breadcrumb-item active">Sales</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

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
                        <div class="col-lg-3">
                          <div class="mb-4">
                            <label class="form-label">Party Account</label>
                            <select id="vendorList" name="partyAccountName" class="form-select" onChange="selectPartyAccount(this.value)" required>
                              <option value="">Select Party Account</option>
                              <?php while ($accountData = $accountResult->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $accountData["accountName"]; ?>"><?php echo $accountData["accountName"]; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-4">
                            <label class="form-label">Account</label>
                            <select name="accountName" id="accountName" class="form-select" required>
                              <option value="">Select Account</option>
                            </select>
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-4">
                            <label for="" class="form-label">V.No.</label>
                            <?php
                            $voucherNo = $voucherRow['voucherNo']+1;
                            // $vNo = substr(strtotime(date("h:i:s")) + $rand, -4);
                            ?>
                            <input type="text" class="form-control" name="voucherNo" placeholder="Enter V.No." value="<?php echo $voucherNo; ?>" required />
                          </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-3">
                          <div class="mb-4">
                            <label for="StartleaveDate" class="form-label">Date</label>
                            <input type="text" class="form-control" name="date" value="<?php echo date(
                                                                                          "d-m-Y"
                                                                                        ); ?>" required />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <div id="customerList">
                                <div class="table-responsive table-card mt-3 mb-1">
                                  <table class="table align-middle table-nowrap" id="itemTable">
                                    <thead class="table-light">
                                      <tr>
                                        <th>Prod Category</th>
                                        <th>Description</th>
                                        <th>Packing Unit</th>
                                        <th>Length</th>
                                        <th>Qty/Pack</th>
                                        <th>Qty/Unit</th>
                                        <th>Unit</th>
                                        <th>Price/Unit</th>
                                        <th>LR No.</th>
                                        <th>Transport</th>
                                        <th>Lot No.</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                      <td style="width:200px;padding-left: 0px;">
                                        <div>
                                          <div class="form-group" id="textarea1">
                                            <select id="groupSelect" class="form-select border" name="productCat" onChange="showUser1234(this.value)" style="width:170px">
                                              <option value="" selected="selected">Prod Category</option>
                                              <?php while ($row = $menu_details->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                                              <?php } ?>
                                            </select>
                                            <input type="hidden" id="editId">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group txtHint">
                                          <select class="form-select descriptionSelect" name="calDescription" style="width:170px">
                                            <option value="">Description</option>
                                          </select>
                                        </div>
                                        <input type="hidden" id="newDescriptionIs">
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="packingUnit" name="packingUnit" placeholder="Packing Unit" style="width: 120px;" />
                                        </div>
                                      </td>
                                      <td>
                                          <div id="quantity" style="font-weight: bold; margin-bottom: 5px;"></div>
                                        <div class="form-group">
                                          <select class="form-select length" id="length" name="length" style="width:170px" onchange="fetchQuantity(this.value)">
                                            <option value="">Select Length</option>
                                          </select>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="qtyPack" name="qtyPack" placeholder="Qty/Pack" style="width: 120px;" oninput="calculateNetQty()" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="totalQty" name="totalQty" placeholder="Total Qty" style="width: 120px;" readonly />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control unitInput" name="coilWt" placeholder="Coil Wt." style="width: 120px;" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group txtHint">
                                          <input type="text" class="form-control rateInput" name="rateIs" placeholder="Rate" style="width: 120px;" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="lrNo" name="lrNo" placeholder="LR No." style="width: 120px;" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="transport" name="transport" placeholder="Transport" style="width: 120px;" />
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="lotNo" name="lotNo" placeholder="Lot No." style="width: 120px;" />
                                        </div>
                                      </td>
                                      
                                      <td>
                                        <div class="d-flex">
                                          <div class="edit">
                                            <button type="button" class="btn btn-sm btn-success edit-item-btn add_form_field1" onclick="insertData()" id="addColum">Add</button>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group" style="display:none;">
                                            <span style="font-size: 13px !important;">Box Stock</span>
                                            <input type="text" class="boxAllQty" style="width: 71px;"  />
                                        </div>
                                    </td>
                                      <td>
                                        <div class="form-group">
                                            <span style="font-size: 13px !important;">Total Stock</span>
                                            <input type="text" class="baseQtyInput" style="width: 71px;"  />
                                        </div>
                                    </td>
                                      </tr>
                                      <!-- JavaScript for Calculation -->
                                      <script>
                                        function calculateNetQty() {
                                          // Get values from the Base Qty and Content fields
                                          var length = parseFloat(document.getElementById('length').value) || 0;
                                          var qtyPack = parseFloat(document.getElementById('qtyPack').value) || 0;

                                          // Calculate Net Qty (Base Qty * Content)
                                          var totalQty = length * qtyPack;

                                          // Display the calculated Net Qty in the Net Qty field
                                          document.getElementById('totalQty').value = totalQty;
                                        }
                                      </script>
                                    </tbody>
                                    <br>
                                    <thead class="table-light">
                                      <tr>
                                        <th>Sr No.</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                      </tr>
                                    </thead>
                                    <tbody class="dynamicData">
                                      <!-- Rows inserted dynamically here by showUser123 -->
                                    </tbody>
                                  </table>
                                  <fieldset id="account" class="containerForm1">
                                  </fieldset>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                                              function editRow(event, button) {
    // Prevent the default button action
    event.preventDefault();

    const row = button.closest('tr');

    // Retrieve the current values from the row
    const prodCat = row.cells[1].innerText;
    const description = row.cells[2].innerText;
    const packingUnit = row.cells[3].innerText;
    const length = row.cells[4].innerText;
    const qtyPack = row.cells[5].innerText;
    const totalQty = row.cells[6].innerText;
    const coilWt = row.cells[7].innerText;
    const rateIs = row.cells[8].innerText;
    const lrNo = row.cells[9].innerText;
    const lotNo = row.cells[10].innerText;
    const transport = row.cells[11].innerText;

    // Populate the fields with the current row data
    document.querySelector('[name="productCat"]').value = prodCat;
    document.querySelector('[name="calDescription"]').value = description;
    document.querySelector('[name="packingUnit"]').value = packingUnit;
    document.querySelector('[name="length"]').value = length;
    document.querySelector('[name="qtyPack"]').value = qtyPack;
    document.querySelector('[name="totalQty"]').value = totalQty;
    document.querySelector('[name="coilWt"]').value = coilWt;
    document.querySelector('[name="rateIs"]').value = rateIs;
    document.querySelector('[name="lrNo"]').value = lrNo;
    document.querySelector('[name="lotNo"]').value = lotNo;
    document.querySelector('[name="transport"]').value = transport;

    // Store the ID of the row being edited in the hidden input
    document.getElementById("editId").value = row.dataset.id;

    // Set qtyPack to read-only during edit
    document.querySelector('[name="qtyPack"]').readOnly = true;
}

                                            
                                            </script>

                      <div class="row">
                        <!-- Remarks Section -->
                        <div class="col-sm-4 align-content-end">
                          <div class="form-group">
                            <label for="remark">Remarks</label>
                            <textarea class="form-control" id="remark" name="remark"></textarea>
                          </div>
                        </div>

                        <!-- Charges and Deductions Section -->
                        <div class="col-sm-4">
                          <div class="row g-3 align-items-center mt-4 mb-1">
                            <div class="col-5">
                              <label for="addChargesPercentage" class="col-form-label">Discount [-] </label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="addChargesPercentage" name="addChargesPercentage" class="form-control" placeholder="Enter Percentage">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mt-4 mb-1">
                            <div class="col-5">
                              <label for="addCharges" class="col-form-label">Addl. Charges [+]</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="addCharges" name="addChargesRemark" class="form-control" placeholder="Enter description">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="deductionCharge" class="col-form-label">Deductions [-]</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="deductionCharge" name="deductionChargeRemark" class="form-control" placeholder="Enter description">
                            </div>
                          </div>
                        </div>

                        <!-- Total Amount and Final Bill Section -->
                        <div class="col-sm-4">
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="totalAmountBase" class="col-form-label">Total Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="totalAmountBase" name="totalAmountBase" class="form-control">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="discountAmount" class="col-form-label">Discount Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="discountAmount" class="form-control">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="afterDiscountTotal" class="col-form-label">Total Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="afterDiscountTotal" class="form-control">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="addChargesAmount" class="col-form-label">Addl. Charges Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="addChargesAmount" name="addChargesAmount" class="form-control">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="deductionChargeAmount" class="col-form-label">Deductions Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="deductionChargeAmount" name="deductionChargeAmount" class="form-control">
                            </div>
                          </div>
                          <div class="row g-3 align-items-center mb-1">
                            <div class="col-5">
                              <label for="totalBill" class="col-form-label">Bill Amount</label>
                            </div>
                            <div class="col-7">
                              <input type="text" id="totalBill" name="totalBill" class="form-control" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="text-center">
                        <input type="submit" name="purchaseGoodsMetrialSubmit" class="btn btn-info" value="Submit">
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

    <!-- End Page-content -->
    <!-- footer start -->
    <?php include_once "include/footer.php"; ?>
  </div>
  </div>
  <!-- end main content-->
  </div>
  <!-- END layout-wrapper -->
  <!--start back-to-top-->
  <button onClick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"> <i class="ri-arrow-up-line"></i> </button>
  <!--end back-to-top-->

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