<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
######################################
/*$qr = "mysqli_query";
$a = $qr($conn, "SELECT * FROM tbl_studentrecord");
while ($row = mysqli_fetch_array($a)) {
    $s_id = $row['Stud_id'];
    $ 
}*/

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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        .btn-kent {
            border: none;
            background: url('controls/icons/download1.png') no-repeat top left;    
            padding: 2px 8px;
        }
        .btn-kent:hover {
            background-color: #63A1A7 !important;
            border-bottom: 5px solid #2D2A31 !important;
        }
    </style>
</head>
<body>
<?php include("controls/view/main-navbar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row1">
            <div style="background: url('controls/icons/download.png') no-repeat top left; border-radius: 1px; padding: 8px; background-color: #63A1A7; border-bottom: 5px solid #2D2A31; color: #fff; letter-spacing: 2px;">
               <h4>&nbsp;<span class="fa fa-angle-double-right"></span><span class="fa fa-angle-right"></span> Class Record Facility</h4>
            </div>
            <br>
            <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline" method="POST">
                    <!-- <b>Search : </b> &nbsp; 
                    <input type="text" name="t_search" class="form-control" placeholder="Search here..">
                    <button type="submit" name="btn_search" class="btn btn-primary"><span class="fa fa-search"></span> Search</button> -->
                    <B><span class="fa fa-list"></span> SELECT GRADE LEVEL</B>
                </form>  
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <!-- <th>Description</th>
                                <th><center>Academic Year</center></th> -->
                                <!-- <th><center>Section</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $val = $_POST['t_search'];
                                    $search = mysqli_query($conn, "SELECT DISTINCT(grade_level),Section FROM tbl_facultyloads WHERE Fac_Id = '$id' AND (grade_level LIKE '%$val%' OR Section LIKE '%$val%' OR s_year LIKE '%$val%') ORDER BY s_year DESC");
                                     while( $rowx = mysqli_fetch_array($search)){
                                        ?>
                                        <tr onclick="window.location='iindex.php?subject=<?= $rowx['grade_level'] ?>';" id="xhover">
                                            <?php 
                                              if($rowx['grade_level'] == "0"){
                                                $data = "Nursery";
                                              }elseif($rowx['grade_level'] == "1"){
                                                $data = "K-1";
                                              }elseif($rowx['grade_level'] == "2"){
                                                $data = "K-2";
                                              }elseif($rowx['grade_level'] == "G1"){
                                                $data = "Grade-1";
                                              }elseif($rowx['grade_level'] == "G2"){
                                                $data = "Grade-2";
                                              }elseif($rowx['grade_level'] == "G3"){
                                                $data = "Grade-3";
                                              }elseif($rowx['grade_level'] == "G4"){
                                                $data = "Grade-4";
                                              }elseif($rowx['grade_level'] == "G5"){
                                                $data = "Grade-5";
                                              }elseif($rowx['grade_level'] == "G6"){
                                                $data = "Grade-6";
                                              }
                                            ?>                                            
                                            <td><?= $data; ?></td>
                                            <!-- <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= $rowx['s_year']; ?></center></td> -->
                                            <!-- <td><center><?= $rowx['Section']; ?></center></td> -->
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    $query = mysqli_query($conn, "SELECT DISTINCT(grade_level),Section FROM tbl_facultyloads WHERE Fac_Id = '$id' ORDER BY s_year DESC");
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr onclick="window.location='iindex.php?subject=<?= $rowx['grade_level'] ?>';" id="xhover">
                                            <?php 
                                              if($rowx['grade_level'] == "0"){
                                                $data = "Nursery";
                                              }elseif($rowx['grade_level'] == "1"){
                                                $data = "K-1";
                                              }elseif($rowx['grade_level'] == "2"){
                                                $data = "K-2";
                                              }elseif($rowx['grade_level'] == "G1"){
                                                $data = "Grade-1";
                                              }elseif($rowx['grade_level'] == "G2"){
                                                $data = "Grade-2";
                                              }elseif($rowx['grade_level'] == "G3"){
                                                $data = "Grade-3";
                                              }elseif($rowx['grade_level'] == "G4"){
                                                $data = "Grade-4";
                                              }elseif($rowx['grade_level'] == "G5"){
                                                $data = "Grade-5";
                                              }elseif($rowx['grade_level'] == "G6"){
                                                $data = "Grade-6";
                                              }
                                            ?>                                            
                                            <td><?= $data; ?></td>
                                            <!-- <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= $rowx['s_year']; ?></center></td> -->
                                            <!-- <td><center><?= $rowx['Section']; ?></center></td> -->
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
        </div>
        <?php include("controls/modal/modal.php") ?>
    </div>
</div>


</body>

</html>
