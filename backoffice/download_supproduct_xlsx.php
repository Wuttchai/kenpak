<?php
include "config/connect.php";

$strExcelFileName="download_supproduct.xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql = "SELECT * FROM fs_product ORDER BY Product_Code ASC ";
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
<td>Product_Code</td>
<td>Product_ThName</td>
<td>Product_EnName</td>
<td>Market_Product_Amount</td>
<td>Unit_Code</td>
<td>Product_Cost</td>
<td>Product_Weigh</td>
</tr>
<?php
if($num>0){
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?=$row[Product_Code]?></td>
<td><?=$row[Product_ThName]?></td>
<td><?=$row[Product_EnName]?></td>
<td><?=$row[Market_Product_Amount]?></td>
<td><?=$row[Unit_Code]?></td>
<td><?=$row[Product_Cost]?></td>
<td><?=$row[Product_Weigh]?></td>
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