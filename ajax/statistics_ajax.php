<?php
	$con = mysqli_connect("localhost","root","","sshop");
	mysqli_set_charset($con, 'UTF8');

	// Lấy thời gian hiện tại
//	date_default_timezone_set("Asia/Saigon");
//	$Odate=date("Y-m-d h:i:s");

	$from = $_GET['from'];
	$to = $_GET['to'];
	$result = mysqli_query($con,"SELECT count(*) as num, sum(Total) as total FROM orders where Odate between '$from' and '$to'");

	echo 'Tổng số hóa đơn: ';
	$row = mysqli_fetch_array($result);
	echo $row['num'];
	echo '<br/><br/>Tổng doanh thu: ';
	echo $row['total'];
	echo '<br/><br/>Tổng số khách mua hàng: ';
	
	$query2= "SELECT *
			FROM orders
			where Odate between '$from' and '$to'
			GROUP BY Cid";
	$result = mysqli_query($con,$query2);
	echo $result->num_rows;
	echo '<br/><br/>Top game bán chạy:<br/>';

	$query3="SELECT count(gkeys.Gid) as num, Gname FROM orders INNER JOIN gkeys ON orders.Oid = gkeys.Oid INNER JOIN games ON gkeys.Gid = games.Gid where Odate between '$from' and '$to' GROUP BY gkeys.Gid ORDER BY num DESC limit 10;";
	$result = mysqli_query($con,$query3);
	$i=0;
	echo '<div style="margin-left:20px">';
	while($row = mysqli_fetch_array($result))
	{
		echo ++$i.". ";
		echo $row['Gname']." (bán được ".$row['num'].")<br/>";
	}
	echo '</div>';


	echo '<br/>Top thể loại được ưa chuộng:<br/>';
	$query4="SELECT count(ggenre.GGid) as num, games.GGid, ggenre.GGname FROM orders INNER JOIN gkeys ON orders.Oid = gkeys.Oid INNER JOIN games ON gkeys.Gid = games.Gid INNER JOIN ggenre ON games.GGid = ggenre.GGid where Odate between '$from' and '$to' GROUP BY ggenre.GGid ORDER BY num DESC limit 10";

	echo '<div style="margin-left:20px">';
	$result = mysqli_query($con,$query4);
	$i=0;
	while($row = mysqli_fetch_array($result))
	{
		echo ++$i.". ";
		echo $row['GGname']."<br/>";
	}
	echo '</div>';

	mysqli_close($con);
?>