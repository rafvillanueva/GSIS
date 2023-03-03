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
    <title>Guadalupe &#8211; Elementary School</title>
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
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-home"></span>
                        <small>&nbsp; Dashboard &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <a href="faculty" style="text-decoration: none;">
                        <small>&nbsp; Faculty &nbsp;</small>
                    </a>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="faculty">
                            <div class="form-group">
                                <img src="assets/icons/User Folder_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Faculty Member</b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px;">
                            <div class="form-group">
                                <input type="text" name="val-search" placeholder="Search here.." class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn-search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-striped ">
                            <thead>
                                <tr>
                                    <th>Faculty Name</th>
                                    <th>ID Number</th>
                                    <th>Status</th>
                                    <th><center>Post Graduate Degree</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['btn-search'])){
                                        $val = $_POST['val-search'];
                                        if(empty($val)){
                                            ?>
                                            <script type="text/javascript">window.location.href = "faculty"</script>
                                            <?php
                                        }
                                        $students = "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$val' OR (firstName like '%$val%' OR lastName like '%$val%' OR middleName like '%$val%' OR Status like '%$val%' OR UnderGrad_Degree like '%$val%') ORDER BY ID DESC LIMIT 0,$perrow";
                                        $student_query = mysqli_query($conn, $students);
                                        while($row = mysqli_fetch_array($student_query)){
                                            ?>
                                            <tr onclick="window.location='faculty-edit?id=<?= $row[1] ?>';" id="xhover">
                                                <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/School Director_96px.png" height="32">        
                                                    <?= $row['lastName'].' , ' . $row['firstName'] .' ' .$row['middleName'] ?>
                                                </td>

                                                <td><?= $row[1] ?></td>
                                                <td><?= $row['Status'] ?></td>
                                                <td><?= $row['PostGrad_Degree'] ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }else{
                                        
                                        $rs = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo ORDER BY lastName ASC LIMIT $p,$perrow");
                                        while($row = mysqli_fetch_array($rs)){
                                            ?>
                                            <tr onclick="window.location='faculty-edit?id=<?= $row[1] ?>';" id="xhover">
                                                <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/School Director_96px.png" height="32">        
                                                    <?= $row['lastName'].' , ' . $row['firstName'] .' ' .$row['middleName'] ?>
                                                </td>

                                                <td><?= $row[1] ?></td>
                                                <td><?= $row['Status'] ?></td>
                                                <td><?= $row['PostGrad_Degree'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php
                if(isset($_POST['btn-search'])){
                    $val = $_POST['val-search'];
                    if(empty($val)){
                        ?>
                        <script type="text/javascript">window.location.href = "faculty"</script>
                        <?php
                    }
                    $total = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$val' OR (firstName like '%$val%' OR lastName like '%$val%' OR middleName like '%$val%' OR Status like '%$val%' OR UnderGrad_Degree like '%$val%') ORDER BY ID DESC LIMIT $p,$perrow");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="faculty?page=<?= $i ?>" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="faculty?page=<?= $i ?>" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                    }
                }else{ 
                    $total = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="faculty?page=<?= $i ?>" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="faculty?page=<?= $i ?>" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                        
                    }
                }
                ?>                
                <br><br><br>
        </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
</body>
</html>