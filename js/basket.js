window.onload = function () {
	$item_cart_count  = sessionStorage.getItem('item_cart_count');
	$item_cart_content = JSON.parse(sessionStorage.getItem('item_cart_content'));
	for ($i = 0; $i < $item_cart_count; $i ++){
		$('#basket_container').append('<div class="basket_item" id="basket_item_' + $i + '"><div class="basket_item_content"><div class="basket_item_and_image_block"><div class = "basket_item_image">' + $item_cart_content[$i][3] + '</div><div class = "basket_item_name">' + $item_cart_content[$i][0] + ': ' + $item_cart_content[$i][1] + '</div></div><div class = "basket_item_price_block"><span class="current_price">' + $item_cart_content[$i][2] + '</span></div></div><div class="buy_button"><form method="POST" action="add_item_to_db.php"><input type="hidden" name="Product_name" value="' + $item_cart_content[$i][1] + '"><input type="hidden" name="Product_price" value="' + $item_cart_content[$i][2] + '"><input type="hidden" name="Product_type" value="' + $item_cart_content[$i][0] + '"><input type="submit" name="submit" value="Купить"/></form><button onclick="Delete(' + $i + ');">Удалить</button></div></div>');
	}
};

function Delete($item_id){
	$item_cart_content = JSON.parse(sessionStorage.getItem('item_cart_content'));
	$item_cart_content.splice($item_id, 1)
	sessionStorage.setItem('item_cart_content', JSON.stringify($item_cart_content));
	$el = document.getElementById("basket_item_" + $item_id);
	$el.remove();

}