<?php
$page = "smg03";
$page_name = "Add Stock (Manual).";

include "config/connect.php";
if($_POST[method]=="1"){
	$today = substr(date("Y"),2).date("mdHis")."001";
	$product_code = explode("|",$_POST[Product_Code]);
	
	$sql_check = "SELECT * FROM fs_product WHERE Product_Code like '$product_code[0]'";
	$query_check = mysqli_query($conn, $sql_check);
	if(mysqli_num_rows($query_check)>0){

		$sql = "INSERT INTO fs_stock (Stock_Code, Product_Code, Stock_Amount, Stock_UnitPrice, Stock_ExpDate, Rack_Code, Stock_CreateDate) 
				VALUES ('$today', '$product_code[0]', '$_POST[Stock_Amount]', '$_POST[Stock_UnitPrice]', '$_POST[Stock_ExpDate]', '$_POST[Rack_Code]', '$_POST[Stock_CreateDate]')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_stock.php?page=1');
	}else{
		echo "<script>alert('ไม่พบหมายเลขสินค้าที่ระบุ กรุณากรอกใหม่'); window.history.back();</script>";
	}
}
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
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										<input type="hidden" name="method" value="1">
											<div class="form-group">
												<label>Buy Product</label>
												<input type="text" class="typeahead form-control" name="Product_Code" id="Product_Code" required autocomplete="off" placeholder="กรอกชื่อ หรือ รหัสสินค้า">
											</div>
											<div class="form-group">
												<label>Products Amount</label>
												<input type="number" class="form-control input-sm" name="Stock_Amount" id="Stock_Amount" min="1" step="0.01" required>
											</div>
											<div class="form-group">
												<label>Price/Unit</label>
												<input type="number" min="0.01" step="0.01" class="form-control input-sm" name="Stock_UnitPrice" id="Stock_UnitPrice" required>
											</div>
											<div class="form-group">
												<label>Create Date</label>
												<input type="date" class="form-control input-sm" name="Stock_CreateDate" id="Stock_CreateDate" required value="<?=date("Y-m-d")?>">
											</div>
											<div class="form-group">
												<label>Expiry Date</label>
												<input type="date" class="form-control input-sm" name="Stock_ExpDate" id="Stock_ExpDate" required>
											</div>
											<div class="form-group">
												<label>Rack</label>
												<select class="form-control input-sm" name="Rack_Code" required>
													<option value="">Select Rack</option>
													<?php 
														echo $sql_in = "SELECT * FROM fs_rack ORDER BY Rack_Code ASC";
														$result_in = mysqli_query($conn, $sql_in);
														while($row_in = mysqli_fetch_assoc($result_in)) {
													?>
													<option value="<?=$row_in[Rack_Code]?>"><?=$row_in[Rack_Code]?> : <?=$row_in[Rack_Detail]?></option>
													<?php
														}
													?>
												</select> 
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_stock.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
                                            </div>
                                        </form>
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
				return $.get('data/get_ajaxpro.php', { query: query }, function (data) {
						console.log(data);
						data = $.parseJSON(data);
						return process(data);
					});
				}
			});
		</script>
    </body>

</html>