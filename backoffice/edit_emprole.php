<?php
$page = "umg04";
$page_name = "Edit Employer Role.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_employer_role WHERE Emprole_Name = '$_POST[Emprole_Name]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0 OR $_POST[Old_Code]==$_POST[Emprole_Name]){
		$sql = "INSERT INTO fs_employer_role (Emprole_Name, Emprole_Status) 
				VALUES ('$_POST[Emprole_Name]', '$_POST[Emprole_Status]')";
		$sql = "UPDATE fs_employer_role SET 
				Emprole_Name = '$_POST[Emprole_Name]', 
				Emprole_Status = '$_POST[Emprole_Status]'  
				WHERE Emprole_Id like '$_POST[Emprole_Id]'";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_emprole.php?page=1');
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code นี้มีอยู่แล้ว\")); </script>";
	}
}

$sql = "SELECT * FROM fs_employer_role WHERE Emprole_Id = '$_GET[id]'";
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
										<input type="hidden" name="Emprole_Id" value="<?=$row[Emprole_Id]?>">
										<input type="hidden" name="Old_Code" value="<?=$row[Emprole_Name]?>">
											<div class="form-group">
												<label>Employer Role Name</label>
												<input type="text" class="form-control input-sm" name="Emprole_Name"  value="<?=$row[Emprole_Name]?>" required>
											</div>
											<div class="form-group">
												<label>Employer Role Status</label>
												<select class="form-control input-sm" name="Emprole_Status" required>
													<option value="">Select Status</option>
													<option value="1" <?php if($row[Emprole_Status]=="1"){echo "selected";}?>>Enable</option>
													<option value="0" <?php if($row[Emprole_Status]=="0"){echo "selected";}?>>Disable</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_emprole.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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