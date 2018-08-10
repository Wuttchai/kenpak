<?php
$page = "obb04";
$page_name = "Order By Back Office: Confirm Order";
$page_rows = 50;

include "config/connect.php";
$action = isset($_GET[a]) ? $_GET[a] : "";
$itemCount = isset($_SESSION[cart]) ? count($_SESSION[cart]) : 0;
if (isset($_SESSION[qty]))
{
    $meQty = 0;
    foreach ($_SESSION[qty] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION[cart]) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION[cart] as $itemId)
    {
        $itemIds = $itemIds . "'".$itemId . "',";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM fs_sell_product 
				LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
				WHERE SellProduct_Code in ({$inputItems}) ORDER BY FIELD(fs_sell_product.SellProduct_Code,{$inputItems})";
    $meQuery = mysqli_query($conn, $meSql);
    $meCount = mysqli_num_rows($meQuery);
} else
{
    $meCount = 0;
}

$meSql_cus = "SELECT * FROM fs_customer 
			LEFT JOIN fs_delivery_cost 
			ON fs_customer.Delivery_Cost_Id = fs_delivery_cost.Delivery_Cost_Id 
			WHERE fs_customer.Customer_Id = '$_GET[cid]'";
$meQuery_cus = mysqli_query($conn, $meSql_cus);
$row_cus = mysqli_fetch_assoc($meQuery_cus);

if($_POST[method]=="1"){
	$meSql = "INSERT INTO fs_delivery_address 
			VALUES ('','$_POST[Delivery_AddShop]','$_POST[Delivery_AddName]','$_POST[Delivery_AddAddress]','$_POST[Delivery_AddTumbon]','$_POST[Delivery_AddAumpor]',
			'$_POST[Delivery_AddProvince]','$_POST[Delivery_AddZipcode]','$_POST[Delivery_AddMobile]','$_POST[Customer_Id]')";
	$meQuery = mysqli_query($conn, $meSql);
	header('location: order_call.php');
}

