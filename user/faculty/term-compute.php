<?php

######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
###################################### 

$id = $_SESSION['user'];
/*if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
    echo  $s_id . "qwewqe";
}*/
if(isset($_POST['trigger']) == 1){

    $f_str = $_POST['sub_id'];
    $f_val = 'SHS';
    $f_rs = strpos($f_str, $f_val);

    if($f_rs === false){
          $periodz_1 = "Prelim";
          $periodz_2 = "Midterm";
          $periodz_3 = "Semi-Finals";
          $periodz_4 = "Finals";
    }else{
          $periodz_1 = "1st Grading";
          $periodz_2 = "2nd Grading";
          $periodz_3 = "3rd Grading";
          $periodz_4 = "4th Grading";
    }

    $acad = $_POST['Acad'];
    $sem = $_POST['Semester'];
    $quiz = $_POST['Quiz'];
    $period = $_POST['Period'];
    $sub_code = $_POST['sub_id'];
    $section = $_POST['section'];
    $fac_id = $_SESSION['user'];
    $stud_id = $id;
    $num = 0;

    if($f_rs === false) {
        #College
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr style="text-transform: uppercase;">
                    <th>Student Complete Name <br><sup>( LASTNAME :: FIRSTNAME :: MIDDLENAME )</sup></th>
                    <th style="width: 70px;"><center>Prelim <sup>Grade</sup></center></th>
                    <th style="width: 70px;"><center>Midterm <sup>Grade</sup></center></th>
                    <th style="width: 150px;"><center>Semi-Finals <sup>Grade</sup></center></th>
                    <th style="width: 70px;"><center>Finals <sup>Grade</sup></center></th>
                    <th><center>&#8211;</center></th>
                    <th style="width: 70px;"><center>Semestral <sup>Grade</sup></center></th>
                    <th style="width: 70px;"><center>Numeric <sup>Grade</sup></center></th>
                    <th><center></center></th>
                </tr>
                <tbody>
                    <?php

                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$sub_code' AND Year = '$acad' AND Semester = '$sem' AND Section = '$section'");
                    while( $row = mysqli_fetch_array($rs)){
                        $id = $row['Stud_Id'];
                        $sub_id = $row['subjectCode'];
                        $acad = $row['Year'];
                        include("controls/view/computation.php");
                        $std_rs = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$id'");
                        $std_row = mysqli_fetch_array($std_rs);
                        $salt_dec = $id . $acad . $sem . 0 . "krc";
                        $salt_enc = hash("md5", $salt_dec);
                        $auth = "../progress/?auth=" . $salt_enc . "&std=" . $id . "&acad=" . $acad . "&sem=" . $sem . "&r=0";
                        ?>
                        <tr id="xhover" onclick="window.location.href = '<?= $auth ?>';">
                            <td><?= $std_row['lastName'] . ", " . $std_row['firstName'] . " " . $std_row['middleName']  ?></td>
                            <td><center><?= number_format($prelim, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($midterm, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($semiterm, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($finals, 2 , ".", ",") ?></center></td>
                            <td></td>
                            <td><center><?= number_format($final_grade, 2 , ".", ",") ?></center></td>
                            <td><center><?= $numeric_grade ?></center></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }else{
        #Senoir Highschool.
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr style="text-transform: uppercase;">
                    <th>Student Complete Name <br><sup>( LASTNAME :: FIRSTNAME :: MIDDLENAME )</sup></th>
                    <th style="width: 70px;"><center>First <sup>Grading</sup></center></th>
                    <th style="width: 70px;"><center>Second <sup>Grading</sup></center></th>
                    <th style="width: 70px;"><center>Third <sup>Grading</sup></center></th>
                    <th style="width: 70px;"><center>Fourth <sup>Grading</sup></center></th>
                    <th><center>&#8211;</center></th>
                    <th style="width: 70px;"><center>Semestral <sup>Grade</sup></center></th>
                    <th style="width: 70px;"><center>Numeric <sup>Grade</sup></center></th>
                </tr>
                <tbody>
                    <?php
                    $rs = mysqli_query($conn, "SELECT * FROM tbl_subjectsenrolled WHERE subjectCode = '$sub_code' AND Year = '$acad' AND Semester = '$sem' AND Section = '$section'");
                    while( $row = mysqli_fetch_array($rs)){
                        $id = $row['Stud_Id'];
                        $sub_id = $row['subjectCode'];
                        $acad = $row['Year'];
                        include("controls/view/computation.php");
                        $std_rs = mysqli_query($conn, "SELECT * FROM tbl_studentrecord WHERE Stud_Id = '$id'");
                        $std_row = mysqli_fetch_array($std_rs);
                        $salt_dec = $id . $acad . $sem . 0 . "krc";
                        $salt_enc = hash("md5", $salt_dec);
                        $auth = "../progress/?auth=" . $salt_enc . "&std=" . $id . "&acad=" . $acad . "&sem=" . $sem . "&r=0";
                        ?>
                        <tr id="xhover" onclick="window.location.href = '<?= $auth ?>';">
                            <td><?= $std_row['lastName'] . ", " . $std_row['firstName'] . " " . $std_row['middleName']  ?></td>
                            <td><center><?= number_format($prelim, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($midterm, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($semiterm, 2 , ".", ",") ?></center></td>
                            <td><center><?= number_format($finals, 2 , ".", ",") ?></center></td>
                            <td></td>
                            <td><center><?= number_format($final_grade, 2 , ".", ",") ?></center></td>
                            <td><center><?= $numeric_grade ?></center></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>