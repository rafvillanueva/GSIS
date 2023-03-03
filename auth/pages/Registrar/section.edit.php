<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_section WHERE Section = '$id'");
    $row = mysqli_fetch_array($course);
    if($row['offer_at'] == "0"){
      $data = "Nursery";
    }elseif($row['offer_at'] == "1"){
      $data = "K-1";
    }elseif($row['offer_at'] == "2"){
      $data = "K-2";
    }elseif($row['offer_at'] == "G1"){
      $data = "Grade-1";
    }elseif($row['offer_at'] == "G2"){
      $data = "Grade-2";
    }elseif($row['offer_at'] == "G3"){
      $data = "Grade-3";
    }elseif($row['offer_at'] == "G4"){
      $data = "Grade-4";
    }elseif($row['offer_at'] == "G5"){
      $data = "Grade-5";
    }elseif($row['offer_at'] == "G6"){
      $data = "Grade-6";
    }
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_section WHERE Section = '$id'");
    header("location: section");
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
                <?php 
                    if(isset($_GET['id'])){
                         ?>
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
                                <span class="fa fa-angle-double-right"></span>
                                  <small>&nbsp; Section Details &nbsp;</small>
                            </div>
                            <hr>
                         <?php
                    }else{
                        ?>
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
                                <a href="course" style="text-decoration: none;">
                                    <small>&nbsp; Section &nbsp;</small>
                                </a>
                                <span class="fa fa-angle-double-right"></span>
                                  <small>&nbsp; Section Details &nbsp;</small>
                            </div>
                            <hr>
                         <?php
                    }
                ?>
                <div id="idsp"></div>
                <div class="panel panel-default">
                   <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="course">
                            <div class="form-group">
                                <?php
                                    if(isset($_GET['id'])){
                                ?>
                                <img src="assets/icons/Edit_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Edit Section</b>
                                <?php
                                }else{
                                    ?>
                                    <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add New Section</b>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" onsubmit="return false" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Building : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?= $row['building']; ?>" required placeholder="Enter Building name here..." id="building">
                                  <input type="hidden" value="<?= $row['ID']; ?>" required id="idx">
                                </div>
                              </div>                              
                              <div class="form-group">
                                <label class="control-label col-sm-2">Section : </label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" value="<?= $row['section']; ?>" required placeholder="Enter Section here.." id="section" >
                                </div>
                                <label class="control-label col-sm-2">Maximum Student : </label>
                                <div class="col-sm-4">
                                  <input type="text" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" value="<?= $row['max_stud']; ?>" required placeholder="Enter Maximum Population here.." id="max_stud">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-2">Offer at : </label>
                                <div class="col-sm-10">
                                  <select class="form-control" required id="year">
                                    <?php
                                      if(isset($_GET['id'])){
                                        ?>
                                        <option value="<?= $row['offer_at'] ?>"><?= $data ?></option>
                                        <option disabled value="">-- Select Grade Level --</option>
                                        <option value="0">Nursery</option>
                                        <option value="1">K-1</option>
                                        <option value="2">K-2</option>
                                        <option value="G1">Grade-1</option>
                                        <option value="G2">Grade-2</option>
                                        <option value="G3">Grade-3</option>
                                        <option value="G4">Grade-4</option>
                                        <option value="G5">Grade-5</option>
                                        <option value="G6">Grade-6</option>
                                        <?php
                                      }else{
                                        ?>
                                        <option selected disabled value="">-- Select Grade Level --</option>
                                        <option value="0">Nursery</option>
                                        <option value="1">K-1</option>
                                        <option value="2">K-2</option>
                                        <option value="G1">Grade-1</option>
                                        <option value="G2">Grade-2</option>
                                        <option value="G3">Grade-3</option>
                                        <option value="G4">Grade-4</option>
                                        <option value="G5">Grade-5</option>
                                        <option value="G6">Grade-6</option>
                                        <?php
                                      }
                                    ?>
                                    
                                  </select>
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?php 
                                        if(isset($_GET['id'])){
                                            echo '<button onclick="updatedata_section()" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>';
                                            ?>
                                                <a href="?del=<?php echo $_GET['id'] ?>" onclick="return confirm('Are you sure you want to remove this Course ?');" style="margin-right: 5px;" class="btn btn-danger pull-right"><span class="fa fa-trash-o"></span>&nbsp; Remove</a>
                                            <?php
                                        }else{
                                            echo '<button onclick="insertdata_section()" class="btn btn-primary pull-right"><span class="fa fa-plus"></span>&nbsp; Submit</button>';
                                        }
                                    ?>                                 
                                  <a href="section" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> List of Sections</a>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>