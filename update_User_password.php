<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();
$login = $_SESSION['User_login'];
$password = $_SESSION['User_password'];
$name = $_SESSION['User_full_name'];

$newpassword = $_POST['new_User_password'];

if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}

$sql = "UPDATE Users SET User_password='$newpassword' WHERE User_login='$login'";

if ($newpassword != null){
	if (mysqli_query($connection, $sql)) {
		echo "<p>$name, ваш пароль был успешно изменён!</p>
		<p>СТАРЫЙ ПАРОЛЬ: $password</p>
		<p>НОВЫЙ ПАРОЛЬ: $newpassword</p></body>";
		session_start();
		$_SESSION['User_password'] = $newpassword;
	} else {
		echo "Ошибка обновления в БД: " . mysqli_error($connection)."</body>";
	}
}
?>