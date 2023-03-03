<?php
error_reporting(0);
date_default_timezone_set("Asia/Manila");
session_start();
require("../../config/db.php");
if(isset($_POST['ip_address'])){
	$machine = $_SERVER['HTTP_USER_AGENT'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date("F d, Y h:s:i A");

	if(!isset($_SESSION['user'])){
		echo '<script type="text/javascript">window.location.href = "../../login/";</script>';
	}

	$samp_user = $_SESSION['user'];

	$rs_info = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$samp_user'");
	$row_info = mysqli_fetch_array($rs_info);
	if(mysqli_num_rows($rs_info) == 0){
		$rs_infoz = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id like '$samp_user'");
		$row_info = mysqli_fetch_array($rs_infoz);
		$name = $row_info['lastName'] . ", " . $row_info['firstName'] . " " . $row_info['middleName'];
	}elseif(mysqli_num_rows($rs_info) != 0){
		$name = $row_info['lastName'] . ", " . $row_info['firstName'] . " " . $row_info['middleName'];
	}else{
		$name = $exist_acc_row['level'];
	}

	$exist_acc = "SELECT count(*) as e, level, Username FROM tbl_accounts WHERE Username = '$samp_user'";
	$exist_acc_sql = mysqli_query($conn, $exist_acc);
	$exist_acc_row = mysqli_fetch_array($exist_acc_sql);

	
	if($exist_acc_row['e'] != 0){
		$role = $exist_acc_row['level'];
		if($role == "Administrator"){
		$name = $role;
		$samp_name = "$name ( $samp_user )";
		$rs = mysqli_query($conn, "INSERT INTO tbl_visit VALUES(NULL,'$ip','$machine','$samp_name','$date')");
		echo '<script type="text/javascript">window.location.href = "../../auth/";</script>';
		}elseif($role == "Faculty"){
		$samp_name = "$name ( $samp_user )";
		$rs = mysqli_query($conn, "INSERT INTO tbl_visit VALUES(NULL,'$ip','$machine','$samp_name','$date')");
		echo '<script type="text/javascript">window.location.href = "../../user/faculty/";</script>';
		}elseif($role == "Student"){
		$samp_name = "$name ( $samp_user )";
		$rs = mysqli_query($conn, "INSERT INTO tbl_visit VALUES(NULL,'$ip','$machine','$samp_name','$date')");
		echo '<script type="text/javascript">window.location.href = "../../user/student/";</script>';
		}elseif($role == "Registrar"){
		$name = $role;
		$samp_name = "$name ( $samp_user )";
		$rs = mysqli_query($conn, "INSERT INTO tbl_visit VALUES(NULL,'$ip','$machine','$samp_name','$date')");
		echo '<script type="text/javascript">window.location.href = "../../auth/pages/registrar/registrar";</script>';
		}elseif($role == "Finance"){
		$name = $role;
		$samp_name = "$name ( $samp_user )";
		$rs = mysqli_query($conn, "INSERT INTO tbl_visit VALUES(NULL,'$ip','$machine','$samp_name','$date')");
		echo '<script type="text/javascript">window.location.href = "../../auth/pages/registrar/finance.php";</script>';
		}
	}

	
	
}
?>