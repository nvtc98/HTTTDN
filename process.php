<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";			
	$dbname = "sshop";	
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	$quer="select * from admini where name='".$_POST['usname']."'";
	$result=$conn->query($quer);
	$row=mysqli_fetch_array($result);
	$namae=$_POST['usname'];
	if($namae!="")
	if($row['name']==$_POST['usname'] && $row['passwd']==$_POST['passwde'])
	{			
		$_SESSION['IDk']=$row['name'];
		// $_SESSION['permit']=$row['permit'];
	}			
	header('Location: adcpg.php');
	?>
</body>
</html>