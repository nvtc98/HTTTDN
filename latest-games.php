<style>
	.wrapper
	{
		height:300px;
		width:90%;
		padding: 50px 0 100px 0;
		margin:auto;
	}
	.element
	{
		background-position:center;
		width:5%;
		height:100%;
		background-size: cover;
		float:left;
		background-color:#555;
		background-blend-mode: multiply;
		-moz-background-blend-mode: multiply;
		-webkit-background-blend-mode: multiply;
		-o-background-blend-mode: multiply;
		transition: 0.5s ease;
	}
	.elementActive
	{
		background-color: rgba(255,255,255,0);
		width:75%;
		transition: 0.5s ease;
	}
	/*.element:hover .costnDetailWrapperActive
	{
		display: block;
		transition: 0.5s ease;
	}*/
	.titleSlide
	{
		background-color: #fd9a00;
		font-family:Arial;
		color: black;
		text-transform: uppercase;
		font-size:22px;
		width: 98.5%;
		padding: 10px;
		text-align:center;
		margin:auto;
		float: left;
	}
	.costnDetailWrapperActive
	{
		display: none;
		transition: 0.5s ease;
		right: 0;
		margin-top: 220px;
		margin-right: 30px;
		border: solid;
		border-radius:5px;
		border-color: white;
		float:right;
		width: auto;	
		height:auto;
	}
	.cost
	{
		background-color: #fd9a00;
		color: black;
		font-family:Arial;
		font-size: 20px;
		padding: 10px;
		float:left;
	}
	.detail
	{
		background-color: black;
		color: white;
		font-family:Arial;
		font-size: 20px;
		padding: 10px;
		cursor: pointer;
		float:left;
	}
</style>


<div class="wrapper">
	<h2 class="titleSlide">Sản phẩm rác nhất</h2>
    <?php
		function price($price)
		{
			$price = (string)$price;
			$dotPosition = strlen($price)-3; 
			while($dotPosition>0)
			{
				$price = substr_replace($price, '.', $dotPosition, 0); 
				$dotPosition-=3;
			}
			return $price;
		}
		
		function show($id , $path, $d, $cost)
		{
			$path=explode("??", $path);
			$path=str_replace("\\","/",$path[0]);
			$path=str_replace(" ","%20",$path);
			echo
			'<div id="element'.$d.'" class="element'.(($d==1)?" elementActive":"").'" style="background-image:url('.$path.')">
    			<div id="price'.$d.'" class="costnDetailWrapperActive"'.(($d==1)?' style="display: block"':"").'>
        			<div class="detail" onclick="window.location='."'chitietsp.php?gid=$id'".'"> Chi tiết </div>
            		<div class="cost"> '.price($cost).'đ </div>
        		</div>
    		</div>';
		}
		$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
		//$conn = mysqli_connect("localhost", "root", "", "sshop");
		$query = "select * from games order by Gid desc limit 6";
		$result = mysqli_query($conn, $query);
		$d=1;
		while ($row = mysqli_fetch_array($result))
		{
			show($row['Gid'], $row['gimage'], $d, $row['Price']);
			$d++;
		}
	?>
	<!--<div id="element1" class="element elementActive" style="background-image:url(Games/Sport/VR%20RHYTHM%20ACTION%20SEIYA/VR%20RHYTHM%20ACTION%20SEIYA_Banner.jpg)">
    	<div id="price1" class="costnDetailWrapperActive" style="display: block">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 610.000đ </div>
        </div>
    </div>
	<div id="element2" class="element" style="background-image:url(IMG/lastestGames/prey.png)">
    	<div id="price2" class="costnDetailWrapperActive">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 615.000đ </div>
        </div>
    </div>
	<div id="element3" class="element" style="background-image:url(IMG/lastestGames/sniperGhostWarrior3.png)">
    	<div id="price3" class="costnDetailWrapperActive">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 620.000đ </div>
        </div>    
    </div>
	<div id="element4" class="element" style="background-image:url(IMG/lastestGames/outLast2.png)">
    	<div id="price4" class="costnDetailWrapperActive">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 630.000đ </div>
        </div>
    </div>
	<div id="element5" class="element" style="background-image:url(IMG/lastestGames/teamfortress2.png)">
    	<div id="price5" class="costnDetailWrapperActive">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 640.000đ </div>
        </div>    
    </div>
	<div id="element6" class="element" style="background-image:url(IMG/lastestGames/ghostTheory.png)">
    	<div id="price6" class="costnDetailWrapperActive">
        	<div class="detail"> Chi tiết </div>
            <div class="cost"> 650.000đ </div>
        </div>
    </div>-->
</div>
<div style="clear:both"></div> <!--this is just a dummy div to clear float style-->

<script>
	var elementAt=1;
	$(".element").hover(function()
	{
		if(this.id!="element"+elementAt)
		{
			$("#price"+elementAt).stop( true, true ).slideDown();
			$("#price"+elementAt).css("display","none");
			document.getElementById("element"+elementAt).classList.remove("elementActive");
			this.classList.add("elementActive");
			elementAt=this.id[this.id.length-1];
			setTimeout(function() {$("#price"+elementAt).slideDown();}, 250);
		}
	}
	);
</script>