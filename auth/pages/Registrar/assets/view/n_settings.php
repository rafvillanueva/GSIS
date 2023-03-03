<?php

$rs = mysqli_query($conn, "SELECT * FROM tbl_semester WHERE ID = '1'");
$row = mysqli_fetch_array($rs);

if($row['Sem_start'] == "01"){
  $f = "January";
}elseif($row['Sem_start'] == "02"){
  $f = "February";
}elseif($row['Sem_start'] == "03"){
  $f = "March";
}elseif($row['Sem_start'] == "04"){
  $f = "April";
}elseif($row['Sem_start'] == "05"){
  $f = "May";
}elseif($row['Sem_start'] == "06"){
  $f = "June";
}elseif($row['Sem_start'] == "07"){
  $f = "July";
}elseif($row['Sem_start'] == "08"){
  $f = "August";
}elseif($row['Sem_start'] == "09"){
  $f = "September";
}elseif($row['Sem_start'] == "10"){
  $f = "October";
}elseif($row['Sem_start'] == "11"){
  $f = "November";
}elseif($row['Sem_start'] == "12"){
  $f = "December";
}

if($row['Sem_end'] == "01"){
  $s = "January";
}elseif($row['Sem_end'] == "02"){
  $s = "February";
}elseif($row['Sem_end'] == "03"){
  $s = "March";
}elseif($row['Sem_end'] == "04"){
  $s = "April";
}elseif($row['Sem_end'] == "05"){
  $s = "May";
}elseif($row['Sem_end'] == "06"){
  $s = "June";
}elseif($row['Sem_end'] == "07"){
  $s = "July";
}elseif($row['Sem_end'] == "08"){
  $s = "August";
}elseif($row['Sem_end'] == "09"){
  $s = "September";
}elseif($row['Sem_end'] == "10"){
  $s = "October";
}elseif($row['Sem_end'] == "11"){
  $s = "November";
}elseif($row['Sem_end'] == "12"){
  $s = "December";
} 

if(isset($_POST['btn_calendar'])){

  $first = $_POST['first_sem'];
  $second = $_POST['second_sem'];

  $rs_u = "UPDATE tbl_semester SET Sem_start = '$first', Sem_end = '$second' WHERE ID = '1'";
  $rs_q = mysqli_query($conn, $rs_u);
  ?>
  <script type="text/javascript">alert("Semester Calendar Updated!."); window.location.href = "semester-calendar";</script>
  <?php
}
?>