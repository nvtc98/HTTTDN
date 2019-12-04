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

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#EEE; overflow: auto" align="center">
	<?php include("header.php"); ?>
	<div class="Basket" style="min-height:80vh">
 
<?php
	$con = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($con, 'UTF8');
	$count=0;
	$Item = "";
	$Money=0;
	foreach ($_COOKIE as $key=>$val)
	{
		if (preg_match("/product/",$key))
			{
				$id=explode("product",$key);
				if (!preg_match("/[123]/",$val)) $val=1;
				$sql="Select * from games where Gid='$id[1]'";
				$result=mysqli_query($con,$sql);
				$row=mysqli_fetch_array($result);
				// Banner link
				$gimage=explode("??",$row['gimage']);
				$src=$gimage[0];
				// NBmail
				$SqlM="SELECT * FROM `ncc` WHERE Nid='".$row['Nid']."'";
				$M_re=mysqli_query($con,$SqlM);
				$NBmail=mysqli_fetch_array($M_re);
				// Sale
				$Sale_re=0;
				if (isset($_SESSION['user']))
				{
				$sqlSale="SELECT * FROM `customera`,`usertype` WHERE Cid='".$_SESSION['userId']."' AND customera.UserTypeId=usertype.UserTypeId";
				$S_re=mysqli_query($con,$sqlSale);
				$Sale=mysqli_fetch_array($S_re);
				$Sale_re=floatval($Sale['TypeDiscount']);
				}
				// Price
				$Price1=floatval($row['Price']);
				$Price2=$Price1-($Price1*$Sale_re/100);
				
				$Item = $Item.'<div class="B_Product_item">
	<div class="img_thumnail"><img class="img-responsive" src="'.$src.'"></div>
	<div class="col-right">
		<div class="box-info-product">
			<p class="name"><a href="#" >'.$row['Gname'].'</a></p>
			<p class="seller-by">Cung cấp bởi <span class="firm"><a href="#">'.$NBmail['NBmail'].'</a></span></p>
			<p class="action"><input type="button" class="btn-item-delete" value="Xóa" onclick="Xoa('.$id[1].', '.$count.');" /></p>
		</div>
		<div class="box-price">
			<p class="price">'.$Price2*$val.'&nbsp;₫</p>
			<p class="price2">'.$Price1*$val.'&nbsp;₫</p>
			<p class="sale">-'.$Sale_re.'%</p>
		</div>
		<div class="quantity-block">
			<div><input type="button" class="btn bootstrap-touchspin-down" value="-" onclick="quantity('.$count.',0,'.$Price1.','.$Sale_re.','.$id[1].');" /></div>
			<div><input type="tel" class="form-control" min="0" value="'.$val.'" /></div>
			<div><input type="button" class="btn bootstrap-touchspin-up" value="+" onclick="quantity('.$count.',1,'.$Price1.','.$Sale_re.','.$id[1].');" /></div>
		</div>
	</div></div>';
				$count++;
				$Money+=$Price2;
			}
	}
	$Item=$Item."</div>";
	$Banner = '<div class="Basket_header"><h5>Giỏ hàng <span>('.$count.' sản phẩm)</span></h5></div>';
	$Product = '<div class="B_Product_area">';
	$Name_Ip='<input type="text" id="GetName" size="30" name="Name" placeholder="Họ tên" style="width:70%; font-size:18px; border: 2px solid #fd9a00;" />';
	$Email_Ip='<input type="text" id="GetMail" name="Email" placeholder="Email" style="width:70%; font-size:18px; border: 2px solid #fd9a00; margin-top:10px;" />';
	if (isset($_SESSION['user']))
	{
		$Get_Info=mysqli_query($con,"Select * from customera where Cid='".$_SESSION['userId']."'");
		$Info=mysqli_fetch_array($Get_Info);
		$Name_Ip='<input type="text" id="GetName" size="30" name="Name" placeholder="Họ tên" value="'.$Info['Cname'].'" style="width:70%; font-size:18px; border: 2px solid #fd9a00;" disabled />';
		$Email_Ip='<input type="text" id="GetMail" name="Email" placeholder="Email" value="'.$Info['Cmail'].'" style="width:70%; font-size:18px; border: 2px solid #fd9a00; margin-top:10px;" disabled />';
	}
	echo '<div class="Info-giaohang" onClick="closeForm(this, event);"><form method="post" name="Info" style="background: #fff;padding-right:20px;height:auto;width: 350px;">
	<span id="Header_info">Thông tin khách hàng</span><br/>
	<span id="name_info">Họ&nbsp;tên&nbsp;</span>'.$Name_Ip.'<br/>
    <span id="mail_info">Email</span>'.$Email_Ip.'<br/>
	<span id="addr_info">Địa&nbsp;chỉ&nbsp;</span><input type="text" id="GetAddress" size="30" name="Address" placeholder="Địa chỉ" style="width:70%; font-size:18px; border: 2px solid #fd9a00; margin-top:10px;" /><br/>
            <center><input type="button" name="Submit" value="Đặt hàng" id="DH"  onclick="return CheckInfo();"/></center>
            <div id="Error"></div>
		</form></div>';

	echo $Banner.$Product.$Item;
	echo '<div class="sum-box">
	<div class="box-style fee">
            <p class="list-info-price">
                <span>Tạm tính: </span>
                <strong id="sum1">'.$Money.'&nbsp;₫</strong>
            </p>
	</div>
	<div class="box-style">
		<div class="total2">
			<span class="text-label">Thành tiền: </span>
			<div class="amount">
				<p><strong id="sum2">'.$Money.'&nbsp;₫ </strong></p>
				<p class="text-right"><small>(Đã bao gồm VAT)</small></p>
			</div>
		</div>
	</div>
	<input type="button" class="btn btn-large btn-checkout" value="Tiến hành đặt hàng" onclick="Confirm()" /></div>';

	mysqli_close($con);
?>
	</div>
    
	<?php
		include("back-to-top.php");
		include("footer.php");
    ?>
    </div>
</body>
</html>