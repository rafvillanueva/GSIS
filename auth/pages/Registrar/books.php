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
                    <a href="subjects" style="text-decoration: none;">
                        <small>&nbsp; Subjects &nbsp;</small>
                    </a>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" autocomplete="off" action="subjects">
                            <div class="form-group">
                                <img src="assets/icons/Open_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Billing</b>
                            </div>
                            <div class="form-group pull-right" style="padding: 10px;">
                            <div class="form-group">                                
                                <select class="form-control" id="getgradez" onchange="search()">
                                  <option disabled selected value="">-- LEVEL --</option>
                                  <option value="%%">All</option>
                                  <option value="0">Nursery</option>
                                  <option value="1">K-1</option>
                                  <option value="2">K-2</option>
                                  <option value="G1">Grade-1</option>
                                  <option value="G2">Grade-2</option>
                                  <option value="G3">Grade-3</option>
                                  <option value="G4">Grade-4</option>
                                  <option value="G5">Grade-5</option>
                                  <option value="G6">Grade-6</option>
                                </select>
                                <B style="letter-spacing: 2px;">&nbsp; OR &nbsp;</B>
                                <input type="text" name="val-search" placeholder="Search here.." class="form-control">
                                <script type="text/javascript">
                                  function search() {
                                    var search_query = document.getElementById("getgradez").value;
                                    window.location.href = "books.php?q=" + search_query;
                                  }
                                </script>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn-search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                <a href="books.new.php" class="btn btn-success"><i class="fa fa-plus"></i> Add Books</a>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-striped ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Book Offer at</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['btn-search'])){
                                        $val = $_POST['val-search'];
                                        if(empty($val)){
                                            ?>
                                            <script type="text/javascript">window.location.href = "books.php"</script>
                                            <?php
                                        }
                                        $students = "SELECT * FROM tbl_books WHERE s_book like '%$val%' OR s_price like '%$val%' ORDER BY s_level DESC LIMIT 0,$perrow";
                                        $student_query = mysqli_query($conn, $students);
                                        while($row = mysqli_fetch_array($student_query)){
                                            ?>
                                            <tr onclick="window.location='books.new.php?id=<?= $row[0] ?>';" id="xhover">
                                                <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/Elective_96px.png" height="32">        
                                                    <?= $row['s_book'] ?>
                                                </td>

                                                <td><?= $row['s_level'] ?></td>
                                                <td><?= $row['s_description'] ?></td>
                                                <td>???. <?= number_format($row['s_price'],2) ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }else{
                                        if(isset($_GET['q'])){
                                            $val = $_GET['q'];
                                            $rs = mysqli_query($conn, "SELECT * FROM tbl_books WHERE s_level like '$val' ORDER BY s_level ASC LIMIT $p,$perrow");
                                        }else{
                                            $rs = mysqli_query($conn, "SELECT * FROM tbl_books ORDER BY s_level ASC LIMIT $p,$perrow");
                                        }

                                        while($row = mysqli_fetch_array($rs)){
                                            if($row['s_level'] == "0"){
                                              $data = "Nursery";
                                            }elseif($row['s_level'] == "1"){
                                              $data = "K-1";
                                            }elseif($row['s_level'] == "2"){
                                              $data = "K-2";
                                            }elseif($row['s_level'] == "G1"){
                                              $data = "Grade-1";
                                            }elseif($row['s_level'] == "G2"){
                                              $data = "Grade-2";
                                            }elseif($row['s_level'] == "G3"){
                                              $data = "Grade-3";
                                            }elseif($row['s_level'] == "G4"){
                                              $data = "Grade-4";
                                            }elseif($row['s_level'] == "G5"){
                                              $data = "Grade-5";
                                            }elseif($row['s_level'] == "G6"){
                                              $data = "Grade-6";
                                            }
                                            ?>
                                            <tr onclick="window.location='books.new.php?id=<?= $row[0] ?>';" id="xhover">
                                                <td style="padding: 0px; padding-left: 15px;">
                                                    <img src="assets/icons/Elective_96px.png" height="32">        
                                                    <?= $row['s_book'] ?>
                                                </td>
                                                <td><?= $data ?></td>
                                                <td><?= $row['s_description'] ?></td>
                                                <td>???. <?= number_format($row['s_price'],2) ?></td>
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
                        <script type="text/javascript">window.location.href = "subjects"</script>
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
                             <a href="subjects?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="subjects?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
                                <?php 
                            }
                            
                        }
                    }
                }else{
                    $total = mysqli_query($conn, "SELECT * FROM tbl_subjects");
                    $count = mysqli_num_rows($total);
                    $next = $page + 1;
                    $limit = $count / $perrow;
                    $limit = ceil($limit);
                    for($i=1;$i<=$limit;$i++){
                        if($page == $i){
                            ?>
                             <a href="subjects?page=<?= $i ?>" name="btn-search" class="btn btn-primary"><?= $i ?></a>
                            <?php
                        }else{
                             if($limit != 1){
                                ?>
                                <a href="subjects?page=<?= $i ?>" name="btn-search" class="btn btn-default"><?= $i ?></a>
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