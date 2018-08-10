<?php
$page = "das01";
$page_name = "Dashboard.";

include "config/connect.php";

$sql = "SELECT COUNT(*) AS num_cus FROM fs_customer";
$result = mysqli_query($conn, $sql);
$row_das1 = mysqli_fetch_assoc($result);

$total_date = 0;
$sql = "SELECT * FROM fs_orders WHERE SUBSTRING(Orders_CreateTime,1,10) = CURDATE() AND order_status = 4";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row_das2 = mysqli_fetch_assoc($result)) {
		$sql_1 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row_das2[Orders_Id]'";
		$result_1 = mysqli_query($conn, $sql_1);
		while($row_das2_1 = mysqli_fetch_assoc($result_1)) {
			$total_date = $total_date+$row_das2_1[Ordersde_Amount]*$row_das2_1[Ordersde_Price];
		}
	}
}

$total_M = 0;
$sql = "SELECT * FROM fs_orders WHERE SUBSTRING(Orders_CreateTime,1,7) = '".date("Y-m")."' AND order_status = 4";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row_das2 = mysqli_fetch_assoc($result)) {
		$sql_1 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row_das2[Orders_Id]'";
		$result_1 = mysqli_query($conn, $sql_1);
		while($row_das2_1 = mysqli_fetch_assoc($result_1)) {
			$total_M = $total_M+$row_das2_1[Ordersde_Amount]*$row_das2_1[Ordersde_Price];
		}
	}
}

$total_all =0;
$sql = "SELECT * FROM fs_orders WHERE order_status = 4";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row_das2 = mysqli_fetch_assoc($result)) {
		$sql_1 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row_das2[Orders_Id]'";
		$result_1 = mysqli_query($conn, $sql_1);
		while($row_das2_1 = mysqli_fetch_assoc($result_1)) {
			$total_all = $total_all+$row_das2_1[Ordersde_Amount]*$row_das2_1[Ordersde_Price];
		}
	}
}
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
	</head>
    <!-- END HEAD -->

    <body >
			<?php include "menu.php";?>
      <?php include "topmenu.php";?>



			<div class="content-wrap">

					<div class="main">
							<div class="container-fluid">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
						<div class="row">
														<div class="col-lg-3">
										                                <div class="card">
										                                    <div class="stat-widget-two">
										                                        <div class="stat-content">
										                                            <div class="stat-text">จำนวนลูกค้า </div>
										                                            <div class="stat-digit" data-value="<?=$row_das1[num_cus]?>"><?php echo (isset($row_das1[num_cus]) ? $row_das1[num_cus] : 0); ?> คน </div>
										                                        </div>
										                                        <div class="progress">
										                                            <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
										                                        </div>
										                                    </div>
										                                </div>
										                            </div>
					        	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="card">
													<div class="stat-widget-two">
															<div class="stat-content">
																	<div class="stat-text">ยอดขายประจำวัน </div>
																	<div class="stat-digit" data-value="<?php echo number_format($total_date,2); ?>"><?php echo (isset($total_date) ? number_format($total_date,2) : 0); ?> บาท </div>
															</div>
															<div class="progress">
																	<div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
													</div>
											</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="card">
												<div class="stat-widget-two">
														<div class="stat-content">
																<div class="stat-text">ยอดขายประจำเดือน </div>
																<div class="stat-digit" data-value="<?php echo number_format($total_M,2); ?>"><?php echo (isset($total_M) ? number_format($total_M,2) : 0); ?> บาท </div>
														</div>
														<div class="progress">
																<div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
												</div>
										</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="card">
											<div class="stat-widget-two">
													<div class="stat-content">
															<div class="stat-text">ยอดขายตั้งแต่วันแรก </div>
															<div class="stat-digit" data-value="<?php echo number_format($total_all,2); ?>"><?php echo (isset($total_all) ? number_format($total_all,2) : 0); ?> บาท </div>
													</div>
													<div class="progress">
															<div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
											</div>
									</div>
							</div>
                        </div>
						<div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue-steel" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php $D = date("d"); echo number_format(($total_M/$D),2); ?>">0</span>
                                        </div>
                                        <div class="desc"> เฉลี่ยยอดขายรายเดือน/วัน </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue-steel" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php $sum_orderM = $thaiweek_m[0]["Count_OrderM"]+$thaiweek_m[1]["Count_OrderM"]+$thaiweek_m[2]["Count_OrderM"]+$thaiweek_m[3]["Count_OrderM"]+$thaiweek_m[4]["Count_OrderM"]+$thaiweek_m[5]["Count_OrderM"]+$thaiweek_m[6]["Count_OrderM"]; echo number_format(($sum_orderM/$D),2); ?>">0</span></div>
                                        <div class="desc"> เฉลี่ยจำนวน Order รายเดือน/วัน </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue-dark" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php $YtoD = date("z"); echo number_format(($total_Y/$YtoD),2); ?>">0</span>
                                        </div>
                                        <div class="desc"> เฉลี่ยยอดขายรายปี/วัน  </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue-dark" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="<?php $sum_orderY = $thaiweek_m[0]["Count_OrderY"]+$thaiweek_m[1]["Count_OrderY"]+$thaiweek_m[2]["Count_OrderY"]+$thaiweek_m[3]["Count_OrderY"]+$thaiweek_m[4]["Count_OrderY"]+$thaiweek_m[5]["Count_OrderY"]+$thaiweek_m[6]["Count_OrderY"]; echo number_format(($sum_orderY/$YtoD),2); ?>"></span></div>
                                        <div class="desc"> เฉลี่ยจำนวน Order รายปี/วัน  </div>
                                    </div>
                                </a>
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
		<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>
