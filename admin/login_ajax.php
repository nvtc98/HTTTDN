<?php
	session_start();
	$conn=mysqli_connect("localhost", "root", "", "sshop")
	// $conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
	or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query = mysqli_query($conn, "select * from admini where name = '$username' and passwd = '$password'");
	//alert($query);
	$count = mysqli_num_rows($query);
	if($count==1)
	{
        $result = mysqli_fetch_array($query);
		$_SESSION['user']=$result['name'];
        echo 1;
	}
	else echo $query;
	mysqli_close($conn);
?>