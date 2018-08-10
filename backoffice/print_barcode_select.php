<?php
$page = "ord03";
$page_name = "Print Barcode.";
$page_rows = 50;

include "config/connect.php";
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
										<!--<form action="print_barcode.php" method="get" target="_balnk">-->
										<form action="print_barcode_select.php" method="post">
										<input type="hidden" name="page" value="1">
											กรุณาเลือกวันส่ง
											<div class="input-group input-group-sm">
												<?php 
													if($_POST[ddate]==""){ 
														echo "<input type=\"date\" name=\"ddate\" class=\"form-control\" value=\"".date("Y-m-d", time() + 3600*24)."\">";
													} else {
														echo "<input type=\"date\" name=\"ddate\" class=\"form-control\" value=\"".$_POST[ddate]."\">";
													}
												?>
												<span class="input-group-btn">
													<button class="btn green" type="submit">Seach</button>
												</span>
											</div>
										</form>
										<hr>
										<div class="table-responsive">
											<form action="add_stockFM_script.php" method="post">
											<input type="hidden" name="fm" value="<?=$_GET[text]?>">
												<table class="table table-striped table-bordered table-hover">
												<?php
													$j = 1;
													$sql = "SELECT DISTINCT(Orders_Date_Cutoff) FROM fs_orders WHERE Orders_Date_Cutoff != '' AND Orders_S_Date = '$_POST[ddate]'";
															$result = mysqli_query($conn, $sql);
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<th colspan='3'> รอบที่ <?=$j?> : <?=$row[Orders_Date_Cutoff]?> </th>
													</tr>
													<?php 
														$i = 1;
														$sql_in = "SELECT DISTINCT(fs_orders.Customer_Id),fs_customer.Customer_Name FROM fs_orders 
																LEFT JOIN fs_customer ON fs_orders.Customer_Id = fs_customer.Customer_Id 
																WHERE fs_orders.Orders_Date_Cutoff = '$row[Orders_Date_Cutoff]'";
																$result_in = mysqli_query($conn, $sql_in);
															if(mysqli_num_rows($result_in) > 0) {
																while($row_in = mysqli_fetch_assoc($result_in)) {
													?>
													<tr>
														<td> <?=$i?> </td>
														<td> <?=$row_in[Customer_Name]?> </td>
														<td> <a href="print_barcode.php?ddate=<?=$_POST[ddate]?>&cid=<?=$row_in[Customer_Id]?>&cutoff=<?=$row[Orders_Date_Cutoff]?>" class="btn btn-circle btn-xs blue" target="_blank"><i class="glyphicon glyphicon-pencil"></i> Print Barcode </a> </td>
													</tr>
												<?php
																$i++;
																}
															}
														$j++;
														}
													}else{
														echo "<tr>";
														echo "<th colspan='3'>0 results</th>";
														echo "</tr>";
													}
												?>
												</table>
											</form>
										</div>
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