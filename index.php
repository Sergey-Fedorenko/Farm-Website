<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');
if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}

session_start();
$User_login = $_SESSION['User_login'];
$User_full_name = $_SESSION['User_full_name'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supermarket</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/all.css" type="text/css">
	<link rel="stylesheet" href="css/fullpage.css" type="text/css">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Для IE -->
    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
      <![endif]-->
</head>
<body>
	<!-- <audio id="background_music" src="music/main_page_bkg_music.mp3"></audio> -->
    <header>
        <div class="header-logo">
           Supermarket.
        </div>
        <div class="header-menu">
            <ul>
                <li data-menuanchor="Drink"><a href="#Drink">Drink</a></li>
                <li data-menuanchor="Food"><a href="#Food">Food</a></li>
                <li data-menuanchor="Electronics"><a href="#Electronics">Electronics</a></li>
				<?php
				if ($User_full_name != null){
					echo "<li><a href='login.php'><i class='fa fa-address-book '></i>".$User_full_name."</a></li>";
				}else{
				echo "<li><a href='personalArea.php'><i class='fa fa-address-book '></i>Авторизация/Регистрация</a></li>";
				}
				?>
				<li><a href="basket.php"><i class="fa fa-shopping-cart"></i>Корзина</a></li>
            </ul>
        </div>
    </header>
	<div id="fullpage">
        <div class="section">
			<div class = "drink_content" id="drink_content">

			</div>
		</div>
        <div class="section">
			<div class = "food_content" id = "food_content">
			</div>
		</div>
        <div class="section">
			<div class = "electronics_content" id = "electronics_content">
			</div>
		</div>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="library/jquery-ui-1.12.1.custom/jquery-ui.js" defer></script>
	<script src="library/jquery-ui-1.12.1.custom/jquery-ui.min.js" defer></script>
    <script src="js/fullpage.js"></script>
    <script src="js/index.js"></script>
</body>

</html>
<!-- <div class="item"><div class="visible_item"><div class="item_image"><img src="https://static.eldorado.ru/photos/71/716/237/16/new_71623716_l_1631659336.jpeg/resize/380x240/"></div><div class="item_name_and_price_container"><div class="item_price">'.$items_prices_onlinetrade[1][$i].' р.</div><div class="item_name">'.$items_titles_onlinetrade[1][$i].'</div></div></div><div class="invisible_item"><div class="item_buy_container"><form method="POST" action="add_item_to_db.php"><input type="hidden" name="Product_name" value="'.$items_titles_onlinetrade[1][$i].'"><input type="hidden" name="Product_price" value="'.$items_prices_onlinetrade[1][$i].'"><input type="hidden" name="Magazine" value="Online-trade"><input class="submit_item_buy" type="submit" name="submit" value="В корзину"/></form></div><div class="item_name_and_price_container"><div class="item_price">'.$items_prices_onlinetrade[1][$i].' р.</div><div class="item_name">'.$items_titles_onlinetrade[1][$i].'</div></div></div></div> -->

<?php
	echo "<script type='text/javascript'>";
	
	$counter = 0;
	$current_product = 0;
	$Selected_drink = mysqli_query($connection, "SELECT Product_name, Product_price, Product_image FROM `Products` WHERE Product_type_id = 1");
	while($row=mysqli_fetch_array($Selected_drink))
	{
		$Find_drink_name = $row['Product_name'];
		$Find_drink_price = $row['Product_price'];
		$Find_drink_image = base64_encode($row['Product_image']);
		
		if ($current_product % 8 == 0){
			echo '$("#drink_content_slide_'.$counter.'").append(\'<div class = "section_name">Drink</div>\');';
			$counter++;
			echo 'newSlide(\'drink_content\', '.$counter.');';
			echo '$("#drink_content_slide_'.$counter.'").append(\'<div class="items_container" id="drink_items_container_'.$counter.'"></div>\');';
		}
		echo '$item_drink_image_'.$current_product.' = \'img src="data:/jpeg;base64,'.$Find_drink_image.'" width="100" height="100"\';';
		echo '$("#drink_items_container_'.$counter.'").append(\'<div class="item"><div class="visible_item"><div class="item_image"><img src="data:/jpeg;base64,'.$Find_drink_image.'" width="100" height="100"></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_drink_price.' р.</div><div class="item_name">'.$Find_drink_name.'</div></div></div><div class="invisible_item"><div class="item_buy_container"><input class="submit_item_buy" type="submit" name="submit" onclick="add_item_to_cart(String(/Drink/), String(/'.$Find_drink_name.'/), '.$Find_drink_price.', $item_drink_image_'.$current_product.');" value="В корзину"/></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_drink_price.' р.</div><div class="item_name">'.$Find_drink_name.'</div></div></div></div>\');';
		
		
		$current_product++;
	}
	
	$counter = 0;
	$current_product = 0;
	$Selected_food = mysqli_query($connection, "SELECT Product_name, Product_price, Product_image FROM `Products` WHERE Product_type_id = 2");
	while($row=mysqli_fetch_array($Selected_food))
	{
		$Find_food_name = $row['Product_name'];
		$Find_food_price = $row['Product_price'];
		$Find_food_image = base64_encode($row['Product_image']);
		
		if ($current_product % 8 == 0){
			echo '$("#food_content_slide_'.$counter.'").append(\'<div class = "section_name">food</div>\');';
			$counter++;
			echo 'newSlide(\'food_content\', '.$counter.');';
			echo '$("#food_content_slide_'.$counter.'").append(\'<div class="items_container" id="food_items_container_'.$counter.'"></div>\');';
		}
		echo '$item_food_image_'.$current_product.' = \'img src="data:/jpeg;base64,'.$Find_food_image.'" width="100" height="100"\';';
		echo '$("#food_items_container_'.$counter.'").append(\'<div class="item"><div class="visible_item"><div class="item_image"><img src="data:/jpeg;base64,'.$Find_food_image.'" width="100" height="100"></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_food_price.' р.</div><div class="item_name">'.$Find_food_name.'</div></div></div><div class="invisible_item"><div class="item_buy_container"><input class="submit_item_buy" type="submit" name="submit" onclick="add_item_to_cart(String(/food/), String(/'.$Find_food_name.'/), '.$Find_food_price.', $item_food_image_'.$current_product.');" value="В корзину"/></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_food_price.' р.</div><div class="item_name">'.$Find_food_name.'</div></div></div></div>\');';
		
		
		$current_product++;
	}
	
	$counter = 0;
	$current_product = 0;
	$Selected_electronics = mysqli_query($connection, "SELECT Product_name, Product_price, Product_image FROM `Products` WHERE Product_type_id = 3");
	while($row=mysqli_fetch_array($Selected_electronics))
	{
		$Find_electronics_name = $row['Product_name'];
		$Find_electronics_price = $row['Product_price'];
		$Find_electronics_image = base64_encode($row['Product_image']);
		
		if ($current_product % 8 == 0){
			echo '$("#electronics_content_slide_'.$counter.'").append(\'<div class = "section_name">electronics</div>\');';
			$counter++;
			echo 'newSlide(\'electronics_content\', '.$counter.');';
			echo '$("#electronics_content_slide_'.$counter.'").append(\'<div class="items_container" id="electronics_items_container_'.$counter.'"></div>\');';
		}
		echo '$item_electronics_image_'.$current_product.' = \'img src="data:/jpeg;base64,'.$Find_electronics_image.'" width="100" height="100"\';';
		echo '$("#electronics_items_container_'.$counter.'").append(\'<div class="item"><div class="visible_item"><div class="item_image"><img src="data:/jpeg;base64,'.$Find_electronics_image.'" width="100" height="100"></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_electronics_price.' р.</div><div class="item_name">'.$Find_electronics_name.'</div></div></div><div class="invisible_item"><div class="item_buy_container"><input class="submit_item_buy" type="submit" name="submit" onclick="add_item_to_cart(String(/electronics/), String(/'.$Find_electronics_name.'/), '.$Find_electronics_price.', $item_electronics_image_'.$current_product.');" value="В корзину"/></div><div class="item_name_and_price_container"><div class="item_price">'.$Find_electronics_price.' р.</div><div class="item_name">'.$Find_electronics_name.'</div></div></div></div>\');';
		
		
		$current_product++;
	}
	
	echo "</script>";
?>