<?php
$page = "csy01";
$page_name = "Add Mainmenu.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_sys_mainmenu WHERE Mainmenu_Code = '$_POST[Mainmenu_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_sys_mainmenu (Mainmenu_Code, Mainmenu_Name, Mainmenu_Link, Mainmenu_FontIcon, Mainmenu_Group, Mainmenu_Type, Mainmenu_Order, Mainmenu_Status, Mainmenu_Permission) 
				VALUES ('$_POST[Mainmenu_Code]', '$_POST[Mainmenu_Name]', '$_POST[Mainmenu_Link]', '$_POST[Mainmenu_FontIcon]', '$_POST[Mainmenu_Group]', '$_POST[Mainmenu_Type]', '$_POST[Mainmenu_Order]', '$_POST[Mainmenu_Status]', '$_POST[Mainmenu_Permission]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_mainmenu.php?page=1');
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
												<label>Mainmenu Code</label>
												<input type="text" class="form-control input-sm" maxlength="3" name="Mainmenu_Code" required>
											</div>
											<div class="form-group">
												<label>Mainmenu Name</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_Name" required>
											</div>
											<div class="form-group">
												<label>Mainmenu Link</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_Link">
											</div>
											<div class="form-group">
												<label>Mainmenu FontIcon</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_FontIcon">
											</div>
											<div class="form-group">
												<label>Mainmenu Group</label>
												<select class="form-control input-sm" name="Mainmenu_Group" required>
													<option value="">Select Group</option>
													<option value="Dashboard">Dashboard</option>
													<option value="Menu">Menu</option>
												</select>
											</div>
											<div class="form-group">
												<label>Mainmenu Type</label>
												<select class="form-control input-sm" name="Mainmenu_Type" required>
													<option value="">Select Type</option>
													<option value="1">ไม่มีเมนูย่อย</option>
													<option value="2">มีเมนูย่อย</option>
												</select>
											</div>
											<div class="form-group">
												<label>Mainmenu Order</label>
												<input type="number" class="form-control input-sm" name="Mainmenu_Order">
											</div>
											<div class="form-group">
												<label>Mainmenu Status</label>
												<select class="form-control input-sm" name="Mainmenu_Status">
													<option value="">Select Status</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
											<div class="form-group">
												<label>Mainmenu Permission</label>
												<select class="form-control input-sm" name="Mainmenu_Permission">
													<option value="">Select Status</option>
													<option value="employer">employer</option>
													<option value="customer">customer</option>
													<option value="supplier">supplier</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_mainmenu.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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