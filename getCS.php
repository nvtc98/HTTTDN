<?php
	// $conn = mysqli_connect("localhost","root","","sshop");
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($conn, 'UTF8');
	$Key="";
	if (isset($_POST['Key'])) $Key=$_POST['Key'];
	$sql= "Select * from customera where Cname LIKE '%$Key%'";
	$result=mysqli_query($conn,$sql);
	$s="";
	while ($row=mysqli_fetch_array($result))
	{
		$s=$s.'<option value="'.$row['Cname'].'">'.$row['Cbirthdate'].'</option>';
	}
	echo $s;
	mysqli_close($conn);
?>