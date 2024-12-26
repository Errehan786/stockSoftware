<?php
// Database connection
include("config.php");

if (isset($_POST['gradeId'])) {
  $gradeId = $_POST['gradeId'];
  // Fetch the rate from the database based on the grade ID
  $query = "SELECT rate FROM rawMeterial WHERE description='$gradeId'";
  $stmt = $conn->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Return the rate as a response
  $rate = $row['rate'];
  echo $rate;
  
  $stmt->close();
}
?>
