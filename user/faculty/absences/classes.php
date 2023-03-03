<?php
######################################
# ------- Global Information ------- #
######################################
include('../../site-config.php');       #
include('../controls/global_info.php'); #
######################################
if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
    $subject = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE ID = '$s_id'");
    $row_s = mysqli_fetch_array($subject);
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
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body onload="jjj()">
<?php include("../controls/view/sub-navbar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="main" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <a href="../main" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="#" style="text-decoration: none;">
                <small>&nbsp; Subjects &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <small>&nbsp; Subject Record <b>[ <?= $row_s['SubjectLoad'] ?> ]</b> &nbsp;</small>
        </div>
        <hr>
        <div class="ro1w">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-3" style="text-transform: uppercase; font-weight: bold; color: gray;">
                        <div class="pull-right">
                            Subject Code : <br>
                        </div><br>
                        <div class="pull-right">
                            Description : <br>
                        </div>
                        <br>
                        <div class="pull-right">
                            Period : <br>
                        </div>
                        <br>
                        <div class="pull-right">
                            Academic Year/Term : <br>
                        </div>
                        <br><br>
                        <div class="pull-right">
                            Grade Components : <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php 
                    $s_code = $row_s['SubjectLoad'];
                    $call_description1 = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$s_code'");
                    $row_d = mysqli_fetch_array($call_description1);

                    ?>
                    <div class="pull-left">
                        <b><?= $row_d['subjectCode'] ?></b> <br>
                    </div>
                    <br>
                    <div class="pull-left">
                        <b><?= $row_d['Description'] ?></b> <br>
                    </div>
                    <br>
                    <?php 

                    $subject_shs = mysqli_query($conn, "SELECT count(*) as e FROM tbl_facultyloads WHERE ID = '$s_id' AND SubjectLoad like '%SHS%'");
                    $row_shs = mysqli_fetch_array($subject_shs);

                    if($row_shs['e'] == 1){

                        date_default_timezone_set("Asia/Manila");
                        $date_now = date("m.d");
                        ###################
                        # School Calendar #
                        ###################
                        $rs_c = mysqli_query($conn, "SELECT * FROM tbl_schoolcalendar WHERE ID = '1'");
                        $row_c = mysqli_fetch_array($rs_c);
                        #######################################
                        $pre_s = date_create($row_c['Prelim']);
                        $pre_e = date_create($row_c['Prelim_End']);
                        $prelim_start = date_format($pre_s,"m.d");
                        $prelim_end = date_format($pre_e,"m.d");
                        #######################################
                        $mid_s = date_create($row_c['Midterm']);
                        $mid_e = date_create($row_c['Midterm_End']);
                        $midterm_start = date_format($mid_s,"m.d");
                        $midter_end = date_format($mid_e,"m.d");
                        #######################################
                        $semi_s = date_create($row_c['Semi_Final']);
                        $semi_e = date_create($row_c['Semi_Final_End']);
                        $semifinal_start = date_format($semi_s,"m.d");
                        $semifinal_end = date_format($semi_e,"m.d");
                        #######################################
                        $final_e = date_create($row_c['Final_End']);
                        $final_end = date_format($final_e,"m.d");
                        #######################################

                           #Date     #End   #Date    #Start
                        if($date_now <= $final_end){
                            echo 'Period : &nbsp;<label> <i>4th Grading</i> </label> <br>';
                            $period = "4th Grading";
                        }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
                            echo 'Period : &nbsp;<label> <i>1st Grading</i> </label> <br>';
                            $period = "1st Grading";
                        }elseif($date_now <= $midter_end && $date_now >= $midterm_start){
                            echo 'Period : &nbsp;<label> <i>2nd Grading</i> </label> <br>';
                            $period = "2nd Grading";
                        }elseif($date_now <= $semifinal_end && $date_now >= $semifinal_start){
                            echo '<label><b>3rd Grading</b><br>';
                            $period = "3rd Grading";
                        }else{
                            echo 'Period : &nbsp;<label> <i><del>Not Available</del></i> </label> <br>';
                            $period = "Not Available";
                        }

                        ?>
                        <div id="info" class="pull-left">
                             &nbsp;<label> <b id="dacad"></b> <b style="display: none;" id="dsem"></b></label> <br>                          
                        </div>
                        <br><br>
                        <?php

                    }else{

                        date_default_timezone_set("Asia/Manila");
                        $date_now = date("m.d");
                        ###################
                        # School Calendar #
                        ###################
                        $rs_c = mysqli_query($conn, "SELECT * FROM tbl_schoolcalendar WHERE ID = '1'");
                        $row_c = mysqli_fetch_array($rs_c);
                        #######################################
                        $pre_s = date_create($row_c['Prelim']);
                        $pre_e = date_create($row_c['Prelim_End']);
                        $prelim_start = date_format($pre_s,"m.d");
                        $prelim_end = date_format($pre_e,"m.d");
                        #######################################
                        $mid_s = date_create($row_c['Midterm']);
                        $mid_e = date_create($row_c['Midterm_End']);
                        $midterm_start = date_format($mid_s,"m.d");
                        $midter_end = date_format($mid_e,"m.d");
                        #######################################
                        $semi_s = date_create($row_c['Semi_Final']);
                        $semi_e = date_create($row_c['Semi_Final_End']);
                        $semifinal_start = date_format($semi_s,"m.d");
                        $semifinal_end = date_format($semi_e,"m.d");
                        #######################################
                        $final_e = date_create($row_c['Final_End']);
                        $final_end = date_format($final_e,"m.d");
                        #######################################

                           #Date     #End   #Date    #Start
                        if($date_now <= $final_end){
                            echo 'Period : &nbsp;<label> <i>Finals</i> </label> <br>';
                            $period = "Finals";
                        }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
                            echo 'Period : &nbsp;<label> <i>Prelim</i> </label> <br>';
                            $period = "Prelim";
                        }elseif($date_now <= $midter_end && $date_now >= $midterm_start){
                            echo 'Period : &nbsp;<label> <i>Midterm</i> </label> <br>';
                            $period = "Midterm";
                        }elseif($date_now <= $semifinal_end && $date_now >= $semifinal_start){
                            echo '<label><b>Semi-Finals</b><br>';
                            $period = "Semi-Finals";
                        }else{
                            echo 'Period : &nbsp;<label> <i><del>Not Available</del></i> </label> <br>';
                            $period = "Not Available";
                        }
                        ?>
                        <div id="info" class="pull-left">
                           <label> <b id="dacad"></b> - <b id="dsem"></b></label>         
                        </div><br>
                        <br>
                        <?php
                    }
                    ?>
                        <div class="pull-left">
                            <label> <b style="color: red; letter-spacing: 1px; text-transform: uppercase;" id="dquiz"></b></label> <br>                                         
                        </div>
                    </div>                     
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-3" style="display: none;">
                        <b style="letter-spacing: 1px;">&nbsp;Academic Year</b><br>
                        <input type="hidden" id="sub_id" value="<?= $row_d['subjectCode'] ?>" name="">
                        <select class="form-control" id="acad" onchange="jjj()" style="margin-top: 5px;">
                            <?php 
                            $datenow = date('Y');
                            $datetom = date('Y', strtotime($datex. ' + 1 year'));
                            ?>
                            <option><?= $datenow . "-" . $datetom ?></option>
                        </select>
                    </div>            
                    <div class="col-lg-3" style="display: none;">
                       <input type="hidden" id="section" value="<?= $row_s['Section']; ?>" name="">
                       <b style="letter-spacing: 1px;">&nbsp;Semester</b><br>
                        <select class="form-control" id="semester" onchange="jjj()" style="margin-top: 5px;">
                            <option selected value="<?= $row_s['Semester'] ?>">
                            <?php 
                                if($row_s['Semester'] == 1){
                                    echo $row_s['Semester'] . "st Semester";
                                }else{
                                    echo $row_s['Semester'] . "nd Semester";
                                }
                            ?>                            
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-4" style="display: none;">
                        <b style="letter-spacing: 1px;">&nbsp;Grade Components</b><br>
                        <select class="form-control" id="quiz" onchange="jjj()" style="margin-top: 5px;">
                            <option>Unexcused absences incurred</option>
                            <!-- <option>Quiz 2</option>
                            <option>Quiz 3</option>
                            <option>Performance Task</option>
                            <option>Exam</option> -->
                        </select>
                    </div>
                    <div class="col-lg-2" style="display: none;">
                        <b style="letter-spacing: 1px;">&nbsp;Period</b><br>
                        <select class="form-control" id="period" onchange="jjj()" style="margin-top: 5px;">
                            <option><?= $period ?></option>
                        </select>
                    </div>
                </div>
                -
            </div>
            <div class="panel-body">                
                <div id="idsp"></div>
                <div id="dsp" style="display: none;"></div>
            </div>
        </div>
       
    </div>
</div>
<style type="text/css">#info { display: none; }</style>
<script type="text/javascript">
    function jjj(){
        var acad = document.getElementById("acad").value;
        var sem = document.getElementById("semester").value;
        var quiz = document.getElementById("quiz").value;
        var period = document.getElementById("period").value;
        var sub_id = document.getElementById("sub_id").value;
        var section = document.getElementById("section").value;
        var trgr = 1;
        document.getElementById("info").style.display = "block";
        document.getElementById("dacad").innerHTML = acad;
        if(sem == 1){
            document.getElementById("dsem").innerHTML = sem + 'st Semester';
        }else{
            document.getElementById("dsem").innerHTML = sem + 'nd Semester';
        }       
        document.getElementById("dquiz").innerHTML = quiz;
        //document.getElementById("dperiod").innerHTML = period;

        $.ajax({
            type: "POST",
            url: "trigger.php",
            data: {"trigger": trgr, "Acad": acad, "Semester": sem, "Quiz": quiz, "Period": period, "sub_id": sub_id, "section": section},
           success: function(html){
                $('#idsp').html(html);
            },
        }); 

    }
</script>
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../../dist/js/sb-admin-2.js"></script>
</body>

</html>
