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
	$newfilename = 'upload_bproduct.' . end($temp);
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
	$pcode = $result['รหัสสินค้า'];
	$thname = $result['ชื่อสินค้า_ไทย'];
	$enname = $result['ชื่อสินค้า_อังกฤษ'];
	$procate = $result['รหัสหมวดหมู่สินค้า'];
	$proamount = $result['จำนวนหน่วยซื้อ'];
	$Unit_Code = $result['รหัสหน่วยซื้อ'];
	$Product_Cost = $result['ราคาซื้อ'];
	$Product_Weigh = $result['น้ำหนักต่อหน่วยซื้อย่อย​(เช่นกรัม)'];
	$Product_Vat = $result['ภาษี (1 = มี)'];
	$Supplier_Id = $result['รหัสผู้ขาย'];
	
	if($pcode!=""){
		$sql_1 = "SELECT * FROM fs_product WHERE Product_Code = '$pcode'";
		$result_1 = mysqli_query($conn, $sql_1);
		$row_count = mysqli_num_rows($result_1);
		if($row_count == "0"){
			$sql_2 = "INSERT INTO fs_product (Product_Code,Product_ThName,Product_EnName,ProductCategory_Code,Market_Product_Amount,Unit_Code,
					Product_Cost,Product_Weigh,Product_Vat,Supplier_Id) 
					VALUES ('$pcode','$thname','$enname','$procate','$proamount','$Unit_Code','$Product_Cost','$Product_Weigh','$Product_Vat','$Supplier_Id')";
			mysqli_query($conn, $sql_2);
		}else{
			$sql_2 = "UPDATE fs_product SET
					Product_ThName = '$thname', 
					Product_EnName = '$enname', 
					Product_Image = '$proimage',
					ProductCategory_Code = '$procate',
					Market_Product_Amount = '$proamount', 
					Unit_Code = '$Unit_Code', 
					Product_Cost = '$Product_Cost', 
					Product_Weigh = '$Product_Weigh', 
					Product_Vat = '$Product_Vat', 
					Supplier_Id = '$Supplier_Id' 
					WHERE Product_Code like '$pcode'";
			mysqli_query($conn, $sql_2);
		}
	}
}
header("location: list_buyproduct.php?page=1&msg=1");
?>