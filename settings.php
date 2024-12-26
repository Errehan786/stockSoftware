<?php
include_once('config.php'); 
include_once('include/auth.php');
$sql12="SELECT id FROM login";
$result = $conn->query($sql12);
$row = $result->fetch(PDO::FETCH_ASSOC);
$password_id = $row['id'];
if(isset($_REQUEST['changePassword'])){
    if ($_REQUEST['newPassword'] !== $_REQUEST['confirmPassword']) {
        $msg = '<div class="mx-3 mt-3">
        <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Please Enter Valid New Password and Confirm Password</h6>
        </div>';
        ?>
        <script>
        // setTimeout(
        // function(){
        //     window.location = "settings.php"; 
        // },
        // 3000);
        </script>
        <?php
        // echo '<script>location.href="settings.php"</script>';  
     }else{
        $oldpass=md5($_REQUEST['oldPassword']);
        $newPassword=md5($_REQUEST['newPassword']);
        $confirmPassword=$_REQUEST['confirmPassword'];
       $sql = "UPDATE login SET password='$newPassword' WHERE id='$password_id'";
       if($conn->exec($sql)){
           echo '<script>alert ("Password has been Save Successfull")</script>';
           echo '<script>location.href="settings.php"</script>';
        // $msg1 = '<div class="mx-3 mt-3">
        // <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>Password has been Save Successfull</h6>
        // </div>';
    //     ?>
         <script>
    //     setTimeout(
    //     function(){
    //         window.location = "settings.php"; 
    //     },
    //     3000);
    //     </script>
         <?php
    //    }else{
    //     $msg = '<div class="mx-3 mt-3">
    //     <h6 class="alert alert-success"><i class="fa fa-solid fa-spinner fa-spin me-2"></i>password has not be Change</h6>
    //     </div>';
    //     ?>
        <script>
    //     setTimeout(
    //     function(){
    //         window.location = "settings.php"; 
    //     },
    //     3000);
    //     </script>
         <?php
       }echo '<script>alert ("Password has has Not Changed")</script>';
       echo '<script>location.href="settings.php"</script>';
     }
}

