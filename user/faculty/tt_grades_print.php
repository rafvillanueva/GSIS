<?php include('../../config/db.php'); ?>
<?php

ob_start();
session_start();
$id = $_SESSION['user'];
if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
}

if(isset($_POST['trigger']) == 1){
?>
    <table id="mytable" class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Students</th>
                <th>Address</th>
                <th>Grade Level</th>
                <th></th>
                <th><center>Grade</center></th>
            </tr>                
        </thead>
        <tbody>
            <?php
                $period = $_POST['Period'];
                $section = $_POST['section'];                    
                $sub_id = $_POST['sub_id'];
                $s_sub = $_POST['s_sub'];
                $fac_id = $_SESSION['user'];
                $stud_id = $id;

                $query_subj = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE subjectCode = '$sub_id'");
                $rowx_subj = mysqli_fetch_array($query_subj);

                $lvl = $rowx_subj['offer_at'];

                $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE s_level = '$lvl' AND Section = '$section'");
                
                while( $rowx = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <?php 
                            $id = $rowx['Stud_Id'];
                            $call_student = mysqli_query($conn, "SELECT * FROM tbl_students WHERE s_id = '$id'");
                            $rowz = mysqli_fetch_array($call_student);
                            if($rowz['s_level'] == "0"){
                              $data = "Nursery";
                            }elseif($rowz['s_level'] == "1"){
                              $data = "K-1";
                            }elseif($rowz['s_level'] == "2"){
                              $data = "K-2";
                            }elseif($rowz['s_level'] == "G1"){
                              $data = "Grade-1";
                            }elseif($rowz['s_level'] == "G2"){
                              $data = "Grade-2";
                            }elseif($rowz['s_level'] == "G3"){
                              $data = "Grade-3";
                            }elseif($rowz['s_level'] == "G4"){
                              $data = "Grade-4";
                            }elseif($rowz['s_level'] == "G5"){
                              $data = "Grade-5";
                            }elseif($rowz['s_level'] == "G6"){
                              $data = "Grade-6";
                            }
                        ?>
                        <td><?= $rowz['s_lname'] . ', ' . $rowz['s_fname'] . ' ' . $rowz['s_mname']; ?></td>
                        <td><?= $rowz['s_address'] ?></td>
                        <td><?= $data ?></td>
                        <td></td>
                        <?php
                        $s_id = $rowz['s_id'];
                        $f_id = $_SESSION['user'];
                        $s_sub = $s_sub;
                        $s_period = $period;

                        $rszz = mysqli_query($conn, "SELECT count(*) as i,s_grade FROM tbl_grade WHERE (s_id = '$s_id'  AND s_period = '$s_period' AND f_id = '$f_id' AND s_sub = '$s_sub')");
                        $rowzz = mysqli_fetch_array($rszz);
                        if($rowzz['i'] == 1){
                            ?>
                            <td style=" width: 90px !important">
                               <!--  <input class="form-control" style="text-align: center;" value="<?= $rowzz['s_grade'] ?>" disabled  id="score<?= $id ?>" onblur="<?= 'save'. $id ?>()" > -->
                               <center>
                               <?= $rowzz['s_grade'] ?>
                               </center>
                            </td>
                           <!--  <td><center><span id="status<?= $id ?>" style="color: orange">Graded</spanb></center></td>
                            <td><center>
                                <span id="edit<?= $id ?>" style="display: block;"><a href="javascript:void(0)" onclick="b_edit<?= $id?>()" class="btn btn-warning btn-xs">Edit</a></span>
                            </center></td> -->
                            <?php
                        }else{
                            ?>
                            <td style=" width: 90px !important">
                                <center>
                                <!-- input class="form-control" style="text-align: center;" value="0" id="score<?= $id ?>" onblur="<?= 'save'. $id ?>()" > -->
                                <?= $rowzz['s_grade'] ?>
                                </center>
                            </td>
                           <!--  <td><center><span id="status<?= $id ?>">-</spanb></center></td>
                            <td><center>
                                <span id="edit<?= $id ?>" style="display: none;"><a href="javascript:void(0)" onclick="b_edit<?= $id?>()" class="btn btn-warning btn-xs">Edit</a></span>
                            </center></td> -->
                            <?php
                        }
                        ?>
                        
                    </tr>
                    <script type="text/javascript">
                        function save<?= $id ?>(){
                            var score = document.getElementById("score<?= $id ?>").value;
                            var s_id = "<?= $rowz['s_id']?>";
                            var f_id = "<?= $_SESSION['user'] ?>";
                            var s_sub = "<?= $s_sub ?>";
                            var s_period = "<?= $period ?>";
                            if(Number(100) < Number(score)){
                                document.getElementById("status<?= $id ?>").innerHTML = "Invalid";
                                document.getElementById("status<?= $id ?>").style.color = "red";
                            }else{
                                $.ajax({
                                    type: "POST",
                                    url: "tt_saved.php",
                                    data: {"Score": score, "s_id": s_id, "f_id": f_id, "s_sub": s_sub, "s_period": s_period},
                                    success: function(html){
                                        $("#dsp").html(html);
                                        document.getElementById("status<?= $id ?>").innerHTML = "Success";
                                        document.getElementById("status<?= $id ?>").style.color = "green";
                                        document.getElementById("score<?= $id ?>").disabled = true;
                                        document.getElementById("edit<?= $id ?>").style.display = "block";
                                    },
                                }); 
                            } 
                        }

                        function b_edit<?= $id ?>(){
                            document.getElementById("score<?= $id ?>").disabled = false;
                            document.getElementById("edit<?= $id ?>").style.display = "none";
                        }
                    </script>
                <?php
                }
            ?>
        </tbody>
    </table>
<?php
}
?>