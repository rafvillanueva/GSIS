<?php require("site-content.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $config['Title'] ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/modify/css/style.css" rel="stylesheet" type="text/css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>    
    <script src="vendor/custom/tnek.js"></script>
    <style type="text/css">
    	body {background-color: #f1f1f1;}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="color: #fff;">           
            <img src="../images/fav.png" height="85">
        </a>
    </div>
</nav>
<div class="container">
    <div>
        <div class="col-md-4" style="padding-top: 50px;">
        <?php
            ob_start();
            session_start();
            if(isset($_SESSION['user']) == ""){
                require("pages/k-login.php");
            }else{
                $user = $_SESSION['user'];
                $info = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
                $info_row = mysqli_fetch_array($info);

                $role = $info_row['Level'];

                if($role == "Administrator"){
                    echo '<script type="text/javascript">window.location.href = "../auth/";</script>';
                }elseif($role == "Faculty"){
                    echo '<script type="text/javascript">window.location.href = "../user/faculty/";</script>';
                }elseif($role == "Student"){
                    echo '<script type="text/javascript">window.location.href = "../user/student/";</script>';
                }elseif($role == "Registrar"){
                    echo '<script type="text/javascript">window.location.href = "../auth/pages/registrar/registrar";</script>';
                }elseif($role == "Finance"){
                    echo '<script type="text/javascript">window.location.href = "../auth/pages/registrar/finance.php";</script>';
                }
            }
        ?>
        </div>
        <div class="col-md-8" style="padding-top: 50px;">
            <h1 style="font-family: 'Acme';"><center>Welcome to Guadalupe Elementary Scool &nbsp;<small style="font-size: 14px;"></small></center></h1>
            <p><center style="font-family: 'Exo'; font-size: 15px; letter-spacing: 1px; font-weight: bold;">Vineyard College is a non-stock and non-profit Educational Institution established with the main purpose of providing quality basic, technical /vocational, higher and advanced education responsive to the need of time and society.</center></p><br>
            <center style="font-family: 'Exo'; font-size: 15px;">
                <a href="http://www.facebook.com/vineyardcollege"><span style="color: #4064AC; font-size: 42px;" class="fa fa-facebook"></span></a>&nbsp;
                <a href="http://www.twitter.com/vipc_ph"><span style="color: #5AA4D6; font-size: 42px;" class="fa fa-twitter"></span></a>&nbsp;
                <a href="http://www.instagram.com/vipc_ph"><span style="color: #D62E73; font-size: 42px;" class="fa fa-instagram"></span></a>&nbsp;
                <a href="vineyard.college"><span style="color: #90D8F0; font-size: 42px;" class="fa fa-skype"></span></a>&nbsp;
                <a href="https://www.youtube.com/channel/UCQMVzOODpRP_3yGlJYXVmHw"><span style="color: #C91F1F; font-size: 42px;" class="fa fa-youtube"></span></a>&nbsp;
            </center>
        </div>        
    </div>
</div>
