<?php
error_reporting(0);
session_start();
$dsn = "mysql:host=localhost;dbname=cineholi_rayInfoSolution_db;charset=UTF8";
$user="cineholi_ray_use";
$password="almKVHjj1d1V";
try {
	$conn = new PDO($dsn, $user, $password);

	if ($conn) {
		// echo '<script>alert("Connected");</script>';
	}
	
  //if(!isset($_SESSION['id']) && empty($_SESSION['id']))header("location:/");	
} catch (PDOException $e) {
	echo $e->getMessage();
} 
date_default_timezone_set('Asia/Calcutta');
$currentTime=strtotime(date('d-m-Y  H:i:s'));
?>