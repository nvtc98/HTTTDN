<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="CSS/signup.css">
<link rel="shortcut icon" href="IMG/favicon.png" />
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<title>Đăng ký</title>
<style>
	html
	{
		background:url(IMG/signupBG.jpg);
		background-size: cover;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-attachment: fixed;
	}
</style>
</head>

<body>
<center>
	<div class="wrapDiv">
        <div class="introDiv">
            <h1 style="text-transform:uppercase"> Chào mừng đến với </h1>
            <h1 style="text-transform:uppercase; font-family:'Roboto-Light'; margin-top: -15px; font-size:50px; border-style:solid; width: 80%"> sang shop </h1>
            <p style="font-family:'Roboto-Light'"> Trang web kinh doanh game đáng tin cậy nhất Việt Nam </p>
            <p style="font-family:'Roboto-Light'; font-size:16px; margin-top: 160px"> Đã có tài khoản? </p>
            <div class="bttn" style="margin-top:-12px;" onClick="signIn()"> ĐĂNG NHẬP </div>
            <a href="index.php" style="text-decoration: none;color: black;"><p style="font-family:'Roboto-Light'; font-size:14px;  border-style:solid; width:50%; padding: 3px; cursor:pointer; font-weight:bold; border-width: 1px; margin-top: 50px "> &gt;&gt; &nbsp; Về lại TRANG CHỦ </p></a>
        </div>
        <div class="form">
        	<div style="background-color: black; color: white; font-family: 'Roboto-Medium'; font-size: 24px; text-transform:uppercase; width: 100%; padding-top: 15px; padding-bottom: 15px"> đăng ký  thành viên</div>
        <form name="signUpForm" method="post" action="index.php" style="padding-left: 50px; padding-top: 30px;text-align:left; float: left" onSubmit="return signUpCheck();" >
                <div class="nameIcon"> </div> 
                <input type="text" class="ipType" placeholder="Họ và Tên" id="Name" name="Name" pattern="[^0-9]+" title="Họ tên chỉ bao gồm các ký tự chữ cái!" required/> <br>
                <div class="mailIcon"> </div>
                <input type="email" class="ipType" placeholder="Email" id="Email" name="Email" pattern="[a-z.0-9_-]+@[a-z]+.[a-z]{3,4}.*" title="Email phải chứa đầy đủ username và domain và không chứa ký tự đặc biệt." required /> <br>
                <div class="pswdIcon"> </div>
                <input type="password" class="ipType" placeholder="Mật khẩu" id="Password" name="Password" minlength="6" required /> <br>
                <div class="pswdConIcon"> </div>
                <input type="password" class="ipType" placeholder="Xác nhận mật khẩu" id="RePassword" name="RePassword" required /> <br>
                <div class="bdIcon"> </div>
                <input type="date" class="ipType" style="height: 21px" placeholder="Ngày sinh" id="BDay" name="BDay" pattern="^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/((19[0-9]{2})|(20[0-1]{1}[0-4]{1}))$" title="Vui lòng nhập ngày sinh theo đúng định dạng DD/MM/YYYY!" required /> <br>
                <div class="phoneIcon"> </div>
                <input type="text" class="ipType" placeholder="Số điện thoại" id="Phone" name="Phone" maxlength="12" pattern="[0-9]+" title="Số điện thoại chỉ bao gồm các ký tự số!" required /> <br>
                <div class="genderIcon"> </div>
                <div style="margin: 3px; float:left; margin-left: 5px; border-width: 1px; padding: 7px; width: 76%; border:solid;"> Giới tính: <input type="radio" name="Gender" value="Nam" checked /> Nam <input type="radio" name="Gender" value="Nữ" /> Nữ </div>
                <input type="submit" value="đăng ký" class="signUpBttn" />
            </form>
        </div>
    </div>
</center>
<?php
	include('sign-in.php');
?>
</body>
</html>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script language="javascript" src="JS/showing-paging.js"></script>

<script type="text/javascript">
	function signUpCheck()
	{
	/*	var Name = document.getElementById("Name");
		var patName = /[0-9]/;
		if (patName.test(Name.value)) {alert("Họ tên không hợp lệ!"); Name.focus(); return false;}*/

		var Email = document.getElementById("Email");
		var patMail = /[^a-zA-Z0-9_.-]/;
		var M = Email.value.split('@');
		var user = M[0];
		var domain = M[1];
		var dmname = domain.split('.');
		if (patMail.test(user)) {alert("Email không hợp lệ!"); Email.focus(); return false;}
		for (i=0;i<dmname.length;i++)
		if (dmname[i]=="" || patMail.test(dmname[i])) {alert("Email không hợp lệ!"); Email.focus(); return false;}
				
		var Password = document.getElementById("Password"); //alert(Password.value);
	//	 {alert("Mật khẩu phải dài hơn 6 ký tự!"); Password.focus(); return false;}
		var RePassword = document.getElementById("RePassword"); //alert(RePassword.value);
		if (Password.value != RePassword.value) {alert("Mật khẩu không khớp!"); RePassword.focus(); return false;}
		
		$Email=document.getElementById("Email").value;
		$Password=encode(document.getElementById("Password").value);
		$Name=document.getElementById("Name").value;
		$BDay=document.getElementById("BDay").value;
		$Phone=document.getElementById("Phone").value;
		$G=document.getElementsByName("Gender");
		if ($G[0].checked) $Gender=$G[0].value;
		else $Gender=$G[1].value;
		$flag=false;
//		$Gender=document.signUpForm.Gender.value;
	//	alert($Gender);
/*		$.ajax({url:"ajax/sign-up_ajax.php", type:"POST", dataType:"text", data:{ Email: $Email, Password: $Password, Name: $Name, BDay: $BDay, Phone: $Phone }, 
		success: function(status) 
			{
			if(status=="1") {window.location="index.php"; }
			else { alert("Đăng ký thất bại!"); return false;}
			}
				});		
*/
		$.ajax({url:"ajax/sign-up_ajax.php", type:"POST", dataType:"text", data:{ Email: $Email, Password: $Password, Name: $Name, BDay: $BDay, Phone: $Phone, Gender: $Gender }, 
				success: function(status) 
					{
						if(status==1) {
							alert("Đăng ký thành công!");
							window.location="index.php";
							$flag=true;
						}
						else
						{
							alert("Địa chỉ email đã tồn tại");
							document.getElementById("Email").focus();
						}
					}
				});
	return $flag;
	}
	
	function signIn()
	{
		$('.signInDialog').fadeIn("slow");
		document.signInForm.email.focus();
	}
</script>