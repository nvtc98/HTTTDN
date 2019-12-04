
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	
	echo '<form action="process.php" method="post">';
	echo 'Login name:    <input type="text" id="usname" name="usname"/></br>
		  Login password: <input type="password" id="passwd" name="passwde"/></br>
		  <input type="submit" value="Login"/> <input type="button" value="Register" onclick="boo()"/>
	';
	echo'</form>'		
	?>
	<script>
	function boo()
		{
			alert("tin người vkl");
		}
	</script>
</body>
</html>