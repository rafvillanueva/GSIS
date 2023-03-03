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
        
    </style>
</head>
<body>
<?php include("nav.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <h3 class="page-header"><i class="fa fa-certificate"></i> Semestral Grades</h3>
            </div>
        </div>
        <div class="row">       
            <form method="POST" action="?panel" autocomplete="off">                 
            <div class="col-lg-7">
                <input class="form-control"  style="padding-right: 0px;" name="t_search" placeholder="Search here..">
            </div>
            <div class="col-lg-1">
                <button class="btn btn-danger" name="btn_search" style="margin-left: 0px;  background-color: #ED1F24;"> Search &nbsp; <span class="fa fa-search"></span></button>
            </div>
            <div class="col-lg-4">
              
            </div>
            </form>
        </div>
        <hr>
        
        <table id="mytable" class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>School Year</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['btn_search'])){
                        $val = $_POST['t_search'];
                        $search = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND (SubjectLoad LIKE '%$val%' OR Section LIKE '%$val%' OR Year LIKE '%$val%') ORDER BY Year DESC");
                         while( $rowx = mysqli_fetch_array($search)){
                            ?>
                            <tr onclick="window.location='records?subject=<?= $rowx['ID'] ?>';" id="xhover">
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
                        $query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' ORDER BY Year DESC");
                        while( $rowx = mysqli_fetch_array($query)){
                            ?>
                            <tr onclick="window.location='records?subject=<?= $rowx['ID'] ?>';" id="xhover">
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
                    }
                    ?>
                    <style type="text/css">
                        #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
                    </style>                   
            </tbody>
        </table>
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
