<?php
include_once('config.php');
include_once('include/auth.php');
/// get description
$descriptionSql = "SELECT * FROM `rawMeterial` where groupName='PVC'";
$descResult = $conn->query($descriptionSql);

// Fetch all data into an array
$rows = $descResult->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Begin page -->
<div id="layout-wrapper">
  <!-- ========== Header Start ========== -->
  <?php include_once('include/header.php'); ?>
  <!-- ========== Header End ========== -->
  <!-- ========== Left Sidebar Start ========== -->
  <?php include_once('include/left-side-menu.php'); ?>
  <!-- Vertical Overlay-->
  <div class="vertical-overlay"></div>
  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <!-- Modal body -->
        <div>
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
                          <td>
                            <div class="form-group">
                              <input type="text" id="coilWt" class="form-control" placeholder="Coil Wt." style="width: 100px;" required />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input type="text" class="form-control" id="length" placeholder="Length" style="width: 100px;" onInput="calculateMetalWt()" required />
                            </div>
                          </td>

                          <td>
                            <div class="form-group">
                              <input type="text" id="metalWt" class="form-control" placeholder="Metal Wt." style="width: 100px;" readonly />
                            </div>
                          </td>
                          <td>
                            <div class="form-group" id="">
                              <input type="text" class="form-control" name="drawing" id="drawing" placeholder="Drawing" style="width: 100px;" required />
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <input type="text" class="form-control" name="r_rate" id="rRateField" placeholder="R/Rate" style="width: 100px;" required>
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
      formattedMetalWt = `${roundedString[0]}.${roundedString.slice(1, 4)}`;  // e.g., 1234 -> 1.234
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" data-choices data-choices-sorting="true" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" data-choices data-choices-sorting="true" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" data-choices data-choices-sorting="true" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" data-choices data-choices-sorting="true" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <select id="iteamList0" class="form-select grade-select" name="" style="width:160px;" data-choices data-choices-sorting="true" required>
                                  <option value="">Select Grade</option>
                                  <?php foreach ($rows as $row1) { ?>
                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1['description']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control avg-rate" name="" id="" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control percentage-field" onkeyup="getCalculation(this.value)" placeholder="Percentage" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control weight-field" placeholder="Weight" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control amount-field" placeholder="Amount" required />
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
                                <input type="text" class="form-control totalPercentageIs" name="totalPercentageIs" id="totalPercentageIs" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control totalWeightIs" name="totalWeightIs" id="totalWeightIs" placeholder="" required />
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group">
                                <input type="text" class="form-control totalAmountIs" name="totalAmountIs" id="totalAmountIs" placeholder="" required />
                              </div>
                            </td>
                          </tr>

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
                              <input type="text" class="form-control inline-block w-50 me-1" id="pvcWt" placeholder="PVC Wt." required />
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
                                <input type="text" class="form-control" name="finalTotalAmount" id="finalTotalAmount" placeholder="" required />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom-0">
                              <div class="form-group d-flex" id="">
                                <p class="mb-0 align-content-center me-1">Labour</p>
                                <input type="text" class="form-control w-25 labour-percentage" id="labourPercentage" placeholder="Labour %" />
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
                                <p class="mb-0 align-content-center me-1">Labour</p> <input type="text" class="form-control w-25" />
                                <p class=" ms-1 mb-0 align-content-center">/Wt</p>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control" name="" id="" placeholder="" required />
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
                                <input type="text" class="form-control" id="packagingCharges" placeholder="" required />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom-0">
                              <div class="form-group d-flex" id="">
                                <p class="mb-0 align-content-center me-1">Rate</p>
                                <input class="form-control" type="text" id="finalProductRate" name="finalProductRate" style="width: 50px;">
                                <p class="ms-1 mb-0 align-content-center">/Wt</p>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="form-group" id="">
                                <input type="text" class="form-control" name="completeFinalAmount" id="completeFinalAmount" placeholder="" required />
                              </div>
                              <div class="form-group" id="">
                                <input type="text" class="form-control" name="completeFinalAmount_is" id="completeFinalAmount_is" placeholder="" required />
                              </div>
                            </td>
                          </tr>
                          
                          <script>
                            document.addEventListener('DOMContentLoaded', function() {
                              function calculateLabourAmount() {
                                // Function to calculate total labour amount
                                function updateLabourAmount() {
                                  // Get the final total amount
                                  var finalTotalAmount = parseFloat(document.getElementById('finalTotalAmount').value) || 0;

                                  // Get the labour percentage
                                  var labourPercentage = parseFloat(document.getElementById('labourPercentage').value) || 0;

                                  // Calculate the total labour amount
                                  var totalLabourAmount = (labourPercentage / 100) * finalTotalAmount;

                                  // Update the total labour amount field
                                  var totalLabourAmountField = document.getElementById('totalLaborAmount');
                                  if (totalLabourAmountField) {
                                    totalLabourAmountField.value = totalLabourAmount.toFixed(2); // Display two decimal points
                                  }
                                }

                                // Add event listener for labour percentage input change
                                var labourPercentageField = document.getElementById('labourPercentage');
                                if (labourPercentageField) {
                                  labourPercentageField.addEventListener('input', updateLabourAmount);
                                }
                              }

                              function calculateTotals() {
                                let totalPercentage = 0;
                                let totalWeight = 0;
                                let totalAmount = 0;

                                // Sum up all the percentage fields
                                document.querySelectorAll('input[name="percentage"]').forEach(function(input) {
                                  totalPercentage += parseFloat(input.value) || 0;
                                });

                                // Sum up all the weight fields
                                document.querySelectorAll('input[name="weight"]').forEach(function(input) {
                                  totalWeight += parseFloat(input.value) || 0;
                                });

                                // Sum up all the amount fields
                                document.querySelectorAll('input[name="amount"]').forEach(function(input) {
                                  totalAmount += parseFloat(input.value) || 0;
                                });

                                // Display totals in the corresponding fields
                                document.getElementById('totalPercentageIs').value = totalPercentage.toFixed(2);
                                document.getElementById('totalWeightIs').value = totalWeight.toFixed(2);
                                document.getElementById('totalAmountIs').value = totalAmount.toFixed(2);
                              }

                              // Event listeners for percentage, weight, and amount fields
                              document.querySelectorAll('input[name="percentage"], input[name="weight"], input[name="amount"]').forEach(function(input) {
                                input.addEventListener('input', calculateTotals);
                              });

                              // Call the functions to set up event listeners and initialize calculations
                              calculateLabourAmount();
                              calculateTotals();
                            });


                            document.addEventListener('DOMContentLoaded', function() {
                              function updateCalculations() {
                                function updateLabourAmount() {
                                  var finalTotalAmount = parseFloat(document.getElementById('finalTotalAmount').value) || 0;
                                  var labourPercentage = parseFloat(document.getElementById('labourPercentage').value) || 0;
                                  var totalLabourAmount = (labourPercentage / 100) * finalTotalAmount;

                                  var totalLabourAmountField = document.getElementById('totalLaborAmount');
                                  if (totalLabourAmountField) {
                                    totalLabourAmountField.value = totalLabourAmount.toFixed(2);
                                  }

                                  return totalLabourAmount;
                                }

                                function updateCompleteFinalAmount() {
                                  var finalTotalAmount = parseFloat(document.getElementById('finalTotalAmount').value) || 0;
                                  var packagingCharges = parseFloat(document.getElementById('packagingCharges').value) || 0;
                                  var totalLabourAmount = updateLabourAmount();

                                  var completeFinalAmount = finalTotalAmount + packagingCharges + totalLabourAmount;

                                  var completeFinalAmountField = document.getElementById('completeFinalAmount');
                                  if (completeFinalAmountField) {
                                    completeFinalAmountField.value = completeFinalAmount.toFixed(2);
                                  }

                                  return completeFinalAmount;
                                }

                                function updateRateDivisionResult() {
                                  var completeFinalAmount = updateCompleteFinalAmount();
                                  var finalProductRate = parseFloat(document.getElementById('finalProductRate').value) || 0;
                                  var rateDivisionResult = finalProductRate ? (completeFinalAmount / finalProductRate).toFixed(2) : 0;

                                  // Update the `completeFinalAmount_is` field
                                  var completeFinalAmountIsField = document.getElementById('completeFinalAmount_is');
                                  if (completeFinalAmountIsField) {
                                    completeFinalAmountIsField.value = rateDivisionResult;
                                  }
                                }

                                // Add event listeners to relevant fields
                                var labourPercentageField = document.getElementById('labourPercentage');
                                var packagingChargesField = document.getElementById('packagingCharges');
                                var finalTotalAmountField = document.getElementById('finalTotalAmount');
                                var finalProductRateField = document.getElementById('finalProductRate');

                                if (labourPercentageField) labourPercentageField.addEventListener('input', updateRateDivisionResult);
                                if (packagingChargesField) packagingChargesField.addEventListener('input', updateRateDivisionResult);
                                if (finalTotalAmountField) finalTotalAmountField.addEventListener('input', updateRateDivisionResult);
                                if (finalProductRateField) finalProductRateField.addEventListener('input', updateRateDivisionResult);
                              }

                              // Call the function to set up event listeners
                              updateCalculations();
                            });
                          </script>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-info">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

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
          var row = percentageField.closest('tr');  // Get the current row
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