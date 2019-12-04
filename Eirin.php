<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	// $servername = "localhost";
	// $username = "root";
	// $password = "";			
	// $dbname = "sshop";	
	// $conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	$conn->query("set names utf8");
	$tab=strval($_GET['tab']);
	//$quer2="SELECT COLUMN_NAME as col FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tab."' and table_schema='sshop'";
	//$result2 = $conn->query($quer2);
	if($tab=="Customera")
	{
		echo '<form name="customera" method="post" onsubmit="return ajaxCustomer();" enctype="multipart/form-data">';
		echo '<table>';
		echo '<tr><td> &nbsp; </td><td><input type="hidden" name="tab" onfocus="this.blur()" value="'.$tab.'"/></td></tr>';
		$getCid = mysqli_query($conn,"SELECT MAX(Cid) FROM `customera` WHERE Cid<1000");
		//$Cid=$getCid->num_rows+1;
		$Cid=mysqli_fetch_array($getCid);
		echo'<tr><td> &nbsp; </td><td> <input type="hidden" name="Cid" value="'.($Cid['MAX(Cid)']+1).'" required/></td></tr>';
		echo'<tr><td> Email: </td><td> <input type="email" name="Cmail" onBlur="checkMail()" required/><div id="Cmail"></div></td></tr>';
		echo'<tr><td>Password: </td><td> <input type="password" id="pass1" name="Cpasswd" required/></td></tr>';
		echo'<tr><td>Re-type Password: </td><td> <input type="password" id="pass2" onchange="checkpass()" name="Cpasswde" required/><div id="warn"></div></td></tr>';
		echo'<tr><td> Balance: </td><td> <input type="text" name="Balance" pattern="[0-9]+" title="Số dư trong tài khoản phải là ký tự số!" required/></td></tr>';
		echo'<tr><td> Name: </td><td> <input type="text" name="Cname" pattern="[^0-9]+" title="Họ tên chỉ bao gồm các ký tự chữ cái!" required/></td></tr>';
		echo'<tr><td> Phone: </td><td> <input type="text" name="Cphone" maxlength="12" pattern="[0-9]+" title="Số điện thoại chỉ bao gồm các ký tự số!" onBlur="checkPhone()" required/><div id="Cphone"></div></td></tr>';
		echo'<tr><td> Birthdate: </td><td> <input type="date" name="Cbirthdate" required style="width: 169px;"/></td></tr>';
		echo'<tr><td> Gender: </td><td> <select name="Cgender"><option value="Nam" selected>Nam</option><option value="Nữ">Nữ</option><option value="Khác">Khác</option></select></td></tr>';
		echo"<tr><td> Customer Type: </td><td><input type='text' id='heck' list='hell' name='UserTypeid' ' required/>";
			echo '<datalist id="hell">';
			$quer3="select UserTypename from UserType";
			$result3=$conn->query($quer3);	
			while ($row3=mysqli_fetch_array($result3))
			{
				echo "<option value='".$row3['UserTypename']."'>";
			}
			echo"</datalist></td></tr>";
		echo'<tr><td> TCharged: </td><td> <input type="number" name="TCharged" min="0" required/></td></tr>';
		echo'<tr><td> Banned: </td><td> <select name="banned"><option value="1">Lock</option><option value="0" selected>Open</option></select></td></tr>';
		echo'<tr><td> Footnote: </td><td> <input type="text" name="footnote" required/></td></tr>';
		echo '<tr><td></td><td><input type="submit" value ="Submit"/> <input type="button" onclick="closeNav()" value="cancel"/></td></tr></table>
		</form><div>
		</div>';
	}
	else
	{
		if ($tab=="orders")
		{
			echo '<div class="showCustomer" id="showCustomer">';
			echo '<table>';
			echo '<tr><td> Email: </td><td> <select name="Cmail" id="Cmail" style=" width:173px; " onChange="getCSinfo();"><option value="" disabled></option></select></tr>';
			echo '<tr><td> Balance: </td><td> <input type="text" name="Balance" id="Balance" disabled /></tr>';
			echo '<tr><td> Name: </td><td> <input type="text" name="Cname" id="Cname" disabled /></tr>';
			echo '<tr><td> Phone: </td><td> <input type="text" name="Cphone" id="Cphone" disabled /></tr>';
			echo '<tr><td> Birthdate </td><td> <input type="text" name="Cbirthdate" id="Cbirthdate" disabled /></tr>';
			echo '<tr><td> Gender </td><td> <input type="text" name="Cgender" id="Cgender" disabled /></tr>';
			echo '<tr><td> Customer Type: </td><td> <input type="text" name="UserTypeid" id="UserTypeid" disabled /></tr>';
			echo '<tr><td> TCharged: </td><td> <input type="text" name="TCharged" id="TCharged" disabled /></tr>';
			echo '<tr><td> Footnote: </td><td> <input type="text" name="footnote" id="footnote" disabled /></tr>';
			echo '</table>';
			echo '</div>';
			
			echo '<form name="order" method="post" enctype="multipart/form-data" onSubmit="return ajaxOrder();">';
			echo '<table>';
			echo '<tr><td> &nbsp; </td><td><input type="hidden" name="tab" onfocus="this.blur()" value="'.$tab.'"/></td></tr>';
			$getOid = mysqli_query($conn,"SELECT MAX(Oid) FROM `orders`");
			$Oid=mysqli_fetch_array($getOid);
			echo'<tr><td> Oid </td><td> <input type="number" name="Oid" value="'.($Oid['MAX(Oid)']+1).'" required/></td></tr>';
			echo'<tr><td> Khách hàng </td><td> <input type="text" id="heck" list="hell" name="Cid" onFocus="CS(this.value);" onChange="getEmail(this.value);" required/></td></tr>';
					echo '<datalist id="hell">';
					echo"</datalist></td></tr>";
			
			
			echo'<tr><td> Ngày đặt </td><td> <input type="date" name="Odate" style=" width: 169px;" required/></td></tr>';
			echo'<tr><td> Ngày giao </td><td> <input type="date" name="DDate" style=" width: 169px;" required/></td></tr>';
			echo'<tr><td> Tổng tiền </td><td> <input type="number" min="0" name="Total" required/></td></tr>';
			echo'<tr><td> Trạng thái </td><td> <select name="Ostatus" style=" width:173px; "><option value="Đang xử lý" selected>Đang xử lý</option><option value="Chưa thanh toán" >Chưa thanh toán</option><option value="Hoàn thành" >Hoàn thành</option></select></td></tr>';
			echo '<tr><td></td><td><input type="submit" value ="Submit"/> <input type="button" onclick="closeNav()" value="cancel"/></td></tr></table></form><div></div>';
			

			echo '<div class="Odetail" id="Odetail">
    		<table>
        	<tr><th>STT</th><th>Game</th><th>Số lượng</th><th>Đơn giá bán</th></tr>
			<tr>
				<td align="center" class="STT">1</td>
				<td align="center">
				<input type="text" name="Gname" class="Gname" id="LGname" list="hellz" style="width: 80px;" onFocus="LG(this.value,1);" onBlur="setPrice(this.value,1);" required /></td>';
			echo '<datalist id="hellz" class="hellz"></datalist></td>';
			echo '<td align="center"><input type="number" min="0" name="Amount" class="Amount" style="width: 60px;" required /></td>
				<td align="center"><input type="number" min="0" name="Price" class="Price" style="width: 80px;" required /></td>
			</tr>
			<tr id="them"><td colspan="5" align="center"><input type="button" value="Thêm" onClick="Them()"/></td></tr>
			</table></div>';
		}
		else
		{
			echo '<form action="add.php" method="post" enctype="multipart/form-data">';
			echo '<table>';
			echo '<tr><td> &nbsp; </td><td><input type="hidden" name="tab" onfocus="this.blur()" value="'.$tab.'"/></td></tr>';
			echo'<tr><td> Gid </td><td> <input type="number" name="Gid" required/></td></tr>';
			echo'<tr><td> Gname </td><td> <input type="text" name="Gname" required/></td></tr>';
			echo"<tr><td>Game Genre</td><td><input type='text' id='heck' list='hell' name='GGid' required/>";
				echo '<datalist id="hell">';
				$quer3="select GGname from ggenre";
				$result3=$conn->query($quer3);	
				while ($row3=mysqli_fetch_array($result3))
				{
					echo "<option value='".$row3['GGname']."'>";
				}
				echo"</datalist></td></tr>";
			echo"<tr><td>Provider</td><td><input type='text' id='heck2' list='hell2' name='Nid' required/>";
				echo '<datalist id="hell2">';
				$quer3="select NBmail from ncc";
				$result3=$conn->query($quer3);	
				while ($row3=mysqli_fetch_array($result3))
				{
					echo "<option value='".$row3['NBmail']."'>";
				}
				echo"</datalist></td></tr>";
			echo'<tr><td> ESRB </td><td> <input type="text" name="ESRB" required/></td></tr>';
			echo'<tr><td> description </td><td> <input type="text" name="description" required/></td></tr>';
			echo'<tr><td> Price </td><td> <input type="number" min="0" name="Price" required/></td></tr>';
			echo'<tr><td> Rating </td><td> <input type="number" min="0" max="10" name="Rating" style="width:169px;" required/></td></tr>';
			echo '<tr><td>Select image to upload:</td><td><input type="file" name="gimage" id="gimage"></td></tr>';
			echo '<tr><td></td><td><input type="submit" value ="Submit"/> <input type="button" onclick="closeNav()" value="cancel"/></td></tr></table></form><div></div>';
/*			while($row2 = mysqli_fetch_array($result2))
			{
				$flag=0;
				if($row2['col'] == 'gimage')
				{
					$flag=1;
				}
	//			if($row2['col'] == 'Cpasswd') $flag=2;
				if($row2['col'] == 'GGid') $flag=3;	
				if($row2['col'] == 'Nid') $flag=4;
	//			if($row2['col'] == 'UserTypeid') $flag=5;
				if($flag==0)
				echo '<tr><td>'.$row2['col'].'</td> <td><input type="text" name="'.$row2['col'].'" required></td></tr>';*/
	/*			elseif($flag==2)
				{
					echo'<tr><td>Password: </td><td> <input type="password" id="pass1" name="Cpasswd" required/></td></tr>';
					echo'<tr><td>Re-type Password: </td><td> <input type="password" id="pass2" onchange="checkpass()" name="Cpasswde" required/><div id="warn"></div></td></tr>';
				}
	*/
/*				elseif($flag==4)
				{
					echo"<tr><td>Provider</td><td><input type='text' id='heck2' list='hell2' name='Nid' required/>";
					echo '<datalist id="hell2">';
					$quer3="select NBmail from ncc";
					$result3=$conn->query($quer3);	
					while ($row3=mysqli_fetch_array($result3))
					{
						echo "<option value='".$row3['NBmail']."'>";
					}
					echo"</datalist></td></tr>";
				}*/
	/*			elseif($flag==5)
				{
					echo"<tr><td>Customer Type</td><td><input type='text' id='heck' list='hell' name='UserTypeid' ' required/>";
					echo '<datalist id="hell">';
					$quer3="select UserTypename from UserType";
					$result3=$conn->query($quer3);	
					while ($row3=mysqli_fetch_array($result3))
					{
						echo "<option value='".$row3['UserTypename']."'>";
					}
					echo"</datalist></td></tr>";	
				}
	*/
/*				elseif($flag==3)
				{						
					echo"<tr><td>Game Genre</td><td><input type='text' id='heck' list='hell' name='GGid' required/>";
					echo '<datalist id="hell">';
					$quer3="select GGname from ggenre";
					$result3=$conn->query($quer3);	
					while ($row3=mysqli_fetch_array($result3))
					{
						echo "<option value='".$row3['GGname']."'>";
					}
					echo"</datalist></td></tr>";
				}
				else
				{
					echo '<tr><td>Select image to upload:</td><td>
					<input type="file" name="gimage" id="gimage"></td></tr>';
				}
				}
				echo '<tr><td></td><td><input type="submit" value ="Submit"/> <input type="button" onclick="closeNav()" value="cancel"/></td></tr></table></form><div></div>';*/
		}
	}
	?>	
</body>
</html>