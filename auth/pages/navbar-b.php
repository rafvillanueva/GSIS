<?php
require("../../config/db.php");
ob_start();
session_start();
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

if($row_admn['Level'] == "Registrar"){
    $link = '
    <div class="col-md-12">
        <a href="#" class="btn btn-sm btn-default btn-block" style="background-color: #777; color: #fff; letter-spacing: 2px; border-radius: 500px;">
        <span class="fa fa-angle-left"></span> Logout
        </a>
    </div>
    ';
}elseif($row_admn['Level'] == "Administrator"){
    $link = '
    <a href="../../login/logout/logout.php?logout">
        <img src="Registrar/assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
        <b> &nbsp; Logout</b>
    </a>
    ';
}else{
   ?><script type="text/javascript">window.location.href = '../../login/'</script><?php
}


$marq = date("l");
if($marq == "Monday"){
    $msg = "I'ts ". $marq ."! The Beginning of the 1st day of the week. have a nice day.";
}elseif($marq == "Wednesday"){
    $msg = 'Do you know you can send announcement via SMS using this application ? <a href="notification" style="color: red">CLICK HERE</a>.'; 
}elseif($marq == "Tuesday"){
    $msg = 'Account not yet active <a href="accounts-add" style="color: red">HERE</a>. just using ID Numbers.'; 
}elseif($marq == "Thursday"){
    $msg = 'Weather Update ? No problem. Notice everyone <a href="notification" style="color: red">HERE</a>'; 
}elseif($marq == "Friday"){
    $msg = 'Site Change ? <a href="site-content/main" style="color: red">Site Configuration</a>'; 
}else{
    $msg = "Weekend already, You are such a hardworking.";
}

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
            <img src="img/fav.png" height="85">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="">
                       <b>Administrator - cPANEL</b>
                        <!-- <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>User Information</small></i><br><br>
                        <b><?= $row_admn['Username'] ?></b> <sup>&#8211;USER</sup><br>
                        <b><?= $row_admn['Email'] ?></b> <sup>&#8211;EMAIL</sup><br>
                        <b><?= $row_admn['Level'] ?></b> <sup>&#8211;ROLE</sup><br> -->
                    </div>

                </li>
                <li style="border: 0px;"><br>
                   <a href="accounts">
                        <img src="registrar/assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> &nbsp; Return </b>
                    </a>
                   <?= $link ?>
                </li>
                <script type="text/javascript">
                    function url() {
                        var url = document.getElementById("url").value;
                        window.location.href = url;
                    }
                </script>
            </ul>
        </div>
    </div>
</nav>