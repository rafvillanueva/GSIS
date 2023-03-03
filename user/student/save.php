<?php
include("../site-config.php");

if(isset($_POST['faci_d'])){
	date_default_timezone_set('Asia/Manila');
	$faci_d = $_POST['faci_d'];
	$stud_id = $_POST['stud_id'];
	$Acad = $_POST['Acad'];
	$Quiz= $_POST['Quiz'];
	$Period = $_POST['Period'];
	$sub_id = $_POST['sub_id'];
	$Score = $_POST['Score'];
	$Total_score = $_POST['Total_score'];
	$Grade = $_POST['Grade'];
	$date = date("F d, Y h:i:s A");

	$save = mysqli_query($conn, "INSERT INTO tbl_scores(Fac_id,Stud_id,SubjectCode,AcadYearAndSem,Grade_Components,Period,Score,Total_score,Grade, Status,Date_edit) VALUES('$faci_d','$stud_id','$sub_id','$Acad','$Quiz','$Period','$Score','$Total_score','$Grade','Sent','$date')");

	$e1 =  "score" . $stud_id;
	$e2 =  "grade" . $stud_id;
	$e3 =  "status" . $stud_id;
	$e4 =  "e_edit" . $stud_id;
	$e5 =  "e_save" . $stud_id;

	echo '
	<script type="text/javascript">
		document.getElementById("'.$e1.'").disabled = true;
		document.getElementById("'.$e3.'").innerHTML = "Sent";
		document.getElementById("'.$e3.'").style.color = "green";
	</script>';
}

if(isset($_POST['ufaci_d'])){

	date_default_timezone_set('Asia/Manila');
	$faci_d = $_POST['ufaci_d'];
	$stud_id = $_POST['stud_id'];
	$Acad = $_POST['Acad'];
	$Quiz= $_POST['Quiz'];
	$Period = $_POST['Period'];
	$sub_id = $_POST['sub_id'];
	$Score = $_POST['Score'];
	$Total_score = $_POST['Total_score'];
	$Grade = $_POST['Grade'];
	$date = date("F d, Y h:i:s A");

	$update = mysqli_query($conn, "UPDATE tbl_scores SET Score = '$Score', Grade = '$Grade', Date_edit = '$date' WHERE Fac_id = '$faci_d' AND Stud_id = '$stud_id' AND SubjectCode = '$sub_id' AND AcadYearAndSem = '$Acad' AND Grade_Components = '$Quiz' AND Period = '$Period'");

	$e1 =  "score" . $stud_id;
	$e2 =  "grade" . $stud_id;
	$e3 =  "status" . $stud_id;
	$e4 =  "e1_edit" . $stud_id;
	$e5 =  "e1_save" . $stud_id;

	echo '
	<script type="text/javascript">
		document.getElementById("'.$e1.'").disabled = true;
		document.getElementById("'.$e3.'").innerHTML = "Sent";
		document.getElementById("'.$e3.'").style.color = "green";
		document.getElementById("'.$e4.'").style.display = "block";
		document.getElementById("'.$e5.'").style.display = "none";		
	</script>';
}
?>
 