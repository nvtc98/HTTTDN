<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link href="CSS/product.css" rel="stylesheet" type="text/css" />
<link href="CSS/basket.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Giỏ hàng</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script language="javascript" src="JS/jquery.cookie.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/sang-basket.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#EEE; overflow: auto" align="center">
	<?php include("header.php"); ?>
    
<?php
	$con = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($con, 'UTF8');
	if (isset($_SESSION['user']))
	echo '<div class="Charge" style="min-height:80vh">
    <center><div class="Charge-area">
    <div style=" float: left;">
		<div>Quý khách vui lòng chuyển khoản theo yêu cầu để nạp tiền vào tài khoản</div><br />
		<div>Ngân hàng nhận: NHNN&PTNT An Phú HCM - PGD Nguyễn Văn Cừ</div><br />
		<div>Tên người nhận: SANGSHOP</div><br />
		<div>Số tài khoản: <strong>1606201036100</strong></div><br />
		<div>Số tiền muốn nạp</div><br />
		<div>Nội dung: NAPTIEN-SANGSHOP-<số tiền muốn nạp>-<email></div><br />
		<div>*LƯU Ý: Vui lòng nhập đúng địa chỉ email để chúng tôi có thể chuyển tiền đúng tài khoản</div><br />
		<div>Chúng tôi sẽ không giải quyết bất cứ trường hợp nào chuyển tiền sai hoặc email trong nội dung chuyển tiền bị sai </div><br />
		</div></div></center></div>';
	else echo '<script>alert("Vui lòng đăng nhập để thực chức năng này!"); window.location="index.php";</script>';
	mysqli_close($con);
?>
    
	<?php
		include("back-to-top.php");
		include("footer.php");
    ?>
    </div>
</body>
</html>