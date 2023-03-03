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
    
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>

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
            include("assets/view/navbar-std-aa.php"); /* Navigation */
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
                    <h2>
                        <b style="text-transform: uppercase; font-weight: bold;"> <b style="letter-spacing: 1px;"><?= $row['s_lname'] . ", " . $row['s_fname'] . " ". $row['s_mname'] ?></b></b>
                    </h2>
                    <br>
                   <!--  -->
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <blockquote>
                        <b>Please Select Picture</b>
                        <hr>
                        <form id="uploadimage" class="form-horizontal" onsubmit="return false" autocomplete="off">
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
                      <hr>
                      <div id="uploaded_image"></div>
                      <script type="text/javascript">
                        $(document).ready(function(){
                         $(document).on('change', '#file', function(){
                          var name = document.getElementById("file").files[0].name;
                          var form_data = new FormData();
                          var ext = name.split('.').pop().toLowerCase();
                          if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                          {
                           alert("Invalid Image File");
                          }
                          var oFReader = new FileReader();
                          oFReader.readAsDataURL(document.getElementById("file").files[0]);
                          var f = document.getElementById("file").files[0];
                          var fsize = f.size||f.fileSize;
                          if(fsize > 2000000)
                          {
                           alert("Image File Size is very big");
                          }
                          else
                          {
                           form_data.append("file", document.getElementById('file').files[0]);
                           $.ajax({
                            url:"../registrar/upload.php?id=" + <?= $_GET['id'] ?>,
                            method:"POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend:function(){
                             $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                            },   
                            success:function(data)
                            {
                              alert("New Profile Updated");
                              $('#uploaded_image').html(data);
                              $('#file').attr('src', '');
                            }
                           });
                          }
                         });
                        });
                      </script>
                    </blockquote>
                    </form>
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
</body>

</html>
