<style type="text/css">
    .navbar-collapse{ position: relative; top: -15px; }
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #ED1F24;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" style="color: #fff;">           
            <img src="../img/vineyard.png">
        </a>
    </div><br><br><br><br>
    <div class="navbar-default sidebar" role="navigation" style="">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <i class="badge" style="letter-spacing: 2px; width: 100%;"><small>Content Menu</small></i>
                     <hr>
                     
                    <?php
                    if(isset($_POST['btn_search'])){
                        $year = $_POST['t_year'];
                        $sem = $_POST['t_sem'];
                        $search1 = mysqli_query($conn, "SELECT count(*) as e FROM tbl_subjectsenrolled WHERE Stud_Id = '$id' AND Year = '$year' AND Semester = '$sem'");
                        $rowx1 = mysqli_fetch_array($search1);
                        $code = $rowx1['subjectCode'];
                        if($rowx1['e'] != 0){
                            $salt_dec = $id  . $year . $sem . 5 . "krc";
                            $salt_enc = hash("md5", $salt_dec);
                            $link = "../progress?auth=" . $salt_enc . "&std=" . $id . "&acad=" . $year . "&sem=" . $sem . "&r=" . 5;
                            ?>
                            <!-- <a href="main" style="background-color: #eee;">
                                <img src="assets/icons/School_96px.png" height="32" style="position: relative;">
                                <b> Grade Record</b>
                            </a> -->
                            <!-- <a href="grades?auth=<?= $salt_enc ?>&std=<?= $id . "&year=" . $year . "&sem=" . $sem ?>">
                                <img src="assets/icons/Exam_96px.png" height="32" style="position: relative;">
                                <b> View Grades</b>
                            </a>
                            <a href="<?= $link ?>">
                                <img src="assets/icons/Futures_96px.png" height="32" style="position: relative;">
                                <b> Progress</b>
                            </a> -->
                            <?php
                        }else{
                         ?>
                         
                         <?php
                        }
                    }
                    ?>
                    <a href="main">
                        <img src="assets/icons/School_96px.png" height="32" style="position: relative;">
                        <b> Grade Record</b>
                    </a>
                    <a href="../student/">
                        <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                        <b> Return</b>
                    </a>
                    <a href="../../login/logout/logout.php?logout">
                        <img src="assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
                        <b>  Logout </b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>