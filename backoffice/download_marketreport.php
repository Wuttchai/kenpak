 <?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include("tcpdf/class/class_curl.php");
include "config/connect.php";

if($_GET[Cutoff]==""){
	$today = date("YmdHis");
	$day_cutoff = $today;
}else{
	$day_cutoff = $_GET[Cutoff];
}

if($_GET[method]==1){
	$sql = "SELECT * FROM fs_orders
			WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = ''";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$id_order = $_GET["o_".$row[Orders_Id]];
			if($id_order == "1"){
				$sql_1 = "UPDATE fs_orders SET
						Orders_Date_Cutoff  = '$day_cutoff'
						WHERE Orders_Id like '$row[Orders_Id]'";
				$result_1 = mysqli_query($conn, $sql_1);
			}
		}
	}
}
// การตั้งค่าข้อความ ที่เกี่ยวข้องให้ดูในไฟล์
// tcpdf / config /  tcpdf_config.php

// เริ่มสร้างไฟล์ pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// กำหนดรายละเอียดของไฟล์ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('afreshdelivery');
$pdf->SetTitle('Template');
$pdf->SetSubject('TCPDF ทดสอบ');
$pdf->SetKeywords('TCPDF, PDF, ทดสอบ,ninenik, guide');

// กำหนดข้อความส่วนแสดง header
/*$pdf->SetHeaderData(
    //PDF_HEADER_LOGO, // โลโก้ กำหนดค่าในไฟล์  tcpdf_config.php
    //PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001',
    //PDF_HEADER_STRING, // กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php
   // array(0,0,0),  // กำหนดสีของข้อความใน header rgb
    //array(0,0,0)   // กำหนดสีของเส้นคั่นใน header rgb
);*/

/*$pdf->setFooterData(
    //array(0,64,0),  // กำหนดสีของข้อความใน footer rgb
   // array(220,44,44)   // กำหนดสีของเส้นคั่นใน footer rgb
);*/

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// กำหนดฟอนท์ของ header และ footer  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// ำหนดฟอนท์ของ monospaced  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// กำหนดขอบเขตความห่างจากขอบ  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// กำหนดแบ่่งหน้าอัตโนมัติ
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// กำหนดสัดส่วนของรูปภาพ  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// อนุญาตให้สามารถกำหนดรุปแบบ ฟอนท์ย่อยเพิมเติมในหน้าใช้งานได้
$pdf->setFontSubsetting(true);

// กำหนด ฟอนท์
$pdf->SetFont('thsarabun', '', 14, '', true);

// เพิ่มหน้า
$pdf->AddPage();

ob_start();
if($_GET[doc_type]=="1"){$doc_name = "ใบคุมสั่งซื้อตลาด";}
elseif($_GET[doc_type]=="2"){$doc_name = "ใบคุมสต๊อคสินค้า";}
elseif($_GET[doc_type]=="3"){$doc_name = "ใบคุมเต็มรูปแบบ (สต๊อคและตลาด)";}
?>
<div style="text-align:center; font-weight: bold; font-size:22px;"><center><?=$doc_name;?> วันที่ <?=$_GET[ddate];?><br> รอบที่ : <?php if($_GET[Cutoff]==""){echo "รอบที่ 1";} else {echo $_GET[Cutoff];}?></center></div>
<br>

