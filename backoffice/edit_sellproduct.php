<?php
$page = "pmg02";
$page_name = "Set Sell Product.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_sell_product WHERE SellProduct_Code = '$_POST[SellProduct_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_sell_product (SellProduct_Code, Product_Code, SellProduct_ThName, SellProduct_Amount, SellProduct_Unit_Code, SellProduct_Buy_Amount, SellProduct_Cost, SellProduct_Weigh, SellProduct_Status) 
				VALUES ('$_POST[SellProduct_Code]', '$_POST[Product_Code]', '$_POST[SellProduct_ThName]', '$_POST[SellProduct_Amount]', '$_POST[SellProduct_Unit_Code]', '$_POST[SellProduct_Buy_Amount]', '$_POST[SellProduct_Cost]', '$_POST[SellProduct_Weigh]', '1')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: edit_sellproduct.php?id='.$_POST[Product_Id]);
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code นี้มีอยู่แล้ว\")); </script>";
	}
}

if($_POST[method]=="2"){
	$sql_chk = "SELECT * FROM fs_sell_product WHERE SellProduct_Code = '$_POST[SellProduct_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0 OR $_POST[Old_Code]==$_POST[SellProduct_Code]){
		$sql = "UPDATE fs_sell_product SET 
				SellProduct_Code = '$_POST[SellProduct_Code]', 
				Product_Code = '$_POST[Product_Code]',  
				SellProduct_ThName = '$_POST[SellProduct_ThName]', 
				SellProduct_Amount = '$_POST[SellProduct_Amount]', 
				SellProduct_Unit_Code = '$_POST[SellProduct_Unit_Code]', 
				SellProduct_Buy_Amount = '$_POST[SellProduct_Buy_Amount]', 
				SellProduct_Cost = '$_POST[SellProduct_Cost]', 
				SellProduct_Weigh = '$_POST[SellProduct_Weigh]', 
				SellProduct_Status = '1' 
				WHERE SellProduct_Id like '$_POST[SellProduct_Id]'";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: edit_sellproduct.php?id='.$_POST[Product_Id]);
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code นี้มีอยู่แล้ว\")); </script>";
	}
}

if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_sell_product WHERE SellProduct_Id = '$_GET[sellid]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: edit_sellproduct.php?id='.$_GET[id]);
}

