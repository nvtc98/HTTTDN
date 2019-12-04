<style>
	#showError
	{
		color:#F00;
		padding-top:15px;
	}
	.submitBttn
	{
		background:#fd9a00; 
		border:none; 
		width:30px; 
		height:27px; 
		margin-left:8px; 
		cursor: pointer;
		float: right;
		margin: 10px 25px;
		display:block;
		padding: 5px;
		transition: 0.6s ease;
	}
	.submitBttn:hover
	{
		transition: 0.6s ease;
		box-shadow: 3px 3px 3px 2px grey;
	}
	
	.welcome
	{
		float: left;
		width: auto;
		height: auto;
		color: white; 
		font-family:Arial; 
		font-size: 16px;
		transition: 0.6s ease;
		background-color: black;
		border: none;
		cursor: pointer;
		line-height: 50px;
		width:100px;
	}
	.welcome:hover
	{
		color: #fd9a00;
		transition: 0.6s ease;
	}
	
	.welcome:hover .dropdown-wrapper
	{
		display: block;
	}
	
	.dropdown-wrapper
	{
		display: none;
		position: absolute;
		right: 0;
	}
	.user-dropdown
	{
		color: black;
		font-family: Arial;
		font-size: 16px;
		background-color: #fd9a00;
		border: none;
		cursor: pointer;
		font-weight: bold;
		padding: 0 10px 0 10px;
		transition: 0.6s ease;
	}
	
	.user-dropdown:hover
	{
		background-color: black;
		color: #fd9a00;
		transition: 0.6s ease;
	}
</style>
<link href="CSS/basket.css" rel="stylesheet" type="text/css" />
<div id="customerZone"></div>

<?php include("sign-in.php") ?>

<script type="text/javascript">
	function signIn()
	{
		$('.signInDialog').fadeIn("slow");
		document.signInForm.email.focus();
	}
	
	function shortenName(str)
	{
		str=str.split(' ');
		return str[str.length-1];
	}
	
	function showLogOut(name)
	{
		var s='<div style="margin-left: 85%; width: 200px; position: absolute;"><div style="color:white;font-family:Arial;font-size:16px;float:left;line-height: 50px; padding-right: 10px">Xin chào,</div><div class="welcome">' + shortenName(name) + '<div class="dropdown-wrapper"><div class="user-dropdown" onclick="window.location='+"'user-info.php'"+'">Thông tin khách hàng</div><div class="user-dropdown" onclick="Basket();" id="GioHang" >Giỏ hàng</div><div class="user-dropdown" onclick="window.location='+"'naptien.php'"+'" id="NapTien" >Nạp tiền</div><div class="user-dropdown" onclick="window.location='+"'lichsu.php'"+'" id="LSMH" >Lịch sử mua hàng</div><div class="user-dropdown" onclick="logOut()">Đăng xuất</div></div></div></div></div>';
		document.getElementById("customerZone").innerHTML=s;
	}
	function getCookie(cname)
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
	function showCustomerZone()
	{
		document.getElementById("customerZone").innerHTML='<input type="button" id="signInBtn" value="Đăng nhập" class="signInUpBttn" style="margin-right: 15px;" onclick="signIn()" /> <a href="sign-up.php"><input type="button" value="Đăng ký" class="signInUpBttn" /></a> <input type="button" value="Giỏ hàng" class="signInUpBttn" style="margin-right: 10px" onclick="Basket();" /> ';
	}
	function logOut()
	{
		$.ajax({url:"ajax/log-out_ajax.php", success: function()
		{
			showCustomerZone(); 
			if(window.location.href.indexOf("index.php")<0 && window.location.href.indexOf("search.php")<0 && window.location.href.indexOf("genre.php")<0 && window.location.href.indexOf("contact.php")<0 && window.location.href.indexOf("information.php")<0)
				window.location="index.php"; 
		}});
	}
</script>

<?php
	if (isset($_SESSION['user']))
		echo '<script>showLogOut("' . $_SESSION['user'] . '")</script>';
	else echo '<script>showCustomerZone();</script>';
?>