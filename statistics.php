<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Statistics</title>
<style>

</style>
</head>
	
<body>
	<div style="float:right">
		<input type="button" style="" value="Back to admin page" onclick="window.location='adcpg.php'" />
	</div>
	<div style="margin: 5%; clear: both; font-size: 20px">
		<div>
			Thống kê
			từ
			<input type='date' id='from'/>

			tới
			<input type='date' id='to'/>

			<input type="button" style="" value="Go" onclick="go()" />
		</div>
		<hr/>
		<div id="content">
			Tổng số hóa đơn:
			<br/>
			Tổng doanh thu:
			<br/>
			Tổng số khách mua hàng:
			<br/>
			Top game bán chạy:
			<br/>
			Top thể loại được ưa chuộng:
			<br/>
		</div>
	</div>
</body>

	
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script>
	function go(){
		$from=$("#from").val();
		$to=$("#to").val();
		$.ajax({url:"ajax/statistics_ajax.php", type:"GET", dataType:"text", data:{ from: $from, to: $to }, 
		success: function(result) 
			{
				$("#content").html(result);
			}
    	});
	}
</script>
</html>