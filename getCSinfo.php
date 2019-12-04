<?php
	$conn = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($conn, 'UTF8');
	$Key="";
	
	if (isset($_POST['Key'])) $Key=$_POST['Key'];
	
	$sql= "Select * from customera where Cid='$Key'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	echo $row['Cmail']."??".$row['Balance']."??".$row['Cname']."??".$row['Cphone']."??".$row['Cbirthdate']."??".$row['Cgender']."??".$row['UserTypeid']."??".$row['TCharged']."??".$row['footnote'];
	mysqli_close($conn);
?>