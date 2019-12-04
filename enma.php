<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php 
	// $servername = "localhost";
	// $username = "root";
	// $password = "";			
	// $dbname = "sshop";	
	// $conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	$tab=strval($_GET['tab']);	
	$IDs=strval($_GET['dore']);		
	if($tab=="games")
	{
		$quer = "delete from odetail where Gid = $IDs";
		$conn->query($quer);
		$quer = "delete from gkeys where Gid = $IDs";
		$conn->query($quer);
		$quer = "delete from config where Gid = $IDs";
		$conn->query($quer);
		$quer = "delete from games where Gid = $IDs";
		$conn->query($quer);
	}
	if($tab=="orders")
	{
		$quer = "delete from odetail where Oid = $IDs";
		$conn->query($quer);
		$quer = "delete from orders where Oid = $IDs";
		$conn->query($quer);
	}
	if($tab=="Customera")
	{		
		$quer = "select Oid from orders where Cid = $IDs";
		$result=$conn->query($quer);
		while($row=mysqli_fetch_array($result))
		{
			$quer = "delete from odetail where Oid = ".$row['Oid'];
			$conn->query($quer);
		}
		$quer = "delete from orders where Cid = $IDs";
		$conn->query($quer);
		$quer = "delete from Customera where Cid = $IDs";
		$conn->query($quer);
	}
	if(!$conn->query($quer))
	{
		echo 'FUCK</br>';
		echo mysqli_error($conn);
		echo '</br>FUCK</br>';
	}
	else
	echo 'YAY ?';
	?>
</body>
</html>