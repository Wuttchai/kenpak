<?php
/* 
upload_file() Parameters :: 
	$file_name = "<name-in-html>"
	$file_target = "<String-Path>"
	$file_size = <interger>
	$file_type = <"images",>
*/
function upload_file($file_name, $target_dir, $file_size, $file_type){
	$temp = explode(".", $_FILES[$file_name]["name"]);
	$newfilename = round(microtime(true)).".".end($temp);
	$target_file = $target_dir.$newfilename;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if($file_type=="images"){
		$check = getimagesize($_FILES[$file_name]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - ".$check["mime"].".";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		//echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES[$file_name]["size"] > $file_size) {
		//echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($file_type=="images"){
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
	}
	if($file_type=="images,document"){
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
			//echo "Sorry, only JPG, JPEG, PNG & GIF & PDF & DOC & DOCX files are allowed.";
			$uploadOk = 0;
		}
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES[$file_name]["name"]). " has been uploaded.";
			$upload = 1;
		} else {
			//echo "Sorry, there was an error uploading your file.";
			$upload = 0;
		}
	}
	return array($upload, $newfilename);
}
?>