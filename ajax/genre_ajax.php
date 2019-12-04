<?php

include("sang-script.php");

$genre=$_GET['genre'];
$curPage = $_GET['curPage'];
$itemsPerPage = $_GET['itemsPerPage'];
$start = ($curPage-1) * $itemsPerPage;

// $conn=mysqli_connect("localhost", "root", "", "sshop") 
$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
mysqli_set_charset($conn, 'UTF8');

$query="select count(*) from games where GGid = '$genre'";
$result = mysqli_query($conn, $query);
$count = mysqli_fetch_array($result);

$query="select * from games where GGid = '$genre' limit $start, $itemsPerPage";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0)
{
	while($row=mysqli_fetch_array($result))
	{
		show($row['Gid'], $row['Gname'], $row['gimage'], $row['Price']);
	}
	echo "&count=" . $count[0];
}
else echo "Không có sản phẩm";
mysqli_close($conn);
?>