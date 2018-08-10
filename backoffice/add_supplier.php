<?php
$page = "umg03";
$page_name = "Add Supplier.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_supplier WHERE Supplier_Code = '$_POST[Supplier_Code]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_supplier (Supplier_Code, Supplier_Name, Supplier_Username, Supplier_Password, Supplier_Tel, Supplier_Status, Market_Id) 
				VALUES ('$_POST[Supplier_Code]', '$_POST[Supplier_Name]', '$_POST[Supplier_Username]', '$_POST[Supplier_Password]', '$_POST[Supplier_Tel]', '$_POST[Supplier_Status]', '$_POST[Market_Id]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_supplier.php?page=1');
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
												<label>Supplier Code</label>
												<input type="text" class="form-control input-sm" maxlength="10" name="Supplier_Code" required>
											</div>
											<div class="form-group">
												<label>Supplier Name</label>
												<input type="text" class="form-control input-sm" name="Supplier_Name" required>
											</div>
											<div class="form-group">
												<label>Supplier Username</label>
												<input type="text" class="form-control input-sm" name="Supplier_Username" required>
											</div>
											<div class="form-group">
												<label>Supplier Password</label>
												<input type="password" class="form-control input-sm" name="Supplier_Password" required>
											</div>
											<div class="form-group">
												<label>Supplier Tel</label>
												<input type="text" class="form-control input-sm" name="Supplier_Tel">
											</div>
											<div class="form-group">
												<label>Market</label>
												<select class="form-control input-sm" name="Market_Id" required>
													<option value="">- Select -</option>
													<?php 
														$sql = "SELECT * FROM fs_sys_market WHERE Market_Status = '1'";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[Market_Id]?>"><?=$row[Market_Code]?> : <?=$row[Market_Name]?></option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Supplier Status</label>
												<select class="form-control input-sm" name="Supplier_Status" required>
													<option value="">- Select -</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_supplier.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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