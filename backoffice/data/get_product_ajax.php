<?php
include "../config/connect.php";

if(isset($_GET[query]))
{
	$output = "";
	$sql = "SELECT Product_ThName FROM fs_product WHERE Product_ThName like '%$_GET[query]%' ORDER BY Product_ThName";
	$query = mysqli_query($conn, $sql);
	$output = "<ul class='list-unstyled'>";
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query))
		{
			$output .= "<li>".$row[Product_ThName]."</li>";
		}
	}else{
		$output .= "<li>Product Not Found</li>";
	}
	$output .= "</u>";
	echo $output;
}
?>