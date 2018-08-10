<?php
include "config/connect.php";

if($_POST[method]=="address"){
	$meSql = "INSERT INTO fs_delivery_address 
			VALUES ('','$_POST[Delivery_AddShop]','$_POST[Delivery_AddName]','$_POST[Delivery_AddAddress]','$_POST[Delivery_AddTumbon]','$_POST[Delivery_AddAumpor]',
			'$_POST[Delivery_AddProvince]','$_POST[Delivery_AddZipcode]','$_POST[Delivery_AddMobile]','$_POST[Customer_Id]')";
	$meQuery = mysqli_query($conn, $meSql);
	echo "<script>alert('เข้าสู่ระบบเรียบร้อยแล้ว ขอบคุณค่ะ'); window.location.href='confirm_order.php'</script>";
}

if($_GET[method]=="address_del"){
	$sql = "DELETE FROM fs_delivery_address WHERE Delivery_AddId = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	echo "<script>alert('ลบข้อมูลสถานที่จัดส่งเรียบร้อยแล้ว ขอบคุณค่ะ'); window.location.href='confirm_order.php'</script>";
}

$meSql_cus = "SELECT * FROM fs_customer 
			LEFT JOIN fs_delivery_cost 
			ON fs_customer.Delivery_Cost_Id = fs_delivery_cost.Delivery_Cost_Id 
			WHERE fs_customer.Customer_Id = '$_SESSION[user_id]'";
