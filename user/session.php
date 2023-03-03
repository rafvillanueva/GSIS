<?php

ob_start();
session_start();

if(isset($_GET['try']) == 1){
	$_SESSION['id'] = "F10001";
	echo "Session start";
}else{
	session_unset();
	session_destroy();
	echo "Session Destroy";
}
?>