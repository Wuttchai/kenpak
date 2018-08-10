<?php
session_start();

if($_SESSION[user_username]!="" AND $_SESSION[user_id]!=""){
	if($_GET[method]=="del"){
		$key = array_search($_GET[id], $_SESSION[cart_item]);
		array_splice($_SESSION[cart_item],$key,1);
		array_splice($_SESSION[cart_amount],$key,1);
		header("location: carts.php?mg=2");
	}elseif($_POST[method]=="edit"){
		echo "Edit";
		print_r($_POST);
		
		for($x = 0; $x < (count($_POST)-1); $x++) {
			$_SESSION[cart_amount][$x] = $_POST[$x];
		}
		header("location: carts.php?mg=1");
	}else{
		if(isset($_SESSION[cart_item])){
			
			if(($k = array_search($_POST[item_code], $_SESSION[cart_item])) === FALSE){
				array_push($_SESSION[cart_item],$_POST[item_code]);
				array_push($_SESSION[cart_amount],$_POST[item_amount]);
			}else{
				$key = array_search($_POST[item_code], $_SESSION[cart_item]);
				$new_amount = $_SESSION[cart_amount][$key] + $_POST[item_amount];
				$_SESSION[cart_amount][$key] = $new_amount;
			}
			
		}else{
			if(isset($_SESSION[cart_amount])){
				
			}else{
				$_SESSION[cart_amount] = array();
				array_push($_SESSION[cart_amount],$_POST[item_amount]);
			}
			$_SESSION[cart_item] = array();
			array_push($_SESSION[cart_item],$_POST[item_code]);
		}

		header("location: products.php?page=1&mg=1");
	}
}else{
	header("location: login.php");
}

?>