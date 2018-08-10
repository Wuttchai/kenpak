<?php
ini_set('display_errors', '0');
ob_start();
session_start();

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fresh_shop";


$servername = "localhost";
$username = "afresh_db";
$password = "2017digital";
$dbname = "afresh_db";*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fresh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>
