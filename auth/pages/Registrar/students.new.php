<?php include("../../site-config.php"); ?>
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
                        <small>&nbsp; Students &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                    <small>&nbsp; Add New Student &nbsp;</small>

                </div>
                <hr>
                <div id="idsp"></div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                        <form class="form-inline" method="POST" action="course">
                            <div class="form-group">
                                <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add New Student</b>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form id="uploadimage" class="form-horizontal" onsubmit="return false" autocomplete="off">
                              <blockquote>
                                <center>
                                  <b>Please Select Picture</b>
                                  <hr>
                                  <img src="" id="profile-img-tag" width="200px" />
                                  <input type="file" name="file" id="file">
                                  <script type="text/javascript">
                                      function readURL(input) {
                                          if (input.files && input.files[0]) {
                                              var reader = new FileReader();
                                              
                                              reader.onload = function (e) {
                                                  $('#profile-img-tag').attr('src', e.target.result);
                                              }
                                              reader.readAsDataURL(input.files[0]);
                                          }
                                      }
                                      $("#file").change(function(){
                                          readURL(this);
                                      });
                                  </script>
                                </center>
                                <div id="uploaded_image"></div>
                                <script type="text/javascript">
                                  /*$(document).ready(function(){
                                   $(document).on('change', '#file', function(){
                                    
                                   });
                                  });*/
                                </script>
                              </blockquote>
                              <hr>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Student ID # : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Student ID #" id="student_id" style="width: 25%;">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Student Name : </label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" required placeholder="First Name.." id="firstname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Last Name.." id="lastname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Middle Name.." id="middlename">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Contact Number : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Contact Number here.." id="contactnum">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Address : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Address here.." id="address">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Gender : </label>
                                <div class="col-sm-2">
                                    <select class="form-control" required id="gender">
                                        <option selected disabled value="">Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <label class="control-label col-sm-2" for="email"> Grade level : </label>
                                <div class="col-sm-6  ">
                                    <select class="form-control" required id="zlevel">
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
                              <hr>
                              <b><font color="red">Parents Information *</font></b>
                              <hr>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Mother's Name : </label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" required placeholder="First Name.." id="mfirstname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Last Name.." id="mlastname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Middle Name.." id="mmiddlename">
                                </div>                      
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Contact Number : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Contact Number here.." id="mcontactnum">
                                </div>
                              </div>
                              <br><br>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Father's Name : </label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" required placeholder="First Name.." id="ffirstname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Last Name.." id="flastname">
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" required placeholder="Middle Name.." id="fmiddlename">
                                </div>                      
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Contact Number : </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" required placeholder="Enter Contact Number here.." id="fcontactnum">
                                </div>
                              </div>
                              <hr>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button onclick="insertdata_student()" type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Submit</button>
                                  <!-- <a href="students.php" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> Back</a> -->
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function shsCourse() {
                            var course = document.getElementById("course").value;
                            if(course == "SHS"){
                                $("#yearlevel").empty();
                                var x = document.getElementById("yearlevel");
                                var option = document.createElement("option");
                                var optionz = document.createElement("option");
                                option.text = "Grade 11";
                                optionz.text = "Grade 12";
                                x.add(option);
                                x.add(optionz);
                                /* Semester */
                                $("#semester").empty();
                                var xx = document.getElementById("semester");
                                var ooption = document.createElement("option");
                                ooption.text = "-";
                                xx.add(ooption);
                            }else{
                                $("#yearlevel").empty();
                                var x = document.getElementById("yearlevel");
                                for(var i = 1; i <= 4; i++){
                                   var opt = document.createElement('option');
                                    opt.value = i;
                                    if(i == 1){
                                        var year = i + "st year"
                                    }else if(i == 2){
                                        var year = i + "nd year"
                                    }else if(i == 3){
                                        var year = i + "rd year"
                                    }else if(i == 4){
                                        var year = i + "th year"
                                    }
                                    opt.innerHTML = year;
                                    x.appendChild(opt);                                    
                                }
                                $("#semester").empty();
                                var xx = document.getElementById("semester");
                                for(var i = 1; i <= 2; i++){
                                   var optt = document.createElement('option');
                                    optt.value = i;
                                    if(i == 1){
                                        var sem = i + "st Semester"
                                    }else if(i == 2){
                                        var sem = i + "nd Semester"
                                    }
                                    optt.innerHTML = sem;
                                    xx.appendChild(optt);                                    
                                }
                            }
                        }
                    </script>
            </div>
        </div>
    </div>
</body>

</html>
