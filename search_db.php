<html>
<head>
<title>Products</title>
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
$search = $_POST['search_db'];
$query = "SELECT item_name, owner, price FROM store WHERE item_name LIKE '%$search%'";
$result = mysql_query($query) or die(mysql_error());

$i = 0;

//print the column titles item name, owner, and price
echo '
<div class="row">
        <div class>
                <h1>Products Similar to: ' . $search . '</h1>
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

        $itemname = $item[0];
        $owner = $item[1];
        $price = $item[2];
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
</body>
</html>
