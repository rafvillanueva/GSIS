<?php require("../../config/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="../../images/site-content/admin/favicon.png"/>
    <title>Guadalupe Elementary School</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <?php 
            include("navbar-b.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
              <div style="background-color: #e5e5e5; padding: 10px;">
                  <a href="administrator" style="text-decoration: none;">
                      <span class="fa fa-home"></span>
                      <small>&nbsp; Administrator Panel &nbsp;</small>
                  </a>
                  <span class="fa fa-angle-double-right"></span>
                  <a href="accounts" style="text-decoration: none;">
                      <small>&nbsp; Accounts &nbsp;</small>
                  </a>
                  <span class="fa fa-angle-double-right"></span>
                  <small>&nbsp; Add New Account &nbsp;</small>
              </div>
              <hr>
                <div id="idsp"></div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="">
                            <div class="form-group">
                                <img src="registrar/assets/icons/Info Squared_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Create Account</b>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" onsubmit="return false" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-2">ID Number : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Username here.." id="username">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Email Address : </label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" required placeholder="Enter Email Address here.." id="email">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Password : </label>
                                <div class="col-sm-9">
                                  <input type="text" id="password" class="form-control" required placeholder="Enter Password here..">
                                </div>
                                <div class="col-sm-1">
                                   <span onclick="password_default()" class="btn btn-default pull-right">Default</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Account Level : </label>
                                <div class="col-sm-10">
                                  <select class="form-control" required id="level" onchange="staff_setting()">
                                        <option selected disabled value="">-- Select Account Level --</option>
                                        <option>Student</option>
                                        <option>Faculty</option>
                                        <option>Finance</option>
                                        <option>Registrar</option>
                                        <option>Administrator</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group" id="staff_group" style="display: none;">
                                <label class="control-label col-sm-2"><b id="staff_name"></b> Name : </label>
                                <div class="col-sm-10">
                                  <input type="text" id="staff_a" class="form-control" required placeholder="Enter here..">
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <!-- <a href="accounts" class="btn btn-default"><span class="fa fa-arrow-left"></span> Return</a> -->
                                  <button onclick="insertdata_account()" class="btn btn-primary pull-right">Submit</button>
                                </div>
                              </div>
                            </form>
                            <script type="text/javascript">
                                function password_default(){
                                    document.getElementById("password").value = "12345!";
                                }
                                function staff_setting(){
                                  var acc_level = document.getElementById("level").value;
                                  if(acc_level === "Administrator"){
                                    document.getElementById("staff_group").style.display = "block";
                                    document.getElementById("staff_name").innerHTML = "Administrator";
                                  }else if(acc_level === "Registrar"){
                                    document.getElementById("staff_group").style.display = "block";
                                    document.getElementById("staff_name").innerHTML = "Registrar";
                                  } else{
                                    document.getElementById("staff_group").style.display = "none";                                    
                                  }
                                }
                            </script>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>    
    <script src="../vendor/custom/tnek.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
