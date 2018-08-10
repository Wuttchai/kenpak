<?php
$page = "csy03";
$page_name = "Add Province.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_sys_province WHERE Province_Code = '$_POST[Province_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_sys_province (Province_Code, Province_Name, Province_Status) 
				VALUES ('$_POST[Province_Code]', '$_POST[Province_Name]', '$_POST[Province_Status]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_province.php?page=1');
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
												<label>Province Code</label>
												<input type="text" class="form-control input-sm" maxlength="2" name="Province_Code" required>
											</div>
											<div class="form-group">
												<label>Province Name</label>
												<input type="text" class="form-control input-sm" name="Province_Name" required>
											</div>
											<div class="form-group">
												<label>Province Status</label>
												<select class="form-control input-sm" name="Province_Status">
													<option value="">Select Status</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_province.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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