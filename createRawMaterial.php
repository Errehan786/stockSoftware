<?php
include_once('config.php');
include_once('include/auth.php');
include_once('include/auth.php');

///final data insert
if (isset($_POST['main_submit'])) {
    $group_name = $_POST['group_name'];
    $pvcDescription = $_POST['pvcDescription'];
    $stock = $_POST['stock'];
    $priceUnit = $_POST['priceUnit'];
    $rate = $_POST['rate'];

    // Determine rate based on group_name
    if ($_POST['group_name'] == 'PVC') {
        $rate = $_POST['pvcRate'];
    } else {
        $rate = $_POST['rate'];
    }

    $units = $_POST['units'];
    $pcs = $_POST['pcs'];
    $othersExpensesField = $_POST['othersExpensesField'];

    // Check if the description already exists in the database
    $getCatSqlIs = "SELECT * FROM `rawMeterial` WHERE `description` = '$pvcDescription'";
    $menu_detailsIs = $conn->query($getCatSqlIs);
    $existingRow = $menu_detailsIs->fetch(PDO::FETCH_ASSOC);

    // If description exists, update the record
    if ($existingRow) {
        $sql = "UPDATE `rawMeterial` 
                SET `groupName` = '$group_name', 
                    `openingStock` = '$stock', 
                    `priceUnit` = '$priceUnit', 
                    `rate` = '$rate', 
                    `unit` = '$units', 
                    `pcs` = '$pcs', 
                    `otherExpance` = '$othersExpensesField' 
                WHERE `description` = '$pvcDescription'";

        if ($conn->exec($sql)) {
            echo '<script>alert("Data Updated Successfully!"); window.location = "createRawMaterial.php";</script>';
        } else {
            echo '<script>alert("Update Failed!"); window.location = "createRawMaterial.php";</script>';
        }
    } else {
        // If description does not exist, insert a new record
        $sql = "INSERT INTO `rawMeterial`(`groupName`, `description`, `openingStock`, `priceUnit`, `rate`, `unit`, `pcs`, `otherExpance`) 
                VALUES ('$group_name', '$pvcDescription', '$stock', '$priceUnit', '$rate', '$units', '$pcs', '$othersExpensesField')";

        if ($conn->exec($sql)) {
            echo '<script>alert("Data Has Been Inserted Successfully!"); window.location = "createRawMaterial.php";</script>';
        } else {
            echo '<script>alert("Insert Failed!"); window.location = "createRawMaterial.php";</script>';
        }
    }
}


///delete item
if (isset($_REQUEST['metrialId'])) {
  $metrialId = $_REQUEST['metrialId'];
  ///getMaterial
  $getMaterial = "select * from rawMeterial WHERE id='$metrialId'";
  $getResult = $conn->query($getMaterial);
  $fetchRow = $getResult->fetch(PDO::FETCH_ASSOC);
  if($fetchRow['openingStock']>0){
    echo '<script>alert("Data can not be deleted because stock is avilabel!");window.location = "createRawMaterial.php";</script>';
  }else{
      $delSql = "DELETE FROM `rawMeterial` WHERE id='$metrialId'";
  if ($delResult = $conn->exec($delSql)) {
      echo '<script>alert("Data has been Deleted successfully!");window.location = "createRawMaterial.php";</script>';
  } else {
      echo '<script>alert("Data has been not Deleted!");window.location = "createRawMaterial.php";</script>';
  }
  }
}

///get category
$getCatSql = "SELECT distinct(groupName) FROM `rawMeterial`";
$menu_details = $conn->query($getCatSql);

?>