//get profile data
if($_SESSION['userName']=="Admin")$tbl = "login";else $tbl = "company";
$getProfile = $conn->query("select * from $tbl where reg_id='$_SESSION[id]'");
$profileDta = $getProfile->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>

    <meta charset="utf-8" />
    <title>Profile Settings | <?php echo $_SESSION['userName']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
        <?php include_once ('include/header.php');?>
        <!-- ========== Header End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        <?php include_once ('include/left-side-menu.php');?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="position-relative mx-n4 mt-n4">
                        <div
                            class="profile-wid-bg profile-setting-img d-flex align-items-center justify-content-center">
                            <h2 class="text-white" style="position: absolute;">Update Profile Details</h2>
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content ">
                                <div class="text-end p-3">
                                    <div class="p-0 ms-auto rounded-circle profile-photo-edit ">
                                        <!-- <input id="profile-foreground-img-file-input" type="file"
                                            class="profile-foreground-img-file-input">
                                        <label for="profile-foreground-img-file-input"
                                            class="profile-photo-edit btn btn-light">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card mt-n5">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/users/avatar-1.jpg"
                                                class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file"
                                                    class="profile-img-file-input">
                                                <label for="profile-img-file-input"
                                                    class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1"><?php echo $_SESSION['userName']?></h5>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#personalDetails"role="tab">
                                                <i class="fa fa-user"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="fa fa-key"></i> Change Password
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="personalDetails" role="tabpanel">
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="firstnameInput"
                                                                placeholder="Enter your name/company name" name="name" value="<?php echo $profileDta['name']?>" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">Phone
                                                                Number</label>
                                                            <input type="text" class="form-control"
                                                                id="phonenumberInput"
                                                                placeholder="Enter your phone number" name="mobile_no"
                                                                value="<?php echo $profileDta['mobile_no']?>" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email
                                                                Address</label>
                                                            <input type="email" class="form-control" id="emailInput"
                                                                placeholder="Enter your email" name="email"
                                                                value="<?php echo $profileDta['email']?>" required>
                                                        </div>
                                                    </div>
                                                   <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="countryInput" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="countryInput" name="address"
                                                                placeholder="address" value="<?php echo $profileDta['address']?>" required/>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="cityInput" class="form-label">City</label>
                                                            <input type="text" class="form-control" id="cityInput" name="city"
                                                                placeholder="City" value="<?php echo $profileDta['city']?>"  required/>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="zipcodeInput" class="form-label">Zip
                                                                Code</label>
                                                            <input type="text" class="form-control" id="zipcodeInput" value="zipcode"
                                                                placeholder="Enter zipcode"  value="<?php echo $profileDta['zipcode']?>" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="cityInput" class="form-label">State</label>
                                                            <input type="text" class="form-control" id="cityInput" name="state"
                                                                placeholder="State" value="<?php echo $profileDta['state']?>"  required/>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="countryInput" class="form-label">Country</label>
                                                            <input type="text" class="form-control" id="countryInput" name="country"
                                                                placeholder="Country" value="<?php echo $profileDta['country']?>" required/>
                                                        </div>
                                                    </div>
                                                    
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="exampleFormControlTextarea"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control"
                                                                id="exampleFormControlTextarea"
                                                                placeholder="Enter your description" rows="3"><?php echo $profileDta['remark']?></textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary">Updates</button>
                                                            <button type="button"
                                                                class="btn btn-soft-success">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <?php
                                        if(isset($msg)){
                                            echo $msg;
                                        }
                                        ?>
                                        <div class="tab-pane active" id="changePassword" role="tabpanel">
                                            <form action="" method="POST">
                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                            <input type="password" class="form-control" id="oldpasswordInput" name="oldPassword" placeholder="Enter current password" Required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" id="newpasswordInput" name="newPassword" placeholder="Enter new password" Required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                            <input type="password" class="form-control" id="confirmpasswordInput" name="confirmPassword" placeholder="Confirm password" Required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <!-- <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <a href="javascript:void(0);"
                                                                class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                        </div>
                                                    </div> -->
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" name="changePassword" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                            <!-- <div class="mt-4 mb-3 border-bottom pb-2">
                                                <div class="float-end">
                                                    <a href="javascript:void(0);" class="link-primary">All Logout</a>
                                                </div>
                                                <h5 class="card-title">Login History</h5>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-smartphone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6>iPhone 12 Pro</h6>
                                                    <p class="text-muted mb-0">Los Angeles, United States - March 16 at
                                                        2:47PM</p>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);">Logout</a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-tablet-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6>Apple iPad Pro</h6>
                                                    <p class="text-muted mb-0">Washington, United States - November 06
                                                        at 10:43AM</p>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);">Logout</a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-smartphone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6>Galaxy S21 Ultra 5G</h6>
                                                    <p class="text-muted mb-0">Conneticut, United States - June 12 at
                                                        3:24PM</p>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);">Logout</a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-macbook-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6>Dell Inspiron 14</h6>
                                                    <p class="text-muted mb-0">Phoenix, United States - July 26 at
                                                        8:10AM</p>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);">Logout</a>
                                                </div>
                                            </div> -->
                                        </div>
                                        <!--end tab-pane-->
                                        <!--end tab-pane-->
                                        <!-- <div class="tab-pane" id="privacy" role="tabpanel">
                                            <div class="mb-4 pb-2">
                                                <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                                <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                                    <div class="flex-grow-1">
                                                        <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                                        <p class="text-muted">Two-factor authentication is an enhanced
                                                            security meansur. Once enabled, you'll be required to give
                                                            two types of identification when you log into Google
                                                            Authentication and SMS are Supported.</p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-sm-3">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-sm btn-primary">Enable Two-facor
                                                            Authentication</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                                    <div class="flex-grow-1">
                                                        <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                                        <p class="text-muted">The first factor is a password and the
                                                            second commonly includes a text with a code sent to your
                                                            smartphone, or biometrics using your fingerprint, face, or
                                                            retina.</p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-sm-3">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set
                                                            up secondary method</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                                    <div class="flex-grow-1">
                                                        <h6 class="fs-14 mb-1">Backup Codes</h6>
                                                        <p class="text-muted mb-sm-0">A backup code is automatically
                                                            generated for you when you turn on two-factor authentication
                                                            through your iOS or Android Twitter app. You can also
                                                            generate a backup code on twitter.com.</p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-sm-3">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-sm btn-primary">Generate backup codes</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="card-title text-decoration-underline mb-3">Application
                                                    Notifications:</h5>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <label for="directMessage"
                                                                class="form-check-label fs-14">Direct messages</label>
                                                            <p class="text-muted">Messages from people you follow</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="directMessage" checked />
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="desktopNotification">
                                                                Show desktop notifications
                                                            </label>
                                                            <p class="text-muted">Choose the option you want as your
                                                                default setting. Block a site: Next to "Not allowed to
                                                                send notifications," click Add.</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="desktopNotification" checked />
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="emailNotification">
                                                                Show email notifications
                                                            </label>
                                                            <p class="text-muted"> Under Settings, choose Notifications.
                                                                Under Select an account, choose the account to enable
                                                                notifications for. </p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="emailNotification" />
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="chatNotification">
                                                                Show chat notifications
                                                            </label>
                                                            <p class="text-muted">To prevent duplicate mobile
                                                                notifications from the Gmail and Chat apps, in settings,
                                                                turn off Chat notifications.</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="chatNotification" />
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="purchaesNotification">
                                                                Show purchase notifications
                                                            </label>
                                                            <p class="text-muted">Get real-time purchase alerts to
                                                                protect yourself from fraudulent charges.</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="purchaesNotification" />
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h5 class="card-title text-decoration-underline mb-3">Delete This
                                                    Account:</h5>
                                                <p class="text-muted">Go to the Data & Privacy section of your profile
                                                    Account. Scroll to "Your data & privacy options." Delete your
                                                    Profile Account. Follow the instructions to delete your account :
                                                </p>
                                                <div>
                                                    <input type="password" class="form-control" id="passwordInput"
                                                        placeholder="Enter your password" value="make@321654987"
                                                        style="max-width: 265px;">
                                                </div>
                                                <div class="hstack gap-2 mt-3">
                                                    <a href="javascript:void(0);" class="btn btn-soft-danger">Close &
                                                        Delete This Account</a>
                                                    <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->

           <!-- footer start -->
        <?php include_once ('include/footer.php');?>
        </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction();" class="btn btn-danger btn-icon" id="back-to-top">
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

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/pages-profile-settings.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Mar 2022 13:01:09 GMT -->

</html>