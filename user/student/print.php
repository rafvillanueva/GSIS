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
    <script type="text/javascript">
        window.print()
    </script>
</head>
<body>
<div class="container">
    <?php
    ob_start();
    session_start();
    $user = $_SESSION['user'];
    $rs_info = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$user'");
    $row_info = mysqli_fetch_array($rs_info);
     if($row_info['s_level'] == "0"){
        $data = "Nursery";
      }elseif($row_info['s_level'] == "1"){
        $data = "K-1";
      }elseif($row_info['s_level'] == "2"){
        $data = "K-2";
      }elseif($row_info['s_level'] == "G1"){
        $data = "Grade-1";
      }elseif($row_info['s_level'] == "G2"){
        $data = "Grade-2";
      }elseif($row_info['s_level'] == "G3"){
        $data = "Grade-3";
      }elseif($row_info['s_level'] == "G4"){
        $data = "Grade-4";
      }elseif($row_info['s_level'] == "G5"){
        $data = "Grade-5";
      }elseif($row_info['s_level'] == "G6"){
        $data = "Grade-6";
      }
    ?>
    <h1> <?= $row_info['s_lname'] . ", " . $row_info['s_fname'] ?></h1>
    <h4>Grade Level : <b><?= $data ?></b></h4>
    <hr>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered">
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
                        $query = mysqli_query($conn, "SELECT * FROM  tbl_subjects WHERE offer_at = '$offer'");
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
    <b><small> ______________________________________ <br> Parent(s) / Guardian(s) Signature.</small></b>
    <br>
    <i style="font-size: 11px;">Date Printed :: <?= date("F d, Y") ?></i>
</div>
</body>
</html>