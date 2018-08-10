<?php
include "config/connect.php";

$sql = "SELECT * FROM fs_sell_product 
		INNER JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		INNER JOIN fs_productcategory ON fs_product.ProductCategory_Code = fs_productcategory.ProductCategory_Code 
		INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
		WHERE fs_sell_product.SellProduct_Code = '$_GET[id]' 
		AND fs_sell_product.SellProduct_Status = '1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//$price_uint = $row[pro_price]/$row[pro_amout];
$price_uint = $row[pro_cost_price];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/owl-slider.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/settings.css"/>
        <link rel="shortcut icon" href="assets/images/favicon.png" />
        <script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>
        <title>ศรีไทย Srithai</title>
    </head>
    <body>

    <!-- End pushmenu -->
    <div class="wrappage">
        <!-- <div id="rtl">RTL</div> -->
        <?php
			include "header.php";
		?>
		
        <div class="container">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-4">
					<?php
						if(file_exists("backoffice/img_pro/".$row[Product_Code].".jpg")) 
						{
							$img = "backoffice/img_pro/".$row[Product_Code].".jpg";
						}else{
							$img = "backoffice/img_pro/product.png";
						}
					?>
					<img class="img-responsive img-thumbnail" src="<?=$img;?>" alt=""/>
                </div>
				<div class="col-md-4">
					<p><font style="color:#0078d1;font-size:20px;">ชื่อสินค้า :  <?=$row[SellProduct_ThName]?></font></p>
					<br>
					<p><font style="font-size:18px;">รหัสสินค้า :  <?=$_GET[id]?></font></h5></p>
					<br>
					<p><font style="font-size:18px;">หมวดสินค้า :  <?=$row[ProductCategory_ThName]?></font></p>
                    <hr style="height: 2px;color: #ff0000; background-color: #ff0000;">
					<p><font style="color:#ff0000;font-size:28px;">ราคา <?=number_format($row[SellProduct_Cost],2)?>/<?=$row[Unit_ThName]?></font></p>
					<br>
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<form action="update_cart.php" method="post">
								<div class="input-group">
									<input type="hidden" class="form-control control-search" name="item_code" value="<?=$_GET[id]?>" required>
									<input type="number" min="1" step="1" class="form-control control-search" name="item_amount" placeholder="กรอกจำนวน" required>
									<button class="button_search" type="submit"> เพิ่มสินค้า</button>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!--End Slide-->
        
        <div id="back-to-top">
            <i class="fa fa-long-arrow-up"></i>
        </div>
        <?php
			include "footer.php";
		?>
        </div>
    <!-- End wrappage -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="assets/js/engo-plugins.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="assets/js/map-icons.js"></script>
    <script type="text/javascript" src="assets/js/store.js"></script>
    </body>
</html>
