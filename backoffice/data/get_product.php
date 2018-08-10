<?php
include "../config/connect.php";

$Product_Code = $_GET['Product_Code'];
$sql = "SELECT Product_ThName FROM fs_product WHERE Product_ThName like '%$Product_Code%' ORDER BY Product_ThName";
$query = mysqli_query($conn, $sql);

if(!$query)
	echo mysqli_error($conn);
else
	while( $row = mysqli_fetch_array($query) )
		echo "<option value='".$row[Product_ThName]."'>";
?>