if($_GET[method]=="2"){
	$sql = "DELETE FROM fs_delivery_address WHERE Delivery_AddId = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: order_call.php');
}
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <?php include "topmenu.php";?>
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <?php include "menu.php";?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
						<div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase"><?=$page_name?></span> 
											<!--<a href="cart.php?page=1" class="btn btn-circle green-jungle btn-sm"><span class="icon-handbag"></span> Cart  : <?=$_SESSION['cusNAME'];?> <span class="badge"><?php echo count($_SESSION['cart']); ?></span> </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a> -->
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
										<div class="table-responsive">
											<?php
												if ($action == 'removed')
												{
													echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
												}

												if ($meCount == 0)
												{
													echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
												} else 
												{
											?>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
												+ เพิ่มที่อยู่จัดส่ง
											</button>
											</p>
											
											<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">เพิ่มสถานที่จัดส่ง</h4>
												  </div>
												  <form action="order_call.php" method="post" name="formupdate" role="form" id="formupdate">
												  <input type="hidden" name="method" value="1">
												  <input type="hidden" name="Customer_Id" value="<?=$row_cus[Customer_Id]?>">
												  <div class="modal-body">
														<div class="form-group">
															<label for="exampleInputEmail1">ชื่อร้าน *</label>
															<input type="text" class="form-control" id="Delivery_AddShop" name="Delivery_AddShop" required>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">ชื่อ-นามสกุล *</label>
															<input type="text" class="form-control" id="Delivery_AddName" name="Delivery_AddName" required>
														</div>
														<div class="form-group">
															<label for="exampleInputAddress">ที่อยู่ *</label>
															<textarea class="form-control" rows="2" name="Delivery_AddAddress" id="Delivery_AddAddress"></textarea>
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">ตำบล *</label>
															<input type="text" class="form-control" id="Delivery_AddTumbon" name="Delivery_AddTumbon" required>
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">อำเภอ *</label>
															<input type="text" class="form-control" id="Delivery_AddAumpor" name="Delivery_AddAumpor" required>
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">จังหวัด *</label>
															<input type="text" class="form-control" id="Delivery_AddProvince" name="Delivery_AddProvince" required>
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">รหัสไปรษณีย์ *</label>
															<input type="text" class="form-control" id="Delivery_AddZipcode" name="Delivery_AddZipcode" maxlength="5" required>
														</div>
														<div class="form-group">
															<label for="exampleInputPhone">เบอร์โทรศัพท์ *</label>
															<input type="text" class="form-control" id="Delivery_AddMobile" name="Delivery_AddMobile" required>
														</div>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												  </div>
												  </form>
												</div>
											  </div>
											</div>
							
											<form action="updateorder.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
											<?php $_SESSION[cusID] = $row_cus[Customer_Id];?>
											<input type="hidden" name="user_id" value="<?=$row_cus[Customer_Id]?>">
											
											<label>เลือกสถานที่จัดส่ง</label>
											<?php
												$sql = "SELECT * FROM fs_delivery_address WHERE Customer_Id = '$row_cus[Customer_Id]' ORDER BY Delivery_AddId";
												$result = mysqli_query($conn, $sql);
												if (mysqli_num_rows($result) > 0) {
													while($row = mysqli_fetch_assoc($result)) {
											?>
											<div class="note note-success">
												<h4><input type="radio" name="address" required value="<?=$row[Delivery_AddId]?>"> <b><?=$row[Delivery_AddName]?></b> <small>ที่อยู่จัดส่ง : ร้าน<?=$row[Delivery_AddShop]?> <?=$row[Delivery_AddAddress]?> ต.<?=$row[Delivery_AddTumbon]?> อ.<?=$row[Delivery_AddAumpor]?> จ.<?=$row[Delivery_AddProvince]?> <?=$row[Delivery_AddZipcode]?> / Tel.<?=$row[Delivery_AddMobile]?></small> 
												<a class="btn btn-danger btn-xs" href="order_call.php?id=<?=$row[Delivery_AddId]?>&method=2" role="button" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></h4>
											</div>
											<?php
													}
												}else{echo "<p><div class=\"alert alert-danger\" role=\"alert\">กรุณาเพิ่มที่อยู่จัดส่งก่อนครับ</div></p>";}
											?>
											
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
												<label>Delivery Date</label>
												<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
													<input type="text" class="form-control" name="Orders_S_Date" required>
													<span class="input-group-btn">
														<button class="btn default" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>
											</div>
											<hr>
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>รหัสสินค้า</th>
															<th>ชื่อสินค้า</th>
															<th>รายละเอียด</th>
															<th>จำนวน</th>
															<th>ราคาต่อหน่วย</th>
															<th>จำนวนเงิน (บาท)</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
													<?php
														if(mysqli_num_rows($meQuery) > 0) {
															$total_price = 0;
															$num = 0;
															while($row = mysqli_fetch_assoc($meQuery)) {
																$key = array_search($row[SellProduct_Code], $_SESSION[cart]);
																$total_price = $total_price + ($row[SellProduct_Cost] * $_SESSION[qty][$key]);
													?>
														<tr>
															<td> <?=$row[SellProduct_Code]?> </td>
															<td> <?=$row[SellProduct_ThName]?> </td>
															<td>  </td>
															<td>  
																<?php echo $_SESSION[qty][$key]; ?>
																<input type="hidden" name="qty[]" value="<?php echo $_SESSION[qty][$key]; ?>" />
																<input type="hidden" name="pro_id[]" value="<?php echo $row[SellProduct_Code]; ?>" />
																<input  type="hidden" name="pro_price[]" value="<?php echo $row[SellProduct_Cost]; ?>" />
															</td>
															<td> <?=number_format($row[SellProduct_Cost],2)?> บาท /  <?=$row[SellProduct_Amount]?> <?=$row[Unit_ThName]?></td>
															<td style="text-align: right;">
																<?php
																	echo number_format($row[SellProduct_Cost]*$_SESSION[qty][$key],2);
																?>
															</td>
															<td>
																<a href="removecart.php?itemId=<?=$row[SellProduct_Code]?>&page=<?=$_GET[page]?>" class="btn btn-circle btn-xs red"><i class="glyphicon glyphicon-trash"></i> Delete </a>
															</td>
														</tr>
													<?php
															$i++;
															$num++;
															}
														}else{
															echo "<tr>";
															echo "<td colspan='6'>0 results</td>";
															echo "</tr>";
														}
													?>
														<tr>
															<td colspan="5" style="text-align: right;">จำนวนเงินรวม</td>
															<td style="text-align: right;"> <?=number_format($total_price,2)?> </td>
															<td>  </td>
														</tr>
														<tr>
															<td colspan="5" style="text-align: right;">ค่าขนส่ง</td>
															<td style="text-align: right;"><?php echo number_format($row_cus[Delivery_Cost], 2); $finaltotal = $row_cus[Delivery_Cost]+$total_price; ?></td>
															<input type="hidden" name="orders_delivery_price" value="<?php echo number_format($row_cus[Delivery_Cost], 2); ?>" />
														</tr>
														<tr>
															<td colspan="5" style="text-align: right;"><b>จำนวนเงินรวมทั้งหมด</b></td>
															<td style="text-align: right;"> <b><?=number_format($finaltotal,2)?></b> </td>
															<td>  </td>
														</tr>
														<tr>
															<td colspan="7" style="text-align: right;">
																<!--<a href="cart_template.php?id=<?=$_GET[id]?>&cid=<?=$_GET[cid]?>" type="button" class="btn btn-danger">ย้อนกลับ</a>-->
																<button type="submit" class="btn btn-primary">บันทึกการสั่งซื้อสินค้า</button>
															</td>
														</tr>
													</tbody>
												</table>
											</form>
											<?php
												}
											?>
										</div>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <?php include "footer.php"; ?>
        </div>


        <?php include "footer_script.php"; ?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->


    </body>

</html>