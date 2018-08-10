<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include("tcpdf/class/class_curl.php");
include "config/connect.php";

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
?>
<div style="text-align: center;"><center>แบบฟอร์มการสั่งสินค้า</center></div>

<table border="1" style="">
	<thead>
		<tr>
			<td width="5%"> # </td>
			<td width="15%" style="text-align:center;"> รหัสสินค้าสินค้า </td>
			<td width="55%" style="text-align:center;"> รายการสินค้าสินค้า </td>
			<td width="10%" style="text-align:center;"> ราคา/หน่วย </td>
			<td width="15%" style="text-align:center;"> จำนวนการสั่งซื้อ </td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$sql_cat = "SELECT * FROM fs_productcategory ORDER BY ProductCategory_Code";
			$result_cat = mysqli_query($conn, $sql_cat);
			if(mysqli_num_rows($result_cat) > 0) {
				while($row_cat = mysqli_fetch_assoc($result_cat)) {
		?>
		<tr>
			<td colspan="5" style="background-color:#D3D3D3"> หมวด : <?=$row_cat[ProductCategory_ThName]?></td>
		</tr>
			<?php 
				$sql_in = "SELECT * FROM fs_template_detail 
						LEFT JOIN fs_template ON fs_template_detail.Template_Id = fs_template.Template_Id 
						LEFT JOIN fs_sell_product ON fs_template_detail.SellProduct_Id = fs_sell_product.SellProduct_Id 
						LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
						WHERE fs_product.ProductCategory_Code = '$row_cat[ProductCategory_Code]' AND fs_template.Template_Id = '$_GET[id]' AND fs_template.Customer_Id like '$_SESSION[user_id]'";
				$result_in = mysqli_query($conn, $sql_in);
				$i = 1;
					while($row_in = mysqli_fetch_assoc($result_in)) {
			?>
				<tr>
					<td width="5%"> <?=$i?> </td>
					<td width="15%"> <?=$row_in[SellProduct_Code]?> </td>
					<td width="55%"> <?=$row_in[SellProduct_ThName]?> </td>
					<td width="10%" style="text-align:rigth;"> <?=number_format($row_in[SellProduct_Cost],2)?>  </td>
					<td width="15%">
						
					</td>
				</tr>
			<?php
					$i++;
					}
				}
			}
			?>
	</tbody>
</table>
												
<?
$html=ob_get_clean();
/*$path_info = pathinfo($_SERVER['REQUEST_URI']);
$http = ($_SERVER['REQUEST_SCHEME'])?$_SERVER['REQUEST_SCHEME']."://":"http://";
$host = $_SERVER['SERVER_NAME'];
$pathDir = $path_info['dirname']."/";
$url = $http.$host.$pathDir;*/


// เรียกใช้งาน ฟังก์ชั่นดึงข้อมูลไฟล์มาใช้งาน
//$html = curl_get($url."data_html.php"); // path ไฟล์ 
// ถ้าทดสอบบน server ใช้เป็น http://www.example.com/data_html.php
// ภ้าทดสอบที่เครื่องก็ใช้ http://localhost/data_html.php


// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// แสดงไฟล์ pdf
$pdf->Output('Template.pdf', 'I');
?>