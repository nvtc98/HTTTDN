<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php 
	echo '<div class="satan">';	
	$conn->query("set names utf8");
	$temp=strtolower($_GET['IDs']);
	$temp=trim($temp);
	if(isset($_GET['action']))
		$sortie = $_GET['action'];
	else $sortie = "DESC";		
	if($sortie == "ASC") $sortie="DESC";
	else $sortie="ASC";
	$quer="SELECT TABLE_NAME as tab FROM INFORMATION_SCHEMA.TABLEs where TABLE_SCHEMA = 'sshop'";
	$result=$conn->query($quer);
	while($row = mysqli_fetch_array($result))
	{
		if(strpos($temp,$row['tab']))
		{
				$_SESSION['tab']=$row['tab'];
				$tab=$row['tab'];
				break;
		}			
		else $tab=$_SESSION['tab'];	
	}
	$quer2="SELECT COLUMN_NAME as col FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tab."'";
	$result2 = $conn->query($quer2);
	$nom = getnum($temp);
	$temp = $_GET['IDs'];
	echo '<table class="wrath"> <tr>';
	while($row2= mysqli_fetch_array($result2))
	{	
		echo '<td><a href=adcpg.php?IDs='.$temp.'&action='.$sortie.'&col='.$row2['col'].'>'.$row2['col'].'</a></td>';	
	}
	echo '</tr>';
	$result2 = $conn->query($quer2);
	$row2= mysqli_fetch_array($result2);
	$quer = "select * from $tab where ".$row2['col']."=".$nom;
	$result2 = $conn->query($quer2);
	$result = $conn->query($quer);
	while($row = mysqli_fetch_array($result))
	{ 
		echo '<tr>';
		while ($row2 = mysqli_fetch_array($result2))	
		{		
			$tem=$row2['col'];
			echo '<td>'.$row[$tem].'</td>';
		}
		echo '</tr>';
	}
	echo '</table></div>';
	function getnum($temp)
	{
		$temp = explode(' ',$temp);
		for($i = 0; $i < count($temp); $i++)
		{
			for($num = 0; $num < 10; $num++)
			if($temp[$i][0] == $num)
			{
				return $temp[$i];
			}
		}
		return 0;
	}
?>
<body>
</body>
</html>