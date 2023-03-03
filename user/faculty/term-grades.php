<?php

######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
###################################### 

if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
}

$subject = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE ID = '$s_id'");
$row_s = mysqli_fetch_array($subject);

$s_code = $row_s['SubjectLoad'];
$call_description1 = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$s_code'");
$row_d = mysqli_fetch_array($call_description1);

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
        #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }        
    </style>
</head>
<body onload="jjj()">
<!--  -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
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
                    <img src="controls/icons/User_96px.png" height="32" style="position: relative;">
                    <?= $row_info['lastName'] . ", " . $row_info['firstName'] ?><br><hr>
                    <a href="current-classes">
                        <img src="controls/icons/Classroom_96px.png" height="32" style="position: relative;">
                        <b> Current Classes</b>
                    </a>
                    <!-- <a href="all-classes">
                        <img src="controls/icons/Books_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a> -->
                    <a href="term-and-semestral" style="background-color: #EEEEEE;">
                        <img src="controls/icons/Scorecard_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a>
                    <!-- <a href="import/main">
                        <img src="controls/icons/Microsoft Excel_96px.png" height="32" style="position: relative;">
                        <b> Import Scores (Excel)</b>
                    </a> -->
                    <a href="../faculty">
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
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="term-and-semestral" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <a href="main" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="term-and-semestral" style="text-decoration: none;">
                <small>&nbsp; Term and Semester &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <small>&nbsp; Subject Selected <b>[ <?= $row_d['subjectCode'] ?> ]</b> &nbsp;</small>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-3">
                    <div class="pull-right">
                        <b style="color: gray; text-transform: uppercase;">Subject Code :</b>
                    </div><br>
                    <div class="pull-right">
                        <b style="color: gray; text-transform: uppercase;">Description : </b>
                    </div><br>
                    <div class="pull-right">
                        <b style="color: gray; text-transform: uppercase;">Academic Year/Term : </b>
                    </div>
                </div>
                <div class="col-md-9">
                    <b><?= $row_d['subjectCode'] ?></b><br>
                    <b><?= $row_d['Description'] ?></b><br>
                    <div id="info"></div>
                    <b id="dacad"></b><b id="dsem"></b>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Term and Semestral Grade
            </div>
            <div class="panel-body" style="padding: 0px;">
                <div id="idsp"></div> <!--  Display Grades -->
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Academic Year</b><br>
                <input type="hidden" id="sub_id" value="<?= $row_d['subjectCode'] ?>" name="">
                <select class="form-control" id="acad" onchange="jjj()" style="margin-top: 5px;">
                    <?php 

                        $query = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_facultyloads ORDER BY Year DESC");
                        while( $row = mysqli_fetch_array($query)){
                            ?>
                            <option><?= $row['Year']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>            
            <div class="col-lg-3">
               <input type="hidden" id="section" value="<?= $row_s['Section']; ?>" name="">
               <b style="letter-spacing: 1px;">&nbsp;Semester</b><br>
                <select class="form-control" id="semester" onchange="jjj()" style="margin-top: 5px;">
                    <option selected value="<?= $row_s['Semester'] ?>">
                    <?php 
                        if($row_s['Semester'] == 1){
                            echo $row_s['Semester'] . "st Semester";
                        }elseif($row_s['Semester'] == 2){
                            echo $row_s['Semester'] . "nd Semester";
                        }else{
                             echo $row_s['Semester'];
                        }
                    ?>                            
                    </option>
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
                    <option>Semi-Finals</option>
                    <option>Finals</option>
                </select>
            </div>
        </div>
        <hr>
        
        <div id="dsp"></div>
        </form>
        <?php
        if(isset($_POST['postgrade']) ) {
        /*$id = $_POST['idx'];
        */
        if(!empty($_POST['grade'])){

            /*foreach($_POST['grade'] as $grade){
               
            //$sql_multi_del = mysqli_query($conn, $query_multi_del); 
            //echo $selected."</br>";
            }*/
            $num = $_POST['count'];
            $fac_id = $_POST['fac_id'];
            $Remarks = $_POST['Remarks'];
            $grade = $_POST['grade'];
            $std_id = $_POST['std_id'];
            $Year = $_POST['Year'];
            $Semester = $_POST['Semester'];
            $Section = $_POST['Section'];
            $SubjectCode = $_POST['SubjectCode'];

            for($i = 0; $i < $num; $i++)
            {

                $verify = mysqli_query($conn, "SELECT count(*) as e FROM tbl_grades WHERE Fac_Id = '".$fac_id[$i]."' AND Stud_Id = '".$std_id[$i]."' AND SubjectCode = '".$SubjectCode[$i]."' AND Year = '".$Year[$i]."' AND Sem = '".$Semester[$i]."' AND Section = '".$Section[$i]."'");
                $vrow = mysqli_fetch_array($verify);
                if($vrow['e'] == 0){
                     $query = "INSERT INTO tbl_grades(Fac_Id, Stud_Id, SubjectCode, Year, Sem, Section, Grade, Remark) VALUES('".$fac_id[$i]."','".$std_id[$i]."','".$SubjectCode[$i]."','".$Year[$i]."','".$Semester[$i]."','".$Section[$i]."','".$grade[$i]."','".$Remarks[$i]."')";
                     $sql = mysqli_query($conn, $query);
                }

               
            }

        }
    }

        ?>
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
            document.getElementById("dsem").innerHTML = ' - ' + sem + 'st Semester';
        }else if(sem == 2){
            document.getElementById("dsem").innerHTML = ' - ' + sem + 'nd Semester';
        }else if(sem == 101){
            document.getElementById("dsem").innerHTML = '';
        }

        

        $.ajax({
            type: "POST",
            url: "term-compute.php",
            data: {"trigger": trgr, "Acad": acad, "Semester": sem, "Quiz": quiz, "Period": period, "sub_id": sub_id, "section": section},
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
