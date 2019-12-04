<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>

</style>
</head>

<?php
	echo '</table></div><form onchange="" action="adcpg.php?id='.$_GET['id'].'&col='.$_GET['col'].'&action='.$_GET['action'].'&ac=0&page='.$_GET['page'].'" method="post">';
	if($_GET['id'] == "orders")
	{
		echo '<div class="butts">';
		echo 'Orders status filter: <input list="filth" name="filth"/>';	
		echo '  <datalist id="filth" >
					<option value="Chưa thanh toán">
					<option value="Đang xử lý">
					<option value="Hoàn thành">
				</datalist>';
//		echo '<input type="submit" value="Tìm kiếm" /><input type="button" value="Add"  onclick="openNav1(&#039'.$_GET['id'].'&#039)"/></form>';
		echo '</form>';
	}
	if($_GET['id'] == "games")
	{
		echo '<div class="butts">Games search-filter: <input type="text" name="filth">';
		echo '<input type="submit" value="Tìm kiếm" >';		
		echo'<input type="button" value="Add"  onclick="openNav1(&#039'.$_GET['id'].'&#039)"/>';
		echo'</form>';
	}
	if($_GET['id'] == "Customera")
	{
		echo '<div class="butts">Customer search-filter: <input type="text" name="filth">';
		echo '<input type="submit" value="Tìm kiếm" >';	
		if($permit<1)
		echo'<input type="button" value="Add"  onclick="openNav1(&#039'.$_GET['id'].'&#039)"/>';
		echo'</form>';
	}
	
	
?>
<body>
</body>
</html>