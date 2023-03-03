<?php
//upload.php
if($_FILES["file"]["name"])
{
 $id = $_GET['id'];
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = $id . '.' . $ext;
 $location = '../../../images/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
}
?>