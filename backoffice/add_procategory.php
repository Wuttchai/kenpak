<?php
$page = "pmg01";
$page_name = "Add Product Category.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_productcategory WHERE ProductCategory_Code = '$_POST[ProductCategory_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		echo $sql = "INSERT INTO fs_productcategory (ProductCategory_Code, ProductCategory_ThName, ProductCategory_EnName, ProductCategory_Remark) 
				VALUES ('$_POST[ProductCategory_Code]', '$_POST[ProductCategory_ThName]', '$_POST[ProductCategory_EnName]', '$_POST[ProductCategory_Comment]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		exit();
		header('Location: list_procategory.php?page=1');
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
                                        <form role="form" action="add_procategory.php" method="post">
										<input type="hidden" name="method" value="1">
											<div class="form-group">
												<label>Product Category Code</label>
												<input type="text" class="form-control input-sm" maxlength="3" name="ProductCategory_Code" required>
											</div>
											<div class="form-group">
												<label>Product Category Thai Name</label>
												<input type="text" class="form-control input-sm" name="ProductCategory_ThName" required>
											</div>
											<div class="form-group">
												<label>Product Category English Name</label>
												<input type="text" class="form-control input-sm" name="ProductCategory_EnName">
											</div>
											<div class="form-group">
												<label>Product Category Comment</label>
												<input type="text" class="form-control input-sm" name="ProductCategory_Comment">
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <button type="button" class="btn default btn-sm" onclick="window.location.replace('list_procategory.php?page=1');">Cancel</button>
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