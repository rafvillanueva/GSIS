<?php
include("../../site-config.php");

// Adding Data to table - #Student Record
if(isset($_POST['Stud_Id'])){

	$id = $_POST['Stud_Id'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$mname = $_POST['middlename'];
	$gender = $_POST['gender'];
	$course = $_POST['course'];
	$yearlvl = $_POST['yearlevel'];
	$yearenrolled = $_POST['yearenrolled'];
	$semester = $_POST['semester'];
	$address = $_POST['address'];

	$date_reg = date("F d, Y");
	if(empty($id) || empty($fname) || empty($lname) || empty($mname) || empty($gender) || empty($course) || empty($yearlvl) || empty($yearenrolled) || empty($semester) || empty($address)){
	echo '
	<div class="alert alert-danger">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div>
	';
	}else{

		$exist_stud = "SELECT count(*) as e,firstname,lastname,middlename FROM tbl_studentrecord WHERE Stud_id like '$id'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

		if($exist_stud_row['e'] == 0){
			$query = "INSERT INTO tbl_studentrecord(Stud_id,firstName,lastName,MiddleName,Gender,Course,Semester,yearLevel,yearEnrolled,Address,dateRegister) VALUES('$id','$fname','$lname','$mname','$gender','$course','$semester','$yearlvl','$yearenrolled','$address','$date_reg')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Student <a href="#" class="alert-link">'.$lname.' , '.$fname.' '.$mname.'</a> has been added.
			</div>
			';
			?>
			<script type="text/javascript">
				document.getElementById("student_id").value = "";
				document.getElementById("firstname").value = "";
				document.getElementById("lastname").value = "";
				document.getElementById("middlename").value = "";
				document.getElementById("address").value = "";
	            document.getElementById("gender").selectedIndex = "0";
				document.getElementById("course").selectedIndex = "0";
				document.getElementById("yearlevel").selectedIndex = "0";
				document.getElementById("yearenrolled").selectedIndex = "0";
				document.getElementById("semester").selectedIndex = "0";
			</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			  <strong><span class="fa fa-warning"></span> '.$id.'</strong> is Already Exist! Owned by : " '.$exist_stud_row['lastname'].' , ' . $exist_stud_row['firstname'] . ' ' . $exist_stud_row['middlename']. ' "
			</div>
			';
		}
	}
}

/* EDIT Student */
if(isset($_POST['Stud_Id_edit'])){

	$idx = $_POST['idxs'];
	$id = $_POST['Stud_Id_edit'];
	$fname = $_POST['firstname_edit'];
	$lname = $_POST['lastname_edit'];
	$mname = $_POST['middlename_edit'];
	$gender = $_POST['gender_edit'];
	$course = $_POST['course_edit'];
	$yearlvl = $_POST['yearlevel_edit'];
	$yearenrolled = $_POST['yearenrolled_edit'];
	$semester = $_POST['semester_edit'];
	$address = $_POST['address_edit'];

	$date_reg = date("F d, Y");
	if(empty($id) || empty($fname) || empty($lname) || empty($mname) || empty($gender) || empty($course) || empty($yearlvl) || empty($yearenrolled) || empty($semester) || empty($address)){
	echo '
	<div class="alert alert-danger">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div>
	';
	}else{

		$query = "UPDATE tbl_studentrecord SET Stud_id = '$id', firstName = '$fname', lastName = '$lname', MiddleName = '$mname', Gender = '$gender', Course = '$course', Semester = '$semester', yearLevel = '$yearlvl', yearEnrolled = '$yearenrolled', Address = '$address' WHERE Stud_id = '$idx'";
		$sql = mysqli_query($conn, $query);
		echo '
		<div class="alert alert-success">
		  <strong><span class="fa fa-check"></span> Success!</strong> 
		  Edit Student Information <a href="#" class="alert-link">'.$lname.' , '.$fname.' '.$mname.'</a> is now updated.
		</div>
		';
			
	}
}

/* Delete Student */
if(isset($_POST['idxd'])){
	$idx = $_POST['idxd'];
	?>
	<script type="text/javascript">
		var result = confirm("Are you sure do you want to removed ?");
		if(result){
			<?php
				$sql = mysqli_query($conn, "DELETE FROM tbl_studentrecord WHERE Stud_id = '$id'");
				echo "DELETE FROM tbl_studentrecord WHERE Stud_id = '$id'";
			?>
		}
	</script>
	<?php
	
	?>
	<!-- <script type="text/javascript">alert("Success! Student has been removed"); window.location.href = "students"</script> -->
	<?php

}

// Adding Data to table - #Course
if(isset($_POST['coursex'])){
	$course = $_POST['coursex'];
	$description = $_POST['description'];
	$program = $_POST['program'];

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

// Adding Data to table - #Subjects
if(isset($_POST['subject'])){
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

// Adding Data to table - #Accounts
if(isset($_POST['level'])){
	$user = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$level = $_POST['level'];

	if(empty($user) || empty($email) || empty($pass) || empty($level)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist = "SELECT count(*) as e,Username FROM tbl_accounts WHERE Username like '$user'";
		$exist_sql = mysqli_query($conn, $exist);
		$exist_row = mysqli_fetch_array($exist_sql);
		if($exist_row['e'] == 0){
			$password = hash("sha256", $pass);
			$query = "INSERT INTO tbl_accounts(Username,Email,Password,Level) VALUES('$user','$email','$password','$level')";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  New Account Member <a href="#" class="alert-link">'.$user.'</a> has been added.
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
			<b><span class="fa fa-warning"></span></b> Username : <strong>'.$user.'</strong> is Already Exist!
			</div>
			';
		}
	}
}

// Updating Data to table - #Accounts
if(isset($_POST['idx'])){
	$id = $_POST['idx'];
	$user = $_POST['username_e'];
	$email = $_POST['email_e'];
	$pass = $_POST['password_e'];
	$level = $_POST['level_e'];

	if(empty($user) || empty($email) || empty($id) || empty($level)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist = "SELECT count(*) as e,Username FROM tbl_accounts WHERE Username like '$user' AND ID != '$id'";
		$exist_sql = mysqli_query($conn, $exist);
		$exist_row = mysqli_fetch_array($exist_sql);
		if($exist_row['e'] == 0){
			if(empty($pass)){
				$query = "UPDATE tbl_accounts SET Username = '$user', Email = '$email', Level = '$level' WHERE ID = '$id'";
				$sql = mysqli_query($conn, $query);
				echo '
				<div class="alert alert-success">
				  <strong><span class="fa fa-check"></span> Success!</strong> 
				  Account Member <a href="#" class="alert-link">'.$user.'</a> is now updated.
				</div>
				';
			}else{
				$password = hash("sha256", $pass);
				$query = "UPDATE tbl_accounts SET Username = '$user', Email = '$email', Password = '$password', Level = '$level' WHERE ID = '$id'";
				$sql = mysqli_query($conn, $query);
				echo '
				<div class="alert alert-success">
				  <strong><span class="fa fa-check"></span> Success!</strong> 
				  Account Member <a href="#" class="alert-link">'.$user.'</a> is now updated.
				</div>
				';
			}			
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
			<b><span class="fa fa-warning"></span></b> Username : <strong>'.$user.'</strong> is Already Exist!
			</div>
			';
		}
	}
}

// Adding Data to table - #Course
if(isset($_POST['c_idx'])){
	$id = $_POST['c_idx'];
	$course = $_POST['c_coursex'];
	$description = $_POST['c_description'];
	$program = $_POST['c_program'];

	if(empty($id) || empty($course) || empty($description) || empty($program)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist_stud = "SELECT count(*) as e,Description,courseCode FROM tbl_coursesoffered WHERE courseCode like '$course' AND ID != '$id'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);
		if($exist_stud_row['e'] == 0){
			$query = "UPDATE tbl_coursesoffered SET courseCode = '$course', Description = '$description', Program = '$program' WHERE ID = '$id'";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			   Course <a href="#" class="alert-link">'.$course.'</a> as " '.$description.' " is now updated.
			</div>
			';
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Cours11e <strong>'.$exist_stud_row['courseCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
			</div>
			';
		}
	}
}

// Edit Data to table - #Subjects
if(isset($_POST['e_idx'])){
	$id = $_POST['e_idx'];
	$subject = $_POST['e_subject'];
	$description = $_POST['e_description'];
	$lec = $_POST['e_unitlec'];
	$lab = $_POST['e_unitlab'];
	$year = $_POST['e_year'];
	$sem = $_POST['e_sem'];
	$prer = $_POST['e_Prerequisite'];

	$date_reg = date("F d, Y");

	if(empty($id) || empty($subject) || empty($description) || $lec == "" || $lab == "" || empty($year) || empty($sem) || empty($prer)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist_stud = "SELECT count(*) as e,Description,subjectCode FROM tbl_subjects WHERE subjectCode like '$subject' AND ID != '$id'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

		if($exist_stud_row['e'] == 0){
			$query = "UPDATE tbl_subjects SET subjectCode = '$subject', Description = '$description', UnitLec = '$lec', UnitLab = '$lab', Year = '$year', Sem = '$sem', Prerequisite = '$prer' WHERE ID = '$id'";
			$sql = mysqli_query($conn, $query);
			echo '
			<div class="alert alert-success">
			  <strong><span class="fa fa-check"></span> Success!</strong> 
			  Subject <a href="#" class="alert-link">'.$subject.'</a> as " '.$description.' " is now updated.
			</div>
			';
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Course <strong>'.$exist_stud_row['subjectCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
			</div>
			';
		}
	}
}
?>

