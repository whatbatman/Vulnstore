<?php
session_start(); //starts the session so we can save their username after login



mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("vulnstore") or die(mysql_error());

$user = $_POST['a_username'];
$pass = $_POST['a_password'];

$pass = md5($pass);
$query = "SELECT username, password FROM users WHERE username = '$user' and password = '$pass'";
$result = mysql_query($query) or die(mysql_error());

$num = mysql_numrows($result);
if($num==1){
	$message = 'Login Good';
	header('Location:homepage.php');
	$_SESSION['user'] = $user;
	echo $_SESSION['user'] ." <=== session user";
} else {
	echo "login bad";
}
?>
