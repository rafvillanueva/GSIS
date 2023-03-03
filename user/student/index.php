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
                <?php
                if(isset($_GET['level'])){
                    ?>
                    <a href="print.php?level=<?=$_GET['level']?>" target="_blank" class="btn pull-right btn-default"><span class="fa fa-print"></span> Print</a>
                    <?php
                }else{
                    ?>
                    <a href="print.php" class="btn pull-right btn-default" target="_blank"><span class="fa fa-print"></span> Print</a>
                    <?php
                }
                ?>
                <form class="form-inline" method="POST">
                    <b>Grade Level : </b> &nbsp; 
                    <select class="form-control" id="acad" onchange="acadz()">
                        <?php
                        if(isset($_GET['level'])){
                              if($_GET['level'] == "0"){
                                $data = "Nursery";
                              }elseif($_GET['level'] == "1"){
                                $data = "K-1";
                              }elseif($_GET['level'] == "2"){
                                $data = "K-2";
                              }elseif($_GET['level'] == "G1"){
                                $data = "Grade-1";
                              }elseif($_GET['level'] == "G2"){
                                $data = "Grade-2";
                              }elseif($_GET['level'] == "G3"){
                                $data = "Grade-3";
                              }elseif($_GET['level'] == "G4"){
                                $data = "Grade-4";
                              }elseif($_GET['level'] == "G5"){
                                $data = "Grade-5";
                              }elseif($_GET['level'] == "G6"){
                                $data = "Grade-6";
                              }
                            ?>
                            <option selected><?= $data ?></option>
                            <option disabled> -- SELECT --</option>
                            <?php
                        }else{
                            ?>
                            <option disabled selected> -- SELECT --</option>
                            <?php
                        }
                        ?>
                        <?php
                        if($row_info['s_level'] == "0"){
                            ?>
                            <option value="0">Nursery</option>
                            <?php
                        }elseif($row_info['s_level'] == "1"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <?php
                        }elseif($row_info['s_level'] == "2"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <?php
                        }elseif($row_info['s_level'] == "G1"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <?php
                        }elseif($row_info['s_level'] == "G2"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <option value="G2">Grade-2</option>
                            <?php
                        }elseif($row_info['s_level'] == "G3"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <option value="G2">Grade-2</option>
                            <option value="G3">Grade-3</option>
                            <?php
                        }elseif($row_info['s_level'] == "G4"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <option value="G2">Grade-2</option>
                            <option value="G3">Grade-3</option>
                            <option value="G4">Grade-4</option>
                            <?php
                        }elseif($row_info['s_level'] == "G5"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <option value="G2">Grade-2</option>
                            <option value="G3">Grade-3</option>
                            <option value="G4">Grade-4</option>
                            <option value="G5">Grade-5</option>
                            <?php
                        }elseif($row_info['s_level'] == "G5"){
                            ?>
                            <option value="0">Nursery</option>
                            <option value="1">K-1</option>
                            <option value="2">K-2</option>
                            <option value="G1">Grade-1</option>
                            <option value="G2">Grade-2</option>
                            <option value="G3">Grade-3</option>
                            <option value="G4">Grade-4</option>
                            <option value="G5">Grade-5</option>
                            <option value="G6">Grade-6</option>
                            <?php
                        }
                        ?>
                    </select>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $user = $_SESSION['user'];
                                if(isset($_GET['level'])){
                                    $val = $_GET['level'];
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE offer_at = '$val'");
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
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    $dt = date("Y");
                                    $dtt = date("Y") + 1;
                                    $datez = $dt . "-" . $dtt;
                                    $offer = $row_info['s_level'];
                                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE offer_at = '$offer'");
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
                                            <td><?= $rowx['Description']; ?></td>
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
        <!-- <?php
        if(isset($_GET['acad'])){
            ?>
            <a href="print.php?acad=<?=$_GET['acad']?>" class="btn btn-xs btn-default"><span class="fa fa-print"></span> Print</a>
            <?php
        }else{
            ?>
            <a href="print.php" class="btn btn-xs btn-default"><span class="fa fa-print"></span> Print</a>
            <?php
        }
        ?> -->
        </div> 
        <?php include("assets/modal/modal.php"); ?>
    </div>
</div>
<script type="text/javascript">
    function acadz(){
        var year = document.getElementById("acad").value;
        window.location.href = '?level=' + year;
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
