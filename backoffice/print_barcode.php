<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include("tcpdf/class/class_curl.php");
include "config/connect.php";

$sql_1 = "UPDATE fs_orders SET 
		Orders_PrintStatus  = '1' 
		WHERE Orders_Date_Cutoff like '$_GET[cutoff]' AND Customer_Id = '$_GET[cid]'";
$result_1 = mysqli_query($conn, $sql_1);
				
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

$sql = "SELECT * FROM fs_orders_detail 
		LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
		WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$_GET[cutoff]' AND fs_orders.Customer_Id = '$_GET[cid]' 
		GROUP BY fs_sell_product.Product_Code,fs_product.Product_ThName ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$sql_in = "SELECT * FROM fs_orders_detail 
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
				WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$_GET[cutoff]' AND fs_orders.Customer_Id = '$_GET[cid]' AND fs_sell_product.Product_Code = '$row[Product_Code]'";
		$result_in = mysqli_query($conn, $sql_in);
		if(mysqli_num_rows($result_in) > 0) {
			$sum = 0;
			while($row_in = mysqli_fetch_assoc($result_in)) {
				$sum = $sum+($row_in[Ordersde_Amount]*$row_in[SellProduct_Buy_Amount]);
			}
		}
		
		$sql_in = "SELECT * FROM fs_orders_detail 
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
				LEFT JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
				WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_orders.Orders_Date_Cutoff = '$_GET[cutoff]' AND fs_orders.Customer_Id = '$_GET[cid]' AND fs_sell_product.Product_Code = '$row[Product_Code]' ORDER BY fs_orders_detail.SellProduct_Code";
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
			<img src="http://chart.apis.google.com/chart?cht=qr&chs=70x70&chld=L|0&chl=<?=$row_in[Ordersde_Barcode]?>"><br>
			<font style="font-weight:bold;"><?=$row_in[Ordersde_Barcode]?></font>
		</td>
		<td>
			product code: <?=$row_in[SellProduct_Code]?><br>
			product: <br>
			<?=$row_in[SellProduct_ThName]?><hr>
			<font style="font-size:20px;font-weight:bold;text-align:center;"><?=$row_in[Ordersde_Amount]?> <?=$row_in[Unit_ThName]?></font>
		</td>
	</tr>
</table>
<hr>
http://www.srithaigo.com
<?
		$html=ob_get_clean();

		// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			}
		}

	}
}
// แสดงไฟล์ pdf
$pdf->Output('Barcode.pdf', 'I');
?>