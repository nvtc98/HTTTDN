<?php

	include("sang-script.php");
	
	function concatenate($str)
	{
		$GLOBALS['query'] .= " and " . $str;
	}
	
	function looseMatch($s1, $s2)
	{
		$s1=strtolower($s1);
		$s2=strtolower($s2);
		$f = array();
		$p = array();
		for($i=0;$i<=strlen($s2);$i++)
		{
			$f[$i] = array();
			$p[$i] = array();
			$f[$i][0]=0;
			$p[$i][0]=0;
		}
		for($i=1;$i<=strlen($s1);$i++)
		{
			$f[0][$i]=0;
			$p[0][$i]=0;
		}
		for($i=0;$i<strlen($s2);$i++)
			for($j=0;$j<strlen($s1);$j++)
				if($s2[$i]==$s1[$j])
				{
					$f[$i+1][$j+1]=max(max($f[$i][$j+1],$f[$i+1][$j]),$f[$i][$j]+1);
					$p[$i+1][$j+1]=$p[$i][$j]+1;
				}
				else
				{
					$f[$i+1][$j+1]=max($f[$i][$j+1],$f[$i+1][$j]);
					$p[$i+1][$j+1]=0;
				}
		$i=strlen($s2);
		$j=strlen($s1);
		$d=1;
		while($f[$i][$j]>0)
		{
			if($f[$i][$j]==$f[$i][$j-1])
				$j--;
			else if($f[$i][$j]==$f[$i-1][$j])
				$i--;
			else
			{
				if($p[$i-1][$j-1]>0) $d++;
				$i--;
				$j--;
			}
		}
		if($d/strlen($s2)>=0.6)
			return true;
		return false;
	}
	
	
	
	
	
	$name=$_GET['name'];
	$sortby=$_GET['sortby'];
	$searchkind=$_GET['searchkind'];
	$genre=$_GET['genre'];
	$esrb=$_GET['esrb'];
	$ncc=$_GET['ncc'];
	$minprice=$_GET['minprice'];
	$maxprice=$_GET['maxprice'];
	$ratingscore=$_GET['ratingscore'];
	$curPage = $_GET['curPage'];
	$itemsPerPage = $_GET['itemsPerPage'];
	$start = ($curPage-1) * $itemsPerPage;
	
	$conn=mysqli_connect("localhost", "root", "", "sshop") or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	
	
	if($searchkind==1)
		$query="select * from games where Gname like '%$name%' and Rating >= $ratingscore";
	else $query="select * from games where Rating >= $ratingscore";
	if($genre) concatenate("GGid = '$genre'");
	if($esrb) concatenate("ESRB = '$esrb'");
	if($ncc) concatenate("Nid = '$ncc'");
	if($minprice) concatenate("Price >= $minprice");
	if($maxprice) concatenate("Price <= $maxprice");
	switch($sortby)
	{
		case 1: { $query.=" order by Gname ASC"; break; }
		case 2: { $query.=" order by Price DESC"; break; }
		case 3: { $query.=" order by Price ASC"; break; }
		case 4: { $query.=" order by Rating DESC"; break; }
		case 5: { $query.=" order by Rating	ASC"; break; }
	}
	
	if($searchkind==1 || $name=="")
	{
		$queryCount=substr_replace($query, "count(*)", 7, 1);
		$result = mysqli_query($conn, $queryCount);
		$count = mysqli_fetch_array($result);
		if($count[0])
		{
			$result = mysqli_query($conn, $query." limit $start, $itemsPerPage");
			while($row=mysqli_fetch_array($result))
			{
				show($row['Gid'], $row['Gname'], $row['gimage'], $row['Price']);
			}
			echo "&count=" . $count[0];
		}
		else echo "Không có sản phẩm&count=" . $count[0];
	}
	else
	{
		$result = mysqli_query($conn, $query);
		$count=0;
		while($row=mysqli_fetch_array($result))
		{
			if(looseMatch($row['Gname'],$name))
			{
				if($count>=$start && $count<$start+$itemsPerPage) show($row['Gid'], $row['Gname'], $row['gimage'], $row['Price']);
				$count++;
			}
		}
		if(!$count) echo "Không có sản phẩm";
		echo "&count=" . $count;
	}
	mysqli_close($conn);
?>