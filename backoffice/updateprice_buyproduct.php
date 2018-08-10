<?php
$page = "upl02";
$page_name = "Update Product Price.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql = "UPDATE fs_product SET 
			Market_Product_Amount = '$_POST[Market_Product_Amount]', 
			Unit_Code = '$_POST[Unit_Code]', 
			Product_Cost = '$_POST[Product_Cost]', 
			Product_Weigh = '$_POST[Product_Weigh]' 
			WHERE Product_Id like '$_POST[Old_Code]'";
	mysqli_query($conn, $sql);
	
	mysqli_close($conn);
	header('Location: list_updateprice.php?page=1');
}

$sql = "SELECT * FROM fs_product WHERE Product_Id = '$_GET[id]'";
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
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="method" value="1">
										<input type="hidden" name="Old_Code" value="<?=$row[Product_Id]?>">
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
												<label>Market Product Amount</label>
												<input type="number" class="form-control input-sm" name="Market_Product_Amount" value="<?=$row[Market_Product_Amount]?>">
											</div>
											<div class="form-group">
												<label>Market Product Unit</label>
												<select class="form-control input-sm" name="Unit_Code">
													<option value="">Select Unit</option>
													<?php 
														$sql_in = "SELECT * FROM fs_unit";
														$result_in = mysqli_query($conn, $sql_in);
														while($row_in = mysqli_fetch_assoc($result_in)) {
															if($row[Unit_Code]==$row_in[Unit_Code]){$check = "selected";}else{$check = "";}
													?>
													<option value="<?=$row_in[Unit_Code]?>" <?=$check?>><?=$row_in[Unit_Code]?> : <?=$row_in[Unit_ThName]?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Product Cost (฿) / Unit</label>
												<input type="number" class="form-control input-sm" name="Product_Cost" value="<?=$row[Product_Cost]?>">
											</div>
											<div class="form-group">
												<label>Product Weigh (g.) / Unit</label>
												<input type="number" class="form-control input-sm" name="Product_Weigh" value="<?=$row[Product_Weigh]?>">
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_updateprice.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
                                            </div>
                                        </form>
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