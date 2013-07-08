<?php
require('dbconnect.php');

?>


<html>
<head></head>
<body>

<p>OK!</p>


<?php

foreach($_REQUEST['skills'] as $skills) {
	$skillname = $skills.", $skillname";
}


$haveskill = sprintf('INSERT INTO skillmap SET name="%s", gender="%s", skill_name="%s"',
	mysql_real_escape_string($_POST['name']),
	mysql_real_escape_string($_POST['gender']), 
	mysql_real_escape_string($skillname));
	
	mysql_query($haveskill) or die(mysql_error());
?>


<p>
<a href="index.php">Top Page</a></p>
<p>
<a href="input.php">Input</a></p>



</body>
</html>

