<?php
$page = "smg05";
$page_name = "Scrap List.";
$page_rows = 50;

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
											<a href="add_stock.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a> 
											<!--<a href="list_scan_in_select.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-save"></span> Scan In </a> 
											<a href="list_scan_out_select.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-open"></span> Scan Out </a> 
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
											$sql = "SELECT * FROM fs_stock 
													INNER JOIN fs_product ON fs_stock.Product_Code = fs_product.Product_Code 
													INNER JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
													WHERE 1=1";
											if($_GET[text]!=""){
												$sql .= " AND (fs_stock.Stock_Code like '%$_GET[text]%' 
														OR fs_stock.Product_Code like '%$_GET[text]%' 
														OR fs_product.Product_ThName like '%$_GET[text]%' 
														OR fs_stock.Stock_ExpDate like '%$_GET[text]%'s)";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;
											
											$sql .= " ORDER BY fs_stock.Stock_Code DESC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);
											
											
										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
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
														<th> Stock Status </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
															
															if($row[Stock_Status]=="0"){$text_Stock = "สร้างรายการจัดเก็บ";}
															elseif($row[Stock_Status]=="2"){$text_Stock = "บันทึกรับเข้าคลัง";}
															elseif($row[Stock_Status]=="4"){$text_Stock = "บันทึกออกจากคลัง";}
												?>
													<tr>
														<td> <?=$row[Stock_Code]?> </td>
														<td> <?=$row[Product_Code]?> </td>
														<td> <?=$row[Product_ThName]?> </td>
														<td> <?=$row[Stock_Amount]?> <?=$row[Unit_ThName]?> </td>
														<td> <?=$row[Stock_UnitPrice]?> </td>
														<td> <?=$row[Stock_ExpDate]?> </td>
														<td> <?=$row[Rack_Code]?> </td>
														<td> <?=$text_Stock?> </td>
														<td>
															<a href="print_barcodestock.php?id=<?=$row[Stock_Code]?>" class="btn btn-circle btn-xs blue" target="_blank"><i class="glyphicon glyphicon-pencil"></i> Print Barcode </a>
															<?php if($row[Stock_Status]<2){ ?>
															<a href="list_stock.php?page=<?=$_GET[page]?>&id=<?=$row[Stock_Code]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
															<?php } ?>
														</td>
													</tr>
												<?php
														}
													}else{
														echo "<tr>";
														echo "<td colspan='9'>0 results</td>";
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