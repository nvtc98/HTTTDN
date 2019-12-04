// JavaScript Document
function quantity(position, option, price, sale, id)
{		
	var count=document.getElementsByClassName("form-control")[position].value;
	if (option=="0") count--;
	else count++;
	if (count<1) count=1;
	if (count>3) count=3;
	document.getElementsByClassName("form-control")[position].value=count;
	//renew cookie
	var now = new Date();
	now.setTime(now.getTime()+60*60*1000);
	time=now.toGMTString();
	document.cookie="product"+id+"="+count+";expires="+time+";path=/";
	
	
	var price2 = price*count;
	var price1 = price2-price2*sale/100;
	var s="&nbsp;₫";
	document.getElementsByClassName("price2")[position].innerHTML=price2+s;
	document.getElementsByClassName("price")[position].innerHTML=price1+s;
	Sum();
}
function Xoa(id, position)
{
	var now = new Date();
	now.setTime(now.getTime()-2*60*60*1000);
	time=now.toGMTString();
	document.cookie="product"+id+"=true;expires="+time+";path=/";
	var s="";
	var content=document.getElementsByClassName("B_Product_item");
	var count=content.length;
	for (i=0;i<count;i++)
	{
		if (i!=position) s+='<div class="B_Product_item">'+content[i].innerHTML+'</div>';
	}
	document.getElementsByClassName("B_Product_area")[0].innerHTML=s;
	Sum();
}
function Sum()
{
	var Item = document.getElementsByClassName("price");
	var Money=0;
	for (i=0;i<Item.length;i++)
	{
		var M_Item=Item[i].innerHTML.split('&nbsp;₫');
		Money+=parseFloat(M_Item[0]);
	}
	//alert(Money);
	document.getElementById("sum1").innerHTML=Money+"&nbsp;₫";
	document.getElementById("sum2").innerHTML=Money+"&nbsp;₫";
	var t = setTimeout(function() {Sum();}, 500);
}
function Confirmed()
{
	//Money
	var cast=document.getElementById("sum2").innerHTML;
	var total_cast=cast.split('&nbsp;₫');
	$money=total_cast[0];
	//Info from form
	$user=document.getElementById("GetName").value;
	$email=document.getElementById("GetMail").value;
	$address=document.getElementById("GetAddress").value;

	document.getElementsByClassName("Info-giaohang")[0].style.display="block";
		$.ajax({url:"ajax/giohang_ajax.php", type:"POST", dataType:"text", data:{ money: $money, user: $user, email: $email,  address: $address }, 
		success: function(result) 
			{
					//alert("AAA");
					if (result==0) {document.getElementById("Error").innerHTML="Số dư trong tài khoản không đủ! Xin vui lòng nạp thêm tiền vào tài khoản để tiếp tục mua hàng!";}
					else
					{
					$(".Basket").html(result);
					}
			}
    	});

}
function Confirm()
{
	var r=confirm("Xác nhận mua hàng!");
	if (r == true)
	{
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		flag=0;
		for(var i = 0; i <ca.length; i++)
		{
			var c = ca[i];
			while (c.charAt(0) == ' ') { c = c.substring(1); }
			if (c.indexOf('product') == 0) {flag=1; break;}
		}
		if (flag==0) alert("Giỏ hàng trống!");
		else document.getElementsByClassName("Info-giaohang")[0].style.display="block";
	}
}
function CheckInfo()
{
	var err=document.getElementById("Error");
	//Check name
	var name=document.getElementById("GetName");
	if (name.value=="") {err.innerHTML="Vui lòng điền tên của bạn!"; name.focus(); return false;}
	var patName=/^[a-zA-Z][^0-9]+/;
	if (!patName.test(name.value)) {err.innerHTML="Tên đã nhập không hợp lệ!"; name.focus(); return false;}
	
	//Check mail
	var mail=document.getElementById("GetMail");
	if (mail.value=="") {err.innerHTML="Vui lòng điền địa chỉ email của bạn!"; mail.focus(); return false;}
	var patMail=/[a-z.0-9_-]+@[a-z]+.[a-z]{3,4}.*/;
	if (!patMail.test(mail.value)) {err.innerHTML="Email bạn đã nhập không hợp lệ!"; mail.focus(); return false;}
	
	//Check address
	var address=document.getElementById("GetAddress");
	if (address.value=="") {err.innerHTML="Vui lòng điền địa chỉ nhận hàng!"; address.focus(); return false;}
	Confirmed();
}
function closeForm(ths, e) { if(e.target==ths) $('.Info-giaohang').fadeOut(); }
function NapTien()
{
	$.ajax({url:"ajax/naptien_ajax.php", type:"POST", dataType:"text", data:{ seri: document.getElementById("Seri").value, code: document.getElementById("Code").value }, 
		success: function(result) 
			{
					//alert("AAA");
					if (result==-1) {document.getElementById("Error").innerHTML="Số Seri hoặc mã thẻ không hợp lệ!";}
					else
					{
						if (result==-2) {document.getElementById("Error").innerHTML="Số Seri hoặc mã thẻ không chính xác!";}
						else
						{
							if (result==-3) {document.getElementById("Error").innerHTML="Thẻ đã được sử dụng!";}
							else
							{
								document.getElementById("Error").innerHTML="";
								alert("Nạp tiền thành công! Số dư trong tài khoản hiện tại là "+result+"SANG's đồng");
							}
						}
					}
			}
    	});
}