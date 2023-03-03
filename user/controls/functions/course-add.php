<?php
include("../../site-config.php");

// Adding Data to table - #Course
if(isset($_POST['course'])){
	$course = $_POST['course'];
	$description = $_POST['description'];
	$program = $_POST['program'];

	$date_reg = date("F d, Y");

	if(empty($course) || empty($description) || empty($program)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist_stud = "SELECT count(*) as e,Description,courseCode FROM tbl_coursesoffered WHERE courseCode like '$course'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

		if($exist_stud_row['e'] == 0){
			$query = "INSERT INTO tbl_coursesoffered(courseCode,Description,Program) VALUES('$course','$description','$program')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Course <a href="#" class="alert-link">'.$course.'</a> as " '.$description.' " has been added.
			</div>
			';
			?>
				<script type="text/javascript">
					document.getElementById("course").value = "";
					document.getElementById("description").value = "";
					document.getElementById("program").selectedIndex = "0";
				</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Course <strong>'.$exist_stud_row['courseCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
			</div>
			';
		}
	}
}

// Adding Data to table - #Section
if(isset($_POST['section'])){
	$section = $_POST['section'];
	if(empty($section)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{
		$exist = "SELECT count(*) as e,Section FROM tbl_section WHERE Section like '$section'";
		$exist_sql = mysqli_query($conn, $exist);
		$exist_row = mysqli_fetch_array($exist_sql);

		if($exist_row['e'] == 0){
			$query = "INSERT INTO tbl_section(Section) VALUES('$section')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Section <a href="#" class="alert-link">'.$section.'</a> has been added.
			</div>
			';
			?>
				<script type="text/javascript">
					document.getElementById("section").value = "";
				</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Section <strong>'.$exist_row['Section'].'</strong> is Already Exist!
			</div>
			';
		}
	}
}

// Adding Data to table - #FacultyInfo
if(isset($_POST['fac_id'])){
	$id = $_POST['fac_id'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$mname = $_POST['middlename'];
	$postg = $_POST['postg'];
	$underg = $_POST['underg'];
	$status = $_POST['status'];

	if(empty($id) || empty($fname) || empty($lname) || empty($mname) || empty($postg) || empty($underg) || empty($status)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist = "SELECT count(*) as e,fac_id,firstName,lastName,middleName FROM tbl_facultyinfo WHERE Fac_id like '$id'";
		$exist_sql = mysqli_query($conn, $exist);
		$exist_row = mysqli_fetch_array($exist_sql);
		if($exist_row['e'] == 0){
			$query = "INSERT INTO tbl_facultyinfo(Fac_id,firstName,lastName,middleName,Status,UnderGrad_Degree,PostGrad_Degree) VALUES('$id','$fname','$lname','$mname','$status','$underg','$postg')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Faculty Member <a href="#" class="alert-link">'.$lname.' , '.$fname.' '.$mname.'</a> has been added.
			</div>
			';
			?>
			<script type="text/javascript">
				setTimeout(function(){
			   window.location.reload(1);
			}, 5000);
			</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Faculty ID # <strong>'.$exist_row['fac_id'].'</strong> is Already Exist! Owned by : " '.$exist_row['lastName'].' , '.$exist_row['firstName'].' '.$exist_row['middleName'].' "
			</div>
			';
		}
	}
}

// Edit Data to table - #FacultyInfo
if(isset($_POST['e_fac_id'])){
	$id = $_POST['e_fac_id'];
	$fname = $_POST['e_firstname'];
	$lname = $_POST['e_lastname'];
	$mname = $_POST['e_middlename'];
	$postg = $_POST['e_postg'];
	$underg = $_POST['e_underg'];
	$status = $_POST['e_status'];

	if(empty($id) || empty($fname) || empty($lname) || empty($mname) || empty($postg) || empty($underg) || empty($status)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

			$query = "UPDATE tbl_facultyinfo SET firstName = '$fname', lastName = '$lname', middleName = '$mname', Status = '$status', UnderGrad_Degree = '$underg', PostGrad_Degree = '$postg' WHERE Fac_id = '$id'";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Faculty Member <a href="#" class="alert-link">'.$lname.' , '.$fname.' '.$mname.'</a> has been added.
			</div>
			';
		
	}
}


if(isset($_POST['coursex'])){
	$course = $_POST['coursex'];

	$date_reg = date("F d, Y");

	if(empty($course)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist_stud = "SELECT count(*) as e,Description,courseCode FROM tbl_coursesoffered WHERE courseCode like '$course'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

		if($exist_stud_row['e'] == 0){
			$query = "INSERT INTO tbl_coursesoffered(courseCode,Description,Program) VALUES('$course','$description','$program')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Course <a href="#" class="alert-link">'.$course.'</a> as " '.$description.' " has been added.
			</div>
			';
			?>
				<script type="text/javascript">
					document.getElementById("course").value = "";
					document.getElementById("description").value = "";
					document.getElementById("program").selectedIndex = "0";
				</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Course <strong>'.$exist_stud_row['courseCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
			</div>
			';
		}
	}
}
?>

