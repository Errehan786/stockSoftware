<?php 
if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
include("config.php");
$username = $_POST['username'];
$password = md5($_POST['password']); 
$query = $conn->query("Select * from `login` where name = '$username' and password ='$password'");
$count = $query->rowCount();

		if($count > 0){
		 $row = $query->fetch(PDO::FETCH_ASSOC);   
		 $_SESSION['id']=$row['id'];
         $_SESSION['userName']="Admin";
		 echo 'true';
		
		 }else{ 
		 $password = sha1($_POST['password']);     
		 //sel company tbl data
		 $query_Q = $conn->query("Select reg_id,name,password from `company` where password ='$password' and (email='$username' || mobile_no='$username')") or die(mysqli_error());
		 if($query_Q->rowCount()>0){
		  $row = $query_Q->fetch(PDO::FETCH_ASSOC);
		  $_SESSION['id']=$row['reg_id'];
          $_SESSION['userName']=$row['name'];
          echo 'true';
		 }else echo 'false';
		}	
}
?>