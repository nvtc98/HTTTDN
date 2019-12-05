		function checkpass()
		{
			"use strict";
			var ax1=document.getElementById("pass1").value;
			var ax2=document.getElementById("pass2").value;
			if(ax1!==ax2)
			{
				document.getElementById("warn").innerHTML="Passwords does not match";
				return false;
			}
			else { document.getElementById("warn").innerHTML=""; return true; }			
		}
		function openNav(dore,tabb,permit) 
		{
		 	if(!permit) permit=0;
    		document.getElementById("hinako").style.width = "100%";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() 
			{				
    			if (this.readyState === 4 && this.status === 200 ) 
				{									
      				document.getElementById("content").innerHTML = this.responseText;
						
    			}
  			};
			var s1="ayashameimaru.php?permit="+permit+"&dore=";
			s1 = s1.concat(dore,"&tab=", tabb);
			xhttp.open("GET", s1, true);
  			xhttp.send();
		}
		function openNav2(dore,dore2,tabb) { "use strict";
    	document.getElementById("hinako").style.width = "100%";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() 
			{				
    			if (this.readyState === 4 && this.status === 200 ) 
				{									
      				document.getElementById("content").innerHTML = this.responseText;
						
    			}
  			};
			var s1="ayashameimaru.php?dore=";
			s1 = s1.concat(dore,"&dore2=",dore2,"&tab=", tabb);
			xhttp.open("GET", s1, true);
  			xhttp.send();
		}
		function Enma(dore,tabb)
		{	"use strict";
		 if(confirm("delete ?"))
		{
			var xhttp = new XMLHttpRequest();
		 	var s1="enma.php?dore=";
			s1 = s1.concat(dore,"&tab=", tabb);
			xhttp.open("GET", s1, true);
  			xhttp.send();
			window.location.reload();
			window.location.reload();
		}		 
		}
		function openNav1(tab){ "use strict";
    	document.getElementById("hinako").style.width = "100%";
			var xhttp = new XMLHttpRequest();		 			
			xhttp.onreadystatechange = function() 
			{				
    			if (this.readyState === 4 && this.status === 200 ) 
				{									
      				document.getElementById("content").innerHTML = this.responseText;
						
    			}
  			};
			xhttp.open("GET", "eirin.php?tab="+tab, true);
  			xhttp.send();			
		}
		function closeNav() { "use strict";
    	document.getElementById("hinako").style.width = "0%";
		}
		
		
		
		
		
		
	function checkMail()
	{
		var Cmail = document.customera.Cmail.value;
		if (Cmail != "")
		{
			$.ajax({url:"addCustomera.php", type:"POST", dataType:"text", data:{ Cmail: Cmail, Option: "1" }, 
					success: function(result) 
						{
							if (result==0)
							{
								document.getElementById("Cmail").innerHTML="Email đã tồn tại!";
							}
							else
							{
								document.getElementById("Cmail").innerHTML="";
							}
						}
					});
		}
		if (document.getElementById("Cmail").innerHTML!="") return false;
		else return true;
	}
	function checkPhone()
	{
		var Cphone = document.customera.Cphone.value;
		if (Cphone != "")
		{
			$.ajax({url:"addCustomera.php", type:"POST", dataType:"text", data:{ Cphone: Cphone, Option: 2 }, 
					success: function(result) 
						{
							if (result==0)
							document.getElementById("Cphone").innerHTML="Số điện thoại đã tồn tại!";
							else
							{
								document.getElementById("Cphone").innerHTML="";
							}
						}
					});
		}
		if (document.getElementById("Cphone").innerHTML!="") return false;
		else return true;
	}