$sql = "SELECT * FROM fs_product 
		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
		WHERE fs_product.Product_Id = '$_GET[id]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"><?=$page_name?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
											<center><img src="<?=$row[Product_Image]?>" width="280px"></center>
											<div class="form-group">
												<label>Product Code : <?=$row[Product_Code]?></label>
											</div>
											<div class="form-group">
												<label>Thai Product Name : <?=$row[Product_ThName]?></label>
											</div>
											<div class="form-group">
												<label>English Product Name : <?=$row[Product_EnName]?></label>
											</div>
											<div class="form-group">
												<label>Buy Product Amount : <?=$row[Market_Product_Amount]?> <?=$row[Unit_ThName]?></label>
											</div>
											<div class="form-group">
												<label>Product Cost  : <?=$row[Product_Cost]?> (฿) / Unit</label>
											</div>
											<div class="form-group">
												<label>Product Weigh : <?=$row[Product_Weigh]?> (g.) / Unit</label>
											</div>
											<hr>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th> Sell_Pro Code </th>
															<th> Sell_Pro Name </th>
															<th> Sell Amount </th>
															<th> Sell Unit </th>
															<th> Equal Amount (Buy) </th>
															<th> Equal Unit (Buy) </th>
															<th> Sell_Pro (฿) </th>
															<th> Sell_Pro Weigh (g.) </th>
															<th>  </th>
														</tr>
													</thead>
													<tbody>
													<?php 
														if($_GET[sellid]==""){
													?>
														<form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
														<input type="hidden" name="method" value="1">
														<input type="hidden" name="Product_Code" value="<?=$row[Product_Code]?>">
														<input type="hidden" name="Product_Id" value="<?=$row[Product_Id]?>">
															<tr>
																<td> <input type="text" class="form-control input-sm" maxlength="10" name="SellProduct_Code" required> </td>
																<td> <input type="text" class="form-control input-sm" name="SellProduct_ThName" required> </td>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Amount" required> </td>
																<td> 
																	<select class="form-control input-sm" name="SellProduct_Unit_Code">
																		<option value="">Select Unit</option>
																		<?php 
																			$sql_in = "SELECT * FROM fs_unit";
																			$result_in = mysqli_query($conn, $sql_in);
																			while($row_in = mysqli_fetch_assoc($result_in)) {
																		?>
																		<option value="<?=$row_in[Unit_Code]?>"><?=$row_in[Unit_Code]?> : <?=$row_in[Unit_ThName]?></option>
																		<?php
																			}
																		?>
																	</select> 
																</td>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Buy_Amount" required> </td>
																<td> <?=$row[Unit_ThName]?> </td>
																<th> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Cost" required> </th>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Weigh" required> </td>
																<td>
																	<button type="submit" class="btn blue btn-sm">Submit</button>
																</td>
															</tr>
														</form>
													<?php 
														} else {
															$sql_3 = "SELECT * FROM fs_sell_product 
																	LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
																	WHERE fs_sell_product.SellProduct_Id = '$_GET[sellid]'";
															$result_3 = mysqli_query($conn, $sql_3);
															$row_3 = mysqli_fetch_assoc($result_3);
													?>
														<form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
														<input type="hidden" name="method" value="2">
														<input type="hidden" name="Product_Code" value="<?=$row[Product_Code]?>">
														<input type="hidden" name="Product_Id" value="<?=$row[Product_Id]?>">
														<input type="hidden" name="SellProduct_Id" value="<?=$_GET[sellid]?>">
														<input type="hidden" name="Old_Code" value="<?=$row_3[SellProduct_Code]?>">
															<tr>
																<td> <input type="text" class="form-control input-sm" maxlength="10" name="SellProduct_Code" value="<?=$row_3[SellProduct_Code]?>" required> </td>
																<td> <input type="text" class="form-control input-sm" name="SellProduct_ThName" value="<?=$row_3[SellProduct_ThName]?>" required> </td>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Amount" value="<?=$row_3[SellProduct_Amount]?>" required> </td>
																<td> 
																	<select class="form-control input-sm" name="SellProduct_Unit_Code">
																		<option value="">Select Unit</option>
																		<?php 
																			$sql_in = "SELECT * FROM fs_unit";
																			$result_in = mysqli_query($conn, $sql_in);
																			while($row_in = mysqli_fetch_assoc($result_in)) {
																				if($row_3[Unit_Code]==$row_in[Unit_Code]){$check = "selected";}else{$check = "";}
																		?>
																		<option value="<?=$row_in[Unit_Code]?>" <?=$check?>><?=$row_in[Unit_Code]?> : <?=$row_in[Unit_ThName]?></option>
																		<?php
																			}
																		?>
																	</select> 
																</td>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Buy_Amount" value="<?=$row_3[SellProduct_Buy_Amount]?>" required> </td>
																<td> <?=$row[Unit_ThName]?> </td>
																<th> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Cost" value="<?=$row_3[SellProduct_Cost]?>" required> </th>
																<td> <input type="text" class="form-control input-sm input-xsmall" name="SellProduct_Weigh" value="<?=$row_3[SellProduct_Weigh]?>" required> </td>
																<td>
																	<button type="submit" class="btn blue btn-sm">Submit</button>
																</td>
															</tr>
														</form>
													<?php
														}
													?>
													<?php
														$sql_2 = "SELECT * FROM fs_sell_product 
																LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
																WHERE fs_sell_product.Product_Code = '$row[Product_Code]'";
														$result_2 = mysqli_query($conn, $sql_2);
														if(mysqli_num_rows($result_2) > 0) {
															while($row_2 = mysqli_fetch_assoc($result_2)) {
													?>
														<tr>
															<td> <?=$row_2[SellProduct_Code]?> </td>
															<td> <?=$row_2[SellProduct_ThName]?> </td>
															<td> <?=$row_2[SellProduct_Amount]?> </td>
															<td> <?=$row_2[Unit_ThName]?> </td>
															<td> <?=$row_2[SellProduct_Buy_Amount]?> </td>
															<td> <?=$row[Unit_ThName]?> </td>
															<td> <?=$row_2[SellProduct_Cost]?> </td>
															<td> <?=$row_2[SellProduct_Weigh]?> </td>
															<td>
																<a href="edit_sellproduct.php?id=<?=$_GET[id]?>&sellid=<?=$row_2[SellProduct_Id]?>" class="btn btn-circle btn-xs blue"><i class="glyphicon glyphicon-pencil"></i> Edit </a>
																<a href="edit_sellproduct.php?id=<?=$_GET[id]?>&sellid=<?=$row_2[SellProduct_Id]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
															</td>
														</tr>
													<?php
															$i++;
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
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
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