$meQuery_cus = mysqli_query($conn, $meSql_cus);
$row_cus = mysqli_fetch_assoc($meQuery_cus);
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
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
					<h2 class="text-left">ยืนยันการสั่งซื้อ (<?=count($_SESSION[cart_item]);?>)</h2>
					<hr>
					<form action="update_order.php" method="post">
						<input type="hidden" name="orders_delivery_price" value="<?=$row_cus[Delivery_Cost];?>">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
							+ เพิ่มที่อยู่จัดส่ง
						</button>
						
						<hr>
						<div class="form-group">
							<label>เลือกสถานที่จัดส่ง</label>
							<?php
								$sql = "SELECT * FROM fs_delivery_address WHERE Customer_Id = '$_SESSION[user_id]' ORDER BY Delivery_AddId";
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_assoc($result)) {
							?>
							
							<div class="radio">
								<label>
									<input type="radio" name="address" required value="<?=$row[Delivery_AddId]?>">
									<b><?=$row[Delivery_AddName]?></b> <small>ที่อยู่จัดส่ง : ร้าน<?=$row[Delivery_AddShop]?> <?=$row[Delivery_AddAddress]?> ต.<?=$row[Delivery_AddTumbon]?> อ.<?=$row[Delivery_AddAumpor]?> จ.<?=$row[Delivery_AddProvince]?> <?=$row[Delivery_AddZipcode]?> / Tel.<?=$row[Delivery_AddMobile]?></small>
									<a href="confirm_order.php?id=<?=$row[Delivery_AddId]?>&method=address_del" role="button" onclick="return confirm('Are you sure you want to delete this item?');"><img src="https://vignette.wikia.nocookie.net/elderscrolls/images/0/05/Incomplete.png" width="20px"></a>
								</label>
							</div>
							<?php
									}
								}else{echo "<p><div class=\"alert alert-danger\" role=\"alert\">กรุณาเพิ่มที่อยู่จัดส่งก่อนครับ</div></p>";}
							?>
						</div>
						<div class="form-group">
							<label for="exampleInputPhone">ประเภทการจ่ายเงิน : </label>
							<?php 
								if($row_cus[Payments_Type1]=="1"){?>
							<input type="radio" name="orders_payment_type" value="1" required> เครดิตเทอม |
							<?php }
								if($row_cus[Payments_Type2]=="1"){
							?>
							<input type="radio" name="orders_payment_type" value="2" required> จ่ายเต็ม |
							<?php }
								if($row_cus[Payments_Type4]=="1"){
							?>
							<input type="radio" name="orders_payment_type" value="4" required> เก็บเงินปลายทาง
							<?php }
							?>
						</div>
						<div class="form-group">
							<label>เลือกวันที่จัดส่งสินค้า : </label>
							<input class="form-control" id="Orders_S_Date" name="Orders_S_Date" placeholder="DD/MM/YYYY" type="text" autocomplete="off" required>
								<script>
									$(document).ready(function(){
									  var date_input=$('input[name="Orders_S_Date"]');
									  var options={
										format: 'yyyy-mm-dd',
										todayHighlight: false,
										todayBtn: false,
										autoclose: true,
										startDate: '<?=date('Y-m-d',strtotime("+1 day"))?>',
									  };
									  date_input.datepicker(options);
									})
								</script>
						</div>
						<hr>
						<input type="hidden" name="method" value="edit">
						<div class="table-responsive">
							<table class="table">
								<caption>รายละเอียดรายการสินค้าในตระกร้า</caption>
								<thead>
									<tr>
										<td>#</td>
										<td>สินค้า</td>
										<td align="right">ราคาต่อหน่วย</td>
										<td align="right">จำนวน</td>
										<td align="right">ราคารวม</td>
									</tr>
								</thead>
								<tbody>
									<?php
										$total = 0;
										for($x = 0; $x < count($_SESSION[cart_item]); $x++) {
											$sql = "SELECT * FROM fs_sell_product 
													INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
													WHERE fs_sell_product.SellProduct_Code = '".$_SESSION[cart_item][$x]."'";
											$query = mysqli_query($conn, $sql);
											$data = mysqli_fetch_array($query);
									?>
									<tr>
										<th scope="row"><?=($x+1);?></th>
										<td>
											<h3 style="color:#2f419a;"><?=$data[SellProduct_ThName];?></h3><br>
											รหัสสินค้า : <?=$_SESSION[cart_item][$x];?><br>
											หมวดสินค้า : ผักสดตามฤดูกาล
										</td>
										<td align="right"><font style="font-size: 24px;"><?=number_format($data[SellProduct_Cost],2)?></font><br>บาท/<?=$data[Unit_ThName]?></td>
										<td align="right"><font style="font-size: 24px;"><?=$_SESSION[cart_amount][$x];?></font><br><?=$data[Unit_ThName]?></td>
										<td align="right"><font style="font-size: 24px;"><?=number_format(($data[SellProduct_Cost]*$_SESSION[cart_amount][$x]),2)?></font><br>บาท</td>
									</tr>
									<?php 
										$total = $total + ($data[SellProduct_Cost]*$_SESSION[cart_amount][$x]);
										}
									?>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 24px;">ราคารวม</font></td>
										<td align="right"><font style="font-size: 24px;"><?=number_format(($total),2)?></font><br>บาท</td>
									</tr>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 24px;">ค่าขนส่ง</font></td>
										<td align="right"><font style="font-size: 24px;">0.00</font><br>บาท</td>
									</tr>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 26px;color:#2f419a;">ราคารวมสุทธิ</font></td>
										<td align="right"><font style="font-size: 26px;color:#2f419a;"><u><?=number_format(($total),2)?></u></font><br>บาท</td>
									</tr>
								</tbody>
							</table>
						</div>
						<center>
							<button type="submit" class="btn btn-primary">สั่งซื้อสินค้า</button>
						</center>
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
		
		<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">เพิ่มสถานที่จัดส่ง</h4>
							  </div>
							  <form action="confirm_order.php" method="post" name="formupdate" role="form" id="formupdate">
								  <input type="hidden" name="method" value="address">
								  <input type="hidden" name="Customer_Id" value="<?=$_SESSION[user_id];?>">
								  <div class="modal-body">
										<div class="form-group">
											<label>ชื่อร้าน *</label>
											<input type="text" class="form-control" id="Delivery_AddShop" name="Delivery_AddShop" required>
										</div>
										<div class="form-group">
											<label>ชื่อ-นามสกุล *</label>
											<input type="text" class="form-control" id="Delivery_AddName" name="Delivery_AddName" required>
										</div>
										<div class="form-group">
											<label>ที่อยู่ *</label>
											<textarea class="form-control" rows="2" name="Delivery_AddAddress" id="Delivery_AddAddress"></textarea>
										</div>
										<div class="form-group">
											<label>ตำบล *</label>
											<input type="text" class="form-control" id="Delivery_AddTumbon" name="Delivery_AddTumbon" required>
										</div>
										<div class="form-group">
											<label>อำเภอ *</label>
											<input type="text" class="form-control" id="Delivery_AddAumpor" name="Delivery_AddAumpor" required>
										</div>
										<div class="form-group">
											<label>จังหวัด *</label>
											<select class="form-control" id="Delivery_AddProvince" name="Delivery_AddProvince" required>
												<option value="">-= เลือกจังหวัด =-</option>
												<option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
												<option value="นครปฐม">นครปฐม</option>
												<option value="นนทบุรี">นนทบุรี</option>
												<option value="ปทุมธานี">ปทุมธานี</option>
												<option value="สมุทรปราการ">สมุทรปราการ</option>
												<option value="สมุทรสาคร">สมุทรสาคร</option>
											</select>
										</div>
										<div class="form-group">
											<label>รหัสไปรษณีย์ *</label>
											<input type="text" class="form-control" id="Delivery_AddZipcode" name="Delivery_AddZipcode" maxlength="5" required>
										</div>
										<div class="form-group">
											<label>เบอร์โทรศัพท์ *</label>
											<input type="text" class="form-control" id="Delivery_AddMobile" name="Delivery_AddMobile" required>
										</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
									<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
								  </div>
							  </form>
							</div>
						  </div>
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
