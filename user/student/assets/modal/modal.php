<!-- View Progress -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><img src="assets/icons/Futures_96px.png" height="55"> <b>View Progress</b></h4>
      </div>
      <div class="modal-body">
        <h2><small>My Id No ::</small> <b><?= $id ?></b></h2>
        <hr>
        <form class="form-inl1ine">
          <div class="form-group">
            <label>School Level</label>
            <select class="form-control" id="acadm" style="margin-top: 5px;">
                <?php
                  #$id = $_GET['id'];
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

          #if($g_row['Course'] != "SHS"){
            ?>
            <div class="form-group">
              <label>Semester</label>
              <select class="form-control" id="semesterm" style="margin-top: 5px;">
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
            </select>
            </div>
            <?php
          #}else{
            ?>
            <!-- <div class="form-group" style="display: none;">
              <select class="form-control" id="semesterm" style="margin-top: 5px;">
                <option value="101">---</option>
            </select>
            </div> -->
            <?php
          #}
          ?>
        </form>
      </div>
      <div class="modal-footer">
        <script type="text/javascript" src="assets/modal/md5.js"></script>
        <script type="text/javascript">
          function link() {
            var id = <?= $id ?>;
            var year = document.getElementById("acadm").value;
            var sem = document.getElementById("semesterm").value;            
            var role = 5;
            var salt = "krc";

            var value = id + year + sem + role + salt;

              var result = MD5(value);
            if(year === "" || sem === ""){
              
            }else{
               window.location.href = "../../user/progress/?auth=" + result + "&std=" + id + "&acad=" + year + "&sem=" + sem + "&r=" + role;
            }
           
          }
        </script>
        <a href="#" onclick="link()" class="btn btn-danger" style="background-color: crimson;">Go <span class="fa fa-angle-right"></span></a>
      </div>
    </div>
  </div>
</div>