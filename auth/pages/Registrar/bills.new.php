<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);

if(isset($_POST['add-button'])){
  $b_name = $_POST['b_name'];
	$b_price = $_POST['b_price'];
  $rs = mysqli_query($conn, "INSERT INTO tbl_billing VALUES(NULL,'$b_name','$b_price')");
	?>
	<script type="text/javascript">
		alert("New Billing Added!");
		window.location.href = "bills.new.php";
	</script>
	<?php
}
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    $rs = mysqli_query($conn, "SELECT * FROM tbl_billing WHERE ID = '$id'");
    $rowz = mysqli_fetch_array($rs);
 }

  if(isset($_POST['edit-button'])){
    $id = $_POST['b_id'];
    $name = $_POST['b_name'];
    $price = $_POST['b_price'];
    $rs = mysqli_query($conn, "UPDATE tbl_billing SET b_name = '$name', b_price = '$price' WHERE ID = '$id'");
  ?>
  <script type="text/javascript">
    alert("Billing Updated!");
    window.location.href = "bills.php";
  </script>
  <?php
 }
if(isset($_GET['del'])){
  $id = $_GET['del'];
  $rs = mysqli_query($conn, "DELETE FROM tbl_billing WHERE ID = '$id'");
  ?>
  <script type="text/javascript">
    alert("Billing Removed!");
    window.location.href = "bills.php";
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
                    <a href="bills.php" style="text-decoration: none;">
                        <small>&nbsp; Bills &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                      <small>&nbsp; Add Billing &nbsp;</small>
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
                                  <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add Billing</b>
                                  <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="bills.new.php" method="POST" autocomplete="off">
                              <br>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Billing name : </label>
                                <div class="col-sm-10">
                                  <input class="form-control" name="b_name" value="<?= $rowz['1'] ?>" required placeholder="Enter Billing name here.." id="description">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Price : </label>
                                <div class="col-sm-10">
                                  <input class="form-control" name="b_price" value="<?= $rowz['2'] ?>" required placeholder="Enter price here.." id="description">
                                </div>
                              </div>
                              <hr>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                      <input name="b_id" value="<?= $rowz['0'] ?>" required type="hidden">
                                      <button type="submit" name="edit-button" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>                                        
                                      <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this billing ?');" class="btn btn-danger pull-right" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a>
                                      <a style="margin-right: 8px;" href="bills.php" name="add-button" class="btn btn-default pull-right"><span class="fa fa-angle-double-left "></span>&nbsp; Back </a>
                                      <?php
                                    }else{
                                      ?>
                                        <button type="submit" name="add-button" class="btn btn-success pull-right"><span class="fa fa-check"></span>&nbsp; Add Bills </button>
                                        <a style="margin-right: 8px;" href="bills.php" name="add-button" class="btn btn-default pull-right"><span class="fa fa-angle-double-left "></span>&nbsp; Back </a>
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
