<?php
include_once 'config/conn.php';
 
if($_POST['province']!=""){
    $sql = "SELECT * FROM tbl_amphur WHERE PROVINCE_ID = '$_POST[province]' ORDER BY AMPHUR_NAME";
	$result = mysqli_query($conn, $sql);
		echo "<option value=\"\">Select</option>";
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value=\"$row[AMPHUR_ID]\">$row[AMPHUR_NAME]</option>";
        }
    }else{
        return false;
    }
}

?>