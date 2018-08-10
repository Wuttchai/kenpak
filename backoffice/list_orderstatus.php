<?php
$page = "fmg01";
$page_name = "Orders List.";
$page_rows = 50;

include "config/connect.php";
if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_customer WHERE Customer_Id = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_customer.php?page='.$_GET[page]);
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
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a> -->
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
													LEFT JOIN fs_customer ON fs_orders.Customer_Id = fs_customer.Customer_Id 
													WHERE 1=1 AND Order_Status like '4'";
											if($_GET[text]!=""){
												$sql .= " AND (Orders_Id like '%$_GET[text]%' 
														OR Customer_Name like '%$_GET[text]%' 
														OR Orders_CreateTime like '%$_GET[text]%' 
														OR Orders_S_Date like '%$_GET[text]%' 
														OR Order_Status like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;
											
											$sql .= " ORDER BY Orders_CreateTime DESC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);
											
											
										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Orders# </th>
														<th> Customer Name </th>
														<th> Create Date </th>
														<th> Delivery Date </th>
														<th> Barcode Order# </th>
														<th> Barcode Receiving# </th>
														<th> Barcode Loading Out# </th>
														<th> Barcode Delivered# </th>
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
														
														$sql_2 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row[Orders_Id]'";
														$result_2 = mysqli_query($conn, $sql_2);
														$inorder = mysqli_num_rows($result_2);
														
														$sql_3 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row[Orders_Id]' AND Ordersde_Flag = '1'";
														$result_3 = mysqli_query($conn, $sql_3);
														$instore = mysqli_num_rows($result_3);
														
														$sql_4 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row[Orders_Id]' AND Ordersde_Flag = '2'";
														$result_4 = mysqli_query($conn, $sql_4);
														$invan = mysqli_num_rows($result_4);
														
														$sql_5 = "SELECT * FROM fs_orders_detail WHERE Orders_Id = '$row[Orders_Id]' AND Ordersde_Flag = '4'";
														$result_5 = mysqli_query($conn, $sql_5);
														$incomplate = mysqli_num_rows($result_5);
												?>
													<tr>
														<td> <a href="orderdetail.php?id=<?=$row[Orders_Id]?>"><?=$row[Orders_Id]?></a> </td>
														<td> <?=$row[Customer_Name]?> </td>
														<td> <?=$row[Orders_CreateTime]?> </td>
														<td> <?=$row[Orders_S_Date]?> </td>
														<td> <?=$inorder?> </td>
														<td> <?=$instore?> </td>
														<td> <?=$invan?> </td>
														<td> <?=$incomplate?> </td>
														<td>
															<a href="download_invoice.php?id=<?=$row[Orders_Id]?>&page=1" class="btn btn-circle btn-xs blue-chambray" target="_blank"><i class="glyphicon glyphicon-pencil"></i> Print Invoice </a>
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