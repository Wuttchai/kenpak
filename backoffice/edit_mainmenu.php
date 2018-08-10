<?php
$page = "csy01";
$page_name = "Edit Mainmenu.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_sys_mainmenu WHERE Mainmenu_Code = '$_POST[Mainmenu_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0 OR $_POST[Old_Code]==$_POST[Mainmenu_Code]){
		$sql = "UPDATE fs_sys_mainmenu SET 
				Mainmenu_Code = '$_POST[Mainmenu_Code]', 
				Mainmenu_Name = '$_POST[Mainmenu_Name]', 
				Mainmenu_Link = '$_POST[Mainmenu_Link]', 
				Mainmenu_FontIcon = '$_POST[Mainmenu_FontIcon]', 
				Mainmenu_Group = '$_POST[Mainmenu_Group]', 
				Mainmenu_Type = '$_POST[Mainmenu_Type]', 
				Mainmenu_Order = '$_POST[Mainmenu_Order]', 
				Mainmenu_Status = '$_POST[Mainmenu_Status]' 
				WHERE Mainmenu_Id like '$_POST[Mainmenu_Id]'";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_mainmenu.php?page=1');
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code นี้มีอยู่แล้ว\")); </script>";
	}
}

$sql = "SELECT * FROM fs_sys_mainmenu WHERE Mainmenu_Id = '$_GET[id]'";
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
										<input type="hidden" name="Mainmenu_Id" value="<?=$row[Mainmenu_Id]?>">
										<input type="hidden" name="Old_Code" value="<?=$row[Mainmenu_Code]?>">
											<div class="form-group">
												<label>Mainmenu Code</label>
												<input type="text" class="form-control input-sm" maxlength="3" name="Mainmenu_Code" value="<?=$row[Mainmenu_Code]?>" required>
											</div>
											<div class="form-group">
												<label>Mainmenu Name</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_Name" value="<?=$row[Mainmenu_Name]?>" required>
											</div>
											<div class="form-group">
												<label>Mainmenu Link</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_Link" value="<?=$row[Mainmenu_Link]?>">
											</div>
											<div class="form-group">
												<label>Mainmenu FontIcon</label>
												<input type="text" class="form-control input-sm" name="Mainmenu_FontIcon" value="<?=$row[Mainmenu_FontIcon]?>">
											</div>
											<div class="form-group">
												<label>Mainmenu Group</label>
												<select class="form-control input-sm" name="Mainmenu_Group" required>
													<option value="">Select Group</option>
													<option value="Dashboard" <?php if($row[Mainmenu_Group]=="Dashboard"){echo "selected";}?>>Dashboard</option>
													<option value="Menu" <?php if($row[Mainmenu_Group]=="Menu"){echo "selected";}?>>Menu</option>
												</select>
											</div>
											<div class="form-group">
												<label>Mainmenu Type</label>
												<select class="form-control input-sm" name="Mainmenu_Type" required>
													<option value="">Select Type</option>
													<option value="1" <?php if($row[Mainmenu_Type]=="1"){echo "selected";}?>>ไม่มีเมนูย่อย</option>
													<option value="2" <?php if($row[Mainmenu_Type]=="2"){echo "selected";}?>>มีเมนูย่อย</option>
												</select>
											</div>
											<div class="form-group">
												<label>Mainmenu Order</label>
												<input type="number" class="form-control input-sm" name="Mainmenu_Order" value="<?=$row[Mainmenu_Order]?>">
											</div>
											<div class="form-group">
												<label>Mainmenu Status</label>
												<select class="form-control input-sm" name="Mainmenu_Status">
													<option value="">Select Status</option>
													<option value="1" <?php if($row[Mainmenu_Status]=="1"){echo "selected";}?>>Enable</option>
													<option value="0" <?php if($row[Mainmenu_Status]=="0"){echo "selected";}?>>Disable</option>
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