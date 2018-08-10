<?php
include "config/connect.php";
require_once 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/IOFactory.php';
include "config/connect.php";

$target_dir = "temp_docs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$temp = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = 'upload_sproduct.' . end($temp);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "temp_docs/".$newfilename)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}

$inputFileName = "temp_docs/".$newfilename;
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName); 

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}

foreach ($namedDataArray as $result) {
	$SellProduct_Code = $result['รหัสสินค้าขาย'];
	$Product_Code = $result['รหัสสินค้าซื้อ'];
	$SellProduct_ThName = $result['ชื่อสินค้า_ไทย'];
	$SellProduct_Amount = $result['จำนวนขาย(เข่น1)'];
	$SellProduct_Unit_Code = $result['รหัสหน่วยขาย'];
	$SellProduct_Buy_Amount = $result['จำนวนหน่วยซื้อ'];
	$SellProduct_Cost = $result['ราคาขาย'];
	$SellProduct_Weigh = $result['น้ำหนักขาย'];
	$SellProduct_Status = $result['สถานะสินค้า(1=เปิดใช้งาน)'];
	
	$sql_1 = "SELECT * FROM fs_sell_product WHERE SellProduct_Code = '$SellProduct_Code'";
	$result_1 = mysqli_query($conn, $sql_1);
	echo $row_count = mysqli_num_rows($result_1);
	if($row_count == "0"){
		echo $sql_2 = "INSERT INTO fs_sell_product (SellProduct_Code,Product_Code,SellProduct_ThName,SellProduct_Amount,SellProduct_Unit_Code,SellProduct_Buy_Amount,SellProduct_Cost,
				SellProduct_Weigh,SellProduct_Status) 
				VALUES ('$SellProduct_Code','$Product_Code','$SellProduct_ThName','$SellProduct_Amount','$SellProduct_Unit_Code','$SellProduct_Buy_Amount','$SellProduct_Cost',
				'$SellProduct_Weigh','$SellProduct_Status')";
		mysqli_query($conn, $sql_2);
	}else{
		echo $sql_2 = "UPDATE fs_sell_product SET
				Product_Code = '$Product_Code', 
				SellProduct_ThName = '$SellProduct_ThName', 
				SellProduct_Amount = '$SellProduct_Amount',
				SellProduct_Unit_Code = '$SellProduct_Unit_Code',
				SellProduct_Buy_Amount = '$SellProduct_Buy_Amount', 
				SellProduct_Cost = '$SellProduct_Cost', 
				SellProduct_Weigh = '$SellProduct_Weigh', 
				SellProduct_Status = '$SellProduct_Status'  
				WHERE SellProduct_Code like '$SellProduct_Code'";
		mysqli_query($conn, $sql_2);
	}
	echo $pcode."<br>";
}
header("location: list_buyproduct.php?page=1&msg=1");
?>