<?php
if($_GET[doc_type]=="1"){
?>
	<table border="1" width="100%">
		<tr>
			<td width="6%" align="center"><b>#</b></td>
			<td width="9%" align="center"><b>รหัส</b></td>
			<td width="51%" align="center"><b>ชื่อสินค้า</b></td>
			<td width="12%" align="center"><b>ปริมาณ/แพ็ค</b></td>
			<td width="12%" align="center"><b>จำนวนแพ็ค</b></td>
			<td width="10%" align="center"><b>ราคา/แพ็ค</b></td>
		</tr>
		<?php
			$i = 1;
			$sql = "SELECT fs_product.Product_Code,sum(fs_orders_detail.Ordersde_Amount) AS pro_aomunt,fs_product.Product_ThName,fs_product.Market_Product_Amount,fs_unit.Unit_ThName FROM fs_orders_detail
					LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
					LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
					LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code
					LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code
					WHERE fs_orders.Orders_S_Date = '$_GET[ddate]'
					OR fs_orders.Orders_Date_Cutoff = '$day_cutoff'
					GROUP BY fs_sell_product.Product_Code";
			$result = mysqli_query($conn, $sql);
      
			if(mysqli_num_rows($result) != 's') {

				while($row = mysqli_fetch_assoc($result)) {
					$sql_stock = "SELECT sum(Stock_Amount) AS stock_amount FROM fs_stock
								WHERE Product_Code = '$row[Product_Code]'
								AND Stock_ExpDate >= '$_GET[ddate]'
								AND Stock_Status = '2'
								GROUP BY Product_Code";
					$query_stock = mysqli_query($conn, $sql_stock);

					if(mysqli_num_rows($query_stock) > 0) {
						while($row_stock = mysqli_fetch_assoc($query_stock)) {
							if(($row[pro_aomunt]-$row_stock[stock_amount])>0){
								//echo "ต้องซื้อ ===> ".ceil(($row[pro_aomunt]-$row_stock[stock_amount])/$row[Market_Product_Amount])."<br>";
								echo 	'<tr>';
								echo	'<td width="6%" align="left"> '.$i.'</td>';
								echo	'<td width="9%" align="left"> '.$row[Product_Code].'</td>';
								echo	'<td width="51%" align="left"> '.$row[Product_ThName].'</td>';
								echo	'<td width="12%" align="right"> '.$row[Market_Product_Amount].' '.$row[Unit_ThName].'&nbsp;&nbsp;</td>';
								echo	'<td width="12%" align="center"> '.ceil(($row[pro_aomunt]-$row_stock[stock_amount])/$row[Market_Product_Amount]).'</td>';
								echo	'<td width="10%"></td>';
								echo	'</tr>';
								$i++;
							}
						}
					}else{
						//echo "ต้องซื้อ ===> ".ceil(($row[pro_aomunt]-$row_stock[stock_amount])/$row[Market_Product_Amount])."<br>";
						echo 	'<tr>';
						echo	'<td width="6%" align="left"> '.$i.'</td>';
						echo	'<td width="9%" align="left"> '.$row[Product_Code].'</td>';
						echo	'<td width="51%" align="left"> '.$row[Product_ThName].'</td>';
						echo	'<td width="12%" align="right"> '.$row[Market_Product_Amount].' '.$row[Unit_ThName].'&nbsp;&nbsp;</td>';
						echo	'<td width="12%" align="center"> '.ceil(($row[pro_aomunt]-$row_stock[stock_amount])/$row[Market_Product_Amount]).'</td>';
						echo	'<td width="10%"></td>';
						echo	'</tr>';
						$i++;
					}
				}
			}
		?>
	</table>

<?php }elseif($_GET[doc_type]=="2"){ ?>
	<table border="1" width="100%">
		<tr>
			<td width="17%" align="center"> <b>รหัสสต๊อก</b> </td>
			<td width="68%" align="center"> <b>รหัสสินค้า : ชื่อสินค้า<?=$row_stock[Product_Code]?> (วันหมดอายุ)</b></td>
			<td width="15%" align="center"> <b> จำนวนสินค้า </b></td>
		</tr>
		<?php
		$sql = "SELECT * FROM fs_orders_detail
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
				LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code
				LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code
				WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$day_cutoff'
				GROUP BY fs_sell_product.Product_Code,fs_product.Product_ThName ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$sql_in = "SELECT * FROM fs_orders_detail
						LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
						LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
						WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$day_cutoff' AND fs_sell_product.Product_Code = '$row[Product_Code]'";
				$result_in = mysqli_query($conn, $sql_in);
				if(mysqli_num_rows($result_in) > 0) {
					$sum = 0;
					while($row_in = mysqli_fetch_assoc($result_in)) {
						$sum = $sum+($row_in[Ordersde_Amount]*$row_in[SellProduct_Buy_Amount]);
					}
				}
				$sum_temp = $sum;

				$sql_stock = "SELECT * FROM fs_stock WHERE Product_Code = '$row[Product_Code]' AND Stock_ExpDate >= '$_GET[ddate]' AND Stock_Status = '2' ORDER BY Stock_ExpDate";
				$query_stock = mysqli_query($conn, $sql_stock);
				$numrows_stock = mysqli_num_rows($query_stock);
				if($numrows_stock >=1){
					while($row_stock = mysqli_fetch_assoc($query_stock) AND $sum_temp > 0) {
			?>
			<tr>
				<td> <?=$row_stock[Stock_Code]?> </td>
				<td> <?=$row_stock[Product_Code]?> : <?=$row[Product_ThName]?> (<?=$row_stock[Stock_ExpDate]?>)</td>
				<td align="right"> <?=$row_stock[Stock_Amount]?> <?=$row[Unit_ThName]?> &nbsp;</td>
			</tr>
			<?php
					$sum_temp = $sum_temp-$row_stock[Stock_Amount];
					}
				}
			}
		}
		?>

	</table>
