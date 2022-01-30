<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

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
</head>
<body>
    <header>
        <div class="header-logo">
            Supermarket.
        </div>
        <div class="header-menu">
            <ul>
                <li><a href="index.php">Главная страница</a></li>
				<li><a href='personalArea.php'><i class='fa fa-address-book '></i>Авторизация/Регистрация</a></li>
            </ul>
        </div>
    </header>
	<div id="fullpage">
        <div class="section">
			<div class="section_name">Регистрация</div>
			<form method="POST" action="/registration.php">
			<input type="text" placeholder="Ваш логин" name="User_login_register">
			<input type="text" placeholder="Ваш пароль" name="User_password_register">
			<input type="text" placeholder="Ваше имя" name="User_full_name_register">
			<p><input type="submit" name="Отправить"></p>
			</form>
		</div>
        <div class="section">
			<div class="section_name">Авторизация</div>
			<form method="POST" action="/login.php">
			<input type="text" placeholder="Ваш логин" name="User_login">
			<input type="text" placeholder="Ваш пароль" name="User_password">
			<p><input type="submit" name="Изменить"></p>
			</form>
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

