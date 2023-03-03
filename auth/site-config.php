<?php 
/*$conn = mysqli_connect("localhost","root","");
$db = mysqli_select_db($conn, "dbz_vineyard");*/

require("../../../config/db.php");

$config['title'] = "Administrator &#8211; Guadalupe Elementary School";


// Faculty Generate ID
$faculty = "SELECT Fac_id as e FROM tbl_facultyinfo ORDER BY Fac_id DESC";
$faculty_query = mysqli_query($conn, $faculty);
$faculty_row = mysqli_fetch_array($faculty_query);
if($faculty_row['e'] == ""){
    $fac_id = "10001";
}else{
	$str = substr($faculty_row['e'], 1);
	$fac_id = $str + 1;
}
?>