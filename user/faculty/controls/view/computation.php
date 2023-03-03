<?php 
#error_reporting(0);

$f_str = $sub_id;
$f_val   = 'SHS';
$f_rs = strpos($f_str, $f_val);

if($f_rs === false){
      $periodz_1 = "Prelim";
      $periodz_2 = "Midterm";
      $periodz_3 = "Semi-Finals";
      $periodz_4 = "Finals";
}else{
      $periodz_1 = "1st Grading";
      $periodz_2 = "2nd Grading";
      $periodz_3 = "3rd Grading";
      $periodz_4 = "4th Grading";
}

/* Prelim | 1st Grading  */
$pqs1 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Quiz 1' AND Year = '$acad'");
$pqs2 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Quiz 2' AND Year = '$acad'");
$pqs3 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Quiz 3' AND Year = '$acad'");
$pqs4 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Performance Task' AND Year = '$acad'");
$pqs5 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_1' AND Grade_Components = 'Exam' AND Year = '$acad'");

$pqs1row = mysqli_fetch_array($pqs1);
$pqs2row = mysqli_fetch_array($pqs2);
$pqs3row = mysqli_fetch_array($pqs3);
$pqs4row = mysqli_fetch_array($pqs4);
$pqs5row = mysqli_fetch_array($pqs5);

$pq1 = $pqs1row['e'];
$pq2 = $pqs2row['e'];
$pq3 = $pqs3row['e'];

$pq1d = $pqs1row['d'];
$pd2d = $pqs2row['d'];
$pd3d = $pqs3row['d'];

$pq4 = $pqs4row['e'];
$pq5 = $pqs5row['e'];

$pq4d = $pqs4row['d'];
$pq5d = $pqs5row['d'];

$pquiz0 = $pq1 + $pq2 + $pq3;
$pquiz1 = $pq1d + $pd2d + $pd3d;
$pquiz2 = ($pquiz0 / $pquiz1) * 50 + 50;
$pquiz = $pquiz2 * .2;

$ptask0 = ($pq4 / $pq4d) * 50 + 50;
$ptask = $ptask0 * .4;

$pexam0 = ($pq5 / $pq5d) * 50 + 50;
$pexam = $pexam0 * .4;

$prelim = $pquiz + $ptask + $pexam;

/* Midterm | 2nd Grading  */
$mid1 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Quiz 1' AND Year = '$acad'");
$mid2 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Quiz 2' AND Year = '$acad'");
$mid3 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Quiz 3' AND Year = '$acad'");
$mid4 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Performance Task' AND Year = '$acad'");
$mid5 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_2' AND Grade_Components = 'Exam' AND Year = '$acad'");


$mid1row = mysqli_fetch_array($mid1);
$mid2row = mysqli_fetch_array($mid2);
$mid3row = mysqli_fetch_array($mid3);
$mid4row = mysqli_fetch_array($mid4);
$mid5row = mysqli_fetch_array($mid5);

$midz1 = $mid1row['e'];
$midz2 = $mid2row['e'];
$midz3 = $mid3row['e'];

$midz1d = $mid1row['d'];
$midz2d = $mid2row['d'];
$midz3d = $mid3row['d'];

$midz4 = $mid4row['e'];
$midz5 = $mid5row['e'];

$midz4d = $mid4row['d'];
$midz5d = $mid5row['d'];

$midquiz0 = $midz1 + $midz2 + $midz3;
$midquiz1 = $midz1d + $midz2d + $midz3d;
$midquiz2 = ($midquiz0 / $midquiz1) * 50 + 50;
$midquiz = $midquiz2 * .2;

$midtask0 = ($midz4 / $midz4d) * 50 + 50;
$midtask = $midtask0 * .4;

$midexam0 = ($midz5 / $midz5d) * 50 + 50;
$midexam = $midexam0 * .4;

$midterm = $midquiz + $midtask + $midexam;

