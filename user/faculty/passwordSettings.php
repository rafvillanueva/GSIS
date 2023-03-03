<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
######################################
?>
<?php
ob_start();
session_start();
if(isset($_SESSION['user']) == ""){
    ?><script type="text/javascript">window.location.href = "../../"</script><?php
}
$user = $_SESSION['user'];
$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
$row_admn = mysqli_fetch_array($rs_adm);

$rs_info = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$user'");
$row_info = mysqli_fetch_array($rs_info);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vineyard College</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/site-content/admin/favicon.png"/>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body>
<!--  -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
    <div class="navbar-header">
        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            <img src="controls/icons/fav.png" height="85">
        </a>
    </div><br><br><br><br>

    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Content Menu</small></i>
                    <hr>
                    <a href="../faculty">
                        <img src="controls/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="controls/icons/Shutdown_96px.png" height="32" style="position: relative;">
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
<!--  -->
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="main" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="password" style="text-decoration: none;">
                <small>&nbsp; Change Password &nbsp;</small>
            </a>
        </div>
        <hr>
        <?php 
            if(isset($_POST['btn_save'])){
            $new = $_POST['t_new'];
            $cur = $_POST['c_new'];
            $confirm = $_POST['t_confirm'];
            $password_curr = hash("sha256", $cur);
            $password = hash("sha256", $new);
            $rs = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Password = '$password_curr' AND Username = '$user'");
            if(mysqli_num_rows($rs) == 1){
                if($new != $confirm){
                echo '
                <div class="alert alert-danger">
                  <strong><span class="fa fa-warning"></span> Warning!</strong> Password not match.
                </div>
                ';
                }else{
                    
                    $update = mysqli_query($conn, "UPDATE tbl_accounts SET Password = '$password' WHERE Username = '$id'");
                    echo '
                    <div class="alert alert-success">
                      <strong><span class="fa fa-check"></span> Susscess!</strong> Password Changed Completed.
                    </div>
                    ';
                }
            }else{
                echo '
                    <div class="alert alert-danger">
                      <strong><span class="fa fa-warning"></span> Error!</strong> Current Password Invalid. Please try again.
                    </div>
                    ';
            }
            
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Password
            </div>
            <div class="panel-body">
                <form method="POST" action="?panel" autocomplete="off">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <b class="pull-right" style="letter-spacing: 1px; margin-top: 5px;">Current Password :</b>
                        </div>
                        <div class="col-lg-9">
                            <input type="password"  required class="form-control" style="padding-right: 0px;" name="c_new" placeholder="Enter Current Password here..">
                        </div>
                    </div>
                    <br><br>
                    <hr>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <b class="pull-right" style="letter-spacing: 1px; margin-top: 5px;">New Password :</b>
                        </div>
                        <div class="col-lg-9">
                            <input type="password"  required class="form-control" style="padding-right: 0px;" name="t_new" placeholder="Enter New Password here..">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <b class="pull-right" style="letter-spacing: 1px; margin-top: 5px;">Confirm Password :</b>
                        </div>
                        <div class="col-lg-9">
                            <input type="password" required class="form-control" style="padding-right: 0px;" name="t_confirm" placeholder="Enter Confirm Password here..">
                        </div>
                    </div>
                    <br><hr>
                    <div class="form-group">                     
                        <div class="pull-right">
                            <button class="btn btn-primary" name="btn_save" style="margin-right: 15px;"> Save &nbsp; <span class="fa fa-save"></span></button>
                        </div>
                    </div>
                                   
                        
                        <!--  -->
                    </form>
                </div>                
            </div>
        </div>
        <hr>
    </div>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
