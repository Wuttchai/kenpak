<?php
include_once 'config/conn.php';
 
if($_POST['amphoe']!=""){
    $sql = "SELECT * FROM tbl_district WHERE AMPHUR_ID = '$_POST[amphoe]' ORDER BY DISTRICT_NAME";
	$result = mysqli_query($conn, $sql);
		echo "<option value=\"\">Select</option>";
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value=\"$row[DISTRICT_ID]\">$row[DISTRICT_NAME]</option>";
        }
    }else{
        return false;
    }
}

?>