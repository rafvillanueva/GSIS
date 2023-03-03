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
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            <img src="../../img/vineyard.png">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Content Menu</small></i><br><br>
                    <a href="../current-classes">
                        <img src="../controls/icons/Classroom_96px.png" height="32" style="position: relative;">
                        <b> Current Classes</b>
                    </a>
                    <!-- <a href="../all-classes">
                        <img src="../controls/icons/Books_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a> -->
                    <a href="../term-and-semestral">
                        <img src="../controls/icons/Scorecard_96px.png" height="32" style="position: relative;">
                        <b> All Records</b>
                    </a>
                    <!-- <a href="../absences/main">
                        <img src="../controls/icons/Decision_96px.png" height="32" style="position: relative;">
                        <b> Unexcused Absences</b>
                    </a> -->
                    <!-- <a href="../import/main">
                        <img src="../controls/icons/Microsoft Excel_96px.png" height="32" style="position: relative;">
                        <b> Import Scores (Excel)</b>
                    </a> -->
                    <a href="../password">
                        <img src="../controls/icons/Password_96px.png" height="32" style="position: relative;">
                        <b> Change Password</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="../controls/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b> Logout</b>
                    </a>
                </li>
                <li>
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