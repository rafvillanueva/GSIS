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
<!--  -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
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
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
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
                    <a href="iindex.php?subject=<?= $_GET['ss'] ?>">
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
        <div class="row1">
            <div style="background: url('controls/icons/download.png') no-repeat top left; border-radius: 1px; padding: 8px; background-color: #63A1A7; border-bottom: 5px solid #2D2A31; color: #fff; letter-spacing: 2px;">
                <?php
                  if($_GET['ss'] == "0"){
                    $data = "Nursery";
                  }elseif($_GET['ss'] == "1"){
                    $data = "K-1";
                  }elseif($_GET['ss'] == "2"){
                    $data = "K-2";
                  }elseif($_GET['ss'] == "G1"){
                    $data = "Grade-1";
                  }elseif($_GET['ss'] == "G2"){
                    $data = "Grade-2";
                  }elseif($_GET['ss'] == "G3"){
                    $data = "Grade-3";
                  }elseif($_GET['ss'] == "G4"){
                    $data = "Grade-4";
                  }elseif($_GET['ss'] == "G5"){
                    $data = "Grade-5";
                  }elseif($_GET['ss'] == "G6"){
                    $data = "Grade-6";
                  }
                ?>
               <h4>&nbsp;<span class="fa fa-angle-double-right"></span><span class="fa fa-angle-right"></span> Class Record Facility :: ( <b style="color: yellow"><?= $data ?></b> ) | Section : ( <b style="color: yellow"><?= $_GET['sec'] ?></b> )</h4>
            </div>
            <br>
            <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline" method="POST">
                    <b>Search : </b> &nbsp; 
                    <input type="text" name="t_search" class="form-control" placeholder="Search here..">
                    <button type="submit" name="btn_search" class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                    
                </form>  
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                 <th>Description</th>
                                <!--<th><center>Academic Year</center></th> -->
                                <!-- <th><center>Section</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $val = $_POST['t_search'];
                                    $ss = $_GET['ss'];
                                    $search = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE (subjectCode LIKE '%$val%') AND offer_at = '$ss' ORDER BY subjectCode DESC");
                                     while( $rowx = mysqli_fetch_array($search)){
                                        ?>
                                        <tr onclick="window.location='Classes?subject=<?= $rowx['subjectCode'] ?>&sec=<?= $_GET['sec'] ?>&ss=<?= $ss ?>';" id="xhover">
                                            <td><?= $rowx['subjectCode']; ?></td>
                                            <td><?= $rowx['Description']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    $ss = $_GET['ss'];
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE offer_at = '$ss' ORDER BY subjectCode DESC");                                    
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr onclick="window.location='Classes?subject=<?= $rowx['subjectCode'] ?>&sec=<?= $_GET['sec'] ?>&ss=<?= $ss ?>';" id="xhover">
                                            <td><?= $rowx['subjectCode']; ?></td>
                                            <td><?= $rowx['Description']; ?></td>
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
