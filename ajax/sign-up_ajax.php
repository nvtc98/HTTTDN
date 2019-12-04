<?php
	session_start();
	// $conn=mysqli_connect("localhost", "root", "", "sshop") 
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
	or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$Name=$_POST['Name'];
	$Email=$_POST['Email'];
	$Password=$_POST['Password'];
	$BDay=$_POST['BDay'];
	$Phone=$_POST['Phone'];
	$Gender=$_POST['Gender'];
	$query = mysqli_query($conn, "select * from customera where Cmail = '$Email'");
	$result = mysqli_fetch_array($query);
	if(!isset($result))
	{
		$sql = "INSERT INTO customera (Cmail, Cpasswd, Cname, Cphone, Cbirthdate, Cgender)
		VALUES ('$Email','$Password','$Name','$Phone','$BDay','$Gender')";
		mysqli_query($conn,$sql);
		$_SESSION['user']=$Name;
		echo 1;
	}
	else
	{
		echo 0;
	}
	mysqli_close($conn);
?>