<?php
include "config/connect.php";
if($_POST[method]=="1"){
	//echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code หรือ Username นี้มีอยู่แล้ว\")); </script>";
	$sql_chk = "SELECT * FROM fs_customer WHERE Customer_Username = '$_POST[Customer_Username]' OR Customer_Email = '$_POST[Customer_Email]' ";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_customer (Customer_Code, Customer_Name, Customer_Email, Customer_Username, Customer_Password, Customer_ShopType, 
				Customer_Type, Payments_Type1,Payments_Type2,Payments_Type3,Payments_Type4, Customer_Tel, Customer_CreditTime, Customer_InvoiceType, 
				Delivery_Cost_Id, Customer_Status,Customer_CreateDate) 
				VALUES ('', '$_POST[Customer_Name]', '$_POST[Customer_Email]', '$_POST[Customer_Username]', '$_POST[Customer_Password]', 
				'$_POST[Customer_ShopType]', '1', '0', '1', '0', '0', '$_POST[Customer_Tel]', 
				'0', '$_POST[Customer_InvoiceType]', '4', '1',NOW())";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: login.php');
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Email หรือ Username นี้มีอยู่แล้ว\")); </script>";
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
					<h2 class="text-center">สมัครสมาชิก</h2>
					<hr>
					<form action="register.php" method="post">
					<input type="hidden" name="method" value="1">
						<div class="form-group">
							<label>ชื่อลูกค้า *</label>
							<input type="text" class="form-control" id="Customer_Name" name="Customer_Name" required>
						</div>
						<div class="form-group">
							<label>อีเมล์ *</label>
							<input type="email" class="form-control" id="Customer_Email" name="Customer_Email" required>
						</div>
						<div class="form-group">
							<label>ชื่อผู้ใช้งาน *</label>
							<input type="text" class="form-control" id="Customer_Username" name="Customer_Username" required>
						</div>
						<div class="form-group">
							<label>รหัสผ่าน *</label>
							<input type="password" class="form-control" id="Customer_Password" name="Customer_Password" required>
						</div>
						<div class="form-group">
							<label>ยืนยันรหัสผ่าน *</label>
							<input type="password" class="form-control" id="Customer_Password2" name="Customer_Password2" required>
						</div>
						<div class="form-group">
							<label>เบอร์ติดต่อ *</label>
							<input type="text" class="form-control" id="Customer_Tel" name="Customer_Tel">
						</div>
						<div class="form-group">
							<label>ประเภทที่อยู่สำหรับจัดส่ง</label>
							<select class="form-control" name="Customer_ShopType" id="Customer_ShopType" required>
								<option value="">- เลือกประเภทที่อยู่สำหรับจัดส่ง -</option>
								<option value="ร้านอาหาร Food Chain">ร้านอาหาร Food Chain</option>
								<option value="ร้านอาหารในห้างสรรพสินค้า">ร้านอาหารในห้างสรรพสินค้า</option>
								<option value="โรงแรม">โรงแรม</option>
								<option value="ภัตตาคาร">ภัตตาคาร</option>
								<option value="Food Court">Food Court</option>
								<option value="ร้านอาหารตามสั่ง">ร้านอาหารตามสั่ง</option>
								<option value="โรงอาหาร">โรงอาหาร</option>
								<option value="โรงพยาบาล">โรงพยาบาล</option>
								<option value="บ้านพักอาศัย">บ้านพักอาศัย</option>
								<option value="อื่นๆ">อื่นๆ</option>
							</select>
						</div>
						<div class="form-group">
							<label>ประเภทลูกค้า</label>
							<select class="form-control" name="Customer_InvoiceType" id="Customer_InvoiceType" required>
								<option value="">- เลือกประเภทลูกค้า -</option>
								<option value="Corporate">ธุรกิจร้านค้า</option>
								<option value="Person">บุคคล</option>
							</select>
						</div>
						<center><button type="submit" class="btn btn-success">ลงทะเบียน</button></center>
					</form>
					<br>
				</div>
				<div class="col-md-6">
					<img class="img-responsive" src="https://i.pinimg.com/736x/8e/81/49/8e8149f45cf10efd6dad2c02c8366d9e--vegetable-stand-vegetable-garden.jpg" alt="banner-home3">
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
