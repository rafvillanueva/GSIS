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
                    <a href="Dashboard" style="text-decoration: none;">
                        <span class="fa fa-angle-double-left"></span>
                        <small>&nbsp; <b>Return</b> &nbsp; :: &nbsp;</small>
                    </a>
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
                                <img src="assets/icons/Open_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Sections</b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px;">
                            <div class="form-group">
                                
                                <select class="form-control" id="getgradez" onchange="search()">
                                  <option disabled selected value="">-- ACADEMIC YEAR --</option>
                                  <?php
                                  $qq = "SELECT DISTINCT(s_year) FROM tbl_subjectsenrolled";
                                  $qq_query = mysqli_query($conn, $qq);
                                  while($qq_row = mysqli_fetch_array($qq_query)){
                                    ?>
                                    <option><?= $qq_row['s_year'] ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                                <script type="text/javascript">
                                  function search() {
                                    var search_query = document.getElementById("getgradez").value;
                                    window.location.href = "logs.php?q=" + search_query;
                                  }
                                </script>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th width="200">Academic Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['btn-search'])){
                                        $val = $_POST['val-search'];
                                        if(empty($val)){
                                            ?>
                                            <script type="text/javascript">window.location.href = "section"</script>
                                            <?php
                                        }
                                        $students = "SELECT * FROM tbl_section WHERE Section like '%$val%' OR Building like '%$val%' ORDER BY ID ASC LIMIT 0,$perrow";
                                        $student_query = mysqli_query($conn, $students);
                                        while($row = mysqli_fetch_array($student_query)){
                                            ?>
                                            <tr onclick="window.location='edit-sections?id=<?= $row[2] ?>';" id="xhover">
                                                 <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/School Building_96px.png" height="32">        
                                                    <?= $row['building'] ?>
                                                </td>
                                                <td><?= $row['section'] ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }else{
                                        if(isset($_GET['q'])){
                                            $sec = $_GET['q'];
                                            $rs = mysqli_query($conn, "SELECT DISTINCT(Section),(s_year) FROM tbl_subjectsenrolled WHERE s_year = '$sec' ORDER BY Section ASC LIMIT $p,$perrow");
                                            
                                            while($row = mysqli_fetch_array($rs)){
                                                ?>
                                                <tr onclick="window.location='logs_info.php?sec=<?= $row['Section'] ?>&acad=<?= $sec ?>';" id="xhover">
                                                    <td style="padding: 0px; padding-left: 15px;">
                                                        <img src="assets/icons/School Building_96px.png" height="32">        
                                                        <?= $row['Section'] ?>
                                                    </td>
                                                    <td><?= $row['s_year'] ?></td>
                                                </tr>
                                                <?php
                                            }
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
                        <script type="text/javascript">window.location.href = "section"</script>
                        <?php
                    }
                    $total = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode like '%$val%' OR Description like '%$val%' ORDER BY ID DESC LIMIT $p,$perrow");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                    }
                }else{
                    $total = mysqli_query($conn, "SELECT * FROM tbl_section");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="section?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
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