/* Semi-Final | 3rd Grading  */
$semi1 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Quiz 1' AND Year = '$acad'");
$semi2 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Quiz 2' AND Year = '$acad'");
$semi3 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Quiz 3' AND Year = '$acad'");
$semi4 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Performance Task' AND Year = '$acad'");
$semi5 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_3' AND Grade_Components = 'Exam' AND Year = '$acad'");

$semi1row = mysqli_fetch_array($semi1);
$semi2row = mysqli_fetch_array($semi2);
$semi3row = mysqli_fetch_array($semi3);
$semi4row = mysqli_fetch_array($semi4);
$semi5row = mysqli_fetch_array($semi5);

$semiz1 = $semi1row['e'];
$semiz2 = $semi2row['e'];
$semiz3 = $semi3row['e'];

$semiz1d = $semi1row['d'];
$semiz2d = $semi2row['d'];
$semiz3d = $semi3row['d'];

$semiz4 = $semi4row['e'];
$semiz5 = $semi5row['e'];

$semiz4d = $semi4row['d'];
$semiz5d = $semi5row['d'];

$semiquiz0 = $semiz1 + $semiz2 + $semiz3;
$semiquiz1 = $semiz1d + $semiz2d + $semiz3d;
$semiquiz2 = ($semiquiz0 / $semiquiz1) * 50 + 50;
$semiquiz = $semiquiz2 * .2;

$semitask0 = ($semiz4 / $semiz4d) * 50 + 50;
$semitask = $semitask0 * .4;

$semiexam0 = ($semiz5 / $semiz5d) * 50 + 50;
$semiexam = $semiexam0 * .4;

$semiterm = $semiquiz + $semitask + $semiexam;

/* Finals | 4th Grading */
$finals1 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Quiz 1' AND Year = '$acad'");
$finals2 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Quiz 2' AND Year = '$acad'");
$finals3 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Quiz 3' AND Year = '$acad'");
$finals4 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Performance Task' AND Year = '$acad'");
$finals5 = mysqli_query($conn, "SELECT sum(Score) as e, sum(Total_score) as d FROM tbl_scores WHERE Fac_Id = '$fac_id' AND Stud_Id = '$id' AND SubjectCode = '$sub_id' AND Period = '$periodz_4' AND Grade_Components = 'Exam' AND Year = '$acad'");

$final1row = mysqli_fetch_array($finals1);
$final2row = mysqli_fetch_array($finals2);
$final3row = mysqli_fetch_array($finals3);
$final4row = mysqli_fetch_array($finals4);
$final5row = mysqli_fetch_array($finals5);

$finalsz1 = $final1row['e'];
$finalsz2 = $final2row['e'];
$finalsz3 = $final3row['e'];

$finalsz1d = $final1row['d'];
$finalsz2d = $final2row['d'];
$finalsz3d = $final3row['d'];

$finalsz4 = $final4row['e'];
$finalsz5 = $final5row['e'];

$finalsz4d = $final4row['d'];
$finalsz5d = $final5row['d'];

$finalsquiz0 = $finalsz1 + $finalsz2 + $finalsz3;
$finalsquiz1 = $finalsz1d + $finalsz2d + $finalsz3d;
$finalsquiz2 = ($finalsquiz0 / $finalsquiz1) * 50 + 50;
$finalsquiz = $finalsquiz2 * .2;

$finalstask0 = ($finalsz4 / $finalsz4d) * 50 + 50;
$finalstask = $finalstask0 * .4;

$finalsexam0 = ($finalsz5 / $finalsz5d) * 50 + 50;
$finalsexam = $finalsexam0 * .4;

$finals = $finalsquiz + $finalstask + $finalsexam;


$final_grade = ($prelim + $midterm + $semiterm + $finals) / 4;

