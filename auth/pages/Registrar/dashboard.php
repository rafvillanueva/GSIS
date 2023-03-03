<?php include("../../site-config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/site-content/admin/favicon.png"/>
    <title><?php echo $config['title'] ?></title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/custom/tnek.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <style type="text/css">
    	.clearbr{ margin-left: 1px; }
    	@media only screen and (max-width: 600px) {
    		.clearbr{ margin-left: 1px; margin-bottom: 5px;}
    	}
    </style>
    
</head>
<!-- Settings -->

<body>


    <div id="wrapper">
        <?php
			include("../../site-config.php");
			ob_start();
			session_start();
			if(isset($_SESSION['user']) == ""){
			    ?><script type="text/javascript">window.location.href = "../../"</script><?php
			}
			$user = $_SESSION['user'];
			$rs_adm = mysqli_query($conn, "SELECT * FROM tbl_accounts WHERE Username = '$user'");
			$row_admn = mysqli_fetch_array($rs_adm);

			if($row_admn['Level'] == "Registrar"){
			    $link = '';
			}elseif($row_admn['Level'] == "Administrator"){
			    $link = '
			    <a href="../../">
                    <img src="assets/icons/Double Left_96px.png" height="32" style="position: relative;">
                    <b> Return</b>
                </a>
			    ';
			}else{
			   ?><script type="text/javascript">window.location.href = '../../../login/'</script><?php
			}


			?>

			<style type="text/css">
			    @import url('https://fonts.googleapis.com/css?family=Montserrat');

			    #kiao:hover {background-color: transparent;}
			    a {color: #000; font-family: font-family: 'Montserrat', sans-serif;}
			    a:active {background-color: transparent;}

			    body {font-family: 'Montserrat', sans-serif;}
			    @media only screen and (max-width: 600px) {
			        .fontz{ font-size: 14px !important;}
			        .imagez{ height: 32px !important; width: 32px !important; position: relative; top: 5px; }
			    }
			    @media only screen and (max-width: 400px) {
			        .fontzz{ font-size: 11px !important;}
			        .imagezz{ height: 22px !important; width: 22px !important; position: relative; top: 5px; }
			    }
			    .navbar-collapse{border-top: 0px;}
			</style>
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #fff; border-bottom-color: black; border: 0px; height: 130px; box-shadow: 2px 2px 2px #e1e1e1; border-top: 15px solid #63A1A7;">
			    <div class="navbar-header">
			        <button type="button" style="background-color: #fff !important;" class="navbar-toggle btn-danger btn" data-toggle="collapse" data-target=".navbar-collapse">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			        </button>
			        <a class="navbar-brand" href="index.php" style="color: #fff;">
			            <img src="../../fav.png" height="85">
			        </a>
			    </div><br><br><br><br>

			    <div class="navbar-default sidebar" role="navigation" style="">
			        <div class="sidebar-nav navbar-collapse">
			            <ul class="nav" id="side-menu">
			                <li class="sidebar-search">
			                       <b><?= $row_admn['Level'] ?> - cPANEL</b><hr>

			                    
			                   <?= $link ?>
			                   <a href="../../../login/logout/logout.php?logout">
			                        <img src="assets/icons/Shutdown_96px.png" height="32" style="position: relative;">
			                        <b> Logout</b>
			                    </a>
			                </li>
			                <li>
			                </li>
			                <script type="text/javascript">
			                    function url() {
			                        var url = document.getElementById("url").value;
			                        window.location.href = url;
			                    }
			                </script>
			            </ul>
			        </div>
			    </div>
			</nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <br>
                </div>
				<div class="row"> <!-- List -->
					<div style="background-color: #EAEAEA; border-radius: 1px; padding: 8px;">
						<div class="conta1iner">
							<b class="page-header"style="font-size: 18px; color: gray; letter-spacing: 1px; text-transform: uppercase;"><!--&nbsp;  <span class="fa fa-book"></span --> RECORDS DETAILS AND OPERATIONS</b>
						</div>
					</div>
					<br>
					<div class="pull-right">
						<a href="logs.php" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/shs-c.png" height="55"><br> Academic Year
						</a>
						<a href="students" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/std-icon.png" height="55"><br> Student
						</a>
						<a href="faculty" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/fac-icon.png" height="55"><br> Faculty 
						</a>
						<a href="subjects" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/subj-icon.png" height="55"><br> Subjects 
						</a>
						<a href="section" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/sec-icon.png" height="55"><br> Sections 
						</a>
					</div>
				</div>
				<!-- List -->
				<br>
				<div class="row"> <!-- Additions -->
					<div style="background-color: #EAEAEA; border-radius: 1px; padding: 7px;">
						<div class="conta1iner">
							<b class="page-header"style="font-size: 18px; color: gray; letter-spacing: 1px; text-transform: uppercase;"><!--&nbsp;  <span class="fa fa-plus"></span> --> RECORD ENTRIES</b>
						</div>
					</div>
					<br>
					<div class="pull-right">
						<a href="set.subject.php" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/Todo List_96px.png" height="55"><br> Subjects <br> (Grade Level)
						</a>
						<a href="new-student" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/astd-icon.png" height="55"><br> Student Enrollment <br> -
						</a>
						<a href="faculty-new" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/afac-icon.png" height="55"><br> Faculty Enlistment<br> -
						</a>
						<a href="new-subject" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/asubj-icon.png" height="55"><br> Subjects Offerings<br> -
						</a>
						<a href="new-section" style="letter-spacing: 1px; margin-right: 18px; width: 170px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/asec-icon.png" height="55"><br> Sections Offerings<br> -
						</a>
					</div>
				</div>
				<br>
				<div class="row"> <!-- Account -->
					<div style="background-color: #EAEAEA; border-radius: 1px; padding: 8px;">
						<div class="conta1iner">
							<b class="page-header"style="font-size: 18px; color: gray; letter-spacing: 1px; text-transform: uppercase;"><!--&nbsp;  <span class="fa fa-plus"></span> --> BILLING</b>
						</div>
					</div>
					<br>
					<div class="pull-right">
						<a href="tuition.php" style="letter-spacing: 1px; margin-right: 18px; width: 150px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/Open_96px.png" height="55"><br> Tuition Fee
						</a>
						<a href="bills.php" style="letter-spacing: 1px; margin-right: 18px; width: 150px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/Open_96px.png" height="55"><br> Bills
						</a>
						<a href="books.php" style="letter-spacing: 1px; margin-right: 18px; width: 150px; margin-bottom: 20px; font-size: 12px; font-family: verdana;" class="btn btn-default">
							<img src="assets/icons/Open_96px.png" height="55"><br> Book w/ Price 
						</a>
					</div>
				</div>
				<!-- Additions -->
            </div>
        </div>
    </div>
</body>
</html>
