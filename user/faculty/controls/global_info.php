<?php 

error_reporting(0);
ob_start();
session_start();

if(isset($_SESSION['user']) == ""){
    ?>
    <script type="text/javascript">
        window.location.href = "../../login/";
    </script>
    <?php
}else{
    $id = $_SESSION['user'];
    $cmd = "SELECT * FROM tbl_facultyinfo INNER JOIN tbl_facultyloads ON tbl_facultyinfo.Fac_Id =  tbl_facultyloads.Fac_Id WHERE tbl_facultyloads.Fac_Id = '$id'";
    $qry = mysqli_query($conn, $cmd);
    $g_row = mysqli_fetch_array($qry);
   
}

?>