$n_0 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.0'");
$r0 = mysqli_fetch_array($n_0);
/* */
$n_1 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.1'");
$r1 = mysqli_fetch_array($n_1);
/* */
$n_2 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.2'");
$r2 = mysqli_fetch_array($n_2);
/* */
$n_3 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.3'");
$r3 = mysqli_fetch_array($n_3);
/* */
$n_4 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.4'");
$r4 = mysqli_fetch_array($n_4);
/* */
$n_5 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.5'");
$r5 = mysqli_fetch_array($n_5);
/* */
$n_6 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.6'");
$r6 = mysqli_fetch_array($n_6);
/* */
$n_7 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.7'");
$r7 = mysqli_fetch_array($n_7);
/* */
$n_8 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.8'");
$r8 = mysqli_fetch_array($n_8);
/* */
$n_9 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '1.9'");
$r9 = mysqli_fetch_array($n_9);
/* */
$n_02 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.0'");
$r02 = mysqli_fetch_array($n_02);
/* */
$n_021 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.1'");
$r021 = mysqli_fetch_array($n_021);
/* */
$n_022 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.2'");
$r022 = mysqli_fetch_array($n_022);
/* */
$n_023 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.3'");
$r023 = mysqli_fetch_array($n_023);
/* */
$n_024 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.4'");
$r024 = mysqli_fetch_array($n_024);
/* */
$n_025 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.5'");
$r025 = mysqli_fetch_array($n_025);
/* */
$n_026 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.6'");
$r026 = mysqli_fetch_array($n_026);
/* */
$n_027 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.7'");
$r027 = mysqli_fetch_array($n_027);
/* */
$n_028 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.8'");
$r028 = mysqli_fetch_array($n_028);
/* */
$n_029 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '2.9'");
$r029 = mysqli_fetch_array($n_029);
/* */
$n_03 = mysqli_query($conn, "SELECT * FROM tbl_numeric WHERE n_grade = '3.0'");
$r03 = mysqli_fetch_array($n_03);


if($final_grade <= $r03[2]){
    $numeric_grade = "3.0";
}elseif($final_grade <= $r029[2] && $final_grade >= $r029[3]){
    $numeric_grade = "2.9";
}elseif($final_grade <= $r028[2] && $final_grade >= $r028[3]){
    $numeric_grade = "2.8";
}elseif($final_grade <= $r027[2] && $final_grade >= $r027[3]){
    $numeric_grade = "2.7";
}elseif($final_grade <= $r026[2] && $final_grade >= $r026[3]){
    $numeric_grade = "2.6";
}elseif($final_grade <= $r025[2] && $final_grade >= $r025[3]){
    $numeric_grade = "2.5";
}elseif($final_grade <= $r024[2] && $final_grade >= $r024[3]){
    $numeric_grade = "2.4";
}elseif($final_grade <= $r023[2] && $final_grade >= $r023[3]){
    $numeric_grade = "2.3";
}elseif($final_grade <= $r022[2] && $final_grade >= $r022[3]){
    $numeric_grade = "2.2";
}elseif($final_grade <= $r021[2] && $final_grade >= $r021[3]){
    $numeric_grade = "2.1";
}elseif($final_grade <= $r02[2] && $final_grade >= $r02[3]){
    $numeric_grade = "2.0";
}elseif($final_grade <= $r9[2] && $final_grade >= $r9[3]){
    $numeric_grade = "1.9";
}elseif($final_grade <= $r8[2] && $final_grade >= $r8[3]){
    $numeric_grade = "1.8";
}elseif($final_grade <= $r7[2] && $final_grade >= $r7[3]){
    $numeric_grade = "1.7";
}elseif($final_grade <= $r6[2] && $final_grade >= $r6[3]){
    $numeric_grade = "1.6";
}elseif($final_grade <= $r5[2] && $final_grade >= $r5[3]){
    $numeric_grade = "1.5";
}elseif($final_grade <= $r4[2] && $final_grade >= $r4[3]){
    $numeric_grade = "1.4";
}elseif($final_grade <= $r3[2] && $final_grade >= $r3[3]){
    $numeric_grade = "1.3";
}elseif($final_grade <= $r2[2] && $final_grade >= $r2[3]){
    $numeric_grade = "1.2";
}elseif($final_grade <= $r1[2] && $final_grade >= $r1[3]){
    $numeric_grade = "1.1";
}elseif($final_grade <= $r0[2] && $final_grade >= $r0[3]){
    $numeric_grade = "1.0";
}

?>