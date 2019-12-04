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

function show($id , $name, $src, $price)
{
	$name=ucwords(strtolower(strlen($name)<31?$name:(substr($name,0,28))."..."));
	$src=explode("??", $src);
	$src=$src[0];
	echo '<div class="product-show">
	<div class="view view-second" onClick="chitiet('.$id.', event)">
		<img src="'.$src.'" width="100%"/>
		<div class="mask"></div>
		<img class="product-utility" title="Thêm vào giỏ" src="IMG/cart.png" onclick="addCart('.$id.')" width="30" height="30" style="left: 35%" />
		<img class="product-utility" title="Thêm vào so sánh" src="IMG/compare.png" onclick="addCmpr('.$id.')" width="30" height="30" style="left: 51%" />
	</div>
	<div>
		<p class="product-name">'.$name.'</p>
		<p class="cost-tag">Giá: '.price($price).' VND</p>
	</div>  
</div>';
}
?>