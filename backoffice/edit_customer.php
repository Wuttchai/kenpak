<?php
$page = "umg02";
$page_name = "Edit Customer.";

include "config/connect.php";
if($_POST[method]=="1"){
	$sql_chk = "SELECT * FROM fs_customer WHERE Customer_Code = '$_POST[Customer_Code]' OR Customer_Username = '$_POST[Customer_Username]'";
	$result = mysqli_query($conn, $sql_chk);
	$rowcount = mysqli_num_rows($result);
	if($rowcount==0 OR $_POST[Old_Code1]==$_POST[Customer_Code] OR $_POST[Old_Code2]==$_POST[Customer_Username]){
		$sql = "UPDATE fs_customer SET
				Customer_Code = '$_POST[Customer_Code]',
				Customer_Name = '$_POST[Customer_Name]',
				Customer_Email = '$_POST[Customer_Email]',
				Customer_Username = '$_POST[Customer_Username]',
				Customer_Password = '$_POST[Customer_Password]',
				Customer_ShopType = '$_POST[Customer_ShopType]',
				Customer_Type = '$_POST[Customer_Type]',
				Payments_Type1 = '$_POST[Payments_Type1]',
				Payments_Type2 = '$_POST[Payments_Type2]',
				Payments_Type3 = '$_POST[Payments_Type3]',
				Payments_Type4 = '$_POST[Payments_Type4]',
				Customer_Tel = '$_POST[Customer_Tel]',
				Customer_CreditTime = '$_POST[Customer_CreditTime]',
				Customer_InvoiceType = '$_POST[Customer_InvoiceType]',
				Delivery_Cost_Id = '$_POST[Delivery_Cost_Id]',
				Customer_Status = '$_POST[Customer_Status]'
				WHERE Customer_Id like '$_POST[Customer_Id]'";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: list_customer.php?page=1');
	}else{
		echo "<script> window.history.back(alert(\"ไม่สามารถ เพิ่มได้ เนื่องจาก Code หรือ Username นี้มีอยู่แล้ว\")); </script>";
	}
}

