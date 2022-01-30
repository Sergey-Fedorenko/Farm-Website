<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();
$login = $_SESSION['User_login'];
$name = $_SESSION['User_full_name'];

$newname = $_POST['newname'];

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
    <header>
        <div class="header-logo">
            Supermarket.
        </div>
        <div class="header-menu">
            <ul>
                <li><a href="index.php">Главная страница</a></li>
				<?php
					echo "<li><a href='login.php'><i class='fa fa-address-book '></i>".$newname."</a></li>";
				?>
            </ul>
        </div>
    </header>
	<div class="fullpage">
		<div class="section">
			<?php
			$sql = "UPDATE Users SET User_full_name='$newname' WHERE User_login='$login'";
			if (mysqli_query($connection, $sql)){
				echo "<p>$name, ваш логин был успешно изменён!</p>
				<p>СТАРОЕ ИМЯ: $name</p>
				<p>НОВОЕ ИМЯ: $newname</p></body>";
				session_start();
				$_SESSION['User_full_name'] = $newname;
			} else {
				echo "Ошибка обновления в БД: " . mysqli_error($connection)."</body>";
				session_destroy();
			}

			?>
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