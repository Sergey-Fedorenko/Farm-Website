<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();

if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}

//$sql = "UPDATE Users SET Text='$text' WHERE User_login='$User_login'";

if ($_POST['User_login'] != null){
	$User_login = $_POST['User_login'];
	$User_password = $_POST['User_password'];
	$_SESSION['User_login'] = $_POST['User_login'];
	$_SESSION['User_password'] = $_POST['User_password'];
}else{
	$User_login = $_SESSION['User_login'];
	$User_password = $_SESSION['User_password'];
	$User_full_name = $_SESSION['User_full_name'];
	$User_id = $_SESSION['User_id'];
}

$SelectedUser_password = mysqli_query($connection, "SELECT * FROM `Users` WHERE User_login = '$User_login'");
while($row=mysqli_fetch_array($SelectedUser_password))
{
$find_User_password = $row['User_password'];
$find_User_full_name = $row['User_full_name'];
$find_User_id = $row['User_id'];
}

$_SESSION['User_full_name'] = $find_User_full_name;
$_SESSION['User_id'] = $find_User_id;

if(array_key_exists('exit', $_POST)) { 
	ExitFromAcc();
} 
function ExitFromAcc() { 
	session_unset();
	session_destroy();
	exit("<meta http-equiv='refresh' content='0; url= /index.php'>");
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
	<div id="fullpage">
	<?php
	if ($find_User_password == $User_password){
		$Selected_User_avatar = mysqli_query($connection, "SELECT User_avatar FROM `Users` WHERE User_login = '$User_login'");
		while($row=mysqli_fetch_array($Selected_User_avatar))
		{
		$User_avatar = base64_encode($row['User_avatar']);
		}
		
		$Bought_products = [];
		
		$Selected_User_avatar = mysqli_query($connection, "SELECT Product_id FROM `Purchases` WHERE User_id = '$find_User_id'");
		while($row=mysqli_fetch_array($Selected_User_avatar))
		{
		$Bought_products = $row['Product_id'];
		}
		
		echo
			'<div class="section">
				<div class="menu">
					<div class="information"';
						if ($User_avatar != null){
						echo
						'<p>Аватар: <img src="data:User_avatar/jpeg;base64,'.$User_avatar.'" width="100" height="100"></p>';
						}
						echo
						'<p>ЛОГИН: '.$User_login.'</p>
						<p>ИМЯ: '.$find_User_full_name.'</p>
						<p>ПАРОЛЬ: '.$User_password.'</p>
						<p>'.$find_User_full_name.', вы успешно залогинились!</p>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="update_User_password">
				<form method="POST" action="/update_User_password.php">
				<input type="text" placeholder="Ваш новый пароль" name="new_User_password">
				<p></p>
				<input type="submit" name="Change" value="Изменить пароль">
				</form>
				</div>
			</div>
			<div class="section">
				<div class="update_User_login">
				<form method="POST" action="/update_User_login.php">
				<input type="text" placeholder="Ваш новый логин" name="new_User_login">
				<p></p>
				<input type="submit" name="Change" value="Изменить логин">
				</form>
				</div>
			</div>
			<div class="section">
				<div class="update_name">
				<form method="POST" action="/update_User_full_name.php">
				<input type="text" placeholder="Ваше новое имя" name="newname">
				<p></p>
				<input type="submit" name="Change" value="Изменить имя">
				</form>
				</div>
			</div>
			<div class="section">
				<div class="delete_User_login">
				<p>Если вы собираетесь удалить аккаунт - нажмите на кнопку</p>
				<form method="POST" action="/delete_User_login.php">
				<input type="submit" value="Удалить аккаунт" name="DeleteAccount">
				</form>
				</div>
			</div>
			<div class="section">
				<div class="deauthorization">
				<form method="POST" action="login.php">
				<p>Выйти из аккаунта: <Br>
				<p></p>
				<input type="submit" name="exit" value="Выход">
				</form>
				</div>
			</div>
			<div class="section">
				<div class="pictureLoad">
				<form method="POST" action="" enctype="multipart/form-data">
				<p><input type="file" name="imagefile" accept=".txt,image/*"></p>
				<p><input type="submit" name="upload_user_avatar" value="Загрузить"></p>
				</form>
				</div>
				</div>';
		if (isset($_POST['upload_user_avatar'])) {
			if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
				echo "<br />Выберите картинку";
			} 
			else { 
				$image = $_FILES['imagefile']['tmp_name'];
				#$image = base64_encode(file_get_contents(addslashes($image)));
				$image = addslashes(file_get_contents($image));
				mysqli_query($connection, "UPDATE Users SET User_avatar='$image' WHERE User_login='$User_login'"); 
			}
		}
	}else{
	echo '<div class="section"><p>Неверный пароль/логин!</p></div>';
	session_destroy();
	}
	?>
	</div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="library/jquery-ui-1.12.1.custom/jquery-ui.js" defer></script>
	<script src="library/jquery-ui-1.12.1.custom/jquery-ui.min.js" defer></script>
    <script src="js/fullpage.js"></script>
    <script src="js/index.js"></script>
</body>

</html>