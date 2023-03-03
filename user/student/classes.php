<?php include('../../config/db.php'); ?>
<?php
error_reporting(0);
ob_start();
session_start();

if(isset($_SESSION['user']) == ""){
    ?>
    <script type="text/javascript">
        window.location.href = "../../login/";
    </script>
    <?php
}else{
    $id = $_SESSION['user'];
    $info = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$id'");
    $info_row = mysqli_fetch_array($info);
}

if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
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
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body onload="jjj()">
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
                    <a href="panel"><i class="fa fa-fw fa-user"></i> &nbsp;Classes</a>
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
                <h2 class="page-header"><i class="fa fa-user"></i> Welcome Back! <b><?= $info_row['lastName'] . ', ' . $info_row['firstName'] . ' ' . $info_row['middleName'] ?></b></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                
                <div class="jumbotron" style="padding: 20px;">
                    <?php 

                        $subject = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE ID = '$s_id'");
                        $row_s = mysqli_fetch_array($subject);

                        $s_code = $row_s['SubjectLoad'];
                        $call_description1 = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$s_code'");
                        $row_d = mysqli_fetch_array($call_description1);

                    ?>
                    Subject Code : &nbsp;<label> <i><?= $row_d['subjectCode'] ?></i> </label> <br>
                    Description : &nbsp;<label> <i><?= $row_d['Description'] ?></i> </label><br>
                    <div id="info">
                        Academic Year/Term : &nbsp;<label> <i id="dacad"></i> </label> <br>
                        Grade Components : &nbsp;<label> <i id="dquiz"></i> </label> <br>
                        Period : &nbsp;<label> <i id="dperiod"></i> </label> <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Academic Year/Term</b><br>
                <input type="hidden" id="sub_id" value="<?= $row_d['subjectCode'] ?>" name="">
                <select class="form-control" id="acad" onchange="jjj()" style="margin-top: 5px;">
                    <?php 

                        $query = mysqli_query($conn, "SELECT DISTINCT(AcadYearAndSem_Assigned) FROM tbl_facultyloads ORDER BY AcadYearAndSem_Assigned DESC");
                        while( $row = mysqli_fetch_array($query)){
                            ?>
                            <option><?= $row['AcadYearAndSem_Assigned']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Grade Components</b><br>
                <select class="form-control" id="quiz" onchange="jjj()" style="margin-top: 5px;">
                    <option>Quiz 1</option>
                    <option>Quiz 2</option>
                    <option>Quiz 3</option>
                    <option>Performance Task</option>
                    <option>Exam</option>
                </select>
            </div>
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Period</b><br>
                <select class="form-control" id="period" onchange="jjj()" style="margin-top: 5px;">
                    <option>Prelim</option>
                    <option>Midterm</option>
                    <option>Semi-Final</option>
                    <option>Finals</option>
                </select>
            </div>            
            <div class="col-lg-3">
               <input type="hidden" id="section" value="<?= $row_s['Section']; ?>" name="">
            </div>
        </div>
        <hr>
        <div id="idsp"></div>
        <div id="dsp"></div>
    </div>
</div>
<style type="text/css">#info { display: none; }</style>
<script type="text/javascript">
    function jjj(){
        var acad = document.getElementById("acad").value;
        var quiz = document.getElementById("quiz").value;
        var period = document.getElementById("period").value;
        var sub_id = document.getElementById("sub_id").value;
        var section = document.getElementById("section").value;
        var trgr = 1;
        document.getElementById("info").style.display = "block";
        document.getElementById("dacad").innerHTML = acad;
        document.getElementById("dquiz").innerHTML = quiz;
        document.getElementById("dperiod").innerHTML = period;

        $.ajax({
            type: "POST",
            url: "trigger.php",
            data: {"trigger": trgr, "Acad": acad, "Quiz": quiz, "Period": period, "sub_id": sub_id, "section": section},
           success: function(html){
                $('#idsp').html(html);
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
