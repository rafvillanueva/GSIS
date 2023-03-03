<?php
include("../../site-config.php");
ob_start();
session_start();
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

if($row_admn['Level'] == "Registrar"){
    $link = '
    ';
}elseif($row_admn['Level'] == "Administrator"){
    $link = '';
}else{
   ?><script type="text/javascript">window.location.href = '../../login/'</script><?php
}

$rs_st = mysqli_query($conn, "SELECT * FROM tbl_studentrecord");
$rs_ft = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo");
$rs_cr = mysqli_query($conn, "SELECT * FROM tbl_coursesoffered");
$rs_ss = mysqli_query($conn, "SELECT * FROM tbl_section");
$rs_sj = mysqli_query($conn, "SELECT * FROM tbl_subjects");

$row_st = mysqli_num_rows($rs_st); 
$row_ft = mysqli_num_rows($rs_ft); 
$row_cr = mysqli_num_rows($rs_cr); 
$row_ss = mysqli_num_rows($rs_ss);  
$row_sj = mysqli_num_rows($rs_sj);

?>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Montserrat');

    #kiao:hover {background-color: transparent;}
    a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
    a:active {background-color: transparent;}

    body {font-family: 'Montserrat', sans-serif;}
    @media only screen and (max-width: 600px) {
        .fontz{ font-size: 14px !important;}
        .imagez{ height: 32px !important; width: 32px !important; position: relative; top: 5px; }
    }
    @media only screen and (max-width: 400px) {
        .fontzz{ font-size: 11px !important;}
        .imagezz{ height: 22px !important; width: 22px !important; position: relative; top: 5px; }
    }
    .navbar-collapse{border-top: 0px;}
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            <img src="../../vineyard.png">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="">
                       <b><?= $row_admn['Level'] ?> - cPANEL</b><hr>

                        <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>User Information</small></i><br><br>
                        <b><?= $row_admn['Username'] ?></b> <sup>&#8211;USER</sup><br>
                        <b><?= $row_admn['Level'] ?></b> <sup>&#8211;ROLE</sup><br>
                        <b><?= $row_admn['Email'] ?></b> <sup>&#8211;EMAIL</sup><br><br>

                        <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Total Counts</small></i><br><br>
                        <div style="text-transform: uppercase; font-weight: bold;">
                            <div class="pull-left">Students &#8211;</div>
                            <div class="pull-right"><label class="label label-danger" style="letter-spacing: 2px; background-color: crimson">
                                <?= number_format($row_st, 0 , "", ",") ?></label></div>
                        </div><br>
                        <div style="text-transform: uppercase; font-weight: bold;">
                            <div class="pull-left">Faculty &#8211;</div>
                            <div class="pull-right"><label class="label label-danger" style="letter-spacing: 2px; background-color: crimson">
                                <?= number_format($row_ft, 0 , "", ",") ?></label></div>
                        </div><br>
                        <div style="text-transform: uppercase; font-weight: bold;">
                            <div class="pull-left">Subjects &#8211;</div>
                            <div class="pull-right"><label class="label label-danger" style="letter-spacing: 2px; background-color: crimson">
                                <?= number_format($row_sj, 0 , "", ",") ?></label></div>
                        </div><br>
                        <div style="text-transform: uppercase; font-weight: bold;">
                            <div class="pull-left">Courses &#8211;</div>
                            <div class="pull-right"><label class="label label-danger" style="letter-spacing: 2px; background-color: crimson">
                                <?= number_format($row_cr, 0 , "", ",") ?></label></div>
                        </div><br>
                        <div style="text-transform: uppercase; font-weight: bold;">
                            <div class="pull-left">Section &#8211;</div>
                            <div class="pull-right"><label class="label label-danger" style="letter-spacing: 2px; background-color: crimson">
                                <?= number_format($row_ss, 0 , "", ",") ?></label></div>
                        </div><br><br>

                         <!--<i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Goto - </small></i><br><br>
                         <select class="form-control" id="url" required onchange="url()">
                             <option selected disabled value="">-- URL --</option>
                             <option disabled></option>
                             <option value="Dashboard">Dashboard (Main)</option>
                             <option disabled></option>
                             <option disabled> + School Management</option>
                             <option value="school-calendar">School Calendar</option>
                             <option value="semester-calendar">Semester Calendar</option>
                              <option value="student-grade-management">Student Grade Management</option>
                             <option value="grade-view">Restriction Grade View</option> 
                             <option value="grade-converter">Numeric Grade Converter</option>
                             <option disabled></option>
                             <option disabled> + List</option>
                             <option value="students">List of Students</option>
                             <option value="faculty">List of Faculty</option>
                             <option value="subjects">List of Subjects</option>
                             <option value="section">List of Sections</option>
                             <option value="course">List of Course</option>
                             <option disabled></option>
                             <option disabled> + Adding Controls</option>
                             <option value="new-course">Add Course</option>
                             <option value="new-section">Add Section</option>
                             <option value="new-subject">Add Subject</option>
                             <option value="new-student">Add Student</option>
                             <option value="faculty-new">Add Faculty</option>
                         </select>
                         <hr>-->
                    </div>
                    <a href="student-grade-management">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                   <a href="../../../login/logout/logout.php?logout">
                        <img src="assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
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