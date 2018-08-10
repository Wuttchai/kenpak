<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include("tcpdf/class/class_curl.php");
include "config/connect.php";
				
// การตั้งค่าข้อความ ที่เกี่ยวข้องให้ดูในไฟล์ 
// tcpdf / config /  tcpdf_config.php 

// เริ่มสร้างไฟล์ pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$resolution= array(80, 50);


// กำหนดรายละเอียดของไฟล์ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('afreshdelivery');
$pdf->SetTitle('Barcode');
$pdf->SetSubject('Barcode');
$pdf->SetKeywords('Barcode');
$pdf->SetAutoPageBreak(TRUE, 0);

$pdf->SetPrintHeader(false);
$pdf->setPrintFooter(false);
		
		$sql_in = "SELECT * FROM fs_stock 
				  INNER JOIN fs_product ON fs_stock.Product_Code = fs_product.Product_Code 
				  INNER JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
				  WHERE fs_stock.Stock_Code = '$_GET[id]'";
		$result_in = mysqli_query($conn, $sql_in);
		if(mysqli_num_rows($result_in) > 0) {
			while($row_in = mysqli_fetch_assoc($result_in)) {
				
		// เพิ่มหน้า 
		$pdf->SetMargins(1, 2, 1, true); // set the margins
		$pdf->AddPage('L', $resolution);
		
		ob_start();
?>
<table border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td align="center" valign="middle" >
			<img src="http://chart.apis.google.com/chart?cht=qr&chs=70x70&chld=L|0&chl=<?=$row_in[Stock_Code]?>"><br>
			<font style="font-size:22px;font-weight:bold;"><?=$row_in[Stock_Code]?></font>
		</td>
		<td>
			product code: <?=$row_in[Product_Code]?><br>
			<?=$row_in[Product_ThName]?><hr>
			<font style="font-size:20px;font-weight:bold;text-align:center;"><?=$row_in[Stock_Amount]?> <?=$row_in[Unit_ThName]?></font>
		</td>
	</tr>
</table>
<hr>
<font style="font-size:18px;font-weight:bold;text-align:center;">Rack : <?=$row_in[Rack_Code]?></font>
<?
		$html=ob_get_clean();

		// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			}
		}

// แสดงไฟล์ pdf
$pdf->Output('Barcode.pdf', 'I');
?>