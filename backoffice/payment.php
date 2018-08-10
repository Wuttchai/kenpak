<?php
$page = "dtp01";
$page_name = "Money Transfer.";

include "config/connect.php";
include "functions/file_function.php";

if($_POST[method]=="1"){
	$sql = "SELECT * FROM fs_orders WHERE Orders_Id like '$_POST[Orders_Id]' AND Customer_Id = '".$_SESSION[user_id]."'";
	$query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);

	if($numrows<1){
		echo "<script>alert('ไม่พบหมายเลข Order ของท่าน กรุณาตรวจสอบอีกครั้ง'); window.history.back();</script>";
	}else{
		$row = mysqli_fetch_array($query);
		if($row[Orders_PaymentDoc]!=""){
			$file = $row[Orders_PaymentDoc];
			!unlink("../doc_transfer/".$file);
		}
		
		list($img_stutus, $img_name) = upload_file("Orders_PaymentDoc", "../doc_transfer/", 500000, "images,document");
		
		if($img_stutus!="" OR $img_stutus!="0"){
			$sql = "UPDATE fs_orders SET
					Orders_PaymentBank = '$_POST[Orders_PaymentBank]',
					Orders_PaymentTransfer = '$_POST[Orders_PaymentTransfer]',
					Orders_PaymentDate = '$_POST[Orders_PaymentDate]',
					Orders_PaymentTime = '$_POST[Orders_PaymentTime]',
					Orders_PaymentDoc = '$img_name',
					Order_Status = '2', 
					Orders_PaymentCreate = NOW() 					
					WHERE Orders_Id like '$_POST[Orders_Id]'";
			$query = mysqli_query($conn, $sql);
			if(!$query){
				echo "<script>alert('ไม่สามารถทำการบันทึกข้อมูลลงในระบบได้ กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
			}else{
				echo "<script>alert('ระบบทำการบันทึกข้อมูลเรียบร้อย ขอบคุณค่ะ'); window.location.href='list_hisorder.php?page=1';</script>";
			}
		}else{
			echo "<script>alert('ไม่สามารถทำการบันทึกข้อมูลลงในระบบได้ กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
		}
	}
}
if($_GET[id]!=""){
	$sql = "SELECT * FROM fs_orders WHERE Orders_Id like '$_GET[id]' AND Customer_Id = '".$_SESSION[user_id]."'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($query);
	
	$total = 0;
	$sql_2 = "SELECT * FROM fs_orders_detail WHERE Orders_Id like '$_GET[id]'";
	$query_2 = mysqli_query($conn, $sql_2);
	while($row_2 = mysqli_fetch_array($query_2)){
		$total = $total+$row_2[Ordersde_Price];
	}
	$total = $total+$row[Orders_Delivery_Price];
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
										<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="method" value="1">
												<div class="form-group">
													<label>เลข Order</label>
													<input type="text" class="form-control" id="Orders_Id" name="Orders_Id" maxlength="12" value="<?=$row[Orders_Id];?>" required>
												</div>
												<div class="form-group">
													<label>โอนเข้าธนาคาร</label>
													<select class="form-control" name="Orders_PaymentBank" id="Orders_PaymentBank" required>
														<option value="">- เลือกธนาคาร -</option>
														<!--<option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>-->
														<option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
													</select>
												</div>
												<div class="form-group">
													<label>ยอดการโอนเงิน</label>
													<input type="number" min="0" step="0.01" class="form-control" id="Orders_PaymentTransfer" name="Orders_PaymentTransfer" value="<?=number_format($total,2,'.','');?>" required>
												</div>
												<div class="form-group">
													<label>วันที่โอนเงิน</label>
													<input type="date" class="form-control" id="Orders_PaymentDate" name="Orders_PaymentDate" required>
												</div>
												<div class="form-group">
													<label>เวลาที่โอนเงิน</label>
													<input type="time" class="form-control" id="Orders_PaymentTime" name="Orders_PaymentTime" required>
												</div>
												<div class="form-group">
													<label>แนบหลักฐาน</label>
													<input type="file" id="Orders_PaymentDoc" name="Orders_PaymentDoc" required>
												</div>
												<button type="submit" class="btn btn-success">submit</button>
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