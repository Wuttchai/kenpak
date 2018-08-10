<?php
$page = "umg02";
$page_name = "Set Detail Template Orders.";

include "config/connect.php";
if($_POST[method]=="1"){
	$product_code = explode("|",$_POST[SellProduct_Id]);
	
	$sql_check = "SELECT * FROM fs_sell_product WHERE SellProduct_Code like '$product_code[0]'";
	$query_check = mysqli_query($conn, $sql_check);
	if(mysqli_num_rows($query_check)>0){
		$get_row = mysqli_fetch_array($query_check);
		
		$sql_chk = "SELECT * FROM fs_template_detail WHERE Template_Id = '$_POST[Template_Id]' AND SellProduct_Id like '$get_row[SellProduct_Id]'";
		$result = mysqli_query($conn, $sql_chk);
		$rowcount = mysqli_num_rows($result);
		if($rowcount==0){
			$sql = "INSERT INTO fs_template_detail (Template_Id, SellProduct_Id) 
					VALUES ('$_POST[Template_Id]', '$get_row[SellProduct_Id]')";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: edit_detailtemplate_bof.php?id='.$_POST[Template_Id].'&cid='.$_POST[cid]);
		}else{
			echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก product นี้มีอยู่แล้ว\")); </script>";
		}
	}else{
		echo "<script>alert('ไม่พบหมายเลขสินค้าที่ระบุ กรุณากรอกใหม่'); window.history.back();</script>";
	}
}

if($_GET[method]=="del"){
	$sql = "DELETE FROM fs_template_detail WHERE Template_Id = '$_GET[id]' AND SellProduct_Id = '$_GET[proid]'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('Location: edit_detailtemplate_bof.php?id='.$_GET[id].'&cid='.$_GET[cid]);
}

$sql = "SELECT * FROM fs_template WHERE Template_Id = '$_GET[id]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include "head.php";?>
		<link href="assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
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
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <span class="caption-subject bold uppercase"><?=$page_name?></span>
											<!--<a href="add_market.php" class="btn btn-circle green-jungle btn-sm"><span class="glyphicon glyphicon-plus"></span> Add </a>-->
											<a href="download_detailtemplate.php?id=<?=$_GET[id]?>" class="btn btn-circle green-jungle btn-sm" target="_blank"><span class="glyphicon glyphicon-save"></span> Download Template </a> 
											<!--<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-open"></span> Upload File </a> 
											<a href="" class="btn btn-circle btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Advance Search </a> -->
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
											<div class="form-group">
												<label>Template Name : <?=$row[Template_Name]?></label>
											</div>
											<div class="form-group">
												<label>Template Detail : <?=$row[Template_Detail]?></label>
											</div>
											<hr>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th> เพิ่มสินค้า </th>
															<th>  </th>
														</tr>
													</thead>
													<tbody>
														<form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
														<input type="hidden" name="method" value="1">
														<input type="hidden" name="Template_Id" value="<?=$_GET[id]?>">
														<input type="hidden" name="cid" value="<?=$_GET[cid]?>">
															<tr>
																<td>
																	<input type="text" class="typeahead form-control" name="SellProduct_Id" id="SellProduct_Id" required autocomplete="off" placeholder="กรอกชื่อ หรือ รหัสสินค้า">
																</td>
																<td>
																	<button type="submit" class="btn blue btn-sm">Submit</button>
																	<a href="list_template.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
																</td>
															</tr>
														</form>
													</tbody>
												</table>
											</div>
											<!-- --------------------------------------- Detail ---------------------------------- -->
											<hr>
											<div class="table-responsive">
												<table class="table table-striped table-bordered">
													<thead>
														<tr>
															<th> # </th>
															<th> รายการสินค้าสินค้า </th>
															<th>  </th>
														</tr>
													</thead>
													<tbody>
														<?php 
															$sql_cat = "SELECT * FROM fs_productcategory ORDER BY ProductCategory_Code";
															$result_cat = mysqli_query($conn, $sql_cat);
															if(mysqli_num_rows($result_cat) > 0) {
																while($row_cat = mysqli_fetch_assoc($result_cat)) {
														?>
														<tr>
															<td colspan="3" style="background-color:#26B57E"> หมวด : <?=$row_cat[ProductCategory_ThName]?></td>
														</tr>
															<?php 
																$sql_in = "SELECT * FROM fs_template_detail
																		INNER JOIN fs_sell_product ON fs_template_detail.SellProduct_Id = fs_sell_product.SellProduct_Id 
																		INNER JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
																		WHERE fs_product.ProductCategory_Code = '$row_cat[ProductCategory_Code]' AND Template_Id = '$_GET[id]'";
																$result_in = mysqli_query($conn, $sql_in);
																$i = 1;
																	while($row_in = mysqli_fetch_assoc($result_in)) {
															?>
																<tr>
																	<td> <?=$i?> </td>
																	<td> <?=$row_in[SellProduct_ThName]?> </td>
																	<td>
																		<a href="#" class="btn btn-circle btn-xs blue-chambray"><i class="fa fa-arrow-down"></i> Down </a>
																		<a href="#" class="btn btn-circle btn-xs blue-chambray"><i class="fa fa-arrow-up"></i> Up </a>
																		<a href="edit_detailtemplate_bof.php?id=<?=$_GET[id]?>&proid=<?=$row_in[SellProduct_Id]?>&cid=<?=$_GET[cid]?>&method=del" class="btn btn-circle btn-xs red" onclick="return confirm('Are you sure you want to delete this item?');"><i class="glyphicon glyphicon-trash"></i> Delete </a>
																	</td>
																</tr>
															<?php
																	$i++;
																	}
																}
															}
															?>
													</tbody>
												</table>
											</div>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
		
		<script>
			$('input.typeahead').typeahead({
				source:  function (query, process) {
				return $.get('data/get_ajaxpro_tem.php?id=<?=$_GET[id]?>&', { query: query }, function (data) {
						console.log(data);
						data = $.parseJSON(data);
						return process(data);
					});
				}
			});
		</script>


    </body>

</html>