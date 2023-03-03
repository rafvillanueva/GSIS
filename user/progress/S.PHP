<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');      #
#include('controls/global_info.php');#
######################################
/*http://127.0.0.1/vineyard.sis/user/progress/?auth=7078708a8e377b88e10036e35c7f74ce&std=20151933&acad=2018-2019&sem=2&r=0*/
if(isset($_GET['std'])){
    $salt_dec = $_GET['std'] . $_GET['acad'] . $_GET['sem'] . $_GET['r'] . "krc";
    $salt_enc = hash("md5", $salt_dec);
    $auth_enc = $_GET['auth'];
    $salt_dec1 = 20151933 . $_GET['acad'] . 2 . $_GET['r'] . "krc";
    //echo hash("md5", $salt_dec1);
    if($salt_enc == $auth_enc){
        $id = $_GET['std'];
        $acad = $_GET['acad'];
        $sem = $_GET['sem'];
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
                    <div class="input-group custom-search-form">
                       <b>Student Panel</b>
                    </div>
                </li>
                <li>
                    <a href="../"><i class="fa fa-fw fa-arrow-left"></i> &nbsp;Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="age-header"><i class="fa fa-user"></i>&nbsp;Student : <?= $row[3] . ", " . $row[2] . " " . $row[4] ?></b>
                </h3>
                 <h4 class="page1-header"><i class="fa fa-info-circle"></i>&nbsp; Course : <?= $row['Course'] ?><b></b></h4>
                 <span class="fa fa-calendar"></span> &nbsp;Academic Year / Term : <b> <?=  $_GET['acad'] ?> </b> &nbsp;
                 <hr>
                 <cente1r>
                     <button class="btn btn-danger" style="background-color: crimson; border-radius: 0px;">Prelim</button>
                     <button class="btn btn-danger" style="background-color: crimson; border-radius: 0px;">Midterm</button>
                 </center>
                 <hr>
            </div>
        </div>

        <div id="myfirstchart" style="height: 350px;"></div>
        <script type="text/javascript">
            var $arrColors = ['#34495E', '#919FA0',  '#666', '#3498DB', '#E27B1A', '#26A95E ', '#2C3C4F', '#E27B1A', '#919FA0'];
            new Morris.Bar({
                element: 'myfirstchart',
                barGap:4,
               /* barSizeRatio:0.15,*/
              data: [
              <?php
                
                $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND Semester = '$sem'");
                $num = mysqli_num_rows($rs);
                while($row = mysqli_fetch_array($rs)){
                    $subject = $row['subjectCode'];
                    $sub_id = $subject;
                    include("computation.php");
                    echo "{ term: '".$subject."', grade: '".number_format($final_grade, 2, ".", "") ."', s: '75' },";
                }
              ?>
                
              ],
              xkey: 'term',
              ykeys: ['grade','s'],
              labels: ['Grade','S'],
              barColors: function (row, series, type) {
                    return $arrColors[row.x];
                }
            });
        </script>        
    </div>
    <hr>
</div>
</body>
</html>