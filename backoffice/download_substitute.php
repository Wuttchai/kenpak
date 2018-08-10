<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include("tcpdf/class/class_curl.php");
include "config/connect.php";

// การตั้งค่าข้อความ ที่เกี่ยวข้องให้ดูในไฟล์ 
// tcpdf / config /  tcpdf_config.php 

// เริ่มสร้างไฟล์ pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$PDF_HEADER_LOGO = "../../image/header.jpg";

// กำหนดรายละเอียดของไฟล์ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('afreshdelivery');
$pdf->SetTitle('Template');
$pdf->SetSubject('TCPDF ทดสอบ');
$pdf->SetKeywords('TCPDF, PDF, ทดสอบ,ninenik, guide');

// กำหนดข้อความส่วนแสดง header
$pdf->SetHeaderData($PDF_HEADER_LOGO, 180, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));

/*$pdf->setFooterData(
    //array(0,64,0),  // กำหนดสีของข้อความใน footer rgb 
   // array(220,44,44)   // กำหนดสีของเส้นคั่นใน footer rgb 
);*/

// remove default header/footer
$pdf->setPrintHeader(TRUE);
$pdf->setPrintFooter(false);


// กำหนดฟอนท์ของ header และ footer  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// ำหนดฟอนท์ของ monospaced  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// กำหนดขอบเขตความห่างจากขอบ  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
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

function convert($number){ 
	$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
	$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
	$number = str_replace(",","",$number); 
	$number = str_replace(" ","",$number); 
	$number = str_replace("บาท","",$number); 
	$number = explode(".",$number); 
	if(sizeof($number)>2){ 
		return 'ทศนิยมหลายตัวนะจ๊ะ'; 
		exit; 
	} 
	$strlen = strlen($number[0]); 
	$convert = ''; 
	for($i=0;$i<$strlen;$i++){ 
		$n = substr($number[0], $i,1); 
		if($n!=0){ 
			if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
			elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
			elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
			else{ $convert .= $txtnum1[$n]; } 
			$convert .= $txtnum2[$strlen-$i-1]; 
		} 
	} 

	$convert .= 'บาท'; 
	if($number[1]=='0' OR $number[1]=='00' OR 
	$number[1]==''){ 
		$convert .= 'ถ้วน'; 
	}else{ 
	$strlen = strlen($number[1]); 
	for($i=0;$i<$strlen;$i++){ 
		$n = substr($number[1], $i,1); 
		if($n!=0){ 
		if($i==($strlen-1) AND $n==1){$convert 
		.= 'เอ็ด';} 
		elseif($i==($strlen-2) AND 
		$n==2){$convert .= 'ยี่';} 
		elseif($i==($strlen-2) AND 
		$n==1){$convert .= '';} 
		else{ $convert .= $txtnum1[$n];} 
		$convert .= $txtnum2[$strlen-$i-1]; 
		} 
	} 
	$convert .= 'สตางค์'; 
	} 
	return $convert; 
} 

ob_start();
?>
<font style="text-align: right;">วันที่ <?=$_GET[ddate]?></font>
<div style="text-align: center; font-size: 22px; font-weight: bold;">ใบรับรองแทนใบเสร็จรับเงิน</div>

<table border="1" width="100%">
	<tr>
		<td width="7%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">ลำดับ</font></td>
		<td width="43%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">รายละเอียดรายจ่าย</font></td>
		<td width="10%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">จำนวน</font></td>
		<td width="10%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">หน่วย</font></td>
		<td width="15%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">ราคาต่อหน่วย</font></td>
		<td width="15%" style="text-align: center;"><font style="font-size: 18px;font-weight: bold;">ราคารวม</font></td>
	</tr>
	<?php 
		$i = 1;
		$total = 0;
		$sql = "SELECT * FROM fs_stock 
				LEFT JOIN fs_sell_product ON fs_stock.Product_Code = fs_sell_product.SellProduct_Code 
				LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
				LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
				WHERE fs_stock.Stock_CreateDate = '$_GET[ddate]' AND Stock_Status = '2' 
				GROUP BY fs_stock.Product_Code";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				
				$total_amount = 0;
				$total_price = 0;
				$sql_in = "SELECT * FROM fs_stock 
				LEFT JOIN fs_sell_product ON fs_stock.Product_Code = fs_sell_product.SellProduct_Code 
				LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
				WHERE fs_stock.Stock_CreateDate = '$_GET[ddate]' AND fs_product.Product_Code ='$row[Product_Code]'";
				$result_in = mysqli_query($conn, $sql_in);
				while($row_in = mysqli_fetch_assoc($result_in)) {
					$total_amount = $total_amount + $row_in[Stock_Amount];
					$total_price = $total_price + ($row_in[Stock_Amount]*$row_in[Stock_UnitPrice]);
				}
	?>
		<tr>
			<td style="text-align: center; font-size: 16px;"> <?=$i?> </td>
			<td style="font-size: 16px;"> <?=$row[Product_Code]?> : <?=$row[Product_ThName]?> </td>
			<td style="text-align: center; font-size: 16px;"> <?=$total_amount?> </td>
			<td style="text-align: center;"> <?=$row[Unit_ThName]?> </td>
			<td style="text-align: right; font-size: 16px;"> <?=number_format(($total_price/$total_amount),2)?>&nbsp;&nbsp;</td>
			<td style="text-align: right; font-size: 16px;"> <?=number_format($total_price,2)?>&nbsp;&nbsp;</td>
		</tr>
	<?php
			$i++;
			$total = $total + $total_price;
			}
		}
	?>
	<tr>
		<td colspan="5" width="85%" style="text-align: center; font-size: 16px; font-weight: bold;">รวมเป็นเงิน</td>
		<td width="15%" style="text-align: right; font-size: 16px;"> <?=number_format($total,2)?>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6" width="100%" style="text-align: left; font-size: 16px; font-weight: bold;"> จำนวนเงินรวมทั้งสิ้น (เป็นตัวอักษร) <?php echo convert(str_replace(",","",number_format($total,2))); ?></td>
	</tr>
</table>
<hr><hr><hr>
<table border="1" width="100%">
	<tr>
		<td width="100%">
			<table border="0" width="100%">
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: left; font-size: 16px;"> ข้าพเจ้า…...…วิจิตรา..จันทร์ผะกา........(ผู้เบิกจ่าย) ตำแหน่ง...…พนักงานจัดซื้อ…… </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: left; font-size: 16px;"> ขอรับรองว่ารายจ่ายข้างต้นนี้ไม่อาจเรียกเก็บใบเสร็จรับเงินจากผู้รับได้ และข้าพเจ้าได้จ่ายไปในงานของทางบริษัทศรีไทย อินเตอร์ โลจิสติกส์ จำกัด โดยแท้  </td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: left; font-size: 16px;"> ลงชื่อ..................................................................................................(ผู้เบิกจ่าย) </td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: left; font-size: 16px;"> ลงชื่อ..................................................................................................(ผู้อนุมัติ) </td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: left; font-size: 16px;"> ลงชื่อ..................................................................................................(ผู้จ่าย) </td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>									
<?
$html=ob_get_clean();


// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// แสดงไฟล์ pdf
$pdf->Output('invoice.pdf', 'I');
?>