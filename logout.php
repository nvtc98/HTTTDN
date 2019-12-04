<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php session_destroy(); 
	$_SESSION['IDk']=0;
	header('Location: adcpg.php');?>
</body>
</html>