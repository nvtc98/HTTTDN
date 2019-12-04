<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Control Page</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="adjs.js"></script>
<script src="jalter.js"></script>
<link rel='stylesheet' type='text/css' href="adcss.css" ></link>

</head>

<body>		
	<?php 			
	// $servername = "localhost";
	// $username = "root";
	// $password = "";			
	// $dbname = "sshop";	
	// $conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	$namae="";
	if(isset($_SESSION['IDk']))
	$namae=$_SESSION['IDk'];
	if(isset($_SESSION['permit']))
	$permit=$_SESSION['permit'];
	if($namae!="")
	{
		echo '<div class="butts"> 
		<a href="adcpg.php?id=games"> Games </a>                
        <a href="adcpg.php?id=Customera"> Customer Account </a>
        <a href="adcpg.php?id=orders"> Orders </a>		
		';
	
	include("searchbox.php");
	echo'<div class="lout">';
	echo '<form action="logout.php" method="post">';
		echo'<input type="submit" onclick="" value="logout"/>';
	echo'</form>'; echo'</div>';
	echo '</div></br>';	
	
		include("nonsearch.php");		
	}
	else
	{	
		include("login.php");
	}
	?>
</body>
</html>