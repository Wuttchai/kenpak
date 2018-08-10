<?php
include "../config/connect.php";

$sql = "SELECT * FROM fs_sell_product WHERE SellProduct_Id NOT IN (SELECT sellProduct_Id FROM fs_template_detail WHERE Template_Id = '$_GET[id]') AND (SellProduct_ThName like '%$_GET[query]%' OR SellProduct_Code like '%$_GET[query]%') ORDER BY SellProduct_ThName ASC";
$query = mysqli_query($conn, $sql);
$json = array();
while($row = mysqli_fetch_array($query)){
	$json[] = $row["SellProduct_Code"]."|".$row["SellProduct_ThName"];
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>