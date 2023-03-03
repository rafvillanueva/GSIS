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
<?php include("nav.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
       <!--  <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-user"></i> Welcome Back! <b><?= $info_row['lastName'] . ', ' . $info_row['firstName'] . ' ' . $info_row['middleName'] ?></b></h2>
            </div>
        </div> --><br>
        <div class="row">
            <div class="col-md-12">                
                <h2 class="alert alert-success"><span class="fa fa-check"></span> <b>Success!</b> Grades has been posted.</h2>
            </div>
        </div>
        <hr>
        <?php
        if(isset($_POST['postgrade']) ) {

        if(!empty($_POST['grade'])){

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
            ?>

            <?php

        }
    }

        ?>
    </div>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