<?php }elseif($_GET[doc_type]=="3"){ ?>
	<table border="1" width="100%">
		<?php
		$sql = "SELECT * FROM fs_orders_detail
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
				LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code
				LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code
				WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$day_cutoff'
				GROUP BY fs_sell_product.Product_Code,fs_product.Product_ThName ";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$sql_in = "SELECT * FROM fs_orders_detail
						LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
						LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
						WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$day_cutoff' AND fs_sell_product.Product_Code = '$row[Product_Code]'";
				$result_in = mysqli_query($conn, $sql_in);
				if(mysqli_num_rows($result_in) > 0) {
					$sum = 0;
					while($row_in = mysqli_fetch_assoc($result_in)) {
						$sum = $sum+($row_in[Ordersde_Amount]*$row_in[SellProduct_Buy_Amount]);
					}
				}
				$sum_temp = $sum;
				$total_stock = 0;
		?>
			<tr bgcolor="#D3D3D3">
				<td colspan="2" width="65%"> <b>รหัส : <?=$row[Product_Code]?> (<?=$row[Product_ThName]?>)</b></td>
				<td width="13%"> <b>จำนวนใช้งาน : </b></td>
				<td width="22%" align="right"> <b><?=$sum?> <?=$row[Unit_ThName]?>&nbsp;&nbsp;</b></td>
			</tr>
			<?php
				$sql_stock = "SELECT * FROM fs_stock WHERE Product_Code = '$row[Product_Code]' AND Stock_ExpDate >= '$_GET[ddate]' AND Stock_Status = '2' ORDER BY Stock_ExpDate";
				$query_stock = mysqli_query($conn, $sql_stock);
				$numrows_stock = mysqli_num_rows($query_stock);
				if($numrows_stock >=1){
					echo "<tr><td colspan=\"4\"> <b>มีในคลังสินค้า </b></td></tr>";
					while($row_stock = mysqli_fetch_assoc($query_stock) AND $sum_temp > 0) {

			?>
			<tr>
				<td width="15%"> <?=$row_stock[Stock_Code]?> </td>
				<td width="63%" colspan="2"> รหัสสต๊อก : <?=$row_stock[Product_Code]?> (วันหมดอายุ : <?=$row_stock[Stock_ExpDate]?>)</td>
				<td align="right"> <?=$row_stock[Stock_Amount]?> <?=$row[Unit_ThName]?> &nbsp;</td>
			</tr>
			<?php
						$sum_temp = $sum_temp-$row_stock[Stock_Amount];
						$total_stock = $total_stock+$row_stock[Stock_Amount];
					}
			?>
			<tr>
				<td colspan="3" align="right"> <b> รวม   &nbsp;</b></td>
				<td align="right">  <b><?=($total_stock);?> <?=$row[Unit_ThName]?> &nbsp;</b></td>
			</tr>
			<?php
				}
				$sql_in = "SELECT * FROM fs_orders_detail
						LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id
						LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
						WHERE  fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$day_cutoff' AND fs_sell_product.Product_Code = '$row[Product_Code]' ORDER BY fs_orders_detail.SellProduct_Code";
				$result_in = mysqli_query($conn, $sql_in);

				if(mysqli_num_rows($result_in) > 0) {
					?>
					<tr>
						<td colspan="3"> <b>สั่งซื้อตลาด </b></td>
						<td align="right"><b><?php if(($sum-$total_stock)<=0){echo "0";}else{echo ($sum-$total_stock);}?> <?=$row[Unit_ThName]?> (<?php if(($sum-$total_stock)<=0){echo "0";}else{echo ceil($sum/$row[Market_Product_Amount]);}?> Unit)&nbsp;&nbsp;</b></td>
					</tr>
					<tr>
						<td colspan="3" align="right"><b>เหลือ Stock &nbsp;</b></td>
						<td align="right"> <b><?=(ceil(($sum-$total_stock)/$row[Market_Product_Amount])*$row[Market_Product_Amount])-($sum-$total_stock)?> <?=$row[Unit_ThName]?>&nbsp;&nbsp;</b></td>
					</tr>
					<tr>
						<td colspan="4"> <b>รายละเอียดการสั่งซื้อ </b></td>
					</tr>
					<?php
					while($row_in = mysqli_fetch_assoc($result_in)) {
			?>
			<tr>
				<td width="15%"> <?=$row_in[Orders_Id]?> </td>
				<td width="63%" colspan="2"> รหัสขาย : <?=$row_in[SellProduct_Code]?> (<?=$row_in[SellProduct_ThName]?>)</td>
				<td align="right"> <?=$row_in[SellProduct_Buy_Amount]?> <?=$row[Unit_ThName]?> &nbsp;</td>
			</tr>
		<?php
					}
				}
		?>
			<tr>
				<td colspan="3" align="right"><b>รวมจำนวน &nbsp;</b></td>
				<td align="right"> <b><?=$sum?> <?=$row[Unit_ThName]?>&nbsp;&nbsp;</b></td>
			</tr>
		<?php
			}
		}
		?>

	</table>
<?php } ?>
<?
$html=ob_get_clean();


// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// แสดงไฟล์ pdf
$pdf->Output('Template.pdf', 'I');
?>
