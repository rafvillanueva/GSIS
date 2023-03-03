<?php

date_default_timezone_set("Asia/Manila");
$date_now = date("m.d");

if($calendar == 'SHS'){
      ###################
      # School Calendar #
      ###################
      $rs = mysqli_query($conn, "SELECT * FROM tbl_semester WHERE ID = '1'");
      $row = mysqli_fetch_array($rs);
      if($row[1] <= $current_month && $row[2] > $current_month){
          $semx = "1st semester";
          $semz = 1;
          $rs_c = mysqli_query($conn, "SELECT * FROM tbl_shscalendar WHERE Semester = '1'");
          $row_c = mysqli_fetch_array($rs_c);
          #######################################
          $pre_s = date_create($row_c['First']);
          $pre_e = date_create($row_c['First_End']);
          $prelim_start = date_format($pre_s,"m.d");
          $prelim_end = date_format($pre_e,"m.d");
          #######################################
          $mid_s = date_create($row_c['Second']);
          $mid_e = date_create($row_c['Second_End']);
          $midterm_start = date_format($mid_s,"m.d");
          $midterm_end = date_format($mid_e,"m.d");
          #######################################
          $semi_s = date_create($row_c['Third']);
          $semi_e = date_create($row_c['Third_End']);
          $semifinal_start = date_format($semi_s,"m.d");
          $semifinal_end = date_format($semi_e,"9m.d");
          #######################################
          $final_s = date_create($row_c['Fourth']);
          $final_e = date_create($row_c['Fourth_End']);
          $final_start = date_format($final_s,"m.d");
          $final_end = date_format($final_e,"m.d");
          ####################################### 

          if($date_now <= $final_end && $date_now >= $final_start){
          $period = "4th Grading";
          }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
              $period = "1st Grading";
          }elseif($date_now <= $midterm_end && $date_now >= $midterm_start){
              $period = "2nd Grading";
          }elseif($date_now <= $semifinal_end){
              $period = "3rd Grading";
          }else{
              $period = "Not Available";
              $semz = 0;
          }
      }else{
          $current_year = date('Y') - 1;
          $advance_year = date('Y');
          $date = $current_year . "-" . $advance_year;
          $semx = "2nd semester";
          $semz = 2;
          $rs_c = mysqli_query($conn, "SELECT * FROM tbl_shscalendar WHERE Semester = '2'");
          $row_c = mysqli_fetch_array($rs_c);
          #######################################
          $pre_s = date_create($row_c['First']);
          $pre_e = date_create($row_c['First_End']);
          $prelim_start = date_format($pre_s,"m.d");
          $prelim_end = date_format($pre_e,"m.d");
          #######################################
          $mid_s = date_create($row_c['Second']);
          $mid_e = date_create($row_c['Second_End']);
          $midterm_start = date_format($mid_s,"m.d");
          $midterm_end = date_format($mid_e,"m.d");
          #######################################
          $semi_s = date_create($row_c['Third']);
          $semi_e = date_create($row_c['Third_End']);
          $semifinal_start = date_format($semi_s,"m.d");
          $semifinal_end = date_format($semi_e,"9m.d");
          #######################################
          $final_s = date_create($row_c['Fourth']);
          $final_e = date_create($row_c['Fourth_End']);
          $final_start = date_format($final_s,"m.d");
          $final_end = date_format($final_e,"m.d");
          ####################################### 

          if($date_now <= $final_end && $date_now >= $final_start){
          $period = "4th Grading";
          }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
              $period = "1st Grading";
          }elseif($date_now <= $midterm_end && $date_now >= $midterm_start){
              $period = "2nd Grading";
          }elseif($date_now <= $semifinal_end){
              $period = "3rd Grading";
          }else{
              $period = "Not Available";
              $semz = 0;
          }
      }

           
      

}else{
      ###################
      # School Calendar #
      ###################
      $rs = mysqli_query($conn, "SELECT * FROM tbl_semester WHERE ID = '1'");
      $row = mysqli_fetch_array($rs);
      if($row[1] <= $current_month && $row[2] > $current_month){
          $semx = "1st semester";
          $semz = 1;
          $rs_c = mysqli_query($conn, "SELECT * FROM tbl_schoolcalendar WHERE Semester = '1'");
          $row_c = mysqli_fetch_array($rs_c);
          #######################################
          $pre_s = date_create($row_c['Prelim']);
          $pre_e = date_create($row_c['Prelim_End']);
          $prelim_start = date_format($pre_s,"m.d");
          $prelim_end = date_format($pre_e,"m.d");
          #######################################
          $mid_s = date_create($row_c['Midterm']);
          $mid_e = date_create($row_c['Midterm_End']);
          $midterm_start = date_format($mid_s,"m.d");
          $midterm_end = date_format($mid_e,"m.d");
          #######################################
          $semi_s = date_create($row_c['Semi_Final']);
          $semi_e = date_create($row_c['Semi_Final_End']);
          $semifinal_start = date_format($semi_s,"m.d");
          $semifinal_end = date_format($semi_e,"m.d");
          #######################################
          $final_s = date_create($row_c['Final']);
          $final_e = date_create($row_c['Final_End']);
          $final_start = date_format($final_s,"m.d");
          $final_end = date_format($final_e,"m.d");
          #######################################  

          if($date_now <= $final_end && $date_now >= $final_start){
              $period = "Finals";
          }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
              $period = "Prelim";
          }elseif($date_now <= $midterm_end && $date_now >= $midterm_start){
              $period = "Midterm";
          }elseif($date_now <= $semifinal_end && $date_now >= $semifinal_start){
              $period = "Semi-Final";
          }else{
              $period = "Not Available";
              $semz = 0;
          }
      }else{
          $current_year = date('Y') - 1;
          $advance_year = date('Y');
          $date = $current_year . "-" . $advance_year;
          $semx = "2nd semester";
          $semz = 2;
          $rs_c = mysqli_query($conn, "SELECT * FROM tbl_schoolcalendar WHERE Semester = '2'");
          $row_c = mysqli_fetch_array($rs_c);
          #######################################
          $pre_s = date_create($row_c['Prelim']);
          $pre_e = date_create($row_c['Prelim_End']);
          $prelim_start = date_format($pre_s,"m.d");
          $prelim_end = date_format($pre_e,"m.d");
          #######################################
          $mid_s = date_create($row_c['Midterm']);
          $mid_e = date_create($row_c['Midterm_End']);
          $midterm_start = date_format($mid_s,"m.d");
          $midterm_end = date_format($mid_e,"m.d");
          #######################################
          $semi_s = date_create($row_c['Semi_Final']);
          $semi_e = date_create($row_c['Semi_Final_End']);
          $semifinal_start = date_format($semi_s,"m.d");
          $semifinal_end = date_format($semi_e,"m.d");
          #######################################
          $final_s = date_create($row_c['Final']);
          $final_e = date_create($row_c['Final_End']);
          $final_start = date_format($final_s,"m.d");
          $final_end = date_format($final_e,"m.d");
          #######################################  

          if($date_now <= $final_end && $date_now >= $final_start){
              $period = "Finals";
          }elseif($date_now <= $prelim_end && $date_now >= $prelim_start){
              $period = "Prelim";
          }elseif($date_now <= $midterm_end && $date_now >= $midterm_start){
              $period = "Midterm";
          }elseif($date_now <= $semifinal_end && $date_now >= $semifinal_start){
              $period = "Semi-Final";
          }else{
              $period = "Not Available";
              $semz = 0;
          }
      }
      
}

/*   #Date        #End
if($date_now <= $final_end){
    $current_year = date('Y') - 1;
    $advance_year = date('Y');
    $date = $current_year . "-" . $advance_year;
}*/




?>