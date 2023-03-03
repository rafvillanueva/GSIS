<?php
include("../../site-config.php");
ob_start();
session_start();
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

if($row_admn['Level'] != "Student"){
     ?><script type="text/javascript">window.location.href = "../../Login"</script><?php
}

$rs_info = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$user'");
$row_info = mysqli_fetch_array($rs_info);
?>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Montserrat');

    #kiao:hover {background-color: transparent;}
    a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
    a:active {background-color: transparent;}

    body {font-family: 'Montserrat', sans-serif;}
    @media only screen and (max-width: 600px) {
        .fontz{ font-size: 14px !important;}
        .imagez{ height: 32px !important; width: 32px !important; position: relative; top: 5px; }
    }
    @media only screen and (max-width: 400px) {
        .fontzz{ font-size: 11px !important;}
        .imagezz{ height: 22px !important; width: 22px !important; position: relative; top: 5px; }
    }
    #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
    .navbar-collapse{ position: relative; top: -15px; }
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
           <img src="assets/icons/fav.png" height="85">
        </a>
    </div><br><br><br><br>
    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <?php
                    if (!file_exists('../../images/'.$row_info['s_id'].".jpg")) {
                        ?>
                         <img src="assets/icons/User_96px.png?thumbnail=<?= date("h:s:i") ?>" height="32" style="position: relative;">
                        <?php
                    }else{
                        ?>
                         <img src="../../images/<?= $row_info['s_id'] ?>.jpg?thumbnail=<?= date("h:s:i") ?>" height="32" style="position: relative; border-radius: 500px;">
                        <?php
                    }
                    ?>
                    <?= $row_info['s_lname'] . ", " . $row_info['s_fname'] ?><br>
                    <hr>
                    <a href="modules">
                        <img src="assets/icons/School_96px.png" height="32" style="position: relative;">
                        <b> Grade Record</b>
                    </a>
                    <!-- <a href="current-grades">
                        <img src="assets/icons/Exam_96px.png" height="32" style="position: relative;">
                        <b> View Current Grades</b>
                    </a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                        <img src="assets/icons/Futures_96px.png" height="32" style="position: relative;">
                        <b> Progress Graph</b>
                    </a> -->
                    <a href="password">
                        <img src="assets/icons/Key_96px.png" height="32" style="position: relative;">
                        <b> Change Password</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b> Logout</b>
                    </a>
                    <!-- <img src="controls/icons/User_96px.png" height="32" style="position: relative;">
                    <?= $user ?><br>
                    <img src="controls/icons/Connection Status On_96px.png" height="32" style="position: relative;">
                    Status : <b><?= $row_info['Status']?></b> -->
                </li>
            </ul>
        </div>
    </div>
</nav>