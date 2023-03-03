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
            $stud_id =$row['Fac_Id'];
            if(isset($_POST['btn-search'])){
                $val = $_POST['val-search'];
                $subjects = "SELECT * FROM tbl_subjects WHERE subjectCode like '%$val%' OR Description like '%$val%' ORDER BY ID DESC";
                $subjects_query = mysqli_query($conn, $subjects);
                while($row = mysqli_fetch_array($subjects_query)){
                    echo '<tr>';
                    echo '<td>'.$row['subjectCode'].'</td>';
                    echo '<td>'.$row['Description'].'</td>';
                    echo '<td>'.$row['UnitLec'].'</td>';
                    echo '<td>'.$row['UnitLab'].'</td>';
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
                    echo '<td>'.$row['Year'].'</td>';
                    echo '<td>'.$row['Section'].'</td>';
                    echo '<td style="font-size: 11px; width: 20px;">';
                    ?>
                    <a href="?enroll=<?php echo $row['ID']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to remove this subject ?');" class="btn btn-danger btn-xs" style="margin-right: 5px;"><i class="fa fa-trash-o"></i> Removed</a>
                    <?php
                    echo '';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
</table>
<div style="min-height: 300px; padding-bottom: 50px;"></div>