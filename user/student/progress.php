<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');      #
include('controls/global_info.php'); #
###################################### 
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
                    <div class="input-group custom-search-form">
                       <b>Student Panel</b>
                    </div>
                </li>
                <li>
                    <a href="panel"><i class="fa fa-fw fa-user"></i> &nbsp;Grade Records & Progress</a>
                </li>
                <li>
                    <a href="password"><i class="fa fa-fw fa-wrench"></i> &nbsp;Change Password</a>
                </li>
                <li>
                    <a href="../../login/logout/logout.php?logout"><i class="fa fa-fw fa-sign-out"></i> &nbsp;Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="age-header"><i class="fa fa-user"></i>&nbsp;Student : <b><?= $g_row['lastName'] . ', ' . $g_row['firstName'] . ' ' . $g_row['middleName'] ?></b>
                </h3>
                 <h4 class="page1-header"><i class="fa fa-info-circle"></i>&nbsp; Course : <b><?= $g_row['Course'] ?></b></h4>
                 <hr>
                 <?php 
                 if(isset($_GET['std'])){
				 	$subj = $_GET['subj'];
				 	$subj_code = str_replace(array('%20', ' '), ' ', $subj);
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
                 <span class="fa fa-calendar"></span> &nbsp;Academic Year : <b> <?= $acad . " (" . $semester ?>)</b> &nbsp;
                 <span class="fa fa-list"></span> &nbsp; Subject Code :<b> <?= $subj_code ?></b> 
            </div>
        </div>
        <hr>
        <div id="myfirstchart" style="height: 250px;"></div>
        <?php include("controls/progress.php"); ?>
        <?php

        $f_str = $g_row[14];
        $f_val   = 'SHS';
        $f_rs = strpos($f_str, $f_val);

        if($f_rs === false){
          $periodz_1 = "Prelim";
          $periodz_2 = "Midterm";
          $periodz_3 = "Semi-Finals";
          $periodz_4 = "Finals";
        }else{
          $periodz_1 = "1st Grading";
          $periodz_2 = "2nd Grading";
          $periodz_3 = "3rd Grading";
          $periodz_4 = "4th Grading";
        }
        $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
        $res_r = mysqli_fetch_array($res);
        $num = mysqli_num_rows($res);
        if($num == 1){
            $periodz_4 = "Finals (Disabled)";
            $finals = 0;
        }
        ?>
		<script type="text/javascript">
		    new Morris.Bar({
		      element: 'myfirstchart',
		      data: [
		        { term: '<?= $periodz_1 ?>', grade: <?= number_format($prelim, 2 , '.', '')?> },
		        { term: '<?= $periodz_2 ?>', grade: <?= number_format($midterm, 2 , '.', '')?> },
		        { term: '<?= $periodz_3 ?>', grade: <?= number_format($semiterm, 2 , '.', '')?> },
		        { term: '<?= $periodz_4 ?>', grade: <?= number_format($finals, 2 , '.', '')?> },
		      ],
		      xkey: 'term',
		      ykeys: ['grade'],
		      labels: ['Grade'],
		      barColors: ["#B21516", "#1531B2", "#1AB244", "#B29215"]
		    });
		</script>
    </div>
    <hr>
    <div class="pull-left">
    	<a href="../" class="btn btn-default"><span class="fa fa-arrow-left"></span> Return</a>
    </div>
</div>
</body>
</html>