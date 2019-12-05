<style>
	.signInDialog
	{
		display: none;
		position: fixed;
		z-index: 20;
		left: 0;
		top: 0;
		width: 100vw;
		height: 100vh;
		overflow: auto;
		background-color: rgb(0,0,0);
		background-color: rgba(0,0,0,0.4);
	}
	
	.signInDialogContent
	{
		background-color: white;
		margin: 15% auto;
		padding: 0 0 20px 20px;
		width: 300px;
		height: 175px;
		border-radius:5px;
		-webkit-box-shadow:0 4px 10px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1);
		-moz-box-shadow:0 4px 10px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1);
		box-shadow:0 4px 10px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1);
	}
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
</style>

<div class="signInDialog" onclick="checkCloseSignIn(this, event)">
	<div class="signInDialogContent" align="left">
    	<span class="close" onclick="closeSignIn()">&times;</span>
    	<div style="height:55px; padding-top:20px;">
            <div style="font-family:Tahoma, Geneva, sans-serif; font-size:20px;">ĐĂNG NHẬP</div>
            <hr color="fd9a00" size="3" width="30" style="left:0px; margin-left:0" />
		</div>
		<form method="post" name="signInForm" style="padding-right:20px; height:auto" onsubmit="signInCheck(); return false;">
    		<input type="text" size="30" name="email" placeholder="Email" style="width:90%; font-size:18px; border: 2px solid #fd9a00;" />
            <br>
            <input type="password" name="password" placeholder="Mật khẩu" style="width:90%; font-size:18px; border: 2px solid #fd9a00; margin-top:10px;" />
            <input type="submit" value="&#10004;" class="submitBttn" />
            <div id="showError"></div>
		</form>
  </div>
</div>

<script type="text/javascript">
	function signInCheck()
	{
		var email=document.signInForm.email;
		$email=email.value;
		$password=document.signInForm.password.value;
		$.ajax({url:"ajax/sign-in_ajax.php", type:"POST", dataType:"text", data:{ email: $email, password: $password }, 
		success: function(status) 
			{
				if(status==-1)
				{
					document.getElementById("showError").innerHTML="Tài khoản không tồn tại.";
					return false;
				}
				else if(decode(status)!=$password)
					{
						document.getElementById("showError").innerHTML="Mật khẩu không chính xác.";
						return false;
					}
				$.ajax({url:"ajax/sign-in_ajax.php", type:"POST", data:{ email: $email, password: $password, mode: true }, success: function(name)
				{
					if(name==-2)
						{
							document.getElementById("showError").innerHTML="VAC Banned";
							return false;
						}
				document.signInForm.reset();
				$('.signInDialog').css("display","none");
				if($('#customerZone').length)
					showLogOut(name);
				else
					window.location="index.php";
				}});
			}
    	});
	}
	
	function closeSignIn()
	{
		$('.signInDialog').fadeOut();
	}
	
	function checkCloseSignIn(ths, e)
	{
		if(e.target==ths) closeSignIn();
	}
</script>