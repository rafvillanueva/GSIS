<?php include('../../config/db.php'); ?>
<?php

ob_start();
session_start();
$id = $_SESSION['user'];
if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
}

if(isset($_POST['Score'])){
	$s_id = $_POST['s_id'];
	$f_id = $_POST['f_id'];
	$Score = $_POST['Score'];
	$s_sub = $_POST['s_sub'];
	$s_period = $_POST['s_period'];
	$dt = date("Y");
    $dtt = date("Y") + 1;

    $datez = $dt . "-" . $dtt;
	$rs = mysqli_query($conn, "SELECT count(*) as i FROM tbl_grade WHERE s_id = '$s_id' AND f_id = '$f_id' AND s_sub = '$s_sub' AND s_period = '$s_period'");
	$row = mysqli_fetch_array($rs);
	if($row['i'] == 1){
		$u = mysqli_query($conn, "UPDATE tbl_grade SET s_grade = '$Score' WHERE s_id = '$s_id' AND f_id = '$f_id' AND s_sub = '$s_sub' AND s_period = '$s_period'");
	}else{
		$i = mysqli_query($conn, "INSERT INTO tbl_grade VALUES(NULL,'$f_id','$s_id','$Score','$s_sub','$s_period','$datez')");
	}
}