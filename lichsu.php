<?php 
    session_start();
    $con = mysqli_connect("localhost","root","","sshop");
    // $con = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($con, 'UTF8');
?>
<!doctype html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="CSS/signup.css">
<link href="CSS/product.css" rel="stylesheet" type="text/css" />
<link href="CSS/contact-intro.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lịch sử mua hàng</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>
<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#eee; height: 110%" align="center">
        <?php
            include("header.php");
        ?>
    	<div class="mutual-bigtitle" style="font-size:30px">
            Lịch sử mua hàng
        </div>
        <hr style="width: 90%">
        <div class="mutual-content" style="margin-left: 150px; margin-bottom: 20px;"> 
        <?php
            $query = "SELECT * from orders where Cid=" . $_SESSION['userId'];

            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo '<div margin-horizontal: 50px;"><p style="font-weight:bold; font-size: 20px">Hóa đơn số: '. $row['Oid'] .'</p>';
                    echo '<p style="font-size: 16px">Thời điểm mua: '. $row['Odate'] .'</p>';
                    echo '<p style="font-size: 16px">Thành tiền: '. $row['Total'] .'đ</p>';
					//get odetail
					$query2 = "select * from odetail where Oid = ".$row['Oid'];
					$result2 = mysqli_query($con, $query2);
					if (mysqli_num_rows($result2) > 0)
						echo '<p style="font-size: 16px">Chi tiết:</p><table style="font-size: 14px;">
							  <tr>
								<th>Tên game</th>
								<th>Số lượng</th>
								<th>Giá</th>
								<th>Key</th>
							  </tr>';
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
					{
						//get game name
						$query3 = "select Gname from games where Gid='".$row2['Gid']."'";
						$result3 = mysqli_query($con, $query3);
						$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
						echo "<tr>
							<td>".$row3['Gname']."</td>
							<td>".$row2['Amount']."</td>
							<td>".$row2['Price']."</td>
							<td>";
						//get keys
						$query4 = "select Gkey from gkeys where Gid='".$row2['Gid']."' and Oid='".$row['Oid']."'";
						$result4 = mysqli_query($con, $query4);
						while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC))
						{
							echo "<div>".$row4['Gkey']."</div>";
						}
						echo "</td>
						  </tr>";
					}
					echo '
						 
						</table>';
                    echo '</div><div style="height:100px"></div>';
                }
            }
            else echo "Không có hóa đơn nào.";
        ?>
        </div>       
    </div>        
	<?php
		include("back-to-top.php");
        include("footer.php");
        mysqli_close($con);
    ?>
</body>
</html>