<?php
######################################
# ------- Global Information ------- #
######################################
include('../../../config/db.php');    #
######################################
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Guadalupe Elementary School</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body>
<?php include("assets/view/main-navbar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 10px;">
            <a href="Dashboard" style="text-decoration: none;">
                <span class="fa fa-angle-double-left"></span>
                <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp; </small>
            </a>
            <a href="Dashboard" style="text-decoration: none;">
                <span class="fa fa-home"></span>
                <small>&nbsp; Account Management &nbsp;</small>
            </a>
            <span class="fa fa-angle-double-right"></span>
            <a href="#" style="text-decoration: none;">
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
                    
                    $update = mysqli_query($conn, "UPDATE tbl_accounts SET Password = '$password' WHERE Username = '$user'");
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
