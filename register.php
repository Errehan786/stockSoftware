<?php 
if(isset($_POST['mobile']) && !empty($_POST['mobile']) && isset($_POST['password']) && !empty($_POST['password'])){
include("config.php");
$reg_id = $currentTime;
$name = addslashes($_POST['name']);
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = addslashes($_POST['address']);
$pass = addslashes($_REQUEST['password']);
$password = addslashes(sha1($_REQUEST['password']));

$sql_reg_Q = "INSERT INTO `company`(`reg_id`, `name`, `email`, `mobile_no`, `address`, `remark`,`password`,`pass`) VALUES ('$reg_id','$name','$email','$mobile','$address','','$password','$pass')";
   
    if($conn->exec($sql_reg_Q)){
		 $_SESSION['id']=$reg_id;
         $_SESSION['userName']=$name;
		 echo 'true';
		
		 }else echo 'false';
 
}
?>