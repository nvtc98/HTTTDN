<link href="CSS/left-menu.css" rel="stylesheet" type="text/css" />

<div class="leftmenu">
	<ul>
        <li><a href="index.php"> Trang chủ </a></li> 
        <li style="font-size: 22px;  padding-left: 45px;" onclick="extendGenre(this)"> thể loại &#9656;</li> 
        	<ul class="genreList">
            	<?php
					$conn=mysqli_connect("localhost", "root", "", "sshop");
					$query=mysqli_query($conn, "select * from ggenre");
					while($row=mysqli_fetch_array($query))
						echo '<li onclick="window.location='."'genre.php?".$row['GGid']."'".'">'.$row['GGname'].'</li>';
					mysqli_close($conn);
				?>
            </ul>
        <li><a href="comparison.php"> so sánh</a></li>     
        <li><a href="information.php"> thông tin</a></li> 
        <li><a href="contact.php"> liên hệ</a></li>   
  	</ul>
</div>
    
<script>
	var leftMenuOpen=false;
	function toggleLeftMenu()
	{
		if(leftMenuOpen)
		{
			$(".push-wrap").animate({marginLeft:"0", marginRight:"0"}, "fast");
			leftMenuOpen=false;
			$(".leftmenu").css("z-index", "-5");
		}
		else
		{
			$(".push-wrap").animate({marginLeft:"250px", marginRight:"-250px"}, "fast");
			leftMenuOpen=true;
			setTimeout(function(){ $(".leftmenu").css("z-index", "5") }, 200);
		}
	}
	
	var genreExtended=false;
	function extendGenre(genre)
	{
		$(".genreList").slideToggle();
		if(genreExtended) genre.innerHTML=" thể loại &#9656;", genreExtended=false;
		else genre.innerHTML=" thể loại &#9662;", genreExtended=true;
	}
	
	function genreClick(GGid)
	{
		$.ajax(
		{
			url:"ajax/genre_ajax.php", type:"GET", dataType:"text", data:{genre: GGid}, success: function(status)
			{
				$(".content").html(status);
			}
		});
	}
</script>