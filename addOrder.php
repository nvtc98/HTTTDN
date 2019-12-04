<?php
	//$conn = mysqli_connect("localhost","root","","sshop");
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($conn, 'UTF8');
	$Oid=""; $Cid=""; $Odate=""; $s="";
	$DDate=""; $Total=""; $Ostatus="";
	if (isset($_POST['Oid'])) $Oid=$_POST['Oid'];
	if (isset($_POST['Cid'])) $Cid=$_POST['Cid'];
	if (isset($_POST['Odate'])) $Odate=$_POST['Odate'];
	if (isset($_POST['DDate'])) $DDate=$_POST['DDate'];
	if (isset($_POST['Total'])) $Total=$_POST['Total'];
	if (isset($_POST['Ostatus'])) $Ostatus=$_POST['Ostatus'];
	if (isset($_POST['s'])) $s=$_POST['s'];
	//Oders
	$sql="INSERT INTO `orders`(`Oid`, `Cid`, `Odate`, `DDate`, `Total`, `Ostatus`) VALUES ('$Oid','$Cid','$Odate','$DDate','$Total','$Ostatus')";
	mysqli_query($conn,$sql);
	//Odetail
	$str=explode("?&?",$s);
	for ($i=0;$i<count($str);$i++)
	{
		$element=explode("??",$str[$i]);
		$getGid=mysqli_query($conn,"Select * from games where Gname='$element[1]'");
		$rowG=mysqli_fetch_array($getGid);
		$reGid=$rowG['Gid'];
		mysqli_query($conn,"INSERT INTO `odetail`(`Oid`, `Gid`, `Amount`, `Price`) VALUES ('$Oid','$reGid','$element[2]','$element[3]')");
	}
	echo "success";
	mysqli_close($conn);
?>