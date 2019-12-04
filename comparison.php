<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link href="CSS/product.css" rel="stylesheet" type="text/css" />
<link href="CSS/comparison.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>So sánh sản phẩm</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script language="javascript" src="JS/jquery.cookie.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#EEE; overflow: auto" align="center">
		<?php 
			include("header.php");
			
			function shorten($s)
			{ 
				$len=500;
				if(strlen($s)>$len)
					$s = substr($s, 0, $len);
				return substr($s, 0, strrpos($s,".")+1);
			}
			
			function price($price)
			{
				$price = (string)$price;
				$dotPosition = strlen($price)-3; 
				while($dotPosition>0)
				{
					$price = substr_replace($price, ' ', $dotPosition, 0); 
					$dotPosition-=3;
				}
				return $price;
			}
			
			if(!isset($_COOKIE['cmpr2']))
				echo '<div style="min-height:80vh; padding-top:50px">Bạn chưa chọn sản phẩm. Vui lòng chọn ít nhất 2 sản phẩm để so sánh.</div>';
			else
			{
				$id1=$_COOKIE['cmpr1'];
				$id2=$_COOKIE['cmpr2'];
				$conn=mysqli_connect("localhost", "root", "", "sshop");
				$query=mysqli_query($conn, "select * from games where Gid=$id1");
				$row=mysqli_fetch_array($query);
				$query=mysqli_query($conn, "select * from games where Gid=$id2");
				$row2=mysqli_fetch_array($query);
				$query=mysqli_query($conn, "select GGname from ggenre where GGid=".$row['GGid']);
				$genre=mysqli_fetch_array($query);
				$genre=$genre[0];
				$query=mysqli_query($conn, "select GGname from ggenre where GGid=".$row2['GGid']);
				$genre2=mysqli_fetch_array($query);
				$genre2=$genre2[0];
				$img=explode("??", $row['gimage']);
				$img=$img[0];
				$img2=explode("??", $row2['gimage']);
				$img2=$img2[0];
				$query=mysqli_query($conn, "select NBmail from ncc where Nid=".$row['GGid']);
				$ncc=mysqli_fetch_array($query);
				$ncc=$ncc[0];
				$query=mysqli_query($conn, "select NBmail from ncc where Nid=".$row2['GGid']);
				$ncc2=mysqli_fetch_array($query);
				$ncc2=$ncc2[0];
				$query=mysqli_query($conn, "select * from config where Gid=$id1");
				$config=mysqli_fetch_array($query);
				$query=mysqli_query($conn, "select * from config where Gid=$id2");
				$config2=mysqli_fetch_array($query);
				mysqli_close($conn);
				echo
        '<div class="comparation-ss content"> so sánh sản phẩm </div>
		 <div class="comparation-wrapper">
		 	<div class="tr">
            	<div class="comparation-title"> '.$row['Gname'].'</div>
				<div class="comparation-title"> '.$row2['Gname'].'</div>
			</div>
			<div class="tr">
				<div class="td">
					<hr style="width: 80%">
					<div class="comparation-img"> <img src="'.$img.'" width="100%"> </div>
					<hr style="width: 80%">
				</div>
				<div class="td">
					<hr style="width: 80%">
                		<div class="comparation-img"> <img src="'.$img2.'" width="100%"> </div>
                	<hr style="width: 80%">
				</div>
			</div>
			<div class="tr">
				<div class="td">
					<div class="comparation-criterion"> Giá </div>
					<div class="comparation-detail"> '.price($row['Price']).' VND </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Giá </div>
                	<div class="comparation-detail"> '.price($row2['Price']).' VND </div>
				</div>
			</div>
			<div class="tr">
				<div class="td">
					<div class="comparation-criterion"> Rating </div>
					<div class="comparation-detail"> '.$row['Rating'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Rating </div>
                	<div class="comparation-detail"> '.$row2['Rating'].' </div>
				</div>
			</div>	
			<div class="tr">
				<div class="td">
					<div class="comparation-criterion"> Thể loại </div>
					<div class="comparation-detail"> '.$genre.' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Thể loại </div>
					<div class="comparation-detail"> '.$genre2.' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> NCC </div>
					<div class="comparation-detail"> '.$ncc.' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> NCC </div>
					<div class="comparation-detail"> '.$ncc2.' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> ESRB </div>
					<div class="comparation-detail"> '.$row['ESRB'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> ESRB </div>
					<div class="comparation-detail"> '.$row2['ESRB'].' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> Mô tả </div>
					<div class="comparation-detail"> '.shorten($row['description']).' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Mô tả </div>
					<div class="comparation-detail"> '.shorten($row2['description']).' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> OS </div>
					<div class="comparation-detail"> '.$config['OS'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> OS </div>
					<div class="comparation-detail"> '.$config2['OS'].' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> Processor </div>
					<div class="comparation-detail"> '.$config['Processor'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Processor </div>
					<div class="comparation-detail"> '.$config2['Processor'].' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> Memory </div>
					<div class="comparation-detail"> '.$config['Memory'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Memory </div>
					<div class="comparation-detail"> '.$config2['Memory'].' </div>
				</div>
			</div>
			<div class="tr">
                <div class="td">
					<div class="comparation-criterion"> Graphics </div>
					<div class="comparation-detail"> '.$config['Graphics'].' </div>
				</div>
				<div class="td">
					<div class="comparation-criterion"> Graphics </div>
					<div class="comparation-detail"> '.$config2['Graphics'].' </div>
				</div>
			</div>
			<div class="tr">
				<div class="td">
					<div class="comparation-criterion"> Storage </div>
					<div class="comparation-detail"> '.$config['Storage'].' </div> 
				</div>   
				<div class="td">
					<div class="comparation-criterion"> Storage </div>
					<div class="comparation-detail"> '.$config2['Storage'].' </div> 
				</div>            
            </div>
		</div>';
			}
			
            include("back-to-top.php");
            include("footer.php");
        ?>
    </div>
</body>
</html>

<!--
--------------CUT CONTENT------------
        	<div class="comparation-product">
            	
                
                
                

                <div class="comparation-criterion"> NCC </div>
                <div class="comparation-detail"> '.$ncc2.' </div>
                <div class="comparation-criterion"> ESRB </div>
                <div class="comparation-detail"> '.$row2['ESRB'].' </div>
                <div class="comparation-criterion"> Mô tả </div>
                <div class="comparation-detail"> '.$row2['description'].' </div>
				<div class="comparation-criterion"> OS </div>
                <div class="comparation-detail"> '.$config2['OS'].' </div>
                <div class="comparation-criterion"> Processor </div>
                <div class="comparation-detail"> '.$config2['Processor'].' </div>
                <div class="comparation-criterion"> Memory </div>
                <div class="comparation-detail"> '.$config2['Memory'].' </div>
                <div class="comparation-criterion"> Graphics </div>
                <div class="comparation-detail"> '.$config2['Graphics'].' </div>
                <div class="comparation-criterion"> Storage </div>
                <div class="comparation-detail"> '.$config2['Storage'].' </div>               
            </div>     
        </div> -->