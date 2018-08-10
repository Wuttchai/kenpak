<header id="header" class="header-v3 header-v3-new">
	<!--End float-left-->
	<div class="right">
		<div id="topbar" class="topbar-ver2">
			<div class="container container-ver2">
				<a class="logo-header-v3" href="#" title="Logo-FreshFood">
				  <img src="assets/images/logo.png" alt="FreshFood" width="95%">
				</a>
				<div class="inner-topbar box">
					<div class="float-left">
						<p><img src="assets/images/icon-phone-header.png" alt="icon"> ติดต่อเรา <span> (063)-204-6878</span></p>
					</div>
					<div class="float-right align-right">
						<?php
							if($_SESSION[user_username]!="" AND $_SESSION[user_id]!=""){
						?>
						<a href="carts.php">ตระกร้าสินค้า (<?=count($_SESSION[cart_item]);?>)</a>
							<div class="hover-menu">
								<a class="acc" href="#"><img src="assets/images/icon-user-header.png" alt="icon"><?=$_SESSION[user_username];?></a>
								<ul class="list-menu">
									<li><a href="carts.php">ตระกร้าสินค้า (<?=count($_SESSION[cart_item]);?>)</a></li>
									<li><a href="history_order.php?page=1">ประวัติการสั่งซื้อ</a></li>
									<li><a href="payment.php">แจ้งโอนเงิน</a></li>
									<li><a href="logout.php">ออกจากระบบ</a></li>
								</ul>
							</div>
						<?php
							}else{
						?>
						<div class="hover-menu">
							<a class="acc" href="#"><img src="assets/images/icon-user-header.png" alt="icon">บัญชีของฉัน</a>
							<ul class="list-menu">
								<li><a href="login.php">เข้าสู่ระบบ</a></li>
								<li><a href="register.php">ลงทะเบียน</a></li>
							</ul>
						</div>
						<?php
							}
						?>
						<!-- End hover-menu -->
					</div>
				</div>
			</div>
			<!-- End container -->
		</div>
		<!-- End topbar -->
		<div class="header-top">
			<div class="container container-ver2">
				<div class="box">
					<p class="icon-menu-mobile"><i class="fa fa-bars" ></i></p>
					<!--End logo-->
					<div class="logo-mobile"><a href="#" title="FreshFood"><img src="assets/images/logo.png" alt="SrithaiGo"></a></div>
					
					<nav class="mega-menu">
						<!-- Brand and toggle get grouped for better mobile display -->
						<ul class="nav navbar-nav" id="navbar">
							<li class="level1 active"><a href="index.php" title="Home">หน้าแรก</a>
								<!-- <ul class="menu-level-1 dropdown-menu">
									<li class="level2"><a href="home_v1.html" title="Home 1">Home 1</a></li>
									<li class="level2"><a href="home_v2.html" title="Home 2">Home 2</a></li>
									<li class="level2"><a href="home_v3.html" title="Home 3">Home 3</a></li>
								</ul> -->
							</li>
							<li class="level1"><a href="about_us.php" title="Product">เกี่ยวกับเรา</a></li>
							<!--<li class="level1 dropdown">
								<a href="#" title="About">เกี่ยวกับเรา</a>
								<div class="sub-menu sub-menu-v2 dropdown-menu">
									<div class="top-sub-menu">
										<img src="assets/images/top-submenu1.jpg" alt="images">
									</div>
									<ul class="menu-level-1">
										<li class="level2"><b>เกี่ยวกับเรา</b>
											<ul class="menu-level-2">
												<li class="level3"><a href="about_us.php" title="About-us">ประวัติความเป็นมา</a></li>
											</ul>
										</li>
										<li class="level2"><b>ข้อมูลการให้บริการ</b>
											<ul class="menu-level-2">
												<li class="level3"><a href="coming.php" title="Area Service">พื้นที่ให้บริการ</a></li>
												<li class="level3"><a href="payment_info.php" title="Condition Payment">เงื่อนไขการชำระเงิน</a></li>
												<li class="level3"><a href="delivery.php" title="Delivery">ข้อมูลการจัดส่ง</a></li>
											</ul>
										</li>
										<li class="level2"><br>
											<ul class="menu-level-2">
												<li class="level3"><a href="policies.php" title="Policies">เงื่อนไขการให้บริการ</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</li>-->
							<li class="level1"><a href="products.php?page=1" title="Product">สินค้า</a></li>
							<li class="level1"><a href="payment.php" title="Payment">แจ้งโอนเงิน</a></li>
							<?php
								if($_SESSION[user_username]!="" AND $_SESSION[user_id]!=""){
							?>
							<li class="level1 dropdown">
								<a href="#" title="About">ข้อมูลสั่งซื้อ</a>
								<div class="sub-menu sub-menu-v2 dropdown-menu">
									<div class="top-sub-menu">
										<img src="assets/images/top-submenu2.jpg" alt="images">
									</div>
									<ul class="menu-level-1">
										<li class="level2"><b>ข้อมูลสมาชิก</b>
											<ul class="menu-level-2">
												<li class="level3"><a href="#" title="About-us">ประวัติส่วนตัว</a></li>
												<li class="level3"><a href="#" title="About-us">เปลี่ยนรหัสผ่าน</a></li>
											</ul>
										</li>
										<li class="level2"><b>ข้อมูลการสั่งซื้อ</b>
											<ul class="menu-level-2">
												<li class="level3"><a href="carts.php">ตระกร้าสินค้า (<?=count($_SESSION[cart_item]);?>)</a></li>
												<li class="level3"><a href="history_order.php?page=1">ประวัติการสั่งซื้อ</a></li>
												<li class="level3"><a href="payment.php">แจ้งโอนเงิน</a></li>
											</ul>
										</li>
										<li class="level2"><br>
											<ul class="menu-level-2">
												<li class="level3"><a href="#" title="Policies">ออกจากระบบ</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</li>
							<?php
								}else{
							?>
							<li class="level1"><a href="register.php" title="Register">ลงทะเบียน</a></li>
							<?php
								}
							?>
							<li class="level1"><a href="express_delivery.php" title="Payment">พื้นที่จัดส่ง</a></li>
							<li class="level1"><a href="contact.php" title="Contact us">ติดต่อเรา</a></li>
							<li class="level1"><a href="login.php" title="Login">เข้าสู่ระบบ</a></li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- End container -->
		</div>
		<!-- End header-top -->
	</div>
	<!--End right-->
</header><!-- /header -->