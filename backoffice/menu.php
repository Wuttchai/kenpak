<?php
include "config/connect.php";
?>
<!-- BEGIN SIDEBAR -->

<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
					<div class="nano">
							<div class="nano-content">
									<div class="logo"><a href="home.php"><!-- <img src="assets/images/logo.png" alt="" /> --><span> <img src="/assets/images/logo.png" alt="FreshFood" width="50%"></span></a></div>
									<ul>
											<li ><a href="home.php"><i class="ti-calendar"></i> แผงควบคุม </a></li>
											<li class="label">เมนูหลัก</li>

											<li ><a href="list_order_backof.php?page=1"><i class="ti-calendar"></i> เพิ่มรายการสั่งซื้อ </a></li>
											<li ><a href="list_order_buy_today.php"><i class="ti-calendar"></i> รายงานการซื้อ-ขาย(วันนี้) </a></li>											
											<li class="label">การจัดการ</li>
											<li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> จัดการผู้ใช้ <span class="sidebar-collapse-icon ti-angle-down"></span></a>
													<ul>
															<li><a href="list_employer.php?page=1">รายการพนักงาน</a></li>
															<li><a href="list_customer.php?page=1">รายการผู้ผลิต</a></li>
															<li><a href="list_supplier.php?page=1">รายการลูกค้า</a></li>
													</ul>
											</li>
											<li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> จัดการสินค้า <span class="sidebar-collapse-icon ti-angle-down"></span></a>
													<ul>
															<li><a href="list_buyproduct.php?page=1">รายการสินค้า</a></li>
															<li><a href="list_procategory.php?page=1">หมวดหมู่สินค้า</a></li>
															<li><a href="list_unit.php?page=1">หน่วยสินค้า</a></li>
													</ul>
											</li>
											<li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> จัดการรายการสั่งซื้อ <span class="sidebar-collapse-icon ti-angle-down"></span></a>
													<ul>
															<li><a href="list_orders.php?page=1">รายการสั่งซื้อ</a></li>
															<li><a href="market_report_select.php">เลือกรายงานการสั่งซื้อ</a></li>

													</ul>
											</li>
											<li><a a href="logout.php"><i class="ti-power-off"></i> ออกจากระบบ</a></li>
									</ul>
							</div>
					</div>
			</div>


	        <!-- bootstrap -->



	        <!--  flot-chart js -->
