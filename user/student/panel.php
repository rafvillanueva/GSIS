<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
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
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        @media only screen and (max-width: 680px) {
            .mobile_media{ display: none; }
            .clearkent{ padding: 1px; }
        }
        #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
        .navbar-collapse{ position: relative; top: -15px; }
    </style>
    <style type="text/css"> .grade{ text-align: center; }</style>
</head>
<body onload="load_acad()">
<?php include("controls/sub-navbar.php"); ?>
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
        </div>
        <hr>
        <div class="row">
            <div class="col-md-7">
                <?php
                if($g_row['Gender'] == "Male"){
                    ?>
                    <img src="assets/icons/user1.png" height="55">                        
                    <?php
                }else{
                    ?>
                    <img src="assets/icons/user2.png" height="55">                        
                    <?php
                }
                ?>
                <label style="font-size: 24px; position: relative; top: 5px; text-transform: uppercase;"><?= $g_row['lastName'] . ", " . $g_row['firstName'] . " " . $g_row['middleName'] ?> <small style="color: gray; font-size: 13px;">( <?= $g_row['Course'] ?> )</small></label>
            </div>
            <div class="col-md-5">      
                <form method="POST" class="form-inline" action="?panel" autocomplete="off" style="position: relative; top: 12px;">
                    <div class="form-group">
                        <select class="form-control" name="t_year" id="t_year">
                            <?php 

                                $sql = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_facultyloads");
                                if(isset($_POST['btn_search'])){
                                    ?>
                                        <option selected><?= $_POST['t_year'] ?></option>
                                        <option disabled>---------------</option>
                                    <?php
                                    date_default_timezone_set("Asia/Manila");
                                    $date = date("Y");
                                    for($i = 2018; $i <= $date; $i++){
                                        $ii = $i + 1;
                                        ?>
                                        <option><?= $i . "-" . $ii?></option>
                                    <?php
                                    }
                                }else{
                                    date_default_timezone_set("Asia/Manila");
                                    $date = date("Y");
                                    for($i = 2018; $i <= $date; ++$i){
                                        $ii = $i + 1;
                                        ?>
                                        <option><?= $i . "-" . $ii?></option>
                                    <?php
                                    }
                                }
                            ?>
                        </select>
                        <span class="clearkent"></span>
                        <select class="form-control" name="t_sem" id="t_sem">
                            <?php 
                            if(isset($_POST['btn_search'])){
                                if($g_row['Course'] == "SHS"){
                                    if($_POST['t_sem'] == 1){
                                    ?>
                                        <option value="1" selected>1<sup>st</sup> Semester</option>
                                        <option value="2">2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }elseif($_POST['t_sem'] == 2){
                                    ?>
                                        <option value="1">1<sup>st</sup> Semester</option>
                                        <option value="2" selected>2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }else{
                                    ?>
                                        <option value="1">1<sup>st</sup> Semester</option>
                                        <option value="2">2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }
                                }else{
                                    if($_POST['t_sem'] == 1){
                                    ?>
                                        <option value="1" selected>1<sup>st</sup> Semester</option>
                                        <option value="2">2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }elseif($_POST['t_sem'] == 2){
                                    ?>
                                        <option value="1">1<sup>st</sup> Semester</option>
                                        <option value="2" selected>2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }else{
                                    ?>
                                        <option value="1">1<sup>st</sup> Semester</option>
                                        <option value="2">2<sup>nd</sup> Semester</option>
                                    <?php 
                                    }
                                    
                                }
                            }else{
                                ?>
                                <option value="1">1<sup>st</sup> Semester</option>
                                <option value="2">2<sup>nd</sup> Semester</option>
                                <?php
                            }
                            ?>
                        </select>  
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" name="btn_search" style="margin-left: 0px; background-color: #0FA7DC;"> Search &nbsp; <span class="fa fa-search"></span></button>
                        <?php 
                        /*if(isset($_POST['btn_search'])){
                            $year = $_POST['t_year'];
                            $sem = $_POST['t_sem'];
                            ?>                    
                            <a id="view" href="grades?std=<?= $id . "&year=" . $year . "&sem=" . $sem ?>" class="btn btn-info" style="background-color: #0FA7DC;"><span class="fa fa-eye"></span>&nbsp; View Grades</a>
                            <?php
                            }*/
                        ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="mytable" class="table">
                        <thead>
                            <tr>
                                <th>Subjects</th>
                                <th class="mobile_media">Descriptions</th>
                                <th><center></center></th>
                                <th></th>
                                <th><center>Semestral Grade</center></th>
                                <th><center>Numeric Grade</center></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $year = $_POST['t_year'];
                                    $sem = $_POST['t_sem'];
                                    $search_str = "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND Year = '$year' AND Semester = '$sem'";
                                    $search = mysqli_query($conn, $search_str);
                                     while( $rowx = mysqli_fetch_array($search)){
                                        $sub_id = $rowx['subjectCode'];
                                        $acad = $year;
                                        ?>
                                        <?php include("controls/computation.php"); ?>
                                        <tr>
                                            <td><?= $rowx['subjectCode']; ?></td>
                                            <?php 
                                                $code = $rowx['subjectCode'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td class="mobile_media"><?= $rowz['Description']; ?></td>
                                            <td></td>
                                            <?php 

                                            $res = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
                                            $res_r = mysqli_fetch_array($res);
                                            $num = mysqli_num_rows($res);
                                            if($num == 1){
                                                ?>
                                                <td class="grade"></td>
                                                <td class="grade"><b style="color: red;"><del>disabled</del></b></td>
                                                <td class="grade"><b style="color: red;"><del>disabled</del></b></td>
                                                <td class="grade"></td>
                                                <td class="grade"></td>
                                                <?php
                                            }else{
                                                ?>
                                                <td class="grade"></td>
                                                <td class="grade"><?= number_format($final_grade, 2 , '.', '') ?></td>
                                                <td class="grade"><?= $numeric_grade ?></td>
                                                <td class="grade"></td>
                                                <td class="grade"></td>
                                                <?php
                                            }
                                            ?>
                                            <td><!-- <a href="progress?std=<?= $id . "&year=" . $year . "&sem=" . $sem . "&subj=" . $code?>" class="btn btn-info btn-sm" style="background-color: #0FA7DC; border-radius: 20px;">View Progress</a> --></td>
                                        </tr>
                                        <?php
                                    }
                                }/*else{
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_grades WHERE Stud_Id = '$id' ORDER BY Year DESC");
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?= $rowx['SubjectCode']; ?></td>
                                            <?php 
                                                $code = $rowx['SubjectCode'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><?= $rowz['UnitLec']; ?></td>
                                            <?php 
                                                $instructor = $rowx['Fac_Id'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$instructor'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td><?= $rowz['lastName'] . ', ' .  $rowz['firstName'] . ' ' . $rowz['middleName']; ?></td>
                                            <td><center><?= $rowx['Grade']; ?></center></td>
                                            <?php 
                                                if($rowx['Remark'] == "PASSED"){
                                                    ?>
                                            <td style="color: green"><?= $rowx['Remark']; ?></td>
                                                    <?php
                                                }else{
                                                   ?>
                                            <td style="color: red"><?= $rowx['Remark']; ?></td>
                                                    <?php  
                                                }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                }*/
                                ?>

                                
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
        
        <hr>
        <?php 
        if(isset($_POST['btn_search'])){
            $year = $_POST['t_year'];
            $sem = $_POST['t_sem'];
            $search1 = mysqli_query($conn, "SELECT count(*) as e FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND Year = '$year' AND Semester = '$sem  '");
            $rowx1 = mysqli_fetch_array($search1);
            ?>
            <div class="pull-left">
             <?= ':: You have ( <b style="color: red">' . $rowx1['e']  . "</b> ) Subject Enrolled."; ?>
            </div>
            <?php
        }
        ?>
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
