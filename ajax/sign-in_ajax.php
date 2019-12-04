<?php
	session_start();
	// $conn=mysqli_connect("localhost", "root", "", "sshop") 
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
	or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$email=$_POST['email'];
	$password=$_POST['password'];
	$query = mysqli_query($conn, "select * from customera where Cmail = '$email'");
	$result = mysqli_fetch_array($query);
	if(isset($_POST['mode']))
	{
		$_SESSION['user']=$result['Cname'];
		$_SESSION['userId']=$result['Cid'];
		echo $result["Cname"];
	}
	else if(!isset($result)) echo -1; //account does not exist;
	else echo $result['Cpasswd'];
	mysqli_close($conn);
?>