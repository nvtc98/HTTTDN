var curPage = 1;
var itemsPerPage = 6;
var contentData;

function show(url, data)
{
	url=url;
	data=data;
	data.curPage = curPage;
	data.itemsPerPage = itemsPerPage;
	contentData={
			url : url,
			type : 'get',
			dataType : 'text',
			data: data,
			success : getData,
		};
	$.ajax(contentData);
}

function getData(result)
{
	result=result.split('&count=');
	var numberOfPages=Math.ceil(result[1]/itemsPerPage);
	result=result[0];
	$('.content').html(result);
	paging(numberOfPages);
	/*if($("body").height() < $(window).height()) //chiều cao website < chiều cao màn hình trình duyệt
	{
		var others = $("#myHeader").hasClass("sticky")?50:0;
		$(".footer").css("height",($(window).height()-$("body").height()-others)+"px");
	}*/
}
	
function paging(numberOfPages)
{
	if(numberOfPages>1)
	{
		var s='';
		var s1='<input type="button" value="';
		var s2='" class="page-button" onClick="changePage(';
		var s3=')" />';
		if(curPage>1)
			s+=s1+"|<"+s2+1+s3;
		if(curPage<6)
			for(var i=1;i<curPage;i++)
				s+=s1+i+s2+i+s3;
		else
		{
			s+='...';
			for(var i=curPage-4;i<curPage;i++)
				s+=s1+i+s2+i+s3;
		}
		s+='<input type="button" value="'+curPage+'" class="page-button-active" disabled onClick="changePage('+curPage+')" />';
		if(numberOfPages-curPage<5)
			for(var i=curPage+1;i<=numberOfPages;i++)
				s+=s1+i+s2+i+s3;
		else
		{
			for(var i=1;i<5;i++)
				s+=s1+(i+curPage)+s2+(i+curPage)+s3;
			s+='...';
		}
		if(curPage<numberOfPages)
			s+=s1+">|"+s2+numberOfPages+s3;
		document.getElementById("page-list").style="padding: 50px 0 50px 0";
		document.getElementById("page-list").innerHTML=s;
	}
	else document.getElementById("page-list").innerHTML="";
}

function changePage(clickedButton)
{
	curPage = clickedButton;
	contentData.data.curPage = curPage;
	$.ajax(contentData);
}

function chitiet(id, e)
{
	if(e.target.className!="product-utility")
		window.location='chitietsp.php?gid='+id;
}
function addCmpr(productId)
{
	$.cookie('cmpr2') && $.cookie('cmpr1', $.cookie('cmpr2'), { path: '/' });
	$.cookie('cmpr1') && $.cookie('cmpr2', productId.toString(), { path: '/' }) || $.cookie('cmpr1', productId.toString(), { path: '/' });
	alert("Đã thêm sản phẩm vào danh sách so sánh.");
}
function addCart(id)
{
	a=prompt("Nhập số lượng:","");
	while (parseInt(a)<1 ||parseInt(a)>3) { a=prompt("Số lượng tối thiểu là 1 và tối đa là 3!\nMời nhập số lượng",""); }
	if (!a) return false;
	var pat=/[123]/;
	if (!pat.test(a)) a=1;
	alert("Đã thêm vào giỏ hàng");
	var now = new Date();
	now.setTime(now.getTime()+60*60*1000);
	time=now.toGMTString();
	document.cookie="product"+id+"="+a+";expires="+time+";path=/";
}
function basketQuantity()
{
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	count=0;
	for(var i = 0; i <ca.length; i++)
	{
		var c = ca[i];
		while (c.charAt(0) == ' ') { c = c.substring(1); }
		if (c.indexOf('product') == 0) count++;
	}
	return count;
}
function Basket()
{
	if (basketQuantity()==0) alert("Giỏ hàng trống");
	else window.location="giohangcautruc.php";
}