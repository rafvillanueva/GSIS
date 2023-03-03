<!-- View Progress -->
<div id="std" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="controls/icons/Futures_96px.png" height="55"> <b>View Progress</b></h4>
      </div>
      <div class="modal-body">
        <!-- <h2><b style="text-transform: uppercase;">#<?= $id ?></b></h2>
        <hr> -->
        <form class="form-inl1ine">
          <div class="form-group">
            <label>Student</label>
             <div class="auto-widget">
                <input type="text" id="id_search" name="id_search" onchange="blank()" class="form-control">
                <div id="std-list" style="z-index: 100"></div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
              $('#id_search').keyup(function(){
                var query = $(this).val();
                if(query != ''){
                  $.ajax({
                    url: "controls/modal/search.php",
                    method: "POST",
                    data: {"query": query},
                    success: function(data){
                      $('#std-list').fadeIn();
                      $('#std-list').html(data);
                    }
                  });
                }
              });
            });
            function blank(){
              var val = $('#id_search').value;
              if(val === ''){
                $('#std-list').innerHTML = '';
              }
            }
          </script>
          <style type="text/css">
            #search_click:hover { background-color: #eee; font-size: 14px; letter-spacing: 1px; width: 100% }
          </style>
          <!-- <div class="form-group">
            <label>Students Name</label>
            <select class="form-control" id="studm" style="margin-top: 5px;">
                <?php

                  $rs = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE fac_id = '$id'");
                  while($row = mysqli_fetch_array($rs)){
                    $subj_code = $row['SubjectLoad'];
                    $subj_year = $row['Year'];
                    $subj_sem = $row['Semester'];
                    $subj_sec = $row['Section'];
                    $subj = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$subj_code' AND Year = '$subj_year' AND Semester = '$subj_sem' AND Section = '$subj_sec'");
                    while($subj_row = mysqli_fetch_array($subj)){
                      $stud_id = $subj_row['Stud_Id'];
                      $stud = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$stud_id'");
                      $stud_row = mysqli_fetch_array($stud);
                        if(!empty($stud_row['Stud_id'])){
                        ?>
                        <option value="<?= $stud_id ?>"><?= $stud_row['lastName'] . ", " . $stud_row['firstName'] . " " . $stud_row['middleName']; ?></option>
                        <?php
                      }
                    }
                    
                    /*$subj_year = $row['Year'];
                    $subj_sem = $row['Semester'];
                    $subj_sec = $row['Section'];
                    $subj = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$subj_code' AND Year = '$subj_year' AND Semester = '$subj_sem' AND Section = '$subj_sec'");
                    $subj_row = mysqli_fetch_array($subj);
                    $stud_id = $subj_row['Stud_Id'];
                    $stud = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$stud_id'");
                    $stud_row = mysqli_fetch_array($stud);
                    if(!empty($stud_row['Stud_id'])){*/
                      ?>
                      <option value="<?= 1#$stud_row['Stud_id'] ?>"><?= $subj_code#$stud_row['lastName'] . ", " . $stud_row['firstName'] . " " . $stud_row['middleName']; ?></option> -->
                      <!-- <?php
                    /*}    */                
                  }
                ?>                
            </select>
            <script type="text/javascript">
              function removeDuplicateOptions(s, comparitor) {
                if(s.tagName.toUpperCase() !== 'SELECT') { return false; }
                var c, i, o=s.options, sorter={};
                if(!comparitor || typeof comparitor !== 'function') {
                  comparitor = function(o) { return o.value; };//by default we comare option values.
                }
                for(i=0; i<o.length; i++) {
                  c = comparitor(o[i]);
                  if(sorter[c]) {
                    s.removeChild(o[i]);
                    i--;
                  }
                  else { sorter[c] = true; }
                }
                return true;
              }
              var s = document.getElementById("studm");
              removeDuplicateOptions(s);
            </script>
          </div> -->
          <div class="form-group">
            <label>Academic Year</label>
            <select class="form-control" id="acadm" style="margin-top: 5px;">
                <?php
                  #$id = $_GET['id'];

                  $rs = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_facultyloads WHERE fac_id = '$id'");
                  while($row = mysqli_fetch_array($rs)){
                    ?>
                    <option><?= $row['Year'] ?></option>
                    <?php
                  }
                ?>                
            </select>
          </div>
          <div class="form-group">
            <label>Semester</label>
            <select class="form-control" id="semesterm" style="margin-top: 5px;">
              <option value="1">1st Semester</option>
              <option value="2">2nd Semester</option>
          </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <script type="text/javascript" src="controls/modal/md5.js"></script>
        <script type="text/javascript">
          function link() {
            var id = '<?= $id ?>';
            var std = document.getElementById("id_search").value;
            var year = document.getElementById("acadm").value;
            var sem = document.getElementById("semesterm").value;            
            var role = 2;
            var salt = "krc";

            var value = std + year + sem + role + salt;

              var result = MD5(value);
            if(year === "" || sem === ""){
              alert("y");
            }else{
               window.location.href = "../../user/progress/?auth=" + result + "&std=" + std + "&acad=" + year + "&sem=" + sem + "&r=" + role;
            }
           
          }
        </script>
        <a href="#" onclick="link()" class="btn btn-danger" style="background-color: crimson;">Go <span class="fa fa-angle-right"></span></a>
      </div>
    </div>
  </div>
</div>