<script>
/// delete row
document.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("delete-row")) {
        event.preventDefault(); // Prevent default action, which can cause page reload
        var rowId = event.target.getAttribute("data-id");

        if (confirm("Are you sure you want to delete this row?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "deleteRow.php", true); // Server-side delete script
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



let descriptionsData = [];
///show instant data same description
function showUser123(groupName, pvcDescription) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                try {
                    var response = JSON.parse(xmlhttp.responseText);

                    var productCalculationData = response.productCalculation || [];

                    var totalQuantity = 0;
                    var grossTotal = 0;
                    var netQty1 = 0;

                    var tableBody = document.querySelector("#itemTable tbody");
                    if (tableBody) {
                        tableBody.innerHTML = ""; // Clear previous rows

                        var totalQuantity = 0;
var grossTotal = 0;

// First, calculate the total quantity and gross total
productCalculationData.forEach(function (item) {
    totalQuantity += parseFloat(item.quantity);
    grossTotal += item.quantity * item.rate;
});

// Now, iterate over the data to create rows
productCalculationData.forEach(function (item, index) {
    var proQtyValue = item.quantity;
    var rowTotal = item.quantity * item.rate;

    // Calculate net quantity as a proportion of the total quantity (from outside the loop)
    var netQty = item.quantity / totalQuantity;

    var row = `<tr data-id="${item.id}">
        <td><a href="#" class="fw-medium">${index + 1}</a></td>
        <td style="display:none;">${item.groupName}</td>
        <td>${item.description}</td>
        <td>${item.quantity}</td>
        <td>${netQty.toFixed(2)}</td>
        <td>${item.units}</td>
        <td>${item.rate}</td>
        <td>${rowTotal.toFixed(2)}</td>
        <td>1 KGS=1 @ 90</td>
        <td>
            <button class="btn btn-warning edit-row" data-id="${item.id}" onclick="editRow(event, this)">Edit</button>
            <button class="btn btn-danger delete-row" data-id="${item.id}">Delete</button>
        </td>
    </tr>`;

    tableBody.innerHTML += row;
});

// Add static rows for totals (same as before)


                        // Add static rows for totals and other charges
                        var staticRows = `
                        <tr>
                          <td colspan="7">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="card shadow-none">
                                  <div class="card-body" style="padding: 0px !important;">
                                    <div id="customerList">
                                      <div class="table-responsive table-card mb-1">
                                        <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                          <tbody class="list form-check-all">
                                            <tr style="display:none;">
                                              <td class="border-bottom-0">Other Charges</td>
                                              <td class="border-bottom-0">Amount</td>
                                            </tr>
                                            <tr style="display:none;">
                                              <td class="border-bottom-0 w-75 align-baseline">
                                                <div class="form-group">
                                                  <input type="text" class="form-control mb-1" name="" />
                                                  <input type="text" class="form-control mb-1" name="" />
                                                </div>
                                              </td>
                                              <td class="border-bottom-0 w-25">
                                                <div class="form-group">
                                                  <input type="text" class="form-control mb-1" value="0.00" name="" />
                                                  <input type="text" class="form-control mb-1" value="0.00" name="" />
                                                  <input type="text" class="form-control mb-1" value="0.00" name="" />
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
                              <div class="col-lg-6">
                                <div class="card shadow-none">
                                  <div class="card-body" style="padding: 0px !important;">
                                    <div id="customerList">
                                      <div class="table-responsive table-card mb-1">
                                        <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                          <tbody class="list form-check-all">
                                            <tr>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  Gross Total
                                                </div>
                                              </td>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  <input type="text" class="form-control" id="grossTotalField" name="" value="${grossTotal.toFixed(2)}" readonly />
                                                </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  Total Quantity
                                                </div>
                                              </td>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  <input type="text" class="form-control" id="totalQuantityField" name="totalQuantityField" value="${totalQuantity.toFixed(2)}" readonly />
                                                </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  Others Expenses
                                                </div>
                                              </td>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  <input type="text" class="form-control" id="othersExpensesField" name="othersExpensesField" value="0.00" />
                                                </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  Net Rates / KGS
                                                </div>
                                              </td>
                                              <td class="border-bottom-0 pb-0">
                                                <div class="form-group">
                                                  <input type="text" class="form-control" id="netRatesField" name="pvcRate" value="${(grossTotal / totalQuantity).toFixed(2)}" readonly />
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
                          </td>
                        </tr>`;
                        tableBody.innerHTML += staticRows;
                    }

                    // Wait until static rows are added, then attach the event listener
                    setTimeout(function () {
                        var othersExpensesField = document.getElementById('othersExpensesField');
                        var totalQuantityField = document.getElementById('totalQuantityField');
                        var netRatesField = document.getElementById('netRatesField');

                        if (othersExpensesField && totalQuantityField && netRatesField) {
                            othersExpensesField.addEventListener('input', function () {
                                var othersExpenses = parseFloat(this.value) || 0;
                                var updatedGrossTotal = grossTotal;
                                document.getElementById('grossTotalField').value = updatedGrossTotal.toFixed(2);

                                // Recalculate net rates
                                var totalQuantity = parseFloat(totalQuantityField.value) || 1; // Avoid division by zero
                                if (totalQuantity > 0) {
                                    var netRate = (updatedGrossTotal / totalQuantity)+othersExpenses;
                                    netRatesField.value = netRate.toFixed(2);
                                }
                            });
                        }
                    }, 100); // Adding a delay to ensure the DOM is fully updated

                    // Hide rate and unit inputs initially
                    var rateInput = document.querySelector(".rateInput");
                    var unitInput = document.querySelector(".unitInput");
                    

                } catch (e) {
                    console.error("Error parsing JSON response: ", e);
                }
            } else {
                console.error("Request failed with status: ", xmlhttp.status);
            }
        }
    };

    xmlhttp.open("GET", "getGroupData.php?q=" + encodeURIComponent(groupName) + "&pvcDescription=" + encodeURIComponent(pvcDescription), true);
    xmlhttp.send();
}






