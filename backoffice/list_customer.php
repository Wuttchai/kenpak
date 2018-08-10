<?php
$page = "umg02";
$page_name = "Customer List.";
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
											<a href="add_customer.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a>
											<!--<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a>
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
											$sql = "SELECT * FROM fs_customer
													WHERE 1=1";
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

											$sql .= " ORDER BY Customer_CreateDate ASC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);


										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Customer Code </th>
														<th> Customer Name </th>
														<th> Customer Email </th>
														<th> Customer Username </th>
														<th> Customer Type </th>
														<th> Create Date </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<td> <?=$row[Customer_Code]?> </td>
														<td> <?=$row[Customer_Name]?> </td>
														<td> <?=$row[Customer_Email]?> </td>
														<td> <?=$row[Customer_Username]?> </td>
														<td> <?php if($row[Customer_Type]=="1"){echo "Normal";} else if($row[Customer_Type]=="2"){echo "VIP";} ?> </td>
														<td> <?=$row[Customer_CreateDate]?> </td>
														<td>
															<a href="list_delivery_address.php?id=<?=$row[Customer_Id]?>&page=1" class="btn btn-circle btn-xs blue-chambray"><i class="glyphicon glyphicon-pencil"></i> Set Address </a>
															<a href="list_template_bof.php?id=<?=$row[Customer_Id]?>&page=1" class="btn btn-circle btn-xs blue-chambray"><i class="glyphicon glyphicon-pencil"></i> Set Template </a>
															|
															<a href="edit_customer.php?id=<?=$row[Customer_Id]?>" class="btn btn-circle btn-xs blue"><i class="glyphicon glyphicon-pencil"></i> Edit </a>
															<a href="list_customer.php?page=<?=$_GET[page]?>&id=<?=$row[Customer_Id]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
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
