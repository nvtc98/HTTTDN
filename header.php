<div class="header" id="myHeader">
	<div class="toggle-nav" onClick="toggleLeftMenu()">&#9776;</div>
    <img src="IMG/sangshopLogo.png" style="width: 160px; height: 40px; float: left; margin-top: 5px; cursor:pointer;" onclick='window.location.href="index.php"' />
  <center>
        <form name="searchTool" action="search.php" onsubmit="return searchPageCheck()" >
            <input name="keyword" type="text" class="searchingBar" placeholder="Tìm kiếm game..." style="float: left; width: 35%; height: 30px; margin-left: 15%; margin-top: 8px"/>
            <input type="submit" value="" class="srchBttn" style="float:left;margin-top: 3px"> 
    </form>

  </center> 
        <?php include("customer-zone.php"); ?>

</div>