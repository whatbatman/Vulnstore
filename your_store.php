<html>
<head>
<title>Your Store</title>
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

<!-- ----------------------ALLOW USER TO ADD ITEM TO STORE ---------- -->
<?php

echo '
	<form action="create_item.php" method="post">
		<div class="rows">
			<div class="large-4 columns">
                		<h1>' . $user . '\'s Store </h1>
       			 </div>
		</div>

		<div class="row">
		<div class="large-6 columns">		
			<h3>Create Item!</h3>
			<label>Item Name
				<input type="text" placeholder="Your item name" name="item_name" />
			</label>
			<label>Item Price
				<input type="text" placeholder="How much is it?" name="item_price"/>
			</label>
			<input type="submit" value="Add Item" class="button" style="width: 30%"/>
		</div>
		</div>

	</form>
';
?>
<!-- ------------------------SHOW USER THEIR ITEMS -------------------- -->

<?php
$user = $_SESSION['user'];
$query = "SELECT item_id, item_name, owner, price FROM store WHERE owner = '$user'";
$result = mysql_query($query) or die(mysql_error());

//print the column titles item name, owner, and price
echo '
<div class="row">
        <div class="large-4 columns">
                <h3>Item Name</h3>
        </div>
        <div class="large-4 columns">
                <h3>Owner</h3>
        </div>
        <div class="large-4 columns">
                <h3>Price</h3>
        </div>
</div>';



$i = 0;
while ($item = mysql_fetch_row($result)){

// apparently 1st letter,    rest of word      owner             price
	//echo $item[0] . " ".  $item[1] . " " . $item[2] . " " . $item[3] . "<br />";
	
	$itemname = $item[1];
	$owner = $item[2];
	$price = $item[3];

if(strlen($itemname) > 0){
//php is amazing and somehow this actually works...
echo '
	<div class = "row">
		<div class = "large-4 columns">
			<p>' . $itemname . '</p>
		</div>
		 <div class = "large-4 columns">
       	        	 <p>' . $owner. '</p>
        	</div>
        	<div class = "large-4 columns">
                	<p>' . $price . '</p>
        	</div>
	</div>
';
}
}
?>

<!-- ----------------------reviews -------------------------- -->


<?php
session_start();
//we need to pull the reviews each time the page is loaded
$s_user = $_SESSION['user'];
$query = "SELECT review from store where owner = '$s_user'";
$result = mysql_query($query) or die(mysql_error());


while ($rev = mysql_fetch_row($result)){
        //display the reviews on the page
        echo '
                <div class="small-8 columns right" >
                                 <p class="text-right">' . $rev[0] . '</p>
                </div>';

}

?>

</body>
</html>
