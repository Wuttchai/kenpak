<?php
include "config/connect.php";
if($_POST[method]=="1"){
	$sql = "SELECT * FROM fs_customer WHERE Customer_Username = '$_POST[username]' AND Customer_Password = '$_POST[password]' AND Customer_Status = '1'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION[user_username] = $row[Customer_Username];
			$_SESSION[user_id] = "C".$row[Customer_Id];
			$_SESSION[user_type] = "customer";
			
			echo "<script>alert('เข้าสู่ระบบเรียบร้อยแล้ว ขอบคุณค่ะ'); window.location.href='products.php?page=1'</script>";
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
				<div class="col-md-12">
					<h2 class="text-left">ตระกร้าสินค้า (<?=count($_SESSION[cart_item]);?>)</h2>
					<hr>
					<?php if($_GET[mg]=="2"){?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							ลบสินค้าออกจากตระกร้าเรียบร้อยแล้วคะ
						</div>
					<?php } if($_GET[mg]=="1"){?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							เพิ่มสินค้าลงตระกร้า และคำนวณราคาใหม่เรียบร้อยแล้วคะ
						</div>
					<?php 
						}
						if(count($_SESSION[cart_item])=="0"){
							echo "<center><h3>ยังไม่มีสินค้าในตระกร้าคะ ... </h3> <br> <a href='products.php?page=1'><h3>ต้องการเลือกดูรายการสินค้า </h3></a></center>";
						}else{ ?>
					<form action="update_cart.php" method="post">
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
										<td></td>
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
										<td align="right"><input type="number" name="<?=$x;?>" class="form-control" min="1" step="1" style="width:100px;height:40px;" value="<?=$_SESSION[cart_amount][$x];?>"> <?=$data[Unit_ThName]?></td>
										<td align="right"><font style="font-size: 24px;"><?=number_format(($data[SellProduct_Cost]*$_SESSION[cart_amount][$x]),2)?></font><br>บาท</td>
										<td valign="middle"><a href="update_cart.php?method=del&id=<?=$_SESSION[cart_item][$x];?>" onclick="return confirm('Are you sure you want to delete this item?');"><img src="https://vignette.wikia.nocookie.net/elderscrolls/images/0/05/Incomplete.png" width="25px"></a></td>
									</tr>
									<?php 
										$total = $total + ($data[SellProduct_Cost]*$_SESSION[cart_amount][$x]);
										}
									?>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 24px;">ราคารวม</font></td>
										<td align="right"><font style="font-size: 24px;"><?=number_format(($total),2)?></font><br>บาท</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 24px;">ค่าขนส่ง</font></td>
										<td align="right"><font style="font-size: 24px;">0.00</font><br>บาท</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4" align="right"><font style="font-size: 26px;color:#2f419a;">ราคารวมสุทธิ</font></td>
										<td align="right"><font style="font-size: 26px;color:#2f419a;"><u><?=number_format(($total),2)?></u></font><br>บาท</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					<center><button type="submit" class="btn btn-success">คำนวณราคาใหม่</button> <a href="confirm_order.php" role="button"><button type="button" class="btn btn-default">ยืนยันการสั่งซื้อ</button></a></center>
					</form>
					<?php } ?>
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
