<?php
$page = "upl01";
$page_name = "Update Product Price.";
$page_rows = 50;

include "config/connect.php";

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
											<!--<a href="add_buyproduct.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a> -->
											<a href="download_supproduct_xlsx.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-save"></span> Download Price Template </a> 
											<a href="#responsive" data-toggle="modal" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-open"></span> Upload Price Product </a> 
											<!--<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a> -->
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
											$sql = "SELECT * FROM fs_product 
													LEFT JOIN fs_productcategory ON fs_product.ProductCategory_Code = fs_productcategory.ProductCategory_Code 
													LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
													WHERE 1=1 AND Supplier_Id = '".substr($_SESSION[user_id],1)."'";
											if($_GET[text]!=""){
												$sql .= " AND (fs_product.Product_Code like '%$_GET[text]%' 
														OR fs_product.Product_ThName like '%$_GET[text]%' 
														OR fs_product.Product_EnName like '%$_GET[text]%' 
														OR fs_productcategory.ProductCategory_ThName like '%$_GET[text]%' 
														OR fs_unit.Unit_ThName like '%$_GET[text]%' 
														OR fs_product.Product_Cost like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;
											
											$sql .= " ORDER BY Product_Code ASC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);
											
											
										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Product Code </th>
														<th> Product Name </th>
														<th> Product Category </th>
														<th> Market Unit </th>
														<th> Product Cost (฿) </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<td> <?=$row[Product_Code]?> </td>
														<td> <?php if($row[Product_Image]!=""){echo "<a href='".$row[Product_Image]."' target='_blank'><i class='icon-picture'></i></a>";}else{}?> <?=$row[Product_ThName]?> : <?=$row[Product_EnName]?> </td>
														<td> <?=$row[ProductCategory_ThName]?> </td>
														<td> <?=$row[Market_Product_Amount]?> <?=$row[Unit_ThName]?> </td>
														<td> <?=number_format($row[Product_Cost],2)?> </td>
														<td>
															<a href="updateprice_buyproduct.php?id=<?=$row[Product_Id]?>" class="btn btn-circle btn-xs blue"><i class="glyphicon glyphicon-pencil"></i> Update Price </a>
														</td>
													</tr>
												<?php
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
				
				<!-- /.modal -->
				<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Upload Price Template</h4>
							</div>
							<div class="modal-body">
								<div class="scroller" style="height:410px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="portlet-body form">
											<form role="form" action="upload_file_supproduct.php" method="post" enctype="multipart/form-data">
												<div class="form-body">
													<div class="form-group">
														<label>Select Price Template</label>
														<input class="form-control spinner" type="file" name="fileToUpload" id="fileToUpload">
													</div>
													<div class="form-actions">
														<button type="submit" class="btn blue">Upload</button>
														<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- END CONTAINER -->
            <?php include "footer.php"; ?>
        </div>


        <?php include "footer_script.php"; ?>
		<?php if($_GET[msg]=="1"){ ?>
		<script>
			alert("Upload Complate.");
		</script>
		<?php } ?>

    </body>

</html>