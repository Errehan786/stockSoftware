<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/favicon.png">
<title>Admin </title>
<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-reset.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/mithlesh_animation.css"/>
<!--external css-->
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="assets/css/newstyle.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/style-animate.css" rel="stylesheet" />
 <!-- Font-Awesome-Icons-CSS -->
 <link href="http://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,500,500i,700,700i,900" rel="stylesheet">

<style>
		.cc{
		width:22%; margin:2% auto;
		}
@media (min-width:300px) and (max-width:600px) {
.cc{
		width:100%; margin:5% auto;
		}
}
</style>
<link href="jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
<script src="jquery-1.9.1.min.js"></script>
</head>
<body class="lock-screen" onLoad="startTime()">
<!--<div class="cc"> <center> <img src="img/lelo.png" width="100%;"></center> </div>-->
<div class="lock-wrapper">
  <div id="time"></div>
  <div class="lock-box text-center"> <img src="assets/images/login_image.png" alt="lock avatar" class="animated infinite bounce"/>
    <h1>Admin</h1>
    <span class="locked">Locked</span>
    <form  class="form-inline"  id="login_form" method="post">
      <div class="form-group col-lg-12">
        <input type="text" class="form-control" name="username" id="username" placeholder="User Name" autofocus onFocus="document.getElementById('error').style.display='none'" style="margin-bottom:10px; background:white;" autocomplete="off">
        <input type="password" placeholder="Password" name="password" id="password" class="form-control lock-input" autocomplete="off" style="background:white;">
        <button type="submit" name="login" class="btn btn-lock"> <i class="icon-arrow-right">></i> </button>
      </div>
    </form>
  </div>
</div>
<script>
			jQuery(document).ready(function(){
			jQuery("#login_form").submit(function(e){
					e.preventDefault();
					var formData = jQuery(this).serialize();
					$.ajax({
						type: "POST",
						url: "login.php",
						data: formData,
						success: function(html){
						//alert(html);
						if(html=='true')
						{
						$.jGrowl("Welcome!", { header: 'Log In Successfully' });
						var delay = 2000;
							setTimeout(function(){ window.location = 'dashboard.php'  }, delay);  
						}
						else
						{
						$.jGrowl("Please Check your Username and Password", { header: 'Login Failed' });
						}
						}
						
					});
					return false;
				});
			});
			</script>
<!-- jgrowl -->
<script src="jGrowl/jquery.jgrowl.js"></script>
<script>
				$(function() {
					$('.tooltip').tooltip();	
					$('.tooltip-left').tooltip({ placement: 'left' });	
					$('.tooltip-right').tooltip({ placement: 'right' });	
					$('.tooltip-top').tooltip({ placement: 'top' });	
					$('.tooltip-bottom').tooltip({ placement: 'bottom' });
					$('.popover-left').popover({placement: 'left', trigger: 'hover'});
					$('.popover-right').popover({placement: 'right', trigger: 'hover'});
					$('.popover-top').popover({placement: 'top', trigger: 'hover'});
					$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
					$('.notification').click(function() {
						var $id = $(this).attr('id');
						switch($id) {
							case 'notification-sticky':
								$.jGrowl("Stick this!", { sticky: true });
							break;
							case 'notification-header':
								$.jGrowl("A message with a header", { header: 'Important' });
							break;
							default:
								$.jGrowl("Hello world!");
							break;
						}
					});
				});
				</script>
<script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
</body>
</html>
