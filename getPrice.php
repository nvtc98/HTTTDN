<?php
	$conn = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($conn, 'UTF8');
	$Key="";
	if (isset($_POST['Key'])) $Key=$_POST['Key'];
	$sql= "Select * from games where Gname='$Key'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo $row['Price'];
	mysqli_close($conn);
?>