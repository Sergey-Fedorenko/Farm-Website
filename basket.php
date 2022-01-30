<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();
$User_login = $_SESSION['User_login'];
$User_full_name = $_SESSION['User_full_name'];

if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}	
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
<body>
<div id="main_container">
	<div class="basket_container" id="basket_container">
	<h1> Оформление заказа </h1>

	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="library/jquery-ui-1.12.1.custom/jquery-ui.js" defer></script>
<script src="library/jquery-ui-1.12.1.custom/jquery-ui.min.js" defer></script>
<script src="js/fullpage.js"></script>
<script src="js/index.js"></script>
<script src="js/basket.js"></script>
</html>