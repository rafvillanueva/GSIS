<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');      #
include('controls/global_info.php'); #
######################################
date_default_timezone_set("Asia/Manila");
$current_year = date('Y');
$advance_year = date('Y') + 1;
$date = $current_year . "-" . $advance_year;
$current_month = date('m');
#$query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND YEAR = '$date' ORDER BY Year DESC");

$calendar = $g_row['Course'];
include("controls/calendar.php");

$salt_dec = $id . $date . $semz . 5 . "krc";
$salt_enc = hash("md5", $salt_dec);
$link = "print.php?auth=" . $salt_enc . "&std=" . $id . "&acad=" . $date . "&sem=" . $semz . "&r=" . 5;
#var_dump($_SERVER);
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
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
    <style type="text/css"> .grade{ text-align: center; }</style>
</head>
<body>
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
                     <a href="modules">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
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
            <a href="main" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <a href="current-classes" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="#" style="text-decoration: none;">
                <small>&nbsp; Current Classess &nbsp;</small>
            </a>
        </div>
        <hr>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Academic Year : </b> &nbsp;<?= $date ?>
                &nbsp;&nbsp;
                <b>Semester : </b> &nbsp;<?= $semx ?> <!-- :: <b style="text-transform: uppercase;"><?= $period ?> </b> -->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <?php
                                    $f_str = $g_row['Course'];
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
                                            <th class="grade">1st Grading</th>
                                            <th class="grade">2nd Grading</th>
                                            <th class="grade">3rd Grading</th>
                                            <th class="grade">4th Grading</th>
                                            <th class="grade">Subject Grade</th>
                                            <th class="grade">Numeric Equivalent</th>
                                        <?php
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $val = $_POST['t_search'];
                                    $search = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND (SubjectCode LIKE '%$val%' OR Section LIKE '%$val%' OR Year LIKE '%$val%') ORDER BY Year DESC");
                                     while( $rowx = mysqli_fetch_array($search)){
                                        ?>
                                        <tr onclick="window.location='Classes?subject=<?= $rowx['ID'] ?>';" id="xhover">
                                            <td><?= $rowx['SubjectLoad']; ?></td>
                                            <?php 
                                                $code = $rowx['SubjectLoad'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><?= $rowx['Year']; ?></td>
                                            <td><?= $rowx['Section']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND YEAR = '$date' AND Semester like '$semz' ORDER BY Year DESC");
                                    
                                    while( $rowx = mysqli_fetch_array($query)){
                                        $sub_id = $rowx['subjectCode'];
                                        $acad = $date;
                                        if($sem == 1 && $g_row['Course'] == "SHS"){
                                            $prelim = 0;
                                            $midterm = 0;
                                        }elseif($sem == 2 && $g_row['Course'] == "SHS"){
                                            $semiterm = 0;
                                            $finals = 0;
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $rowx['subjectCode'] ?></td>
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
                                 <style type="text/css">
                                    #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
                                </style>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        Total Subject Loaded ( <b style="color: red;"><?= mysqli_num_rows($query) ?> </b> )
    </div>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
