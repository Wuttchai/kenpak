<?php
session_start();
include "config/connect.php";


$today = substr(date("Y"),2).date("mdHis");

if($_POST[orders_payment_type]=="1" or $_POST[orders_payment_type]=="4"){
	$order_status = "4";
}else if($_POST[orders_payment_type]=="2" or $_POST[orders_payment_type]=="3"){
	$order_status = "0";
}else{}

$sql_add = "SELECT * FROM fs_delivery_address WHERE Customer_Id = '$_SESSION[user_id]' AND Delivery_AddId = '$_POST[address]'";
$result_add = mysqli_query($conn, $sql_add);
$row_add = mysqli_fetch_assoc($result_add);
		$orders_shopname = $row_add[Delivery_AddShop];
		$orders_name = $row_add[Delivery_AddName];
		$orders_address = $row_add[Delivery_AddAddress];
		$orders_tumbon = $row_add[Delivery_AddTumbon];
		$orders_aumpor = $row_add[Delivery_AddAumpor];
		$orders_province = $row_add[Delivery_AddProvince];
		$orders_zipcode = $row_add[Delivery_AddZipcode];
		$orders_tel = $row_add[Delivery_AddMobile];

		
$meSql = "INSERT INTO fs_orders (Orders_Id, Customer_Id, Orders_CreateTime, Orders_PaymentType, Orders_S_Date, Orders_Delivery_Price, Order_Status, 
		Orders_Delivery_AddShop, Orders_Delivery_AddName, Orders_Delivery_AddAddress, Orders_Delivery_AddTumbon, Orders_Delivery_AddAumpor, Orders_Delivery_AddProvince, 
		Orders_Delivery_AddZipcode, Orders_Delivery_AddMobile,Order_Flag) 
		VALUES ('$today','$_SESSION[user_id]',NOW(), $_POST[orders_payment_type], '$_POST[Orders_S_Date]', '$_POST[orders_delivery_price]', '$order_status', 
		'$orders_shopname', '$orders_name', '$orders_address', '$orders_tumbon', '$orders_aumpor', '$orders_province', '$orders_zipcode', '$orders_tel','0') ";
$meQeury = mysqli_query($conn, $meSql);


if ($meQeury) {
	$order_id = mysqli_insert_id();
	for($x = 0; $x < count($_SESSION[cart_item]); $x++) {
		$ordersde_id = $today.str_pad($x+1,3,"0",STR_PAD_LEFT);
		
		$sql = "SELECT * FROM fs_sell_product 
				INNER JOIN fs_unit ON fs_sell_product.SellProduct_Unit_Code = fs_unit.Unit_Code 
				WHERE fs_sell_product.SellProduct_Code = '".$_SESSION[cart_item][$x]."'";
		$query = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($query);
		
		for($y = 1; $y <= $_SESSION[cart_amount][$x]; $y++) {
			$ordersde_barcode = $ordersde_id.str_pad($y,3,"0",STR_PAD_LEFT);
			$lineSql = "INSERT INTO fs_orders_detail (Ordersde_Id, Ordersde_Barcode, Orders_Id, SellProduct_Code, Ordersde_Amount, Ordersde_Price, 
						Ordersde_Weight,Ordersde_Flag) VALUES ('$ordersde_id','$ordersde_barcode','$today','".$_SESSION[cart_item][$x]."','1','$data[SellProduct_Cost]',
						'$data[SellProduct_Weigh]','0')";
			mysqli_query($conn, $lineSql);
		}
	}
}

mysqli_close();
unset($_SESSION[cart_item]);
unset($_SESSION[cart_amount]);
echo "<script>alert('บันทึกข้อมูลการสั่งซื้อเรียบร้อย ขอบคุณค่ะ'); window.location.href='history_order.php?page=1'</script>";
?>