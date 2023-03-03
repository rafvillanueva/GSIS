<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
$fees = mysqli_query($conn, "SELECT * FROM tbl_tuition WHERE ID = '1'");
$f_row = mysqli_fetch_array($fees);
$fees2 = mysqli_query($conn, "SELECT * FROM tbl_tuition WHERE ID = '2'");
$f_row2 = mysqli_fetch_array($fees2);

if(isset($_POST['k-button'])){
	$k_fees = $_POST['gradeschoolz'];
  $rs = mysqli_query($conn, "UPDATE tbl_tuition SET s_tuition = '$k_fees' WHERE ID = '1'");
	?>
	<script type="text/javascript">
		alert("Tuition Updated!");
		window.location.href = "tuition.php";
	</script>
	<?php
}
if(isset($_POST['g-button'])){

  $g_fees = $_POST['gradeschool'];
  $rs = mysqli_query($conn, "UPDATE tbl_tuition SET s_tuition = '$g_fees' WHERE ID = '2'");
  ?>
  <script type="text/javascript">
    alert("Tuition Updated!");
    window.location.href = "tuition.php";
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
    <title>Guadalupe Elementary School</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                        <small>&nbsp; Book &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                      <small>&nbsp; Book Details &nbsp;</small>
                </div>
                <hr>
                <div id="idsp"></div>
                <div class="panel panel-default">
                  <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="course">
                            <div class="form-group">
                               <?php
                                    if(isset($_GET['id'])){
                                ?>
                                <img src="assets/icons/Edit_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Edit Subject</b>
                                <?php
                                }else{
                                  ?>
                                  <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Tuition Fees</b>
                                  <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="tuition.php" method="POST" autocomplete="off">
                              <h1><center><b>Tution for K1 - K2</b></center></h1>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Price : </label>
                                <div class="col-sm-10">
                                  <input class="form-control" name="gradeschoolz" value="<?= $f_row['s_tuition'] ?>" required placeholder="Tution fee" id="description">
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                        <button onclick="editdata_subject()" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>                                        
                                      <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this Subject ?');" class="btn btn-danger pull-right" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a>
                                      <?php
                                    }else{
                                      ?>
                                        <button type="submit" name="k-button" class="btn btn-success pull-right"><span class="fa fa-check"></span>&nbsp; Save Changes </button>
                                      <?php
                                    }
                                  ?>
                                </div>
                              </div>

                            </form>
                            <br>
                            <hr>
                            <br>
                            <form class="form-horizontal" action="tuition.php" method="POST" autocomplete="off">
                              <h1><center><b>Tution for Grade 1 - Grade 6</b></center></h1>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Price : </label>
                                <div class="col-sm-10">
                                  <input class="form-control" name="gradeschool" value="<?= $f_row2['s_tuition'] ?>" required placeholder="Tution fee" id="description">
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                        <button onclick="editdata_subject()" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>                                        
                                      <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this Subject ?');" class="btn btn-danger pull-right" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a>
                                      <?php
                                    }else{
                                      ?>
                                        <button type="submit" name="g-button" class="btn btn-success pull-right"><span class="fa fa-check"></span>&nbsp; Save Changes </button>
                                      <?php
                                    }
                                  ?>
                                </div>
                              </div>

                            </form>
                        </div>
                    </div>
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
