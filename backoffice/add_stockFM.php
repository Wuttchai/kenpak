<?php
$page = "smg03";
$page_name = "Add Stock (จากใบคุมตลาด).";

include "config/connect.php";
if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_stock WHERE Stock_Code = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_stock.php?page='.$_GET[page]);
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
											<!--<a href="add_stock.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add Manual </a>
											<a href="add_stockFM.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add จากใบคุมตลาด </a> 
											<a href="list_scan_in_select.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-save"></span> Scan In </a> 
											<a href="list_scan_out_select.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-open"></span> Scan Out </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a>-->
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
									<div class="portlet-body">
														<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
														<input type="hidden" name="page" value="1">
															<div class="input-group input-group-sm">
																<input type="text" name="text" class="form-control" placeholder="กรอกหมายเลขใบคุมตลาด" value="<?=$_GET[text]?>">
																<span class="input-group-btn">
																	<button class="btn green" type="submit">Search</button>
																</span>
															</div>
														</form>
														<?php
															if($_GET[text]!=""){
																
																$sql = "SELECT * FROM fs_orders 
																		LEFT JOIN fs_orders_detail ON fs_orders.Orders_Id = fs_orders_detail.Orders_Id 
																		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
																		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
																		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code
																		WHERE fs_orders.Orders_Date_Cutoff like '$_GET[text]' 
																		GROUP BY fs_product.Product_Code 
																		ORDER BY fs_product.Product_Code ";
																}
															$result = mysqli_query($conn, $sql);
															$row_count = mysqli_num_rows($result);
															$result = mysqli_query($conn, $sql);
															
															
														?>
														<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
														<div class="table-responsive">
															<form action="add_stockFM_script.php" method="post">
															<input type="hidden" name="fm" value="<?=$_GET[text]?>">
															<div class="input-group">
																<label>เลือกวันที่ซื้อสินค้า</label>
																<input type="date" name="Stock_CreateDate" id="Stock_CreateDate" class="form-control" value="<?=date("Y-m-d")?>">
															</div>
															<hr>
																<table class="table table-striped table-bordered table-hover">
																	<thead>
																		<tr>
																			<th> Stock Code </th>
																			<th> Product Code </th>
																			<th> Product Name </th>
																			<th> Product Amount </th>
																			<th> Price/Unit </th>
																			<th> Expiry Date </th>
																			<th> Rack </th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php
																		if(mysqli_num_rows($result) > 0) {
																			$i = 1;
																			while($row = mysqli_fetch_assoc($result)) {
																				
																				if($row[Stock_Status]=="0"){$text_Stock = "สร้างรายการจัดเก็บ";}
																				elseif($row[Stock_Status]=="2"){$text_Stock = "บันทึกรับเข้าคลัง";}
																				elseif($row[Stock_Status]=="4"){$text_Stock = "บันทึกออกจากคลัง";}
																				if($row[Product_Code]!=""){
																	?>
																		<tr>
																			<td> <?=$i?> </td>
																			<td> <?=$row[Product_Code]?> </td>
																			<td> <?=$row[Product_ThName]?> </td>
																			<td> <input type="number" class="form-control input-sm" name="S_<?=$row[Product_Code]?>" id="S_<?=$row[Product_Code]?>" min="1" step="0.01" placeholder="<?=$row[Unit_ThName]?>"> </td>
																			<td> <input type="number" min="0.01" step="0.01" class="form-control input-sm" name="SP_<?=$row[Product_Code]?>" id="SP_<?=$row[Product_Code]?>" placeholder="ราคา<?=$row[Unit_ThName]?>ละ"> </td>
																			<td> <input type="date" class="form-control input-sm" name="SE_<?=$row[Product_Code]?>" id="SE_<?=$row[Product_Code]?>" value="<?=date("Y-m-d");?>"> </td>
																			<td> 
																				<select class="form-control input-sm" name="RC_<?=$row[Product_Code]?>">
																					<option value="">Select Rack</option>
																					<?php 
																						$sql_in = "SELECT * FROM fs_rack ORDER BY Rack_Code ASC";
																						$result_in = mysqli_query($conn, $sql_in);
																						while($row_in = mysqli_fetch_assoc($result_in)) {
																					?>
																					<option value="<?=$row_in[Rack_Code]?>"><?=$row_in[Rack_Code]?> : <?=$row_in[Rack_Detail]?></option>
																					<?php
																						}
																					?>
																				</select>  
																			</td>
																		</tr>
																	<?php
																			$i++;
																				}
																			}
																			echo "<tr>";
																			echo '<td colspan="7"><button type="submit" class="btn blue btn-sm">Submit</button></td>';
																			echo "</tr>";
																		}else{
																			echo "<tr>";
																			echo "<td colspan='7'>0 results</td>";
																			echo "</tr>";
																		}
																	?>
																	</tbody>
																</table>
															</form>
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