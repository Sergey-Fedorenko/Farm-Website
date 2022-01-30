<?php
	$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');
	if( $connection == false )
	{
	echo 'Не удалось подключиться к базе данных!<br>';
	exit();
	}

	$Product_name = $_POST['Product_name'];
	$Product_price = $_POST['Product_price'];
	$Product_type = $_POST['Product_type'];
	$todayDateTime = date('Y-m-d');

	session_start();
	$User_login = $_SESSION['User_login'];
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
				<li><a href="index.php">Главная страница</a></li>
				<?php
				if ($User_full_name != null){
					echo "<li><a href='login.php'><i class='fa fa-address-book '></i>".$User_full_name."</a></li>";
				}else{
				echo "<li><a href='personalArea.php'><i class='fa fa-address-book '></i>Авторизация/Регистрация</a></li>";
				}
				?>
            </ul>
        </div>
    </header>
	<div id="fullpage">
        <div class="section">
			<?php
			if ($User_login != null){
				$Selected_User_id = mysqli_query($connection, "SELECT User_id FROM `Users` WHERE User_login = '$User_login'");
				while($row=mysqli_fetch_array($Selected_User_id))
				{
				$Find_user_id = $row['User_id'];
				}

				$Selected_product_id_request = mysqli_query($connection, "SELECT Product_id FROM `Products` WHERE Product_name='".$Product_name."'");
				while($row=mysqli_fetch_array($Selected_product_id_request))	
				{
				$Product_id = $row['Product_id'];
				}

				mysqli_query ($connection, "INSERT INTO `Purchases`(Product_id, User_id) VALUES ('$Product_id', '$Find_user_id')");	

				echo "Успешная покупка товара!";
				session_destroy();
				
				
			}else{
				echo 'Для покупки товаров необходимо авторизироваться!';
			}
			?>
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