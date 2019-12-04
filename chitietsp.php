<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link href="CSS/spStyle.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sang Shop</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#EEE" align="center">
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
		
		$gid=$_GET['gid'];
		$conn=mysqli_connect("localhost", "root", "", "sshop");
		$query=mysqli_query($conn, "select * from games where Gid=$gid");
		$row=mysqli_fetch_array($query);
		$query=mysqli_query($conn, "select GGname from ggenre where GGid=".$row['GGid']);
		$genre=mysqli_fetch_array($query);
		$genre=$genre[0];
		$imglist=explode("??", $row['gimage']);
		$trailer=$imglist[count($imglist)-1];
		$query=mysqli_query($conn, "select * from config where Gid=$gid");
		$row2=mysqli_fetch_array($query);
		mysqli_close($conn);
		
		echo
		'<div style="float: left; padding-left: 50px; padding-right: 20px; background-color: #EEE">
	<div> 	<h1 class="titleSP"> '.$row['Gname'].'</h1> </div>
    <div style="width: 100%; height: 100%; float: left;">
    <div class="containerSP">
    	<hr>
        <iframe width="600" height="400" src="'.$trailer.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

    </div>
    <div class="detailSP">
        &diams;&nbsp; Thể loại: '.$genre.'
        <br><br>
        &diams;&nbsp; ESRB: '.$row['ESRB'].'
        <br><br>
        &diams;&nbsp; Rating: '.$row['Rating'].'
        <br> <br>
        &diams;&nbsp; Description: '.shorten($row['description']).'
        <br><br>
    
    </div>
    <div class="priceSP">
        '.price($row['Price']).' VND
        <div draggable="true" class="buySP" onclick="addCart('.$gid.')">
            Thêm vào giỏ
        </div>
    </div>

    <div class="detailBar">
        <div class="blockBar" onClick="switchContent(false)"> yêu cầu hệ thống </div>
        <div class="blockBar" onClick="switchContent(true)"> preview gameplay </div>
    </div>
    </div>
    <div class="info">
            <p> <span> OS: </span> '.$row2['OS'].' </p>
            <p> <span> Processor: </span> '.$row2['Processor'].' </p>
            <p> <span> Memory: </span> '.$row2['Memory'].' </p>
            <p> <span> Graphics: </span> '.$row2['Graphics'].' </p>
            <p> <span> DirectX: </span> '.$row2['DirectX'].' </p>
            <p> <span> Storage: </span> '.$row2['Storage'].' </p>
            <p> <span> Sound Card: </span> '.$row2['Sound Card'].' </p>
    </div>
    <div class="preview" style="display:none">';
		for($i=0;$i<count($imglist)-1;$i++)
			echo $imglist[$i]."??";
    echo '
	</div>
</div>       ';
		
            include("back-to-top.php");
            include("footer.php");
        	?>

</body>
<script type="text/javascript">

//var info=$(".info").html();
var gameplayAt=0;

function switchContent(mode)
{
	if(mode)
	{
		$(".preview").show();
		$(".info").hide();
	}
	else
	{
		$(".info").show();
		$(".preview").hide();
	}
}

var s=$(".preview").html();
s=s.split("??");
gameplay(0);

function gameplay(mode)
{
	gameplayAt+=mode;
	if(gameplayAt>s.length-2)
		gameplayAt=0;
	else if(gameplayAt<0)
		gameplayAt=s.length-2;
	$(".preview").html('<input type="button" class="swtchbtn-left" value="&#10094;" onClick="gameplay(-1)"><img  class="preview-img" src="'+s[gameplayAt]+'"><input type="button" class="swtchbtn-right" value="&#10095;" onClick="gameplay(1)">');
}

</script>
</html>