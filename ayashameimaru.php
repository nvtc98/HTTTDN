<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body onLoad="initproduct()">
	<?php 		
	$tab=strval($_GET['tab']);
	$permit = $_GET['permit'];
	echo '<form action="update.php" method="post" enctype="multipart/form-data"';
	if ($tab=="orders")
		echo ' onSubmit="return subm()"';
	echo '>';
	$servername = "localhost";
	$username = "root";
	$password = "";			
	$dbname = "sshop";	
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	$conn->query("set names utf8");
	$_SESSION['tab']=$tab;	
	$IDs=strval($_GET['dore']);
	if($tab=="games") $col = "Gid";
	if($tab=="Customera") $col = "Cid";
	if($tab=="orders") $col = "Oid";
	if($tab=="UserType") $col = "UserTypeid";
	$quer = "select * from ".$tab." where ".$col." = ".$IDs;
	
	echo '<table>';
	echo '<tr style="display:none"><td>Table:</td> <td><input type="text" onfocus="this.blur()" name="tab" value="'.$tab.'" /></td></tr>';
	$result = $conn->query($quer);	
	if($tab=="games")
	{
	while ($row = mysqli_fetch_array($result))	
	{
		echo"<tr><td>Game ID:</td><td><input type='text' name='Gid' value='".$row['Gid']."'/></td></tr>";
		echo"<tr><td>Name:</td><td><input type='text' name='Gname' value='".$row['Gname']."'/></td></tr>";
		$quer2="select GGname from ggenre where GGid='".$row['GGid']."'";
		$result2=$conn->query($quer2);		
		$row2=mysqli_fetch_array($result2);
		echo"<tr><td>Game Genre</td><td><input type='text' id='heck' list='hell' name='GGid' value='".$row2['GGname']."' />";
		echo '<datalist id="hell">';
		$quer2="select GGname from ggenre";
		$result2=$conn->query($quer2);	
		while ($row2=mysqli_fetch_array($result2))
		{
			echo "<option value='".$row2['GGname']."'>";
		}
		echo"</datalist></td></tr>";
		$quer2="select NBmail from ncc where Nid='".$row['Nid']."'";
		$result2=$conn->query($quer2);		
		$row2=mysqli_fetch_array($result2);
		echo"<tr><td>Game Genre</td><td><input type='text' id='heck2' list='hell2' name='Nid' value='".$row2['NBmail']."' />";
		echo '<datalist id="hell2">';
		$quer2="select NBmail from ncc";
		$result2=$conn->query($quer2);	
		while ($row2=mysqli_fetch_array($result2))
		{
			echo "<option value='".$row2['NBmail']."'>";
		}
		echo"</datalist></td></tr>";
		echo"<tr><td>ESRB:</td><td><input type='text' name='ESRB' value='".$row['ESRB']."'/></td></tr>";
		echo"<tr><td>Price:</td><td><input type='text' name='Price' value='".$row['Price']."'/></td></tr>";
		echo"<tr><td>Rating:</td><td><input type='text' name='Rating' value='".$row['Rating']."'/></td></tr>";
		echo"<tr><td>description:</td><td><input type='text' name='description' value='".$row['description']."'/></td></tr>";
		echo"<tr><td>Game Images:</td><td><input type='text' name='gimage' value='".$row['gimage']."'/></td></tr>";
	}
	}
	if($tab=="Customera")
	{
	while ($row = mysqli_fetch_array($result))	
	{
		echo"<tr><td>Customer ID:</td><td><input type='text' name='Cid' value='".$row['Cid']."'/></td></tr>";
		echo"<tr><td>Customer Mail:</td><td><input type='text' name='Cmail' value='".$row['Cmail']."' onfocus='this.blur()' /></td></tr>";
		echo"<tr><td>Password:</td><td><input type='password' name='Cpasswd' value='".$row['Cpasswd']."' onfocus='this.blur()' /></td></tr>";
		echo"<tr><td>Balance:</td><td><input type='text' name='Balance' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['Balance']."'/></td></tr>";
		echo"<tr><td>Name:</td><td><input type='text' name='Cname' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['Cname']."'/></td></tr>";
		echo"<tr><td>Customer Phone:</td><td><input type='text' name='Cphone' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['Cphone']."'/></td></tr>";
		echo"<tr><td>Birthday:</td><td><input type='text' name='Cbirthdate' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['Cbirthdate']."'/></td></tr>";
		echo"<tr><td>Gender:</td><td><input type='text' name='Cgender' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['Cgender']."'/></td></tr>";
		$quer2="select UserTypename from UserType where UserTypeid=".$row['UserTypeid'];
		$result2=$conn->query($quer2);		
		$row2=mysqli_fetch_array($result2);
		echo"<tr><td>Customer Type</td><td><input type='text' id='heck' list='hell' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "name='UserTypeid' value='".$row2['UserTypename']."' />";
		echo '<datalist id="hell">';
		$quer2="select UserTypename from UserType";
		$result2=$conn->query($quer2);	
		while ($row2=mysqli_fetch_array($result2))
		{
			echo "<option value='".$row2['UserTypename']."'>";
		}
		echo"</datalist></td></tr>";		
		echo"<tr><td>Total Charged:</td><td><input type='text' name='TCharged' ";
		if($permit>0)
			echo"onfocus='this.blur()' ";
		echo "value='".$row['TCharged']."'/></td></tr>";
		echo "<tr><td>Banned:</td><td>";
		echo "<select  name='banned'>";
		$banned = $row['banned'];
		echo "<option ".($banned==0?"selected":"")."value='0'>false</option>";
		echo "<option ".($banned==1?"selected":"")." value='1'>true</option>";
		echo "</select></td></tr>";
//		<input type='text' name='banned' value='".$row['banned']."'/></td></tr>";
		echo"<tr><td>Footnote:</td><td><input type='text' name='footnote' value='".$row['footnote']."'/></td></tr>";
	}
	}
	if($tab=="orders")
	{
	while ($row = mysqli_fetch_array($result))	
	{
		echo"<tr><td>Orders ID:</td><td><input type='text' name='Oid' value='".$row['Oid']."'/></td></tr>";
		$quer2="select Cmail from customera where Cid=".$row['Cid'];
		$result2=$conn->query($quer2);		
		$row2=mysqli_fetch_array($result2);
		echo"<tr><td>Customer Mail</td><td><input type='text' id='heck' list='hell' name='Cid' value='".$row2['Cmail']."' />";
		echo '<datalist id="hell">';
		$quer2="select Cmail from customera";
		$result2=$conn->query($quer2);	
		while ($row2=mysqli_fetch_array($result2))
		{
			echo "<option value='".$row2['Cmail']."'>";
		}
		echo"</datalist></td></tr>";
		echo"<tr><td>Ordered Time</td><td><input type='datetime-local' name='Odate' value='".str_replace(" ","T",$row['Odate'])."'/></td></tr>";
		echo"<tr><td>Delivered Time:</td><td><input type='datetime-local' name='DDate' value='".str_replace(" ","T",$row['DDate'])."'/></td></tr>";
		echo'
		<tr><td colspan="2" id="dssp" style="display:none">
		Danh sách sản phẩm<hr>
		</td></tr>
		<tr><td colspan="2">
			<div id="product-area"></div>
		</td></tr>
		<tr><td colspan="2">
			<input type="button" value="Xem danh sách sản phẩm" onClick="view(this,'.$IDs.')">
		</td></tr>
		<tr><td colspan="2">
			<input type="button" id="addp" style="display:none" value="Thêm sản phẩm" onClick="addproduct()">
			<div id="plim"></div>
		</td></tr>
		';
		//echo"<tr><td>Total:</td><td><input type='text' name='Total' value='".$row['Total']."'/> VND</td></tr>";
		echo'<tr><td>Order Status:</td><td>
		<select name="Ostatus" id="Ostatus">
			<option ';
			if($row['Ostatus'] == "Chưa thanh toán")
				echo "selected";
			echo ">Chưa thanh toán</option>
			<option ";
			if($row['Ostatus'] == "Đang xử lý")
				echo "selected";
			echo ">Đang xử lý</option>
			<option ";
			if($row['Ostatus'] == "Hoàn thành")
				echo "selected";
			echo ">Hoàn thành</option>
		</select></td></tr>";		
	}
	}
	echo '<tr><td> </td> <td><input type="submit" value ="Submit"/><input type="button" onclick="closeNav()" value="cancel"/></td></tr>
	</form><div>
	</div>';

	
	?>
</body>
</html>