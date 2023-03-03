<?php 
require("../../config/db.php");

$config['title'] = "Administrator &#8211; Vineyard College";


// Student
$students = "SELECT * FROM tbl_studentrecord ORDER BY ID DESC Limit 0,50";
$student_query = mysqli_query($conn, $students);

// Faculty
$faculty_list = "SELECT * FROM tbl_facultyinfo ORDER BY ID DESC Limit 0,50";
$facultyl_query = mysqli_query($conn, $faculty_list);

// Acount
$account = "SELECT * FROM tbl_accounts ORDER BY ID DESC Limit 0,50";
$account_query = mysqli_query($conn, $account);

// Course
$course = "SELECT * FROM tbl_coursesoffered ORDER BY ID DESC Limit 0,50";
$course_query = mysqli_query($conn, $course);

// Subjects
$subjects = "SELECT * FROM tbl_subjects ORDER BY ID DESC Limit 0,50";
$subjects_query = mysqli_query($conn, $subjects);

// Section
$section = "SELECT * FROM tbl_section ORDER BY ID DESC Limit 0,50";
$section_query = mysqli_query($conn, $section);

// Faculty Generate ID
$faculty = "SELECT Fac_id as e FROM tbl_facultyinfo ORDER BY Fac_id DESC";
$faculty_query = mysqli_query($conn, $faculty);
$faculty_row = mysqli_fetch_array($faculty_query);
if($faculty_row['e'] == ""){
    $fac_id = "10001";
}else{
	$str = substr($faculty_row['e'], 1);
	$fac_id = $str + 1;
}
?>