///for get description
function showUser1234(str) {
    if (str === "") {
        // Clear inputs and table rows
        document.querySelector(".descriptionSelect").innerHTML = "<option value=''>Select Description</option>";
        // document.querySelector(".rateInput").style.display = "none";
        // document.querySelector(".unitInput").style.display = "none";
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

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var response = JSON.parse(xmlhttp.responseText);

            // Save descriptions data for later use
            descriptionsData = response.descriptions;

            var totalQuantity = 0;
            var grossTotal = 0;

            // Populate table with items
            var tableBody = document.querySelector("#itemTable tbody");
            if (tableBody) {
                tableBody.innerHTML = ""; // Clear previous rows

                var staticRows = `
                    <tr>
                      <td colspan="7">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="card shadow-none">
                              <div class="card-body" style="padding: 0px !important;">
                                <div id="customerList">
                                  <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                      <tbody class="list form-check-all">
                                        <tr style="display:none;">
                                          <td class="border-bottom-0">Other Charges</td>
                                          <td class="border-bottom-0">Amount</td>
                                        </tr>
                                        <tr style="display:none;">
                                          <td class="border-bottom-0 w-75 align-baseline">
                                            <div class="form-group">
                                              <input type="text" class="form-control mb-1" name="" />
                                              <input type="text" class="form-control mb-1" name="" />
                                            </div>
                                          </td>
                                          <td class="border-bottom-0 w-25">
                                            <div class="form-group">
                                              <input type="text" class="form-control mb-1" value="0.00" name="" />
                                              <input type="text" class="form-control mb-1" value="0.00" name="" />
                                              <input type="text" class="form-control mb-1" value="0.00" name="" />
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
                          <div class="col-lg-6">
                            <div class="card shadow-none">
                              <div class="card-body" style="padding: 0px !important;">
                                <div id="customerList">
                                  <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                      <tbody class="list form-check-all">
                                        <tr>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              Gross Total
                                            </div>
                                          </td>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              <input type="text" class="form-control" id="grossTotalField" name="" value="${grossTotal.toFixed(2)}" readonly />
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              Total Quantity
                                            </div>
                                          </td>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              <input type="text" class="form-control" id="totalQuantityField" name="totalQuantityField" value="${totalQuantity.toFixed(2)}" readonly />
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              Others Expenses
                                            </div>
                                          </td>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              <input type="text" class="form-control" id="othersExpensesField" name="othersExpensesField" value="0.00" />
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              Net Rates / KGS
                                            </div>
                                          </td>
                                          <td class="border-bottom-0 pb-0">
                                            <div class="form-group">
                                              <input type="text" class="form-control" id="netRatesField" name="" value="${(grossTotal / totalQuantity).toFixed(2)}" readonly />
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
                      </td>
                    </tr>`;

                tableBody.innerHTML += staticRows;
            }

            // Update description dropdown
            var descriptionSelect = document.querySelector(".descriptionSelect");
            descriptionSelect.innerHTML = "<option value=''>Select Description</option>" +
                response.descriptions.map(function (descriptionData) {
                    return "<option value='" + descriptionData.description + "'>" + descriptionData.description + "</option>";
                }).join("");

            // Hide rate and unit inputs initially
            // document.querySelector(".rateInput").style.display = "none";
            // document.querySelector(".unitInput").style.display = "none";
            
            // Show rate and unit inputs when a description is selected
            descriptionSelect.addEventListener("change", function () {
                var selectedDescription = this.value;
                var selectedData = descriptionsData.find(desc => desc.description === selectedDescription);

                if (selectedData) {
                    document.querySelector(".rateInput").value = selectedData.rate;
                    document.querySelector(".unitInput").value = selectedData.unit;
                    document.querySelector(".rateInput").style.display = "block";
                    document.querySelector(".unitInput").style.display = "block";
                } else {
                    // document.querySelector(".rateInput").style.display = "none";
                    // document.querySelector(".unitInput").style.display = "none";
                }
            });
        }
    };

    xmlhttp.open("GET", "getGroupData1.php?q=" + encodeURIComponent(str), true);
    xmlhttp.send();
}

