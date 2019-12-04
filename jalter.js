var odetailpressed=false;

function addproduct()
{
	var d=parseInt(document.getElementById("addp").className);
	
	$.ajax({url:"order_ajax.php", dateType:"text", success:function(result)
	{
		var s='<div id="p'+d+'"><select name="g'+d+'" class="gameselect">'+result+'</select><div>Số lượng</div><input type="number" name="sl'+d+'" ><br><input type="button" value="Xóa" onclick="remove('+d+')"><hr></div>';
		$("#product-area").html($("#product-area").html()+s);
		document.getElementById("addp").className=parseInt(parseInt(d)+1);
	}});
}

function view(t, id)
{
	$("#dssp").show();
	$("#addp").show();
	$(t).hide();
	var s="";
	$.ajax({url:"order_ajax.php", dateType:"text", type:"GET", data:{id: id}, success:function(result)
	{
		result=result.split("?count=");
		s+=result[0];
		document.getElementById("addp").className=result[1];
		$("#product-area").html(s);
		odetailpressed=true;
	}});
}

function remove(p)
{
	$("#p"+p).html("");
}

function subm()
{
	if(document.getElementById("Ostatus").selectedIndex==2)
		if(!confirm("Nếu sửa trạng thái thành Hoàn thành bạn sẽ không thể sửa hóa đơn nữa. Tiếp tục?"))
			return false;
	if(odetailpressed)
		document.getElementById("plim").innerHTML='<input type="text" name="soluong" value="'+(parseInt(document.getElementById("addp").className)-1)+'">';
	alert("SD");
	return true;
}