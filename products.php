<?php
include "config/connect.php";
include "functions/pagenumber_function.php";

$sql = "SELECT * FROM fs_sell_product 
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code ";
if($_GET[cat]!=""){
	$sql .= "WHERE fs_product.ProductCategory_Code = '$_GET[cat]' ";
}
$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
$page_rows = 12;
$goto = ($_GET[page]-1) * $page_rows;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/owl-slider.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/settings.css"/>
        <link rel="shortcut icon" href="assets/images/favicon.ico" />
        <!--<script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>-->
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
		<!--<link href="backoffice/assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />-->
		<style>
			ul.typeahead.dropdown-menu{
				background: #ffffff;
			}
			ul.typeahead.dropdown-menu li a {
				font-size: 15px;
			}
		</style>
        <title>ศรีไทยโก :: SrithaiGo</title>
    </head>
    <body>

    <!-- End pushmenu -->
    <div class="wrappage">
        <!-- <div id="rtl">RTL</div> -->
        <?php
			include "header.php";
		?>
		
        <div class="container container-ver2 box-cat-home3">
            <div class="row">
                <div class="col-md-3">
                    <div class="categories-home3">
                        <h3>หมวดหมู่สินค้า</h3>
                        <i class="fa fa-chevron-circle-down icon-click"></i>
                        <ul class="menu-vertical">
                            <li><img src="assets/images/icon-categories-1.png" alt=""><a href="products.php?page=1" title="ผลไม้สด">ทั้งหมด</a></li>
							<?php
								$sql = "SELECT * FROM fs_productcategory ORDER BY ProductCategory_ThName";
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_assoc($result)) {
							?>
                            <li><img src="assets/images/<?=$row[ProductCategory_Img]?>" alt=""><a href="products.php?cat=<?=$row[ProductCategory_Code]?>&page=1" title="<?=$row[ProductCategory_ThName]?>"><?=$row[ProductCategory_ThName]?></a></li>
							<?php
									}
								}
							?>
                        </ul>
                    </div>
                </div>
                <!--End col-md-3-->
                <div class="col-md-9">
                    <div class="container">
						<div class="title-text-v2">
							<h3>รายการสินค้า</h3>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<form action="search.php" method="get">
									<div class="input-group">
										<input type="hidden" class="form-control control-search" name="page" value="1" required>
										<input type="text" class="typeahead form-control control-search" name="text" required autocomplete="off" >
										<button class="button_search" type="submit"> ค้นหา</button>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?php if($_GET[mg]=="1"){?>
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									เพิ่มสินค้าลงตระกร้าเรียบร้อยแล้วคะ
								</div>
								<?php } ?>
								<p style="margin-top: 1em;">พบสินค้าจำนวน <?=$numrows;?> รายการ (<?=$_GET[page];?>/<?=maximun_page($numrows, $page_rows);?> หน้า)</p>
							</div>
						</div>
						<hr>
						<div class="featured-products">
							<div class="tab-container space-10">
								<div class="row">
									<?php
										$sql_1 = "SELECT * FROM fs_sell_product 
												 INNER JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
												 INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code ";
										if($_GET[cat]!=""){
											$sql_1 .= "WHERE fs_product.ProductCategory_Code = '$_GET[cat]' ";
										}
											$sql_1 .= " LIMIT $goto,$page_rows";
										$result_1 = mysqli_query($conn, $sql_1);
										if(mysqli_num_rows($result_1) > 0) {
											while($row_1 = mysqli_fetch_assoc($result_1)) {
									?>
									<div class="col-md-4">
										<div style="height:450px;">
											<center>
												<a href="products_detail.php?id=<?=$row_1[SellProduct_Code]?>" title="product-images">
													<?php
														if(file_exists("backoffice/img_pro/".$row_1[Product_Code].".jpg")) 
														{
															$img = "backoffice/img_pro/".$row_1[Product_Code].".jpg";
														}else{
															$img = "backoffice/img_pro/product.png";
														}
													?>
													<img class="img-responsive img-thumbnail" src="<?=$img;?>" alt=""/>
												</a>
												<a href="products_detail.php?id=<?=$row_1[SellProduct_Code]?>" title="BlueBerry"><h3 style="margin-top: 1em;"><?=$row_1[SellProduct_ThName]?></h3></a>
												<h4 style="margin-top: 1em;margin-bottom: 1em;"> <?=number_format($row_1[SellProduct_Cost],2)?>/<?=$row_1[Unit_ThName]?></h4>
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<form action="update_cart.php" method="post">
															<div class="input-group">
																<input type="hidden" class="form-control control-search" name="item_code" value="<?=$row_1[SellProduct_Code]?>" required>
																<input type="number" min="1" step="1" class="form-control control-search" name="item_amount" placeholder="กรอกจำนวน" required>
																<button class="button_search" type="submit"> เพิ่มสินค้า</button>
															</div>
														</form>
													</div>
												</div>
											</center>
										</div>
										<hr>
									</div>
									<!-- End item -->
									<?php
											}
										}
									?>
								</div>
							</div>
							<!-- End viewall -->
						</div>
						
						<center>
							<?php 
							pagination_number(maximun_page($numrows, $page_rows), $_GET[page], "products.php?cat=".$_GET[cat], 3); ?>
						</center>

					</div>
                </div>
                <!--End col-md-9-->
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
