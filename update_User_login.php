<?php
$connection = mysqli_connect('127.0.0.1', 'root', '','Supermarket');

session_start();
$login = $_SESSION['User_login'];
$password = $_SESSION['User_password'];
$name = $_SESSION['User_full_name'];

$newlogin = $_POST['new_User_login'];

if( $connection == false )
{
echo 'Не удалось подключиться к базе данных!<br>';
exit();
}

$SelectedId = mysqli_query($connection, "SELECT User_id FROM `Users` WHERE User_login = '$login'");
while($row=mysqli_fetch_array($SelectedId))
{
$findId = $row['User_id'];
}

$SelectedLogin = mysqli_query($connection, "SELECT User_login FROM `Users` WHERE User_login = '$newlogin'");
while($row=mysqli_fetch_array($SelectedLogin))
{
$findLogin = $row['User_login'];
}

if($newlogin != $findLogin and $newlogin != null){
	$sql = "UPDATE Users SET User_login='$newlogin' WHERE User_id='$findId'";
	if (mysqli_query($connection, $sql)) {
		echo "<p>$name, ваш логин был успешно изменён!</p>
		<p>СТАРЫЙ ЛОГИН: $login</p>
		<p>НОВЫЙ ЛОГИН: $newlogin</p></body>";
		session_start();
		$_SESSION['User_login'] = $newlogin;
	} else {
		echo "Ошибка обновления в БД: " . mysqli_error($connection)."</body>";
	}
}
else{
	echo "Такой логин уже существует! Изменения не произошли.</body>";	
}
?>