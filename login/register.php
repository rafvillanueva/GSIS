<?php require("site-content.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $config['Title'] ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['Favicon'] ?>"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/modify/css/style.css" rel="stylesheet" type="text/css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>    
    <script src="vendor/custom/tnek.js"></script>
    <style type="text/css">
    	body {background-color: #f1f1f1;}
    </style>
</head>
<body>
<?php
	require("pages/k-register.php");
?>
</body>
</html>