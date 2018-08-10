<?php
$page = "smg01";
$page_name = "Check In.";
$page_rows = 50;

include "config/connect.php";
if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_sys_submenu WHERE Submenu_Id = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_submenu.php?page='.$_GET[page]);
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
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase"><?=$page_name?></span> 
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
									<form action="list_check_in.php" method="get">
									<input type="hidden" name="page" value="1">
										กรุณาเลือกวันส่ง
										<div class="input-group input-group-sm">
											<input type="date" name="ddate" class="form-control" value="<?=date("Y-m-d", time() + 3600*24);?>">
											<span class="input-group-btn">
												<button class="btn green" type="submit">Submit</button>
											</span>
										</div>
									</form>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
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