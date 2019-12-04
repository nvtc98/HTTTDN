<style>
	.table 
	{ 
		display:table;
		padding: 10px;
		right: 0;
		left: 0;
		margin: auto;
	}
	.tr 
	{ 
		display: table-row;
		margin:auto;
	}
	.td 
	{ 
		display: table-cell;
		padding: 5px;
		font-weight:bold;
		border-color: black;
		border: 3px;
		font-size: 15px;
	}
	#searchFilter
	{
		display: none;
		border: 1px solid #fd9a00;
		padding:5px;
		background-color: #fd9a00;
		color: black;
		font-family:Arial;
		font-size: 16px;
		position: fixed;
		width: 100%;
		height:120px;
		top: 50px;
		z-index: 1;
	}
	
	#searchFilter select
	{
		border: 1px solid #333;
		padding: 2px;
	}
	
	#searchFilter input[type=text]
	{
		border: 1px solid #333;
		padding: 2px;
	}

/* range type style */
	input[type=range] {
	  -webkit-appearance: none;
	  margin: 18px 0;
	  width: 100%;
	}
	input[type=range]:focus {
	  outline: none;
	}
	input[type=range]::-webkit-slider-runnable-track {
	  width: 100%;
	  height: 8.4px;
	  cursor: pointer;
	  animate: 0.2s;
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	  background: #333;
	  border-radius: 1.3px;
	  border: 0.2px solid #010101;
	}
	input[type=range]::-webkit-slider-thumb {
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	  border: 1px solid #000000;
	  height: 36px;
	  width: 16px;
	  border-radius: 3px;
	  background: #ffffff;
	  cursor: pointer;
	  -webkit-appearance: none;
	  margin-top: -14px;
	}
	input[type=range]:focus::-webkit-slider-runnable-track {
	  background: #333;
	}
	input[type=range]::-moz-range-track {
	  width: 100%;
	  height: 8.4px;
	  cursor: pointer;
	  animate: 0.2s;
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	  background: #666;
	  border-radius: 1.3px;
	  border: 0.2px solid #010101;
	}
	input[type=range]::-moz-range-thumb {
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	  border: 1px solid #000000;
	  height: 36px;
	  width: 16px;
	  border-radius: 3px;
	  background: #000;
	  cursor: pointer;
	}
	input[type=range]::-ms-track {
	  width: 100%;
	  height: 8.4px;
	  cursor: pointer;
	  animate: 0.2s;
	  background: transparent;
	  border-color: transparent;
	  border-width: 16px 0;
	  color: transparent;
	}
	input[type=range]::-ms-fill-lower {
	  background: #333;
	  border: 0.2px solid #010101;
	  border-radius: 2.6px;
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	}
	input[type=range]::-ms-fill-upper {
	  background: #000;
	  border: 0.2px solid #010101;
	  border-radius: 2.6px;
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	}
	input[type=range]::-ms-thumb {
	  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
	  border: 1px solid #000000;
	  height: 36px;
	  width: 16px;
	  border-radius: 3px;
	  background: #ffffff;
	  cursor: pointer;
	}
	input[type=range]:focus::-ms-fill-lower {
	  background: black;
	}
	input[type=range]:focus::-ms-fill-upper {
	  background: #367ebd;
	}
</style>
<script type="text/javascript" src="JS/showing-paging.js"></script>

<div style="height:50px;" id="dummyHeader"></div>
<div id="searchFilter">
    <form name="searchFilterForm" class="table">
        <div class="tr">
            <div class="td">Sắp xếp theo</div>
            <div class="td">Kiểu tìm kiếm</div>
            <div class="td">Thể loại</div>
            <div class="td">Độ tuổi (ESRB)</div>
            <div class="td">Nhà cung cấp</div>
            <div class="td">Khoảng giá</div>
            <div class="td">Điểm đánh giá</div>
        </div>
        <div class="tr">
            <div class="td">
                <select name="sortby" onchange="filter()">
                    <option selected="selected">---</option>
                    <option>Bảng chữ cái</option>
                    <option>Giá ↘</option>
                    <option>Giá ↗</option>
                    <option>Điểm đánh giá ↘</option>
                    <option>Điểm đánh giá ↗</option>
                </select>
            </div>
            <div class="td">
                <input type="radio" name="searchkind" checked="checked" onclick="filter()" />Chính xác
                <input type="radio" name="searchkind" onclick="filter()" />Thoáng
            </div>
            <div class="td">
                <select name="genre" onchange="filter()">
                    <option selected="selected" value="0">---</option>
                    <?php
					$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
                        //$conn=mysqli_connect("localhost", "root", "", "sshop");
                        $query=mysqli_query($conn, "select * from ggenre");
                        while($row=mysqli_fetch_array($query))
                            echo '<option value="'.$row['GGid'].'">'.$row['GGname'].'</option>';
                    ?>
                </select>
            </div>	
            <div class="td">        	
                <select name="ESRB" onchange="filter()">
                    <option selected="selected" value="0">---</option>
                    <option value="eC">eC (early Childhood)</option>
                    <option value="E">E (Everyone)</option>
                    <option value="E10+">E10+ (Everyone 10+)</option>
                    <option value="T">T (Teen)</option>
                    <option value="M">M (Mature)</option>
                    <option value="Ao">Ao (Adults only)</option>
                    <option value="RP">RP (Rating Pending)</option>
                </select>
            </div>
            <div class="td">
                <select name="ncc" onchange="filter()">
                    <option selected="selected" value="0">---</option>
                    <?php
                        $query=mysqli_query($conn, "select * from ncc");
                        while($row=mysqli_fetch_array($query))
                            echo '<option value="'.$row['Nid'].'">'.$row['NBmail'].'</option>';
                    ?>
                </select>
            </div>
            <div class="td">
                <input type="text" name="minprice" placeholder="Tối thiểu" width="50%" size="5" onchange="filter()" />
                <input type="text" name="maxprice" placeholder="Tối đa" width="50%" size="5" onchange="filter()" />
            </div>
            <div class="td">
                <input type="range" name="ratingscore" min="5" max="9.5" step="0.5" value="5" onchange="filter()" />
                <div>Từ <span id="ratingscoreRangeValue">5</span> trở lên</div>
            </div>
        </div>
    </form>
