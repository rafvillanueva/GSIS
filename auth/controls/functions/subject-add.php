<?php
include("../../site-config.php");
$subject = $_POST['subject'];
$description = $_POST['description'];
$lec = $_POST['unitlec'];
$lab = $_POST['unitlab'];
$year = $_POST['year'];
$sem = $_POST['sem'];
$prer = $_POST['Prerequisite'];

$date_reg = date("F d, Y");

if(empty($subject) || empty($description) || $lec == "" || $lab == "" || empty($year) || empty($sem) || empty($prer)){
	echo '
	<div class="alert alert-danger">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div>
	';
}else{

	$exist_stud = "SELECT count(*) as e,Description,subjectCode FROM tbl_subjects WHERE subjectCode like '$subject'";
	$exist_stud_sql = mysqli_query($conn, $exist_stud);
	$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

	if($exist_stud_row['e'] == 0){
		$query = "INSERT INTO tbl_subjects(subjectCode,Description,UnitLec,UnitLab,Year,Sem,Prerequisite) VALUES('$subject','$description','$lec','$lab','$year','$sem','$prer')";
		$sql = mysqli_query($conn, $query);
		echo '
		<div class="alert alert-success">
		  <strong><span class="fa fa-check"></span> Success!</strong> 
		  New Subject <a href="#" class="alert-link">'.$subject.'</a> as " '.$description.' " has been added.
		</div>
		';
		?>
			<script type="text/javascript">
				document.getElementById("subject").value = "";
				document.getElementById("description").value = "";
				document.getElementById("UnitLec").value = "";
				document.getElementById("UnitLab").value = "";
				document.getElementById("year").selectedIndex = "0";
				document.getElementById("semester").selectedIndex = "0";
				document.getElementById("Prerequisite").value = "None";
			</script>
		<?php
	}else{
		echo '
		<div class="alert alert-warning">
		<b><span class="fa fa-warning"></span></b> Course <strong>'.$exist_stud_row['subjectCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
		</div>
		';
	}
}
?>

