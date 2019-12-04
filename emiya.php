<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Documenaaat</title>
</head>

<body>
	<?php 		
	$servername = "localhost";
	$username = "root";
	$password = "";			
	$dbname = "sshop";	
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn->query("set names utf8");
	$_SESSION['tab']="odetail"; //debug and shorten typing time (")>
	$IDs=strval($_GET['dore']);
	$quer = "select * from odetail, orders where orders.Oid = odetail.Oid and orders.Oid = $IDs";
	$result = $conn->query($quer);
	$row=mysqli_fetch_array($result);
		echo '<center>';
		echo '<div style="font-size:16px; font-weight: bold; font-family: Arial; text-align: left; margin-left: 35%; margin-right: 35%; margin-top: -120px;border: dash; padding: 20px; background-color: white; color: black"> Order ID: <div style="font-weight: normal">'.$row['Oid'].'</div><br>';
		$quer2="select * from customera where Cid='".$row['Cid']."'";	
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2)  				
				echo 'Account Email: <div style="font-weight: normal">'.$meh['Cmail']."</div><br>";
					else { echo mysqli_error($conn); echo "nothing";}
		echo 'Ordered Day: <div style="font-weight: normal">'.$row['Odate']."</div><br>";
		echo 'Delivered Day: <div style="font-weight: normal">'.$row['DDate']."</div><br>";
		echo 'Orders Status: <div style="font-weight: normal">'.$row['Ostatus']."</div><br>";
		/*$quer3="select * from games where Gid='".$row['Gid']."'";	
			$result3=$conn->query($quer3);
			$meh=mysqli_fetch_array($result3);
			if($result3)  				
				echo 'Games: <div style="font-weight: normal">'.$meh['Gname']."</div><br>";;*/
		//xuất nhiều tên game lấy từ odetail
		$quer4="select * from orders,odetail where orders.Oid=odetail.Oid and orders.Oid = '".$row['Oid']."'";
			$result4 = $conn->query($quer4);
			echo 'Games: ';
			while($row = mysqli_fetch_array($result4))
			{
				$quer3="select * from games where Gid='".$row['Gid']."'";	
				$result3=$conn->query($quer3);
				$meh=mysqli_fetch_array($result3);
				if($result3)  				
				echo '<div style="font-weight: normal">'.$meh['Gname'].'('.$row['Amount'].')</div>';	
			}
		//echo 'Amount: <div style="font-weight: normal">'.$row['Amount']."</div><br>";
		echo 'Price: <div style="font-weight: normal">'.$row['Price']."</div><br>";
		echo "<hr width='100%'>";
		echo 'Total: <div style="font-weight: normal">'.$row['Total']." </div></div></center>";
	
	?>

</body>
</html>