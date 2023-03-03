<?php include('../site-config.php'); ?>
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
                    <th>Student ID #</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th style="width: 70px;"><center>Final Grade</center></th>
                    <th><center>Remarks</center></th>
                </tr>                
            </thead>
            <tbody>
                <?php 
                    $acad = $_POST['Acad'];
                    $sem = $_POST['Semester'];
                    $quiz = $_POST['Quiz'];
                    $period = $_POST['Period'];
                    $sub_id = $_POST['sub_id'];
                    $section = $_POST['section'];
                    $fac_id = $_SESSION['user'];
                    $stud_id = $id;
                    $num = 0;
                    echo '<input value="'.$section.'" id="sectionx" type="hidden">';
                    $query = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$sub_id' AND Section = '$section' AND Semester = '$sem' AND Year = '$acad'");
                    while( $rowx = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <?php 
                                $id = $rowx['Stud_Id'];
                                $call_student = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$id'");
                                $rowz = mysqli_fetch_array($call_student);
                                include("shscompute.php"); 
                            ?>
                            <td><?= $id ?></td>
                            <td><a href=""><?= $rowz['lastName'] . ', ' . $rowz['firstName'] . ' ' . $rowz['middleName']; ?></a></td>
                            <?php
                            $score = mysqli_query($conn, "SELECT * FROM tbl_scores WHERE Stud_id = '$id' AND SubjectCode = '$sub_id' AND Year = '$acad' AND Grade_Components = '$quiz' AND Period = '$period'");
                            $row_score = mysqli_fetch_array($score);
                            if(!empty($row_score['Stud_id'])){
                            ?>
                            <td><?= $rowz['Course'] ?></td>
                            
                            <?php 

                            $post_grade = mysqli_query($conn, "SELECT count(*) as e FROM tbl_grades WHERE Fac_Id = '$fac_id' AND Stud_id = '$id' AND Year = '$acad' AND Sem = '$sem' AND Section = '$section' AND SubjectCode = '$sub_id'");
                            $post_row = mysqli_fetch_array($post_grade);

                            $grade = number_format((float)$final_grade, 0, '.', ',');

                            if($grade >= 100){
                                if($post_row['e'] == 0){                                    
                                echo '<td><center><input class="form-control" style="text-align: center;" name="grade[]" value="100"></center></td>';
                                }else{

                                echo '<td><center><input readonly class="form-control" style="text-align: center;" name="grade[]" value="100"></center></td>';
                                }
                                echo '<td><center>PASSED</center></td>';
                                echo '<input type="hidden" value="PASSED" name=""Remarks[]>';
                            }elseif($grade >= 75){
                                 if($post_row['e'] == 0){                                    
                                echo '<td><center><input class="form-control" style="text-align: center;" name="grade[]" value="'.$grade.'"></center></td>';
                                }else{
                                echo '<td><center><input readonly class="form-control" style="text-align: center;" name="grade[]" value="'.$grade.'"></center></td>';
                                }
                                
                                echo '<td><center>PASSED</center></td>';
                                echo '<input type="hidden" value="PASSED" name="Remarks[]">';
                            }else{
                                if($post_row['e'] == 0){
                                echo '<td><input class="form-control" style="text-align: center; color: red" name="grade[]" value="'.$grade.'"></td>';
                                }else{
                                echo '<td><input readonly class="form-control" style="text-align: center; color: red" name="grade[]" value="'.$grade.'"></td>';
                                }
                                echo '<td><center style="color: red">FAILED</center></td>';
                                echo '<input type="hidden" value="FAILED" name="Remarks[]">';
                            }
                            ?>
                            <input type="hidden" value="<?= $id ?>" name="std_id[]">
                            <input type="hidden" value="<?= $acad ?>" name="Year[]">
                            <input type="hidden" value="<?= $sem ?>" name="Semester[]">
                            <input type="hidden" value="<?= $section ?>" name="Section[]">
                            <input type="hidden" value="<?= $fac_id ?>" name="fac_id[]">
                            <input type="hidden" value="<?= $sub_id ?>" name="SubjectCode[]">
                            <?php


                                }else{
                            ?>
                            <td><?= $rowz['Course'] ?></td>
                            <td><center>-</center></td>
                            <td><center>-</center></td>
                            
                            
                        </tr>
                        <?php
                        }
                        $num++;
                    }
                    echo '<input type="hidden" value="'.$num.'" name="count">';
                ?>
            </tbody>
        </table>
        <div style="min-height: 300px; padding-bottom: 50px;"></div>
    <?php
}
?>