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
	$quer;
	if($tab=="games")
	{
		$quer ='update '.$tab.' set Gid="'.$_POST['Gid'].'", 
		Gname="'.$_POST['Gname'].'", ';
		$quer2='select GGid from ggenre where GGname="'.$_POST['GGid'].'"';
		$result2=$conn->query($quer2);
		$row2=mysqli_fetch_array($result2);
		$quer = $quer.'GGid="'.$row2['GGid'].'", ';
		$quer2='select Nid from ncc where NBmail="'.$_POST['Nid'].'"';
		$result2=$conn->query($quer2);
		$row2=mysqli_fetch_array($result2);
		$quer = $quer.'Nid="'.$row2['Nid'].'", ';
		$quer = $quer.'ESRB="'.$_POST['ESRB'].'", description="'.$_POST['description'].'", Price="'.$_POST['Price'].'", Rating="'.$_POST['Rating'].'", gimage="'.$_POST['gimage'].'" where Gid = '.$_POST['Gid'];
	}
	if($tab=="Customera")
	{
		$quer ='update '.$tab.' set Cid="'.$_POST['Cid'].'", 
		Cname="'.$_POST['Cname'].'", ';
		$quer2='select UserTypeid from UserType where UserTypename="'.$_POST['UserTypeid'].'"';
		$result2=$conn->query($quer2);
		$row2=mysqli_fetch_array($result2);
		$quer = $quer.'UserTypeid="'.$row2['UserTypeid'].'", ';		
		$quer = $quer.'Cmail="'.$_POST['Cmail'].'", Cpasswd="'.$_POST['Cpasswd'].'", Balance="'.$_POST['Balance'].'", Cphone="'.$_POST['Cphone'].'", Cbirthdate="'.$_POST['Cbirthdate'].'", Cgender="'.$_POST['Cgender'].'", TCharged="'.$_POST['TCharged'].'", banned="'.$_POST['banned'].'", footnote="'.$_POST['footnote'].'" where Cid = '.$_POST['Cid'];
	}
	if($tab=="orders")
	{
		if(isset($_POST["soluong"]))
		{
			echo "co so luong";
			$count=intval($_POST["soluong"]);
			$qOdetail="delete from Odetail where Oid = '".$_POST['Oid']."'";
			$rOdetail = mysqli_query($conn, $qOdetail);
			$totalPrice=0;
			for($i=1;$i<=$count;$i++)
			{
				if(isset($_POST["g".$i]))
				{
					$rOdetail3 = mysqli_query($conn, "select usertype.TypeDiscount from customera, usertype where customera.Cid = '".$_POST['Cid']."' and customera.UserTypeid = usertype.UserTypeid");
					$row3=mysqli_fetch_array($rOdetail3);
					echo $row3;
					$row3=intval($row3[0]);
					echo $row3;
					$price=(intval($_POST['g'.$i])*intval($_POST['sl'.$i])*$row3/100);
					$qOdetail2='insert into Odetail (Oid, Gid, Amount, Price) values ("'.$_POST['Oid'].'", "'.$_POST['g'.$i].'" , '.$_POST['sl'.$i].', $price)';
					$rOdetail2 = mysqli_query($conn, $qOdetail2);
					$totalPrice+=$price;
				}
			}
		}
		
		$quer ='update '.$tab.' set Oid="'.$_POST['Oid'].'", 
		Odate="'.$_POST['Odate'].'", ';
		$quer2='select Cid from Customera where Cmail="'.$_POST['Cid'].'"';
		$result2=$conn->query($quer2);
		$row2=mysqli_fetch_array($result2);
		$quer = $quer.'Cid="'.$row2['Cid'].'", ';
		if(isset($_POST["soluong"]))
			$quer = $quer.'Odate="'.$_POST['Odate'].'", DDate="'.$_POST['DDate'].'", Total="'.$totalPrice.'", Ostatus="'.$_POST['Ostatus'].'" where Oid = "'.$_POST['Oid'].'"';
		else
			$quer = $quer.'Odate="'.$_POST['Odate'].'", DDate="'.$_POST['DDate'].'", Ostatus="'.$_POST['Ostatus'].'" where Oid = "'.$_POST['Oid'].'"';
	}
	if(!$conn->query($quer))
	{
	
	echo mysqli_error($conn);
		echo"<br>";
	echo $quer;
		}

	header('Location: adcpg.php?id='.$tab.'');
		echo("<meta http-equiv='refresh' content='2'>"); 
	?>
</body>
</html>