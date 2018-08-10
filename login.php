<?php
include "config/connect.php";
if($_POST[method]=="1"){
	$sql = "SELECT * FROM fs_customer WHERE Customer_Username = '$_POST[username]' AND Customer_Password = '$_POST[password]' AND Customer_Status = '1'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION[user_username] = $row[Customer_Username];
			//$_SESSION[cusNAME] = $row[Customer_Username];
			$_SESSION[fulluser_id] = "C".$row[Customer_Id];
			$_SESSION[user_id] = $row[Customer_Id];
			//$_SESSION[cusID] = $row[Customer_Id];
			$_SESSION[user_type] = "customer";

			if($row[Customer_Type]=="1"){
			echo "<script>alert('เข้าสู่ระบบเรียบร้อยแล้ว ขอบคุณค่ะ'); window.location.href='products.php?page=1'</script>";
			}elseif($row[Customer_Type]=="2"){
			echo "<script>alert('เข้าสู่ระบบเรียบร้อยแล้ว ขอบคุณค่ะ'); window.location.href='backoffice/list_template.php?page=1'</script>";
			}
		}else{
			echo "<script>alert('ชื่อผู้ใช้งานหรือรหัสผ่านผิดพลาด กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
		}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/owl-slider.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/settings.css"/>
        <link rel="shortcut icon" href="assets/images/favicon.ico" />
        <script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>

        <title>ศรีไทยโก :: SrithaiGo</title>
    </head>
    <body>

    <!-- End pushmenu -->
    <div class="wrappage">
        <!-- <div id="rtl">RTL</div> -->
        <?php
			include "header.php";
		?>
		
        <div class="container container-ver2 box-cat-home3">
			<br>
            <div class="row">
				<div class="col-md-6">
					<img class="img-responsive" src="https://cdnexpatwomanfood.expatwoman.com/s3fs-public/healthy.jpg" alt="banner-home3">
					<br>
				</div>
				<div class="col-md-6">
					<h2 class="text-center">สมาชิกเข้าสู่ระบบ</h2>
					<hr>
					<form action="login.php" method="post">
					<input type="hidden" name="method" value="1">
						<div class="form-group">
							<label>ชื่อผู้ใช้งาน *</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="form-group">
							<label>รหัสผ่าน *</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<center><button type="submit" class="btn btn-success">เข้าสู่ระบบ</button></center>
					</form>
					<hr>
					<center><a href="register.php">สมัครสมาชิก</a> | ลืมรหัสผ่าน</center>
					<br>
				</div>
			</div>
        </div>
        
        <div id="back-to-top">
            <i class="fa fa-long-arrow-up"></i>
        </div>
        <?php
			include "footer.php";
		?>
        </div>
    <!-- End wrappage -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="assets/js/engo-plugins.js"></script>
    <script type="text/javascript" src="assets/js/store.js"></script>
    </body>
</html>
