<?php
$page = "csy02";
$page_name = "Add Submenu.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_sys_submenu WHERE Submenu_Code = '$_POST[Submenu_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_sys_submenu (Submenu_Code, Submenu_Name, Submenu_Link, Submenu_Order, Submenu_Status, Mainmenu_Code, Submenu_Permission) 
				VALUES ('$_POST[Submenu_Code]', '$_POST[Submenu_Name]', '$_POST[Submenu_Link]', '$_POST[Submenu_Order]', '$_POST[Submenu_Status]', '$_POST[Mainmenu_Code]', '$_POST[Submenu_Permission]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_submenu.php?page=1');
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
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										<input type="hidden" name="method" value="1">
											<div class="form-group">
												<label>Under Mainmenu</label>
												<select class="form-control input-sm" name="Mainmenu_Code" required>
													<option value="">Select Mainmenu</option>
													<?php 
														$sql = "SELECT * FROM fs_sys_mainmenu WHERE Mainmenu_Type = '2' AND Mainmenu_Status = '1'";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[Mainmenu_Code]?>"><?=$row[Mainmenu_Name]?> (<?=$row[Mainmenu_Code]?>)</option>
													<?php 
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Submenu Code</label>
												<input type="text" class="form-control input-sm" maxlength="5" name="Submenu_Code" required>
											</div>
											<div class="form-group">
												<label>Submenu Name</label>
												<input type="text" class="form-control input-sm" name="Submenu_Name" required>
											</div>
											<div class="form-group">
												<label>Submenu Link</label>
												<input type="text" class="form-control input-sm" name="Submenu_Link">
											</div>
											<div class="form-group">
												<label>Submenu Order</label>
												<input type="number" class="form-control input-sm" name="Submenu_Order">
											</div>
											<div class="form-group">
												<label>Submenu Status</label>
												<select class="form-control input-sm" name="Submenu_Status">
													<option value="">Select Status</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
											<div class="form-group">
												<label>Submenu Permission</label>
												<select class="form-control input-sm" name="Submenu_Permission">
													<option value="">Select Status</option>
													<option value="employer">employer</option>
													<option value="customer">customer</option>
													<option value="supplier">supplier</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_submenu.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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