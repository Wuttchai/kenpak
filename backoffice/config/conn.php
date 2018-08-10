<?php
error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_center";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn,"utf8");

?>