////for insert pvc multiple row material data
function insertData() {
    var productCat = document.querySelector('[name="productCat"]').value;
    var totalQuantityField = document.querySelector('[name="totalQuantityField"]').value;
    var pvcDescription = document.querySelector('[name="pvcDescription"]').value; // Keep pvcDescription
    var calDescription = document.querySelector('[name="calDescription"]').value;
    var proQty = document.querySelector('[name="proQty"]').value;
    var coilWt = document.querySelector('[name="coilWt"]').value;
    var rateIs = document.querySelector('[name="rateIs"]').value;
    
    // Get the edit ID
    var editId = document.getElementById("editId").value;

    // Client-side validation
    if (!productCat || !pvcDescription || !calDescription || !proQty || !coilWt || !rateIs) {
        alert('Please fill out all required fields.');
        return; // Prevent form submission if any field is missing
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", editId ? "updateData.php" : "insertData.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
             //alert(xhr.responseText); // Show the response from PHP
            
            // Clear other form fields after successful operation, but not pvcDescription
            document.querySelector('[name="productCat"]').value = '';
            document.querySelector('[name="calDescription"]').value = '';
            document.querySelector('[name="proQty"]').value = '';
            document.querySelector('[name="coilWt"]').value = '';
            document.querySelector('[name="rateIs"]').value = '';
            document.getElementById("editId").value = ''; // Clear the edit ID for future inserts

            // Fetch and show data based on pvcDescription
            showUser123(pvcDescription);
        }
    };

    xhr.send(
        "productCat=" + encodeURIComponent(productCat) +
        "&pvcDescription=" + encodeURIComponent(pvcDescription) +
        "&calDescription=" + encodeURIComponent(calDescription) +
        "&proQty=" + encodeURIComponent(proQty) +
        "&coilWt=" + encodeURIComponent(coilWt) +
        "&rateIs=" + encodeURIComponent(rateIs) +
        "&editId=" + encodeURIComponent(editId) + // Send the edit ID if present
        "&totalQuantityField=" + encodeURIComponent(totalQuantityField) + // Send the edit ID if present
        "&proCalculationSubmit=true"
    );
}
</script>

