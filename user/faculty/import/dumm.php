
<!-- CREATE TABLE IF NOT EXISTS tbl_excel (  
  excel_id int(11) NOT NULL AUTO_INCREMENT,  
  excel_name varchar(250) NOT NULL,  
  excel_email varchar(300) NOT NULL,  
  PRIMARY KEY (excel_id)  
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  -->

<?php
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "dbz_vineyard");
$output = '';
date_default_timezone_set("Asia/Manila");
$date = date("F d, Y h:s:i A");
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= '
  <div class="table-responsive">
  <table class="table">
    <tr>
      <td>Student Name</td>
      <td>Subject Grade</td>
      <td>SMS | Status</td>
    </tr>
    <tbody>
  ';
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=14; $row<=$highestRow; $row++)
   {
    $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    if(!empty($name)){
      #Static
      $faculty_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, 7)->getValue());
      $subject_code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, 9)->getValue());
      $year = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 7)->getValue());
      $sem = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 8)->getValue());
      $period = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 9)->getValue());
      $section = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, 7)->getValue());
      #score names
      

      #dynamic
      $std_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());

      $q1 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
      $q1_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 12)->getValue());
      $q1_grade = ($q1 / $q1_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(3, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, 11)->getValue());
      }
      $q1_query = "
      INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$q1','$q1_over','$q1_grade','Sent','$date','$section')";

      $q2 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
      $q2_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, 12)->getValue());
      $q2_grade = ($q2 / $q2_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(4, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, 11)->getValue());
      }
      $q2_query = "
      INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$q2','$q2_over','$q2_grade','Sent','$date','$section')";
      $q3 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
      $q3_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, 12)->getValue());
      $q3_grade = ($q3 / $q3_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(5, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, 11)->getValue());
      }
      $q3_query = "
      INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$q3','$q3_over','$q3_grade','Sent','$date','$section')";
      $pf = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
      $pf_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, 12)->getValue());
      $pf_grade = ($pf / $pf_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(6, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, 11)->getValue());
      }
      $pf_query = "
      INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$pf','$pf_over','$pf_grade','Sent','$date','$section')";      
      $ex = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
      $ex_over = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, 12)->getValue());
      $ex_grade = ($q1 / $q1_over) * 50 + 50;
      if($worksheet->getCellByColumnAndRow(7, $row)->getValue()){
        $components = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, 11)->getValue());
      }
      $ex_query = "
      INSERT INTO tbl_scores(Fac_id, Stud_id, SubjectCode, Year, Semester, Grade_Components, Period, Score, Total_score, Grade, Status, Date_edit, Section) VALUES ('$faculty_id','$std_id','$subject_code','$year','$sem','$components','$period','$ex','$ex_over','$ex_grade','Sent','$date','$section')";

      /*mysqli_query($connect, $q1_query);
      mysqli_query($connect, $q2_query);
      mysqli_query($connect, $q3_query);
      mysqli_query($connect, $pf_query);
      mysqli_query($connect, $ex_query);*/

       $output .= '<tr>';
       $output .= '<td>' . $name .'</td>';
       $output .= '<td>' . $ex_grade .'</td>';
       $output .= '<td>Sent</td>';
       $output .= '</tr>';


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

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Import Excel to Mysql using PHPExcel in PHP</h3><br />
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>

      
    </tbody>
  </table>
</div>

  </div>
 </body>
</html>