$sql = "SELECT * FROM fs_customer WHERE Customer_Id = '$_GET[id]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
										<input type="hidden" name="Customer_Id" value="<?=$row[Customer_Id]?>">
										<input type="hidden" name="Old_Code1" value="<?=$row[Customer_Code]?>">
										<input type="hidden" name="Old_Code2" value="<?=$row[Customer_Username]?>">
											<div class="form-group">
												<label>Customer Code</label>
												<input type="text" class="form-control input-sm" maxlength="10" name="Customer_Code" value="<?=$row[Customer_Code]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Name</label>
												<input type="text" class="form-control input-sm" name="Customer_Name" value="<?=$row[Customer_Name]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Email</label>
												<input type="email" class="form-control input-sm" name="Customer_Email" value="<?=$row[Customer_Email]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Username</label>
												<input type="text" class="form-control input-sm" name="Customer_Username" value="<?=$row[Customer_Username]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Password</label>
												<input type="text" class="form-control input-sm" name="Customer_Password" value="<?=$row[Customer_Password]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Shop Type</label>
												<select class="form-control" name="Customer_ShopType" id="Customer_ShopType" required>
													<option value="">- เลือกประเภทร้านอาหาร -</option>
													<option value="ร้านอาหาร Food Chain" <?php if($row[Customer_ShopType]=="ร้านอาหาร Food Chain"){echo "selected";}?>>ร้านอาหาร Food Chain</option>
													<option value="ร้านอาหารในห้างสรรพสินค้า" <?php if($row[Customer_ShopType]=="ร้านอาหารในห้างสรรพสินค้า"){echo "selected";}?>>ร้านอาหารในห้างสรรพสินค้า</option>
													<option value="โรงแรม" <?php if($row[Customer_ShopType]=="โรงแรม"){echo "selected";}?>>โรงแรม</option>
													<option value="ภัตตาคาร" <?php if($row[Customer_ShopType]=="ภัตตาคาร"){echo "selected";}?>>ภัตตาคาร</option>
													<option value="Food Court" <?php if($row[Customer_ShopType]=="Food Court"){echo "selected";}?>>Food Court</option>
													<option value="ร้านอาหารตามสั่ง" <?php if($row[Customer_ShopType]=="ร้านอาหารตามสั่ง"){echo "selected";}?>>ร้านอาหารตามสั่ง</option>
													<option value="โรงอาหาร" <?php if($row[Customer_ShopType]=="โรงอาหาร"){echo "selected";}?>>โรงอาหาร</option>
													<option value="โรงพยาบาล" <?php if($row[Customer_ShopType]=="โรงพยาบาล"){echo "selected";}?>>โรงพยาบาล</option>
													<option value="บ้านพักอาศัย" <?php if($row[Customer_ShopType]=="บ้านพักอาศัย"){echo "selected";}?>>บ้านพักอาศัย</option>
													<option value="อื่นๆ" <?php if($row[Customer_ShopType]=="อื่นๆ"){echo "selected";}?>>อื่นๆ</option>
												</select>
											</div>
											<div class="form-group">
												<label>Customer Type</label>
												<select class="form-control input-sm" name="Customer_Type" required>
													<option value="">- Select -</option>
													<option value="1" <?php if($row[Customer_Type]=="1"){echo "selected";}?>>Normal</option>
													<option value="2" <?php if($row[Customer_Type]=="2"){echo "selected";}?>>VIP</option>
												</select>
											</div>
											<div class="form-group">
												<label>Payment Type</label>
												  <div>
													<input type="checkbox" id="Payments_Type1" name="Payments_Type1" value="1" <?php if($row[Payments_Type1]=="1"){echo "checked";}?>>
													<label>เครดิตเทอม</label>
												  </div>
												  <div>
													<input type="checkbox" id="Payments_Type2" name="Payments_Type2" value="1" <?php if($row[Payments_Type2]=="1"){echo "checked";}?>>
													<label>จ่ายเต็ม</label>
												  </div>
												  <div>
													<input type="checkbox" id="Payments_Type3" name="Payments_Type3" value="1" <?php if($row[Payments_Type3]=="1"){echo "checked";}?>>
													<label>จ่ายครึ่ง</label>
												  </div>
												  <div>
													<input type="checkbox" id="Payments_Type4" name="Payments_Type4" value="1" <?php if($row[Payments_Type4]=="1"){echo "checked";}?>>
													<label>เก็บเงินปลายทาง</label>
												  </div>
											</div>
											<div class="form-group">
												<label>Delivery Cost</label>
												<select class="form-control input-sm" name="Delivery_Cost_Id" required>
													<option value="">- Select -</option>
													<?php
														$sql_in = "SELECT * FROM fs_delivery_cost ORDER BY Delivery_Cost_Id ASC";
														$result_in = mysqli_query($conn, $sql_in);
														while($row_in = mysqli_fetch_assoc($result_in)) {
															if($row[Delivery_Cost_Id]==$row_in[Delivery_Cost_Id]){$check = "selected";}else{$check = "";}
													?>
													<option value="<?=$row_in[Delivery_Cost_Id]?>" <?=$check?>><?=$row_in[Delivery_Cost_Name]?> (<?=number_format($row_in[Delivery_Cost],2)?>)</option>
													<?php
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Customer Tel</label>
												<input type="text" class="form-control input-sm" name="Customer_Tel" value="<?=$row[Customer_Tel]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Credit Time (Day)</label>
												<input type="number" min="0" step="1" class="form-control input-sm" name="Customer_CreditTime" value="<?=$row[Customer_CreditTime]?>" required>
											</div>
											<div class="form-group">
												<label>Customer Status</label>
												<select class="form-control input-sm" name="Customer_Status" required>
													<option value="">- Select -</option>
													<option value="1" <?php if($row[Customer_Status]=="1"){echo "selected";}?>>Enable</option>
													<option value="0" <?php if($row[Customer_Status]=="0"){echo "selected";}?>>Disable</option>
												</select>
											</div>
											<div class="form-group">
												<label>Invoice Status</label>
												<select class="form-control input-sm" name="Customer_InvoiceType" required>
													<option value="">- Select -</option>
													<option value="Person" <?php if($row[Customer_InvoiceType]=="Person"){echo "selected";}?>>Person</option>
													<option value="Corporate" <?php if($row[Customer_InvoiceType]=="Corporate"){echo "selected";}?>>Corporate</option>
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
