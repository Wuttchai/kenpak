<?php
include "config/connect.php";

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
    <div class="awe-page-loading">
         <div class="awe-loading-wrapper">
            <div class="awe-loading-icon">
               <img src="assets/images/logo.png" alt="images">
            </div>
            <div class="progress">
               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
         </div>
      </div>

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
                    <div class="tp-banner-container ver3">
                        <div class="tp-banner" >
                            <ul>    <!-- SLIDE  -->
                                <!-- SLIDE  -->
                                <li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_01.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
                                <li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_02.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_03.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_04.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_05.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_06.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_07.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_08.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_09.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_10.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_11.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_12.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_13.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
								<li data-transition="random" data-slotamount="14" data-masterspeed="600" >
                                    <!-- MAIN IMAGE -->
                                    <img src="assets/images/banner/Banner_14.jpg"  alt="Futurelife-home2-slideshow"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                                </li>
                                <!-- SLIDER -->
                            </ul>
                            <div class="tp-bannertimer"></div>
                        </div>
                    </div>
                </div>
                <!--End col-md-9-->
            </div>
        </div>
        <!--End Slide-->

        <div class="container container-ver2 ">
			<marquee scrollamount="5"><h3>พื้นที่ในการจัดส่งสินค้า (จ.ปทุมธานี)</h3></marquee>
            <div class="title-text-v2">
                <h3>สินค้าเด่น</h3>
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
			<hr>
            <div class="featured-products">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#popular" aria-controls="home" role="tab" data-toggle="tab"><h3>ยอดนิยม</h3></a></li>
					<li role="presentation"><a href="#profile" aria-controls="home" role="tab" data-toggle="tab"><h3>สินค้าใหม่</h3></a></li>
				</ul>
				<div class="tab-content space-10">
					<div role="tabpanel" class="tab-pane active" id="popular">
						<div class="row">
							<?php
								$sql_1 = "SELECT fs_orders_detail.SellProduct_Code,fs_sell_product.SellProduct_ThName,fs_sell_product.SellProduct_Cost,fs_unit.Unit_ThName, SUM(fs_orders_detail.Ordersde_Amount) FROM fs_orders_detail 
											INNER JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
											INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
											GROUP BY fs_orders_detail.SellProduct_Code 
											ORDER BY SUM(fs_orders_detail.Ordersde_Amount) DESC 
											LIMIT 0,8";
								$result_1 = mysqli_query($conn, $sql_1);
								if(mysqli_num_rows($result_1) > 0) {
									while($row_1 = mysqli_fetch_assoc($result_1)) {
							?>
							<div class="col-md-3">
								<div style="height:450px;">
									<center>
										<a href="products_detail.php?id=<?=$row_1[SellProduct_Code]?>" title="product-images">
											<?php
												if(file_exists("backoffice/img_pro/".$row_1[SellProduct_Code].".jpg")) 
												{
													$img = "backoffice/img_pro/".$row_1[SellProduct_Code].".jpg";
												}else{
													$img = "backoffice/img_pro/product.png";
												}
											?>
											<img class="img-responsive img-thumbnail" src="<?=$img;?>" alt=""/>
										</a>
										<a href="products_detail.php?id=<?=$row_1[SellProduct_Code]?>" title="BlueBerry"><h3 style="margin-top: 1em;"><?=$row_1[SellProduct_ThName]?></h3></a>
										<h3 style="margin-top: 1em;margin-bottom: 1em;"> <?=number_format($row_1[SellProduct_Cost],2)?>/<?=$row_1[Unit_ThName]?></h3>
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
								}else{echo "<center>ยังไม่มีรายการสั่งสินค้า</center>";}
							?>
                        </div>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="row">
                            <?php
								$sql_1 = "SELECT * FROM fs_sell_product 
										 INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
										 INNER JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
										 ORDER BY SellProduct_Id DESC LIMIT 0,8";
								$result_1 = mysqli_query($conn, $sql_1);
								if(mysqli_num_rows($result_1) > 0) {
									while($row_1 = mysqli_fetch_assoc($result_1)) {
							?>
                            <div class="col-md-3">
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
										<h3 style="margin-top: 1em;margin-bottom: 1em;"> <?=number_format($row_1[SellProduct_Cost],2)?>/<?=$row_1[Unit_ThName]?></h3>
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
				</div>
                <!-- End viewall -->
            </div>
			<div class="box center space-padding-tb-30">
				<a class="link-v1 color-brand font-300" href="products.php?page=1" title="View All">ดูทั้งหมด</a>
			</div>
        </div>
        <!--End container-ver2-->
        <div class="banner-home3">
            <div class="container container-ver2 space-40">
                <img class="img-responsive" src="assets/images/Promotion01.png" alt="banner-home3">
                <!--<div class="text">
                    <img src="http://landing.engocreative.com/html/freshfood/demo/assets/images/icon-phone.png" alt="icon">
                    <h4>Call FOR US now</h4>
                    <h3>(063) - 204 - 6878</h3>
                    <p>Order Organic food To Fit Your Healthy Lifestyle!</p>
                </div>-->
                <!--End text-->
                <div class="icon-banner">
                    <img src="http://landing.engocreative.com/html/freshfood/demo/assets/images/home3-images-banner1.png" alt="icon-banner">
                </div>
            </div>
        </div>
        <!--End banner-home3-->
        
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
