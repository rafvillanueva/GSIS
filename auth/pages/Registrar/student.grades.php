<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$id'");
    $row = mysqli_fetch_array($course);
    $cr = $row['Course'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id'");
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_section WHERE Section = '$id'");
    header("location: section");
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
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <title><?php echo $config['title'] ?></title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../../vendor/jquery/jquery.min.js"></script>    
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>    
</head>
<body>
    <div id="wrapper">
        <?php 
            include("assets/view/navbar_1-a.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                    <a href="student-grade-management" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-home"></span>
                        <small>&nbsp; Dashboard &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="student-grade-management" style="text-decoration: none;">
                        <small>&nbsp; Student Grade Management &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                      <small>&nbsp; Student Grade Management Details &nbsp;</small>
                </div>
                <hr>
                <div id="idsp"></div>
                <div class="row">
                    <div class="col-md-7">
                        <?php
                        if($row['Gender'] == "Male"){
                            ?>
                            <img src="assets/icons/user1.png" height="55">                        
                            <?php
                        }else{
                            ?>
                            <img src="assets/icons/user2.png" height="55">                        
                            <?php
                        }
                        ?>
                        <label style="font-size: 24px; position: relative; top: 5px; text-transform: uppercase;"><?= $row['lastName'] . ", " . $row['firstName'] . " " . $row['middleName'] ?></label>
                    </div>
                    <div class="col-md-5">
                        <form class="form-inline" onsubmit="return false" style="position: relative; top: 12px;">
                        <div class="form-group">
                            <select class="form-control" id="acad">
                                <?php
                                if(isset($_GET['year'])){
                                    ?>
                                    <option selected><?= $_GET['year'] ?></option>
                                     <option disabled value="">Academic Year</option>
                                    <?php
                                    $acad = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_subjectsenrolled WHERE Stud_id = '$id' ORDER BY ID DESC");
                                    while($row = mysqli_fetch_array($acad)){
                                        ?>
                                        <option><?= $row['Year'] ?></option>
                                        <?php
                                    }
                                }else{
                                ?>
                                <option disabled selected value="">Academic Year</option>                               
                                <?php
                                
                                $acad = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_subjectsenrolled WHERE Stud_id = '$id' ORDER BY ID DESC");
                                while($row = mysqli_fetch_array($acad)){
                                    ?>
                                    <option><?= $row['Year'] ?></option>
                                    <?php
                                }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="sem">
                                <?php
                                if(isset($_GET['sem'])){
                                    if($_GET['sem'] == 1){
                                        $semx = "1st Semester";
                                    }elseif($_GET['sem'] == 2){
                                        $semx = "2nd Semester";                                        
                                    }else{
                                        $semx = "101";
                                        $semval = "--";
                                    }
                                    if($cr == "SHS"){
                                        ?>
                                            <option value="101">--</option>
                                            <option disabled value="">Semester</option>
                                        <?php
                                    }else{
                                        ?>                                                                            
                                            <option selected value="<?= $_GET['sem'] ?>"><?= $semval ?></option>
                                            <option disabled value="">Semester</option>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                }else{

                                    if($cr == "SHS"){
                                        ?>
                                        <option value="101">--</option>
                                        option disabled value="">Semester</option>
                                        <?php
                                    }else{
                                        ?>
                                        <option disabled selected value="">Semester</option>
                                        <option value="1">1st Semester</option>
                                        <option value="2">2nd Semester</option>
                                        <?php
                                    }
                                
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" onclick="searchz()"><span class="fa fa-search"></span> Search</button>
                        </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="panel panel-default">                   
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><b>Subject Code</b></td>
                                    <td><b>PRELIM</b></td>
                                    <td><b>MIDTERM</b></td>
                                    <td><b>SEMI-FINAL</b></td>
                                    <td><b>FINAL</b></td>
                                    <td><b>&#8211;</b></td>
                                    <td><b><center><small>Subject Grade</small></center></b></td>
                                    <td><b><center><small>Numeric Equivalent</small></center></b></td>
                                </tr>
                                <tbody>
                                    <?php
                                    $acad = $_GET['year'];
                                    $sem = $_GET['sem'];
                                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE Stud_id = '$id' AND Year = '$acad' AND Semester = '$sem'");
                                    while($row = mysqli_fetch_array($rs)){
                                        $subject = $row['subjectCode'];
                                        $sub_id = $subject;
                                        $subject_rs = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$sub_id'");
                                        $subject_row = mysqli_fetch_array($subject_rs);
                                        include("assets/view/computation.php");
                                    ?>
                                    <tr>
                                    <td><?= $subject ?></td>
                                    <td><?= number_format($prelim, 2, ".", "") ?></td>
                                    <td><?= number_format($midterm, 2, ".", "") ?></td>
                                    <td><?= number_format($semiterm, 2, ".", "") ?></td>
                                    <td><?= number_format($finals, 2, ".", "") ?></td>
                                    <td><b>&#8211;</b></td>
                                    <td><center><?= number_format($final_grade, 2, ".", "") ?></center></td>
                                    <td><center><?= $numeric_grade ?></center></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_GET['sem'])){
                    ?>
                    <span style="letter-spacing: 1px; text-transform: uppercase;">
                        Total Subject Enrolled 
                        ( <b style="color: red;"><?= mysqli_num_rows($rs) ?></b> )
                    </span>                    
                    <?php
                    if(mysqli_num_rows($rs) != "0"){
                        ?>
                        <a href="print.php?id=<?= $_GET['id'] ?>&year=<?= $_GET['year'] ?>&sem=<?= $_GET['sem'] ?>" target="_blank" class="btn btn-default btn-xs"><span class="fa fa-print"></span> Print Report</a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function searchz(){
            var acad = document.getElementById("acad").value;
            var sem = document.getElementById("sem").value;
            if(acad !== "" || sem !== ""){
                window.location.href = "?id=" + <?= $id ?> + "&year=" + acad + "&sem=" + sem;                
            }
        }
    </script>
</body>
</html>