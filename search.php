<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link href="CSS/product.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sang Shop</title>
				
</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script language="javascript" src="JS/jquery.cookie.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>

<body style="width: 100%" bgcolor="#EEE">
	<?php include("leftmenu.php") ?>
    <div class="push-wrap">
		<?php
            include("header.php");
            include("search-filter.php");
            include("content.php");
            include("back-to-top.php");
            include("footer.php");
        ?>
	</div>
</body>
</html>