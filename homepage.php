<html>
<head>
<title>HomePage</title>
<link rel="stylesheet" href="css/foundation.css" />
</head>
<body>
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

<!-- ----------------------- SEARCH PRODUCTS IS HERE --------------- -->

<form action = "search_db.php" method = "post">
	<div class="row">
		<div class="large-10 columns">
			<h3>Search Products
					<input type="text" placeholder="Search for a product" name="search_db" />
					<input type="submit" class="button right" value="Search!"/>
			</h3>
		</div>
	</div>
</form>

<!-- ----------------------- SEARCH USERS IS HERE  ---------------- -->

<form action = "search_2.php" method = "post">
   <div class="row">
        <div class="large-10 columns">
            <h3>Search User Store
                    <input type="text" placeholder="Search a users store" name="search_us" />
            		<input type="submit" class="button right" value="Search!"/>
			</h3>
        </div>
    </div>

</form>
</body>
</html>
