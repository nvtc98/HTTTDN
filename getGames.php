<?php
	$conn = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($conn, 'UTF8');
	$Key="";
	if (isset($_POST['Key'])) $Key=$_POST['Key'];
	$sql= "Select * from games where Gname LIKE '%$Key%'";
	$result=mysqli_query($conn,$sql);
	$s="";
	while ($row=mysqli_fetch_array($result))
	{
		$s=$s.'<option value="'.$row['Gname'].'"></option>';
	}
	echo $s;
	mysqli_close($conn);
?>