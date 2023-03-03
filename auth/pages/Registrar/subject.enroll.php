<?php
include("../../site-config.php");
if(isset($_GET['student'])){
    $id = $_GET['student'];
    $student = "SELECT * FROM tbl_students WHERE s_id = '$id'";
    $student_query_enroll = mysqli_query($conn, $student);
    $student_row = mysqli_fetch_array($student_query_enroll);

    $course = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$id'");
    $exe_course = mysqli_fetch_array($course);

    if($exe_course['s_level'] == "0"){
      $data = "Nursery";
    }elseif($exe_course['s_level'] == "1"){
      $data = "K-1";
    }elseif($exe_course['s_level'] == "2"){
      $data = "K-2";
    }elseif($exe_course['s_level'] == "G1"){
      $data = "Grade-1";
    }elseif($exe_course['s_level'] == "G2"){
      $data = "Grade-2";
    }elseif($exe_course['s_level'] == "G3"){
      $data = "Grade-3";
    }elseif($exe_course['s_level'] == "G4"){
      $data = "Grade-4";
    }elseif($exe_course['s_level'] == "G5"){
      $data = "Grade-5";
    }elseif($exe_course['s_level'] == "G6"){
      $data = "Grade-6";
    }

    date_default_timezone_set("Asia/Manila");
    $date_now = date("m.d");
    $current_year = date('Y');
    $advance_year = date('Y') + 1;
    $date = $current_year . "-" . $advance_year;
    $current_month = date('m');


    
    if(isset($_GET['del'])){
        $id = $_GET['enroll'];
        $student_view = "DELETE FROM tbl_subjectsenrolled WHERE ID = '$id'";
        mysqli_query($conn, $student_view);
        header("location: ?student=".$_GET['student']);
    }
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
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/> -->
    <title>Guadalupe &#8211; Elementary School</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../alert/sweetalert2.css">

    <script src="../../alert/jquery2-x.js"></script>
    <script src="../../alert/sweetalert2.js"></script>
</head>
<body>
    <div id="wrapper">
        <?php 
            include("assets/view/navbar-std-b.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                    <a href="view-student?id=<?= $id ?>" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-home"></span>
                        <small>&nbsp; Dashboard &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="students" style="text-decoration: none;">
                        <small>&nbsp; Students &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="view-student?id=<?= $id ?>" style="text-decoration: none;">
                        <small>&nbsp; Student Details &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <small>&nbsp; Add Student Subject (<b style="letter-spacing: 2px;"> <?= '#'. $student_row['s_id'] .' :: '. $student_row['s_lname'] . ' , ' . $student_row['s_fname'] . ' ' . $student_row['s_mname'] ?> </b>)&nbsp;</small>

                </div>
                <hr>
                <div id="idsp"></div>
                <?php 
                if(isset($_GET['student'])){
                    $id = $_GET['student'];

                    
                    /*echo '<a href="view-student?id='.$_GET['student'].'" class="btn btn-default" style="margin-right: 5px; margin-bottom: 10px;"><i class="fa fa-arrow-left"></i> Back</a>';*/
                    /*echo '
                    <h3 style="margin-top: 0px;">
                     <b><span class="fa fa-user"></span></b> Student : <strong> #'. $student_row['Stud_id'] .' - </strong> '. $student_row['lastName'] . ' , ' . $student_row['firstName'] . ' ' . $student_row['middleName']. '.
                    </h3>
                    ';*/

                }else{
                    //echo '<script type="text/javascript">window.location.href = "students"</script>';
                }
                if(isset($_GET['enroll'])){
                    date_default_timezone_set('Asia/Manila'); 
                    $stud_id = $_GET['student'];
                    $sec = $_GET['section'];
                    $lvl = $_GET['level'];

                    $course = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$stud_id'");
                    $exe_course = mysqli_fetch_array($course);

                    date_default_timezone_set("Asia/Manila");
                    
                    $dt = date("Y");
                    $dtt = date("Y") + 1;

                    $datez = $dt . "-" . $dtt;

                    $enroll = "INSERT INTO tbl_subjectsEnrolled(Stud_Id,s_level,Section,s_year) VALUES('$stud_id','$lvl','$sec','$datez')";
                    ECHO $enroll;
                    $enroll_query = mysqli_query($conn, $enroll);

                    echo '<input type="hidden" value="'.$sec.'" id="subx">';
                    echo '<input type="hidden" value="'.$lvl.'" id="desx">';
                      ?>
                        <script type="text/javascript">
                            var subq = document.getElementById("subx").value;
                            var desq = document.getElementById("desx").value;
                            swal(
                              'Success!',
                              'Enrolled to ' + subq,
                              'success').then(function () {  
                              window.location.href = "enroll-student-subject?student=" + <?= $_GET['student'] ?>;                           
                            })
                        </script>
                      <?php
                }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" autocomplete="off" method="POST" action="?student=<?php echo $id?>">
                            <div class="form-group">
                                <img src="assets/icons/Open_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Sections ( <b style="color: orange"><?= $data ?></b> )</b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px; padding-right: 2px;">
                            <div class="form-group">
                              <!--   <input type="text" class="form-control" placeholder="Search here.." name="val-search"> -->
                            </div>
                            <div class="form-group">
                               <!-- <button type="submit" name="btn-search" class="btn btn-primary ">SEARCH <i class="fa fa-search"></i></button> -->
                               <!-- <a  href="#" data-toggle="modal" data-target="#subject_enrolled" class="btn btn-warning btn-md " style="font-size: 13px; letter-spacing: 1px;"><i class="fa fa-info-circle"></i> Subject Enrolled</a> -->
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th width="150">Section</th>
                                        <th>Building</th>
                                        <th width="180"><center>Total Student</center></th>
                                        <th width="100"><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_POST['btn-search'])){

                                    }else{
                                        $level = $exe_course['s_level'];
                                        $rs = mysqli_query($conn, "SELECT * FROM tbl_section WHERE offer_at = '$level'");
                                    }

                                    while($row = mysqli_fetch_array($rs)){
                                        ?>
                                        <tr>
                                            <td><?= $row['section'] ?></td>
                                            <td><?= $row['building'] ?></td>

                                            <?php
                                            $sec = $row['section'];
                                            $lvl = $exe_course['s_level'];
                                            $id = $_GET['student'];

                                            $max =  mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE s_level = '$lvl' AND section = '$sec'");

                                            if(mysqli_num_rows($max) == $row['max_stud']){
                                                ?>
                                                <td><center>( <b style="color: red"><?= mysqli_num_rows($max) ?> / <?= $row['max_stud'] ?></b> )</center></td>
                                                <?php
                                                    $enroll =  mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE s_level = '$lvl' AND section = '$sec' AND stud_id = '$id'");
                                                    if(mysqli_num_rows($enroll) == 1){
                                                        ?>
                                                        <td><center><b style="color: red">Enrolled</b></center></td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <td><center><b style="color: red">FULL</b></center></td>
                                                        <?php
                                                    }
                                                ?>
                                                <?php
                                            }else{
                                                ?>
                                                <td><center>( <?= mysqli_num_rows($max) ?> / <?= $row['max_stud'] ?> )</center></td>
                                                 <?php
                                                $enroll =  mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE s_level = '$lvl' AND section = '$sec' AND stud_id = '$id'");
                                                if(mysqli_num_rows($enroll) == 1){
                                                    ?>
                                                    <td><center><b style="color: red">Enrolled</b></center></td>
                                                    <?php
                                                }else{
                                                    $enroll_level =  mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE s_level = '$lvl' AND stud_id = '$id'");
                                                    if(mysqli_num_rows($enroll_level) == 1){
                                                    ?>
                                                     <td><center><b style="color: #333">-</b></center></td>
                                                    <?php
                                                    }else{                                                    
                                                    ?>
                                                    <td><center><a href="?section=<?= $row['section'] ?>&level=<?= $exe_course['s_level'] ?>&enroll&student=<?= $_GET['student'] ?>" class="btn btn-sm btn-success btn-block" name="btn-sub-enroll"><i class="fa fa-plus"></i> Enroll</a></center></td>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <?php

                                            }
                                            ?>                                            
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </form>
                
                <div class="pagination-container">
                    <nav>
                        <ul class="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include("assets/modal/modal.php"); ?>
    <script src="../../vendor/jquery/jquery.min.js"></script>    
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
            function goBack() {
                window.history.back();
            }
    </script>
</body>

</html>
