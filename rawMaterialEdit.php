<?php include_once('config.php');
include_once('include/auth.php');
///get rawMaterial
$rawMaterialSql = "SELECT * FROM `rawMeterial` where id='$_REQUEST[editMetrialId]'";
$rawMaterialDetails = $conn->query($rawMaterialSql);
$rawMaterialrow = $rawMaterialDetails->fetch(PDO::FETCH_ASSOC);

//Update Table
if (isset($_REQUEST['item_submit'])) {
  $group_name = $_REQUEST['group_name'];
  $pvcDescription = $_REQUEST['pvcDescription'];
  $stock = $_REQUEST['stock'];
  $rate = $_REQUEST['rate'];
  $units = $_REQUEST['units'];
  $pcs = $_REQUEST['pcs'];
  $sql = "UPDATE rawMeterial SET groupName='$group_name', description='$pvcDescription', openingStock='$stock', rate='$rate', unit='$units', pcs='$pcs' WHERE id='".$_REQUEST['editMetrialId']."'";
if ($conn->query($sql)) {
    echo '<script>alert("Data Updated Success"); location.href="createRawMaterial.php";</script>';
} else {
    echo "<script>alert('Failed');</script>";
}

}

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" class="fa-events-icons-ready" data-layout-style="default" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">

<head>
  <meta charset="utf-8" />
  <title>Raw Material Edit | <?php echo $_SESSION['userName'] ?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">
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
                <h4 class="mb-sm-0">Edit Raw Material </h4>
                <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                      <a href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                      Edit Raw Material
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <div class="row" id="addNewItem">
            <div class="col-xxl-12">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Edit Raw Material</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
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
                          <option value="<?php echo $row['name']; ?>"<?php if($rawMaterialrow['groupName'] == $row['name'])echo "selected"; ?>>
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
                        <input type="text" class="form-control" id="pvcDescription" name="pvcDescription" value="<?php if(isset($rawMaterialrow['description']))echo $rawMaterialrow['description']?>" placeholder="Enter Description" oninput="checkDescription(this.value)" />
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
                      <input type="text" class="form-control" name="stock" value="<?php if(isset($rawMaterialrow['openingStock']))echo $rawMaterialrow['openingStock']?>" placeholder="Opening stock" />
                    </div>
                  </div>
                  
                  <div class="col-lg-4" id="rateData">
                    <div class=" mb-3">
                      <label class="form-label">Rate</label>
                      <input type="text" class="form-control" name="rate" value="<?php if(isset($rawMaterialrow['rate']))echo $rawMaterialrow['rate']?>" placeholder="Enter Rate" />
                    </div>
                  </div>
                  <div class="col-lg-2" style="padding-right: 0;">
                    <div class="mb-4">
                      <label for="compnayNameinput" class="form-label">Units</label>
                      <select class="form-select" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" name="units" />
                      <option value="">Select Units </option>
                      <option value="Kg" <?php if($rawMaterialrow['unit'] == "Kg")echo "selected"; ?>>Kg</option>
                      <option value="Meter" <?php if($rawMaterialrow['unit'] == "Meter")echo "selected"; ?>>Meter</option>
                      <option value="Pcs" <?php if($rawMaterialrow['unit'] == "Pcs")echo "selected"; ?>>Pcs</option>
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
                <!-- Modal footer -->
                <div class="modal-footer">
                  <input type="submit" name="item_submit" class="btn btn-info" value="Updated" style="background-color:#0ab39c;">
                </div>
              </form>
                    <!--end col-->
                  </div>
                  <!--end row-->
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Footer start -->
    <?php include_once('include/footer.php'); ?>
  </div>
  </div>
  <!-- end main content-->
  </div>
  <!-- END layout-wrapper -->
  <!--start back-to-top-->
  <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <!--end back-to-top-->

  <!-- JAVASCRIPT -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>
  <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="assets/js/plugins.js"></script>
  <!-- prismjs plugin -->
  <script src="assets/libs/prismjs/prism.js"></script>
  <script src="assets/libs/list.js/list.min.js"></script>
  <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
  <!-- listjs init -->
  <script src="assets/js/pages/listjs.init.js"></script>
  <!-- App js -->
  <script src="assets/js/app.js"></script>
</body>

</html>