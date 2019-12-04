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
	$tab = $_POST['tab'];
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn->query("set names utf8");
	$quer2="SELECT COLUMN_NAME as col FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tab."'";
	$result2 = $conn->query($quer2);
	$row = mysqli_fetch_array($result2);
	$quer = "insert into `".$tab."` (`".$row['col'].'`';
	while ($row = mysqli_fetch_array($result2))
	{		
		$quer = $quer.', `'.$row['col'].'`';
	}
	$result2 = $conn->query($quer2);
	$row = mysqli_fetch_array($result2);
	if($_POST[$row['col']]!='')
	$quer = $quer.") values ( '".$_POST[$row['col']]."'";
	else $quer = $quer.") values ( '".$_POST[$row['col']]."'";
	$target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gimage"]["name"]);
	echo $_FILES["gimage"]["tmp_name"]."<br />".$target_file;
	$fname = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	while ($row = mysqli_fetch_array($result2))
	{
		if($row['col']!='gimage'){
			if ($row['col']=='GGid')
			{
				$GetGGid = mysqli_query($conn,"Select * from ggenre where GGname='".$_POST[$row['col']]."'");
				$GGid=mysqli_fetch_array($GetGGid);
				if (isset($GGid)) $quer = $quer.", '".$GGid['GGid']."'";
				else
				{
					$getNewGGid=mysqli_query($conn,"Select MAX(GGid) from ggenre");
					$NewGGid=mysqli_fetch_array($getNewGGid);
					mysqli_query($conn,"INSERT INTO `ggenre`(`GGid`, `GGname`) VALUES ('".$NewGGid['MAX(GGid)']."','".$_POST[$row['col']]."')");
					$quer = $quer.", '".$NewGGid['MAX(GGid)']."'";
				}
			}
			else if ($row['col']=='Nid')
			{
				$GetNid = mysqli_query($conn,"Select * from ncc where NBmail='".$_POST[$row['col']]."'");
				$Nid=mysqli_fetch_array($GetNid);
				if (isset($Nid)) $quer = $quer.", '".$Nid['Nid']."'";
				else
				{
					$getNewNid=mysqli_query($conn,"Select MAX(Nid) from ncc");
					$NewNid=mysqli_fetch_array($getNewNid);
					mysqli_query($conn,"INSERT INTO `ncc`(`Nid`, `Nphone`, `NBmail`) VALUES ('".$NewNid['MAX(Nid)']."','','".$_POST[$row['col']]."')");
					$quer = $quer.", '".$NewNid['MAX(Nid)']."'";
				}
			}
			else
			$quer = $quer.", '".$_POST[$row['col']]."'";			
		}
		else $quer = $quer.",'$target_file'";
	}
	$quer = $quer.');';
	
	if($conn->query($quer))
	{
		if(move_uploaded_file($_FILES["gimage"]["tmp_name"],$target_file))
		echo 'yay';
		else
		echo 'boo';
		header('Location: adcpg.php?id='.$tab.'');
		echo("<meta http-equiv='refresh' content='2'>");

	}
	else { echo mysqli_error($conn); echo mysqli_errno($conn); echo'</br>'; echo $quer; echo"</br>boo"; }
	?>
</body>
</html>