<?php
$page = "pmg01";
$page_name = "Product Category List.";
$page_rows = 50;

include "config/connect.php";
if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_productcategory WHERE ProductCategory_Id = '$_GET[id]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: list_procategory.php?page='.$_GET[page]);
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
											<a href="add_procategory.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a>
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
											$sql = "SELECT * FROM fs_productcategory WHERE 1=1";
											if($_GET[text]!=""){
												$sql .= " AND (ProductCategory_Code like '%$_GET[text]%'
														OR ProductCategory_ThName like '%$_GET[text]%'
														OR ProductCategory_EnName like '%$_GET[text]%'
														OR ProductCategory_Comment like '%$_GET[text]%')";
												}
											$result = mysqli_query($conn, $sql);
											$row_count = mysqli_num_rows($result);
											$total_page = ceil($row_count/$page_rows);
											$goto = ($_GET[page]-1) * $page_rows;

											$sql .= " LIMIT $goto,$page_rows";
											$result = mysqli_query($conn, $sql);


										?>
										<p style="margin-top: 15px;">Result <?=$row_count?> entries</p>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th> Category Code </th>
														<th> Category Name (Th) </th>
														<th> Category Name (En) </th>
														<th> Comment </th>
														<th>  </th>
													</tr>
												</thead>
												<tbody>
												<?php
													if(mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
												?>
													<tr>
														<td> <?=$row[ProductCategory_Code]?> </td>
														<td> <?=$row[ProductCategory_ThName]?> </td>
														<td> <?=$row[ProductCategory_EnName]?> </td>
														<td> <?=$row[ProductCategory_Comment]?> </td>
														<td>
															<a href="edit_procategory.php?page=<?=$_GET[page]?>&id=<?=$row[ProductCategory_Id]?>" class="btn btn-circle btn-xs blue"><i class="glyphicon glyphicon-pencil"></i> Edit </a>
															<a href="list_procategory.php?page=<?=$_GET[page]?>&id=<?=$row[ProductCategory_Id]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
														</td>
													</tr>
												<?php
														}
													}else{
														echo "<tr>";
														echo "<td colspan='5'>0 results</td>";
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
