<?php
$page = "umg02";
$page_name = "Add Customer.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_customer WHERE Customer_Code = '$_POST[Customer_Code]' OR Customer_Username = '$_POST[Customer_Username]' OR Customer_Email = '$_POST[Customer_Email]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0){
		$sql = "INSERT INTO fs_customer (Customer_Code, Customer_Name, Customer_Email, Customer_Username, Customer_Password, Customer_ShopType, 
				Customer_Type, Payments_Type1,Payments_Type2,Payments_Type3,Payments_Type4, Customer_Tel, Customer_CreditTime, Customer_InvoiceType, 
				Delivery_Cost_Id, Customer_Status,Customer_CreateDate) 
				VALUES ('$_POST[Customer_Code]', '$_POST[Customer_Name]', '$_POST[Customer_Email]', '$_POST[Customer_Username]', '$_POST[Customer_Password]', 
				'$_POST[Customer_ShopType]', '$_POST[Customer_Type]', '$_POST[orders_payment_type1]', '$_POST[orders_payment_type2]', '$_POST[orders_payment_type3]', 
				'$_POST[orders_payment_type4]', '$_POST[Customer_Tel]', '$_POST[Customer_CreditTime]', '$_POST[Customer_InvoiceType]', '$_POST[Delivery_Cost_Id]', 
				'$_POST[Customer_Status]',NOW())";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_customer.php?page=1');
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code หรือ Username นี้มีอยู่แล้ว\")); </script>";
	}
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
												<label>Customer Code</label>
												<input type="text" class="form-control input-sm" maxlength="10" name="Customer_Code" required>
											</div>
											<div class="form-group">
												<label>Customer Name</label>
												<input type="text" class="form-control input-sm" name="Customer_Name" required>
											</div>
											<div class="form-group">
												<label>Customer Email</label>
												<input type="email" class="form-control input-sm" name="Customer_Email" required>
											</div>
											<div class="form-group">
												<label>Customer Username</label>
												<input type="text" class="form-control input-sm" name="Customer_Username" required>
											</div>
											<div class="form-group">
												<label>Customer Password</label>
												<input type="password" class="form-control input-sm" name="Customer_Password" required>
											</div>
											<div class="form-group">
												<label>Customer Shop Type</label>
												<select class="form-control" name="Customer_ShopType" id="Customer_ShopType" required>
													<option value="">- เลือกประเภทร้านอาหาร -</option>
													<option value="ร้านอาหาร Food Chain">ร้านอาหาร Food Chain</option>
													<option value="ร้านอาหารในห้างสรรพสินค้า">ร้านอาหารในห้างสรรพสินค้า</option>
													<option value="โรงแรม">โรงแรม</option>
													<option value="ภัตตาคาร">ภัตตาคาร</option>
													<option value="Food Court">Food Court</option>
													<option value="ร้านอาหารตามสั่ง">ร้านอาหารตามสั่ง</option>
													<option value="โรงอาหาร">โรงอาหาร</option>
													<option value="โรงพยาบาล">โรงพยาบาล</option>
													<option value="บ้านพักอาศัย">บ้านพักอาศัย</option>
													<option value="อื่นๆ">อื่นๆ</option>
												</select>
											</div>
											<div class="form-group">
												<label>Customer Type</label>
												<select class="form-control input-sm" name="Customer_Type" required>
													<option value="">- Select -</option>
													<option value="1" selected>Normal</option>
													<option value="2">VIP</option>
												</select>
											</div>
											<div class="form-group">
												<label>Payment Type</label>
												  <div>
													<input type="checkbox" id="orders_payment_type1" name="orders_payment_type1" value="1">
													<label>เครดิตเทอม</label>
												  </div>
												  <div>
													<input type="checkbox" id="orders_payment_type2" name="orders_payment_type2" value="1">
													<label>จ่ายเต็ม</label>
												  </div>
												  <div>
													<input type="checkbox" id="orders_payment_type3" name="orders_payment_type3" value="1">
													<label>จ่ายครึ่ง</label>
												  </div>
												  <div>
													<input type="checkbox" id="orders_payment_type4" name="orders_payment_type4" value="1">
													<label>เก็บเงินปลายทาง</label>
												  </div>
											</div>
											<div class="form-group">
												<label>Delivery Cost</label>
												<select class="form-control input-sm" name="Delivery_Cost_Id" required>
													<option value="">- Select -</option>
													<?php 
														$sql = "SELECT * FROM fs_delivery_cost ORDER BY Delivery_Cost_Id ASC";
														$result = mysqli_query($conn, $sql);
														while($row = mysqli_fetch_assoc($result)) {
													?>
													<option value="<?=$row[Delivery_Cost_Id]?>"><?=$row[Delivery_Cost_Name]?> (<?=number_format($row[Delivery_Cost],2)?>)</option>
													<?php 
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Customer Tel</label>
												<input type="text" class="form-control input-sm" name="Customer_Tel" required>
											</div>
											<div class="form-group">
												<label>Customer Credit Time (Day)</label>
												<input type="number" min="0" step="1" class="form-control input-sm" name="Customer_CreditTime" required>
											</div>
											<div class="form-group">
												<label>Customer Status</label>
												<select class="form-control input-sm" name="Customer_Status" required>
													<option value="">- Select -</option>
													<option value="1" selected>Enable</option>
													<option value="0">Disable</option>
												</select>
											</div>
											<div class="form-group">
												<label>Invoice Status</label>
												<select class="form-control input-sm" name="Customer_InvoiceType" required>
													<option value="">- Select -</option>
													<option value="Person">Person</option>
													<option value="Corporate">Corporate</option>
												</select>
											</div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue btn-sm">Submit</button>
                                                <a href="list_customer.php?page=1"><button type="button" class="btn default btn-sm">Cancel</button></a>
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

    </body>

</html>