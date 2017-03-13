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

<!-- ----------------------ALLOW USER TO ADD ITEM TO STORE THIS ISN'T HERE ---------- 

	<form action="create_item.php" method="post">
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

	</form> -->

<!-- ------------------------SHOW USER THEIR ITEMS -------------------- -->

<?php
session_start();
$s_user = $_POST['search_us'];
$query = "SELECT item_id, item_name, owner, price FROM store WHERE owner = '$s_user'";
$result = @mysql_query($query);

$i = 0;

//print the column titles item name, owner, and price
echo '
<div class="row">
	<div class>
		<h1>' . $s_user . '\'s Store </h1>
	</div>
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



        <form action="add_review.php" method="post">
                <div class="row">
                <div class="large-6 columns">
                        <label>Leave a Review
                                <input type="text" placeholder="'Wow! Cool store man!'" name="review" />
                        </label>
                        <input type="submit" value="Leave Review" class="button"/>
                </div>
                </div>

        </form>

<!-- -------------------- let us buy things! ---------------- -->

	<form action="buy_item.php" method="post">
		<div class="row">
		<div class="large-6 columns">
			<label>What item would you like to buy?
				<input type="text" placeholder="Type item name here" name="to_buy" />
			</label>
				<input type="submit" value="Buy it!" class="button" />
		</div>
		</div>
	</form>


<!-- ------------------- Reviews! --------------------------- -->
<?php
session_start();
//we need to pull the reviews each time the page is loaded
$s_user = $_POST['search_us'];
$form_token = $s_user;
$_SESSION['form_token'] = $form_token;
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

