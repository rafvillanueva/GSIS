<?php
if(isset($_GET['import'])){
require('Classes/PHPExcel.php');

$id = $_GET['id'];
$subj = $_GET['subj'];

######################################
# ------- Global Information ------- #
######################################
include('../../../config/db.php');       #
include('../controls/global_info.php'); #
######################################

$subjectx = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE ID = '$subj'");
$subj_row = mysqli_fetch_array($subjectx);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);  
$sheet = $objPHPExcel->getActiveSheet();

$rowCount = 9; 
$column = 'A';

$objPHPExcel->getActiveSheet()->setCellValue("A"."2", "Faculty ID Number");
$objPHPExcel->getActiveSheet()->setCellValue("A"."3", "Faculty Name");
$objPHPExcel->getActiveSheet()->setCellValue("A"."4", "Subject Code");
$objPHPExcel->getActiveSheet()->setCellValue("A"."5", "Section");

/*----------------------------------------------------------------------------------*/
$objPHPExcel->getActiveSheet()->setCellValue("B"."2", strtoupper($_GET['id']));
$objPHPExcel->getActiveSheet()->setCellValue("B"."3", strtoupper($g_row['lastName'] . ", " . $g_row['firstName'] . " " . $g_row['middleName']));
$objPHPExcel->getActiveSheet()->setCellValue("B"."4", $_GET['subj']);
$objPHPExcel->getActiveSheet()->setCellValue("B"."5", $_GET['sec']);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
/*----------------------------------------------------------------------------------*/

$objPHPExcel->getActiveSheet()->setCellValue("C"."2", "School Year");
$objPHPExcel->getActiveSheet()->setCellValue("C"."3", "Semester");
$objPHPExcel->getActiveSheet()->setCellValue("C"."4", "Period");

/*----------------------------------------------------------------------------------*/
$objPHPExcel->getActiveSheet()->setCellValue("D"."2", $_GET['year']);
$objPHPExcel->getActiveSheet()->setCellValue("D"."3", $_GET['sem']);
$objPHPExcel->getActiveSheet()->setCellValue("D"."4", $_GET['period']);
$objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
/*----------------------------------------------------------------------------------*/

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);

$sheet->getStyle('B2')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('B3')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('B4')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('B5')->getFont()->setBold(true)->setSize(10);

$sheet->getStyle('D2')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('D3')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('D4')->getFont()->setBold(true)->setSize(10);

$sheet->getStyle('A7:I7')->getFont()->setBold(true)->setSize(11);

$objPHPExcel->getActiveSheet()->setCellValue("A"."7", "Student ID Number");
$objPHPExcel->getActiveSheet()->setCellValue("B"."7", "Student Name");
$objPHPExcel->getActiveSheet()->setCellValue("C"."7", "Course");
$objPHPExcel->getActiveSheet()->setCellValue("D"."7", "Absences");
$objPHPExcel->getActiveSheet()->setCellValue("E"."7", $_GET['comp']);

$s = $_GET['subj'];
$ss = $_GET['sec'];
$sem = $_GET['sem'];
$acad = $_GET['year'];

$q = "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$s' AND Section = '$ss' AND Semester = '$sem' AND Year = '$acad'";
$query = mysqli_query($conn,$q);
  while( $rowx = mysqli_fetch_array($query)){

  $id = $rowx['Stud_Id'];
  $call_student = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$id'");
  $rowz = mysqli_fetch_array($call_student);
  $name = $rowz['lastName'] . ', ' . $rowz['firstName'] . ' ' . $rowz['middleName'];

  $objPHPExcel->getActiveSheet()->setCellValue("A".$rowCount, $id);
  $objPHPExcel->getActiveSheet()->setCellValue("B".$rowCount, $name);
  $objPHPExcel->getActiveSheet()->setCellValue("C".$rowCount, $rowz['Course']);
  $objPHPExcel->getActiveSheet()->getStyle("A".$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $rowCount++;
  /*for($j=1; $j<2;$j++)  
  {
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $rowx[$j]);
    $column++;
  } */

}
  $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFB74D');
  $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="vineyard.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');
}
?>