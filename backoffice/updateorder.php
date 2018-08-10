<?php
session_start();
include "config/connect.php";

function plusDAy($num,$date) {
	$tomorrow = date('Y-m-d',strtotime($date . "+$num days"));
	return $tomorrow;
}

$today = substr(date("Y"),2).date("mdHis");

if(date("H:i:s")<="17:00:00") {
	$datesend = plusDAy(1,date("Y-m-d"));
} else {
	$datesend = plusDAy(2,date("Y-m-d"));
}

if($_POST[orders_payment_type]=="1" or $_POST[orders_payment_type]=="4"){
	$order_status = "4";
}else if($_POST[orders_payment_type]=="2" or $_POST[orders_payment_type]=="3"){
	$order_status = "0";
}else{}

$sql_add = "SELECT * FROM fs_delivery_address WHERE Customer_Id = '$_POST[user_id]' AND Delivery_AddId = '$_POST[address]'";
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
						Orders_Delivery_AddZipcode, Orders_Delivery_AddMobile,Order_Flag, Orders_PaymentBank, Orders_PaymentTransfer)
						VALUES ('$today','$_SESSION[cusID]',NOW(), $_POST[orders_payment_type], '$_POST[Orders_S_Date]', '$_POST[orders_delivery_price]', '$order_status',
						'$orders_shopname', '$orders_name', '$orders_address', '$orders_tumbon', '$orders_aumpor', '$orders_province', '$orders_zipcode', '$orders_tel','0','null', 0) ";

$meQeury = mysqli_query($conn, $meSql);

if ($meQeury) {
			$order_id = mysqli_insert_id();
			for ($i = 0; $i < count($_POST['qty']); $i++) {
				$order_detail_quantity = $_POST['qty'][$i];
				$order_detail_price = $_POST['pro_price'][$i];
				$product_id = $_POST['pro_id'][$i];

				$Sql_w = "SELECT SellProduct_Weigh FROM fs_sell_product WHERE SellProduct_Code = '{$product_id}'";
				$Query_w = mysqli_query($conn, $Sql_w);
				$row_w = mysqli_fetch_assoc($Query_w);

				$ordersde_id = $today.str_pad($i+1,3,"0",STR_PAD_LEFT);

				for($j = 1; $j <= $order_detail_quantity; $j++){
					$ordersde_barcode = $today.str_pad($i+1,3,"0",STR_PAD_LEFT).str_pad($j,3,"0",STR_PAD_LEFT);
					$lineSql = "INSERT INTO fs_orders_detail (Ordersde_Id, Ordersde_Barcode, Orders_Id, SellProduct_Code, Ordersde_Amount, Ordersde_Price, Ordersde_Weight,Ordersde_Flag) ";
					$lineSql .= "VALUES (";
					$lineSql .= "'{$ordersde_id}',";
					$lineSql .= "'{$ordersde_barcode}',";
					$lineSql .= "'{$today}',";
					$lineSql .= "'{$product_id}',";
					$lineSql .= "'1',";
					$lineSql .= "'{$order_detail_price}', '$row_w[SellProduct_Weigh]','0'";
					$lineSql .= ") ";
					
					mysqli_query($conn, $lineSql);
				}

			}

			mysqli_close();
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
			unset($_SESSION[cusID]);
			if(substr($_SESSION[fulluser_id],0,1)=="C"){
				header('location: list_template.php?page=1');
			}else{
				header('location: list_order_backof.php?page=1&a=order');
			}
		}else{
			mysqli_close();
			header('location:list_order_backof.php?page=1&a=orderfail');
		}
?>