</div>
<center style="position:fixed; margin-left:90vw; z-index: 1">
	<div id="filterSwitchLine" style="border-left:2px #fd9a00 solid; height:50px; width:0;"></div>
	<div id="filterSwitch" style="height:50px; width:50px; background:url(IMG/icon/filter.png); background-size:cover; cursor:pointer" onclick="toggleFilter()"></div>
</center>

<script type="text/javascript">
	document.searchFilterForm.ratingscore.oninput = function() {$("#ratingscoreRangeValue").html(this.value);};
	
	$(function()
	{
		document.searchTool.keyword.value=window.location.href.split("keyword=")[1].replace('+', ' ');
		filter();
	});
	
	var showFilter=false;
	function toggleFilter()
	{
		if(showFilter)
		{
			$("#searchFilter").slideToggle("slow");
			//$("#filterSwitchLine").animate({marginTop: "0px"},"slow");
			$("#dummyHeader").animate({height:"50px"},"slow");
			showFilter=false;
		}
		else
		{
			$("#searchFilter").slideToggle("slow");
			//$("#filterSwitchLine").animate({marginTop: "130px"},"slow");
			$("#dummyHeader").animate({height:"180px"},"slow");
			showFilter=true;
		}
	}
	
	function priceCheck()
	{
		var minprice=document.searchFilterForm.minprice;
		var maxprice=document.searchFilterForm.maxprice;
		var pattern = /\D/;
		if(pattern.test(minprice.value)){alert("Giá tiền không hợp lệ."); minprice.value=""; return false;} 
		if(pattern.test(maxprice.value)){alert("Giá tiền không hợp lệ."); maxprice.value=""; return false;} 
		return true;
	}
	
	function filter()
	{
		if(priceCheck())
		{
			curPage=1;
			var name=document.searchTool.keyword.value;
			if(name!=window.location.href.split("keyword=")[1].replace('+', ' '))
				window.history.pushState('string', '', 'search.php?keyword=' + name);
			var data=
				{ 
					name: name,
					sortby: document.searchFilterForm.sortby.selectedIndex,
					searchkind: document.searchFilterForm.searchkind[0].checked?"1":"2",
					genre: document.searchFilterForm.genre.value,
					esrb: document.searchFilterForm.ESRB.value,
					ncc: document.searchFilterForm.ncc.value,
					minprice: document.searchFilterForm.minprice.value,
					maxprice: document.searchFilterForm.maxprice.value,
					ratingscore: document.searchFilterForm.ratingscore.value,
				};
			show("ajax/search-filter_ajax.php", data);
			/*$.ajax(
			{
				url:"ajax/search-filter_ajax.php", type:"GET", dataType:"text", data:
				{ 
					name: name,
					sortby: document.searchFilterForm.sortby.selectedIndex,
					searchkind: document.searchFilterForm.searchkind[0].checked?"1":"2",
					genre: document.searchFilterForm.genre.value,
					esrb: document.searchFilterForm.ESRB.value,
					ncc: document.searchFilterForm.ncc.value,
					minprice: document.searchFilterForm.minprice.value,
					maxprice: document.searchFilterForm.maxprice.value,
					ratingscore: document.searchFilterForm.ratingscore.value,
					curPage: curPage,
					itemsPerPage: itemsPerPage,
				}, success : getData,
			});*/
		}
	}
</script>