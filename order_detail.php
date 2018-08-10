<?php
include "config/connect.php";

$sql = "SELECT * FROM fs_orders	WHERE fs_orders.Orders_Id = '$_GET[id]' AND fs_orders.Customer_Id = '".$_SESSION[user_id]."'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($query);

if($data[Order_Status]=="0"){$text_status = "รอชำระเงิน";}
elseif($data[Order_Status]=="2"){$text_status = "รอยืนยันการชำระเงิน";}
elseif($data[Order_Status]=="4"){$text_status = "สั่งซื้อเรียบร้อย";}
elseif($data[Order_Status]=="6"){$text_status = "ยกเลิกการสั่งซื้อ";}
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
					<h2 class="text-left">รายละเอียดการสั่งซื้อสินค้า : #<?=$_GET[id];?></h2>
					<hr>
						<div class="table-responsive">
							<table class="table">
								<caption><a href="history_order.php?page=1">รายการสั่งซื้อสินค้า</a> < รายละเอียดการสั่งซื้อสินค้า</caption>
								<thead>
									<tr>
										<th>ผู้รับสินค้า</th>
										<td colspan="5"><?=$data[Orders_Delivery_AddName]?></td>
									</tr>
									<tr>
										<th>สถานที่จัดส่ง</th>
										<td colspan="5"><?=$data[Orders_Delivery_AddShop]?> <?=$data[Orders_Delivery_AddAddress]?> ต.<?=$data[Orders_Delivery_AddTumbon]?> อ.<?=$data[Orders_Delivery_AddAumpor]?> จ.<?=$data[Orders_Delivery_AddProvince]?> <?=$data[Orders_Delivery_AddZipcode]?></td>
									</tr>
									<tr>
										<th>เบอร์ติดต่อ</th>
										<td colspan="5"><?=$data[Orders_Delivery_AddMobile]?></td>
									</tr>
									<tr>
										<th>วันที่สั่งซื้อ</th>
										<td colspan="5"><?=$data[Orders_CreateTime]?></td>
									</tr>
									<tr>
										<th>วันที่จัดส่ง</th>
										<td colspan="5"><?=$data[Orders_S_Date]?></td>
									</tr>
									<tr>
										<th>สถานะการชำระเงิน</th>
										<td colspan="5"><?=$text_status?> <?php if($data[Orders_PaymentDoc]!=""){echo "(<a href='doc_transfer/".$data[Orders_PaymentDoc]."' target='_blank'>ไฟล์เอกสาร</a>)";} ?> <?php if($data[Order_Status]=="0"){echo " | <a href='payment.php?id=$data[Orders_Id]'>แจ้งโอนเงิน</a>";}else{}?></td>
									</tr>
									<tr>
										<td colspan="6">รายละเอียดสินค้า</td>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										$dc = 0;
										$total = 0;
										
										$sql = "SELECT * FROM fs_orders 
												LEFT JOIN fs_orders_detail ON fs_orders.Orders_Id = fs_orders_detail.Orders_Id 
												LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
												LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
												WHERE fs_orders_detail.Orders_Id = '$_GET[id]'
												GROUP BY fs_orders_detail.Ordersde_Id";
										$result = mysqli_query($conn, $sql);
										$row_count = mysqli_num_rows($result);
										$total_page = ceil($row_count/$page_rows);
										
										$sql .= " ORDER BY fs_orders_detail.SellProduct_Code DESC";
										$result = mysqli_query($conn, $sql);
										if(mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_assoc($result)) {
												$dc = $row[Orders_Delivery_Price];
															
												$sql_in = "SELECT * FROM fs_orders_detail 
															WHERE fs_orders_detail.Ordersde_Id = '$row[Ordersde_Id]'";
												$result_in = mysqli_query($conn, $sql_in);
												$num_pro = 0;
												if(mysqli_num_rows($result_in) > 0) {
													while($row_in = mysqli_fetch_assoc($result_in)) {
														$num_pro = $num_pro +1;
													}
												}
									?>
									<tr>
										<th scope="row"><?=$i;?></th>
										<td>
											<div style="color:#2f419a;"><?=$row[SellProduct_Code]?></div>
										</td>
										<td><?=$row[SellProduct_ThName]?></td>
										<td><?=$num_pro?> <?=$row[Unit_ThName]?></td>
										<td align="right"> <?=number_format($row[Ordersde_Price],2)?>/<?=$row[Unit_ThName]?></td>
										<td align="right"> <?=number_format($num_pro*$row[Ordersde_Price],2)?> บาท</td>
									</tr>
									<?php 
											$i++;
											$total = $total + ($num_pro*$row[Ordersde_Price]);
											}
										}
									?>
									<tr>
										<td colspan="5" align="right">ราคารวม</td>
										<td align="right"><?=number_format($total,2);?> บาท</td>
									</tr>
									<tr>
										<td colspan="5" align="right">ค่าขนส่ง</td>
										<td align="right"><?=number_format($dc,2)?> บาท</td>
									</tr>
									<tr>
										<td colspan="5" align="right">ราคารวมสุทธิ</td>
										<td align="right"><?=number_format($total+$dc,2)?> บาท</td>
									</tr>
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
