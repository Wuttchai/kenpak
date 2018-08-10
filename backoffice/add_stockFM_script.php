<?php
include "config/connect.php";

$sql = "SELECT * FROM fs_orders 
		LEFT JOIN fs_orders_detail ON fs_orders.Orders_Id = fs_orders_detail.Orders_Id 
		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code
		WHERE fs_orders.Orders_Date_Cutoff like '$_POST[fm]' 
		GROUP BY fs_product.Product_Code 
		ORDER BY fs_product.Product_Code ";
$result = mysqli_query($conn, $sql);
$row_count = mysqli_num_rows($result);
$result = mysqli_query($conn, $sql);
$i = 1;

if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		if($row[Product_Code]!=""){
			echo $row[Product_Code]."--->";
			echo $_POST["S_".$row[Product_Code]]."--->";
			echo $_POST["SP_".$row[Product_Code]]."--->";
			echo $_POST["SE_".$row[Product_Code]]."--->";
			echo $_POST["RC_".$row[Product_Code]]."<br>";
			if($_POST["S_".$row[Product_Code]]!="" AND $_POST["SP_".$row[Product_Code]]!="" AND $_POST["SE_".$row[Product_Code]]!=""){
				$today = substr(date("Y"),2).date("mdHis").str_pad($i,3,"0",STR_PAD_LEFT);;
				$sql = "INSERT INTO fs_stock (Stock_Code, Product_Code, Stock_Amount, Stock_UnitPrice, Stock_ExpDate, Rack_Code, Stock_CreateDate) 
						VALUES ('$today', '$row[Product_Code]', '".$_POST["S_".$row[Product_Code]]."', '".$_POST["SP_".$row[Product_Code]]."', '".$_POST["SE_".$row[Product_Code]]."', '".$_POST["RC_".$row[Product_Code]]."', '$_POST[Stock_CreateDate]')";
				mysqli_query($conn, $sql);
				$i++;
			}
		}
	}
}

header('location:list_stock.php?page=1');
?>