<!-- View Progress -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="assets/icons/Class_96px.png" height="55"> <b>View Progress</b></h4>
      </div>
      <div class="modal-body">
        <h2><b>#<?= $_GET['id'] ?></b></h2>
        <hr>
        <form class="form-inl1ine">
          <div class="form-group">
            <label>School Level</label>
            <select class="form-control" id="acadm" style="margin-top: 5px;">
                <?php
                  $id = $_GET['id'];
                  $rs = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_subjectsenrolled WHERE Stud_id = '$id'");
                  while($row = mysqli_fetch_array($rs)){
                    ?>
                    <option><?= $row['Year'] ?></option>
                    <?php
                  }
                ?>                
            </select>
          </div>
          <?php
              $course = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_id = '$id'");
              $course_row = mysqli_fetch_array($course);
              if($course_row['Course'] == "SHS"){
                 ?>
                <div class="form-group" style="display: none;">
                  <label>Semester</label>
                  <select class="form-control" id="semesterm" style="margin-top: 5px;">
                    <option value="101">---</option>
                  </select>
                </div>
                <?php
              }else{
                ?>
                <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control" id="semesterm" style="margin-top: 5px;">
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                  </select>
                </div>
                <?php
              }
              ?>
        </form>
      </div>
      <div class="modal-footer">
        <script type="text/javascript" src="assets/modal/md5.js"></script>
        <script type="text/javascript">
          function link() {
            var id = <?= $_GET['id'] ?>;
            var year = document.getElementById("acadm").value;
            var sem = document.getElementById("semesterm").value;            
            var role = 1;
            var salt = "krc";

            var value = id + year + sem + role + salt;

              var result = MD5(value);
            if(year === "" || sem === ""){
              
            }else{
               window.location.href = "../../../user/progress/?auth=" + result + "&std=" + id + "&acad=" + year + "&sem=" + sem + "&r=" + role;
            }
           
          }
        </script>
        <a href="#" onclick="link()" class="btn btn-danger" style="background-color: crimson;">Go <span class="fa fa-angle-right"></span></a>
      </div>
    </div>
  </div>
</div>

