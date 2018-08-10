<?php
$page = "umg02";
$page_name = "Delivery Address List.";
$page_rows = 50;

include "config/connect.php";

if($_POST[method]=="1"){
	$meSql = "INSERT INTO fs_delivery_address 
			VALUES ('','$_POST[Delivery_AddShop]','$_POST[Delivery_AddName]','$_POST[Delivery_AddAddress]','$_POST[Delivery_AddTumbon]','$_POST[Delivery_AddAumpor]',
			'$_POST[Delivery_AddProvince]','$_POST[Delivery_AddZipcode]','$_POST[Delivery_AddMobile]','$_POST[Customer_Id]')";
	$meQuery = mysqli_query($conn, $meSql);
	header('Location: list_delivery_address.php?page=1&id='.$_POST[Customer_Id]);
}

if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_delivery_address WHERE Delivery_AddId = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_delivery_address.php?page='.$_GET[page].'&id='.$_GET[cid]);
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
											<button type="button" class="btn btn-circle green-jungle btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Add</button>
											<!--<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-save"></span> Download Template </a> 
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
											$sql = "SELECT * FROM fs_delivery_address 
													WHERE Customer_Id = '$_GET[id]'";
											if($_GET[text]!=""){
												$sql .= " AND (Market_Code like '%$_GET[text]%' 
														OR Market_Name like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;
											
											$sql .= " ORDER BY Delivery_AddShop ASC LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);
											
											
										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Shop Name </th>
														<th> Name </th>
														<th> Address </th>
														<th> Tumbon </th>
														<th> Aumpor </th>
														<th> Province </th>
														<th> Zipcode </th>
														<th> Mobile </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<td> <?=$row[Delivery_AddShop]?> </td>
														<td> <?=$row[Delivery_AddName]?> </td>
														<td> <?=$row[Delivery_AddAddress]?> </td>
														<td> <?=$row[Delivery_AddTumbon]?> </td>
														<td> <?=$row[Delivery_AddAumpor]?> </td>
														<td> <?=$row[Delivery_AddProvince]?> </td>
														<td> <?=$row[Delivery_AddZipcode]?> </td>
														<td> <?=$row[Delivery_AddMobile]?> </td>
														<td>
															<a href="list_delivery_address.php?page=<?=$_GET[page]?>&id=<?=$row[Delivery_AddId]?>&cid=<?=$_GET[id]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
														</td>
													</tr>
												<?php
														}
													}else{
														echo "<tr>";
														echo "<td colspan='9'>0 results</td>";
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
								
								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">เพิ่มสถานที่จัดส่ง</h4>
									  </div>
									  <form action="list_delivery_address.php" method="post" name="formupdate" role="form" id="formupdate">
									  <input type="hidden" name="method" value="1">
									  <input type="hidden" name="Customer_Id" value="<?=$_GET[id]?>">
									  <div class="modal-body">
											<div class="form-group">
												<label for="exampleInputEmail1">ชื่อร้าน *</label>
												<input type="text" class="form-control" id="Delivery_AddShop" name="Delivery_AddShop" required>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">ชื่อ-นามสกุล *</label>
												<input type="text" class="form-control" id="Delivery_AddName" name="Delivery_AddName" required>
											</div>
											<div class="form-group">
												<label for="exampleInputAddress">ที่อยู่ *</label>
												<textarea class="form-control" rows="2" name="Delivery_AddAddress" id="Delivery_AddAddress"></textarea>
											</div>
											<div class="form-group">
												<label for="exampleInputPhone">ตำบล *</label>
												<input type="text" class="form-control" id="Delivery_AddTumbon" name="Delivery_AddTumbon" required>
											</div>
											<div class="form-group">
												<label for="exampleInputPhone">อำเภอ *</label>
												<input type="text" class="form-control" id="Delivery_AddAumpor" name="Delivery_AddAumpor" required>
											</div>
											<div class="form-group">
												<label for="exampleInputPhone">จังหวัด *</label>
												<input type="text" class="form-control" id="Delivery_AddProvince" name="Delivery_AddProvince" required>
											</div>
											<div class="form-group">
												<label for="exampleInputPhone">รหัสไปรษณีย์ *</label>
												<input type="text" class="form-control" id="Delivery_AddZipcode" name="Delivery_AddZipcode" maxlength="5" required>
											</div>
											<div class="form-group">
												<label for="exampleInputPhone">เบอร์โทรศัพท์ *</label>
												<input type="text" class="form-control" id="Delivery_AddMobile" name="Delivery_AddMobile" required>
											</div>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
									  </form>
									</div>
								  </div>
								</div>
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