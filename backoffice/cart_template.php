<?php
$page = "obb03";
$page_name = "Order By Back Office: Cart";
$page_rows = 50;

include "config/connect.php";

if($_GET[cid]==""){
	$cid = $_SESSION[user_id];
}else{
	$cid = $_GET[cid];
}

$meSql = "SELECT * FROM fs_template_detail 
			LEFT JOIN fs_sell_product ON fs_template_detail.SellProduct_Id = fs_sell_product.SellProduct_Id 
			LEFT JOIN fs_unit ON fs_unit.Unit_Code = fs_sell_product.SellProduct_Unit_Code 
			WHERE fs_template_detail.Template_Id = '$_GET[id]'";
$meQuery = mysqli_query($conn, $meSql);
$meCount = mysqli_num_rows($meQuery);
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
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
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
									<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
									<input type="hidden" name="page" value="1">
										<div class="input-group input-group-sm">
											<input type="text" name="text" class="form-control" placeholder="Search for..." value="<?=$_GET[text]?>">
											<span class="input-group-btn">
												<button class="btn green" type="submit">Search</button>
											</span>
										</div>
									</form>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											เลือกรายชื่อสินค้าที่ต้องการสั่งซื้อ
											<form action="cart_template.php?id=<?=$_GET[id]?>&cid=<?=$cid?>" method="post" name="fromupdate">
											<input type="hidden" name="id" value="<?=$_GET[id]?>">
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>#</th>
															<th>รหัสสินค้า</th>
															<th>ชื่อสินค้า</th>
															<th>รายละเอียด</th>
															<th>จำนวน</th>
															<th>ราคาต่อหน่วย</th>
															<th>จำนวนเงิน</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
													<?php
														if(mysqli_num_rows($meQuery) > 0) {
															$total_price = 0;
															$num = 0;
															$i = 1;
															$_SESSION[cart] = array();
															$_SESSION[qty] = array();
															while($row = mysqli_fetch_assoc($meQuery)) {
																$qty = "qty_".$row[SellProduct_Code];
																$total_price = $total_price + ($row[SellProduct_Cost] * $_POST[$qty]);
																if($_POST[$qty] > 0){
																	array_push($_SESSION[cart],$row[SellProduct_Code]);
																	array_push($_SESSION[qty],$_POST[$qty]);
																}
													?>
														<tr>
															<td> <?=$i?> </td>
															<td> <?=$row[SellProduct_Code]?> </td>
															<td> <?=$row[SellProduct_ThName]?> </td>
															<td>  </td>
															<td>  
																<input type="number" name="qty_<?=$row[SellProduct_Code]?>" min="0" step="1" value="<?=$_POST[$qty]?>" class="form-control" style="width: 80px;text-align: center;">
															</td>
															<td> <?=number_format($row[SellProduct_Cost],2)?> บาท /  <?=$row[SellProduct_Amount]?> <?=$row[Unit_ThName]?></td>
															<td style="text-align: right;">
																<?php
																	echo number_format($row[SellProduct_Cost]*$_POST[$qty],2)." บาท";
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
															<td colspan="6" style="text-align: right;">
																<h4>จำนวนเงินรวมทั้งหมด</h4>
															</td>
															<td style="text-align: right;"> <h4><?=number_format($total_price,2)?> บาท</h4> </td>
															<td>  </td>
														</tr>
														<tr>
															<td colspan="8" style="text-align: right;">
																<button type="submit" class="btn btn-info">คำนวณราคาสินค้าใหม่</button>
																<a onclick="CheckSumPrice();" href="order_call_template.php?id=<?=$_GET[id]?>&cid=<?=$cid?>" type="button" class="btn btn-primary" >สังซื้อสินค้า</a>
															</td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
										<?php include "page_number.php";?>
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


    </body>

</html>