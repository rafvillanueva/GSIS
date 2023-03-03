<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['enroll'])){
    $ide = $_GET['enroll'];
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_facultyloads WHERE ID = '$ide'");
    $course = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE ID = '$id'");
    $row = mysqli_fetch_array($course);
    header("location: faculty-edit?id=".$id);
}elseif(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_facultyinfo WHERE Fac_Id = '$id'");
    $row = mysqli_fetch_array($course);
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_facultyinfo WHERE Fac_Id = '$id'");
    $sql = mysqli_query($conn, "DELETE FROM tbl_facultyloads WHERE Fac_Id = '$id'");
    header("location: faculty");
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
    <title>Guadalupe &#8211; Elementary School</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <?php 
            include("assets/view/navbar-fac-a.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php 
                    if(isset($_GET['id'])){
                        ?>
                           <br>
                            <div style="background-color: #e5e5e5; padding: 10px;">
                                <a href="faculty" style="text-decoration: none;">
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
                                <span class="fa fa-angle-double-right"></span>
                                <small>&nbsp; Faculty Details &nbsp;</small>
                            </div>
                            <hr>
                        <?php
                    }else{
                        ?>
                         <br>
                            <div style="background-color: #e5e5e5; padding: 10px;">
                                <a href="faculty" style="text-decoration: none;">
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
                                <span class="fa fa-angle-double-right"></span>
                                <small>&nbsp; Add New Faculty &nbsp;</small>
                            </div>
                            <hr>
                        <?php
                    }
                ?>
                <div id="idsp"></div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="faculty">
                            <div class="form-group">
                                 <?php
                                    if(isset($_GET['id'])){
                                ?>
                                <img src="assets/icons/Info Squared_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Faculty Information</b>
                                <?php
                                }else{
                                  ?>
                                  <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add New Faculty</b>
                                  <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" onsubmit="return false" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Faculty ID # : </label>
                                <div class="col-sm-10">
                                    <?php 
                                        if(isset($_GET['id'])){
                                             ?>
                                            <input type="text" class="form-control" required readonly placeholder="Enter Faculty ID #" id="fac_id" value="<?php echo $row['Fac_Id']; ?>" style="width: 25%;">
                                            <?php
                                        }else{
                                            ?>
                                            <input type="text" class="form-control" required readonly placeholder="Enter Faculty ID #" id="fac_id" value="F<?php echo $fac_id; ?>" style="width: 25%;">
                                            <?php
                                        }
                                    ?>                                 
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Faculty Name : </label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" value="<?php echo $row['firstName']; ?>" required placeholder="First Name.." id="firstname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" value="<?php echo $row['lastName']; ?>" required placeholder="Last Name.." id="lastname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" value="<?php echo $row['middleName']; ?>" required placeholder="Middle Name.." id="middlename">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Post-Grad. Degree : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?php echo $row['PostGrad_Degree']; ?>" required placeholder="Enter here.." id="postg">
                                </div>
                              </div>                              
                              <div class="form-group">
                                <label class="control-label col-sm-2">Under-Grad. Degree : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?php echo $row['UnderGrad_Degree']; ?>" required placeholder="Enter here.." id="underg">
                                </div>
                              </div>
                              <div class="form-group">
                               <label class="control-label col-sm-2">Status : </label>
                                <div class="col-sm-10">
                                    <select class="form-control" required id="status">
                                        <option selected disabled value="">-- Select Status --</option>
                                        <?php 
                                            if(isset($_GET['id'])){
                                                echo '<option selected>'.$row['Status'].'</option>';
                                            }
                                        ?>
                                        <option>Full-Time</option>
                                        <option>Part-Time</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?php 
                                        if(isset($_GET['id'])){
                                            ?>
                                                <button onclick="updatedata()" class="btn btn-default">
                                                    <i class="fa fa-save"></i>&nbsp; Save Changes
                                                </button>
                                                 <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this Faculty ?');" class="btn btn-default" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a> 
                                                <a href="#" class="btn btn-default pull-right" data-toggle="modal" data-target="#subject_load">
                                                    <i class="fa fa-eye"></i>
                                                     View Load Subject
                                                 </a>
                                                   <a href="faculty-load?Faculty=<?php echo $row['Fac_Id'] ?>" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-plus"></i> Add Load Subject</a>&nbsp;
                                            <?php
                                        }else{
                                            ?>
                                                <button onclick="insertdata()" class="btn btn-primary pull-right"><i class="fa fa-check"></i> &nbsp;Submit</button>
                                            <?php
                                        }
                                    ?>                                 
                                  
                                </div>
                              </div>
                            </form>
                            <script type="text/javascript">
                                    function insertdata(){
                                    var id = document.getElementById("fac_id").value;
                                    var fname = document.getElementById("firstname").value;
                                    var lname = document.getElementById("lastname").value;
                                    var mname = document.getElementById("middlename").value;
                                    var postg = document.getElementById("postg").value;
                                    var underg = document.getElementById("underg").value;
                                    var status = document.getElementById("status").value;
                                    $.ajax({
                                        type: "POST",
                                        url: "../../controls/functions/course-add.php",
                                        data: {"fac_id": id,"firstname": fname, "lastname": lname, "middlename": mname,
                                        "postg": postg, "underg": underg, "status": status},
                                        success: function(html){
                                            $('#idsp').html(html);
                                        },
                                    });     
                                    }

                                    function updatedata(){
                                    var id = document.getElementById("fac_id").value;
                                    var fname = document.getElementById("firstname").value;
                                    var lname = document.getElementById("lastname").value;
                                    var mname = document.getElementById("middlename").value;
                                    var postg = document.getElementById("postg").value;
                                    var underg = document.getElementById("underg").value;
                                    var status = document.getElementById("status").value;
                                    $.ajax({
                                        type: "POST",
                                        url: "../../controls/functions/course-add.php",
                                        data: {"e_fac_id": id,"e_firstname": fname, "e_lastname": lname, "e_middlename": mname,
                                        "e_postg": postg, "e_underg": underg, "e_status": status},
                                        success: function(html){
                                            $('#idsp').html(html);
                                            setTimeout(function(){ window.location.href = "faculty-edit?id=" + id }, 3000);
                                        },
                                    });     
                                    }
                            </script>

                        </div>
                    </div>
                        <?php 
                            if(isset($_GET['id'])){
                                include("assets/modal/modal.php");
                                
                            }
                        ?>
            </div>
        </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
</body>

</html>
