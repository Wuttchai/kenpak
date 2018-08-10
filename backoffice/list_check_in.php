<?php
$page = "smg01";
$page_name = "Check In.";

include "config/connect.php";


if($_REQUEST[method]=="1"){
	
	?><script type="text/javascript">top.clearData();</script><?
	
	echo $sql2 = "SELECT * FROM fs_orders_detail WHERE Ordersde_Barcode = '$_REQUEST[barcode]' ";
	$result2 = mysqli_query($conn, $sql2);
	if(mysqli_num_rows($result2)>0) {
		$row2 = mysqli_fetch_assoc($result2);
		
		if($row2[Ordersde_Flag]==0) {
			$error = 0;
		 } else {
			 if($row2[Ordersde_Flag]==1) {
				$error = 1;
				$texterror = "Error : Already scanned."; 
			 } else {
				 $error = 1;
			 	 $texterror = "Error : Already scanned."; 
			 }
		 }
		
		if($error==1) {
			?><script type="text/javascript">top.beepError();setTimeout(function(){ alert('<?=$texterror?>');top.clearData(); }, 500);</script><?
			exit();
		}
		
		//$sql = "UPDATE orders_detail_market SET odm_status = '2', incomplate_status = '0' Where barcode = '$_REQUEST[barcode]' AND market_date = CURRENT_DATE() ";
		$sql = "UPDATE fs_orders_detail SET Ordersde_Flag = '1' Where Ordersde_Barcode = '$_REQUEST[barcode]' ";
		$result = mysqli_query($conn, $sql);
		
		$sql2 = "SELECT * FROM fs_orders_detail 
		LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
		WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' 
		AND fs_orders_detail.Ordersde_Flag = '0'";
		$result2 = mysqli_query($conn, $sql2);
		$num_rows2 = mysqli_num_rows($result2);
		
		?><script type="text/javascript">top.reloadData('<?=$_REQUEST[barcode]?>','<?=$num_rows2?>');</script><?
	
	} else {
		?><script type="text/javascript">top.beepError();setTimeout(function(){ alert('Data not found.');top.clearData(); }, 100);</script><?
	}
	
	
	exit();
}

$sql = "SELECT * FROM fs_orders_detail 
		LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
		WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' 
		AND fs_orders_detail.Ordersde_Flag = '0' ";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

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
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption font-red-sunglo">
											<span class="caption-subject bold uppercase"><?=$page_name?> : Delivery Date (<?=$_GET[ddate]?>)</span>
										</div>
									</div>
									<form id="myForm" name="myForm" method="post" action="list_check_in.php?ddate=<?=$_GET[ddate]?>" target="zxcv" onSubmit="DelayedSubmission()">
									<input type="hidden" name="method" id="method" value="1">
									<div class="row">
										<div class="col-md-2">Date Barcode : </div>
										<div class="col-md-12"><input type="text" name="barcode" id="barcode"  autofocus size="60" class="form-control spinner" autocomplete="off" ></div>
									</div>
									</form>
									<div class="row">
										<div class="col-md-12">
											<!-- BEGIN EXAMPLE TABLE PORTLET-->
											<div class="portlet light bordered">
												<div class="portlet-title">
													<div class="caption font-dark">
														<i class="icon-settings font-dark"></i>
														<span class="caption-subject bold uppercase">รายการที่ยังไม่ได้ Scan (<font class="_alldatashow"><?=$num_rows;?></font>)</span>
														<!--<a class="btn btn-sm green-meadow" data-toggle="modal" href="#responsive"> <i class="icon-plus"></i> Add Orders </a> -->
													</div>
													<div class="tools"> </div>
												</div>
												<div class="portlet-body">
													<table class="table table-striped table-bordered table-hover" id="sample_1">
														<thead>
															<tr>
																<th> # </th>
																<th> Barcode </th>
																<th> Product </th>
															</tr>
														</thead>
														<tbody>
															<?php
																if ($num_rows > 0) {
																	// output data of each row
																	$i = 1;
																	while($row = mysqli_fetch_assoc($result)) {
															?>
															<tr class="_barcode_<?=$row[Ordersde_Barcode]?>">
																<td> <?=$i?> </td>
																<td> <?=$row[Ordersde_Barcode]?> </td>
																<td> <?=$row[SellProduct_ThName]?> </td>
															</tr>
															<?php
																$i++;}}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<!-- END EXAMPLE TABLE PORTLET-->
										</div>
									</div>
								</div>
                                <!-- END EXAMPLE TABLE PORTLET-->
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
		<script language="javascript" type="text/javascript">
			function DelayedSubmission() {
				document.getElementById("barcode").autofocus;
				document.forms["myForm"].submit();
			}
			
			
			function reloadData(runid,numberdata) {
				$('._alldatashow').text(numberdata);
				$('._barcode_'+runid).hide();
				$('#barcode').val('');
				$('#barcode').focus();
				beep();
			}
			
			function clearData() {
				$('#barcode').val('');
				$('#barcode').focus();
			}
			
			</script>
			<script type="text/javascript" src="beep.js"></script>
			<iframe name="zxcv" id="zxcv" width="0" height="0" style="position:absolute; z-index:-9999; left:-100000px;" frameborder="0" scrolling="no"></iframe>

    </body>

</html>