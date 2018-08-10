<?php
$page = "obt02";
$page_name = "Order By Back Office: Shopping Market";
$page_rows = 50;

include "config/connect.php";

if($_GET[id]==""){
	$id = $_SESSION[user_id];
}else{
	$id = $_GET[id];
}

if($id!=""){
	if($_SESSION[cusID] != $id){
		$_SESSION[cusID] = $id;
		echo $meSql = "SELECT * FROM fs_customer WHERE Customer_Id = '$id'";
		$meQuery = mysqli_query($conn, $meSql);
		$row = mysqli_fetch_assoc($meQuery);
		$_SESSION[cusNAME] = $row[Customer_Name];

		$_SESSION[cart] = array();
		$_SESSION[qty] = array();
	}
}else{
	if($_SESSION[cusID] != substr($_SESSION[user_id],1)){
		$_SESSION[cusID] = substr($_SESSION[user_id],1);
		$meSql = "SELECT * FROM fs_customer WHERE Customer_Id = '$_SESSION[user_id]'";
		$meQuery = mysqli_query($conn, $meSql);
		$row = mysqli_fetch_assoc($meQuery);
		$_SESSION[cusNAME] = $row[Customer_Name];

		$_SESSION[cart] = array();
		$_SESSION[qty] = array();
	}
}

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        $meQty = $meQty + $meItem;
    }
}else{
    $meQty=0;
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
										<?php
											$i = 1;
											$sql = "SELECT * FROM fs_sell_product
													LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code
													WHERE 1=1";
											if($_GET[text]!=""){
												$sql .= " AND (SellProduct_Code like '%$_GET[text]%'
														OR SellProduct_ThName like '%$_GET[text]%'
														OR SellProduct_Cost like '%$_GET[text]%'
														OR SellProduct_Amount like '%$_GET[text]%'
														OR Unit_ThName like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;

											$sql .= " ORDER BY SellProduct_Code ASC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);

										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											เลือกรายชื่อสินค้าที่ต้องการสั่งซื้อ
											<?php
												if($action == 'exists'){
													echo "<div class=\"alert alert-warning\">เพิ่มจำนวนสินค้าแล้ว</div>";
												}
												if($action == 'add'){
													echo "<div class=\"alert alert-success\">เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
												}
												if($action == 'order'){
													echo "<div class=\"alert alert-success\">สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
												}
												if($action == 'orderfail'){
													echo "<div class=\"alert alert-warning\">สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
												}
											?>
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Sell_Pro Code </th>
														<th> Sell_Pro Name </th>
														<th> Sell_Pro Cost(฿) / Unit </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<td> <?=$row[SellProduct_Code]?> </td>
														<td> <?=$row[SellProduct_ThName]?> </td>
														<td> <?=number_format($row[SellProduct_Cost],2)?> บาท /  <?=$row[SellProduct_Amount]?> <?=$row[Unit_ThName]?></td>
														<td>
															<a href="updatecart.php?itemId=<?=$row[SellProduct_Code]?>&page=<?=$_GET[page]?>&id=<?=$id?>" class="btn btn-circle btn-xs blue-chambray"><i class="icon-basket"></i> Add to Cart </a>

														</td>
													</tr>
												<?php
														$i++;
														}
													}else{
														echo "<tr>";
														echo "<td colspan='6'>0 results</td>";
														echo "</tr>";
													}
												?>
												</tbody>
											</table>
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
