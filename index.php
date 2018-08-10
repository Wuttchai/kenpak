<?php
include 'config/connect.php';

if($_POST[method]=="1"){
	if($_POST[usertype]=="employer"){
	$sql = "SELECT * FROM fs_employer WHERE Employer_Username = '$_POST[username]' AND Employer_Password = '$_POST[password]' AND Employer_Status = '1'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION[user_username] = $row[Employer_Username];
			$_SESSION[user_id] = "E".$row[Employer_id];
			$_SESSION[user_type] = "employer";

			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST[username],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST[password],time()+ (10 * 365 * 24 * 60 * 60));
			}
			else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}

			header("location: /backoffice/home.php");
		}else{
			header("location: /backoffice/index.php?msg=2&cty=1");
		}
	}
	if($_POST[usertype]=="customer"){
	$sql = "SELECT * FROM fs_customer WHERE Customer_Username = '$_POST[username]' AND Customer_Password = '$_POST[password]' AND Customer_Status = '1'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION[user_username] = $row[Customer_Username];
			$_SESSION[fulluser_id] = "C".$row[Customer_Id];
			$_SESSION[user_id] = $row[Customer_Id];
			$_SESSION[user_type] = "customer";

			header("location: list_template.php?page=1");
		}else{
			header("location: index.php?msg=2&cty=2");
		}
	}
	if($_POST[usertype]=="supplier"){
	$sql = "SELECT * FROM fs_supplier WHERE Supplier_Username = '$_POST[username]' AND Supplier_Password = '$_POST[password]' AND Supplier_Status = '1'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION[user_username] = $row[Supplier_Username];
			$_SESSION[user_id] = "S".$row[Supplier_Id];
			$_SESSION[user_type] = "supplier";

			header("location: list_updateprice.php?page=1");
		}else{
			header("location: index.php?msg=2&cty=3");
		}
	}
}
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Srithaigo | User Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="backoffice/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="backoffice/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="backoffice/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="backoffice/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="backoffice/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="backoffice/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="backoffice/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="backoffice/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="backoffice/assets/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                <img src="/assets/images/logo.png" style="height: 100px;" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="index.php" method="post">
			<input type="hidden" name="method" value="1">
                <div class="form-title">
                    <span class="form-title">เข้าสู่ระบบ.</span>

                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username, password and Type. </span>
                </div>
				<?php
					if($_GET[msg]=="1"){
				?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<strong>บันทึกข้อมูลเรียบร้อย</strong> เข้าสู่ระบบ.
				</div>
				<?php
					}
					if($_GET[msg]=="2"){
				?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<strong>Username or Password</strong> ผิดพลาด.
				</div>
				<?php
					}
				?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" required> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required> </div>
				<div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Type</label>
										<input type="hidden" id="usertype" name="usertype" value="employer">
				
				</div>
				<div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Login</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
							<input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />Remember
                            <span></span>
                        </label>
                    </div>
                    <!--<div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                    </div>-->
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="index.php"  method="post">
                <div class="form-title">
                    <span class="form-title">Forget Password ?</span>
                    <span class="form-subtitle">Enter your e-mail to reset it.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright hide"> 2017 © DigitechStartup 4.0. Admin Dashboard Template. </div>
        <!-- END LOGIN -->

        <!-- BEGIN CORE PLUGINS -->
        <script src="backoffice/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="backoffice/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="backoffice/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="backoffice/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="backoffice/assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->

    </body>

</html>
