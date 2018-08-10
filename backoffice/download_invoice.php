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

$sql_cus = "SELECT * FROM fs_orders 
		LEFT JOIN fs_customer ON fs_orders.Customer_Id = fs_customer.Customer_Id 
		WHERE fs_orders.Orders_Id = '$_GET[id]'";
$result_cus = mysqli_query($conn, $sql_cus);
$row_cus = mysqli_fetch_assoc($result_cus);

ob_start();
?>
<div style="text-align: center; font-size: 22px; font-weight: bold;"><center>ใบส่งสินค้า (Delivery Receipt)</center></div>

<table border="1" width="100%">
	<tr>
		<td width="50%">
			<table border="0" width="100%">
				<tr>
					<td width="100%"> Customer : <?=$row_cus[Customer_Name]?></td>
				</tr>
				<tr>
					<td width="100%"> Address : <?=$row_cus[Orders_Delivery_AddAddress]?> ตำบล/แขวง<?=$row_cus[Orders_Delivery_AddTumbon]?> อำเภอ/เขต<?=$row_cus[Orders_Delivery_AddAumpor]?> จังหวัด<?=$row_cus[Orders_Delivery_AddProvince]?> <?=$row_cus[Orders_Delivery_AddZipcode]?></td>
				</tr>
				<tr>
					<td width="100%"> Tel : <?=$row_cus[Orders_Delivery_AddMobile]?></td>
				</tr>
				<tr>
					<td width="100%"> สถานะลูกค้า/Customer Status : </td>
				</tr>
				<tr>
					<td width="100%"> ครบกำหนดวันที่ ...../...../.....  </td>
				</tr>
			</table>
		</td>
		<td width="50%">
			<table border="0" width="100%">
				<tr>
					<td width="100%"> วันที่/Date : ...../...../.....  </td>
				</tr>
				<tr>
					<td width="100%"> เลขที่ใบกำกับ /Order No. : <?=$_GET[id]?></td>
				</tr>
				<tr>
					<td width="100%"> พนักงานขาย/Sales Person : </td>
				</tr>
				<tr>
					<td width="100%"> Tel: </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<hr><hr><hr>
<table border="1" width="100%">
	<tr>
		<td width="7%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">ลำดับ</font><br><font style="font-size: 13px; font-weight: bold;">ITEM</font></td>
		<td width="43%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">รายละเอียด</font><br><font style="font-size: 13px; font-weight: bold;">DESCRIPTION</font></td>
		<td width="10%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">จำนวน</font><br><font style="font-size: 13px; font-weight: bold;">QTY.</font></td>
		<td width="10%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">หน่วย</font><br><font style="font-size: 13px; font-weight: bold;">UNIT</font></td>
		<td width="15%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">ราคาต่อหน่วย(บาท)</font><br><font style="font-size: 13px; font-weight: bold;">UNIT PRICE (Baht)</font></td>
		<td width="15%" style="text-align: center;"><font style="font-size: 16px;font-weight: bold;">ราคารวม(บาท)</font><br><font style="font-size: 13px; font-weight: bold;">TOTAL AMOUNT (Baht)</font></td>
	</tr>
	<?php 
		$i = 1;
		$sql = "SELECT * FROM fs_orders 
				LEFT JOIN fs_orders_detail ON fs_orders.Orders_Id = fs_orders_detail.Orders_Id 
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
				WHERE fs_orders_detail.Orders_Id = '$_GET[id]'
				GROUP BY fs_orders_detail.Ordersde_Id";
		$result = mysqli_query($conn, $sql);
		$row_count = mysqli_num_rows($result);
		$total_page = ceil($row_count/$page_rows);
		
		$sql .= " ORDER BY fs_orders_detail.SellProduct_Code DESC";
		$result = mysqli_query($conn, $sql);
		$dc = 0;
		$total = 0;
		
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$dc = $row[Orders_Delivery_Price];
				
				$sql_in = "SELECT * FROM fs_orders_detail 
							WHERE fs_orders_detail.Ordersde_Id = '$row[Ordersde_Id]'";
				$result_in = mysqli_query($conn, $sql_in);
				$num_pro = 0;
				if(mysqli_num_rows($result_in) > 0) {
					while($row_in = mysqli_fetch_assoc($result_in)) {
						$total = $total + $row[Ordersde_Price];
						$num_pro = $num_pro +1;
					}
				}
	?>
		<tr>
			<td style="text-align: center; font-size: 16px;"> <?=$i?> </td>
			<td style="font-size: 16px;"> <?=$row[SellProduct_ThName]?> </td>
			<td style="text-align: center; font-size: 16px;"> <?=$num_pro?> </td>
			<td></td>
			<td style="text-align: right; font-size: 16px;"> <?=number_format($row[Ordersde_Price],2)?>&nbsp;&nbsp;</td>
			<td style="text-align: right; font-size: 16px;"> <?=number_format($num_pro*$row[Ordersde_Price],2)?>&nbsp;&nbsp;</td>
		</tr>
	<?php
			$i++;
			}
		}
	?>
	<tr>
		<td colspan="5" width="85%" style="text-align: center; font-size: 16px; font-weight: bold;">ค่าขนส่ง</td>
		<td width="15%" style="text-align: right; font-size: 16px;"> <?=number_format($dc,2)?>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" width="85%" style="text-align: center; font-size: 16px; font-weight: bold;">รวมเป็นเงิน</td>
		<td width="15%" style="text-align: right; font-size: 16px;"> <?=number_format($total+$dc,2)?>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6" width="100%" style="text-align: left; font-size: 16px; font-weight: bold;"> จำนวนเงินรวมทั้งสิ้น (เป็นตัวอักษร) <?php echo convert(str_replace(",","",number_format($total+$dc,2))); ?></td>
	</tr>
</table>
<hr><hr><hr>
<table border="1" width="100%">
	<tr>
		<td width="50%">
			<table border="0" width="100%">
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px; font-weight: bold;"> ผู้รับของ/Receiver </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> ได้รับสินค้าตามรายการถูกต้องแล้ว </td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> ลงชื่อ.................................................................................................. </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> (.................................................................................) ตัวบรรจง </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> วันที่/Date ................./................./................. </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> เบอร์ติดต่อ/Tel. ....................................................................... </td>
				</tr>
			</table>
		</td>
		<td width="50%">
			<table border="0" width="100%">
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px; font-weight: bold;"> ผู้ส่งของ/Delivered By </td>	
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%"></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> ลงชื่อ.................................................................................................. </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> (.................................................................................) ตัวบรรจง </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> วันที่/Date ................./................./................. </td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center; font-size: 16px;"> เบอร์ติดต่อ/Tel. ....................................................................... </td>
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