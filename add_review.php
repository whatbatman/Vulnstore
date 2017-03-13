<?php
session_start();
mysql_connect('localhost', 'root', '') or die(mysql_error());
echo 'connected to mysql<br />';
mysql_select_db('vulnstore') or die(mysql_error());
echo 'connected to db';

$u_review = $_POST['review'];
$s_user = $_SESSION['form_token'];
if(strpos($u_review, '<script>') !== false){
$u_review = str_replace('<script>', '');
}


//$u_review = str_replace("\(", "\(\'") . $u_review;
//$u_review = htmlspecialchars($u_review);

echo "asdfasdf: " . $u_review;
$query = "INSERT INTO `store` (`review`, `owner`) values ('$u_review', '$s_user')";
$result = mysql_query($query) or die(mysql_error());

$num = mysql_numrows($result);
if($num==1){
        $message = 'Your review has been entered, Thanks!';
        echo $message;
}
?>
