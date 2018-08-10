<?php
$page = "ord01";
$page_name = "Orders List.";
$page_rows = 50;

include "config/connect.php";
if($_GET[method]=="ch"){
	$sql = "UPDATE fs_orders SET Order_Status = '6' WHERE Orders_Id = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_orders.php?page='.$_GET[page]);
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
													WHERE 1=1";
											if($_GET[text]!=""){
												$sql .= " AND (Orders_Id like '%$_GET[text]%'
														OR Customer_Name like '%$_GET[text]%'
														OR Orders_CreateTime like '%$_GET[text]%'
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
														<th> Payment Type </th>
														<th> Payment Status </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
														if($row[Orders_PaymentType]=="1"){$payment_text = "เครดิตเทอม";}
														else if($row[Orders_PaymentType]=="2"){$payment_text = 'จ่ายเต็ม <a href="../doc_transfer/'.$row[Orders_PaymentDoc].'" target="_blank" class="btn btn-circle btn-xs blue"> File </a>';}
														else if($row[Orders_PaymentType]=="3"){$payment_text = "จ่ายครึ่ง";}
														else if($row[Orders_PaymentType]=="4"){$payment_text = "เก็บเงินปลายทาง";}

														if($row[Order_Status]=="0"){$text_status = "รอชำระเงิน";}
														elseif($row[Order_Status]=="2"){$text_status = "รอยืนยันการชำระเงิน";}
														elseif($row[Order_Status]=="4"){$text_status = "สั่งซื้อเรียบร้อย";}
														elseif($row[Order_Status]=="6"){$text_status = "ยกเลิกการสั่งซื้อ";}

														if($row[Order_Status]!="6"){
															$status_chenge = '<a href="list_orders.php?id='.$row[Orders_Id].'&method=ch&page='.$_GET[page].'" class="btn btn-circle btn-xs red" onclick="return confirm(\'Are you sure you want to Reject this Order?\');"><i class="glyphicon glyphicon-pencil"></i> Reject Order </a>';
														}else{$status_chenge = "";}
												?>
													<tr>
														<td> <a class="text-primary" href="orderdetail.php?id=<?=$row[Orders_Id]?>"><?=$row[Orders_Id]?></a> </td>
														<td> <?=$row[Customer_Name]?> </td>
														<td> <?=$row[Orders_CreateTime]?> </td>
														<td> <?=$payment_text?> </td>
														<td> <?=$text_status?> </td>
														<td>
															<?=$status_chenge;?>
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