<?php
######################################
# ------- Global Information ------- #
######################################
include('../../site-config.php');       #
include('../controls/global_info.php'); #
######################################
date_default_timezone_set("Asia/Manila");
$current_year = date('Y');
$advance_year = date('Y') + 1;
$date = $current_year . "-" . $advance_year;
$current_month = date('m');
$query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND YEAR = '$date' ORDER BY Year DESC");

$subject_shs = mysqli_query($conn, "SELECT count(*) as e FROM tbl_facultyloads WHERE ID = '$s_id' AND SubjectLoad like '%SHS%'");
$row_shs = mysqli_fetch_array($subject_shs);

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
<body>
<?php include("../controls/view/sub-navbar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="../main" style="text-decoration: none;">
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
        </div>
        <hr>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>UNEXCUSED ABSENCES INCURRED </b>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th><center>School Year</center></th>
                                <th><center>Section</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $val = $_POST['t_search'];
                                    $search = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND (SubjectLoad LIKE '%$val%' OR Section LIKE '%$val%' OR Year LIKE '%$val%') ORDER BY Year DESC");
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
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND YEAR = '$date' ORDER BY Year DESC");
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr onclick="window.location='Classes?subject=<?= $rowx['ID'] ?>';" id="xhover">
                                            <td><?= $rowx['SubjectLoad']; ?></td>
                                            <?php 
                                                $code = $rowx['SubjectLoad'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= $rowx['Year']; ?></center></td>
                                            <td><center><?= $rowx['Section']; ?></center></td>
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
<br>
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../../vendor/raphael/raphael.min.js"></script>
<script src="../../vendor/morrisjs/morris.min.js"></script>
<script src="../../data/morris-data.js"></script>
<script src="../../dist/js/sb-admin-2.js"></script>
</body>

</html>
