<?php
	session_start();
	unset( $_SESSION['user'] );
	foreach ($_COOKIE as $key=>$val) if (preg_match("/id/",$key)) setcookie($key, "false", time() - (86400 * 30), "/");
	//header ( 'Location: home.php ' );
?>