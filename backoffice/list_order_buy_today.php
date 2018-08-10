<?php
$page = "ord01";
$page_name = "Orders Detail.";
$page_rows = 50;

include "config/connect.php";
if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_customer WHERE Customer_Id = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_customer.php?page='.$_GET[page]);
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
                                            <span class="caption-subject bold uppercase"><?=$page_name?> : Order Number <?=$_GET[id]?></span>
											<!--<a href="add_customer.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a>
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a>
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a>
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a> -->
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
										<?php
											$i = 1;
											$sql = "SELECT * FROM fs_orders
													LEFT JOIN fs_orders_detail ON fs_orders.Orders_Id = fs_orders_detail.Orders_Id
													LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
												  WHERE Orders_S_Date > '".date("Y-m-d")."'
													GROUP BY fs_orders_detail.Orders_Id";
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);

											$sql .= " ORDER BY fs_orders_detail.SellProduct_Code DESC";
											$result = mysqli_query($conn, $sql);

										?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th align="center"> Barcode# </th>
														<th align="center"> Product ID </th>
														<th align="center"> Product Name </th>
														<th align="center"> จำนวนสั่ง </th>
														<th align="center"> ราคาต่อหน่วย </th>
														<th align="center"> ราคารวม </th>
													</tr>
												</thead>
												<tbody>
												<?php
													$dc = 0;
													$total = 0;
                          $id ='';
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
															$dc = $row[Orders_Delivery_Price];

															$sql_in = "SELECT * FROM fs_orders_detail
																		WHERE fs_orders_detail.Ordersde_Id = '$row[Ordersde_Id]'";
															$result_in = mysqli_query($conn, $sql_in);
															$num_pro = 0;

															if(mysqli_num_rows($result_in) > 0) {

																while($row_in = mysqli_fetch_assoc($result_in)) {
                                    //print_r($row);
																	$total = $total + $row[Ordersde_Price];
																	$num_pro = $num_pro +1;
																}
															}
												?>
													<tr>


                            <?php if ($row[SellProduct_Code] == $SellProduct_Code): $num_pro = $num_pro+$num_pro;?>




                            <?php if ($id != $row[SellProduct_Code]): ?>

                              <td> <?=$row[Ordersde_Id]?> </td>
  														<td> <?=$row[SellProduct_Code]?> </td>
  														<td> <?=$row[SellProduct_ThName]?> </td>
                              <td align="center"> <?=$num_pro?> </td>
                              <td align="right"> <?=number_format($row[Ordersde_Price],2)?> </td>
                              <td align="right"> <?=number_format($num_pro*$row[Ordersde_Price],2)?> </td>
                              	</tr>
                            <?php endif; $id = $row[SellProduct_Code] ?>


												<?php
														$i++;
														}
													}else{
														echo "<tr>";
														echo "<td colspan='7'>0 results</td>";
														echo "</tr>";
													}
												?>
													<tr>
														<td colspan='5'>ค่าขนส่ง</td>
														<td align="right"> <?=number_format($dc,2)?> </td>
													</tr>
													<tr>
														<td colspan='5'>รวมทั้งหมด</td>
														<td align="right"> <?=number_format($total+$dc,2)?> </td>
													</tr>
												</tbody>
											</table>
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


    </body>

</html>
