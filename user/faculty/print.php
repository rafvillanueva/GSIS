<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
######################################
if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
    $subject = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE ID = '$s_id'");
    $row_s = mysqli_fetch_array($subject);

    $user = $_SESSION['user']; 
}
?>
<?php
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

$rs_info = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_id = '$user'");
$row_info = mysqli_fetch_array($rs_info);

$s = $_GET['subject'];
$f_val   = 'SHS';
$str = substr($s, 0, 3);
$f_rs = strpos($str, $f_val);

if($f_rs === false){
    $calendar = '';
}else{
    $calendar = 'SHS';
}

include("controls/view/calendar.php");
?>
<?php 
    $s_code = $_GET['subject'];
    $call_description1 = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$s_code'");
    $row_d = mysqli_fetch_array($call_description1);
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
</head>
<body onload="jjj();">
<!--  -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7; display: none;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            <img src="controls/icons/fav.png" height="85">
        </a>
    </div>

    <div class="navbar-default sidebar" role="navigation" style="display: none;">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <img src="controls/icons/User_96px.png" height="32" style="position: relative;">
                    <?= $row_info['lastName'] . ", " . $row_info['firstName'] ?><br><hr>
                    <!-- <a href="current-classes" style="background-color: #EEEEEE;">
                        <img src="controls/icons/Classroom_96px.png" height="32" style="position: relative;">
                        <b> Current Classes</b>
                    </a> -->
                    <!-- <a href="all-classes">
                        <img src="controls/icons/Books_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a> -->
                    <!-- <a href="term-and-semestral">
                        <img src="controls/icons/Scorecard_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a> -->
                    <!-- <a href="import/main">
                        <img src="controls/icons/Microsoft Excel_96px.png" height="32" style="position: relative;">
                        <b> Import Scores (Excel)</b>
                    </a> -->
                    <a href="iiindex.php?sec=<?= $_GET['sec'] ?>&ss=<?= $_GET['ss'] ?>">
                        <img src="controls/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="controls/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b> Logout</b>
                    </a>
                </li>
                <li>
                   <?= $link ?>
                </li>
                <script type="text/javascript">
                    function url() {
                        var url = document.getElementById("url").value;
                        window.location.href = url;
                    }
                </script>
            </ul>
        </div>
    </div>
</nav>
<!--  -->
<div id="page-wrappe1r">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px; display: none;">
            <a href="iiindex.php?sec=<?= $_GET['sec'] ?>&ss=<?= $_GET['ss'] ?>" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <a href="main" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="#" style="text-decoration: none;">
                <small>&nbsp; Classess &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <small>&nbsp; Subject Record <b>[ <?= $row_s['SubjectLoad'] ?> ]</b> &nbsp;</small>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">  
                    <div class="col-lg-9" style="display: block;">
                        <b>Faculty Name : <u> <?= $row_info['lastName'] . ", " . $row_info['firstName'] ?></u></b>
                        &nbsp; :: &nbsp;
                        <b style="padding-top: 50px;">Subject Code : <u><?= $row_d['subjectCode'] ?></u></b>
                    </div>
                    <div class="col-lg-3" style="display: none;">
                        <b style="letter-spacing: 1px;">&nbsp;Period</b><br>
                        <input type="hidden" id="sub_id" value="<?= $row_d['subjectCode'] ?>" name="">
                        <input type="hidden" id="section" value="<?= $_GET['sec']; ?>" name="">
                        <select class="form-control" id="period" onchange="jjj()" style="margin-top: 5px;">
                            <option><?= $_GET['op'] ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-body">                
                <div id="idsp"></div>
                <div id="dsp" style="display: block;"></div>
            </div>
        </div>
       
    </div>
</div>
<style type="text/css">#info { display: none; }</style>
<script type="text/javascript">
    function jjj(){
        /*var acad = document.getElementById("acad").value;
        var sem = document.getElementById("semester").value;
        var quiz = document.getElementById("quiz").value;*/
        var trgr = 1;
        var period = document.getElementById("period").value;
        var sub_id = document.getElementById("sub_id").value;
        var section = document.getElementById("section").value;
        var s_sub = "<?= $row_d['subjectCode'] ?>";
        /*var sub_id = document.getElementById("sub_id").value;
        
        var trgr = 1;*/
        /*document.getElementById("info").style.display = "block";
        document.getElementById("dacad").innerHTML = acad;
        if(sem == 1){
            document.getElementById("dsem").innerHTML = sem + 'st Semester';
        }else{
            document.getElementById("dsem").innerHTML = sem + 'nd Semester';
        }       
        document.getElementById("dquiz").innerHTML = quiz;*/
        //document.getElementById("dperiod").innerHTML = period;

        $.ajax({
            type: "POST",
            url: "tt_grades_print.php",
            data: {"trigger": trgr, "Period": period, "sub_id": sub_id, "section": section, "s_sub": s_sub},
           success: function(html){
                $('#idsp').html(html);
                window.print();
            },
        }); 

    }
</script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
