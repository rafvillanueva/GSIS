<?php
 
require('Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);  
$sheet = $objPHPExcel->getActiveSheet();

$rowCount = 7; 
$column = 'A';

$objPHPExcel->getActiveSheet()->setCellValue("A"."2", "Faculty ID Number");
$objPHPExcel->getActiveSheet()->setCellValue("A"."3", "Faculty Name");
$objPHPExcel->getActiveSheet()->setCellValue("A"."4", "Subject Code");
$objPHPExcel->getActiveSheet()->setCellValue("A"."5", "Section");

/*----------------------------------------------------------------------------------*/
$objPHPExcel->getActiveSheet()->setCellValue("B"."2", "--");
$objPHPExcel->getActiveSheet()->setCellValue("B"."3", "--");
$objPHPExcel->getActiveSheet()->setCellValue("B"."4", "--");
$objPHPExcel->getActiveSheet()->setCellValue("B"."5", "--");
/*----------------------------------------------------------------------------------*/

$objPHPExcel->getActiveSheet()->setCellValue("C"."2", "School Year");
$objPHPExcel->getActiveSheet()->setCellValue("C"."3", "Semester");
$objPHPExcel->getActiveSheet()->setCellValue("C"."4", "Period");

/*----------------------------------------------------------------------------------*/
$objPHPExcel->getActiveSheet()->setCellValue("D"."2", "--");
$objPHPExcel->getActiveSheet()->setCellValue("D"."3", "--");
$objPHPExcel->getActiveSheet()->setCellValue("D"."4", "--");
/*----------------------------------------------------------------------------------*/

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);

$sheet->getStyle('A2:I2')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('A3:I3')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('A4:I4')->getFont()->setBold(true)->setSize(10);
$sheet->getStyle('A5:I5')->getFont()->setBold(true)->setSize(10);

for($j=1; $j<10;$j++)  
{
  $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, "www");
  $column++;
}

// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="vineyard.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');