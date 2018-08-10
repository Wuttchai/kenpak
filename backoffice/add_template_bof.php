<?php
$page = "umg02";
$page_name = "Add Template Orders.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql = "INSERT INTO fs_template (Template_Name, Template_Detail, Template_Status, Customer_Id, Template_CreateBy) 
			VALUES ('$_POST[Template_Name]', '$_POST[Template_Detail]', '$_POST[Template_Status]', '$_POST[Customer_Id]', 'backoffice')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_template_bof.php?page=1&id='.$_POST[id]);
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
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										<input type="hidden" name="method" value="1">
										<input type="hidden" name="Customer_Id" value="<?=$_GET[id]?>">
										<input type="hidden" name="id" value="<?=$_GET[id]?>">
											<div class="form-group">
												<label>Template Name</label>
												<input type="text" class="form-control input-sm" name="Template_Name" required>
											</div>
											<div class="form-group">
												<label>Template Detail</label>
												<input type="text" class="form-control input-sm" name="Template_Detail">
											</div>
											<div class="form-group">
												<label>Template Status</label>
												<select class="form-control input-sm" name="Template_Status">
													<option value="">Select Status</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_template_bof.php?id=<?=$_GET[id]?>&page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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