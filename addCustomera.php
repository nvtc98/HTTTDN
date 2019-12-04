<?php
	//$conn = mysqli_connect("localhost","root","","sshop");
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($conn, 'UTF8');
	$Cid=""; $Cmail=""; $Cpasswd=""; $Balance=""; $Cname=""; $Cphone=""; $Cbirthdate="";
	$Cgender=""; $UserTypeid=""; $TCharged=""; $banned=""; $footnote="";
	if (isset($_POST['Cid'])) $Cid=$_POST['Cid'];
	if (isset($_POST['Cmail'])) $Cmail=$_POST['Cmail'];
	if (isset($_POST['Cpasswd'])) $Cpasswd=$_POST['Cpasswd'];
	if (isset($_POST['Balance'])) $Balance=$_POST['Balance'];
	if (isset($_POST['Cname'])) $Cname=$_POST['Cname'];
	if (isset($_POST['Cphone'])) $Cphone=$_POST['Cphone'];
	if (isset($_POST['Cbirthdate'])) $Cbirthdate=$_POST['Cbirthdate'];
	if (isset($_POST['Cgender'])) $Cgender=$_POST['Cgender'];
	if (isset($_POST['UserTypeid'])) $UserTypeid=$_POST['UserTypeid'];
	if (isset($_POST['TCharged'])) $TCharged=$_POST['TCharged'];
	if (isset($_POST['banned'])) $banned=$_POST['banned'];
	if (isset($_POST['footnote'])) $footnote=$_POST['footnote'];
	
	if (isset($_POST['Option']))
	{
		$Option=$_POST['Option'];
		if ($Option=="1") //Check mail
		{
			$resultCmail = mysqli_query($conn,"Select * from customera where Cmail='$Cmail'");
			$queryCmail=mysqli_fetch_array($resultCmail);
			if (isset($queryCmail)) echo 0; //Cmail existed
			else echo 1; //Pass
		}
		if ($Option==2) //Check phone
		{
			$resultCphone = mysqli_query($conn,"Select * from customera where Cphone='$Cphone'");
			$queryCphone=mysqli_fetch_array($resultCphone);
			if (isset($queryCphone)) echo 0; //Cphone existed
			else echo 1; //Pass
		}
	}
	else
	{
		$getIDuserType=mysqli_query($conn,"Select * from usertype where UserTypename='$UserTypeid'");
		$USTypeID=mysqli_fetch_array($getIDuserType);
		$sql="INSERT INTO `customera`(`Cid`, `Cmail`, `Cpasswd`, `Balance`, `Cname`, `Cphone`, `Cbirthdate`, `Cgender`, `UserTypeid`, `TCharged`, `banned`, `footnote`) VALUES ('$Cid','$Cmail','$Cpasswd','$Balance','$Cname','$Cphone','$Cbirthdate','$Cgender','".$USTypeID['UserTypeid']."','$TCharged','$banned','$footnote')";
		$query=mysqli_query($conn,$sql);
		echo "success";
	}
	header('Location: adcpg.php?id=Customera');
		echo("<meta http-equiv='refresh' content='2'>");
?>