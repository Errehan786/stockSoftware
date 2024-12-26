<?php 
include_once('config.php'); 
include_once('include/auth.php'); 

$sql1 = "SELECT description, rate, unit FROM rawMeterial WHERE groupName = 'PVC'";
$result1 = $conn->query($sql1);

?>
<script>
    /// delete row
document.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("delete-row")) {
        event.preventDefault(); // Prevent default action, which can cause page reload
        var rowId = event.target.getAttribute("data-id");

        if (confirm("Are you sure you want to delete this row?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "deleteSemiGoods.php", true); // Server-side delete script
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
</script>

<!-- Begin page -->
<div id="layout-wrapper">
  <!-- ========== Header Start ========== -->
  <?php include_once ('include/header.php');?>
  <!-- ========== Header End ========== -->
  <!-- ========== Left Sidebar Start ========== -->
  <?php include_once ('include/left-side-menu.php');?>
  <!-- ========== Left Sidebar End ========== -->
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
              <h4 class="mb-sm-0">PVC Production </h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a> </li>
                  <li class="breadcrumb-item active">PVC Production</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <div class="row">
          <div class="row" id="addNewPurchase">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">PVC Production</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
                    <form id="productForm" action="" method="post">
                      <div class="row">
                          
                          <!--end col-->
                      <div class="col-lg-4">
                            <div class="mb-4">
                                <label for="quantityInput" class="form-label">Quantity</label>
                                <input type="hidden" id="editId" name="editId">
                                <input type="text" class="form-control" id="quantityInput" name="quantityInput" placeholder="Enter Quantity" required />
                            </div>
                        </div>

                      <div class="col-lg-4">
                        <div class="mb-4">
                          <label class="form-label">Prod Category</label>
                          <select id="productCat" name="productCat" class="form-select"  required>
                            <option value="">Select Prod. Category</option>
                            <option value="PVC">PVC</option>
                          </select>
                        </div>
                      </div>
                      <!--end col-->
                       <div class="col-lg-4">
                        <div class="mb-4">
                          <label class="form-label">Description</label>
                          <select id="prodDesc" name="prodDesc" class="form-select" onchange="fetchProductDetails()" required>
                            <option value="">Select Description</option>
                            <?php
                                while($descRow = $result1->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $descRow['description']; ?>"><?php echo $descRow['description']; ?></option>
                            <?php } ?>
                        </select>
                        <script>
                            function fetchProductDetails() {
    var description = document.getElementById('prodDesc').value;
    var inputQuantity = parseFloat(document.getElementById('quantityInput').value); // Get the entered quantity
    //var editId = document.getElementById("editId").value;

    if (description) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_product_details.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    var response = JSON.parse(this.responseText);
                    var tableBody = document.querySelector("#customerTable tbody");
                    tableBody.innerHTML = ''; // Clear previous table rows

                    if (response.length > 0) {
                        var quantityIs = 0;
                        var totalCalculatedQty = 0; // This will store the total calculated quantity for validation

                        response.forEach(function (row, index) {
                            quantityIs = parseFloat(row.quantity);
                            var netQty = quantityIs / row.totalQuantity;

                            // Calculate the product of inputQuantity and netQty
                            var calculatedQty = inputQuantity * netQty;
                            totalCalculatedQty += calculatedQty; // Add to total for validation later
                            var amount = calculatedQty * row.rate;
                            //alert(row.description);

                            var tableRow = `
                                <tr>
                                    <td>${index + 1}</td> <!-- Serial number -->
                                    <td>${row.description}</td>
                                    <td>${netQty.toFixed(2)}</td>
                                    <td>${calculatedQty.toFixed(2)}</td> <!-- Display the calculated result -->
                                    <td>${row.rate}</td>
                                    <td>${amount.toFixed(2)}</td>
                                    <td>${row.stock.toFixed(2)}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += tableRow;
                        });

                        // Set both Unit and Rate fields with the fetched values
                        document.getElementById('unitField').value = response[0].units;  // Update unit field
                        document.getElementById('newRate').value = response[0].newRate;  // Update rate field

                        // Add total calculatedQty to a hidden field or for validation during submission
                        document.getElementById('totalCalculatedQty').value = totalCalculatedQty.toFixed(2);
                        document.getElementById('stockAvailable').value = response[0].stock; // Store the stock for comparison
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="8">No data found</td></tr>';
                    }
                } catch (e) {
                    alert("Error parsing response: " + e.message);
                }
            }
        };

        xhr.send("description=" + encodeURIComponent(description));
    } else {
        alert("Please select a description.");
    }
}

                        </script>


                        </div>
                      </div>
                      <!--end col-->
                       <div class="col-lg-4">
                        <div class="mb-4">
                          <label class="form-label">Trans. Date</label>
                          <input type="text" class="form-control" name="" placeholder="" value="<?php echo date('Y-m-d'); ?>"  id="cDate" required/>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-4">
    <div class="mb-4">
        <label for="unitField" class="form-label">Unit</label>
        <input type="text" class="form-control" id="unitField" placeholder="Unit" required readonly />
    </div>
</div>
                      <div class="col-lg-4" style="display:none;">
    <div class="mb-4">
        <label for="newRate" class="form-label">Rate</label>
        <input type="text" class="form-control" id="newRate" placeholder="Rate" />
    </div>
</div>
<input type="hidden" id="totalCalculatedQty" value="0">
<input type="hidden" id="stockAvailable" value="0">
                      <!--end col-->
                    <div class="col-lg-12 text-center" >
                         <input type="button" id="submitButton" class="btn btn-info" style="background-color:#0ab39c;" value="Submit">
                      </div>
                       </div>
                   </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('submitButton').addEventListener('click', function() {
        var quantity = document.getElementById('quantityInput').value;
        var prodCat = document.getElementById('productCat').value;
        var description = document.getElementById('prodDesc').value;
        var transDate = document.getElementById('cDate').value;
        var unit = document.getElementById('unitField').value;
        var newRate = document.getElementById('newRate').value;
        var editId = document.getElementById('editId').value; // Get the edit ID

        // Validate if any field is empty
        if (!quantity || !prodCat || !description || !transDate || !unit || !newRate) {
            alert("Please fill in all required fields before submitting.");
            return; // Stop the submission process if validation fails
        }

        // Stock validation (same as before)
        var tableRows = document.querySelectorAll("#customerTable tbody tr");
        var stockError = false;

        for (var i = 0; i < tableRows.length; i++) {
            var row = tableRows[i];
            var calculatedQty = parseFloat(row.cells[3].textContent); 
            var stockAvailable = parseFloat(row.cells[6].textContent); 

            if (calculatedQty > stockAvailable) {
                stockError = true;
                alert(`Calculated quantity (${calculatedQty}) exceeds available stock (${stockAvailable})`);
                document.getElementById('quantityInput').value = '';
                document.getElementById('productCat').value = '';
                document.getElementById('prodDesc').value = '';
                break;
            }
        }

        if (stockError) return;

        // Determine whether to update or insert
        var xhr = new XMLHttpRequest();
        xhr.open('POST', editId ? 'update_product.php' : 'insert_product.php', true); // Use `update_product.php` if editing
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                try {
                    var response = JSON.parse(this.responseText);
                    //alert(response);
                    if (response.success) {
                        document.getElementById('quantityInput').value = '';
                        document.getElementById('prodDesc').value = '';
                        document.getElementById('editId').value = ''; // Clear editId

                        if (editId) {
                            
                            // Update the existing row if editing
                            var totalAmt = response.data.quantity * response.data.rate;
                    var editedRow = document.querySelector(`#customerTableIs tr[data-id='${editId}']`);
                    editedRow.cells[1].innerText = response.data.quantity;
                    editedRow.cells[2].innerText = response.data.description;
                    editedRow.cells[3].innerText = response.data.cDate;
                    editedRow.cells[4].innerText = response.data.unit;
                    editedRow.cells[5].innerText = response.data.rate;
                    editedRow.cells[6].innerText = totalAmt.toFixed(2);

                    // Ensure the "Edit" and "Delete" buttons are functional after update
                    editedRow.cells[7].innerHTML = `
                        <button class="edit-row" data-id="${response.data.id}" onclick="editRow(event, this)" style="margin-right:8px;">Edit</button>
                        <button class="delete-row" data-id="${response.data.id}" onclick="deleteRow(event, this)">Delete</button>
                    `;
                        } else {
                            // Add new row if inserting
                            var tableBody = document.querySelector("#customerTableIs tbody");
                            var totalAmt = response.data.quantity * response.data.rate;
                            var newRow = `
                                <tr data-id="${response.data.id}">
                                    <td style="display:none;">${response.data.prodCat}</td>
                                    <td>${response.data.quantity}</td>
                                    <td>${response.data.description}</td>
                                    <td>${response.data.cDate}</td>
                                    <td>${response.data.unit}</td>
                                    <td>${response.data.rate}</td>
                                    <td>${totalAmt.toFixed(2)}</td>
                                    <td style="display:flex;">
                                        <button class="edit-row" data-id="${response.data.id}" onclick="editRow(event, this)" style="margin-right:8px;">Edit</button>
                                        <button class="delete-row" data-id="${response.data.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                            tableBody.innerHTML += newRow;
                        }
                    } else {
                        alert("Error inserting/updating data.");
                    }
                } catch (e) {
                    console.error("Error parsing JSON response:", e);
                }
            }
        };

        var formData = `quantity=${encodeURIComponent(quantity)}&prodCat=${encodeURIComponent(prodCat)}&description=${encodeURIComponent(description)}&cDate=${encodeURIComponent(transDate)}&unit=${encodeURIComponent(unit)}&newRate=${encodeURIComponent(newRate)}&editId=${encodeURIComponent(editId)}`;
        xhr.send(formData);
    });
});

                   </script>
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
                    <table class="table align-middle table-nowrap" id="customerTable">
                      <thead class="table-light">
                        <tr>
                          <th>S. No.</th>
                          <th>Description</th>
                          <th>F. Qty</th>
                          <th>Prod. Qty</th>
                          <th>Rate</th>
                          <th>Amount</th>
                          <th>Stock</th>
                        </tr>
                      </thead>
                      <tbody class="list form-check-all">
                        
                      </tbody>
                    </table>
                  </div>
                  <!--========================== Show Data ==========================-->
                  <div class="table-responsive">
    <table class="table align-middle table-nowrap" id="customerTableIs">
        <thead class="table-light">
            <tr>
                <th>Prod. Qty</th>
                <th>Description</th>
                <th>Date</th>
                <th>Unit</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="list form-check-all">
            <!-- New rows will be appended here -->
        </tbody>
    </table>
</div>

<script>
    function editRow(event, button) {
    event.preventDefault();
    
    const row = button.closest('tr');
    
    // Retrieve the current values from the row
    const prodCat = row.cells[0].innerText;
    const quantityInput = row.cells[1].innerText;
    const prodDesc = row.cells[2].innerText;
    
    // Populate the form with the current row data
    document.getElementById('quantityInput').value = quantityInput; 
    document.getElementById('productCat').value = prodCat;
    document.getElementById('prodDesc').value = prodDesc;
    
    // Store the ID of the row being edited in the hidden input
    document.getElementById("editId").value = row.dataset.id; 
}

</script>



                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
       </div>
     </div>
   </div>
  </div>

<!-- End Page-content -->
<!-- footer start -->
<?php include_once ('include/footer.php');?>