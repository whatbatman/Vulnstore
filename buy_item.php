<html>
<head>
<title>Item Bought</title>
<link rel="stylesheet" href="css/foundation.css" />
</head>
<body>
<!-- Lets you get the balance and users name for the nav bar -->
         <?php
                session_start();

                mysql_connect('localhost', 'root', '') or die(mysql_error());
                mysql_select_db('vulnstore') or die(mysql_error());
                $user = $_SESSION['user'];
                $query = "select balance from users where username = '$user'";
                $result = mysql_query($query) or die(mysql_error());

                $bal = mysql_fetch_row($result); //bal[0] is balance b/c array
        ?>

<!-- ----------------------- TOP NAV BAR IS HERE -------------------- -->

        <nav class="top-bar">
                <ul class="title-area">
                        <li class="name"><h1><a href="homepage.php">VulnStore</a></h1></li>
                </ul>

                <section class="top-bar-section">
                        <ul class="right">
                                <li><a><?php echo "Bal: " .$bal[0] ?></a></li>
                                <li><a href="your_store.php"><?php echo $_SESSION['user'] ."'s Store" ?></a></li>
                                <li><a href="logout.php">Logout</a></li>
                        </ul>
                </section>
        </nav>
        <ul class="large-block-grid-4">



<?php
session_start();
mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('vulnstore') or die(mysql_error());

$item = $_POST['to_buy'];
$user = $_SESSION['user'];
$owner = $_SESSION['form_token'];

$query = "SELECT item_name FROM store WHERE item_name = '$item' and owner = '$owner'";
$result= mysql_query($query) or die(mysql_error());

$num = mysql_numrows($result);
if($num==1){
//Giving the buyer the new item
$query = "update `store` set owner='$user' where item_name = '$item' and owner = '$owner'";
$result = mysql_query($query) or die(mysql_error());

//getting the price of the item
$query = "SELECT price from store where item_name = '$item' and owner = '$user'";
$result = mysql_query($query) or die(mysql_error());
$price = mysql_fetch_row($result);

//getting the balance of the buyer so we can deduct the price of the item
$query = "select balance from users where username = '$user'";
$result = mysql_query($query) or die(mysql_error());
$bal = mysql_fetch_row($result); 
$total = $bal[0] - $price[0];
$query = "update `users` set balance='$total' where username='$user'";
$result = mysql_query($query) or die(mysql_error());

//giving seller their money
$query = "select balance from users where username = '$owner'";
$result = mysql_query($query) or die(mysql_error());
$bal = mysql_fetch_row($result);
$total = $bal[0] + $price[0];
$query = "update `users` set balance='$total' where username='$owner'";
$result = mysql_query($query) or die(mysql_error());

echo '
<div class="row">
	<h1>Your item has been bought, thanks!</h1>
</div>
';

}else{
echo '
<div class="row">
	<h1>Sorry, there was an error processing your request. That sucks.</h1>
</div>
';
}
?>


</body>
</html>
