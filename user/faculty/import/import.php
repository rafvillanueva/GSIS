<?php
######################################
# ------- Global Information ------- #
######################################
include('../../../config/db.php');       #
#include('../controls/global_info.php'); #
######################################
#include("../../site-config.php");
ob_start();
session_start();
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

$rs_info = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_id = '$user'");
$row_info = mysqli_fetch_array($rs_info);

?>
<?php
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "dbz_vineyard");
$output = '';
date_default_timezone_set("Asia/Manila");
$date = date("F d, Y h:s:i A");


if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"]));
 $allowed_extension = array("xls", "xlsx", "csv");
 if(in_array($extension, $allowed_extension)) 
 {
  $file = $_FILES["excel"]["tmp_name"];
  include("Classes/PHPExcel/IOFactory.php");
  $objPHPExcel = PHPExcel_IOFactory::load($file); 
  $num = 1;
  /*
  <td><center>Quiz 2</center></td>
      <td><center>Quiz 3</center></td>
      <td><center>Performance <sup>Task</sup></center></td>
      <td><center>Exam</center></td>*/
  $output .= '
  <div class="table-responsive">
  <table class="table">
    <tr style="font-weight: bold;">
      <td>#</td>
      <td>Student Name</td>
      <td><center>Absences</center></td>
      <td><center>Grade Components</center></td>
      
      <td><center>Subject</center></td>
      <td><center>SMS | Status</center></td>
    </tr>
    <tbody>
  ';
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=8; $row<=$highestRow; $row++)
   {
    $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    if(!empty($name)){
      #Static
      $faculty_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, 2)->getValue());
      $subject_code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, 4)->getValue());
      $year = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 2)->getValue());
      $sem = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 3)->getValue());
      $period = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 4)->getValue());
      $section = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, 5)->getValue());
      #score names
      


      #dynamic
      $std_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());


      ###############################################################################################################
      # Absences #
      if($worksheet->getCellByColumnAndRow(3, $row)->getValue() || $worksheet->getCellByColumnAndRow(3, $row)->getValue() == 0){
        $components = "Unexcused absences incurred";
      }
      $absent = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
      $vr1 = mysqli_query($conn, "SELECT * FROM tbl_scores WHERE Stud_id = '$std_id' AND Grade_Components = '$components' AND Year = '$year' AND Semester = '$sem' AND Period = '$period' AND Fac_id = '$faculty_id'");
      if(mysqli_num_rows($vr1) == 0){
        $abent_sql = "
        INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$absent','0','0','Sent','$date','$section')";
        mysqli_query($connect, $abent_sql);
        $exist_abent = $absent;
        $exist_abent = '<b style="color: red">Save</b>';
      }else{
        $exist_abent = '<b style="color: red">EXIST</b>';
      }
      ###############################################################################################################

      ###############################################################################################################
      # QUIZ 1 #
      $q1 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
      $q1_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, 8)->getValue());
      $q1_grade = ($q1 / $q1_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(4, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, 7)->getValue());
      }
      $vr1 = mysqli_query($conn, "SELECT * FROM tbl_scores WHERE Stud_id = '$std_id' AND Grade_Components = '$components' AND Year = '$year' AND Semester = '$sem' AND Period = '$period' AND Fac_id = '$faculty_id'");
      if(mysqli_num_rows($vr1) == 0){
        $q1_query = "
        INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$q1','$q1_over','$q1_grade','Sent','$date','$section')";
        mysqli_query($connect, $q1_query);
        $exist_q1 = number_format($q1_grade,2,".",",");
        $exist_q1 = '<b style="color: red">Save</b>';
      }else{
        $exist_q1 = '<b style="color: red">EXIST</b>';
      }
      
    $output .= '<tr>';
    $output .= '<td>' . $num++ .'</td>';
    $output .= '<td>' . $std_id .'</td>'; //$name
    $output .= '<td><center>' . $worksheet->getCellByColumnAndRow(3, $row)->getValue() . " - " . $components  .'</center></td>';
    $output .= '<td><center>' . $std_id .'</center></td>';
    /*$output .= '<td><center>' . $exist_q2 .'</center></td>';
    $output .= '<td><center>' . $exist_q3 .'</center></td>';
    $output .= '<td><center>' . $exist_pf .'</center></td>';
    $output .= '<td><center>' . $exist_ex .'</center></td>';*/
    $output .= '<td><center>' . $subject_code .'</center></td>';
    $output .= '<td><center>Sent</center></td>';
    $output .= '</tr>';
        
    header("location: ../Classes?subject=" . $_GET['id']);
    }

   }
  } 
 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
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
    <title>Vineyard College</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body>
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
    #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
    
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            <img src="../../img/vineyard.png">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <img src="../controls/icons/User_96px.png" height="32" style="position: relative;">
                    <?= $row_info['lastName'] . ", " . $row_info['firstName'] ?><br><hr>
                    <!-- <a href="current-classes">
                        <img src="../controls/icons/Classroom_96px.png" height="32" style="position: relative;">
                        <b> Current Classes</b>
                    </a>
                    <a href="all-classes">
                        <img src="../controls/icons/Books_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a>
                    <a href="term-and-semestral">
                        <img src="../controls/icons/Scorecard_96px.png" height="32" style="position: relative;">
                        <b> Term & Sem. Grade</b>
                    </a>
                    <a href="import/main" style="background-color: #eee;">
                        <img src="../controls/icons/Microsoft Excel_96px.png" height="32" style="position: relative;">
                        <b> Import Scores (Excel)</b>
                    </a> -->
                    <a href="../Classes?subject=<?= $_GET['id'] ?>">
                        <img src="../controls/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="../controls/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b> Logout</b>
                    </a>
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
            <a href="../current-classes" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small> 
            </a>
            <a href="../current-classes" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Class Record Facility &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="../import" style="text-decoration: none;">
                <small>&nbsp; Import Scores ( <b>Excel</b> ) &nbsp;</small>
            </a>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading" >
                <form class="form-inline" method="post" enctype="multipart/form-data">
                     <img src="../controls/icons/Microsoft Excel_96px.png" height="32" style="position: relative;">
                    <b style="margin-right: 5px;">IMPORT SCORES ( <b>Excel Format </b>)</b>
                    </a>
                </form>
            </div>
            <div class="panel-body">
                    <?php
                       echo $output . "-sss";
                    ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
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
