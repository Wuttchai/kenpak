<?php
include "config/connect.php";

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
					<h2 class="text-left">ประวัติการสั่งซื้อสินค้า</h2>
					<hr>
						<div class="table-responsive">
							<table class="table">
								<caption>รายการสั่งซื้อสินค้า</caption>
								<thead>
									<tr>
										<td>#</td>
										<td>เลขสั่งซื้อ</td>
										<td>วันที่สั่งซื้อ</td>
										<td>วันที่จัดส่ง</td>
										<td>สถานะการชำระเงิน</td>
										<td align="right">ราคารวม</td>
										<td align="right"></td>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										$sql = "SELECT * FROM fs_orders	WHERE fs_orders.Customer_Id = '".$_SESSION[user_id]."' ORDER BY Orders_CreateTime DESC";
										$query = mysqli_query($conn, $sql);
										while($data = mysqli_fetch_array($query)){
											
											$total = 0;
											$sql_detail = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '".$data[Orders_Id]."'";
											$query_detail = mysqli_query($conn, $sql_detail);
											while($data_detail = mysqli_fetch_array($query_detail)){
												$total = $total+($data_detail[Ordersde_Amount]*$data_detail[Ordersde_Price]);
											}
											
											if($data[Order_Status]=="0"){$text_status = "รอชำระเงิน";}
											elseif($data[Order_Status]=="2"){$text_status = "รอยืนยันการชำระเงิน";}
											elseif($data[Order_Status]=="4"){$text_status = "สั่งซื้อเรียบร้อย";}
											elseif($data[Order_Status]=="6"){$text_status = "ยกเลิกการสั่งซื้อ";}
									?>
									<tr>
										<th scope="row"><?=$x;?></th>
										<td>
											<h3 style="color:#2f419a;"><a href="order_detail.php?id=<?=$data[Orders_Id];?>"><?=$data[Orders_Id];?></a></h3>
										</td>
										<td><?=$data[Orders_CreateTime]?></td>
										<td><?=$data[Orders_S_Date]?></td>
										<td><?=$text_status?> <?php if($data[Orders_PaymentDoc]!=""){echo "(<a href='doc_transfer/".$data[Orders_PaymentDoc]."' target='_blank'>ไฟล์เอกสาร</a>)";} ?></td>
										<td align="right"><?=number_format($total,2)?> บาท</td>
										<td align="right"><?php if($data[Order_Status]=="0"){echo "<a href='payment.php?id=$data[Orders_Id]'>แจ้งโอนเงิน</a>";}else{echo "แจ้งโอนเงินแล้ว";}?></td>
									</tr>
									<?php 
										$x++;
										}
									?>
								</tbody>
							</table>
						</div>
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
