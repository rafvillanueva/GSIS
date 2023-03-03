<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
######################################
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
        
    </style>
</head>
<body>
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
            <a href="term-and-semestral" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="term-and-semestral" style="text-decoration: none;">
                <small>&nbsp; Term and Semester :: <b>( <?= $_GET['view'] ?> Subjects )</b> &nbsp;</small>
            </a>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
              <form class="form-inline" method="POST" action="?panel" autocomplete="off">
                    <div class="form-group">
                         <input class="form-control"  style="padding-right: 0px;" name="t_search" placeholder="Search here..">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" name="btn_search" style="margin-left: 0px;  background-color: #ED1F24;"> Search &nbsp; <span class="fa fa-search"></span></button>
                    </div>
                </form>  
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                     <table id="mytable" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th><center>School Year</center></th>
                                <th><center>Section</center></th>
                                <!-- <th><center>Total Students</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['btn_search'])){
                                    $val = $_POST['t_search'];
                                    $search = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND (SubjectLoad LIKE '%$val%' OR Section LIKE '%$val%' OR Year LIKE '%$val%') ORDER BY Year DESC");
                                     while( $rowx = mysqli_fetch_array($search)){
                                        ?>
                                        <tr  onclick="window.location='term-grades?subject=<?= $rowx['ID'] ?>';" id="xhover">
                                            <td><?= $rowx['SubjectLoad']; ?></td>
                                            <?php 
                                                $code = $rowx['SubjectLoad'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);
                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= $rowx['Year']; ?></center></td>
                                            <td><center><?= $rowx['Section']; ?></center></td>
                                            <?php 
                                                $year = $rowx['Year'];
                                                $sem = $rowz['Sem'];
                                                $section = $rowx['Section'];
                                                $count = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$code' AND Year = '$year' AND Semester = '$sem' AND Section = '$section'"); 
                                            ?>
                                            <td><center>( <b style="color: red;"> <?= mysqli_num_rows($count) ?></b> )</center></td>
                                        </tr>
                                        <?php
                                    }
                                }else{

                                        if(isset($_GET['view'])){
                                            $view = $_GET['view'];

                                            if($view == "SHS"){
                                                 $query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND SubjectLoad LIKE '%(SHS)%' ORDER BY Year DESC");
                                                 
                                                while( $rowx = mysqli_fetch_array($query)){
                                                    ?>
                                                    <tr onclick="window.location='term-grades?subject=<?= $rowx['ID'] ?>';" id="xhover">
                                                        <td><?= $rowx['SubjectLoad']; ?></td>
                                                        <?php 
                                                            $code = $rowx['SubjectLoad'];
                                                            $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                            $rowz = mysqli_fetch_array($call_description);
                                                        ?>
                                                        <td><?= $rowz['Description']; ?></td>
                                                        <td><?= $rowx['Year']; ?></td>
                                                        <td><?= $rowx['Section']; ?></td>
                                                        <!-- <?php 
                                                            $year = $rowx['Year'];
                                                            $sem = $rowz['Sem'];
                                                            $section = $rowx['Section'];
                                                            $count = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$code' AND Year = '$year' AND Semester = '$sem' AND Section = '$section'"); 
                                                        ?>
                                                        <td><center>( <b style="color: red;"> <?= mysqli_num_rows($count) ?></b> )</center></td> -->
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                 $query = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND SubjectLoad NOT LIKE '%(SHS)%' ORDER BY Year DESC");
                                                while( $rowx = mysqli_fetch_array($query)){
                                                    ?>
                                                    <tr onclick="window.location='term-grades?subject=<?= $rowx['ID'] ?>';" id="xhover">
                                                        <td><?= $rowx['SubjectLoad']; ?></td>
                                                        <?php 
                                                            $code = $rowx['SubjectLoad'];
                                                            $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                            $rowz = mysqli_fetch_array($call_description);
                                                        ?>
                                                        <td><?= $rowz['Description']; ?></td>
                                                        <td><center><?= $rowx['Year']; ?></center></td>
                                                        <td><center><?= $rowx['Section']; ?></center></td>
                                                        <!-- <?php 
                                                            $year = $rowx['Year'];
                                                            $sem = $rowz['Sem'];
                                                            $section = $rowx['Section'];
                                                            $count = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$code' AND Year = '$year' AND Semester = '$sem' AND Section = '$section'"); 
                                                        ?>
                                                        <td><center>( <b style="color: red;"> <?= mysqli_num_rows($count) ?></b> )</center></td> -->

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }else{
                                            header("location: term.php");
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
        <?php
        if(isset($_POST['btn_search'])){
            $val = $_POST['t_search'];
            $search = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$id' AND (SubjectLoad LIKE '%$val%' OR Section LIKE '%$val%' OR Year LIKE '%$val%') ORDER BY Year DESC");
            ?>
            Total Subject Loaded ( <b style="color: red;"><?= mysqli_num_rows($search) ?></b> )
            <?php
        }else{
            ?>
            Total Subject Loaded ( <b style="color: red;"><?= mysqli_num_rows($query) ?> </b> )
            <?php
        }
        ?>
        
        <hr>
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
