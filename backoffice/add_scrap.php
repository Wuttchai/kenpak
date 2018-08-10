<?php
$page = "smg03";
$page_name = "Add Scrap (Manual).";

include "config/connect.php";
if($_POST[method]=="1"){

}

$sql = "SELECT * FROM fs_stock 
		LEFT JOIN fs_product ON fs_stock.Product_Code = fs_product.Product_Code WHERE fs_stock.Stock_Code = '$_GET[id]'";
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
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										<input type="hidden" name="method" value="1">
										<input type="hidden" name="stock_id" value="<?=$_GET[id]?>">
										<input type="hidden" name="stock_amount" value="<?=$row[Stock_Amount]?>">
											<div class="form-group">
												<label><b>Buy Product :</b> <?=$row[Product_Code]?> : <?=$row[Product_ThName]?> (<?=$row[Product_EnName]?>)</label>
											</div>
											<div class="form-group">
												<label><b>Products Amount :</b> <?=$row[Stock_Amount]?></label>
											</div>
											<div class="form-group">
												<label><b>Price/Unit :</b> ราคาถุงละ <?=$row[Stock_UnitPrice]?> บาท</label>
											</div>
											<div class="form-group">
												<label><b>Create Date :</b> <?=$row[Stock_CreateDate]?></label>
											</div>
											<div class="form-group">
												<label><b>Expiry Date :</b> <?=$row[Stock_ExpDate]?></label>
											</div>
											<div class="form-group">
												<label><b>Rack :</b> </label> 
											</div>
											<div class="form-group">
												<label>Scrap Amount</label>
												<input type="number" min="0.01" step="0.01" max="<?=$row[Stock_Amount]?>" class="form-control input-sm" name="Stock_UnitPrice" id="Stock_UnitPrice" required>
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