<?php
$sql = "SELECT * FROM `items` where user_reg_id='$_SESSION[id]'";
$result = $conn->query($sql);
?>
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
              <h4 class="mb-sm-0">Raw Material List </h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">Raw Material List</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->

        <!-- end row -->
        <div class="row" id="addNewPurchase">
          <div class="col-xxl-12">
            <div class="card">
              <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add Raw Material </h4>
              </div>
              <form action="" method="post">
                <div class="row p-3">
                  <div class="col-lg-4">
                    <div class="mb-4">
                      <?php
                      // vender name select code
                      $sql = "SELECT * FROM `group`";
                      $result = $conn->query($sql);
                      ?>
                      <label class="form-label">Select Group</label>
                      <select id="vendorList" name="group_name" class="form-select" onChange="createVendor(this.value);getMaterialData(this.value);">
                        <option value="">Select Group</option>
                        <?php echo '<optgroup label="For a new Group"></optgroup><option value="Add New">Add New</option>'; ?>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $row['name']; ?>">
                            <?php echo htmlspecialchars($row['name']); ?>
                          </option>
                        <?php } ?>
                      </select>
                    
                      <script>
                      function getMaterialData(groupName) {
                        if (groupName == "") {
                            document.getElementById("materialData").innerHTML = ""; // Clear data if no group is selected
                            return;
                        }
                    
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "getMaterialData.php", true); // Assuming you have a separate PHP file for fetching data
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
                          // Show the "Add New" modal if selected
                          if (getVType === "Add New") {
                            $("#addNewVendor").modal('show'); // Use Bootstrap modal method to show the modal
                          }
                    
                          // Show or hide the popup fields based on the selected group
                          if (getVType === "PVC") {
                            $("#rateData").hide();  // Show the popup fields when PVC is selected
                            $("#proCal").show();  // Show the popup fields when PVC is selected
                          } else {
                              $("#rateData").show();
                            $("#proCal").hide();  // Hide the popup fields for other selections
                          }
                        }
                    
                        function closeVendorModel() {
                          $("#addNewVendor").modal('hide'); // Use Bootstrap modal method to hide the modal
                        }
                    
                        function vendorRsubmit(event) {
                          event.preventDefault(); // Prevent default form submission
                          const vendorName = document.vendorForm.v_name.value;
                          if (vendorName === '') {
                            $("#messageVendorTxt").html('<span style="color: red;"> Enter Vendor Name</span>');
                            return false;
                          }
                    
                          $("#btnVbutton").addClass('fa-spinner fa-spin');
                          const myData = {
                            v_name: vendorName
                          };
                    
                          jQuery.ajax({
                            type: "POST",
                            url: "submitModelData.php",
                            data: myData,
                            success: function(response) {
                              if (response === '0') {
                                $("#messageVendorTxt").html('<span style="color: red;"> Some error!</span>');
                              } else {
                                $("#messageVendorTxt").html('<span style="color: green;"> Data has been saved successfully</span>');
                                const newOption = `<option value="${vendorName}">${vendorName}</option>`;
                                $("#vendorList").append(newOption); // Add new option to the dropdown
                    
                                setTimeout(function() {
                                  document.vendorForm.v_name.value = '';
                                  $("#addNewVendor").modal('hide'); // Use Bootstrap method to hide modal
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
                    </div>

                  </div>
                  <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" id="pvcDescription" name="pvcDescription" placeholder="Enter Description" oninput="checkDescription(this.value)" />
                        <small id="descriptionMessage" style="color:red; display:none;">Description already exists!</small>
                      </div>
                    </div>
                    
                    <script>
                        function checkDescription(pvcDescriptionData) {
                            if (pvcDescriptionData.length === 0) {
                                document.getElementById("descriptionMessage").style.display = "none";
                                return;
                            }
                        
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function () {
                                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                                    try {
                                        var response = JSON.parse(xmlhttp.responseText);
                                        console.log(response);  // Debugging
                        
                                        if (response.exists) {
                                            // Show message if description exists
                                            document.getElementById("descriptionMessage").style.display = "inline";
                                            document.getElementById("descriptionMessage").textContent = "Description already exists!";
                                        } else {
                                            // Hide message if description does not exist
                                            document.getElementById("descriptionMessage").style.display = "none";
                                        }
                                    } catch (e) {
                                        console.error("Error parsing JSON response: " + e);
                                    }
                                }
                            };
                        
                            xmlhttp.open("GET", "checkDescription.php?pvcDescriptionData=" + encodeURIComponent(pvcDescriptionData), true);
                            xmlhttp.send();
                        }

                    </script>
                    
                  <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Opening Stock
                      </label>
                      <input type="text" class="form-control" name="stock" placeholder="Opening stock" required />
                    </div>
                  </div>
                  
                  <div class="col-lg-4" id="rateData">
                    <div class=" mb-3">
                      <label class="form-label">Rate</label>
                      <input type="text" class="form-control" name="rate" placeholder="Enter Rate" />
                    </div>
                  </div>
                  <div class="col-lg-2" style="padding-right: 0;">
                    <div class="mb-4">
                      <label for="compnayNameinput" class="form-label">Units</label>
                      <select class="form-select" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" name="units" />
                      <option value="">Select Units </option>
                      <option value="Kg">Kg</option>
                      <option value="Meter">Meter</option>
                      <option value="Pcs">Pcs</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2" style="padding-left: 0;">
                    <div class="mb-4">
                      <label for="compnayNameinput" class="form-label">&nbsp;</label>
                      <input type="text" class="form-control" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" name="pcs" value="1" autocomplete="off" />
                      <small><span id="getMiscellaneousCost" style="margin-left: 15px;"></span></small>
                    </div>
                  </div>
                </div>


                <div class="modal-body" id="proCal">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body" style="padding: 0px !important;">
                          <div id="customerList">
                            <div class="table-responsive table-card mt-3 mb-1">
                              <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                  <tr>
                                    <th>Prod Category</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <!--<th>Qty/KG</th>-->
                                    <th>Units</th>
                                    <th>Rate</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                  <td>
                                    <div>
                                      <div class="form-group" id="textarea1">
                                        <select id="groupSelect" class="form-select border" name="productCat" onChange="showUser1234(this.value)">
                                          <option value="" selected="selected">Select Prod. Category</option>
                                          <?php while ($row = $menu_details->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['groupName']; ?>"><?php echo $row['groupName']; ?></option>
                                          <?php } ?>
                                        </select>
                                        <input type="hidden" id="editId"/>
                                      </div>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="form-group txtHint">
                                      <select class="form-select descriptionSelect" name="calDescription">
                                        <option value="">Select Description</option>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="proQty" id="proQty" style="width: 120px;" placeholder="Qty" />
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <input type="text" class="form-control unitInput" name="coilWt" id="coilWt" placeholder="Coil Wt." style="width: 120px;" />
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group txtHint">
                                      <input type="text" class="form-control rateInput" name="rateIs" id="rateIs" placeholder="Rate" style="width: 120px;" />
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="edit">
                                        <button type="button" class="btn btn-sm btn-success edit-item-btn add_form_field1" onclick="insertData()" id="addColum">Add</button>
                                      </div>
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
                  function editRow(event, button) {
                    // Prevent the default button action
                    event.preventDefault(); 
                
                    const row = button.closest('tr');
                
                    // Retrieve the current values from the row
                    const prodCat = row.cells[1].innerText;
                    const description = row.cells[2].innerText;
                    const quantity = row.cells[3].innerText;
                    const rate = row.cells[6].innerText;
                    const netQty = row.cells[5].innerText;
                
                    // Populate the fields with the current row data
                    document.querySelector('[name="productCat"]').value = prodCat; 
                    document.querySelector('[name="calDescription"]').value = description; // Adjust this if needed
                    document.querySelector('[name="proQty"]').value = quantity;
                    document.querySelector('[name="rateIs"]').value = rate;
                    document.querySelector('[name="coilWt"]').value = netQty; // Assuming this is correct
                
                    // Store the ID of the row being edited in the hidden input
                    document.getElementById("editId").value = row.dataset.id; 
                }
                
                </script>
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-body" style="padding: 0px !important;">
                          <div class="live-preview">
                            <div class="table-responsive table-card">
                              <table class="table align-middle table-nowrap mb-0" id="itemTable">
                                  
                                <thead class="table-light">
                                  <tr>
                                    <th>S. No.</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Qty/Kg</th>
                                    <th>Unit</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Formula</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <td colspan="12">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="card shadow-none">
                                          <div class="card-body" style="padding: 0px !important;">
                                            <div id="customerList">
                                              <div class="table-responsive table-card  mb-1">
                                                <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                  <tbody class="list form-check-all">
                                                    <tr style="display:none;">
                                                      <td class="border-bottom-0">Other Charges</td>
                                                      <td class="border-bottom-0">Amount</td>
                                                    </tr>
                                                    <tr style="display:none;">
                                                      <td class="border-bottom-0 w-75 align-baseline">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control mb-1" name="" id="" placeholder="" />
                                                          <input type="text" class="form-control mb-1" name="" id="" placeholder="" />
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 w-25">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control mb-1" name="" id="" placeholder="" />
                                                          <input type="text" class="form-control mb-1" name="" id="" placeholder="" />
                                                          <input type="text" class="form-control mb-1" name="" id="" placeholder="" />
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
                                      <div class="col-lg-6">
                                        <div class="card shadow-none">
                                          <div class="card-body" style="padding: 0px !important;">
                                            <div id="customerList">
                                              <div class="table-responsive table-card  mb-1">
                                                <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                                  <tbody class="list form-check-all">
                                                    <tr>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          Gross Total
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control" name="" id="" placeholder="" />
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control" name="" id="" placeholder="" />
                                                        </div>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          Others Expenses
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control" name="" id="" placeholder="" />
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-0"></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          Net Rates / KGS
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-0">
                                                        <div class="form-group" id="">
                                                          <input type="text" class="form-control" name="" id="" placeholder="" />
                                                        </div>
                                                      </td>
                                                      <td class="border-bottom-0 pb-1"></td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div><!-- end card-body -->
                      </div><!-- end card -->
                    </div><!-- end col -->
                  </div><!-- end row -->
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                  <input type="submit" name="main_submit" class="btn btn-info" style="background-color:#0ab39c;">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="padding: 0px !important;">
                <div id="customerList">
                  <div id="childRDelete"></div>
                  <?php
                  $sql = "SELECT * FROM `rawMeterial` order by id desc";
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
                            <th>Unit</th>
                            <th>Conv. in PCS</th>
                            <th>Rate</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="list form-check-all" id="materialData">
                          <?php
                          $sr = 1;
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            @extract($row);
                          ?>
                            <tr>
                                <td><?php echo $sr; ?></td>
                              <td><?php echo $groupName; ?></td>
                              <td><?php echo $description; ?></td>
                              <td><?php echo $openingStock; ?></td>
                              <td><?php echo $unit; ?></td>
                              <td><?php echo $pcs; ?></td>
                              <td><?php echo $rate; ?></td>
                              <td>
                                <div class="d-flex gap-2">
                                  <div class="edit">
                                    <a href="rawMaterialEdit.php?editMetrialId=<?php echo $id; ?>" class="btn btn-sm btn-success edit-item-btn" name="edit_category_item">Edit</a>
                                  </div>
                                  <div class="remove">
                                    <a href="?metrialId=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                  </div>
                                </div>
                              </td>
                            <?php $sr++; } ?>
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

      </div>
    </div>
    <div class="modal fade" id="addNewVendor" tabindex="-1" aria-labelledby="addNewVendor" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Group</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="closeVendorModel()"></button>
          </div>
          <div class="modal-body" id="pops">
            <form name="vendorForm" method="post" onSubmit="return vendorRsubmit(event)">
              <div class="mb-3">
                <label for="v_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="v_name" id="v_name" placeholder="Enter Group Name" />
              </div>
              <div class="text-center" style="margin-bottom: 15px;">
                <button type="submit" class="btn btn-primary" id="btnVbutton"><i class="fa"></i> Submit</button>
              </div>
              <p id="messageVendorTxt" style="text-align: center;"></p>
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
<!-- footer start -->
<?php include_once('include/footer.php'); ?>

<!--start back-to-top-->
<button onClick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"> <i class="ri-arrow-up-line"></i> </button>
<!--end back-to-top-->
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
<script>
  $(document).ready(function() { //Make script DOM ready
    $('#myselect').change(function() { //jQuery Change Function
      var opval = $(this).val(); //Get value from select element
      if (opval == "secondoption") { //Compare it and if true
        $('#myModal-1').modal("show"); //Open Modal
      }
    });
  });
</script>
</body>

</html>