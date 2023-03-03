<?php
######################################
# ------- Global Information ------- #
######################################
include('../../config/db.php');       #
include('controls/global_info.php'); #
######################################
if(isset($_GET['subject'])){
    $s_id = $_GET['subject'];
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
    <title>Vineyard College</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/site-content/admin/favicon.png"/>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        #kiao:hover {background-color: transparent;}
        a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
        a:active {background-color: transparent;}

        body {font-family: 'Montserrat', sans-serif;}
        
    </style>
</head>
<body onload="jjj()">
<?php include("nav.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
       <!--  <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><i class="fa fa-user"></i> Welcome Back! <b><?= $info_row['lastName'] . ', ' . $info_row['firstName'] . ' ' . $info_row['middleName'] ?></b></h2>
            </div>
        </div> --><br>
        <div class="row">
            <div class="col-md-12">                
                <div class="jumbotron" style="padding: 20px;">
                    <?php 

                        $subject = mysqli_query($conn, "SELECT * FROM tbl_facultyloads WHERE ID = '$s_id'");
                        $row_s = mysqli_fetch_array($subject);

                        $s_code = $row_s['SubjectLoad'];
                        $call_description1 = mysqli_query($conn, "SELECT * FROM tbl_subjects WHERE SubjectCode = '$s_code'");
                        $row_d = mysqli_fetch_array($call_description1);

                    ?>
                    Subject Code : &nbsp;<label> <i><?= $row_d['subjectCode'] ?></i> </label> <br>
                    Description : &nbsp;<label> <i><?= $row_d['Description'] ?></i> </label><br>
                    <div id="info">
                        Academic Year/Term : &nbsp;<label> <i id="dacad"></i> </label> <br>
                        Semester : &nbsp;<label> <i id="dsem"></i> </label> <br>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="posted.php">            
        <div class="row">
            <div class="col-lg-3">
                <button class="btn btn-success btn-block" name="postgrade" style="letter-spacing: 1px;"><span class="fa fa-check"></span> POST GRADE</button>
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Academic Year</b><br>
                <input type="hidden" id="sub_id" value="<?= $row_d['subjectCode'] ?>" name="">
                <select class="form-control" id="acad" onchange="jjj()" style="margin-top: 5px;">
                    <?php 

                        $query = mysqli_query($conn, "SELECT DISTINCT(Year) FROM tbl_facultyloads ORDER BY Year DESC");
                        while( $row = mysqli_fetch_array($query)){
                            ?>
                            <option><?= $row['Year']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>            
            <div class="col-lg-3">
               <input type="hidden" id="section" value="<?= $row_s['Section']; ?>" name="">
               <b style="letter-spacing: 1px;">&nbsp;Semester</b><br>
                <select class="form-control" id="semester" onchange="jjj()" style="margin-top: 5px;">
                    <option selected value="<?= $row_s['Semester'] ?>">
                    <?php 
                        if($row_s['Semester'] == 1){
                            echo $row_s['Semester'] . "st Semester";
                        }else{
                            echo $row_s['Semester'] . "nd Semester";
                        }
                    ?>                            
                    </option>
                </select>
            </div>
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Grade Components</b><br>
                <select class="form-control" id="quiz" onchange="jjj()" style="margin-top: 5px;">
                    <option>Quiz 1</option>
                    <option>Quiz 2</option>
                    <option>Quiz 3</option>
                    <option>Performance Task</option>
                    <option>Exam</option>
                </select>
            </div>
            <div class="col-lg-3">
                <b style="letter-spacing: 1px;">&nbsp;Period</b><br>
                <select class="form-control" id="period" onchange="jjj()" style="margin-top: 5px;">
                    <option>Prelim</option>
                    <option>Midterm</option>
                    <option>Semi-Final</option>
                    <option>Finals</option>
                </select>
            </div>
        </div>
        <hr>
        <div id="idsp"></div>
        <div id="dsp"></div>
        </form>
        <?php
        if(isset($_POST['postgrade']) ) {
        /*$id = $_POST['idx'];
        */
        if(!empty($_POST['grade'])){

            /*foreach($_POST['grade'] as $grade){
               
            //$sql_multi_del = mysqli_query($conn, $query_multi_del); 
            //echo $selected."</br>";
            }*/
            $num = $_POST['count'];
            $fac_id = $_POST['fac_id'];
            $Remarks = $_POST['Remarks'];
            $grade = $_POST['grade'];
            $std_id = $_POST['std_id'];
            $Year = $_POST['Year'];
            $Semester = $_POST['Semester'];
            $Section = $_POST['Section'];
            $SubjectCode = $_POST['SubjectCode'];

            for($i = 0; $i < $num; $i++)
            {

                $verify = mysqli_query($conn, "SELECT count(*) as e FROM tbl_grades WHERE Fac_Id = '".$fac_id[$i]."' AND Stud_Id = '".$std_id[$i]."' AND SubjectCode = '".$SubjectCode[$i]."' AND Year = '".$Year[$i]."' AND Sem = '".$Semester[$i]."' AND Section = '".$Section[$i]."'");
                $vrow = mysqli_fetch_array($verify);
                if($vrow['e'] == 0){
                     $query = "INSERT INTO tbl_grades(Fac_Id, Stud_Id, SubjectCode, Year, Sem, Section, Grade, Remark) VALUES('".$fac_id[$i]."','".$std_id[$i]."','".$SubjectCode[$i]."','".$Year[$i]."','".$Semester[$i]."','".$Section[$i]."','".$grade[$i]."','".$Remarks[$i]."')";
                     $sql = mysqli_query($conn, $query);
                }

               
            }

        }
    }

        ?>
    </div>
</div>
<style type="text/css">#info { display: none; }</style>
<script type="text/javascript">
    function jjj(){
        var acad = document.getElementById("acad").value;
        var sem = document.getElementById("semester").value;
        var quiz = document.getElementById("quiz").value;
        var period = document.getElementById("period").value;
        var sub_id = document.getElementById("sub_id").value;
        var section = document.getElementById("section").value;
        var trgr = 1;
        document.getElementById("info").style.display = "block";
        document.getElementById("dacad").innerHTML = acad;
        document.getElementById("dsem").innerHTML = sem + ' | Semester';

        $.ajax({
            type: "POST",
            url: "rsgrade.php",
            data: {"trigger": trgr, "Acad": acad, "Semester": sem, "Quiz": quiz, "Period": period, "sub_id": sub_id, "section": section},
           success: function(html){
                $('#idsp').html(html);
            },
        }); 

    }
</script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
