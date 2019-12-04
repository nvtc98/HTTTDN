<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="CSS/signup.css">
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sang Shop</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script language="javascript" src="JS/showing-paging.js"></script>

<style>
	.tr {display: table-row}
	.td {display: table-cell}
	.main-form
	{
		background-color: rgba(1,1,1,0.5);
		color: white;
		font-family: 'Roboto-Light';
		font-size:18px;
		width: 400px;
		height: 500px;
		padding-top:50px;
	}
	#Password
	{
		width: 83%;
		text-align: left;
	}
	#Password:hover
	{
		box-shadow: 0px 0px 6px rgba(0, 0, 0, 10);
		background-color: #222;
		color: #fd9a00;
		font-weight: bold;
		cursor: pointer;
	}
</style>

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background:url(IMG/signupBG.jpg); background-size: cover; -webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover; background-attachment: fixed;" align="center">
		<?php 
			include("header.php");
			
			$id=$_SESSION['userId'];
			$conn=mysqli_connect("localhost", "root", "", "sshop");
			mysqli_set_charset($conn, 'UTF8');
			$query=mysqli_query($conn, "select * from customera where Cid='$id'");
			$row=mysqli_fetch_array($query);
			$gender=($row['Cgender']=="Nam")?true:false; 
			$query=mysqli_query($conn, "select UserTypeName from usertype where UserTypeid='".$row['UserTypeid']."'");
			$rank=mysqli_fetch_array($query);
			mysqli_close($conn);
        	
			echo
        	'<div class="main-form" style="min-height: 550px;" >
        	<div style="background-color: black; color: white; font-family: '."'Roboto-Medium'".'; font-size: 24px; text-transform:uppercase; width: 100%; padding-top: 15px; padding-bottom: 15px">Thông tin khách hàng</div>
        <form name="userInfo" method="post" style="padding-left: 50px; padding-top: 30px;text-align:left; float: left" onSubmit="return changeInfo()" >
                <div class="nameIcon"> </div> 
                <input type="text" class="ipType" style="width: 65%" placeholder="Họ và Tên" value="'.$row['Cname'].'" id="Name" name="Name" pattern="[^0-9]+" title="Họ tên chỉ bao gồm các ký tự chữ cái!" required/> <br>
                <div class="mailIcon"> </div>
                <input type="email" class="ipType" style="width: 65%" placeholder="Email" id="Email" name="Email" value="'.$row['Cmail'].'" pattern="[a-z.0-9_-]+@[a-z]+.[a-z]{3,4}.*" title="Email phải chứa đầy đủ username và domain và không chứa ký tự đặc biệt." required /> <br>
                <div class="pswdIcon"> </div>
                <input type="button" class="ipType" style="width: 70.6%" value="Thay đổi mật khẩu" id="Password" onClick="changePassword()" /> <br>
                <div class="bdIcon"> </div>
                <input type="date" class="ipType" style="height: 21; width: 65%" placeholder="Ngày sinh" id="BDay" name="BDay" value="'.date('Y-m-d', strtotime($row['Cbirthdate'])).'" pattern="^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/((19[0-9]{2})|(20[0-1]{1}[0-4]{1}))$" title="Vui lòng nhập ngày sinh theo đúng định dạng DD/MM/YYYY!" required /> <br>
                <div class="phoneIcon"> </div>
                <input type="text" class="ipType" placeholder="Số điện thoại" style="width: 65%" id="Phone" name="Phone" maxlength="12" value="'.$row['Cphone'].'" pattern="[0-9]+" title="Số điện thoại chỉ bao gồm các ký tự số!" required /> <br>
                <div class="genderIcon"> </div><div style="margin: 3px; float:left; margin-left: 5px; border-width: 1px; padding: 7px; width: 65%; border:solid;"> Giới tính: <input type="radio" name="Gender" value="Nam" '.($gender?"checked":"").' /> Nam <input type="radio" name="Gender" value="Nữ" '.($gender?"":"checked").' /> Nữ </div>
				<p class="ipType" style="width: 78%; margin-left: 0; color: black; font-weight: bold; float: left">Số tiền trong tài khoản: '.$row['Balance'].'đ</p><p class="ipType" style="width: 78%; margin-left: 0; color: black; font-weight: bold; float: left">Rank: '.$rank[0].'</p>
                <input type="submit" value="Thay đổi" class="signUpBttn" style="margin-left: 40px; margin-top: 160px;" />
				
            </form>
        </div>';
        
        

            include("back-to-top.php");
            include("footer.php");
        ?>
    </div>
</body>

<script>
	function changePassword()
	{
		var old=prompt("Nhập mật khẩu hiện tại");
		if(!old) return;
		$.ajax({url:"ajax/user-info_ajax.php", type:"POST", dataType:"text", data:{mode:1, old:old}, success: function(status)
		{
			if(decode(status)==old)
			{
				$new=prompt("Nhập mật khẩu mới");
				if(!$new) return;
				if($new.length<6)
				{
					alert("Mật khẩu tối thiểu 6 ký tự");
					return;
				}
				$new2=prompt("Xác nhận mật khẩu mới");
				if(!$new2) return;
				if($new == $new2)
					$.ajax({url:"ajax/user-info_ajax.php", type:"POST", data:{mode:2, newp:encode($new)}, success: function()
					{
						alert("Cập nhật mật khẩu thành công!");
					}});
				else alert("Mật khẩu không khớp!");
			}
			else alert("Mật khẩu không chính xác!");
		}});
	}
	
	function changeInfo()
	{
		var Email = document.getElementById("Email");
		var patMail = /[^a-zA-Z0-9_.-]/;
		var M = Email.value.split('@');
		var user = M[0];
		var domain = M[1];
		var dmname = domain.split('.');
		if (patMail.test(user)) {alert("Email không hợp lệ!"); Email.focus(); return false;}
		for (i=0;i<dmname.length;i++)
		if (dmname[i]=="" || patMail.test(dmname[i])) {alert("Email không hợp lệ!"); Email.focus(); return false;}
		$Email=document.getElementById("Email").value;
		$Name=document.getElementById("Name").value;
		$BDay=document.getElementById("BDay").value;
		$Phone=document.getElementById("Phone").value;
		$G=document.getElementsByName("Gender");
		if ($G[0].checked) $Gender=$G[0].value;
		else $Gender=$G[1].value;
		$.ajax({url:"ajax/user-info_ajax.php", type:"POST", data:{ mode:0, Email: $Email, Name: $Name, BDay: $BDay, Phone: $Phone, Gender: $Gender }, success: function(a) {alert("Cập nhật thành công!");}});
		return false;
	}
</script>
</html>