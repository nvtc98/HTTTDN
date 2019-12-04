<?php session_start() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link href="CSS/contact-intro.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thông tin</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>

<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#eee; height: 110%" align="center">
		<?php include("header.php"); ?>
<!-- CONTENT --> 
	<div class="info-wrapper">
    	<div class="info-header"> chào mừng đến với sang shop </div>
    	<div class="info-table">
        	<div class="info-title"> cửa hàng game đa dạng </div>
            <div class="info-content"> 
            	Cửa hàng Sang Shop có khoảng 150 game với đa dạng các thể loại khác nhau. Tận hưởng 1 kho game khủng với giá siêu mềm là thứ chỉ có Sang Shop mới cung cấp được cho khách hàng 
            </div>
            <img class="info-img" src="IMG/info/bundle.png" />
        </div>
        <div class="info-table">
        	<div class="info-title"> đội ngũ hỗ trợ chuyên nghiệp </div>
            <div class="info-content"> 
            	Bất cứ có vấn đề gì thắc mắc, đội ngũ hỗ trợ của Sang Shop sẽ giải đáp và hỗ trợ các bạn trong thời gian sớm nhất có thể. <p>Thân thiện - Nhiệt tình - Lắng nghe là 3 tiêu chí chính của đội ngũ hỗ trợ Sang Shop.</p>
            </div>
            <img class="info-img" src="IMG/info/support.png" />
        </div>
        <div class="info-table">
        	<div class="info-title"> cộng đồng khách hàng lớn mạnh </div>
            <div class="info-content"> 
            	Sang Shop là 1 trong những shop bán game có cộng đồng khách hàng lớn mạnh, bạn có thể kết bạn mới, tham gia các group game. Với hàng triệu người bạn tiềm năng (và kẻ thù cũng vậy). Cuộc vui sẽ không bao giờ kết thúc.
            </div>
            <img class="info-img" src="IMG/info/community.png" />
        </div>
        <div class="info-table">
        	<div class="info-title"> Có thể mang sản phẩm bất cứ nơi đâu </div>
            <div class="info-content"> 
            	Với sản phẩm bạn nhận được từ chúng tôi (thông qua code), bạn có thể mang đi bất cứ đâu và tặng cho bất cứ ai. <p> Tuy nhiên, mỗi code sẽ chỉ có giá trị 1 lần, nên cân nhắc trước khi trao nó cho ai </p>
            </div>
            <img class="info-img" src="IMG/info/entertainment.jpg" />
        </div>
        <div class="info-table" style=" margin-bottom: 30px">
        	<div class="info-title"> Hỗ trợ nhiều hệ điều hành </div>
            <div class="info-content"> 
            	Với Sang Shop, dù là bạn đang trong hệ điều hành nào, bạn đều có thể thanh toán và nhận code game 1 cách dễ dàng, nhanh chóng và tiện lợi. </p>
            </div>
            <img class="info-img" src="IMG/info/os.jpg" />
        </div>
        <hr width="60%">
		<div style="background-color:#fd9a00; color: white; float:left; width: 90%; padding: 20px; font-family:Arial; font-size: 30px; margin-top: 10px"> 
        	Vậy còn chần chừ gì nữa? Hãy tham gia mua hàng tại Sang Shop ngay để được hưởng nhiều ưu đãi. Chúng tôi sẽ luôn đồng hành cùng bạn!
        </div>
    </div>
		
	<?php
		include("back-to-top.php");
		include("footer.php");
    ?>
</body>
</html>