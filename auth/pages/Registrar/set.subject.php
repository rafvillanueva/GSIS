<?php 
$perrow = 50;
if(isset($_REQUEST['page'])){
    $page = $_REQUEST['page'];
     $p =  10 + $page * $perrow; 
}else{
    $page = 0;
    $p = 50;
}
$p = $page * $perrow;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <title>Registrar &#8211; Guadalupe Elementary School</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
         #xhover:hover{ background-color: #e1e1e1; cursor: pointer; }
    </style>
</head> 
<body>
    <div id="wrapper">
        <?php 
            include("assets/view/navbar.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
               <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                    <?php
                    if(isset($_GET['view'])){
                    ?>
                    <a href="set.subject.php" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <?php
                    }else{
                    ?>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <?php

                    }
                    ?>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-home"></span>
                        <small>&nbsp; Dashboard &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="section" style="text-decoration: none;">
                        <small>&nbsp; Section &nbsp;</small>
                    </a>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" autocomplete="off" action="section">
                            <div class="form-group">
                                <img src="assets/icons/Open_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Grade Level</b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px;">
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_GET['view'])){
                        ?>
                        <div class="panel-body">
                            <h2><b><?= "Grade Level :: " ?></b></h2>
                            <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Subject Code</th>
                                        <th>Subject Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num = 1;
                                    $view = $_GET['view'];
                                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE offer_at = '$view'");
                                    while($row = mysqli_fetch_array($rs)){
                                        ?>
                                        <tr>
                                            <td><?= $num ?></td>
                                            <td><?= $row['subjectCode'] ?></td>
                                            <td><?= $row['Description'] ?></td>
                                        </tr>
                                        <?php
                                        $num++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }else{
                        ?>  
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">-</th>
                                        <th>Grade Level</th>
                                        <th width="150"><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Nursery</td>
                                        <td>
                                            <a href="?view=0" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>K-1</td>
                                        <td>
                                            <a href="?view=1" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>K-2</td>
                                        <td>
                                            <a href="?view=2" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-1</td>
                                        <td>
                                            <a href="?view=G1" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-2</td>
                                        <td>
                                            <a href="?view=G2" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-3</td>
                                        <td>
                                            <a href="?view=G3" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-4</td>
                                        <td>
                                            <a href="?view=G4" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-5</td>
                                        <td>
                                            <a href="?view=G5" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="assets/icons/School Building_96px.png" height="32"></td>     
                                        <td>Grade-6</td>
                                        <td>
                                            <a href="?view=G6" class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    ?>
                </div>
        </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
</body>
</html>