<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php

if(isset($_SESSION['user']) == ""){
    ?>
    <script type="text/javascript">
        window.location.href = "../login/";
    </script>
    <?php
}else{
    $id = $_SESSION['user'];
    $info = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$id'");
    $info_row = mysqli_fetch_array($info);
}
?>

</body>
</html>