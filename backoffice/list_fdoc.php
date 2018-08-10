<?php
$page = "fmg03";
$page_name = "Finance Documents.";
$page_rows = 50;

include "config/connect.php";

$sql = "UPDATE fs_orders SET Order_Status = '6' WHERE Orders_S_Date < '".date("Y-m-d")."' AND Order_Status <= 2";
$query = mysqli_query($conn, $sql);
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
									<!--<form action="download_marketreport.php" method="get" target="_balnk">-->
									<form action="download_substitute.php" method="get" target="_blank">
									<input type="hidden" name="page" value="1">
										<div class="form-group">
											<label>กรุณาเลือกวันที่ซื้อของ</label>
											<input type="date" name="ddate" class="form-control" value="<?=date("Y-m-d")?>">
										</div>
										<div class="form-group">
											<label>กรุณาเลือกประเภทเอกสาร</label>
											<select class="form-control input-sm" name="doc_type">
												<option value="1">ใบรับรองแทนใบเสร็จรับเงิน</option>
											</select>
										</div>
										<div class="form-actions">
											<button type="submit" class="btn blue btn-sm">Submit</button>
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