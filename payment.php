<?php
include "config/connect.php";
include "functions/file_function.php";

if($_POST[method]=="1"){
	$sql = "SELECT * FROM fs_orders WHERE Orders_Id like '$_POST[Orders_Id]'";
	$query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows<1){
		echo "<script>alert('ไม่พบหมายเลข Order ของท่าน กรุณาตรวจสอบอีกครั้ง'); window.history.back();</script>";
	}else{
		$row = mysqli_fetch_array($query);
		if($row[Order_Status]!="4" AND $row[Order_Status]!="6"){
			if($row[Orders_PaymentDoc]!=""){
				$file = $row[Orders_PaymentDoc];
				!unlink("doc_transfer/".$file);
			}
		
			list($img_stutus, $img_name) = upload_file("Orders_PaymentDoc", "doc_transfer/", 500000, "images,document");
			
			if($img_stutus!="" OR $img_stutus!="0"){
				$sql = "UPDATE fs_orders SET
						Orders_PaymentBank = '$_POST[Orders_PaymentBank]',
						Orders_PaymentTransfer = '$_POST[Orders_PaymentTransfer]',
						Orders_PaymentDate = '$_POST[Orders_PaymentDate]',
						Orders_PaymentTime = '$_POST[Orders_PaymentTime]',
						Orders_PaymentDoc = '$img_name',
						Order_Status = '2',
						Orders_PaymentCreate = NOW() 					
						WHERE Orders_Id like '$_POST[Orders_Id]'";
				$query = mysqli_query($conn, $sql);
				if(!$query){
					echo "<script>alert('ไม่สามารถทำการบันทึกข้อมูลลงในระบบได้ กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
				}else{
					echo "<script>alert('ระบบทำการบันทึกข้อมูลเรียบร้อย ขอบคุณค่ะ'); window.location.href='history_order.php?page=1';</script>";
				}
			}else{
				echo "<script>alert('ไฟล์นามสกุลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
			}
		}else{
			echo "<script>alert('รายการสั่งซื้อนี้ไม่สามารถดำเนินการได้ เนื่องจากถูกดำเนินการอยู่ หรือยกเลิก'); window.history.back();</script>";
		}
	}
}

if($_GET[id]!=""){
	$total = 0;
	echo $sql_detail = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '".$_GET[id]."'";
	$query_detail = mysqli_query($conn, $sql_detail);
	while($data_detail = mysqli_fetch_array($query_detail)){
		$total = $total+($data_detail[Ordersde_Amount]*$data_detail[Ordersde_Price]);
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/owl-slider.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/settings.css"/>
        <link rel="shortcut icon" href="assets/images/favicon.png" />
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
				<div class="col-md-12">
					<h2 class="text-center">แจ้งโอนเงิน</h2>
					<p>ชำระเงินผ่านบัญชีธนาคาร<br>
					<font color="red">* กรุณาชำระเงินภายใน 16:00 น. ของแต่ละวัน ไม่เช่นนั้นระบบจะทำการยกเลิกออร์เดอร์ทั้งหมด</font>
					</p>
					<hr>
					<table class="table table-bordered">
						<tr>
							<td class="text-center"><h3>ธนาคาร</h3></td>
							<td class="text-center"><h3>ชื่อบัญชี</h3></td>
							<td class="text-center"><h3>เลขบัญชี</h3></td>
						</tr>
						<!--<tr>
							<td><center><img class="img-responsive" src="img/bank/scb.jpg" alt="banner-home3"></center></td>
							<td class="text-center"><h3>บริษัท srithai (ประเทศไทย) จำกัด</h3></td>
							<td class="text-center"><h3>999-9999-9999</h3></td>
						</tr>-->
						<tr>
							<td><center><img class="img-responsive" src="img/bank/kbank.jpg" alt="banner-home3"></center></td>
							<td class="text-center" style="vertical-align:middle;"><h3>บจก. ศรีไทย อีคอมเมิร์ซ</h3></td>
							<td class="text-center" style="vertical-align:middle;"><h3>183 10577 49</h3></td>
						</tr>
					</table>
					<p>แจ้งชำระเงิน<br></p>
					<hr>
					<form action="payment.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="method" value="1">
						<div class="form-group">
							<label>เลข Order</label>
							<input type="text" class="form-control" id="Orders_Id" name="Orders_Id" maxlength="12" value="<?=$_GET[id];?>" required autocomplete="off">
						</div>
						<div class="form-group">
							<label>โอนเข้าธนาคาร</label>
							<select class="form-control" name="Orders_PaymentBank" id="Orders_PaymentBank" required>
								<option value="">- เลือกธนาคาร -</option>
								<!--<option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>-->
								<option value="ธนาคารกสิกรไทย" selected>ธนาคารกสิกรไทย</option>
							</select>
						</div>
						<div class="form-group">
							<label>ยอดการโอนเงิน</label>
							<input type="number" min="0.01" step="0.01" class="form-control" id="Orders_PaymentTransfer" name="Orders_PaymentTransfer" value="<?=number_format($total,2,'.','')?>" required>
						</div>
						<div class="form-group">
							<label>วันที่โอนเงิน</label>
							<input type="date" class="form-control" id="Orders_PaymentDate" name="Orders_PaymentDate" required>
						</div>
						<div class="form-group">
							<label>เวลาที่โอนเงิน</label>
							<input type="time" class="form-control" id="Orders_PaymentTime" name="Orders_PaymentTime" required>
						</div>
						<div class="form-group">
							<label>แนบหลักฐาน</label>
							<input type="file" id="Orders_PaymentDoc" name="Orders_PaymentDoc" required>
						</div>
						<center><button type="submit" class="btn btn-success">แจ้งโอนเงิน</button></center>
					</form>
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
