<?php
session_start();

if($_SESSION[user_type]=="customer"){
	$type = "C";
}else{
	$type = "A";
}
session_destroy();

if($type == "C"){
	header("location: ../index.php");
}else{
	header("location: index.php");
}
?>