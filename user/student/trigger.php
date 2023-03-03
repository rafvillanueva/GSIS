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
                    <th>Student</th>
                    <th style="width: 90px; padding-left: 1px;"><i style="font-size: 11px; text-align: center;">Perfect Score</i><input class="form-control" value="30" id="perfect" style="text-align: center;"></th>
                    <th></th>
                    <th><center>Grade</center></th>
                    <th><center>SMS | Status</center></th>
                    <th style="width: 100px;">Action</th>
                </tr>                
            </thead>
            <tbody>
                <?php 
                    $acad = $_POST['Acad'];
                    $quiz = $_POST['Quiz'];
                    $period = $_POST['Period'];
                    $sub_id = $_POST['sub_id'];                    
                    $section = $_POST['section'];                    
                    $fac_id = $_SESSION['user'];
                    $stud_id = $id;

                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$sub_id' AND Section = '$section'");
                    while( $rowx = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <?php 
                                $id = $rowx['Stud_Id'];
                                $call_student = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$id'");
                                $rowz = mysqli_fetch_array($call_student);
                            ?>
                            <td><a href=""><?= $rowz['lastName'] . ', ' . $rowz['firstName'] . ' ' . $rowz['middleName']; ?></a></td>
                            <?php
                                $score = mysqli_query($conn, "SELECT * FROM tbl_scores WHERE Stud_id = '$id' AND SubjectCode = '$sub_id' AND AcadYearAndSem = '$acad' AND Grade_Components = '$quiz' AND Period = '$period'");
                                $row_score = mysqli_fetch_array($score);
                                if(!empty($row_score['Stud_id'])){
                                    ?>
                            <td style=" padding-left: 1px; text-align:">
                            <input class="form-control" disabled value="<?= $row_score['Score'] . '/' . $row_score['Total_score'] ?>"  style="text-align: center;" value="0"  id="score<?= $id ?>" onblur="<?= 'w'.$id ?>()" >
                            <input type="hidden" value="<?= $row_score['Score'] ?>" id="edit_scorex<?= $id ?>">
                            <input type="hidden" value="<?= $row_score['Total_score'] ?>" id="edit_overx<?= $id ?>">
                            <input type="hidden" value="<?= $row_score['Grade'] ?>" id="edit_gradex<?= $id ?>">
                            </td>
                            <td></td>
                            <td><center><div id="grade<?= $id ?>"><?= number_format((float)$row_score['Grade'], 2, '.', ',') ?></div></center></td>
                            <td style="color: green;"><center><div id="status<?= $id ?>"><?= $row_score['Status'] ?></div></center></td>
                            <td id="ee_edit<?= $id ?>">
                                <a href="javascript:void(0);" style="color: #333;"  onclick="<?= 'edit_score_'.$id ?>()">
                                    <span class="fa fa-pencil"></span>&nbsp; Edit
                                </a>
                            </td>
                            <td id="ee_save<?= $id ?>" style="display: none;">
                                
                                    <a href="javascript:void(0);" style="color: #333;"  onclick="<?= 'update_score_'.$id ?>()">
                                        <span class="fa fa-check"></span> Update
                                    </a>
                                    <br>
                                    <a href="javascript:void(0);" style="color: #333;"  onclick="<?= 'cancel_score_'.$id ?>()">
                                        <span class="fa fa-times"></span>&nbsp; Cancel
                                    </a>
                            </td>
                                    <?php
                                }else{

                            ?>
                            <td style=" padding-left: 1px; text-align:">
                                <input class="form-control" style="text-align: center;" value="0"  id="score<?= $id ?>" onblur="<?= 'w'.$id ?>()" >
                                <input type="hidden" id="edit1_scorex<?= $id ?>">
                                <input type="hidden" id="edit1_overx<?= $id ?>">
                                <input type="hidden" id="edit1_gradex<?= $id ?>">
                            </td>
                            <td></td>
                            <td><center><div id="grade<?= $id ?>">0</div></center></td>
                            <td style="color: orange;"><center><div id="status<?= $id ?>">Ready</div></center></td>
                            
                            <td id="e1_edit<?= $id ?>" style="display: none;">                                
                                    <a href="javascript:void(0);" style="color: #333;"  onclick="<?= 'update1_score_'.$id ?>()">
                                        <span class="fa fa-check"></span> Update
                                    </a>
                                    <br>
                                    <a href="javascript:void(0);" style="color: #333;"  onclick="<?= 'cancel1_score_'.$id ?>()">
                                        <span class="fa fa-times"></span>&nbsp; Cancel
                                    </a>
                            </td>
                            <td id="e1_save<?= $id ?>">
                                <a href="javascript:void(0);" style="color: #333; display: none;" id="<?= 'aftersave'.$id ?>" onclick="<?= 'edit1_score_'.$id ?>()">
                                    <span class="fa fa-pencil"></span>&nbsp; Edit
                                </a>
                                <a href="javascript:void(0);" style="color: #333;" id="<?= 'onsave'.$id ?>" onclick="<?= 'save_score_'.$id ?>()">
                                    <span class="fa fa-save"></span>&nbsp; Save
                                </a>
                            </td>
                        </tr>
                        <?php
                                }
                        echo '<script type="text/javascript">
                            function w'.$id.'(){
                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;



                                if(Number(total) < Number(score)){
                                    document.getElementById("grade'.$id.'").innerHTML = "Invalid";
                                    document.getElementById("grade'.$id.'").style.color = "red";
                                }else{
                                    var grade_total = (score / total) * 50 + 50;
                                    document.getElementById("grade'.$id.'").innerHTML = grade_total.toFixed(2);
                                    document.getElementById("grade'.$id.'").style.color = "black";
                                }                                                        
                            }

                            function save_score_'.$id.'(){

                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;
                                var grade_total = (score / total) * 50 + 50;

                                var fac_id = "'.$fac_id.'";
                                var std_id = "'.$id.'";
                                var Acad = "'.$acad.'";
                                var Quiz = "'.$quiz.'";
                                var Period = "'.$period.'";
                                var sub_id = "'.$sub_id.'";

                                if(Number(total) < Number(score)){
                                    document.getElementById("grade'.$id.'").innerHTML = "Invalid";
                                    document.getElementById("grade'.$id.'").style.color = "red";
                                }else{
                                    $.ajax({
                                        type: "POST",
                                        url: "save.php",
                                        data: {"faci_d": fac_id, "stud_id": std_id, "Acad": Acad, "Quiz": Quiz, "Period": Period, "sub_id": sub_id, "Score": score, "Total_score": total, "Grade": grade_total},
                                       success: function(html){
                                            $("#dsp").html(html);
                                            document.getElementById("grade'.$id.'").style.color = "black";
                                            document.getElementById("aftersave'.$id.'").style.display = "block";
                                            document.getElementById("onsave'.$id.'").style.display = "none";

                                            document.getElementById("edit1_scorex'.$id.'").value = score;
                                            document.getElementById("edit1_overx'.$id.'").value = total;
                                            document.getElementById("edit1_gradex'.$id.'").value = grade_total;

                                            document.getElementById("score'.$id.'").value = score + "/" + total;

                                        },
                                    }); 
                                }
                            }

                            function update_score_'.$id.'(){

                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;
                                var grade_total = (score / total) * 50 + 50;

                                var fac_id = "'.$fac_id.'";
                                var std_id = "'.$id.'";
                                var Acad = "'.$acad.'";
                                var Quiz = "'.$quiz.'";
                                var Period = "'.$period.'";
                                var sub_id = "'.$sub_id.'";

                                if(Number(total) < Number(score)){
                                    document.getElementById("grade'.$id.'").innerHTML = "Invalid";
                                    document.getElementById("grade'.$id.'").style.color = "red";
                                }else{
                                    $.ajax({
                                        type: "POST",
                                        url: "save.php",
                                        data: {"ufaci_d": fac_id, "stud_id": std_id, "Acad": Acad, "Quiz": Quiz, "Period": Period, "sub_id": sub_id, "Score": score, "Total_score": total, "Grade": grade_total},
                                       success: function(html){
                                            $("#dsp").html(html);
                                            document.getElementById("grade'.$id.'").style.color = "black";
                                            document.getElementById("ee_save'.$id.'").style.display = "none";
                                            document.getElementById("ee_edit'.$id.'").style.display = "block";
                                            document.getElementById("edit_scorex'.$id.'").value = document.getElementById("score'.$id.'").value;
                                            document.getElementById("edit_overx'.$id.'").value = total;
                                            document.getElementById("score'.$id.'").value = document.getElementById("edit_scorex'.$id.'").value + "/" + document.getElementById("edit_overx'.$id.'").value;
                                        },
                                    }); 
                                }
                            }

                            function update1_score_'.$id.'(){

                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;
                                var grade_total = (score / total) * 50 + 50;

                                var fac_id = "'.$fac_id.'";
                                var std_id = "'.$id.'";
                                var Acad = "'.$acad.'";
                                var Quiz = "'.$quiz.'";
                                var Period = "'.$period.'";
                                var sub_id = "'.$sub_id.'";

                                if(Number(total) < Number(score)){
                                    document.getElementById("grade'.$id.'").innerHTML = "Invalid";
                                    document.getElementById("grade'.$id.'").style.color = "red";
                                }else{
                                    $.ajax({
                                        type: "POST",
                                        url: "save.php",
                                        data: {"ufaci_d": fac_id, "stud_id": std_id, "Acad": Acad, "Quiz": Quiz, "Period": Period, "sub_id": sub_id, "Score": score, "Total_score": total, "Grade": grade_total},
                                       success: function(html){
                                            $("#dsp").html(html);
                                            document.getElementById("grade'.$id.'").style.color = "black";
                                            document.getElementById("e1_save'.$id.'").style.display = "block";
                                            document.getElementById("e1_edit'.$id.'").style.display = "none";
                                            document.getElementById("edit1_scorex'.$id.'").value = document.getElementById("score'.$id.'").value;
                                            document.getElementById("edit1_overx'.$id.'").value = total;
                                            document.getElementById("score'.$id.'").value = document.getElementById("edit1_scorex'.$id.'").value + "/" + document.getElementById("edit1_overx'.$id.'").value;
                                        },
                                    }); 
                                }
                            }

                            function edit_score_'.$id.'(){
                                document.getElementById("ee_edit'.$id.'").style.display = "none";
                                document.getElementById("ee_save'.$id.'").style.display = "block";
                                document.getElementById("score'.$id.'").disabled = false;
                                document.getElementById("status'.$id.'").style.color = "orange";
                                document.getElementById("status'.$id.'").innerHTML = "Ready";
                                document.getElementById("score'.$id.'").value = document.getElementById("edit_scorex'.$id.'").value;
                                document.getElementById("perfect").value = document.getElementById("edit_overx'.$id.'").value;
                            }

                            function edit1_score_'.$id.'(){
                                document.getElementById("e1_edit'.$id.'").style.display = "block";
                                document.getElementById("e1_save'.$id.'").style.display = "none";
                                document.getElementById("score'.$id.'").disabled = false;
                                document.getElementById("status'.$id.'").style.color = "orange";
                                document.getElementById("status'.$id.'").innerHTML = "Ready";
                                document.getElementById("score'.$id.'").value = document.getElementById("edit1_scorex'.$id.'").value;
                                document.getElementById("perfect").value = document.getElementById("edit1_overx'.$id.'").value;
                            }

                            
                            function cancel_score_'.$id.'(){
                               

                                document.getElementById("ee_edit'.$id.'").style.display = "block";
                                document.getElementById("ee_save'.$id.'").style.display = "none";
                                document.getElementById("score'.$id.'").disabled = true;
                                document.getElementById("score'.$id.'").value = document.getElementById("edit_scorex'.$id.'").value + "/" + document.getElementById("edit_overx'.$id.'").value;

                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;
                                
                                var grade_total = (score / total) * 50 + 50;

                                var cancel_total = document.getElementById("edit_gradex'.$id.'").value;
                                document.getElementById("grade'.$id.'").innerHTML = Number(cancel_total).toFixed(2);
                                document.getElementById("grade'.$id.'").style.color = "black";

                                document.getElementById("status'.$id.'").style.color = "green";
                                document.getElementById("status'.$id.'").innerHTML = "Sent";
                            }

                            function cancel1_score_'.$id.'(){
                               

                                document.getElementById("e1_edit'.$id.'").style.display = "none";
                                document.getElementById("e1_save'.$id.'").style.display = "block";
                                document.getElementById("score'.$id.'").disabled = true;

                                document.getElementById("score'.$id.'").value = document.getElementById("edit1_scorex'.$id.'").value + "/" + document.getElementById("edit1_overx'.$id.'").value;

                                var cancel_total = document.getElementById("edit1_gradex'.$id.'").value;
                                document.getElementById("grade'.$id.'").innerHTML = Number(cancel_total).toFixed(2);

                                var total = document.getElementById("perfect").value;
                                var score = document.getElementById("score'.$id.'").value;
                                
                                var grade_total = (score / total) * 50 + 50;

                                document.getElementById("status'.$id.'").style.color = "green";
                                document.getElementById("status'.$id.'").innerHTML = "Sent";
                            }
                        </script>';


                    }
                ?>
            </tbody>
        </table>
        <div style="min-height: 300px; padding-bottom: 50px;"></div>
    <?php
}
?>