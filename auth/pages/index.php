<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Guadalupe Elementary School</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/site-content/admin/favicon.png"/>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .btn-kent {
            border: none;
            background: url('img/download1.png') no-repeat top left;    
            padding: 2px 8px;
        }
        .btn-kent:hover {
            background-color: #63A1A7 !important;
            border-bottom: 5px solid rgb(67, 121, 127) !important;
        }
    </style>
</head>

<body>
<?php 
    include("navbar.php"); /* Navigation */
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div style="background-color: #e5e5e5; padding: 9px;">
            <span class="fa fa-volume-up"></span> Hello! and Welcome, <b><?= $row_admn['a_name'] ?></b> as [ <b><?= $row_admn['Level'] ?></b> ]. <?= $msg ?>
        </div>
        <hr>
        <div class="row1">
            <div style="background: url('img/download.png') no-repeat top left; border-radius: 1px; padding: 8px; background-color: #63A1A7; border-bottom: 5px solid rgb(67, 121, 127); color: #fff; letter-spacing: 2px;">
               <h4><span class="fa fa-gear"></span> Administrator :: Modules</h4>
            </div>
            <br>
            <div class="pull-righ1t">
                <a href="accounts" style="letter-spacing: 1px; margin-right: 18px; width: 100%; background-color: #453F4A; border-bottom: 5px solid #2D2A31;  margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-danger btn-kent">
                    <div class="pull-left">
                        <img src="img/user.png" height="55"> User Accounts Management
                    </div>
                </a>
                <br>
                <a href="Registrar/registrar" style="letter-spacing: 1px; margin-right: 18px;  width: 100%; background-color: #453F4A; border-bottom: 5px solid #2D2A31; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-danger btn-kent">
                    <div class="pull-left">
                        <img src="img/Admin.png" height="55"> Record Administration Facility
                    </div>
                </a>
                <br>
                <a href="password" style="letter-spacing: 1px; margin-right: 18px; width: 100%; background-color: #453F4A; border-bottom: 5px solid #2D2A31;  margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-danger btn-kent">
                    <div class="pull-left">
                        <img src="Registrar/assets/icons/Key_96px.png" height="55"> Change Password
                    </div>
                </a>
                <hr>
            </div>
        </div> 
    </div>
</div>
        
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
