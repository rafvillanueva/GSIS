<?php include("../../site-config.php"); ?>
<?php 
error_reporting(0);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course = mysqli_query($conn, "SELECT * FROM tbl_books WHERE subjectCode = '$id'");
    $row = mysqli_fetch_array($course);
}elseif(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql = mysqli_query($conn, "DELETE FROM tbl_subjects WHERE subjectCode = '$id'");
    header("location: subjects");
}
?>
<?php
if(isset($_POST['newbook'])){
	$name = $_POST['bookname'];
	$description = $_POST['bookDesc'];
	$price = $_POST['bookprice'];

	$rs = mysqli_query($conn, "INSERT INTO tbl_books VALUES(NULL,'$name','$description','$price')");
	?>
	<script type="text/javascript">
		alert("New Book Added");
		//window.location.href = "book.new.php";
	</script>
	<?php
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
<body onload="window.print()">
    <div id="wrapper1">
        <div id="page1-wrapper">
            <div class="container-fluid">
               
                        <div class="panel-body">
                          <?php
                          if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $student_view = "SELECT * FROM tbl_students WHERE s_id = '$id'";
                            $student_query_view = mysqli_query($conn, $student_view);
                            $row = mysqli_fetch_array($student_query_view);
                          }
                          ?>
                          <?php
                            

                            if(isset($_GET['prev'])){
                              if($_GET['q'] == "0"){
                                $data = "Nursery";
                              }elseif($_GET['q'] == "1"){
                                $data = "K-1";
                              }elseif($_GET['q'] == "2"){
                                $data = "K-2";
                              }elseif($_GET['q'] == "G1"){
                                $data = "Grade-1";
                              }elseif($_GET['q'] == "G2"){
                                $data = "Grade-2";
                              }elseif($_GET['q'] == "G3"){
                                $data = "Grade-3";
                              }elseif($_GET['q'] == "G4"){
                                $data = "Grade-4";
                              }elseif($_GET['q'] == "G5"){
                                $data = "Grade-5";
                              }elseif($_GET['q'] == "G6"){
                                $data = "Grade-6";
                              }
                              $l = $_GET['q'];
                            }else{
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
                              $l = $row['s_level'];
                            }
                          ?>
                          <h1>
                          <center><span style="letter-spacing: 5px; font-size: 42px;">STATEMENT OF ACCOUNT</span></center>
                          <hr>
                          </h1>
                          <h3>
                            <b style="text-transform: uppercase;"> <b style="letter-spacing: 1px;"><?= $row['s_lname'] . ", " . $row['s_fname'] . " ". $row['s_mname'] . " | " . $data ?></b></b>
                          </h3>
                          <script type="text/javascript">
                            function searchz() {
                              var search_query = document.getElementById("getgradezz").value;
                              var id = "<?= $_GET['id'] ?>";
                              window.location.href = "payment.php?id=" + id + "&q=" + search_query + "&prev";
                            }
                          </script>
                          <?php
                          if(isset($_GET['prev'])){
                            if($_GET['q'] == "0" || $_GET['q'] == "1" || $_GET['q'] == "2"){
                              $g_id = 1;
                            }elseif($_GET['q'] == "G1" || $_GET['q'] == "G2" || $_GET['q'] == "G3" || $_GET['q'] == "G4" || $_GET['q'] == "G5" || $_GET['q'] == "G6"){
                              $g_id = 2;
                            }
                          }else{
                            if($row['s_level'] == "0" || $row['s_level'] == "1" || $row['s_level'] == "2"){
                              $g_id = 1;
                            }elseif($row['s_level'] == "G1" || $row['s_level'] == "G2" || $row['s_level'] == "G3" || $row['s_level'] == "G4" || $row['s_level'] == "G5" || $row['s_level'] == "G6"){
                              $g_id = 2;
                            }
                          }
                          $bill = mysqli_query($conn, "SELECT * FROM tbl_tuition WHERE ID = '$g_id'");
                          $b_row = mysqli_fetch_array($bill);
                          if(isset($_GET['prev'])){
                            $dd = $_GET['q'];
                            $level = $_GET['q'];
                          }else{
                            $dd = $row['s_level'];
                            $level = $row['s_level'];
                          }
                          /* Test Result */
                          #echo "SELECT Sum(s_price) as t FROM tbl_books WHERE s_level = '$dd'";
                          #echo "SELECT Sum(b_price) as t FROM tbl_billing <br>";


                          $book = mysqli_query($conn, "SELECT Sum(s_price) as t FROM tbl_books WHERE s_level = '$dd'");
                          $billingz = mysqli_query($conn, "SELECT Sum(b_price) as t FROM tbl_billing");
                          $s_row = mysqli_fetch_array($book);
                          $bb_row = mysqli_fetch_array($billingz);
                          
                          $total =  $s_row['t'] + $bb_row['t'] + $b_row['s_tuition'];
                          $id = $row['s_id'];
                          
                          $history = mysqli_query($conn, "SELECT Sum(s_amount) as t FROM tbl_history WHERE s_id = '$id' AND s_level = '$level'");
                          $h_row = mysqli_fetch_array($history);
                          $remain = $total - $h_row['t'];
                          ?>
                          <hr>
                            <blockquote>
                              <h1><b style="font-size: 62px; color: green">₱. <?= number_format($remain, 2) ?></b></h1>
                              <i>Remaining Balance.</i>
                            </blockquote>
                        <div class="container-fluid">
                          
                          <div class="pull-left1">
                             <b><i style="color: gray">Tuition Fee</i></b><br>
                            <b><blockquote>
                              <b style="font-size: 14px; text-transform: uppercase;"> <?= $data ?> : ₱. <font color="red"> <?= number_format($b_row['s_tuition'], 2) ?> </font></b><br>
                             </blockquote>
                            <b><i style="color: gray">List Of Payments</i></b><br>
                            <b><blockquote>
                              <?php
                              $bill = mysqli_query($conn, "SELECT * FROM tbl_billing");
                              while($b_row = mysqli_fetch_array($bill)){
                              ?>
                              <b style="font-size: 14px; text-transform: uppercase;"> <?= $b_row['b_name'] ?> : ₱. <font color="red"> <?= number_format($b_row['b_price'], 2) ?> </font></b><br>
                              <?php } ?>
                             </blockquote>

                             <b><i style="color: gray">List Of Books</i></b><br>
                            <b><blockquote>
                              <?php
                              $bill = mysqli_query($conn, "SELECT * FROM tbl_books WHERE s_level = '$dd'");
                              while($b_row = mysqli_fetch_array($bill)){
                              ?>
                              <b style="font-size: 14px; text-transform: uppercase;"> <?= $b_row['s_book'] ?> : ₱. <font color="red"> <?= number_format($b_row['s_price'], 2) ?> </font></b><br>
                              <?php } ?>
                             </blockquote>
                          </div>
                          <hr>
                          <div class="pull-lef1t" style="font-size: 24px;">
                            <b>Total Balance : <font color="red">₱. <?= number_format($total, 2) ?></font></b><br>
                          <hr><br>
                          </div>
                          <div class="pull-left">
                            <form method="POST" action="payment.php">
                              <?php
                              if(isset($_POST['payment'])){
                                date_default_timezone_set("Asia/Manila");
                                $id = $_POST['s_id'];
                                $level = $_POST['s_level'];
                                $payment = $_POST['s_amount'];
                                $remain = $_POST['s_remain'];
                                $date = date("F d, Y h:m:s A");
                                if($payment <= $remain){
                                  $sql = "INSERT INTO tbl_history VALUES(NULL,'$id','$payment','$level','$date')";
                                  $rs = mysqli_query($conn, $sql);
                                  ?>
                                  <script type="text/javascript">
                                    alert("Payment Success");
                                    window.location.href = "payment.php?id=<?= $id ?>";
                                  </script>
                                  <?php
                                }else{
                                  ?>
                                  <script type="text/javascript">
                                    alert("Invalid Amount.");
                                    window.location.href = "payment.php?id=<?= $id ?>";
                                  </script>
                                  <?php
                                }
                                
                              }
                              ?>
                            </form>
                          </div>
                        </div>
                        <b>Payment History</b><br><br>
                        <script type="text/javascript">
                          function search() {
                            var search_query = document.getElementById("getgradez").value;
                            var id = "<?= $_GET['id'] ?>";
                            window.location.href = "payment.php?id=" + id + "&q=" + search_query;
                          }
                        </script>
                        <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th width="50">#</th>
                              <th>Amount</th>
                              <th width="150">Grade</th>
                              <th width="300">Date and Time</th>
                            </tr>
                            <tbody>
                              <?php
                              if(isset($_GET['q'])){
                                $g = $_GET['q'];
                                $sql = mysqli_query($conn, "SELECT * FROM tbl_history WHERE s_id = '$id' AND s_level like '$g' ORDER BY ID DESC");
                              }else{
                                $level = $_POST['s_level'];
                                $sql = mysqli_query($conn, "SELECT * FROM tbl_history WHERE s_id = '$id' AND s_level = '$dd' ORDER BY ID DESC");
                              }
                              $num = 1;
                              while($rowz = mysqli_fetch_array($sql)){
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
                                <tr>
                                  <td><?= $num ?></td>
                                  <td><?= number_format($rowz['s_amount'], 2) ?></td>
                                  <td><?= $data ?></td>
                                  <td><?= $rowz['s_date'] ?></td>
                                </tr>
                                <?php
                                $num++;
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                        </div>
                    </div>
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