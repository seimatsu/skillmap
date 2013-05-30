<?php
require('dbconnect.php');

?>


<html>
<head></head>
<body>

<p>Updated!</p>


<?php

foreach($_REQUEST['skills'] as $skills) {
	$skillname = $skills.", $skillname";
}


$sql = sprintf('UPDATE skillmap SET name="%s", gender="%s", skill_name="%s" WHERE id=%d',
	mysql_real_escape_string($_POST['name']),
	mysql_real_escape_string($_POST['gender']), 
	mysql_real_escape_string($skillname),
	mysql_real_escape_string($_POST['id']));
	mysql_query($sql) or die(mysql_error());
?>


<p>
<a href="index.php">Top Page</a></p>
<p>
<a href="input.php">Input</a></p>



</body>
</html>