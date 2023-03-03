<?php include("../../site-config.php"); ?>
<?php

if(isset($_GET['enroll'])){
    $ide = $_GET['enroll'];
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND subjectCode = '$ide'");
    $student_view = "SELECT * FROM tbl_students WHERE Stud_Id = '$id'";
    $student_query_view = mysqli_query($conn, $student_view);
    $row = mysqli_fetch_array($student_query_view);
    header("location: view-student?id=$id");
}elseif(isset($_GET['id'])){
    $id = $_GET['id'];
    $student_view = "SELECT * FROM tbl_students WHERE s_id = '$id'";
    $student_query_view = mysqli_query($conn, $student_view);
    $row = mysqli_fetch_array($student_query_view);
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_students WHERE s_id = '$id'");
    header("location: students");
}
else{
    header("location: students");
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
    <style type="text/css">
        .dropdown {
          position: relative;
          display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 200px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          font-size: 13px;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
          display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
          background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php 
            include("assets/view/navbar-std-a.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                  <a href="students" style="text-decoration: none;">
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
                    <small>&nbsp; Student Details &nbsp;</small>

                </div>
                <hr>
                <div class="col-md-12">
                    <small>
                        <div class="dropdown" id="edit">
                            <a href="javascript:void(0)" style="color: #75A4D2; font-size: 16px;">
                                <span class="fa fa-gear"></span> More Operations
                            </a>
                            <div class="dropdown-content">
                               <a href="enroll-student-subject?student=<?php echo $row['s_id'] ?>">Assign Section</a>
                                <a href="javascript:void(0)" onclick="edit()">Edit Profile</a>
                                <a href="?del=<?php echo $_GET['id'] ?>" onclick="return confirm('Are you sure you want to remove this student ?');">Remove Student</a>
                                <!-- <a href="#" data-toggle="modal" data-target="#myModal">View Progress</a>-->
                                <!-- <a href="#" data-toggle="modal" data-target="#subject_enrolled">View Subject Enrolled</a>  -->
                                <a href="payment.php?id=<?php echo $row['s_id'] ?>">Billing</a> 
                                <a href="student.profile.php?id=<?= $_GET['id'] ?>">Upload New Picture</a>
                              </div>
                        </div>
                    </small>
                    <h2>
                        <div class="1pull-right">
                          <img src="../../../images/<?= $_GET['id'] ?>.jpg" style="position: relative; width: 150px; height: 150px; top: -0px; border: 3px #e1e1e1 solid; border-radius: 5px;">
                        <b style="text-transform: uppercase; font-weight: bold;"> <b style="letter-spacing: 1px;"><?= $row['s_lname'] . ", " . $row['s_fname'] . " ". $row['s_mname'] ?></b></b>
                        </div>
                    </h2>
                    <br>
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>ID Number : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                         <b id="std_idb" style="font-size: 15px; letter-spacing: 1px;"><?= $row['s_id'] ?></b>
                           <div class="form-group" id="edit_std" style="display: none; margin-bottom: 0px;">
                                <input type="hidden" id="idx" value="<?php echo $row['s_id'] ?>">
                                <input type="text" class="form-control" required placeholder="Enter Student ID #" id="student_id" value="<?php echo $row['s_id'] ?>" style="width: 25%;">
                            </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Complete Name : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="completename" style="font-size: 15px; letter-spacing: 1px;"><?= $row['s_lname'] . ", " . $row['s_fname'] . " ". $row['s_mname'] ?></b>
                           <div class="form-group" id="edit_completename" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="First Name.." id="firstname" value="<?php echo $row['s_fname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Last Name.." id="lastname" value="<?php echo $row['s_lname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Middle Name.." id="middlename" value="<?php echo $row['s_mname'] ?>">
                            </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Gender : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="genderb" style="font-size: 15px; letter-spacing: 1px;"><?= $row['s_gender']?></b>
                           <div class="form-group" id="edit_gender" style="display: none; margin-bottom: 0px;">
                                <select class="form-control" required id="gender">
                                    <option><?php echo $row['s_gender'] ?></option>
                                    <option disabled value="">Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Address : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="addressb" style="font-size: 15px; letter-spacing: 1px;"><?= $row['s_address']?></b>
                           <div class="form-group" id="edit_address" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="Enter Address here.." id="address" value="<?php echo $row['s_address'] ?>">
                          </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Contact # : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="contactb" style="font-size: 15px; letter-spacing: 1px;"><?= $row['s_contact']?></b>
                           <div class="form-group" id="edit_contact" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="Enter Address here.." id="contactnum" value="<?php echo $row['s_contact'] ?>">
                            </div>
                       </div>
                   </div>
                   <!--  -->
                  <hr style="margin: 8px;">
                  <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Mother's Complete Name : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="completenamem" style="font-size: 15px; letter-spacing: 1px;"><?= $row['m_lname'] . ", " . $row['m_fname'] . " ". $row['m_mname'] ?></b>
                           <div class="form-group" id="edit_completenamem" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="First Name.." id="mfirstname" value="<?php echo $row['m_fname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Last Name.." id="mlastname" value="<?php echo $row['m_lname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Middle Name.." id="mmiddlename" value="<?php echo $row['m_mname'] ?>">
                            </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Mother's Contact # : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="contactm" style="font-size: 15px; letter-spacing: 1px;"><?= $row['m_contact']?></b>
                           <div class="form-group" id="edit_contactm" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="Enter Address here.." id="contactmz" value="<?php echo $row['m_contact'] ?>">
                            </div>
                       </div>
                   </div>
                   <hr style="margin: 8px;">
                  <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Father's Complete Name : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="completenamef" style="font-size: 15px; letter-spacing: 1px;"><?= $row['f_lname'] . ", " . $row['f_fname'] . " ". $row['f_mname'] ?></b>
                           <div class="form-group" id="edit_completenamef" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="First Name.." id="ffirstname" value="<?php echo $row['f_fname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Last Name.." id="flastname" value="<?php echo $row['f_lname'] ?>">
                              <div style="padding: 3px;"></div>
                              <input type="text" class="form-control" required placeholder="Middle Name.." id="fmiddlename" value="<?php echo $row['f_mname'] ?>">
                            </div>
                       </div>
                    </div>
                    <hr style="margin: 8px;">
                    <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Father's Contact # : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <b id="contactf" style="font-size: 15px; letter-spacing: 1px;"><?= $row['f_contact']?></b>
                           <div class="form-group" id="edit_contactf" style="display: none; margin-bottom: 0px;">
                              <input type="text" class="form-control" required placeholder="Enter Address here.." id="contactfz" value="<?php echo $row['f_contact'] ?>">
                            </div>
                       </div>
                   </div>
                   <hr style="margin: 8px;">
                   <div class="row">
                       <div class="col-md-3">
                           <div class="pull-right" style="color: gray; text-transform: uppercase;">
                               <b>Grade Level : </b>
                           </div>
                       </div>
                       <div class="col-md-9">
                          <?php
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
                           <b id="slevel" style="font-size: 15px; letter-spacing: 1px;"><?= $data ?></b>
                           <div class="form-group" id="edit_slevel" style="display: none; margin-bottom: 0px;">
                              <select class="form-control" required id="zlevel">
                                  <option value="<?= $row['s_level'] ?>"><?= $data ?></option>
                                  <option disabled value="">---------------</option>
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
                </div>
                <div class="col-md-12">
                    <hr>
                    <div class="row">
                        <div id="idsp"></div>
                        <div class="pull-right">
                            <div id="edit_btns" style="display: none;">
                                <a href="javascript:void(0)" onclick="cancel()" class="btn btn-danger" style="text-transform: uppercase; letter-spacing: 2px; color: #fff; background-color: crimson; font-size: 13px; margin-top: 8px; ">
                                    <span class="fa fa-times"></span> Cancel
                                </a>
                                <a href="javascript:void(0)" onclick="editdata_student()" class="btn btn-success" style="text-transform: uppercase; letter-spacing: 2px; color: #fff; font-size: 13px; margin-top: 8px;">
                                    <span class="fa fa-save"></span> Save Changes
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                </div>
            </div>
        </div>
    </div>
    <?php include("assets/modal/modal.php"); ?>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        function edit() {
            document.getElementById("edit_completename").style.display = "block";
            document.getElementById("edit_completenamem").style.display = "block";
            document.getElementById("edit_completenamef").style.display = "block";
            document.getElementById("edit_gender").style.display = "block";
            document.getElementById("edit_address").style.display = "block";
            document.getElementById("edit_contact").style.display = "block";
            document.getElementById("edit_contactf").style.display = "block";
            document.getElementById("edit_contactm").style.display = "block";
            document.getElementById("edit_std").style.display = "block";
            document.getElementById("edit_slevel").style.display = "block";
            

            document.getElementById("completename").style.display = "none";
            document.getElementById("completenamem").style.display = "none";
            document.getElementById("completenamef").style.display = "none";
            document.getElementById("genderb").style.display = "none";
            document.getElementById("addressb").style.display = "none";
            document.getElementById("contactb").style.display = "none";
            document.getElementById("contactf").style.display = "none";
            document.getElementById("contactm").style.display = "none";
            document.getElementById("idsp").style.display = "none";
            document.getElementById("std_idb").style.display = "none";
            document.getElementById("slevel").style.display = "none";

            document.getElementById("edit_btns").style.display = "block";
            document.getElementById("edit").style.display = "none";
        }

        function cancel(){
            document.getElementById("edit_completename").style.display = "none";
            document.getElementById("edit_completenamem").style.display = "none";
            document.getElementById("edit_completenamef").style.display = "none";
            document.getElementById("edit_gender").style.display = "none";
            document.getElementById("edit_address").style.display = "none";
            document.getElementById("edit_contact").style.display = "none";
            document.getElementById("edit_contactf").style.display = "none";
            document.getElementById("edit_contactm").style.display = "none";
            document.getElementById("edit_std").style.display = "none";
            document.getElementById("edit_slevel").style.display = "none";

            document.getElementById("completename").style.display = "block";
            document.getElementById("completenamem").style.display = "block";
            document.getElementById("completenamef").style.display = "block";
            document.getElementById("genderb").style.display = "block";
            document.getElementById("addressb").style.display = "block";
            document.getElementById("contactb").style.display = "block";
            document.getElementById("contactf").style.display = "block";
            document.getElementById("contactm").style.display = "block";
            document.getElementById("idsp").style.display = "block";
            document.getElementById("std_idb").style.display = "block";
            document.getElementById("slevel").style.display = "block";

            document.getElementById("edit_btns").style.display = "none";
            document.getElementById("edit").style.display = "block";
        }
    </script>
</body>

</html>
