<?php include("../../site-config.php"); ?>
<?php 
if(isset($_GET['Faculty'])){
$id = $_GET['Faculty'];

$student = "SELECT * FROM tbl_facultyinfo WHERE Fac_id = '$id'";
$student_query_enroll = mysqli_query($conn, $student);
$student_row = mysqli_fetch_array($student_query_enroll);

date_default_timezone_set("Asia/Manila");
$date_now = date("m.d");
$current_year = date('Y');
$advance_year = date('Y') + 1;
$date = $current_year . "-" . $advance_year;
$current_month = date('m');

if(isset($_GET['del'])){
    $ide = $_GET['enroll'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_facultyloads WHERE ID = '$ide'");
    header("location: ?Faculty=".$_GET['Faculty']);
}
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
    <title>Registrar &#8211; Vineyard College</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../alert/sweetalert2.css">

    <script src="../../alert/jquery2-x.js"></script>
    <script src="../../alert/sweetalert2.js"></script>
</head> 
<body>
    <div id="wrapper">
        <?php  
            include("assets/view/navbar-fac-b.php"); /* Navigation */
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <div style="background-color: #e5e5e5; padding: 10px;">
                    <small>
                      <i class="fa fa-sitemap custom" style="color: red;">&nbsp; </i>
                      <a href="/vineyard/vipcsite/auth/pages/registrar/" style="text-decoration: none;">
                          <b>Registrar Panel</b>
                      </a>
                      &nbsp;
                      <i class="fa fa-angle-double-right" style="color: red;">&nbsp; </i>
                      <a href="/vineyard/vipcsite/auth/pages/registrar/registrar" style="text-decoration: none;">
                          Record Administration Facility
                      </a>
                      &nbsp; 
                      <i class="fa fa-angle-double-right" style="color: red;">&nbsp; </i>
                      <a href="/vineyard/vipcsite/auth/pages/registrar/faculty" style="text-decoration: none;
                          ">    
                          Record Details and Operations <b>::</b> List of Faculty 
                      </a>
                      &nbsp;
                      <i class="fa fa-angle-double-right" style="color: red;">&nbsp; </i>
                      <a href="faculty-edit?id=<?= $id ?>" style="text-decoration: none;">
                          Faculty Details
                      </a>
                      &nbsp;
                      <i class="fa fa-angle-double-right" style="color: red;">&nbsp;</i>
                          Adding loads for &nbsp; <b style="letter-spacing: 2px; font-size: 14px; color: #0000FF ;"> <?= $student_row['firstName'] . '  ' . $student_row['lastName'] ?> </b>
                    </small>

                </div>
                <hr>
                <div id="idsp"></div>
                <?php 
                if(isset($_GET['Faculty'])){
                   

                }else{
                    //echo '<script type="text/javascript">window.location.href = "students"</script>';
                }
                if(isset($_POST['btn-sub-load'])){
                    $fac_id = $_GET['Faculty'];
                    $glevel = $_POST['grade_level'];
                    $section = $_POST['section'];
                        
                    date_default_timezone_set("Asia/Manila");
                    
                    $enroll = "INSERT INTO tbl_facultyloads(Fac_Id,grade_level,Section,s_year) VALUES('$fac_id','$glevel','$section','$date')";
                    $enroll_query = mysqli_query($conn, $enroll);

                      ?>
                        <script type="text/javascript">
                            swal(
                              'Load Success.',
                              '',
                              'success').then(function () {                             
                            })
                        </script>
                      <?php
                }
                ?>
                <div class="panel panel-default">
                <div class="panel-heading" style="border-radius: 0px; background-color: #474E62; color: #fff; padding-top: 0px; padding-bottom: 0px;">
                    <form class="form-inline" autocomplete="off" method="POST" action="?Faculty=<?php echo $id?>">
                        <div class="form-group">
                            <img src="assets/icons/Open_96px.png" height="55" width="45" class="imagez"> 
                            <b class="fontz" style=" letter-spacing: 2px; font-size: 20px; position: relative; top: 5px;">
                            List of Grade Section To Load ( <b style="color: orange;"><?= $date ?></b> ) 
                            </b>
                        </div>
                        <div class="form-group pull-right" style="padding: 10px; padding-right: 0px;">
                        
                        </div>
                    </form>
                </div>
                <div class="table-responsive1" style="height: 400px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Grade Level</th>
                                <th width="200">Section</th>
                                <th width="120"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>Nursery</td>
                              <td>
                                <input type="hidden" name="grade_level" value="0">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = '0' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = '0' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>K-1</td>
                              <td>
                                <input type="hidden" name="grade_level" value="1">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = '1' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = '1' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>K-2</td>
                              <td>
                                <input type="hidden" name="grade_level" value="2">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = '2' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = '2' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-1</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G1">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G1' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G1' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-2</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G2">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G2' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G2' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-3</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G3">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G3' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G3' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-4</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G4">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G4' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G4' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-5</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G5">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G5' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G5' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                            <form method="POST" action="faculty-load?Faculty=<?= $_GET['Faculty'] ?>">
                            <tr>
                              <td>GRADE-6</td>
                              <td>
                                <input type="hidden" name="grade_level" value="G6">
                                <?php
                                echo '<select class="form-control" style="margin-bottom: 5px; font-size: 12px; font-style: bold;" required name="section">';
                                echo '<option disabled selected value="">- Select-</option>';
                                    
                                    $section_select = "SELECT * FROM tbl_section WHERE offer_at = 'G6' ORDER BY Section ASC";
                                    $section_select_query = mysqli_query($conn, $section_select);
                                    while($select_row = mysqli_fetch_array($section_select_query)){
                                        $section_display = $select_row['section'];

                                        $section_display_sql = mysqli_query($conn, "SELECT count(*) as r,Section FROM tbl_facultyloads WHERE Section = '$section_display' AND grade_level = 'G6' AND s_year = '$date'");
                                        $section_row = mysqli_fetch_array($section_display_sql);

                                        if($section_display != $section_row['Section']){
                                             echo '<option>'.$section_display.'</option>';
                                        }

                                    }
                                echo '</select>';
                                ?>
                              </td>
                              <td>
                                  <center><button class="btn btn-sm btn-success btn-block" name="btn-sub-load"><i class="fa fa-plus"></i> Load</button></center>
                              </td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Faculty -->
    <div id="subject_load" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><img src="assets/icons/Elective_96px.png" height="55"> <b>Subject Load</b></h4>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table id="mytable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Year & Semester</th>
                        <th>Section</th>
                        <th><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $idx = $_GET['Faculty'];
                        $stud_id = $idx;
                        $view_subEnroll = "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$stud_id'";
                        $view_subEnroll_query = mysqli_query($conn, $view_subEnroll);
                        while($row = mysqli_fetch_array($view_subEnroll_query)){
                            echo '<tr>';
                            echo '<td>'.$row['SubjectLoad'].'</td>';
                            $subCodex = $row['SubjectLoad'];
                            $view_from_subject = "SELECT * From tbl_subjects WHERE subjectCode = '$subCodex'";
                            $view_from_subject_query = mysqli_query($conn, $view_from_subject);
                            $view_from_subject_row = mysqli_fetch_array($view_from_subject_query);
                            echo '<td>'.$view_from_subject_row['Description'].'</td>';
                            if($row['Semester'] == 1){
                              $semz = "1st Semester";
                            }elseif($row['Semester'] == 2){
                              $semz = "2nd Semester";
                            }
                            echo '<td>'.$row['Year']. " - " . $semz .'</td>';
                            echo '<td>'.$row['Section'].'</td>';
                            echo '<td style="font-size: 11px; width: 20px;">';
                            ?>
                              <a href="?enroll=<?php echo $row['ID']; ?>&Faculty=<?php echo $_GET['Faculty']; ?>&del" onclick="return confirm('Are you sure you want to remove this subject ?');" class="btn btn-danger btn-xs" style="margin-right: 5px;"><i class="fa fa-trash-o"></i> Removed</a>
                            <?php
                           
                            echo '';
                            echo '</td>';
                            echo '</tr>';
                          }
                           
                    ?>
                </tbody>
            </table>
              <!-- <?php include_once("faculty.edit.php"); ?> -->
          </div>
          </div>
          <div class="modal-footer">        
           
          </div>
        </div>
      </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>    
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
            function goBack() {
                window.history.back();
            }
    </script>
</body>

</html>
