<?php include("../../site-config.php"); ?>
<?php 

$rs = mysqli_query($conn, "SELECT * FROM tbl_gradeview WHERE ID = '1'");
$row = mysqli_fetch_array($rs);
if(isset($_GET['std'])){
  $id = $_GET['std'];
  $del = mysqli_query($conn, "DELETE FROM tbl_gradeview_specific WHERE Stud_id = '$id'");
  ?>
  <script type="text/javascript">
    alert("SUCCESS.");
    window.location.href = "grade-view";
  </script>
  <?php
}
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
    <title><?php echo $config['title'] ?></title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
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
                    <a href="students" style="text-decoration: none;">
                        <small>&nbsp; Grade View Restriction &nbsp;</small>
                    </a>
                </div>
                <hr>
                <div id="idsp"></div>
                <div class="col-md-5">
                <div class="panel panel-default">
                  <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="course">
                            <div class="form-group">
                                <img src="assets/icons/Defense_96px.png" height="45" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Grade Visibility</b>
                            </div>
                        </form>
                    </div>
                      <div class="panel-body">
                          <form class="form-horizontal" action="gradeview.php" method="POST" autocomplete="off">
                            <div class="form-group">
                              <label class="control-label col-sm-3">Term : </label>
                              <div class="col-sm-9">
                                <select class="form-control" name="term">
                                    <?php
                                      if($row['Role'] == ""){
                                          ?>
                                            <option value="1">Prelim</option>
                                            <option value="2">Midterm</option>
                                            <option value="3">Semi-Finals</option>
                                            <option value="4">Finals</option>
                                            <option value="0">Visible</option>
                                          <?php
                                      }elseif($row['Role'] == "1"){
                                          ?>
                                            <option selected value="1">Prelim</option>
                                            <option value="2">Midterm</option>
                                            <option value="3">Semi-Finals</option>
                                            <option value="4">Finals</option>
                                            <option value="0">Visible</option>
                                          <?php
                                      }elseif($row['Role'] == "2"){
                                          ?>
                                            <option value="1">Prelim</option>
                                            <option selected value="2">Midterm</option>
                                            <option value="3">Semi-Finals</option>
                                            <option value="4">Finals</option>
                                            <option value="0">Visible</option>
                                          <?php
                                      }elseif($row['Role'] == "3"){
                                          ?>
                                            <option value="1">Prelim</option>
                                            <option value="2">Midterm</option>
                                            <option selected value="3">Semi-Finals</option>
                                            <option value="4">Finals</option>
                                            <option value="0">Visible</option>
                                          <?php
                                      }elseif($row['Role'] == "4"){
                                          ?>
                                            <option value="1">Prelim</option>
                                            <option value="2">Midterm</option>
                                            <option value="3">Semi-Finals</option>
                                            <option selected value="4">Finals</option>
                                            <option value="0">Visible</option>
                                          <?php
                                      }else{
                                          ?>
                                            <option value="1">Prelim</option>
                                            <option value="2">Midterm</option>
                                            <option value="3">Semi-Finals</option>
                                            <option value="4">Finals</option>
                                            <option selected value="0">Visible</option>
                                          <?php
                                      }
                                    ?>                                      
                                </select>
                              </div>
                            </div>
                            <div class="form-group"> 
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="Submit" name="btn_save" class="btn btn-primary pull-right">Submit</button>
                              </div>
                            </div>
                          </form>
                      </div>
                    </div>
                </div>
                <div class="col-md-7">
                  <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="course">
                            <div class="form-group">
                                <img src="assets/icons/User Shield_96px.png" height="45" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Specific Student</b>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="gradeview.php" method="POST" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-3">Student ID : </label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="std">
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="Submit" name="btn_save_sp" class="btn btn-primary pull-right">Submit</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <?php 
                        if(isset($_POST['btn_save'])){
                            $role = $_POST['term'];
                            $rs = mysqli_query($conn, "UPDATE tbl_gradeview SET Role = '$role'");
                            ?> <script type="text/javascript"> window.location.href = "gradeview.php"; </script> <?php   
                        }
                    ?>
                </div>
            </div>
            <div class="container-fluid">
              <?php 
                if(isset($_POST['btn_save_sp'])){
                    $std = $_POST['std'];
                    $ver = mysqli_query($conn,"SELECT * FROM tbl_gradeview_specific INNER JOIN tbl_studentrecord ON tbl_gradeview_specific.Stud_id = tbl_studentrecord.Stud_id WHERE tbl_studentrecord.Stud_id = '$std'");                    
                    $num = mysqli_num_rows($ver);
                    if($num == 0){
                       $rs = mysqli_query($conn, "INSERT INTO tbl_gradeview_specific(Stud_id) VALUES('$std')");
                      ?>
                        <div class="alert alert-success"><span class="fa fa-check"></span> Student ID # : <b><?= $std ?></b> has been added.</div>
                      <?php
                    }else{
                      ?>
                        <div class="alert alert-danger"><span class="fa fa-warning"></span> Student ID # : <b><?= $std ?></b> is already exist.</div>
                      <?php 
                    }                      
                }
            ?>
              <hr>
              <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                    <form class="form-inline" method="POST" action="course">
                        <div class="form-group">
                            <img src="assets/icons/Open_96px.png" height="45" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">List of Student Restricted to View Final Grades.</b>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                          <td><b>Student ID # </b></td>
                          <td><b>Name</b></td>
                          <td></td>
                          <td style="width: 10px;"></td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $specific = mysqli_query($conn, "SELECT * FROM tbl_gradeview_specific");
                            while($s_row = mysqli_fetch_array($specific)){
                              ?>                       
                              <tr>
                                <td><?= $s_row[1] ?></td>
                                <?php
                                $idx = $s_row[1];
                                $std = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$idx'");
                                $std_row = mysqli_fetch_array($std);
                                ?>
                                <td><?= $std_row[3] . ", " . $std_row[2] . " " . $std_row[4] ?></td>
                                <td></td>
                                <td><center><a href="?std=<?= $s_row[1] ?>" class="btn btn-default btn-sm"> Allow</a></center></td>
                              </tr>
                              <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</body>

</html>
