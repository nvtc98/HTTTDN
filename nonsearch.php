
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
	
	if(isset($_GET['id']))
	$tID = $_GET['id'];
	if(isset($_GET['col']))
	$colu= $_GET['col'];
	if(isset($_GET['action']))
	$sortie= $_GET['action'];
	$_SESSION['tab']=$tID;
	$conn->query("set names utf8");
	if(!isset($_GET['action']) && !isset($_GET['IDs']))
	{ 
		if(!isset($_GET['id'])&& !isset($_GET['col'])) 		
			header('Location: adcpg.php?id=games&col=Gid&action=DESC&ac=1&page=0');
		else header('Location: adcpg.php?id='.$tID.'&col='.$colu.'&action=DESC&ac=1&page=0');
		echo("<meta http-equiv='refresh' content='2'>");		
	}
	if($_GET['ac']!=0)
	if($sortie=="DESC") $sortie="ASC";
	else $sortie="DESC";
	echo "<div class='satan'>
			<table class='wrath'>
				";	
	if($tID == "games" && !isset($_POST['filth']))
	{		
		$lim=20;
		if($result = $conn->query("select count(Gid) as total from $tID"))
		{			
			$temp = mysqli_fetch_assoc($result);
			$totalpage= ceil($temp['total']/$lim);			
		}
		$vcurpage= $_GET['page'];
		if($colu!="")
		$quer="select * from games order by $colu $sortie limit $vcurpage,$lim";		
		else
		$quer="select * from games order by gid $sortie limit $vcurpage,$lim";		
		$result=$conn->query($quer);	
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=gid&action='.$sortie.'&ac=1&page=0">Game ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=gname&action='.$sortie.'&ac=1&page=0">Name</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=ggid&action='.$sortie.'&ac=1&page=0">Genre</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=nid&action='.$sortie.'&ac=1&page=0">Provider</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=esrb&action='.$sortie.'&ac=1&page=0">ESRB</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=price&action='.$sortie.'&ac=1&page=0">Price</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=rating&action='.$sortie.'&ac=1&page=0">Rating</a></div></td>
		<td>Functions</td></tr>';
		while($row=mysqli_fetch_array($result))
		{						
			echo"<tr><td>".$row['Gid']."</td>";
			echo"<td>".$row['Gname']."</td>";
			$quer2="select * from ggenre where ggid='".$row['GGid']."'";			
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 
				
				echo"<td>".$meh['GGname']."</td>";
				 }
			else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			
			
			$quer2="select * from ncc where Nid='".$row['Nid']."'";			
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 
				
				echo"<td>".$meh['NBmail']."</td>";	 }
			else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			
			
			echo"<td>".$row['ESRB']."</td>";
			echo"<td>".$row['Price']."</td>";
			echo"<td>".$row['Rating']."</td>";			
			echo '<td> <div class="butts">';
			echo "<a href='#' onclick='openNav(".$row['Gid'].",&#039$tID&#039)'> edit </a> ";
			echo '<a href="#" onclick="Enma('.$row['Gid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';		
			echo "</tr> ";
		}
		echo "</table></div>";
		echo '<div style="clear: both;">';	
		for($i = 0; $i < $totalpage; $i++)
		{
			echo '<a href="adcpg.php?id='.$_GET['id'].'&col='.$_GET['col'].'&action='.$sortie.'&ac=0&page='.($i*$lim).'">'.($i+1).'</a> |';
		}
		echo '</div>';
	}
	if($tID == "Customera" && !isset($_POST['filth']))
	{		
		if($colu!="")
		$quer="select * from customera order by $colu $sortie";		
		else
		$quer="select * from customera order by cid $sortie";		
		if($result=$conn->query($quer)) { }
		else echo mysqli_error($conn);
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cid&action='.$sortie.'&ac=1&page=0">Customer Account ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cmail&action='.$sortie.'&ac=1&page=0">Account Email</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cpasswd&action='.$sortie.'&ac=1&page=0">Password</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=balance&action='.$sortie.'&ac=1&page=0">Balance</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cname&action='.$sortie.'&ac=1&page=0">Customer Name</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cphone&action='.$sortie.'&ac=1&page=0">Customer Phone</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cbirthdate&action='.$sortie.'&ac=1&page=0">Birthday</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cgender&action='.$sortie.'&ac=1&page=0">Gender</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=usertypeid&action='.$sortie.'&ac=1&page=0">Customer Type</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=tcharged&action='.$sortie.'&ac=1&page=0">Total Charged</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=banned&action='.$sortie.'&ac=1&page=0">Banned</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=footnote&action='.$sortie.'&ac=1&page=0">Note</a></div></td>';
//		if($permit<1)
		echo'<td>Functions</td>';
		echo '</tr>';		
		while($row=mysqli_fetch_array($result))
		{						
			echo"<tr><td>".$row['Cid']."</td>";
			echo"<td>".$row['Cmail']."</td>";
			echo"<td>".$row['Cpasswd']."</td>";
			echo"<td>".$row['Balance']."</td>";
			echo"<td>".$row['Cname']."</td>";
			echo"<td>".$row['Cphone']."</td>";
			echo"<td>".$row['Cbirthdate']."</td>";
			echo"<td>".$row['Cgender']."</td>";
			$quer2="select * from usertype where usertypeid='".$row['UserTypeid']."'";		
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 				
				echo"<td>".$meh['UserTypename']."</td>";
				 }
			else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			echo"<td>".$row['TCharged']."</td>";
			if($row['banned']=='1')
			echo"<td>True</td>";
			else echo"<td>False</td>";
			echo"<td>".$row['footnote']."</td>";		
//			if($permit<1)
			{
				echo '<td> <div class="butts">';
				echo "<a href='#' onclick='openNav(".$row['Cid'].",&#039$tID&#039, $permit)'> edit </a> ";
				if($permit<1)
					echo '<a href="#" onclick="Enma('.$row['Cid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';		
			}
			echo "</tr> ";
		}
		echo "</table></div>";
	}
	if($tID == "orders" && !isset($_POST['filth']))
	{
		
		if($colu!="")
		$quer="select * from orders,odetail where orders.Oid=odetail.Oid order by orders.$colu $sortie";
		else
		$quer="select * from orders,odetail where orders.Oid=odetail.Oid order by orders.Oid $sortie";	
		if($result=$conn->query($quer)) { }
		else {
			echo mysqli_error($conn);
			echo $quer;
			}
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Oid&action='.$sortie.'&ac=1&page=0">Orders ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cid&action='.$sortie.'&ac=1&page=0">Account Email</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Odate&action='.$sortie.'&ac=1&page=0">Ordered Day</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=DDate&action='.$sortie.'&ac=1&page=0">Delivered Day</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=total&action='.$sortie.'&ac=1&page=0">Total</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Ostatus&action='.$sortie.'&ac=1&page=0">Orders Status</a></div></td>		
		<td>Functions</td></tr>';
		$t=""; $t2="";
		while($row=mysqli_fetch_array($result))
		{						
			$t.="<tr><td>".$row['Oid']."</td>";
			$quer2="select * from customera where Cid='".$row['Cid']."'";	
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 				
				$t.="<td>".$meh['Cmail']."</td>";
				 }
			else { echo mysqli_error($conn); $t.="<td>nothing</td>";}
			$t.="<td>".$row['Odate']."</td>";
			$t.="<td>".$row['DDate']."</td>";
			$t.="<td>".$row['Total']."đ</td>";
			$t.="<td>".$row['Ostatus']."</td>";								
			$t.= '<td> <div class="butts">';
			$t.="<a href='#' onclick='openNav3(".$row['Oid'].",&#039$tID&#039)'> info </a> ";
			if($permit<1)
			{
				$t.= "<a href='#' onclick='openNav(".$row['Oid'].",&#039$tID&#039)'> edit </a> ";
				$t.= '<a href="#" onclick="Enma('.$row['Oid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';
			}		
			$t.= "</tr> ";
			if($t!=$t2)
			{
				echo $t;
				$t2=$t;
			}
			$t="";
		}
		echo "</table></div>";
	}
	//Code của Huy von Einzbern nên có thể sẽ sai <(")
	if ( $tID == "games" && isset($_POST['filth'] ))
	{
		$quer = "SELECT * FROM games WHERE Gid LIKE '%".$_POST['filth']."%' OR Gname LIKE '%".$_POST['filth']."%'";
		$result=$conn->query($quer);
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=gid&action='.$sortie.'&ac=1&page=0">Game ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=gname&action='.$sortie.'&ac=1&page=0">Name</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=ggid&action='.$sortie.'&ac=1&page=0">Genre</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=nid&action='.$sortie.'&ac=1&page=0">Provider</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=esrb&action='.$sortie.'&ac=1&page=0">ESRB</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=price&action='.$sortie.'&ac=1&page=0">Price</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=rating&action='.$sortie.'&ac=1&page=0">Rating</a></div></td>
		<td>Functions</td></tr>';
		while($row = mysqli_fetch_array($result))
		{
			echo"<tr><td>".$row['Gid']."</td>";
			echo"<td>".$row['Gname']."</td>";
			$quer2="select * from ggenre where ggid='".$row['GGid']."'";			
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) 
				echo"<td>".$meh['GGname']."</td>";
					else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			$quer2="select * from ncc where Nid='".$row['Nid']."'";			
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) 
				echo"<td>".$meh['NBmail']."</td>";
					else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			echo"<td>".$row['ESRB']."</td>";
			echo"<td>".$row['Price']."</td>";
			echo"<td>".$row['Rating']."</td>";
			echo '<td> <div class="butts">';
			echo "<a href='#' onclick='openNav(".$row['Gid'].",&#039$tID&#039)'> edit </a> ";
			echo '<a href="#" onclick="Enma('.$row['Gid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';		
			echo "</tr> ";
		}
	}
	if ( $tID == "Customera" && isset($_POST['filth'] ))
	{
		$quer = "SELECT * FROM CUSTOMERA WHERE Cid LIKE '%".$_POST['filth']."%' OR Cname LIKE '%".$_POST['filth']."%'";
		$result=$conn->query($quer);
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cid&action='.$sortie.'&ac=1&page=0">Customer Account ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cmail&action='.$sortie.'&ac=1&page=0">Account Email</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cpasswd&action='.$sortie.'&ac=1&page=0">Password</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=balance&action='.$sortie.'&ac=1&page=0">Balance</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cname&action='.$sortie.'&ac=1&page=0">Customer Name</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cphone&action='.$sortie.'&ac=1&page=0">Customer Phone</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cbirthdate&action='.$sortie.'&ac=1&page=0">Birthday</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=cgender&action='.$sortie.'&ac=1&page=0">Gender</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=usertypeid&action='.$sortie.'&ac=1&page=0">Customer Type</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=tcharged&action='.$sortie.'&ac=1&page=0">Total Charged</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=banned&action='.$sortie.'&ac=1&page=0">Banned</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=footnote&action='.$sortie.'&ac=1&page=0">Note</a></div></td>';
//		if($permit<1)
		echo'<td>Functions</td>';
		echo '</tr>';
		while($row=mysqli_fetch_array($result))
		{						
			echo"<tr><td>".$row['Cid']."</td>";
			echo"<td>".$row['Cmail']."</td>";
			echo"<td>".$row['Cpasswd']."</td>";
			echo"<td>".$row['Balance']."</td>";
			echo"<td>".$row['Cname']."</td>";
			echo"<td>".$row['Cphone']."</td>";
			echo"<td>".$row['Cbirthdate']."</td>";
			echo"<td>".$row['Cgender']."</td>";
			$quer2="select * from usertype where usertypeid='".$row['UserTypeid']."'";		
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 				
				echo"<td>".$meh['UserTypename']."</td>";
				 }
			else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			echo"<td>".$row['TCharged']."</td>";
			if($row['banned']=='1')
			echo"<td>True</td>";
			else echo"<td>False</td>";
			echo"<td>".$row['footnote']."</td>";	
//			if($permit<1)
			{
				echo '<td> <div class="butts">';
				echo "<a href='#' onclick='openNav(".$row['Cid'].",&#039$tID&#039)'> edit </a> ";
				echo '<a href="#" onclick="Enma('.$row['Cid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';		
			}
			echo "</tr> ";
		}
	}
	if ( $tID == "orders" && isset($_POST['filth'] ))
	{
		$quer = "SELECT * FROM ORDERS WHERE OSTATUS = '".$_POST['filth']."' OR ODATE LIKE '%".$_POST['filth']."%' OR DDATE LIKE '%".$_POST['filth']."%'";
		$result=$conn->query($quer);
		echo '<tr><td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Oid&action='.$sortie.'&ac=1&page=0">Orders ID</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Cid&action='.$sortie.'&ac=1&page=0">Account Email</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Odate&action='.$sortie.'&ac=1&page=0">Ordered Day</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=DDate&action='.$sortie.'&ac=1&page=0">Delivered Day</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=total&action='.$sortie.'&ac=1&page=0">Total</a></div></td>
		<td><div class="butts2"><a href="adcpg.php?id='.$tID.'&col=Ostatus&action='.$sortie.'&ac=1&page=0">Orders Status</a></div></td>		
		<td>Functions</td></tr>';
		while($row=mysqli_fetch_array($result))
		{						
			echo"<tr><td>".$row['Oid']."</td>";
			$quer2="select * from customera where Cid='".$row['Cid']."'";	
			$result2=$conn->query($quer2);
			$meh=mysqli_fetch_array($result2);
			if($result2) { 				
				echo"<td>".$meh['Cmail']."</td>";
				 }
			else { echo mysqli_error($conn); echo"<td>nothing</td>";}
			echo"<td>".$row['Odate']."</td>";
			echo"<td>".$row['DDate']."</td>";
			echo"<td>".$row['Total']."đ</td>";
			echo"<td>".$row['Ostatus']."</td>";								
			echo '<td> <div class="butts">';
			echo "<a href='#' onclick='openNav3(".$row['Oid'].",&#039$tID&#039)'> info </a> ";
			echo "<a href='#' onclick='openNav2(".$row['Oid'].",&#039$tID&#039)'> edit </a> ";
			echo '<a href="#" onclick="Enma('.$row['Oid'].',&#039'.$tID.'&#039)"> del </a></div> </td>';		
			echo "</tr> ";
		}
		echo "</table></div>";
	}
	include('Edpg.php');
	?>
<body>
</body>
</html>