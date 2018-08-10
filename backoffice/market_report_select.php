<?php
$page = "ord02";
$page_name = "Market Control Document.";
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
      <?php include "menu.php";?>
      <?php include "topmenu.php";?>

      <div class="content-wrap">
          <div class="main">
              <div class="container-fluid">
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
									<form action="market_report_select.php" method="post">
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
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
						<?php
							if($_POST[ddate]!=""){
							$i = 1;
							$sql = "SELECT * FROM fs_orders
									LEFT JOIN fs_customer ON fs_orders.Customer_Id = fs_customer.Customer_Id
									WHERE fs_orders.Orders_S_Date = '$_POST[ddate]'  AND fs_orders.Order_Status like '4'";
							$result = mysqli_query($conn, $sql);

						?>

						<div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
										<form action="download_marketreport.php" method="get" target="_balnk" id="my-form" onsubmit="setTimeout('parent.location.reload()',500); return true;">
										<input type="hidden" name="ddate" value="<?=$_POST[ddate]?>">
										<input type="hidden" name="method" value="1">
											รายการสั่งซื้อรอตัดรอบ
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th> Orders# </th>
															<th> Customer Name </th>
															<th> Create Date </th>
															<th> Payment Type </th>
															<th> Order Status </th>
															<th>  </th>
														</tr>
													</thead>
													<tbody>
													<?php
														if(mysqli_num_rows($result) > 0) {
															while($row = mysqli_fetch_assoc($result)) {
																if($row[Orders_PaymentType]=="1"){$payment_text = "เครดิตเทอม";}
																else if($row[Orders_PaymentType]=="2"){$payment_text = "จ่ายเต็ม";}
																else if($row[Orders_PaymentType]=="3"){$payment_text = "จ่ายครึ่ง";}
																else if($row[Orders_PaymentType]=="4"){$payment_text = "เก็บเงินปลายทาง";}

																if($row[Order_Status]=="0"){$text_status = "รอชำระเงิน";}
																elseif($row[Order_Status]=="2"){$text_status = "รอยืนยันการชำระเงิน";}
																elseif($row[Order_Status]=="4"){$text_status = "สั่งซื้อเรียบร้อย";}
																elseif($row[Order_Status]=="6"){$text_status = "ยกเลิกการสั่งซื้อ";}
													?>
														<tr>
															<td> <label class="mt-checkbox mt-checkbox-outline"> <?=$row[Orders_Id]?> <input type="checkbox" value="1" name="o_<?=$row[Orders_Id]?>" checked><span></span></label> </td>
															<td> <?=$row[Customer_Name]?> </td>
															<td> <?=$row[Orders_CreateTime]?> </td>
															<td> <?=$payment_text?> </td>
															<td> <?=$text_status?> </td>
															<td>  </td>
														</tr>
													<?php
															}
														}else{
															echo "<tr>";
															echo "<td colspan='6'>0 results</td>";
															echo "</tr>";
														}
													?>
													</tbody>
												</table>
												<div class="form-group">
													<label>Market Cutoff</label>
													<select class="form-control input-sm" name="Cutoff">
														<option value="">New Cutoff</option>
														<?php
															$j = 1;
															$sql = "SELECT DISTINCT(Orders_Date_Cutoff) FROM fs_orders WHERE Orders_Date_Cutoff != '' AND Orders_S_Date = '$_POST[ddate]'";
															$result = mysqli_query($conn, $sql);
															while($row = mysqli_fetch_assoc($result)) {
														?>
														<option value="<?=$row[Orders_Date_Cutoff]?>"> รอบที่ <?=$j?> : <?=$row[Orders_Date_Cutoff]?></option>
														<?php
															$j++;
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label>Document Type</label>
													<select class="form-control input-sm" name="doc_type">
														<option value="1">ใบคุมสั่งซื้อตลาด</option>
														<option value="2">ใบคุมสต๊อคสินค้า</option>
														<option value="3">ใบคุมเต็มรูปแบบ (สต๊อคและตลาด)</option>
													</select>
												</div>
												<div class="form-actions">
													<button type="submit" class="btn blue btn-sm">Submit</button>
												</div>
											</div>
										</form>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
						<?php
							}
						?>
            
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
