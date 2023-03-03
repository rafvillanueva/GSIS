<?php
ob_start();
session_start();

//error_reporting(0);

/* Database */
require("../../config/db.php");

/* Redirect URL */
header('Refresh: 0; ../'); 

/* Login Admin */
if(isset($_POST['username'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$password = hash("sha256", $pass);
	if(empty($user) || empty($pass)){
	echo '
	<div class="alert alert-warning kr-label" style="color:orange;">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div><hr>
	';
	}else{
		$exist_acc = "SELECT count(*) as e, level, Username FROM tbl_accounts WHERE (Username LIKE '$user' OR Email LIKE '$user') AND Password = '$password'";
		$exist_acc_sql = mysqli_query($conn, $exist_acc);
		$exist_acc_row = mysqli_fetch_array($exist_acc_sql);
		if($exist_acc_row['e'] != 0){

			$role = $exist_acc_row['level'];
			$_SESSION['user_level'] = $role;
            $_SESSION['user'] = $user;
            echo '<script type="text/javascript">window.location.href = "checklogs/";</script>';
			/*if($role == "Administrator"){
				$_SESSION['user'] = $exist_acc_row['Username'];
                echo '<script type="text/javascript">window.location.href = "../auth/";</script>';
            }elseif($role == "Faculty"){
            	$_SESSION['user'] = $exist_acc_row['Username'];
                echo '<script type="text/javascript">window.location.href = "../user/faculty/";</script>';
            }elseif($role == "Student"){
            	$_SESSION['user'] = $role
            	$_SESSION['user_level'] = $exist_acc_row['Username'];
                #echo '<script type="text/javascript">window.location.href = "../user/student/";</script>';
                echo '<script type="text/javascript">window.location.href = "ip/";</script>';
            }elseif($role == "Registrar"){
            	$_SESSION['user'] = $exist_acc_row['Username'];
                echo '<script type="text/javascript">window.location.href = "../auth/pages/registrar/";</script>';
            }*/

			
			
			
			/*Redirect Invalid*/
			/*if(isset($_SESSION['k-admin']) == ""){
				header("location: ../");
			}*/

		}else{
			echo '
			<div class="alert alert-danger kr-label" style="color: red;"><span class="fa fa-warning"></span> Invalid <b>Username/Password</b>. Try Again.</div>
			<hr>
			';
		}
	}
}

/* Register Admin */
if(isset($_POST['username_r'])){
	$user = $_POST['username_r'];
	$email = $_POST['email_r'];
	$pass = $_POST['password_r'];
	$password = hash("sha256", $pass);
	if(empty($user) || empty($pass) || empty($email)){
	echo '
	<div class="alert alert-warning kr-label" style="color:orange;">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div><hr>
	';
	}else{
		$exist_acc = "SELECT count(*) as e FROM tbl_administrator WHERE (Username LIKE '$user' OR Email LIKE '$email')";
		$exist_acc_sql = mysqli_query($conn, $exist_acc);
		$exist_acc_row = mysqli_fetch_array($exist_acc_sql);
		if($exist_acc_row['e'] == 0){

			$password = hash("sha256", $pass);
			$regs = "INSERT INTO tbl_administrator(Username,Email,Password) VALUES('$user','$email','$password')";
			$query = mysqli_query($conn, $regs);

			echo '
			<div class="alert alert-success kr-label" style="color:green;">
			  <strong><span class="fa fa-check"></span> Success!</strong> New Admin Account Added.
			</div><hr>';


		}else{
			echo '
			<div class="alert alert-danger kr-label" style="color: red;"><span class="fa fa-warning"></span> The <b>Username/Email Address</b>. is already exist.</div>
			<hr>
			';
		}
	}
}
?>
