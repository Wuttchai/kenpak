<?php
$page = "pmg02";
$page_name = "Add Buy Product.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_product WHERE Product_Code = '$_POST[Product_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		if($_FILES["fileToUpload"]["name"]!="") {
			$target_dir = "img_pro/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$new_name = $target_dir . $_POST[Product_Code].".".strtolower($imageFileType);
			
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
			}

			if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
			&& strtolower($imageFileType) != "gif" ) {
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "<script> window.history.back(alert(\"ไม่สามารถ อัพรูปภาพได้\")); </script>";
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_name)) {
					$sql = "INSERT INTO fs_product (Product_Code, Product_ThName, Product_EnName, Product_Image, ProductCategory_Code, Market_Product_Amount, Unit_Code, Product_Cost, Product_Weigh, Product_Vat, Product_ScrapStatus, Supplier_Id) 
					VALUES ('$_POST[Product_Code]', '$_POST[Product_ThName]', '$_POST[Product_EnName]', '$new_name', '$_POST[ProductCategory_Code]', '$_POST[Market_Product_Amount]', '$_POST[Unit_Code]', '$_POST[Product_Cost]', '$_POST[Product_Weigh]', '$_POST[Product_Vat]', '$_POST[Product_ScrapStatus]', '$_POST[Supplier_Id]')";
					mysqli_query($conn, $sql);
					mysqli_close($conn);
					header('Location: list_buyproduct.php?page=1');
				} else {
					echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มข้อมูลได้\")); </script>";
				}
			}
		}else{	
			$sql = "INSERT INTO fs_product (Product_Code, Product_ThName, Product_EnName, Product_Image, ProductCategory_Code, Market_Product_Amount, Unit_Code, Product_Cost, Product_Weigh, Product_Vat, Product_ScrapStatus, Supplier_Id) 
					VALUES ('$_POST[Product_Code]', '$_POST[Product_ThName]', '$_POST[Product_EnName]', '', '$_POST[ProductCategory_Code]', '$_POST[Market_Product_Amount]', '$_POST[Unit_Code]', '$_POST[Product_Cost]', '$_POST[Product_Weigh]', '$_POST[Product_Vat]', '$_POST[Product_ScrapStatus]', '$_POST[Supplier_Id]')";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: list_buyproduct.php?page=1');
		}
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code นี้มีอยู่แล้ว\")); </script>";
	}
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
											<div class="form-group">
												<label>Product Code</label>
												<input type="text" class="form-control input-sm" maxlength="10" name="Product_Code">
											</div>
											<div class="form-group">
												<label>Thai Product Name</label>
												<input type="text" class="form-control input-sm" name="Product_ThName">
											</div>
											<div class="form-group">
												<label>English Product Name</label>
												<input type="text" class="form-control input-sm" name="Product_EnName">
											</div>
											<div class="form-group">
												<label>Product Image</label>
												<input type="file" class="form-control input-sm" name="fileToUpload">
											</div>
											<div class="form-group">
												<label>Product Category</label>
												<select class="form-control input-sm" name="ProductCategory_Code">
													<option value="">Select Category</option>
													<?php 
														$sql = "SELECT * FROM fs_productcategory";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[ProductCategory_Code]?>"><?=$row[ProductCategory_Code]?> : <?=$row[ProductCategory_ThName]?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Market Product Amount</label>
												<input type="number" class="form-control input-sm" name="Market_Product_Amount">
											</div>
											<div class="form-group">
												<label>Market Product Unit</label>
												<select class="form-control input-sm" name="Unit_Code">
													<option value="">Select Unit</option>
													<?php 
														$sql = "SELECT * FROM fs_unit";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[Unit_Code]?>"><?=$row[Unit_Code]?> : <?=$row[Unit_ThName]?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Product Cost (฿) / Unit</label>
												<input type="number" class="form-control input-sm" name="Product_Cost">
											</div>
											<div class="form-group">
												<label>Product Weigh (g.) / Unit</label>
												<input type="number" class="form-control input-sm" name="Product_Weigh">
											</div>
											<div class="form-group">
												<label>Product Vat</label>
												<select class="form-control input-sm" name="Product_Vat">
													<option value="">Select Vat</option>
													<option value="0">Non Vat</option>
													<option value="1">Include Vat</option>
												</select>
											</div>
											<div class="form-group">
												<label>Product Scraps Status</label>
												<div class="mt-checkbox-list">
													<label class="mt-checkbox mt-checkbox-outline"> Scraps
														<input type="checkbox" name="Product_ScrapStatus" value="1" name="test">
														<span></span>
													</label>
												</div>
											</div>
											<div class="form-group">
												<label>Supplier</label>
												<select class="form-control input-sm" name="Supplier_Id">
													<option value="">Select Unit</option>
													<?php 
														$sql = "SELECT * FROM fs_supplier";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[Supplier_Id]?>"><?=$row[Supplier_Code]?> : <?=$row[Supplier_Name]?></option>
													<?php
														}
													?>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_buyproduct.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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