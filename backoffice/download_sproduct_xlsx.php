<?php
include "config/connect.php";

$strExcelFileName="download_sproduct.xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql = "SELECT * FROM fs_sell_product ORDER BY SellProduct_Code ASC ";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td>รหัสสินค้าขาย</td>
<td>รหัสสินค้าซื้อ</td>
<td>ชื่อสินค้า_ไทย</td>
<td>จำนวนขาย(เข่น1)</td>
<td>รหัสหน่วยขาย</td>
<td>จำนวนหน่วยซื้อ</td>
<td>ราคาขาย</td>
<td>น้ำหนักขาย</td>
<td>สถานะสินค้า(1=เปิดใช้งาน)</td>
</tr>
<?php
if($num>0){
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?=$row[SellProduct_Code]?></td>
<td><?=$row[Product_Code]?></td>
<td><?=$row[SellProduct_ThName]?></td>
<td><?=$row[SellProduct_Amount]?></td>
<td><?=$row[SellProduct_Unit_Code]?></td>
<td><?=$row[SellProduct_Buy_Amount]?></td>
<td><?=$row[SellProduct_Cost]?></td>
<td><?=$row[SellProduct_Weigh]?></td>
<td><?=$row[SellProduct_Status]?></td>
</tr>
<?php
}
}
?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>