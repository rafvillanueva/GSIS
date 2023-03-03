<?php 
$perrow = 50;
if(isset($_REQUEST['page'])){
    $page = $_REQUEST['page'];
     $p =  10 + $page * $perrow; 
}else{
    $page = 0;
    $p = 50;
}
$p = $page * $perrow;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <title>Registrar &#8211; Guadalupe Elementary School</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
         #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
    </style>
</head> 
<body>
    <div id="wrapper">
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
    $link = '';
}elseif($row_admn['Level'] == "Administrator"){
    $link = '';
}elseif($row_admn['Level'] == "Finance"){
    $link = '';
}else{
   ?><script type="text/javascript">window.location.href = '../../login/'</script><?php
}


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
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
           <img src="../../fav.png" height="85">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="">
                       <b><?= $row_admn['Level'] ?> - cPANEL</b><hr>
                    </div>
                    <?php
                    if(isset($_GET['setup'])){
                    ?>
                    <a href="setup_settings.php">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <?php
                    }else{
                    ?>
                    <a href="logs.php">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <?php
                    }
                    ?>
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
        <div id="page-wrapper">
            <div class="container-fluid">
               <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-home"></span>
                        <small>&nbsp; Dashboard &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="section" style="text-decoration: none;">
                        <small>&nbsp; Section &nbsp;</small>
                    </a>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" autocomplete="off" action="section">
                            <div class="form-group">
                                <img src="assets/icons/Open_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Students under <b style="color: orange;"><?= $_GET['acad'] ?></b> :: SECTION <b style="color: orange;"><?= $_GET['sec'] ?></b></b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px;">
                            <div class="form-group">
                                
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student name</th>
                                    <th>Student Address</th>
                                    <th>Monther Contact Number</th>
                                    <th>Father Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['btn-search'])){
                                        $val = $_POST['val-search'];
                                        if(empty($val)){
                                            ?>
                                            <script type="text/javascript">window.location.href = "section"</script>
                                            <?php
                                        }
                                        $students = "SELECT * FROM tbl_section WHERE Section like '%$val%' OR Building like '%$val%' ORDER BY ID ASC LIMIT 0,$perrow";
                                        $student_query = mysqli_query($conn, $students);
                                        while($row = mysqli_fetch_array($student_query)){
                                            ?>
                                            <tr onclick="window.location='edit-sections?id=<?= $row[2] ?>';" id="xhover">
                                                 <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/User1.png" height="32">        
                                                    <?= $row['building'] ?>
                                                </td>
                                                <td><?= $row['section'] ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }else{
                                        $sec = $_GET['sec'];
                                        $acad = $_GET['acad'];

                                        $rs = mysqli_query($conn, "SELECT DISTINCT(Stud_id) FROM tbl_subjectsenrolled WHERE section = '$sec' AND s_year = '$acad'");
                                        while($row = mysqli_fetch_array($rs)){
                                            $s_id = $row['Stud_id'];
                                            $std = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$s_id'");
                                            $stdrow = mysqli_fetch_array($std);
                                            $stdname = $stdrow['s_lname'] . ", " . $stdrow['s_fname'] . " " . $stdrow['s_mname']; 
                                            ?>
                                            <tr onclick="window.location='logs_info.php?sec=<?= $row['section'] ?>&acad=<?= $_GET['q'] ?>';" id="xhover">
                                                <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/User1.png" height="32">        
                                                    <?= $stdname ?>
                                                </td>
                                                <td><?= $stdrow['s_address'] ?></td>
                                                <td><?= $stdrow['m_contact'] ?></td>
                                                <td><?= $stdrow['f_contact'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php
                if(isset($_POST['btn-search'])){
                    $val = $_POST['val-search'];
                    if(empty($val)){
                        ?>
                        <script type="text/javascript">window.location.href = "section"</script>
                        <?php
                    }
                    $total = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode like '%$val%' OR Description like '%$val%' ORDER BY ID DESC LIMIT $p,$perrow");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                    }
                }else{
                    $total = mysqli_query($conn, "SELECT * FROM tbl_section");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                        
                    }
                }
                ?>                
                <br><br><br>
        </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
</body>
</html>