<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_books WHERE subjectCode = '$id'");
    $row = mysqli_fetch_array($course);
}
?>
<?php
if(isset($_POST['newbook'])){
	$name = $_POST['bookname'];
	$description = $_POST['bookDesc']; 
  $price = $_POST['bookprice'];
	$level = $_POST['zlevel'];

	$rs = mysqli_query($conn, "INSERT INTO tbl_books VALUES(NULL,'$name','$description','$price','$level')");
	?>
	<script type="text/javascript">
		alert("New Book Added");
		window.location.href = "books.php";
	</script>
	<?php
}
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    $rs = mysqli_query($conn, "SELECT * FROM tbl_books WHERE ID = '$id'");
    $rowz = mysqli_fetch_array($rs);
    if($rowz['s_level'] == "0"){
      $data = "Nursery";
    }elseif($rowz['s_level'] == "1"){
      $data = "K-1";
    }elseif($rowz['s_level'] == "1"){
      $data = "K-2";
    }elseif($rowz['s_level'] == "G1"){
      $data = "Grade-1";
    }elseif($rowz['s_level'] == "G2"){
      $data = "Grade-2";
    }elseif($rowz['s_level'] == "G3"){
      $data = "Grade-3";
    }elseif($rowz['s_level'] == "G4"){
      $data = "Grade-4";
    }elseif($rowz['s_level'] == "G5"){
      $data = "Grade-5";
    }elseif($rowz['s_level'] == "G6"){
      $data = "Grade-6";
    }
 }
 if(isset($_GET['del'])){
  $id = $_GET['del'];
  $rs = mysqli_query($conn, "DELETE FROM tbl_books WHERE ID = '$id'");
  ?>
  <script type="text/javascript">
    alert("Book Removed!");
    window.location.href = "books.php";
  </script>
  <?php
}
if(isset($_POST['edit-button'])){
  $id = $_POST['idx'];
  $name = $_POST['bookname'];
  $descr = $_POST['bookDesc'];
  $price = $_POST['bookprice'];
  $level = $_POST['zlevel'];
  $rs = mysqli_query($conn, "UPDATE tbl_books SET s_book = '$name', s_description = '$descr', s_price = '$price', s_level = '$level' WHERE ID = '$id'");
  ?>
  <script type="text/javascript">
    alert("Book Updated!");
    window.location.href = "books.new.php?id=<?= $id ?>";
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
                                  <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add Book</b>
                                  <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="books.new.php" method="POST" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Book Name : </label>
                                <?php
                                    if(!isset($_GET['id'])){
                                  ?>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $rowz['s_book'] ?>" required placeholder="Enter Book name" id="subject" name="bookname">
                                  </div>
                                <?php 
                                  }else{
                                    ?>
                                    <div class="col-sm-10">
                                      <input type="hidden" value="<?=$_GET['id'] ?>" required name="idx">
                                      <input type="text" class="form-control" value="<?= $rowz['s_book'] ?>" required placeholder="Enter Book name" id="subject" name="bookname">
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Description : </label>
                                <div class="col-sm-10">
                                  <textarea rows="5" name="bookDesc" class="form-control" required placeholder="Write the Description here.." id="description"><?= $rowz['s_description'] ?></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Price : </label>
                                <div class="col-sm-10">
                                  <input class="form-control" name="bookprice" value="<?= $rowz['s_price'] ?>" required placeholder="Book Price" id="description">
                                </div>
                              </div>
                              <div class="form-group">
                              <label class="control-label col-sm-2" for="email"> Grade level : </label>
                                 <div class="col-sm-10">
                                    <select class="form-control" required name="zlevel">
                                      <?php
                                      if(isset($_GET['id'])){
                                        ?>
                                        <option value="<?= $rowz['s_level'] ?>"><?= $data ?></option>
                                        <?php
                                      }
                                      ?>
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
                                  </div>
                                </div>                                
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                        <button type="submit" name="edit-button" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>                                        
                                      <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this book ?');" class="btn btn-danger pull-right" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a>
                                      <?php
                                    }else{
                                      ?>
                                        <button type="submit" name="newbook" class="btn btn-primary pull-right"><span class="fa fa-plus"></span>&nbsp; Submit </button>
                                        <a style="margin-right: 8px;" href="books.php" name="add-button" class="btn btn-default pull-right"><span class="fa fa-angle-double-left "></span>&nbsp; Back </a>
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
