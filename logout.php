<?php
session_start();

session_unset();

session_destroy();
?>

<html>
<head>
<title>Logged Out :(</title>
</head>

<body>
<h1>You have been logged out.</h1>
 <a href="signin.html">Log back in!</a>
</body>
</html>
