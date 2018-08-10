<?php
include "../config/connect.php";

$sql_ajax = "SELECT SellProduct_ThName FROM fs_sell_product WHERE SellProduct_ThName like '%$_GET[query]%' ORDER BY SellProduct_ThName";
$query_ajax = mysqli_query($conn, $sql_ajax);

$json = array();
while($row_ajax = mysqli_fetch_array($query_ajax)){
	$json[] = $row_ajax["SellProduct_ThName"];
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>