function openNav3(dore)
		{
			"use strict";
    		document.getElementById("hinako").style.width = "100%";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() 
			{				
    			if (this.readyState === 4 && this.status === 200 ) 
				{									
      				document.getElementById("content").innerHTML = this.responseText;
						
    			}
  			};
			var s1="emiya.php?dore=";
			s1 = s1.concat(dore);
			xhttp.open("GET", s1, true);
  			xhttp.send();
		}
	function ajaxCustomer()
	{
		var Cid = document.customera.Cid.value;
		var Cmail = document.customera.Cmail.value;
		var passwd = document.customera.Cpasswd.value;
		var Cpasswd = encode(passwd);
		var Balance = document.customera.Balance.value;
		var Cname = document.customera.Cname.value;
		var Cphone = document.customera.Cphone.value;
		var Cbirthdate = document.customera.Cbirthdate.value;
		var Cgender = document.customera.Cgender.value;// alert(Cgender);
		var UserTypeid = document.customera.UserTypeid.value;
		var TCharged = document.customera.TCharged.value;
		var banned = document.customera.banned.value; //alert(banned);
		var footnote = document.customera.footnote.value;
		if (checkMail()==false) return false;
		if (checkpass()==false) return false;
		if (checkPhone()==false) return false;
//	alert(Cbirthdate);
		$.ajax({url:"addCustomera.php", type:"POST", dataType:"text", data:{ Cid: Cid, Cmail: Cmail, Cpasswd: Cpasswd, Balance: Balance, Cname: Cname, Cphone: Cphone, Cbirthdate: Cbirthdate, Cgender: Cgender, UserTypeid: UserTypeid, TCharged: TCharged, banned: banned, footnote: footnote }, 
				success: function(result) 
					{
						if (result=="success") 
						{
							closeNav();
							alert("Thêm tài khoản thành công!");
						}
					}
				});
		return true;
	}
	function encode(s)
{
	var rand=Math.floor((Math.random()*100)+33)
	var result=String.fromCharCode(rand);
	var si;
	for(var i=0;i<s.length;i++)
	{
		si=s.charCodeAt(i);
		result+=String.fromCharCode(si+rand);
		if(si%2)
			result+=String.fromCharCode(rand+Math.floor((Math.random()*100)+1));
	}
	return result;
}
	function decode(s)
{
	var pivot=s.charCodeAt(0);
	var result="";
	var si;
	for(var i=1;i<s.length;i++)
	{
		si=s.charCodeAt(i)-pivot;
		result+=String.fromCharCode(si);
		if(si%2)
			i++;
	}
	return result;
}

	function CS(a)
	{
		$.ajax({url:"getCS.php", type:"POST", dataType:"text", data:{ Key: a }, 
				success: function(result) 
					{
						document.getElementById("hell").innerHTML=result;
					}
				});
	}
	function  getEmail(a)
	{
		var t = setTimeout(function() {getCSinfo(); totalMoney();}, 500);
		$.ajax({url:"getEmail.php", type:"POST", dataType:"text", data:{ Key: a }, 
				success: function(result) 
					{
						document.getElementById("Cmail").innerHTML=result;
					}
				});
	}
	function getCSinfo()
	{
		var a=document.getElementById("Cmail").value;
		$.ajax({url:"getCSinfo.php", type:"POST", dataType:"text", data:{ Key: a }, 
				success: function(result) 
					{
						var s=result.split('??');
						document.getElementById("Balance").value=s[1];
						document.getElementById("Cname").value=s[2];
						document.getElementById("Cphone").value=s[3];
						document.getElementById("Cbirthdate").value=s[4];
						document.getElementById("Cgender").value=s[5];
						document.getElementById("UserTypeid").value=s[6];
						document.getElementById("TCharged").value=s[7];
						document.getElementById("footnote").value=s[8];
					}
				});
		
	}
	function ajaxOrder()
	{
		var Oid = order.Oid.value;
		var Cid = document.getElementById("Cmail").value;
		var Odate = order.Odate.value;
		var DDate = order.DDate.value;
		var Total = order.Total.value;
		var Ostatus = order.Ostatus.value;
		var s="";
		var lenDetail=document.getElementsByClassName("STT").length;
		for (i=0;i<lenDetail;i++)
		{
			var Game=document.getElementsByClassName("Gname").item(i).value;
			var Amount=document.getElementsByClassName("Amount").item(i).value;
			var Price=document.getElementsByClassName("Price").item(i).value;
			s=s+(i+1)+"??"+Game+"??"+Amount+"??"+Price+"?&?";
		}
		$.ajax({url:"addOrder.php", type:"POST", dataType:"text", data:{ Oid: Oid, Cid: Cid, Odate: Odate, DDate: DDate, Total: Total, Ostatus: Ostatus, s: s }, 
				success: function(result) 
					{
						if (result=="success") 
						{
							closeNav();
							alert("Thêm đơn hàng thành công!");
						}
					}
				});
	}
	function Them()
	{
		var a = new Array();
		var b = new Array();
		var c = new Array();
		var len = document.getElementsByClassName("STT").length+1;
		var s = document.getElementById("Odetail").innerHTML;
		var temp=s.split('<tr id');
		for (i=0;i<len-1;i++)
		{
			a[i]=document.getElementsByClassName("Gname").item(i).value;
			b[i]=document.getElementsByClassName("Price").item(i).value;
			c[i]=document.getElementsByClassName("Amount").item(i).value;
		}
		document.getElementById("Odetail").innerHTML=temp[0]+'<tr><td align="center" class="STT">'+len+'</td><td align="center"><input type="text" name="Gname" class="Gname" id="LGname" list="hellz" style="width: 80px;" onFocus="LG(this.value,'+len+');"  onBlur="setPrice(this.value,'+len+');" required /></td><datalist id="hellz" class="hellz"></datalist></td><td align="center"><input type="number" min="0" name="Amount" class="Amount" style="width: 60px;" required /></td><td align="center"><input type="number" min="0" name="Price" class="Price" style="width: 80px;" required /></td></tr><tr id="them"><td colspan="5" align="center"><input type="button" value="Thêm" onClick="Them()"/></td></tr></table></div>'; 
		for (i=0;i<len-1;i++)
		{
			document.getElementsByClassName("Gname").item(i).value=a[i];
			document.getElementsByClassName("Price").item(i).value=b[i];
			document.getElementsByClassName("Amount").item(i).value=c[i];
		}
		totalMoney();
	}
	function LG(a,stt)
	{
		$.ajax({url:"getGames.php", type:"POST", dataType:"text", data:{ Key: a }, 
				success: function(result) 
					{
						document.getElementsByClassName("hellz").item(stt-1).innerHTML=result;
					}
				});
	}
	function setPrice(a,stt)
	{		
		$.ajax({url:"getPrice.php", type:"POST", dataType:"text", data:{ Key: a }, 
				success: function(result) 
					{
						document.getElementsByClassName("Price").item(stt-1).value=result;
					}
				});
		totalMoney();
	}
	function totalMoney()
	{
		var total=0;
		var len = document.getElementsByClassName("Amount").length;
		for (i=0;i<len;i++)
		{
			var amount=document.getElementsByClassName("Amount").item(i).value;
			if (amount=="") amount=0;
			var price=document.getElementsByClassName("Price").item(i).value;
			if (price=="") price=0;
			total=total+parseInt(amount)*parseInt(price);
		}
		document.order.Total.value=total;
	}