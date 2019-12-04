<?php
$conn=mysqli_connect("localhost", "root", "", "sshop") or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
mysqli_set_charset($conn, 'UTF8');

$query="select * from games";
$result = mysqli_query($conn, $query);
$s="";
while($row=mysqli_fetch_array($result))
{
	//$s.= '<option value="'. $row[0] .'"></option>';
	$s.= '<option value="'. $row["Gid"] .'">'. $row["Gname"] .'</option>';
}

if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$d=1;
	$query="select * from odetail where Oid = '$id'";
	$result = mysqli_query($conn, $query);
	while($row=mysqli_fetch_array($result))
	{
		$gid='"'.$row["Gid"].'"';
		$t=str_replace($gid,$gid.' selected="selected" ', $s);
		echo '<div id="p'.$d.'"><select name="g'.$d.'" class="gameselect">'.$t.'</select><div>Số lượng</div>';
		$query2="select * from games where Gid = gid";
		$result2 = mysqli_query($conn, $query);
		$row2=mysqli_fetch_array($result2);
		echo '<input type="number" name="sl'.$d.'" value="'.$row["Amount"].'" ><br><input type="button" value="Xóa" onclick="remove('.$d.')"><hr></div>';
		$d++;
		echo "?count=".$d;
	}
}
else echo $s;


mysqli_close($conn);
?>