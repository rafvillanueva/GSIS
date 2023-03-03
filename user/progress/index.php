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

    $info = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$s_id'");
    $g_row = mysqli_fetch_array($info);

    if($_GET['r'] == "0"){
        $back = '../../user/faculty/term-and-semestral';
    }elseif($_GET['r'] == "1"){
        $back = '../../auth/pages/registrar/view-student?id=' . $_GET['std'];
    }elseif($_GET['r'] == "2"){
        $back = '../../user/faculty/';
    }elseif($_GET['r'] == "5"){
        $back = '../../user/student/modules';
    }
    if(isset($_GET['r']) == "5"){
        $rs_r = mysqli_query($conn, "SELECT * FROM tbl_gradeview WHERE ID = '1'");
        $row_r = mysqli_fetch_array($rs_r);

        $role = $row_r['Role'];
    }
    $current_month = date('m');
    /*$subject_shs = mysqli_query($conn, "SELECT count(*) as e FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND SubjectCode  like '%SHS%'");
    $row_shs = mysqli_fetch_array($subject_shs);*/
    /*$rs = mysqli_query($conn, "SELECT * FROM tbl_semester WHERE ID = '1'");
    $rowxz = mysqli_fetch_array($rs);
    if($row_shs['e'] == 0){
        #1st Semester
        for($i=$rowxz[1];$i>=$rowxz[2]; --$i){
            if($current_month == $i){
                $semx = " 1st semester";
                $semz = 1;
            }       
        }
        #2nd Semester
        for($i=$rowxz[2];$i>=1; --$i){
            if($current_month == $i){
                $semx = " 2nd semester";
                $semz = 2;
            } 
        }
        for($i=$rowxz[1];$i<=12; $i++){
           if($current_month == $i){
                $semx = " 2nd semester";
                $semz = 2;
            } 
        }
    }else{
        #1st Semester
        for($i=$rowxz[1];$i>=$rowxz[2]; --$i){
            if($current_month == $i){
                $semx = " 1st semester";
                $semz = "%%";
            }       
        }
        #2nd Semester
        for($i=$rowxz[2];$i>=1; --$i){
            if($current_month == $i){
                $semx = " 2nd semester";
                $semz = "%%";
            } 
        }
        for($i=$rowxz[1];$i<=12; $i++){
           if($current_month == $i){
                $semx = "2nd semester";
               $semz = "%%";
            } 
        }
    }*/

    $calendar = $g_row['Course'];
    include("asset/view/calendar.php");
}
if(!isset($_GET['r'])){
    header("location: ../../login/");
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
                     <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Student Progress</small></i>
                     <hr>
                     <a href="javascript: window.print()">
                        <img src="asset/icons/Print_96px.png" height="32" style="position: relative;">
                        <b> Print</b>
                    </a>
                     <a href="<?= $back ?>">
                        <img src="asset/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="asset/icons/Shutdown_96px.png" height="32" style="position: relative;">
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
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="age-header">
                    <img src="asset/icons/User_96px.png" height="55">
                    <b style="text-transform: uppercase;"><?= $g_row[3] . ", " . $g_row[2] . " " . $g_row[4] ?></b> <small> ( <?= $g_row['Course'] ?> )</small><br>
                </h3>&nbsp;&nbsp;
                <?php
                if($_GET['sem'] == "1"){
                    $e = " - 1st Semester";
                }elseif($_GET['sem'] == "2"){
                    $e = " - 2nd Semester";
                }elseif($_GET['sem'] == "101"){
                    $e = "";
                }
                ?>
                <img src="asset/icons/School_96px.png" height="32"> &nbsp;&nbsp;&nbsp; Academic Year / Term : <b> <?=  $_GET['acad'] . $e  ?> </b> &nbsp;
            </div>
        </div>

        <div id="myfirstchart" style="height: 220px;"></div>
        <hr>
        <h3><b>Student Term Grades.</b></h3>
        <div class="table-responsive">
            <table class="table">
                <thead style="font-weight: bold; letter-spacing: 2px; text-transform: uppercase;">
                    <td>Sucject Code</td>
                    <td>Sucject Description</td>
                    <td>-</td>
                    <?php
                    if($g_row['Course'] == "SHS"){
                        ?>
                        <td><center>1st <sup>Grading</sup></center></td>
                        <td><center>2nd <sup>Grading</sup></center></td>
                        <td><center>3rd <sup>Grading</sup></center></td>
                        <td><center>4th <sup>Grading</sup></center></td>
                        <?php
                    }else{
                        ?>
                        <td><center>Prelim</center></td>
                        <td><center>Midterm</center></td>
                        <td><center>Semi-Final</center></td>
                        <td><center>Final</center></td>
                        <?php
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    /*$f_str = $g_row[14];
                    $f_val   = 'SHS';
                    $f_rs = strpos($f_str, $f_val);*/
                    $id = $_GET['std'];
                    $acad = $_GET['acad'];
                    $sem = $_GET['sem'];
                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND Semester like '$sem'");
                    while($row = mysqli_fetch_array($rs)){
                        $subject = $row['subjectCode'];
                        $sub_id = $subject;
                        $subject_rs = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$sub_id'");
                        $subject_row = mysqli_fetch_array($subject_rs);

                        include("computation.php");

                        $prelim_rate = number_format($prelim, 2, ".", "");
                        $midterm_rate = number_format($midterm, 2, ".", "");
                        $semifinal_rate = number_format($semiterm, 2, ".", "");
                        $final_rate = number_format($finals, 2, ".", "");

                        $compute = $midterm_rate - $prelim_rate;
                        if($compute == 0){
                            $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute, 2, ".", "") . ' </b> )';
                        }elseif($compute >= 1){
                           $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                        }else{
                            $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                        }

                        /* SEMI FINAL */
                        $compute1 = $semifinal_rate - $midterm_rate;
                        if($compute1 == 0){
                            $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute1, 2, ".", "") . ' </b> )';
                        }elseif($compute1 >= 1){
                           $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute1, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                        }else{
                            $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute1, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                        }

                         /* FINAL */
                        $compute2 = $final_rate - $semifinal_rate;
                        if($compute2 == 0){
                            $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute2, 2, ".", "") . ' </b> )';
                        }elseif($compute2 >= 1){
                           $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute2, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                        }else{
                            $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute2, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                        }
                        if(isset($_GET['r']) == "5"){
                            if($role == 0){
                                $prelim = 0;
                                $rate_mid = 0;
                                $rate_semi = 0;
                                $rate_final = 0;
                            }elseif($role == 1){
                                $rate_mid = 0;
                                $rate_semi = 0;
                                $rate_final = 0;
                            }elseif($role == 2){
                                $rate_semi = 0;
                                $rate_final = 0;
                            }elseif($role == 3){
                                $rate_final = 0;
                            }
                            if($_GET['r'] == "5"){
                                $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
                                $res_r = mysqli_fetch_array($res);
                                $num = mysqli_num_rows($res);
                               if($num == 1){
                                     $rate_final = 0;
                                } 
                            }                       
                        }
                        if($sem == 1 && $g_row['Course'] == "SHS"){
                            $rate_semi = "-";
                            $rate_final = "-";
                        }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                            $prelim = "-";
                            $rate_mid = "-";
                        }
                        ?>
                        <tr>
                            <td><?= $subject ?></td>
                            <td><?= $subject_row['Description'] ?></td>
                            <td></td>
                            <td><center><?= number_format($prelim, 2, ".", "") ?></center></td>
                            <td><center><?= $rate_mid ?></center></td>
                            <td><center><?= $rate_semi ?></center></td>
                            <td><center><?= $rate_final ?></center></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3><b>UNEXCUSED ABSENCES.</b></h3>
        <div class="table-responsive">
            <table class="table">
                <thead style="font-weight: bold; letter-spacing: 2px; text-transform: uppercase;">
                    <td>Sucject Code</td>
                    <td>Sucject Description</td>
                    <td>-</td>
                    <?php
                    if($g_row['Course'] == "SHS"){
                        ?>
                        <td><center>1st <sup>Grading</sup></center></td>
                        <td><center>2nd <sup>Grading</sup></center></td>
                        <td><center>3rd <sup>Grading</sup></center></td>
                        <td><center>4th <sup>Grading</sup></center></td>
                        <td><center>Total</center></td>
                        <?php
                    }else{
                        ?>
                        <td><center>Prelim</center></td>
                        <td><center>Midterm</center></td>
                        <td><center>Semi-Final</center></td>
                        <td><center>Final</center></td>
                        <td><center>Total</center></td>
                        <?php
                    }
                    ?>
                    
                </thead>
                <tbody>
                    <?php 
                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND (Semester like '101' OR Semester like '$sem')");

                    while($row = mysqli_fetch_array($rs)){
                        $subject = $row['subjectCode'];
                        $sub_id = $subject;
                        $subject_rs = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$sub_id'");
                        $subject_row = mysqli_fetch_array($subject_rs);

                        include("computation.php");
                        /* Absences */
                        $ab_1 = mysqli_query($conn, "SELECT SUM(Score) as Score FROM tbl_scores WHERE Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Unexcused absences incurred' AND Year = '$acad' AND Score != '0'");
                        $ab_2 = mysqli_query($conn, "SELECT SUM(Score) as Score FROM tbl_scores WHERE Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Unexcused absences incurred' AND Year = '$acad' AND Score != '0'");
                        $ab_3 = mysqli_query($conn, "SELECT SUM(Score) as Score FROM tbl_scores WHERE Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Unexcused absences incurred' AND Year = '$acad' AND Score != '0'");
                        $ab_4 = mysqli_query($conn, "SELECT SUM(Score) as Score FROM tbl_scores WHERE Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Unexcused absences incurred' AND Year = '$acad' AND Score != '0'");

                        $ab_row1 = mysqli_fetch_array($ab_1);
                        $ab_row2 = mysqli_fetch_array($ab_2);
                        $ab_row3 = mysqli_fetch_array($ab_3);
                        $ab_row4 = mysqli_fetch_array($ab_4);

                        if(number_format($ab_row1['Score'], 0 , "", ",") == 0){
                            $ab_x1 = '<b>0</b>';
                        }else{
                            $ab_x1 = '<b style="color: red">'.number_format($ab_row1['Score'], 0 , "", ",").'</b>';
                        }
                        if(number_format($ab_row2['Score'], 0 , "", ",") == 0){
                            $ab_x2 = '<b>0</b>';
                        }else{
                            $ab_x2 = '<b style="color: red">'.number_format($ab_row2['Score'], 0 , "", ",").'</b>';
                        }
                        if(number_format($ab_row3['Score'], 0 , "", ",") == 0){
                            $ab_x3 = '<b>0</b>';
                        }else{
                            $ab_x3 = '<b style="color: red">'.number_format($ab_row3['Score'], 0 , "", ",").'</b>';
                        }
                        if(number_format($ab_row4['Score'], 0 , "", ",") == 0){
                            $ab_x4 = '<b>0</b>';
                        }else{
                            $ab_x4 = '<b style="color: red">'.number_format($ab_row4['Score'], 0 , "", ",").'</b>';
                        }

                        $total_ab = $ab_row1['Score'] + $ab_row2['Score'] + $ab_row3['Score'] + $ab_row4['Score'];
                        if($sem == 1 && $g_row['Course'] == "SHS"){
                            $ab_x3 = "-";
                            $ab_x4 = "-";
                        }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                            $ab_x1 = "-";
                            $ab_x2 = "-";
                        }
                        ?>
                        <tr>
                            <td><?= $subject ?></td>
                            <td><?= $subject_row['Description'] ?></td>
                            <td></td>
                            <td><center><?= $ab_x1 ?></center></td>
                            <td><center><?= $ab_x2 ?></center></td>
                            <td><center><?= $ab_x3 ?></center></td>
                            <td><center><?= $ab_x4 ?></center></td>
                            <td><center><?= $total_ab ?></center></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>      
        <h3><b>Semestral Grades w/ Numeric Grade.</b></h3>
         <div class="table-responsive">
        <table class="table">
            <thead style="font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">
                <td>Sucject Code</td>
                <td>Sucject Description</td>
                <td>-</td>
                <td></td>
                <td></td>
                <td width="150"><center><sup>Semestral Grades</sup></center></td>
                <td width="150"><center><sup>Numeric Grades</sup></center></td>
            </thead>
            <tbody>
                <?php 
                $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND (Semester like '101' OR Semester like '$sem')");

                while($row = mysqli_fetch_array($rs)){
                    $subject = $row['subjectCode'];
                    $sub_id = $subject;
                    $subject_rs = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$sub_id'");
                    $subject_row = mysqli_fetch_array($subject_rs);

                    include("computation.php");

                    $prelim_rate = number_format($prelim, 2, ".", "");
                    $midterm_rate = number_format($midterm, 2, ".", "");
                    $semifinal_rate = number_format($semiterm, 2, ".", "");
                    $final_rate = number_format($finals, 2, ".", "");

                    $compute = $midterm_rate - $prelim_rate;
                    if($compute == 0){
                        $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute, 2, ".", "") . ' </b> )';
                    }elseif($compute >= 1){
                       $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                    }else{
                        $rate_mid = number_format($midterm, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                    }

                    /* SEMI FINAL */
                    $compute1 = $semifinal_rate - $midterm_rate;
                    if($compute1 == 0){
                        $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute1, 2, ".", "") . ' </b> )';
                    }elseif($compute1 >= 1){
                       $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute1, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                    }else{
                        $rate_semi = number_format($semiterm, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute1, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                    }

                     /* FINAL */
                    $compute2 = $final_rate - $semifinal_rate;
                    if($compute2 == 0){
                        $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: blue"> ' . number_format($compute2, 2, ".", "") . ' </b> )';
                    }elseif($compute2 >= 1){
                       $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: green"> ' . number_format($compute2, 2, ".", "") . '&nbsp; <span class="fa fa-caret-up"></span></b> )';
                    }else{
                        $rate_final = number_format($finals, 2, ".", "") . ' ( <b style="color: red"> ' . number_format($compute2, 2, ".", "") . '&nbsp; <span class="fa fa-caret-down"></span></b> )';
                    }
                    if(isset($_GET['r']) == "5"){
                        if($role == 0){
                            $prelim = 0;
                            $midterm = 0;
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 1){
                            $midterm = 0;
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 2){
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 3){
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }
                        if($_GET['r'] == "5"){
                                $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
                                $res_r = mysqli_fetch_array($res);
                                $num = mysqli_num_rows($res);
                               if($num == 1){
                                    $final_grade = 0;
                                    $numeric_grade = 0;
                                } 
                            }                       
                        }
                    ?>
                    <tr>
                        <td><?= $subject ?></td>
                        <td><?= $subject_row['Description'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><center><b style="color: #2C3C4F"><?= number_format($final_grade, 2, ".", "") ?></b></center></td>
                        <td><center><b style="color: #333"><?= $numeric_grade ?></b></center></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>        
        <hr>
        </div>
        <script type="text/javascript">
            var $arrColors = ['#34495E', '#919FA0',  '#666', '#3498DB', '#E27B1A', '#26A95E ', '#2C3C4F', '#E27B1A', '#919FA0'];
            new Morris.Bar({
                element: 'myfirstchart',
                barGap:4,
               /* barSizeRatio:0.15,*/
              data: [
              <?php
                
                $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND (Semester like '$sem' OR Semester like '101')");
                if(mysqli_num_rows($rs) == NULL){

                    $num =0;
                }else{
                    $num = mysqli_num_rows($rs);
                }
                while($row = mysqli_fetch_array($rs)){
                    $subject = $row['subjectCode'];
                    $sub_id = $subject;
                    include("computation.php");
                    if(isset($_GET['r']) == "5"){
                        if($role == 0){
                            $prelim = 0;
                            $midterm = 0;
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 1){
                            $midterm = 0;
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 2){
                            $semiterm = 0;
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }elseif($role == 3){
                            $finals = 0;
                            $final_grade = 0;
                            $numeric_grade = 0;
                        }

                        if($sem == 1 && $g_row['Course'] == "SHS"){
                            $semiterm = "0";
                            $finals = "0";
                        }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                            $prelim = "0";
                            $midterm = "0";
                        }
                        
                        if($_GET['r'] == "5"){
                            $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
                            $res_r = mysqli_fetch_array($res);
                            $num = mysqli_num_rows($res);
                           if($num == 1){
                                $finals = 0;
                            } 
                        }

                    }

                    if($sem == 1 && $g_row['Course'] == "SHS"){
                        echo "{ term: '".$subject."', prelim: '". number_format($prelim, 2, ".", "") ."', midterm: '".number_format($midterm, 2, ".", "") ."', finalg: '".number_format($final_grade, 2, ".", "")."'  },";
                    }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                        echo "{ term: '".$subject."', semi: '".number_format($semiterm, 2, ".", "") ."', final: '".number_format($finals, 2, ".", "")."', finalg: '".number_format($final_grade, 2, ".", "")."'  },";
                    }else{
                        if($prelim == 50 || $midterm == 50 || $semiterm == 50 || $finals == 50){                           
                            echo "{ term: '".$subject."', prelim: '". number_format($prelim, 2, ".", "") ."', midterm: '".number_format($midterm, 2, ".", "") ."', semi: '".number_format($semiterm, 2, ".", "") ."', final: '".number_format($finals, 2, ".", "")."' },"; 
                        }else{
                            echo "{ term: '".$subject."', prelim: '". number_format($prelim, 2, ".", "") ."', midterm: '".number_format($midterm, 2, ".", "") ."', semi: '".number_format($semiterm, 2, ".", "") ."', final: '".number_format($finals, 2, ".", "")."', finalg: '".number_format($final_grade, 2, ".", "")."'  },"; 
                        }
                    }
                    
                }
              ?>
                
              ],
              xkey: 'term',              
              <?php
              if($g_row['Course'] == "SHS"){
                if($sem == 1 && $g_row['Course'] == "SHS"){
                    echo "ykeys: ['prelim','midterm','finalg'],";
                    echo "labels: ['1st Grading','2nd Grading','Subject Grade'],";
                }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                    echo "ykeys: ['semi','final','finalg'],";
                    echo "labels: ['3rd Grading','4th Grading','Subject Grade'],";
                }               
              }else{
                echo "ykeys: ['prelim','midterm','semi','final','finalg'],";
                echo "labels: ['Prelim','Midterm','Semi-Final','Final','Subject Grade'],";
              }
              ?>
              
              resize: true,
              barColors: function (row, series, type) {
                    return $arrColors[row.x];
                }
            });
            /*, semi: '".number_format($semiterm, 2, ".", "") ."', final: '".number_format($final, 2, ".", "") ."'*/
        </script>        
    </div>
    <hr>
</div>
</body>
</html>