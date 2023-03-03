<?php
include("../../site-config.php");

if(isset($_POST['faci_d'])){
	date_default_timezone_set('Asia/Manila');
	$faci_d = $_POST['faci_d'];
	$stud_id = $_POST['stud_id'];
	$Acad = $_POST['Acad'];
	$sem = $_POST['Semester'];
	$Quiz= $_POST['Quiz'];
	$Period = $_POST['Period'];
	$sub_id = $_POST['sub_id'];
	$Score = $_POST['Score'];
	$Total_score = $_POST['Total_score'];
	$Grade = $_POST['Grade'];
	$sectionx = $_POST['sectionx'];
	$date = date("F d, Y h:i:s A");

	$save = mysqli_query($conn, "INSERT INTO tbl_scores(Fac_id,Stud_id,SubjectCode,Year,Semester,Grade_Components,Period,Score,Total_score,Grade, Status,Date_edit,Section) VALUES('$faci_d','$stud_id','$sub_id','$Acad','$sem','$Quiz','$Period','$Score','$Total_score','$Grade','Sent','$date','$sectionx')");

	$e1 =  "score" . $stud_id;
	$e2 =  "grade" . $stud_id;
	$e3 =  "status" . $stud_id;
	$e4 =  "e_edit" . $stud_id;
	$e5 =  "e_save" . $stud_id;
/*
	$numbers = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$stud_id'");
    function itexmo($number,$message,$apicode){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);}
    $row = mysqli_fetch_array($numbers);
    if($row['ContactNumber'] != ""){
     	$num = $row['ContactNumber'];
      	$msg = "Hello! " . $row['lastName'] . ", " .  $row['firstName'] . ". You got (".$Score."/".$Total_score.") for '" . $Quiz .
      	"' ---noreply@vineyand.com";
        $result = itexmo($num, $msg, "TR-KRCSO607350_8JJTL");
        if ($result == ""){
            $err++;
        }else if ($result == 0){
            $count++;
        }
        else{ 
            echo "Error Num ". $result . " was encountered!";
        }

    }*/

	echo '
	<script type="text/javascript">
		document.getElementById("'.$e1.'").disabled = true;
		document.getElementById("'.$e3.'").innerHTML = "Sent";
		document.getElementById("dsp").innerHTML = "Sent";
		document.getElementById("'.$e3.'").style.color = "green";
	</script>';
}

if(isset($_POST['ufaci_d'])){

	date_default_timezone_set('Asia/Manila');
	$faci_d = $_POST['ufaci_d'];
	$stud_id = $_POST['stud_id'];
	$Acad = $_POST['Acad'];
	$sem = $_POST['Semester'];
	$Quiz= $_POST['Quiz'];
	$Period = $_POST['Period'];
	$sub_id = $_POST['sub_id'];
	$Score = $_POST['Score'];
	$Total_score = $_POST['Total_score'];
	$Grade = $_POST['Grade'];
	$date = date("F d, Y h:i:s A");

	$update = mysqli_query($conn, "UPDATE tbl_scores SET Score = '$Score', Grade = '$Grade', Date_edit = '$date', Total_score = '$Total_score' WHERE Fac_id = '$faci_d' AND Stud_id = '$stud_id' AND SubjectCode = '$sub_id' AND Year = '$Acad' AND Semester = '$sem' AND Grade_Components = '$Quiz' AND Period = '$Period'");

	$e1 =  "score" . $stud_id;
	$e2 =  "grade" . $stud_id;
	$e3 =  "status" . $stud_id;
	$e4 =  "e1_edit" . $stud_id;
	$e5 =  "e1_save" . $stud_id;

	/*$numbers = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$stud_id'");
    function itexmo($number,$message,$apicode){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);}
    $row = mysqli_fetch_array($numbers);
    if($row['ContactNumber'] != ""){
     	$num = $row['ContactNumber'];
      	$msg = "Hello! " . $row['lastName'] . ", " .  $row['firstName'] . ". You got (".$Score."/".$Total_score.") for '" . $Quiz .
      	"' ---noreply@vineyand.com";
        $result = itexmo($num, $msg, "TR-KRCSO607350_8JJTL");
        if ($result == ""){
            $err++;
        }else if ($result == 0){
            $count++;
        }
        else{ 
            echo "Error Num ". $result . " was encountered!";
        }

    }*/

	echo '
	<script type="text/javascript">
		document.getElementById("'.$e1.'").disabled = true;
		document.getElementById("'.$e3.'").innerHTML = "Sent";
		document.getElementById("'.$e3.'").style.color = "green";
		//document.getElementById("'.$e4.'").style.display = "block";
		//document.getElementById("'.$e5.'").style.display = "none";		
	</script>';
}
?>
 