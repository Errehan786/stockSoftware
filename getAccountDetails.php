<?php
// Database connection
include("config.php");
  $acName = $_REQUEST['q'];
  // Fetch the rate from the database based on the grade ID
  $query = "SELECT accountGroup FROM account WHERE accountName='$acName'";
  $stmt = $conn->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // Return the rate as a response
  $accountGroup = $row['accountGroup'];

?>
<option value="<?php echo $accountGroup; ?>"><?php echo $accountGroup;?> </option>
