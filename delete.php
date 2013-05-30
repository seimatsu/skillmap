<?php
require('dbconnect.php');

$sql = sprintf("DELETE FROM skillmap WHERE id=%d",
	mysql_real_escape_string($_REQUEST['id'])
);
mysql_query($sql) or die(mysql_error());
?>

<html>
<head></head>
<body>

<p>Deleted!</p>
<p>
<a href="index.php">Top Page</a></p>
<p>
<a href="input.php">Input</a></p>


</body>
</html>
