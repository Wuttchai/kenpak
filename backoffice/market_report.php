<?php
include "config/connect.php";

echo "<center><h3>ใบคุมตลาด</h3></center>";
?>
<table border="1" width="100%">
<?php
$sql = "SELECT * FROM fs_orders_detail 
		LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
		LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code
		LEFT JOIN fs_product ON fs_sell_product.Product_Code = fs_product.Product_Code 
		LEFT JOIN fs_unit ON fs_product.Unit_Code = fs_unit.Unit_Code 
		WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' 
		GROUP BY fs_sell_product.Product_Code,fs_product.Product_ThName ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$sql_in = "SELECT * FROM fs_orders_detail 
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
				WHERE fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_sell_product.Product_Code = '$row[Product_Code]'";
		$result_in = mysqli_query($conn, $sql_in);
		if(mysqli_num_rows($result_in) > 0) {
			$sum = 0;
			while($row_in = mysqli_fetch_assoc($result_in)) {
				$sum = $sum+($row_in[Ordersde_Amount]*$row_in[SellProduct_Buy_Amount]);
			}
		}
?>
	<tr>
		<td colspan="2"><h3> รหัสสินค้า : <?=$row[Product_Code]?></h3></td>
		<td><h3> ชื่อสินค้า : <?=$row[Product_ThName]?></h3></td>
		<td><h3> จำนวนการสั่งซื้อ : <?=$sum?> <?=$row[Unit_ThName]?></h3></td>
	</tr>
	<?php
		$sql_in = "SELECT * FROM fs_orders_detail 
				LEFT JOIN fs_orders ON fs_orders_detail.Orders_Id = fs_orders.Orders_Id 
				LEFT JOIN fs_sell_product ON fs_orders_detail.SellProduct_Code = fs_sell_product.SellProduct_Code 
				WHERE  fs_orders.Orders_S_Date = '$_GET[ddate]' AND fs_sell_product.Product_Code = '$row[Product_Code]' ORDER BY fs_orders_detail.SellProduct_Code";
		$result_in = mysqli_query($conn, $sql_in);
		if(mysqli_num_rows($result_in) > 0) {
			while($row_in = mysqli_fetch_assoc($result_in)) {
	?>
	<tr>
		<td> --- </td>
		<td> รหัสสินค้า : <?=$row_in[SellProduct_Code]?></td>
		<td> <?=$row_in[SellProduct_ThName]?></td>
		<td>  น้ำหนัก <?=$row_in[SellProduct_Buy_Amount]?> <?=$row[Unit_ThName]?> * <?=$row_in[Ordersde_Amount]?></td>
	</tr>
<?php
			}
		}
	}
}
?>
</table>