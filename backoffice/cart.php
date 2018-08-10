<?php
$page = "obb03";
$page_name = "Order By Back Office: Cart";
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
      <?php include "menu.php";?>
      <?php include "topmenu.php";?>

      <div class="content-wrap">
          <div class="main">
              <div class="container-fluid">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
            <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase"><?=$page_name?></span>
											<a href="cart.php?page=1" class="btn btn-circle green-jungle btn-sm"><span class="icon-handbag"></span> Cart  : <?=$_SESSION['cusNAME'];?> <span class="badge"><?php echo count($_SESSION['cart']); ?></span> </a>
											<!--<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a>
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a>
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a>-->
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
											<form action="updatecart.php" method="post" name="fromupdate">
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
															while($row = mysqli_fetch_assoc($meQuery)) {
																$key = array_search($row[SellProduct_Code], $_SESSION[cart]);
																$total_price = $total_price + ($row[SellProduct_Cost] * $_SESSION[qty][$key]);
													?>
														<tr>
															<td> <?=($num+1)?></td>
															<td> <?=$row[SellProduct_Code]?> </td>
															<td> <?=$row[SellProduct_ThName]?> </td>
															<td>  </td>
															<td>
																<input type="number" name="qty[<?=$num?>]" min="1" step="1" value="<?=$_SESSION[qty][$key]?>" class="form-control" style="width: 80px;text-align: center;">
																<input type="hidden" name="arr_key_<?=$num?>" value="<?=$key?>">
															</td>
															<td> <?=number_format($row[SellProduct_Cost],2)?> บาท /  <?=$row[SellProduct_Amount]?> <?=$row[Unit_ThName]?></td>
															<td style="text-align: right;">
																<?php
																	echo number_format($row[SellProduct_Cost]*$_SESSION[qty][$key],2)." บาท";
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
																<a onclick="CheckSumPrice();" href="order_call.php" type="button" class="btn btn-primary" >สังซื้อสินค้า</a>
															</td>
														</tr>
													</tbody>
												</table>
											</form>
											<?php
												}
											?>
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
