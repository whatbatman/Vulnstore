<?php
session_start();
mysql_connect('localhost', 'root', '') or die(mysql_error());
echo 'connected to mysql<br />';
mysql_select_db('vulnstore') or die(mysql_error());
echo 'connected to db';



$name = $_POST['item_name'];
$price = $_POST['item_price'];
$user = $_SESSION['user'];
echo $user;
echo "<br />" . $price . "<br />";

$query = "SELECT item_name from store where item_name = '$name'";
$result = mysql_query($query) or die(mysql_error());

$num = mysql_numrows($result);
echo $num;

if($num==1){
      $message = 'An item with that name already exists, try again.';
} else {
      $query = "INSERT INTO `store` (`item_name`, `price`, `owner`) VALUES ('$name', '$price', '$user')";
      $result = mysql_query($query) or die(mysql_error());

      $message = 'Item added, thanks!<br />';
}
	echo $message;

?>
