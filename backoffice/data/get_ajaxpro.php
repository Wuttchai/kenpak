<?php
include "../config/connect.php";

$sql = "SELECT Product_Code, Product_ThName FROM fs_product WHERE Product_ThName like '%$_GET[query]%' OR Product_Code like '%$_GET[query]%' ORDER BY Product_ThName";
$query = mysqli_query($conn, $sql);
$json = array();
while($row = mysqli_fetch_array($query)){
	$json[] = $row["Product_Code"]."|".$row["Product_ThName"];
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>