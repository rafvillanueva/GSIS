<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');      #
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
        .btn-kent {
            border: none;
            background: url('assets/icons/download1.png') no-repeat top left;    
            padding: 2px 8px;
        }
        .btn-kent:hover {
            background-color: #63A1A7 !important;
            border-bottom: 5px solid #2D2A31 !important;
        }
    </style>
</head>
<body>
<?php include("controls/main-navbar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row1">
            <div style="background: url('assets/icons/download.png') no-repeat top left; border-radius: 1px; padding: 8px; background-color: #63A1A7; border-bottom: 5px solid #2D2A31; color: #fff; letter-spacing: 2px;">
               <h4>&nbsp;<span class="fa fa-angle-double-right"></span><span class="fa fa-angle-right"></span> Grade Record</h4>
            </div>
            <br>
            <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline" method="POST">
                    <b>Academic Year : </b> &nbsp; 
                    <select class="form-control" id="acad" onchange="acadz()">
                        <option disabled selected> -- SELECT --</option>
                        <?php
                        $dt = date("Y");
                        $dtt = date("Y") + 1;
                        for($i = 2018; $i <= $dt; $i++){    
                            echo "<option>";
                            echo $i ."-";
                            echo $i+1;
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <?php
                    if(isset($_GET['acad'])){
                        ?>
                        &nbsp;&nbsp; :: ( <b style="color: red;"><?= $_GET['acad'] ?></b> )
                        <?php
                    }else{
                        ?>
                        &nbsp;&nbsp; :: ( <b style="color: red;"><?= $dt . " - " . $dtt ?></b> )
                        <?php
                    }
                    ?>
                </form>  
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th><center>FIRST <br><small>GRADING</small></center></th>
                                <th><center>SECOND <br><small>GRADING</small></center></th>
                                <th><center>THIRD <br><small>GRADING</small></center></th>
                                <th><center>FOURTH <br><small>GRADING</small></center></th>
                                <th><center>SUBJECT <br><small>GRADE</small></center></th>
                                <th><center>Section</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $user = $_SESSION['user'];
                                if(isset($_GET['acad'])){
                                    $val = $_GET['acad'];
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$user' AND s_year = '$val'");
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?= $rowx['subjectCode']; ?></td>
                                            <?php 
                                                $code = $rowx['subjectCode'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);

                                                $subj =  $rowx['subjectCode'];

                                                $g1 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '1st Grading'");
                                                $r_g1 = mysqli_fetch_array($g1);
                                                $g2 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '2nd Grading'");
                                                $r_g2 = mysqli_fetch_array($g2);
                                                $g3 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '3rd Grading'");
                                                $r_g3 = mysqli_fetch_array($g3);
                                                $g4 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '4th Grading'");
                                                $r_g4 = mysqli_fetch_array($g4);

                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= number_format($r_g1['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g2['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g3['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g4['s_grade'], 2); ?></center></td>
                                            <?php
                                            $total = (number_format($r_g1['s_grade'], 2) + number_format($r_g2['s_grade'], 2) + number_format($r_g3['s_grade'], 2) + number_format($r_g4['s_grade'], 2)) / 4
                                            ?>
                                            <td><center><?= number_format($total, 2); ?></center></td>
                                            <td><center><?= $rowx['Section']; ?></center></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    $dt = date("Y");
                                    $dtt = date("Y") + 1;
                                    $datez = $dt . "-" . $dtt;
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_Id = '$user' AND s_year = '$datez'");
                                    while( $rowx = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td><?= $rowx['subjectCode']; ?></td>
                                            <?php 
                                                $code = $rowx['subjectCode'];
                                                $call_description = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$code'");
                                                $rowz = mysqli_fetch_array($call_description);

                                                $subj =  $rowx['subjectCode'];

                                                $g1 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '1st Grading'");
                                                $r_g1 = mysqli_fetch_array($g1);
                                                $g2 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '2nd Grading'");
                                                $r_g2 = mysqli_fetch_array($g2);
                                                $g3 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '3rd Grading'");
                                                $r_g3 = mysqli_fetch_array($g3);
                                                $g4 = mysqli_query($conn, "SELECT * FROM tbl_grade WHERE s_id = '$user' AND s_sub = '$subj' AND s_period = '4th Grading'");
                                                $r_g4 = mysqli_fetch_array($g4);

                                            ?>
                                            <td><?= $rowz['Description']; ?></td>
                                            <td><center><?= number_format($r_g1['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g2['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g3['s_grade'], 2); ?></center></td>
                                            <td><center><?= number_format($r_g4['s_grade'], 2); ?></center></td>
                                            <?php
                                            if(empty($r_g1['s_grade']) || empty($r_g2['s_grade']) || empty($r_g3['s_grade']) || empty($r_g4['s_grade'])){
                                                $total = "";
                                            }else{
                                                $total = (number_format($r_g1['s_grade'], 2) + number_format($r_g2['s_grade'], 2) + number_format($r_g3['s_grade'], 2) + number_format($r_g4['s_grade'], 2)) / 4;
                                            }
                                            ?>
                                            <td><center><?= number_format($total, 2); ?></center></td>
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
                    <br>
                </div>
            </div>
        </div>
        <?php
        if(isset($_GET['acad'])){
            ?>
            <a href="print.php?acad=<?=$_GET['acad']?>" class="btn btn-xs btn-default"><span class="fa fa-print"></span> Print</a>
            <?php
        }else{
            ?>
            <a href="print.php" class="btn btn-xs btn-default"><span class="fa fa-print"></span> Print</a>
            <?php
        }
        ?>
        </div> 
        <?php include("assets/modal/modal.php"); ?>
    </div>
</div>
<script type="text/javascript">
    function acadz(){
        var year = document.getElementById("acad").value;
        window.location.href = '?acad=' + year;
    }
</script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
