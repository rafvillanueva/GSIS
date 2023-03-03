<?php

require("../../../../config/db.php");

if(isset($_POST['query'])){
	?>
	<script type="text/javascript">
		document.getElementById('std-list').style.display = "block";
	</script>
	<?php
	$val = $_POST['query'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_studentrecord WHERE (Stud_Id like '%$val%' OR lastName like '%$val%' OR firstName like '%$val%')");
	$output = '<ul class="list-unstyled" style="background-color: #fff; border: 1px solid #e1e1e1; padding: 5px; box-shadow: 2px 2px 2xp #333;-webkit-box-shadow: -1px 1px 2px 1px rgba(196,190,196,1); -moz-box-shadow: -1px 1px 2px 1px rgba(196,190,196,1); box-shadow: -1px 1px 2px 1px rgba(196,190,196,1);">';
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){
			$output .= '<li><a onclick="document.getElementById(\'id_search\').value = '.$row['Stud_id'].'; document.getElementById(\'std-list\').style.display = \'none\';" href="#" style="cursor: pointer;"><b>[ '.$row['Stud_id'].' ] :: </b>'.$row['lastName'].', '.$row['firstName']. ' ' .$row['middleName'].'</a></li>';
		}
	}else{
		$output .= '<li><b>Student ID Not Found</b></li>';
	}
	$output .= '</ul>';
	echo $output;
}

?>