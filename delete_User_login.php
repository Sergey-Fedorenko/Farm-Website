<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();
$login = $_SESSION['User_login'];
$name = $_SESSION['User_full_name'];

echo '<p>ЛОГИН: '.$login.'</p>
<p>ИМЯ: '.$name.'</p>';

if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}

$sql = "DELETE FROM Users WHERE User_login='$login'";

if (mysqli_query($connection, $sql)) {
    echo $name.", ваш аккаунт был успешно удалён!</body>";
	session_destroy();
} else {
    echo "Ошибка удаления в БД: " . mysqli_error($connection);
	session_destroy();
}
?>