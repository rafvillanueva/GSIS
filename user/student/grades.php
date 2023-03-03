<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');      #
include('controls/global_info.php'); #
######################################
if(isset($_GET['std'])){
    $salt_dec = $_GET['std'] . $_GET['year'] . $_GET['sem'] . 5 . "krc";
    $salt_enc = hash("md5", $salt_dec);
    $auth_enc = $_GET['auth'];
    //echo hash("md5", $salt_dec1);
    if($salt_enc == $auth_enc){
        $id = $_GET['std'];
        $acad = $_GET['year'];
        $sem = $_GET['sem'];
        $salt_dec = $id  . $acad . $sem . 5 . "krc";
        $salt_enc = hash("md5", $salt_dec);
        $link = "print.php?auth=" . $salt_enc . "&std=" . $id . "&acad=" . $acad . "&sem=" . $sem . "&r=" . 5;
    }else{
        ?>
        <script type="text/javascript">window.location.href = "../";</script>
        <?php
    }
    $s_id = $_GET['std'];
    $rs = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$s_id'");
    $row = mysqli_fetch_array($rs);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vineyard College</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/site-content/admin/favicon.png"/>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<script src="../vendor/raphael/raphael.min.js"></script>
	<script src="../vendor/morrisjs/morris.min.js"></script>
	<script src="../data/morris-data.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body onload="load_acad()">
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">           
            <img src="../img/vineyard.png">
        </a>
    </div><br><br><br><br>
    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Content Menu</small></i>
                     <hr>
                     <a href="<?= $link ?>" target="_blank">
                        <img src="assets/icons/Print_96px.png" height="32" style="position: relative;">
                        <b> Print</b>
                    </a>
                     <a href="main">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Back</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b>  Logout </b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="Dashboard" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Grade Record &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <small>&nbsp; Subjects &nbsp;</small>
            <span class="fa fa-angle-double-right"></span>
            <small>&nbsp; View Grades &nbsp;</small>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- <h3 class="age-header"><i class="fa fa-user"></i>&nbsp;Student : <b><?= $g_row['lastName'] . ', ' . $g_row['firstName'] . ' ' . $g_row['middleName'] ?></b>
                </h3> --><!-- 
                 <h4 class="page1-header"><i class="fa fa-info-circle"></i>&nbsp; Course : <b><?= $g_row['Course'] ?></b></h4> -->
                 <?php 
                 if(isset($_GET['std'])){
				 	$acad = $_GET['year'];
				 	$sem = $_GET['sem'];
				 	if($sem == 1){
				 		$semester = "1st Semester";
				 	}elseif($sem == 2){
				 		$semester = "2nd Semester";
				 	}elseif($sem == 101){
                        $semester = "-Senior Highschool-";
                    }
				 }
                 ?>
                 <img src="assets/icons/Calendar_96px.png" height="35"> <span style="text-transform: uppercase;">&nbsp;Academic Year / Term : <b> <?= $acad . " - ( " . $semester ?> )</b></span>
            </div>
        </div>
        <hr>
        <?php include("controls/progress.php"); ?>
        <style type="text/css"> .grade{ text-align: center; }</style>
        <div class="table-responsive">
            <table class="table">
                <tr>
                <?php 
                if(isset($_GET['std'])){
                    $acad = $_GET['year'];
                    $sem = $_GET['sem'];

                    $f_str = $g_row[14];
                    $f_val   = 'SHS';
                    $f_rs = strpos($f_str, $f_val);

                    if($f_rs === false){
                        ?>
                            <th>Subject Code</th>
                            <th class="grade">Prelim</th>
                            <th class="grade">Midterm</th>
                            <th class="grade">Semi-Finals</th>
                            <th class="grade">Finals</th>
                            <th class="grade">Subject Grade</th>
                            <th class="grade">Numeric Equivalent</th>
                        <?php
                    }else{
                        ?>
                            <th>Subject Code</th>
                            <th class="grade">First Grading</th>
                            <th class="grade">Second Grading</th>
                            <th class="grade">Third Grading</th>
                            <th class="grade">Fourth Grading</th>
                            <th class="grade">Subject Grade</th>
                            <th class="grade">Numeric Equivalent</th>
                        <?php
                    }
                }
                ?>
                </tr>
                <?php
                if(isset($_GET['std'])){
                    $acad = $_GET['year'];
                    $sem = $_GET['sem'];
                    $id = $_GET['std'];
                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND Semester = '$sem' AND Year = '$acad'");
                    while($row = mysqli_fetch_array($query)){
                        $sub_id = $row['subjectCode'];
                        ?>
                        <tr>
                            <td><?= $row['subjectCode'] ?></td>
                            <?php include("controls/computation.php"); ?>
                            <td class="grade"><?= number_format($prelim, 2 , '.', '')?></td>
                            <td class="grade"><?= number_format($midterm, 2 , '.', '')?></td>
                            <td class="grade"><?= number_format($semiterm, 2 , '.', '') ?></td>
                            <!-- Restriction -->
                            <?php 

                            $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
                            $res_r = mysqli_fetch_array($res);
                            $num = mysqli_num_rows($res);
                            if($num == 1){
                                ?>
                                <td class="grade"><b style="color: red;"><del>disabled</del></b></td>
                                <td class="grade"><b style="color: red;"><del>disabled</del></b></td>
                                <td class="grade"><b style="color: red;"><del>disabled</del></b></td>
                                <?php
                            }else{
                                ?>
                                <td class="grade"><?= number_format($finals, 2 , '.', '') ?></td>
                                <td class="grade"><?= number_format($final_grade, 2 , '.', '') ?></td>
                                <td class="grade"><?= $numeric_grade ?></td>
                                <?php
                            }
                            ?>
                            
                        </tr>
                        <?php
                    }
                 }
                ?>
                
            </table>
        </div>
    </div>
</div>
</body>
</html>