<!-- Subjects -->
<div id="subject_enrolled" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="assets/icons/Elective_96px.png" height="55"> <b>Subject Enrolled</b></h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="mytable" class="table table-striped">
              <thead>
                  <tr>
                      <th>Subject Code</th>
                      <th>Description</th>
                      <th>Section</th>
                      <th><center>Action</center></th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    if(empty($_GET['id'])){
                      $idx = $_GET['student'];
                    }else{
                      $idx = $_GET['id'];
                    }
                      $stud_id = $idx;
                      if(isset($_POST['btn-search'])){
                          $val = $_POST['val-search'];
                          $subjects = "SELECT * FROM tbl_subjects WHERE subjectCode like '%$val%' OR Description like '%$val%' ORDER BY ID DESC";
                          $subjects_query = mysqli_query($conn, $subjects);
                          while($row = mysqli_fetch_array($subjects_query)){
                              echo '<tr>';
                              echo '<td>'.$row['subjectCode'].'</td>';
                              echo '<td>'.$row['Description'].'</td>';
                              echo '<td style="font-size: 11px; width: 120px;">';
                              $subCode = $row['subjectCode'];
                              $exist_sub = "SELECT count(*) as sub FROM tbl_subjectsEnrolled WHERE Stud_Id = '$stud_id' AND subjectCode = '$subCode'";
                              $exist_sub_query = mysqli_query($conn, $exist_sub);
                              $exist_row = mysqli_fetch_array($exist_sub_query);
                              if($exist_row['sub'] == 0){
                              echo '<form action="?student='. $id .'" method="POST">';
                              echo '<input type="hidden" name="enroll_sub" value="'.$row['subjectCode'].'">';
                              echo '<input type="hidden" name="enroll_des" value="'.$row['Description'].'">';
                              echo '<select class="form-control" style="margin-bottom: 5px;" required name="section">';
                              echo '<option disabled selected value="">-Section-</option>';
                                  $section_select = "SELECT * FROM tbl_section ORDER BY Section ASC";
                                  $section_select_query = mysqli_query($conn, $section_select);
                                  while($select_row = mysqli_fetch_array($section_select_query)){
                                  echo '<option>'.$select_row['Section'].'</option>';
                                  }
                              echo '</select>';
                              echo '<center><button class="btn btn-sm btn-success btn-block" name="btn-sub-enroll"><i class="fa fa-plus"></i> Add</button></center>';
                              echo '</form>';                                  
                              }else{
                                  echo '<center><h5 style="color: red;">Enrolled</h5></center>';
                              }
                              echo '</td>';
                              echo '</tr>';
                          }
                      }else{
                          $view_subEnroll = "SELECT * FROM tbl_subjectsEnrolled WHERE Stud_Id = '$stud_id'";
                          $view_subEnroll_query = mysqli_query($conn, $view_subEnroll);
                          while($row = mysqli_fetch_array($view_subEnroll_query)){
                              echo '<tr>';
                              echo '<td>'.$row['subjectCode'].'</td>';
                              $subCodex = $row['subjectCode'];
                              $view_from_subject = "SELECT * From tbl_subjects WHERE subjectCode = '$subCodex'";
                              $view_from_subject_query = mysqli_query($conn, $view_from_subject);
                              $view_from_subject_row = mysqli_fetch_array($view_from_subject_query);
                              echo '<td>'.$view_from_subject_row['Description'].'</td>';

                                                         
                              echo '<td>'.$row['Section'].'</td>';
                              echo '<td style="font-size: 11px; width: 20px;">';
                              if(empty($_GET['id'])){
                              ?>
                                <a href="?enroll=<?php echo $row['ID']; ?>&student=<?php echo $_GET['student']; ?>&del" onclick="return confirm('Are you sure you want to remove this subject ?');" class="btn btn-danger btn-xs" style="margin-right: 5px;"><i class="fa fa-trash-o"></i> Removed</a>
                              <?php
                              }else{
                              ?>
                                <a href="?enroll=<?php echo $row['subjectCode']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this subject ?');" class="btn btn-danger btn-xs" style="margin-right: 5px;"><i class="fa fa-trash-o"></i> Removed</a>
                              <?php
                              }
                             
                              echo '';
                              echo '</td>';
                              echo '</tr>';
                          }
                      }
                  ?>
              </tbody>
          </table>
      </div>
      </div>
      <div class="modal-footer">        
       
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
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th><center>Action</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                  if(empty($_GET['id'])){
                      $idx = $_GET['Faculty'];
                    }else{
                      $idx = $_GET['id'];
                    }
                    $stud_id = $idx;
                    $view_subEnroll = "SELECT * FROM tbl_facultyloads WHERE Fac_Id = '$stud_id'";
                    $view_subEnroll_query = mysqli_query($conn, $view_subEnroll);
                    while($row = mysqli_fetch_array($view_subEnroll_query)){
                        echo '<tr>';
                        $subCodex = $row['grade_level'];
                        if($row['grade_level'] == "0"){
                          $data = "Nursery";
                        }elseif($row['grade_level'] == "1"){
                          $data = "K-1";
                        }elseif($row['grade_level'] == "2"){
                          $data = "K-2";
                        }elseif($row['grade_level'] == "G1"){
                          $data = "Grade-1";
                        }elseif($row['grade_level'] == "G2"){
                          $data = "Grade-2";
                        }elseif($row['grade_level'] == "G3"){
                          $data = "Grade-3";
                        }elseif($row['grade_level'] == "G4"){
                          $data = "Grade-4";
                        }elseif($row['grade_level'] == "G5"){
                          $data = "Grade-5";
                        }elseif($row['grade_level'] == "G6"){
                          $data = "Grade-6";
                        }
                        echo '<td>'.$data.'</td>';
                        echo '<td>'.$row['Section'].'</td>';
                        echo '<td style="font-size: 11px; width: 20px;">';
                        if(empty($_GET['id'])){
                          //$idx = $_GET['Faculty'];
                        }else{
                        ?>
                          <a href="?enroll=<?php echo $row['ID']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this subject ?');" class="btn btn-danger btn-xs" style="margin-right: 5px;"><i class="fa fa-trash-o"></i> Removed</a>
                        <?php
                        }
                       
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

<!-- Settings -->
<div id="settingz" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>New Settings</b></h4>
      </div>
      <div class="modal-body">
        <center>
          <h4><b>Calendar Settings.</b></h4><br>
          <a href="setup_settings.php" class="btn btn-primary" style="width: 200px;">Change to new settings.</a> <br><br>
          <a href="?e6093e437ef86aee923fd1f81f7891d0619bd43a6b2347929a363f57065ee847" class="btn btn-danger"  style="width: 200px;">Remain old settings.</a> <br><br>
          <a href="?later" style="color: #477E89"> Change Later.</a>
        </center>
      </div>
    </div>
  </div>
</div>