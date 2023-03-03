<?php
error_reporting(0);
ob_start();
session_start();

if(isset($_SESSION['user']) == ""){
    header("location: ../../login");
}else{
    $id = $_SESSION['user'];
    $info = mysqli_query($conn, "SELECT * FROM tbl_studentrecord INNER JOIN tbl_subjectsenrolled ON tbl_studentrecord.Stud_id = tbl_subjectsenrolled.Stud_Id WHERE tbl_subjectsenrolled.Stud_Id = '$id'");
    $g_row = mysqli_fetch_array($info);

    if(empty(mysqli_num_rows($info))){
    	$info = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$id'");
    	$g_row = mysqli_fetch_array($info);
    }
}
?>