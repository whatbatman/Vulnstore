<?php
	session_start();
ini_set("display_errors", "off");
mysql_connect("localhost", "root", "") or die(mysql_error());
echo "connected to mysql<br />";
mysql_select_db("vulnstore") or die(mysql_error());
echo "connected to db<br />";

$store = $_POST['search_us'];
//$store = mysql_real_escape_string($store);
//$store = stripslashes($store);
echo "THIS IS IT: " . $store . "<br />";
$query = "SELECT item_name, item_picture, owner FROM store WHERE owner = '$store'";
$result = @(mysql_query($query));

$num = (@mysql_numrows($result));
echo "num is: -> " . $num . "<br />";


$i = 0;
while ($item = mysql_fetch_row($result)){
        //   item_name       path_to_pic      owner
        echo $item[0] . " " . $item[1] . " " . $item[2] .  "<br />";

	echo ('<img src="' . $item[1] . '"/>');
        $i++;
}

?>
