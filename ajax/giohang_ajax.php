<?php
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	session_start();
	$con = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($con, 'UTF8');
	
	 // Lấy ID hóa đơn hiện tại
	$result = mysqli_query($con,"SELECT * from orders");
	$Oid=$result->num_rows+1;
	

	// Lấy thời gian hiện tại
	date_default_timezone_set("Asia/Saigon");
	$Odate=date("Y-m-d h:i:s");
	// Tiền hóa đơn
	$Total=$_POST['money'];
	// Địa chỉ giao hàng
	$user_info=$_POST['user'];
	$email_info=$_POST['email'];
	$Stt=0;
	$str="<center><table border='1px solid black' class='tb-css'><tr><th colspan='7' align='center'>Thông tin giao dịch</th></tr>
		<tr class='row-HD'><th>Stt</th><th>Tên sản phẩm</th><th>Số lượng mua</th><th>Đơn giá</th><th>Giảm giá</th><th>Thành tiền</th><th>Key</th></tr>";	
				
	if (isset($_SESSION['user'])) //member
	{
		// Lưu hóa đơn vào database
		$HD_sql="INSERT INTO `orders`(`Cid`, `Odate``, `Total`, `Ostatus`) VALUES ('".$_SESSION['userId']."','$Odate','$Total','Hoàn thành')";
		mysqli_query($con,$HD_sql);
	
		// Sale
		$sqlSale="SELECT * FROM `customera`,`usertype` WHERE Cid='".$_SESSION['userId']."' AND customera.UserTypeId=usertype.UserTypeId";
		$S_re=mysqli_query($con,$sqlSale);
		$Sale_re=mysqli_fetch_array($S_re);
		$Sale=floatval($Sale_re['TypeDiscount']);
		// Số dư trong tài khoản
		$sqlCus="Select * from customera where Cid='".$_SESSION['userId']."'";
		$Run_sqlCus=mysqli_query($con,$sqlCus);
		$Customer=mysqli_fetch_array($Run_sqlCus);
		if ($Customer['Balance']>=$Total)
		{
	//		echo 1; // Giao dịch thành công
	// Update info-rank-blablabla customer
			$New_Balance=$Customer['Balance']-$Total;
//			$New_TCharged=$Customer['TCharged']+$Total;
//			$New_UType=$Customer['UserTypeid'];
			$sql_UsType="Select * from `usertype`";
			$result_UsType=mysqli_query($con,$sql_UsType);
			echo '<div style=" float: left; ">
			<div>User: '.$user_info.'</div>
			<div>Email: '.$email_info.'</div>
			</div>';
			

			$Cus_sql="UPDATE `customera` SET  `Balance`='$New_Balance' WHERE Cid='".$_SESSION['userId']."'";

			
			foreach ($_COOKIE as $key=>$val)
			{
				if (preg_match("/product/",$key))
				{
					$id=explode("product",$key);
					$sql="Select * from games where Gid='$id[1]'";
					$result=mysqli_query($con,$sql);
					$row=mysqli_fetch_array($result);
					$Price=$row['Price']*$val-($row['Price']*$val*$Sale/100);
					$str=$str."<tr><td class='cell-HD'>".$Stt."</td><td class='cell-HD'>".$row['Gname']."</td><td class='cell-HD'>".$val."</td><td class='cell-HD'>".($row['Price']*$val)."</td><td class='cell-HD'>".$Sale."%</td><td class='cell-HD'>".$Price."</td><td class='cell-HD'>";
					for ($i=0;$i<$val;$i++)
					{
						$get_key=generateRandomString();
						if ($i==$val-1) $str=$str."<div class='key_final'>".$get_key."</div>";
						else $str=$str."<div class='key'>".$get_key."</div>";
						$sql_updqte_key="INSERT INTO `gkeys`(`Gkey`, `Gid`, `Oid`) VALUES ('$get_key','$id[1]', '$Oid')";
						mysqli_query($con,$sql_updqte_key);
					}
					$str=$str."</td></tr>";
					// Lưu chi tiết hóa đơn vào database
					$Odetail_sql="INSERT INTO `odetail`(`Oid`, `Gid`, `Amount`, `Price`) VALUES ('$Oid','$id[1]','$val','$Price')";
					mysqli_query($con,$Odetail_sql);
					$Stt++;
					setcookie($key, "false", time() - (86400 * 30), "/"); //xóa cookie
				}
			}
			echo $str."<tr><th colspan='2' align='right'>Tổng cộng:</th><th colspan='5' align='center'>".$Total."&nbsp;₫</th></tr></table></center>";
		}
		else echo 0; // Số sư tài khoản không đủ
	}
	else //guest
	{
		// Lưu hóa đơn vào database
		$HD_sql="INSERT INTO `orders`(`Cid`, `Odate`, `DDate`, `Total`) VALUES ('100','$Odate','$Odate','$Total')";
		mysqli_query($con,$HD_sql);

		// Sale
		$Sale=0;

		// Update info-rank-blablabla customer
		echo '<div style=" float: left; width:20%;">
		<div>User: '.$user_info.'</div>
		<div>Email: '.$email_info.'</div>
		<div>Địa chỉ: '.$address_info.'</div><br />
		
		<div>Quý khách vui lòng chuyển khoản theo yêu cầu để hoàn thành giao dịch</div><br />
		<div>Ngân hàng nhận: NHNN&PTNT An Phú HCM - PGD Nguyễn Văn Cừ</div><br />
		<div>Tên người nhận: SANGSHOP</div><br />
		<div>Số tài khoản: <strong>1606201036100</strong></div><br />
		<div>Số tiền: '.$Total.'&nbsp;₫</div><br />
		<div>Nội dung: Mua hàng SANGSHOP, số hóa đơn '.$Oid.'</div><br />
		</div>';
				
		foreach ($_COOKIE as $key=>$val)
		{
			if (preg_match("/product/",$key))
			{
				$id=explode("product",$key);
				$sql="Select * from games where Gid='$id[1]'";
				$result=mysqli_query($con,$sql);
				$row=mysqli_fetch_array($result);
				$Price=$row['Price']*$val-($row['Price']*$val*$Sale/100);
				$str=$str."<tr><td class='cell-HD'>".$Stt."</td><td class='cell-HD'>".$row['Gname']."</td><td class='cell-HD'>".$val."</td><td class='cell-HD'>".($row['Price']*$val)."</td><td class='cell-HD'>".$Sale."%</td><td class='cell-HD'>".$Price."</td><td class='cell-HD'>";
				for ($i=0;$i<$val;$i++)
				{
					$get_key=generateRandomString();
					if ($i==$val-1) $str=$str."<div class='key_final'>Hoàn thành giao dịch để nhận key</div>";
					else $str=$str."<div class='key'>Hoàn thành giao dịch để nhận key</div>";
					$sql_updqte_key="INSERT INTO `gkeys`(`Gkey`, `Gid`) VALUES ('$get_key','$id[1]')";
					mysqli_query($con,$sql_updqte_key);
				}
				$str=$str."</td></tr>";
				// Lưu chi tiết hóa đơn vào database
				$Odetail_sql="INSERT INTO `odetail`(`Oid`, `Gid`, `Amount`, `Price`) VALUES ('$Oid','$id[1]','$val','$Price')";
				mysqli_query($con,$Odetail_sql);
				$Stt++;
				setcookie($key, "false", time() - (86400 * 30), "/"); //xóa cookie
			}
		}
		echo $str."<tr><th colspan='2' align='right'>Tổng cộng:</th><th colspan='5' align='center'>".$Total."&nbsp;₫</th></tr></table></center>";

	}

//	echo $Total;
	mysqli_close($con);
?>