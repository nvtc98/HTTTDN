<?php
	session_start();
	$conn=mysqli_connect("localhost", "root", "", "sshop") or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$email=$_POST['email'];
	$password=$_POST['password'];
	$query = mysqli_query($conn, "select * from customera where Cmail = '$email'");
	$result = mysqli_fetch_array($query);
	if(isset($_POST['mode']))
	{
		if($result['banned']==0)
		{
			$_SESSION['user']=$result['Cname'];
			$_SESSION['userId']=$result['Cid'];
			echo $result["Cname"];
		}
		else echo -2; //banned
	}
	else if(!isset($result)) echo -1; //account does not exist;
	else echo $result['Cpasswd'];
	mysqli_close($conn);
?>
