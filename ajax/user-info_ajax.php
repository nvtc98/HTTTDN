<?php
	session_start();
	include("sang-script.php");
	$conn=mysqli_connect("localhost", "root", "", "sshop") or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$id=$_SESSION['userId'];
	if($_POST['mode']==1)
	{
		$password=$_POST['old'];
		$query = "select Cpasswd from customera where Cid = '$id'";
		$query = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($query);
		echo $row[0];
	}
	else if($_POST['mode']==2)
	{
		$password=$_POST['newp'];
		$query = "UPDATE Customera SET Cpasswd = '$password' WHERE Cid = '$id'";
		mysqli_query($conn, $query);
	}
	else
	{
		$Name=$_POST['Name'];
		$Email=$_POST['Email'];
		$BDay=$_POST['BDay'];
		$Phone=$_POST['Phone'];
		$Gender=$_POST['Gender'];
		$query = "UPDATE Customera SET Cname = '$Name', Cmail = '$Email', Cbirthdate = '$BDay', Cphone = '$Phone', Cgender = '$Gender' WHERE Cid = '$id'";
		mysqli_query($conn, $query);
		echo $query;
	}
	mysqli_close($conn);
?>