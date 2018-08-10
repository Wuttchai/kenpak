<?php
$page = "fmg02";
$page_name = "Confirm Payment.";
$page_rows = 50;

include "config/connect.php";

if($_GET[id]!="" AND $_GET[status]!=""){
	if($_GET[status]=="co"){
		$sql = "UPDATE fs_orders SET Order_Status = '4' WHERE Orders_Id = '$_GET[id]'";
	}
	if($_GET[status]=="re"){
		$sql = "UPDATE fs_orders SET Order_Status = '6' WHERE Orders_Id = '$_GET[id]'";
	}
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_confirm.php?page=1');
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
											<!--<a href="add_customer.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a>-->
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
									<form action="<?=$_SERVER["PHP_SELF"]?>" method="get">
									<input type="hidden" name="page" value="1">
										<div class="input-group input-group-sm">
											<input type="text" name="text" class="form-control" placeholder="Search for..." value="<?=$_GET[text]?>">
											<span class="input-group-btn">
												<button class="btn green" type="submit">Search</button>
											</span>
										</div>
									</form>
										<?php
											$i = 1;
											$sql = "SELECT * FROM fs_orders 
													WHERE 1=1 AND Order_Status like '2' ";
											if($_GET[text]!=""){
												$sql .= " AND (Customer_Code like '%$_GET[text]%' 
														OR Customer_Name like '%$_GET[text]%' 
														OR Customer_Email like '%$_GET[text]%' 
														OR Customer_Username like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;
											
											$sql .= " ORDER BY Orders_Id ASC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);
											
											
										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Orders# </th>
														<th> Orders Price </th>
														<th> Payment Bank </th>
														<th> Payment Date </th>
														<th> Payment </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
															
															$total = 0;
															$sql_2 = "SELECT * FROM fs_orders_detail WHERE Orders_Id like '$row[Orders_Id]'";
															$query_2 = mysqli_query($conn, $sql_2);
															while($row_2 = mysqli_fetch_array($query_2)){
																$total = $total+$row_2[Ordersde_Price];
															}
															$total = $total+$row[Orders_Delivery_Price];
												?>
													<tr>
														<td> <a href="orderdetail.php?id=<?=$row[Orders_Id]?>"><?=$row[Orders_Id]?></a> </td>
														<td> <?=number_format($total,2)?> </td>
														<td> <?=$row[Orders_PaymentBank]?> </td>
														<td> <?=$row[Orders_PaymentDate]?> <?=$row[Orders_PaymentTime]?></td>
														<td> <?=number_format($row[Orders_PaymentTransfer],2)?> </td>
														<td>
															<a href="../doc_transfer/<?=$row[Orders_PaymentDoc]?>" target="_blank" class="btn btn-circle btn-xs blue"> File </a> | 
															<a href="list_confirm.php?id=<?=$row[Orders_Id]?>&status=co" class="btn btn-circle btn-xs green" onclick="return confirm('Are you sure Confirm?');"> Confirm </a>
															<a href="list_confirm.php?id=<?=$row[Orders_Id]?>&status=re" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure Reject?');"> Reject </a>
														</td>
													</tr>
												<?php
														$i++;
														}
													}else{
														echo "<tr>";
														echo "<td colspan='6'>0 results</td>";
														echo "</tr>";
													}
												?>
												</tbody>
											</table>
										</div>
										<?php include "page_number.php";?>
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