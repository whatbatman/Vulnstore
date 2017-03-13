<?php
	
mysql_connect('localhost', 'root', '') or die(mysql_error());
echo 'connected to mysql<br />';
mysql_select_db('vulnstore') or die(mysql_error());
echo 'connected to db';

$user = $_POST['username'];
$pass = $_POST['password'];
$token = $_SESSION['form_token'];
echo $user;
echo $pass;

$pass = md5($pass);
echo "hashed: " . $pass . "<br />";

//select <db_col_name> from <table_name> where <db_col_name> = <var>
$query = "SELECT username FROM users WHERE username = '$user'";
$result = mysql_query($query) or die(mysql_error());

$num = mysql_numrows($result);
echo $num;
if($num==1){
        $message = 'A user with this name already exists, try again.';
} else{
        $query = "INSERT INTO `users` (`username`, `password`, `balance`) VALUES ('$user', '$pass', 1000)";
	$result = mysql_query($query) or die(mysql_error());
	
        $message = 'Your user has been added. Thank you.<br />';
	header('Location: ' . 'signin.html');
}
?>

<html>
<p><?php echo $message; ?>
<a href="signup.html">Try Again</a>
<a href="signin.html">SignIn</a>
</html>

