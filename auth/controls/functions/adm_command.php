<?php
include("../../site-config.php");

// Adding Data to table - #Student Record
if(isset($_POST['Stud_Id'])){

	$id = $_POST['Stud_Id'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$mname = $_POST['middlename'];
	$gender = $_POST['gender'];
	$contactnum = $_POST['contactnumm'];
	$address = $_POST['address'];

	$m_fname = $_POST['mfirstname'];
	$m_lname = $_POST['mlastname'];
	$m_mname = $_POST['mmiddlename'];
	$m_contact = $_POST['mcontactnum'];

	$f_fname = $_POST['ffirstname'];
	$f_lname = $_POST['flastname'];
	$f_mname = $_POST['fmiddlename'];
	$f_contact = $_POST['fcontactnum'];

	$s_level = $_POST['slevel'];


	$date_reg = date("F d, Y");

	if(empty($fname) || empty($lname) || empty($mname) || empty($gender) || empty($m_fname) || empty($m_lname) || empty($m_mname) || empty($m_contact) || empty($f_fname)  || empty($f_lname)  || empty($f_mname)  || empty($f_contact)){
	echo '
	<div class="alert alert-danger">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div>
	';
	}else{

		$exist_stud = "SELECT count(*) as e,s_fname,s_lname,s_mname FROM tbl_students WHERE s_id like '$id'";
		$exist_stud_sql = mysqli_query($conn, $exist_stud);
		$exist_stud_row = mysqli_fetch_array($exist_stud_sql);

		if($exist_stud_row['e'] == 0){
			$query = "INSERT INTO tbl_students VALUES(NULL,'$id','$fname','$lname','$mname','$contactnum','$address','$gender','$m_fname','$m_lname','$m_lname','$m_contact','$f_fname','$f_lname','$f_mname','$f_contact','$s_level')";
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
				document.getElementById("contactnum").value = "";
	            document.getElementById("gender").selectedIndex = "0";

				document.getElementById("mfirstname").value = "";
				document.getElementById("mlastname").value = "";
				document.getElementById("mmiddlename").value = "";
				document.getElementById("mcontactnum").value = "";

				document.getElementById("ffirstname").value = "";
				document.getElementById("flastname").value = "";
				document.getElementById("fmiddlename").value = "";
				document.getElementById("fcontactnum").value = "";
			</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			  <strong><span class="fa fa-warning"></span> '.$id.'</strong> is Already Exist! Owned by : " '.$exist_stud_row['s_lname'].' , ' . $exist_stud_row['s_fname'] . ' ' . $exist_stud_row['s_mname']. ' "
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
	$address = $_POST['address_edit'];
	$contactnum = $_POST['contactnumm_edit'];

	$mfname = $_POST['mfirstname_edit'];
	$mlname = $_POST['mlastname_edit'];
	$mmname = $_POST['mmiddlename_edit'];
	$mcontact = $_POST['mcontactnumm_edit'];

	$ffname = $_POST['ffirstname_edit'];
	$flname = $_POST['flastname_edit'];
	$fmname = $_POST['fmiddlename_edit'];
	$fcontact = $_POST['fcontactnumm_edit'];

	$s_level = $_POST['slevel'];

	$date_reg = date("F d, Y");
	if(empty($id) || empty($fname) || empty($lname) || empty($mname) || empty($gender) || empty($address) || empty($contactnum) || empty($mfname) || empty($mlname) || empty($mmname) || empty($mcontact) || empty($ffname) || empty($flname) || empty($fmname) || empty($fcontact)){
	echo '
	<div class="alert alert-danger">
	  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
	</div>
	';
	}else{
		$query = "UPDATE tbl_students SET s_id = '$id', s_fname = '$fname', s_lname = '$lname', s_mname = '$mname', s_gender = '$gender', s_contact = '$contactnum', s_address = '$address', m_fname = '$mfname', m_lname = '$mlname', m_mname = '$mmname', m_contact = '$mcontact', f_fname = '$ffname', f_lname = '$flname', f_mname = '$fmname', f_contact = '$fcontact', s_level = '$s_level' WHERE s_id = '$idx'";
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
	$year = $_POST['year'];

	$date_reg = date("F d, Y");

	if(empty($subject) || empty($description)){
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
			$query = "INSERT INTO tbl_subjects(subjectCode,Description,offer_at) VALUES('$subject','$description','$year')";
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
			<b><span class="fa fa-warning"></span></b> Subject <strong>'.$exist_stud_row['subjectCode'].'</strong> is Already Exist! As : " '.$exist_stud_row['Description']. ' "
			</div>
			';
		}
	}
}

// Adding Data to table - #Section
if(isset($_POST['section'])){
	$section = $_POST['section'];
	$building = $_POST['building'];
	$max_stud = $_POST['max_stud'];
	$year = $_POST['year'];
	if(empty($section) || empty($building) || empty($max_stud)){
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
			$query = "INSERT INTO tbl_section(Building,Section,max_stud,offer_at) VALUES('$building','$section','$max_stud','$year')";
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
					window.setTimeout(function () {
				        location.href = "section";
				    }, 2000);
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

// Edit Data to table - #Section
if(isset($_POST['section_u'])){
	$section = $_POST['section_u'];
	$building = $_POST['building_u'];
	$max_stud = $_POST['max_stud_u'];
	$id = $_POST['idx_u'];
	if(empty($section) || empty($building) || empty($max_stud)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{
	
		$query = "UPDATE tbl_section SET Section = '$section', Building = '$building', max_stud = '$max_stud' WHERE ID = '$id'";
		$sql = mysqli_query($conn, $query);
		echo '
		<div class="alert alert-success">
		  <strong><span class="fa fa-check"></span> Success!</strong> 
		  New Section <a href="#" class="alert-link">'.$section.'</a> is now updated.			 
		</div>
		';
		?>
			<script type="text/javascript">
				/*document.getElementById("section").value = "";
				window.setTimeout(function () {
			        location.href = "edit-section";
			    }, 2000);*/
			</script>
		<?php
		
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
	$staff_a = $_POST['staff_a'];

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
			$query = "INSERT INTO tbl_accounts(ID,Username,Email,Password,Level,a_name) VALUES(NULL,'$user','$email','$password','$level','$staff_a')";
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
	$idz = $_POST['idx'];
	$userz = $_POST['username_e'];
	$emailz = $_POST['email_e'];
	$passz = $_POST['password_e'];
	$levelz = $_POST['level_e'];

	if(empty($userz) || empty($emailz) || empty($idz) || empty($levelz)){
		echo '
		<div class="alert alert-danger">
		  <strong><span class="fa fa-warning"></span> Warning!</strong> Please enter the following.
		</div>
		';
	}else{

		$exist = "SELECT count(*) as e,Username FROM tbl_accounts WHERE Username like '$userz' AND ID != '$idz'";
		$exist_sql = mysqli_query($conn, $exist);
		$exist_row = mysqli_fetch_array($exist_sql);

		if($exist_row['e'] == 0){
			if(empty($passz)){
				$query = "UPDATE tbl_accounts SET Username = '$userz', Email = '$emailz', Level = '$levelz' WHERE ID = '$idz'";
				$sql = mysqli_query($conn, $query);
				echo '
				<div class="alert alert-success">
				  <strong><span class="fa fa-check"></span> Success!</strong> 
				  Account Member <a href="#" class="alert-link">'.$userz.'</a> is now updated.
				</div>
				';
			}else{
				$passwordz = hash("sha256", $passz);
				$query = "UPDATE tbl_accounts SET Username = '$userz', Email = '$emailz', Password = '$passwordz', Level = '$levelz' WHERE ID = '$idz'";
				$sql = mysqli_query($conn, $query);				
				echo '
				<div class="alert alert-success">
				  <strong><span class="fa fa-check"></span> Success!</strong> 
				  Account Member <a href="#" class="alert-link">'.$userz.'</a> is now updated.
				</div>
				';
			}			
			?>
			<script type="text/javascript">
				setTimeout(function(){
			   window.location.href = "accounts-edit?id=" + <?= $userz ?>;
			}, 5000);
			</script>
			<?php
		}else{
			echo '
			<div class="alert alert-warning">
			<b><span class="fa fa-warning"></span></b> Username : <strong>'.$userz.'</strong> is Already Exist!
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
	$year = $_POST['e_year'];

	$date_reg = date("F d, Y");

	if(empty($id) || empty($subject) || empty($description)){
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
			$query = "UPDATE tbl_subjects SET subjectCode = '$subject', Description = '$description', Offer_at = '$year' WHERE ID = '$id'";
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

