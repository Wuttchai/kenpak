<?php
$page = "lmg02";
$page_name = "Edit Delivery Cost.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql = "UPDATE fs_delivery_cost SET 
			Delivery_Cost_Name = '$_POST[Delivery_Cost_Name]', 
			Delivery_Cost = '$_POST[Delivery_Cost]' 
			WHERE Delivery_Cost_Id like '$_POST[Delivery_Cost_Id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_deliverycost.php?page=1');
}

$sql = "SELECT * FROM fs_delivery_cost WHERE Delivery_Cost_Id = '$_GET[id]'";
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
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										<input type="hidden" name="method" value="1">
										<input type="hidden" name="Delivery_Cost_Id" value="<?=$row[Delivery_Cost_Id]?>">
											<div class="form-group">
												<label>Delivery Name</label>
												<input type="text" class="form-control input-sm" name="Delivery_Cost_Name" value="<?=$row[Delivery_Cost_Name]?>" required>
											</div>
											<div class="form-group">
												<label>Delivery Cost</label>
												<input type="text" class="form-control input-sm" name="Delivery_Cost" value="<?=$row[Delivery_Cost]?>" required>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_deliverycost.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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