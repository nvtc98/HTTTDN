<?php
$curPage = $_GET['curPage'];
$itemsPerPage = $_GET['itemsPerPage'];

// $conn = mysqli_connect('localhost', 'root', '', 'sshop')
$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
or die ('Lỗi: không thể kết nối. Hãy chơi khủng long .-.');
mysqli_set_charset($conn, 'UTF8');

$query = mysqli_query($conn, 'select count(*) from games');
$count = mysqli_fetch_array($query);

$start = ($curPage-1) * $itemsPerPage;
$query = mysqli_query($conn, "select * from games limit $start, $itemsPerPage");
if (mysqli_num_rows($query) > 0)
{
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
	{
		echo $row['Gname'].'<br>';
	}
	echo "&count=" . $count[0];
}
else echo "Không có sản phẩm";
mysqli_close($conn);
?>