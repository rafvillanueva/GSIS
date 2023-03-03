<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$id'");
    $row = mysqli_fetch_array($course);
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_subjects WHERE subjectCode = '$id'");
    header("location: subjects");
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
                        <small>&nbsp; Subject &nbsp;</small>
                    </a>
                    <span class="fa fa-angle-double-right"></span>
                      <small>&nbsp; Subject Details &nbsp;</small>
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
                                  <img src="assets/icons/Plus_96px.png" height="55" class="imagez"> <b class="fontz" style="text-transform: uppercase; letter-spacing: 2px; font-size: 24px; position: relative; top: 5px;">Add New Subject</b>
                                  <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                        <div class="panel-body">
                            <form class="form-horizontal" onsubmit="return false" autocomplete="off">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Subject Code : </label>
                                <?php
                                    if(!isset($_GET['id'])){
                                  ?>
                                  <div class="col-sm-10">
                                    <input type="hidden"value="<?= $row['ID'] ?>" required id="idx">
                                    <input type="text" class="form-control" onblur="shs_subject()" value="<?= $row['subjectCode'] ?>" required placeholder="Enter Subject Code" id="subject">
                                  </div>
                                  <!-- <div class="col-sm-3">                                  
                                    <a href="#" onclick="autoSHS()" class="btn btn-default btn-block">(SHS) Senior Highschool</a>
                                  </div> -->
                                <?php 
                                  }else{
                                    ?>
                                    <div class="col-sm-10">
                                      <input type="hidden"value="<?= $row['ID'] ?>" required id="idx">
                                      <input type="text" class="form-control" onblur="shs_subject()" value="<?= $row['subjectCode'] ?>" required placeholder="Enter Subject Code" id="subject">
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Description : </label>
                                <div class="col-sm-10">
                                  <textarea rows="5" class="form-control" required placeholder="Write the Description here.." id="description"><?= $row['Description'] ?></textarea>
                                </div>
                              </div>
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
                              <div class="form-group">
                                <label class="control-label col-sm-2">Offer at : </label>
                                <div class="col-sm-10">
                                  <select class="form-control" required id="year">
                                    <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                      <option value="<?= $row['s_level'] ?>"><?= $data ?></option>
                                      <option disabled value="">---------------</option>
                                      <?php
                                    }else{
                                      ?>
                                      <option selected disabled value="">-- Select Grade Level --</option>
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
                              <!-- <div class="form-group"> -->
                                <!-- <label class="control-label col-sm-2">Units : </label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" value="<?= $row['UnitLec'] ?>" required placeholder="Enter Unit Lec." id="UnitLec">
                                </div> -->
                                <!-- <div class="col-sm-2">
                                  <input type="text" class="form-control" value="<?= $row['UnitLab'] ?>" required placeholder="Enter Unit Lab." id="UnitLab">
                                </div> -->
                                <!-- <div class="col-sm-3">
                                  <select class="form-control" required id="year">
                                        <option selected disabled value="">-- Select Year --</option>
                                        <?php
                                          if(isset($_GET['id'])){
                                            if($row['Year'] == 1){
                                              echo '<option selected value="1">1st Year</option>';
                                              ?>
                                              <option value="" disabled>--</option>
                                              <option value="0">Senior Higchool</option>
                                              <option value="1">1st Year</option>
                                              <option value="2">2nd Year</option>
                                              <option value="3">3rd Year</option>
                                              <option value="4">4th Year</option>
                                              <?php
                                            }elseif($row['Year'] == 2){
                                               echo '<option selected value="2">2nd Year</option>';
                                               ?>
                                              <option value="" disabled>--</option>
                                              <option value="0">Senior Higchool</option>
                                              <option value="1">1st Year</option>
                                              <option value="2">2nd Year</option>
                                              <option value="3">3rd Year</option>
                                              <option value="4">4th Year</option>
                                              <?php
                                            }elseif($row['Year'] == 3){
                                               echo '<option selected value="3">3rd Year</option>';
                                               ?>
                                              <option value="" disabled>--</option>
                                              <option value="0">Senior Higchool</option>
                                              <option value="1">1st Year</option>
                                              <option value="2">2nd Year</option>
                                              <option value="3">3rd Year</option>
                                              <option value="4">4th Year</option>
                                              <?php
                                            }elseif($row['Year'] == 4){
                                               echo '<option selected value="4">4th Year</option>';
                                               ?>
                                              <option value="" disabled>--</option>
                                              <option value="0">Senior Higchool</option>
                                              <option value="1">1st Year</option>
                                              <option value="2">2nd Year</option>
                                              <option value="3">3rd Year</option>
                                              <option value="4">4th Year</option>
                                              <?php
                                            }elseif($row['Year'] == 112){
                                               echo '<option selected value="112">Senior Highchool</option>';
                                            }
                                          }
                                        ?>
                                    </select>
                                </div> -->
                                <!-- <div class="col-sm-3">
                                  <select class="form-control" required id="semester">
                                        <option selected disabled value="">-- Select Semester --</option>
                                        <?php
                                          if(isset($_GET['id'])){
                                              if($row['Sem'] == 1){
                                                  echo '<option selected value="1">1st Semester</option>';
                                                  ?>
                                                  <option disabled> --</option>
                                                  <option value="1">1st Semester</option>
                                                  <option value="2">2nd Semester</option>
                                                  <?php
                                              }elseif($row['Sem'] == 2){
                                                 echo '<option selected value="2">2nd Semester</option>';
                                                 ?>
                                                  <option disabled> --</option>
                                                  <option value="1">1st Semester</option>
                                                  <option value="2">2nd Semester</option>
                                                  <?php
                                              }elseif($row['Sem'] == 101){
                                                 echo '<option selected value="101">-</option>';
                                              }                                             
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div> -->
                            <!--   <div class="form-group">
                                <label class="control-label col-sm-2">Prerequisite : </label>
                                <div class="col-sm-10">
                                 <input type="text" class="form-control" required placeholder="Enter Prerequisite here.." id="Prerequisite" value="None">
                                </div>
                              </div> -->
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                   <a href="subjects" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> List of Subjects</a>
                                  <?php
                                    if(isset($_GET['id'])){
                                      ?>
                                        <button onclick="editdata_subject()" class="btn btn-success pull-right"><span class="fa fa-save"></span>&nbsp; Save Changes</button>                                        
                                      <a href="?del=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this Subject ?');" class="btn btn-danger pull-right" style="margin-right: 5px;">  <i class="fa fa-trash-o"></i> Removed</a>
                                      <?php
                                    }else{
                                      ?>
                                        <button onclick="insertdata_subject()" class="btn btn-primary pull-right"><span class="fa fa-plus"></span>&nbsp; Submit</button>
                                      <?php
                                    }
                                  ?>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript">
                       function shs_subject(){
                              var SearchTerm = "(SHS)";
                              var TextSearch = document.getElementById("subject").value;

                              if (SearchTerm.length > 0 && TextSearch.indexOf(SearchTerm) > -1) {
                                  $('#semester')
                                  .find('option')
                                  .remove()
                                  .end()
                                  .append('<option selected value="101">-</option>')
                                  .val('101');

                                  document.getElementById("UnitLab").value = "-";
                                  document.getElementById("UnitLec").value = "-";

                                  $('#year')
                                  .find('option')
                                  .remove()
                                  .end()
                                  .append('<option value="112">Senior Highchool</option>')
                                  .val('112')

                                } else {
                                   $('#semester')
                                  .find('option')
                                  .remove()
                                  .end()
                                  .append('<option disabled selected value="">-- Select Semester --</option>')
                                  .append('<option value="1">1st Semester</option>')
                                  .append('<option value="2">2nd Semester</option>')
                                  .val('2')
                                  .val('1')
                                  .val('');

                                  document.getElementById("UnitLab").value = "";
                                  document.getElementById("UnitLec").value = "";

                                  $('#year')
                                  .find('option')
                                  .remove()
                                  .end()
                                  .append('<option disabled selected value="">-- Select Year --</option>')
                                  .append('<option value="5">Grade 11</option>')
                                  .append('<option value="6">Grade 12</option>')
                                  .append('<option value="1">1st Year</option>')
                                  .append('<option value="2">2nd Year</option>')
                                  .append('<option value="3">3rd Year</option>')
                                  .append('<option value="4">4th Year</option>')
                                  .val('4')
                                  .val('3')
                                  .val('2')
                                  .val('1')
                                  .val('5')
                                  .val('6')
                                  .val('');
                                }
                          }
                          function autoSHS(){
                            document.getElementById("subject").value = "(SHS)";
                            shs_subject();
                          }
                    </script>
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
